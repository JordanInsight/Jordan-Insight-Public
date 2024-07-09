@extends('layout.base')

@section('title', 'Blog')

@section('content')
    <div class="preloader">
        <img src="assets/images/loader.png" class="preloader__image" alt="">
    </div>
    <div class="page-wrapper">
        <section class="page-header"
            style="background-image: url({{ asset('assets/images/backgrounds/blogWallpaper.png') }}) ;
                   background-size: cover;
                   background-position:center;">
            <div class="container">
                <h2>Blog List</h2>
                <ul class="thm-breadcrumb list-unstyled">
                    <li><a href="{{ route('base') }}">Home</a></li>
                    <li><span>Blog</span></li>
                </ul>
            </div>
        </section>
        <section class="blog-list">
            <div class="container">
                @if (Auth::check())
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
                                        <button type="button" class="btn-link" title data-toggle="tooltip"
                                            data-original-title="Post an Question">
                                        </button>
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
                <div class="row">
                    <div class="col-lg-8 posts-container" id="posts-container">
                        <!-- Posts will be fetched and inserted here by AJAX -->
                    </div>
                    <div class="col-lg-4">
                        <div class="sidebar">
                            <div class="sidebar__single sidebar__search">
                                <form id="search-form" class="sidebar__search-form">
                                    @csrf
                                    <input type="search" id="search-input" placeholder="Search">
                                    <button type="submit"><i class="tripo-icon-magnifying-glass"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Pagination container -->
                    <div class="post-pagination" id="pagination-container"></div>
                </div>
            </div>
        </section>
    </div>
    <a href="#" data-target="html" class="scroll-to-target scroll-to-top"><i class="fa fa-angle-up"></i></a>
@endsection




<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Fetch initial posts
        fetchPosts("{{ route('blog.fetch') }}");

        // Handle search form submission
        $('#search-form').on('submit', function(e) {
            e.preventDefault();
            var query = $('#search-input').val();
            fetchPosts("{{ route('post.search') }}?query=" + query);
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
            var $submitButton = $('#postForm button[type="submit"]');
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('blog.post.store') }}",
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    $('#messageBox').text('Post added successfully!').css('color', 'green')
                        .show();
                    $('#postForm textarea[name="content"]').val('');
                    $('#postForm input[name="title"]').val('');
                    $('#postForm input[name="image"]').val('');
                    fetchPosts("{{ route('blog.fetch') }}");
                    setTimeout(function() {
                        $submitButton.prop('disabled', false);
                        $('#messageBox').hide();
                    }, 5000);
                },
                error: function(xhr, status, error) {
                    console.error('Error adding post:', error);
                    $('#messageBox').text('Failed to add post: ' + xhr.responseText).css(
                        'color', 'red').show();
                    setTimeout(function() {
                        $('#messageBox').hide();
                    }, 5000);
                }
            });
        });

        // Fetch posts function
        function fetchPosts(pageUrl) {
            $.ajax({
                url: pageUrl,
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    if (response.posts.length === 0) {
                        $('#posts-container').html(
                            '<p>No posts yet</p>'); // Display no posts message
                        $('#pagination-container').html(''); // Clear pagination
                    } else {
                        renderPosts(response.posts);
                        renderPagination(response.currentPage, response.lastPage, response
                            .previousPageUrl, response.nextPageUrl);
                    }

                },
                error: function(xhr, status, error) {
                    console.error('Error fetching posts:', error);

                }
            });
        }

        // Function to render posts dynamically
        function renderPosts(posts) {
            var postsHtml = '';
            posts.forEach(function(post) {
                postsHtml += generatePostHtml(post);
            });
            $('#posts-container').html(postsHtml);
        }

        // Function to generate HTML for a single post
        function generatePostHtml(post) {
            return `
            <div class="blog-two__single blog-one__single">
                <div class="row">
                    <div class="col-md-6">
                        <div class="blog-one__image">
                            ${post.image ? `<img src="/uploads/post_images/${post.image}" alt="Image for ${post.title}">` : `<img src="{{ asset('assets/images/default/post-default.webp') }}" alt="Default Image">`}
                            <a href="/blog/details/${post.id}" class="image-overlay-link"><i class="fa fa-long-arrow-alt-right"></i></a>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex">
                        <div class="blog-two__content my-auto">
                            <ul class="list-unstyled blog-one__meta">
                                <li><a href="#"><i class="far fa-user-circle"></i> ${post.user.first_name} ${post.user.last_name}</a></li>
                                <li><a href="/blog/details/${post.id}"><i class="far fa-thumbs-up"></i> ${post.likes_count} Likes</a></li>
                                <li><a href="/blog/details/${post.id}"><i class="far fa-comments"></i> ${post.comments_count} Comments</a></li>
                            </ul>
                            <h3><a href="/blog/details/${post.id}">${post.title}</a></h3>
                            <p>${post.content}</p>
                            <a href="/blog/details/${post.id}" class="blog-two__link">Read More</a>
                        </div>
                    </div>
                </div>
            </div>`;
        }

        // Function to render pagination dynamically
        function renderPagination(currentPage, lastPage, previousPageUrl, nextPageUrl) {
            var paginationHtml = '';
            if (previousPageUrl) {
                paginationHtml += `<a href="${previousPageUrl}"><i class="fa fa-angle-left"></i></a>`;
            }
            for (let i = 1; i <= lastPage; i++) {
                paginationHtml +=
                    `<a class="${i === currentPage ? 'active' : ''}" href="/blog/fetch?page=${i}">${i}</a>`;
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
