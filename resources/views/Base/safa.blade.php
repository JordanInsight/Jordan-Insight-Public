{{-- userProfile.blade.php --}}
@extends('layout.base')

@section('title', 'User Profile - {{ $user->first_name }} {{ $user->last_name }}')

@section('content')




{{-- sssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssss --}}



    <div id="userProfile" style="max-width: 600px; margin: auto;">
        <div id="userDetails" style="text-align: center; margin-bottom: 20px;">
            <h1>{{ $user->first_name }} {{ $user->last_name }}</h1>
            <img src="{{ asset('uploads/user_profile_pictures/' . $user->user_pfp) }}" alt="Profile Picture"
                style="width: 100px; height: 100px; border-radius: 50%;">

            <form id="profilePicForm" method="POST" action="{{ route('user.profile.picture', ['user' => Auth::id()]) }}"
                enctype="multipart/form-data">
                @csrf
                <label for="profilePicInput">Upload Profile Picture:</label>
                <input type="file" id="profilePicInput" name="profilePic" accept="image/*">
                <button type="submit" class="btn btn-primary">Upload</button>
                <div class="Image-message"></div>
            </form>


        </div>
        <div class="post-create-form">
            <form method="POST" id="postForm" action="{{ route('user.profile.post', ['user' => Auth::id()]) }}"
                enctype="multipart/form-data" class="create-post-form">
                @csrf
                <div class="form-group">
                    <label for="title" class="form-label">Title:</label>
                    <input type="text" id="title" name="title" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="content" class="form-label">Content:</label>
                    <textarea id="content" name="content" required class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" id="image" name="image" class="form-control">
                </div>

                <button type="submit" class="btn btn-primary">Create Post</button>
            </form>
            <div class="message"></div>
        </div>
        <div class="postFetch">
            <!-- Posts will be fetched and inserted here by the Ajax call -->
        </div>
        <!-- Modal -->
        <div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-labelledby="editPostModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editPostModalLabel">Edit Post</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- The form inside the modal -->
                        <form id="editPostForm">
                            <div class="form-group">
                                <label for="postTitle">Title</label>
                                <input type="text" class="form-control" id="postTitle" name="title" required>
                            </div>
                            <div class="form-group">
                                <label for="postContent">Content</label>
                                <textarea class="form-control" id="postContent" name="content" rows="3" required></textarea>
                            </div>
                            <input type="hidden" id="postId" name="id">
                            <!-- Add any other fields you want to be able to edit -->
                            <button type="submit" class="btn btn-primary">Save changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

@endsection

<script type="module">
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });

        FetchPosts();


        $('#postForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);


            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                contentType: false, // This is required for FormData
                processData: false, // Also required for FormData
                dataType: 'json',
                success: function(response) {
                    console.log('Post added:', response.message);
                    $('.message').text(response.message).css('color', 'green');
                    FetchPosts();
                    // Handle success
                },
                error: function(jqXHR) {
                    console.error('Failed:', jqXHR.responseText);
                    $('.message').text('Failed to create post.').css('color', 'red');
                    // Handle error
                }
            });
        });

        $('#profilePicForm').on('submit', function(e) {
            e.preventDefault();
            let formData = new FormData(this);

            $.ajax({
                url: $(this).attr('action'),
                type: 'POST',
                data: formData,
                contentType: false, // This is required for FormData
                processData: false, // Also required for FormData
                dataType: 'json',
                success: function(response) {
                    console.log('Image uploaded:', response.message);
                    $('.Image-message').text(response.message).css('color', 'green');
                    setTimeout(function() {
                        window.location.reload();
                    }, 100); // Adjust the delay as needed
                },
                error: function(jqXHR) {
                    console.error('Failed:', jqXHR.responseText);
                    $('.Image-message').text('Failed to upload Image.').css('color', 'red');
                    // Handle error
                }
            });
        });

        function FetchPosts() {
            $.ajax({
                url: "{{ route('user.profile.fetch', ['user' => Auth::id()]) }}",
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    let html = '';
                    response.posts.forEach(function(post) {
                        let likeButtonClass = post.user_has_liked ? 'btn-danger' :
                            'btn-primary';
                        let likeButtonText = post.user_has_liked ? 'Unlike' : 'Like';
                        // ... Inside your forEach loop for posts
                        html +=
                            `<div class="post" style="position: relative; border: 1px solid #e1e8ed; margin-bottom: 10px; padding: 10px; border-radius: 10px;">` +
                            // The post div with relative positioning
                            `<div class="dropdown" style="position: absolute; top: 10px; right: 10px;">` +
                            // Dropdown div with absolute positioning
                            `<button class="btn btn-default" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="padding: 0; border: none; background: none; font-size: 1em;">` +
                            `&middot;&middot;&middot;` +
                            // Three-dot icon using HTML character entity
                            `</button>` +
                            // Three-dot icon using HTML character entity
                            `</button>` +
                            `<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton-${post.id}">` +
                            // Bootstrap class for aligning the dropdown to the right
                            `<a class="dropdown-item edit-post" href="#" data-id="${post.id}" data-title="${post.title}" data-content="${post.content}">Edit post</a>` +
                            `<a class="dropdown-item text-danger" href="#">Delete post</a>` +
                            `</div>` +
                            `</div>` +
                            `<h2 style="margin: 0;">${post.title}</h2>` +
                            `<p style="color: #555;">${post.content}</p>` +
                            `<small>${post.post_date}</small>`;
                        if (post.image) {
                            html +=
                                `<img src="${window.location.origin}/uploads/post_images/${post.image}" alt="Post image" style="max-width: 100%; border-radius: 10px; margin-top: 10px;">`;
                        }
                        html +=
                            `<button class="like-btn btn ${likeButtonClass}" data-post-id="${post.id}">${likeButtonText}</button>` +
                            `<span class="likes-count">${post.likes_count} Likes</span>`; // Close the post div

                        // Add existing comments to the post
                        html += `<div; class="comments-section">`;
                        if (post.comments && post.comments.length > 0) {
                            post.comments.forEach(function(comment) {
                                let commentLikeButtonClass = comment
                                    .user_has_liked ? 'btn-danger' : 'btn-primary';
                                let commentLikeButtonText = comment.user_has_liked ?
                                    'Unlike' : 'Like';
                                html +=
                                    `<div class="comment" style="border-top: 1px solid #ddd; padding: 10px;">` +
                                    `<p><strong>${comment.user_name}</strong> <small>${comment.created_at_formatted}</small></p>` +
                                    `<p>${comment.content}</p>` +
                                    `<button class="like-comment-btn ${commentLikeButtonClass}" data-comment-id="${comment.id}">${commentLikeButtonText}</button>` +
                                    `<span class="comment-likes-count">${comment.likes_count} Likes</span>` +
                                    `</div>`;
                            });
                        } else {
                            html += `<p>This post has no comments</p>`;
                        }
                        html +=
                            `<form class="comment-form" data-post-id="${post.id}">` +
                            `<div class="form-group">` +
                            `<textarea name="comment" class="form-control comment-input" placeholder="Write a comment..."></textarea>` +
                            `</div>` +
                            `<button type="submit" class="btn btn-secondary comment-btn">Submit Comment</button>` +
                            `</form>`;
                        html += `</div> </div>`
                    });
                    $('.postFetch').html(html);
                    bindLikeButtons(); // Bind like button click events after the HTML is generated
                    bindCommentForms();
                    bindCommentLikeButtons();
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                }
            });
        }

        function bindLikeButtons() {
            $('.like-btn').off('click').on('click', function() {
                let postId = $(this).data('post-id');
                $.ajax({
                    url: '/user/profile/' + postId + '/like',
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content")
                    },
                    success: function(response) {
                        let button = $('button[data-post-id="' + postId + '"]');
                        button.next('.likes-count').text(response.likesCount);
                        button.text(response.userHasLiked ? 'Unlike' : 'Like');
                        button.toggleClass('btn-primary btn-danger');
                    },
                    error: function(jqXHR) {
                        console.error('Failed to like:', jqXHR.responseText);
                    }
                });
            });
        }

        function bindCommentForms() {
            $('.comment-form').off('submit').on('submit', function(e) {
                e.preventDefault();
                let postId = $(this).data('post-id');
                let commentInput = $(this).find('.comment-input').val();

                $.ajax({
                    url: '/post/' + postId +
                        '/comment', // The URL where your backend handles comments
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                        comment: commentInput
                    },
                    success: function(response) {
                        FetchPosts();
                    },
                    error: function(jqXHR) {
                        console.error('Failed to submit comment:', jqXHR.responseText);

                    }
                });
            });
        }

        function bindCommentLikeButtons() {
            $('.like-comment-btn').off('click').on('click', function() {
                let commentId = $(this).data('comment-id');
                let button = $(this); // Store the button reference

                $.ajax({
                    url: `/comment/${commentId}/like`,
                    type: 'POST',
                    data: {
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },
                    success: function(response) {
                        button.toggleClass('btn-primary btn-danger');
                        button.siblings('.comment-likes-count').text(
                            `${response.likesCount} Likes`);
                        button.text(response.userHasLiked ? 'Unlike' : 'Like');
                    },
                    error: function(jqXHR) {
                        console.error('Failed to like comment:', jqXHR.responseText);
                        // Optionally handle the error
                    }
                });
            });
        }


    });
</script>
