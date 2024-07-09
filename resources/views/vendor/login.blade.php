{{-- admin/login.blade.php --}}
@extends('layout.vendorloginbase')

@section('content')

    <head>
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    </head>
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-6 col-lg-4">
                <!-- Vendor Login Form -->
                <div class="auth-form">
                    <h2 class="text-center">Vendor Login</h2>
                    <form action="{{ route('vendor.login') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="admin-email">Email:</label>
                            <input type="email" class="form-control" id="admin-email" name="email" required>
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="form-group position-relative">
                            <label for="admin-password">Password:</label>
                            <input type="password" class="form-control" id="admin-password" name="password" required>
                            <i class='bx bx-show password-icon' onclick="toggleVendorPasswordVisibility()"
                                style="position: absolute; right: 15px; top: 65%; transform: translateY(-50%); cursor: pointer;"></i>
                            @error('password')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>



                        <div class="form-group">
                            <a href="{{ route('forgotPasswordForm') }}">Forgot Password ?</a>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary btn-block">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        window.toggleVendorPasswordVisibility =
            toggleVendorPasswordVisibility;

        function toggleVendorPasswordVisibility() {
            var passwordInput = document.getElementById('admin-password');
            var passwordIcon = document.querySelector('.password-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.classList.replace('bx-show', 'bx-hide');
            } else {
                passwordInput.type = 'password';
                passwordIcon.classList.replace('bx-hide', 'bx-show');
            }
        }


    });
</script>
