@extends('layout.adminbase')

@section('content')
    <!-- partial:partials/_sidebar.html -->
    @include('partials._sidebar')
    <!-- partial -->

    <div class="page-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('partials._navbar')
        <!-- partial -->
        <div class="page-content">
            <div class="container-xl px-4 mt-4">
                <nav class="nav nav-borders">
                    <a class="nav-link active" href="#">Overview</a>
                </nav>
                <hr class="mt-0 mb-4">
                <div class="message-box" style="display:none;"></div>
                <div class="row">
                    <div class="col-xl-4">
                        <div class="card mb-4">
                            <div class="card-header">Profile Picture</div>
                            <div class="card-body text-center">
                                <h3 class="username">{{ $user->first_name }} {{ $user->last_name }}</h3>
                                <h4 class="admin">Admin</h4>
                                <br>
                                <img class="img-account-profile rounded-circle mb-2"
                                    src="{{ $user->user_pfp ? asset('uploads/user_profile_pictures/' . $user->user_pfp) : asset('assets/images/default/user-default-picture.png') }}"
                                    alt="Profile Picture">

                                <br>
                                <!-- Hidden file input for triggering via the button -->
                                <input type="file" id="profileImageInput" style="display: none;" name="profilePic">

                                <!-- Button triggers the hidden file input -->
                                <button class="btn btn-primary" id="uploadImageButton" type="button">Upload new
                                    image</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <div class="card mb-4">
                            <div class="card-header">Account Details</div>
                            <div class="card-body">
                                <form id="detailsUpdate" method="POST" action="/admin/profile/{{ $user->id }}/update"
                                    enctype="multipart/form-data">

                                    @csrf
                                    <div class="row gx-3 mb-3">
                                        <div class="col-md-6">
                                            <input class="form-control" name="first_name" type="text"
                                                placeholder="First name" value="{{ $user->first_name }}">
                                        </div>
                                        <div class="col-md-6">
                                            <input class="form-control" name="last_name" type="text"
                                                placeholder="Last name" value="{{ $user->last_name }}">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <input class="form-control" name="email" type="email"
                                            placeholder="Email address" value="{{ $user->email }}">
                                    </div>
                                    <button class="btn btn-primary" type="submit">Save changes</button>
                                </form>
                                <br>
                                <br>
                                <button class="btn btn-secondary change-password change-password-admin-btn">
                                    <i class="fa fa-key"></i>
                                    <span>Change Password</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Change Password Model -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog"
        aria-labelledby="changePasswordModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="changePasswordForm" action="{{ route('user.profile.update.password', ['user' => Auth::id()]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-header">
                        <h5 style="font-family: inherit;" class="modal-title" id="profilePicModalLabel">Chane
                            Password </h5>
                    </div>
                    <div class="modal-body">
                        <div class="column gx-3 mb-3">
                            <div class="col-md-6">
                                <input class="form-control" name="recent_password" type="password"
                                    placeholder="Recent Password">
                            </div>
                            <br>
                            <div class="col-md-6">
                                <input class="form-control" name="new_password" type="password" placeholder="New Password">
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
                        <button type="button" class="btn btn-secondary change-password close"
                            data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Change Password</button>
                    </div>
                    <br>
                </form>
                <div id="messageBox" class="messageBox" style="display: none; color: red; font-size: 16px; padding: 10px;">
                </div>
            </div>
        </div>
    </div>


    <script type="text/javascript">
        $(document).ready(function() {
            // CSRF Token setup for AJAX
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


            $('.change-password-admin-btn').on('click', function() {
                $('#changePasswordModal').modal('show');
            });

            $('.close').click(function() {
                $('#changePasswordModal').modal('hide');
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
                        $('#messageBox').text(response.message).css('color', 'green').show();
                        setTimeout(function() {
                            $('#messageBox')
                                .hide(); // Hide the message box after displaying the message
                            window.location.reload();
                        }, 3000); // Adjust the delay as needed
                    },
                    error: function(jqXHR) {
                        var message = 'Failed to change password.'; // Default error message
                        if (jqXHR.responseText) {
                            try {
                                var responseJson = JSON.parse(jqXHR.responseText);
                                // Use the main error message or the first error detail available
                                if (responseJson.errors) {
                                    var firstErrorKey = Object.keys(responseJson.errors)[0];
                                    message = responseJson.errors[firstErrorKey][
                                        0
                                    ]; // Show only the first error message
                                } else {
                                    message = responseJson.message ||
                                        message; // Use the server's message if available
                                }
                            } catch (e) {
                                console.error('Error parsing JSON!', e);
                            }
                        }
                        $('#messageBox').text(message).css('color', 'red').show();
                        setTimeout(function() {
                            $('#messageBox')
                                .hide(); // Hide the message box after displaying the message
                        }, 5000); // Message box hides after 5 seconds
                    }
                });
            });


            var initialFormData = $('#detailsUpdate').serialize();
            // Form Submission with AJAX
            $('#detailsUpdate').on('submit', function(e) {
                e.preventDefault(); // Prevent the default form submission
                var currentFormData = $(this).serialize();
                if (currentFormData === initialFormData) {
                    showMessage('No changes detected', 'message-info');
                    return; // Exit the function if the form data hasn't changed
                }
                let formData = new FormData(this);

                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        $('.message-box').text(response.message).addClass('message-success')
                            .show();
                        setTimeout(function() {
                            window.location
                                .reload(); // Reload the page to reflect updated data
                        }, 1000);
                    },
                    error: function(jqXHR) {
                        var errorResponse = JSON.parse(jqXHR.responseText);
                        $('.message-box').text(errorResponse.message).addClass('message-error')
                            .show();
                    }
                });
            });

            function showMessage(text, className) {
                $('.message-box').text(text).removeClass('message-success message-error message-info').addClass(
                    className).show();
                setTimeout(function() {
                    $('.message-box').fadeOut('slow');
                }, 1000); // Message will fade out after 2 seconds
            }

            // Trigger file input when button is clicked
            $('#uploadImageButton').click(function() {
                $('#profileImageInput').click();
            });

            // Handle file selection and form submission
            $('#profileImageInput').change(function() {
                if ($(this)[0].files.length > 0) { // Make sure a file was selected
                    var formData = new FormData();
                    formData.append('profilePic', $(this)[0].files[0]);

                    $.ajax({
                        url: "{{ route('admin.profile.upload-image', $user) }}",
                        type: 'POST',
                        data: formData,
                        contentType: false,
                        processData: false,
                        success: function(response) {
                            $('.message-box').text(response.message).addClass('message-success')
                                .show();
                            setTimeout(function() {
                                window.location
                                    .reload(); // Reload the page to reflect updated data
                            }, 1000);
                        },
                        error: function(jqXHR) {
                            var errorResponse = JSON.parse(jqXHR.responseText);
                            $('.message-box').text(errorResponse.message).addClass(
                                'message-error').show();
                        }
                    });
                }
            });
        });
    </script>
@endsection
