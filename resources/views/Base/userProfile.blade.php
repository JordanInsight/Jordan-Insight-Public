{{-- userProfile.blade.php --}}
@extends('layout.base')

@section('title', "User Profile - $userName")


@section('content')

    <div class="page-wrapper">

    </div>

    <section class="blog-one blog-one__grid">
        <div class="container">
            <div class="user">
                <div class="panel profile-cover">
                    <div class="profile-cover__img">
                        <img src="{{ $user->user_pfp ? asset('uploads/user_profile_pictures/' . $user->user_pfp) : asset('assets/images/default/user-default-picture.png') }}"
                            alt="{{ $user->first_name }} {{ $user->last_name }}" />
                        <h3 class="h3">{{ $user->first_name }} {{ $user->last_name }}</h3>
                    </div>
                    <div class="profile-cover__action bg--img" data-overlay="0.3">
                        @if (Auth::check() && $user->id === Auth::user()->id)
                            <button class="btn btn-rounded btn-info upload-profile-pic">
                                <i class="fa fa-camera"></i>
                                <span>Upload Profile Picture</span>
                            </button>
                            <button class="btn btn-rounded btn-info settings-button">
                                <i class="fa fa-gear"></i>
                                <span>Edit Profile</span>
                            </button>
                        @endif
                    </div>
                    <div class="profile-cover__info">
                        <ul class="nav">
                            <li><strong>{{ $postCount }}</strong>Posts</li>
                            <li><strong>{{ $commentsCount }}</strong>Comments</li>
                        </ul>
                    </div>
                </div>
                {{-- Only show the posting form if the logged-in user is viewing their own profile --}}
                @if (Auth::check() && $user->id === Auth::id())
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">What's on your mind, {{ $user->first_name }}?</h3>
                        </div>
                        <div class="panel-content panel-activity">
                            <form id="postForm" method="POST"
                                action="{{ route('user.profile.post', ['user' => Auth::id()]) }}"
                                class="panel-activity__status" enctype="multipart/form-data">
                                @csrf
                                <input type="text" id="title" name="title" required class="form-control"
                                    placeholder="Title">
                                <br>
                                <textarea id="content" name="content" required class="form-control" placeholder="Share what you've been up to..."></textarea>
                                <div class="actions">
                                    <div class="btn-group">
                                        <label for="image" class="custom-file-upload">Choose File</label>
                                        <input type="file" id="image" name="image" class="form-control">
                                        <span id="file-name"></span>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-rounded btn-info">
                                        Post
                                    </button>
                                </div>
                            </form>
                            <div id="messageBox" class="messageBox"
                                style="display: none; color: red; font-size: 16px; padding: 10px;"></div>
                        </div>
                    </div>
                @endif


            </div>

            <div class="row posts-container">
                <!-- Posts will be loaded here via AJAX -->
            </div>



            <div class="post-pagination" id="pagination-container">
                <!-- Pagination links will be dynamically inserted here -->
            </div>


            <!-- Profile Picture Modal -->
            <div class="modal fade" id="profilePicModal" tabindex="-1" role="dialog"
                aria-labelledby="profilePicModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="profilePicForm" action="{{ route('user.profile.picture', ['user' => Auth::id()]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 style="font-family: inherit;" class="modal-title" id="profilePicModalLabel">Upload
                                    Profile Picture</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="profilePic" class="custom-file-upload">Choose Image</label>
                                    <input type="file" id="profilePic" class="form-control" name="profilePic"
                                        accept="image/*">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-rounded btn-secondary"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-rounded btn-info">Upload</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <!-- Edit Profile Model -->
            <div class="modal fade" id="profileEditModal" tabindex="-1" role="dialog"
                aria-labelledby="profileEditModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="profileEditForm" action="{{ route('user.profile.update', ['user' => Auth::id()]) }}"
                            method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 style="font-family: inherit;" class="modal-title" id="profilePicModalLabel">Update
                                    Your Profile</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="row justify-content-center align-items-centergx-3 mb-3">
                                    <div class="col-md-6">
                                        <input class="form-control" name="first_name" type="text"
                                            placeholder="First name" value="{{ $userInId->first_name }}">
                                    </div>
                                    <div class="col-md-6">
                                        <input class="form-control" name="last_name" type="text"
                                            placeholder="Last name" value="{{ $userInId->last_name }}">
                                    </div>
                                </div>
                                <div class="mb-3">
                                    <input class="form-control" name="email" type="email"
                                        placeholder="Email address" value="{{ $userInId->email }}">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-rounded btn-secondary"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-rounded btn-info">Update</button>
                            </div>

                            <div class="change-password-btn">
                                <button class="btn btn-rounded btn-info ">
                                    <i class="fa fa-key"></i>
                                    <span>Change Password</span>
                                </button>
                            </div>

                        </form>


                    </div>
                </div>
            </div>


            <!-- Change Password Model -->
            <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog"
                aria-labelledby="changePasswordModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form id="changePasswordForm"
                            action="{{ route('user.profile.update.password', ['user' => Auth::id()]) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="modal-header">
                                <h5 style="font-family: inherit;" class="modal-title" id="profilePicModalLabel">Chane
                                    Password </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="column gx-3 mb-3">
                                    <div class="col-md-6">
                                        <input class="form-control" name="recent_password" type="password"
                                            placeholder="Recent Password">
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <input class="form-control" name="new_password" type="password"
                                            placeholder="New Password">
                                    </div>
                                    <br>
                                    <div class="col-md-6">
                                        <input class="form-control" name="new_password_confirmation" type="password"
                                            placeholder="Confirm New Password">
                                    </div>
                                    <br>
                                </div>
                                <a href="{{ route('forgotPasswordForm') }}">Forgot Password ?</a>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-rounded btn-secondary"
                                    data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-rounded btn-info">Change Password</button>
                            </div>
                            <br>

                        </form>

                        <div class="error-message"></div>
                    </div>
                </div>
            </div>


        </div><!-- /.container -->
    </section><!-- /.blog-one -->

    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>


@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.upload-profile-pic').on('click', function() {
            $('#profilePicModal').modal('show');
        });

        $('.settings-button').on('click', function() {
            $('#profileEditModal').modal('show');
        });

        $('.change-password-btn').on('click', function() {
            event.preventDefault();
            $('#profileEditModal').modal('hide');
            $('#changePasswordModal').modal('show');
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
                    $('.error-message').text(response.message).css('color', 'green');
                    setTimeout(function() {
                        window.location.reload();
                    }, 100); // Adjust the delay as needed
                },
                error: function(jqXHR) {
                    console.error('Failed:', jqXHR.responseText);
                    $('.error-message').text('Failed to upload Image.').css('color', 'red');
                    // Handle error
                }
            });
        });

        $('#profileEditForm').on('submit', function(e) {
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
                    console.log('Profile Updated:', response.message);
                    $('.Image-message').text(response.message).css('color', 'green');
                    setTimeout(function() {
                        window.location.reload();
                    }, 100); // Adjust the delay as needed
                },
                error: function(jqXHR) {
                    console.error('Failed:', jqXHR.responseText);
                    $('.Image-message').text('Failed to Update Profile.').css('color',
                        'red');
                    // Handle error
                }
            });
        });

        $('#changePasswordForm').on('submit', function(e) {
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
                    console.log('Password Updated Successfully:', response.message);
                    $('.Image-message').text(response.message).css('color', 'green');
                    setTimeout(function() {
                        window.location.reload();
                    }, 100); // Adjust the delay as needed
                },
                error: function(jqXHR) {
                    console.error('Failed:', jqXHR.responseText);
                    $('.Image-message').text('Try Again.').css('color',
                        'red');
                    // Handle error
                }
            });
        });

        $('#image').change(function() {
            var fullPath = $(this).val();
            var fileName = fullPath.split('\\').pop();
            var maxLength = 15; // Maximum number of characters to display before truncating

            // Get the file extension
            var fileExtension = fileName.split('.').pop();

            // Truncate the file name if it's too long
            if (fileName.length > maxLength) {
                fileName = fileName.substring(0, maxLength) + '... .' + fileExtension;
            }

            $('#file-name').text(
                fileName); // Updates the text of the span to the file name or the truncated name
        });




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
                    $('#messageBox').text('Post added successfully!').css('color', 'green')
                        .show();
                    $('#postForm textarea[name="content"]').val('');
                    $('#postForm input[name="title"]').val('');
                    $('#postForm input[name="image"]').val('');
                    fetchPosts(
                        "{{ route('user.profile.fetch', ['user' => Auth::id()]) }}");
                    setTimeout(function() {
                        $submitButton.prop('disabled', false);
                        $('#messageBox').hide();
                    }, 5000);
                },
                error: function(jqXHR) {
                    console.error('Error adding post:', error);
                    $('#messageBox').text('Failed to add post: ' + xhr.responseText).css(
                        'color', 'red').show();
                    setTimeout(function() {
                        $('#messageBox').hide();
                    }, 5000);
                }
            });
        });

        // Initial fetch for posts
        fetchPosts("{{ route('user.profile.fetch', ['user' => $profileUserId]) }}");


        // Function to fetch posts using jQuery's ajax method
        function fetchPosts(pageUrl) {
            $.ajax({
                url: pageUrl,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.posts.length === 0) {
                        $('.posts-container').html('<p>No posts available.</p>');
                        $('.post-pagination').html('');
                    } else {
                        renderPosts(response.posts);
                        renderPagination(response.currentPage, response.lastPage, response
                            .previousPageUrl, response.nextPageUrl, response.userId);
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching posts:', error);
                }
            });
        }

        // Function to render posts dynamically
        function renderPosts(posts) {
            let postsHtml = '';
            posts.forEach(function(post) {
                postsHtml += `
            <div class="col-lg-4 col-md-6">
                <div class="blog-one__single">
                    <div class="blog-one__image">
                        ${post.image ? `<img src="/uploads/post_images/${post.image}" alt="Image for ${post.title}">` : `<img src="{{ asset('assets/images/default/post-default.webp') }}" alt="Default Image">`}
                        <a href="/blog/details/${post.id}"><i class="fa fa-long-arrow-alt-right"></i></a>
                    </div>
                    <div class="blog-one__content">
                        <ul class="list-unstyled blog-one__meta">
                            <li><a href="/blog/details/${post.id}"><i class="far fa-thumbs-up"></i> ${post.likes_count} Likes</a></li>
                            <li><a href="/blog/details/${post.id}"><i class="far fa-comments"></i> ${post.comments_count} Comments</a></li>
                        </ul>
                        <h3><a href="/blog/details/${post.id}">${post.title}</a></h3>
                    </div>
                </div>
            </div>
        `;
            });
            $('.posts-container').html(postsHtml);
        }


        // Function to render pagination dynamically
        function renderPagination(currentPage, lastPage, previousPageUrl, nextPageUrl, userId) {
            var paginationHtml = '';
            if (previousPageUrl) {
                paginationHtml += `<a href="${previousPageUrl}"><i class="fa fa-angle-left"></i></a>`;
            }
            for (let i = 1; i <= lastPage; i++) {
                paginationHtml +=
                    `<a class="${i === currentPage ? 'active' : ''}" href="/user/profile/fetch/${userId}?page=${i}">${i}</a>`;
            }
            if (nextPageUrl) {
                paginationHtml += `<a href="${nextPageUrl}"><i class="fa fa-angle-right"></i></a>`;
            }
            $('#pagination-container').html(paginationHtml);
        }

        // Event delegation for pagination links
        $(document).on('click', '.post-pagination a', function(e) {
            e.preventDefault();
            var pageUrl = $(this).attr('href');
            fetchPosts(pageUrl);
            $('html, body').animate({
                scrollTop: $('.posts-container').offset().top
            }, 'slow');
        });


    });
</script>
@section('ajax_scripts')
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
@endsection
