@extends('layout.base')

@section('title', 'Blog Details')

@section('content')
    <section class="page-header"
        style="background-image: url({{ asset('assets/images/backgrounds/postDetailWallpaper.jpg') }});
                                        background-size: cover;
                                        background-position: bottom;">
        <div class="container">
            <h2>Post Details</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('blog') }}">Home</a></li>
                <li><span>Post</span></li>
            </ul>
        </div>
    </section>

    <section class="blog-list">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div id="postMessageBox" class="messageBox"
                        style="display: none; color: red; font-size: 16px; padding: 10px;"></div>

                    <div id="postDetails"> <!-- Placeholder for post details -->
                        <!-- Dynamic content will be loaded here -->
                    </div>

                    <div id="commentsSection"> <!-- Placeholder for comments -->
                        <!-- Comments will be dynamically loaded here -->
                    </div>
                    <div id="messageBox" class="messageBox"
                        style="display: none; color: red; font-size: 16px; padding: 10px;"></div>
                    @if (Auth::check())
                        <div class="comment-form">

                            <h3 class="comment-form__title">Leave a Comment</h3>
                            <form id="commentForm" class="contact-one__form">
                                @csrf
                                <div class="row low-gutters">
                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <textarea name="message" placeholder="Write Message" required></textarea>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="input-group">
                                            <button type="submit" class="thm-btn contact-one__btn">Send message</button>
                                        </div>
                                    </div>

                                </div>
                            </form>

                        </div>
                    @endif
                </div>
                <div class="col-lg-4">
                    <div class="sidebar">
                        <div class="sidebar__single sidebar__post">
                            <h3 class="sidebar__title">Recent Posts</h3>
                            <ul class="sidebar__post-list list-unstyled" id="recentPosts">
                                <!-- Recent posts will be dynamically loaded here -->
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Edit Post Modal -->
    <div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-labelledby="editPostModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editPostForm" method="POST" enctype="multipart/form-data"> <!-- Add enctype for file upload -->
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPostModalLabel">Edit Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editPostId" name="postId">
                        <div class="form-group">
                            <label for="editPostTitle">Title</label>
                            <input type="text" class="form-control" id="editPostTitle" name="title" required>
                        </div>
                        <div class="form-group">
                            <label for="editPostContent">Content</label>
                            <textarea class="form-control" id="editPostContent" name="content" rows="3" required></textarea>
                        </div>
                        <div class="form-group">
                            <label for="editPostImage">Image</label>
                            <input type="file" class="form-control-file" id="editPostImage" name="image">
                            <br>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="removeImage" name="removeImage"
                                    value="true">
                                <label class="form-check-label" for="removeImage">Remove existing image</label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!-- Edit Comment Modal -->
    <div class="modal fade" id="editCommentModal" tabindex="-1" role="dialog" aria-labelledby="editCommentModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="editCommentForm" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="editCommentModalLabel">Edit Comment</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" id="editCommentId" name="commentId">
                        <div class="form-group">
                            <label for="editCommentContent">Content</label>
                            <textarea class="form-control" id="editCommentContent" name="content" rows="3" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    var userId = @json(auth()->user()->id ?? null);
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        const postId = {{ $post->id }};
        fetchPostDetails(postId);
        fetchRecentPosts();

        $('#commentForm').on('submit', function(e) {
            e.preventDefault();
            const $submitButton = $(this).find('button[type="submit"]');
            const message = $(this).find('textarea[name="message"]').val();

            $submitButton.prop('disabled', true);
            if (!message) {
                $('#messageBox').text('Please enter a message.').show();
                $submitButton.prop('disabled', false);
                return;
            }

            $.ajax({
                url: '/blog/post-comment/' + postId,
                type: 'POST',
                data: {
                    _token: $('input[name="_token"]').val(),
                    message: message
                },
                success: function(response) {
                    $('#messageBox').text('Comment added successfully!').css('color',
                        'green').show();
                    $('#commentForm textarea[name="message"]').val('');
                    fetchPostDetails(postId);
                    setTimeout(function() {
                        $submitButton.prop('disabled', false);
                        $('#messageBox')
                            .hide();
                    }, 5000);
                },
                error: function(xhr) {
                    $('#messageBox').text('Error posting comment. Please try again.').css(
                        'color', 'red').show();
                    setTimeout(function() {
                        $submitButton.prop('disabled', false);
                    }, 5000);
                },
                complete: function() {
                    $submitButton.prop('disabled', false);
                }
            });
        });


        function fetchPostDetails(postId) {
            $.ajax({
                url: `/blog/details/fetch/${postId}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    renderPostDetails(data); // Simplified call since data includes postId
                    bindLikeButton();
                    renderComments(postId, data.comments);
                    bindLikeCommentButtons();
                },
                error: function(error) {
                    console.error('Error fetching post details:', error);
                }
            });
        }

        function renderPostDetails(data) {
            let isOwner = data.user.id === userId;
            let likeButtonClass = data.user_has_liked ? 'fas fa-thumbs-up' : 'far fa-thumbs-up';
            let postHtml = `
        <div class="blog-details__content">
            ${isOwner ? `
            <div class="dropdown">
                <button class="thm-btn post-one__btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    &middot;&middot;&middot;
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <button class="dropdown-item edit-post" data-id="${data.id}" data-title="${data.title}" data-content="${encodeURIComponent(data.content)}">Edit post</button>
                    <button class="dropdown-item text-danger delete-post" data-id="${data.id}">Delete post</button>
                </div>
            </div>` : ''}
            <h3>${data.title}</h3>
            <div>${data.content}</div>
            <br>
            <div class="blog-details__image">
                ${data.image ? `<img class="img-fluid" src="/uploads/post_images/${data.image}" alt="Image for ${data.title}">` : ''}
            </div>
            <br>
            <ul class="list-unstyled blog-one__meta">
                <li>
                    <a href="#" class="like-btn" data-post-id="${data.id}">
                        <i class="${likeButtonClass}"></i>
                        <span class="likes-count">${data.likes_count}</span> Likes
                    </a>
                </li>
                <li><a href="#"><i class="far fa-comments"></i> ${data.comments_count} Comments</a></li>
            </ul>
        </div>
        <div class="author-one">
            <div class="author-one__image">
                ${data.user.user_pfp ? 
                    `<img src="/uploads/user_profile_pictures/${data.user.user_pfp}" alt="Profile Image" width="200px" height="200px">` :
                    `<img src="/assets/images/default/user-default-picture.png" alt="Default Profile Image" width="200px" height="200px">`
                }
            </div>
            <div class="author-one__content">
                <h3>${data.user.first_name} ${data.user.last_name}</h3>
                <a href="${data.profileLink}">View Profile</a>
            </div>
        </div>
    `;
            $('#postDetails').html(postHtml); // Inject the HTML content
            bindEditPostButtons();
            bindDeletePostButtons();
        }






        function renderComments(postId, comments) { // Ensure postId is passed to this function
            let commentsHtml = '<h3 class="comment-one__title">' + comments.length + ' Comments</h3>';
            comments.forEach(comment => {
                let isCommentOwner = comment.user.id === userId;
                let likeButtonClass = comment.user_has_liked ? 'fas' : 'far';
                commentsHtml += `
        <div class="comment-one__single">
            <div class="comment-one__image">
                ${comment.user.user_pfp ? 
                    `<img src="/uploads/user_profile_pictures/${comment.user.user_pfp}" alt="Profile Image" width="200px" height="200px">` :
                    `<img src="/assets/images/default/user-default-picture.png" alt="Default Profile Image" width="200px" height="200px">`
                }
            </div>
            <div class="comment-one__content">
                <h3>${comment.user.first_name} ${comment.user.last_name}</h3>
                <p>${comment.content}</p>
                <br>
                <ul class="list-unstyled blog-one__meta">
                    <li>
                        <a href="#" class="like-comment-btn" data-post-id="${postId}" data-comment-id="${comment.id}">
                            <i class="${likeButtonClass} fa-thumbs-up"></i> 
                            <span class="comment-likes-count">${comment.likes_count}</span> Likes
                        </a>
                    </li>
                </ul>
                ${isCommentOwner ? `
                <div class="dropdown">
                    <button class="thm-btn comment-one__btn" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        &middot;&middot;&middot;
                    </button>
                    <div class="dropdown-menu dropdown-menu-right">
                        <button class="dropdown-item edit-comment" data-id="${comment.id}" data-content="${comment.content}">Edit comment</button>
                        <button class="dropdown-item text-danger delete-comment" data-id="${comment.id}">Delete comment</button>
                    </div>
                </div>` : ''}
            </div>
        </div>
        `;
            });
            $('#commentsSection').html(commentsHtml);
            bindEditCommentButtons();
            bindDeleteCommentButtons();
            bindLikeCommentButtons(); // Ensure this function binds events correctly with postId included
        }



        function fetchRecentPosts() {
            $.ajax({
                url: '{{ route('blog.fetch.recent') }}',
                type: 'GET',
                success: function(posts) {
                    let postsHtml = '';
                    posts.forEach(post => {
                        postsHtml += `
                        <li>
                            <div class="sidebar__post-image">
                                <img src="${post.image ? '/uploads/post_images/' + post.image : ''}" alt="${post.title}" width="100px" height="60px" style="display: ${post.image ? 'block' : 'none'}">
                            </div>
                            <div class="sidebar__post-content">
                                <h3><a href="/blog/details/${post.id}">${post.title}</a></h3>
                            </div>
                        </li>
                        `;
                    });
                    $('#recentPosts').html(postsHtml);
                },
                error: function(error) {
                    console.log('Error fetching recent posts:', error);
                    $('#recentPosts').html('<li>Error loading recent posts.</li>');
                }
            });
        }

        function bindEditPostButtons() {
            $('.edit-post').off('click').on('click', function() {
                let postId = $(this).data('id');
                let postTitle = $(this).data('title');
                let postContent = $(this).data('content');
                let postImage = $(this).data(
                    'image'); // Make sure to add this data attribute in your HTML

                $('#editPostModal').find('#editPostId').val(postId);
                $('#editPostModal').find('#editPostTitle').val(postTitle);
                $('#editPostModal').find('#editPostContent').val(postContent);

                // Handle image display in modal
                if (postImage) {
                    $('#editPostModal').find('#currentImageDisplay').text('Current image: ' + postImage
                        .split('/').pop());
                    $('#editPostModal').find('#removeImage').prop('checked', false);
                } else {
                    $('#editPostModal').find('#currentImageDisplay').text('No current image.');
                }

                $('#editPostModal').modal('show');
            });

            $('#editPostForm').off('submit').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                formData.set('removeImage', $('#removeImage').is(':checked') ? 'true' : 'false');
                formData.append('postId', $('#editPostId')
                    .val()); // Ensure postId is included if not already in FormData

                $.ajax({
                    url: '/blog/post/' + formData.get('postId') + '/update',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#editPostModal').modal('hide');
                        fetchPostDetails(formData.get(
                            'postId'));
                        fetchRecentPosts(); // Refresh the post details
                        $('#postMessageBox').text('Post updated successfully!').css('color',
                            'green').show();
                        setTimeout(function() {
                            $('#postMessageBox')
                                .hide(); // Optionally hide the message box
                        }, 5000); // Message displayed for 5 seconds
                    },
                    error: function(error) {
                        console.error('Error updating post:', error);
                        $('#postMessageBox').text('Error updating post. Please try again.')
                            .css('color', 'red').show();
                    }
                });
            });
        }



        function bindDeletePostButtons() {
            $('.delete-post').off('click').on('click', function() {
                let postId = $(this).data('id');
                $.ajax({
                    url: '/blog/post/' + postId + '/delete',
                    type: 'DELETE',
                    success: function(response) {
                        $('#postMessageBox').text('Post deleted successfully.').css({
                            'color': 'green',
                            'display': 'block'
                        });
                        setTimeout(function() {
                            // Check the referrer URL for specific paths
                            if (document.referrer.includes('/blog')) {
                                window.location.href =
                                    '{{ route('blog') }}'; // Redirect to the blog
                            } else if (document.referrer.match(
                                    /\/user\/profile\/\d+/)) {
                                // This regex checks if the referrer URL follows the pattern of a user profile with an ID
                                window.location.href = document
                                    .referrer; // Go back to the specific user profile
                            } else {
                                window.location.href =
                                    '/'; // Default redirection if referrer is not identified
                            }
                        }, 2000);
                    },
                    error: function(error) {
                        console.error('Error deleting post:', error);
                        $('#postMessageBox').text('Error deleting post. Please try again.')
                            .css({
                                'color': 'red',
                                'display': 'block'
                            });
                    }
                });
            });
        }


        function bindEditCommentButtons() {
            $('.edit-comment').off('click').on('click', function() {
                let commentId = $(this).data('id');
                let commentContent = $(this).data('content');

                $('#editCommentModal').find('#editCommentId').val(commentId);
                $('#editCommentModal').find('#editCommentContent').val(commentContent);

                $('#editCommentModal').modal('show');
            });

            $('#editCommentForm').off('submit').on('submit', function(e) {
                e.preventDefault();
                let formData = new FormData(this);

                $.ajax({
                    url: '/blog/comment/' + formData.get('commentId') + '/update',
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('#editCommentModal').modal('hide');
                        fetchPostDetails(postId); // Refresh the comments
                    },
                    error: function(error) {
                        console.error('Error updating comment:', error);
                    }
                });
            });
        }

        function bindDeleteCommentButtons() {
            $('.delete-comment').off('click').on('click', function() {
                let commentId = $(this).data('id');
                $.ajax({
                    url: '/blog/comment/' + commentId + '/delete',
                    type: 'DELETE',
                    success: function(response) {
                        $('#messageBox').text('Comment deleted successfully.').css({
                            'color': 'red',
                            'display': 'block'
                        });
                        fetchPostDetails(postId);
                        setTimeout(function() {
                            $('#messageBox')
                                .hide(); // Optionally hide the message box 
                        }, 2000); // Delay the redirect by 2 seconds
                    },
                    error: function(error) {
                        console.error('Error deleting comment:', error);
                    }
                });
            });
        }

        function bindLikeButton() {
            $('.like-btn').off('click').on('click', function(event) {
                event.preventDefault(); // Prevent default anchor click behavior
                const postId = $(this).data('post-id');
                const $icon = $(this).find('i');
                const $likesCount = $(this).find('.likes-count');

                $.ajax({
                    url: `/blog/${postId}/like`,
                    type: 'POST',
                    success: function(response) {
                        $likesCount.text(response.likes_count); // Update the likes count
                        $icon.removeClass('fas far fa-thumbs-up').addClass(response
                            .user_has_liked ? 'fas fa-thumbs-up' : 'far fa-thumbs-up');
                        console.log(response);
                    },
                    error: function(response) {
                        console.error('Error liking post:', response.responseText);
                    }
                });
            });
        }



        function bindLikeCommentButtons() {
            $('.like-comment-btn').off('click').on('click', function(event) {
                event.preventDefault();
                const postId = $(this).data(
                    'post-id'); // Make sure this data attribute is set correctly
                const commentId = $(this).data('comment-id');
                const $icon = $(this).find('i');
                const $likesCount = $(this).find(
                    '.comment-likes-count'); // This targets the span containing the count

                $.ajax({
                    url: `/blog/${postId}/comments/${commentId}/like`,
                    type: 'POST',
                    success: function(response) {
                        // Update the number only, without adding the word 'Likes' again
                        $likesCount.text(response
                            .likesCount); // Only update the numeric count
                        $icon.toggleClass(
                            'fas far'); // Toggle the icon class to show like/unlike
                        $icon.toggleClass('liked', response
                            .userHasLiked
                        ); // Optionally toggle a 'liked' class for visual feedback
                    },
                    error: function(response) {
                        console.error('Error liking comment:', response.responseText);
                    }
                });
            });
        }





    });
</script>
