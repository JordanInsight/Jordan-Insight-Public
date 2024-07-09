{{-- register.blade.php --}}
@extends('layout.base')

@section('title', 'Register')


<head>
    <link rel="stylesheet" href="{{ asset('assets/css/Log In.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <style>
        main {
            background: url({{ asset('assets/images/default/p1.jpg') }}) no-repeat;
        }

        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 5px;
            margin-bottom: 5px;
        }
    </style>
</head>
@section('content')
    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-6 col-lg-4">
                <div class="wrapper">
                    <form id="signupForm" action="{{ route('register') }}" method="POST">
                        @csrf
                        <h1><a href="{{ route('base') }}"><img src="{{ asset('assets/images/logo-dark.png') }}"
                                    alt="Jordan Insight Home" width="200px"></a></h1><br>
                        <h1>Sign Up</h1>

                        <div class="input-box">
                            <input type="text" placeholder="First Name" id="first_name" name="first_name"
                                value="{{ old('first_name') }}" required>
                            <i class='bx bxs-user'></i>
                            @error('first_name')
                                <span class="error-message">{{ $message }}</span>
                                @php $displayError = true; @endphp
                            @enderror
                        </div>

                        <div class="input-box">
                            <input type="text" placeholder="Last Name" id="last_name" name="last_name"
                                value="{{ old('last_name') }}" required>
                            <i class='bx bxs-user-detail'></i>
                            @if (empty($displayError))
                                @error('last_name')
                                    <span class="error-message">{{ $message }}</span>
                                    @php $displayError = true; @endphp
                                @enderror
                            @endif
                        </div>

                        <div class="input-box">
                            <input type="email" placeholder="Email" id="email" name="email"
                                value="{{ old('email') }}" required>
                            <i class='bx bxs-envelope'></i>
                            @if (empty($displayError))
                                @error('email')
                                    <span class="error-message">{{ $message }}</span>
                                    @php $displayError = true; @endphp
                                @enderror
                            @endif
                        </div>

                        <div class="input-box">
                            <input type="password" placeholder="Password" id="password" name="password" required>
                            
                            <i class='bx bx-show' onclick="togglePasswordVisibility('password', this)"></i>
                            @if (empty($displayError))
                                @error('password')
                                    <span class="error-message">{{ $message }}</span>
                                    @php $displayError = true; @endphp
                                @enderror
                            @endif
                        </div>

                        <div class="input-box">
                            <input type="password" placeholder="Confirm Password" id="confirm_password"
                                name="password_confirmation" required>
                            
                            <i class='bx bx-show' onclick="togglePasswordVisibility('confirm_password', this)"></i>
                            @if (empty($displayError))
                                @error('password_confirmation')
                                    <span class="error-message">{{ $message }}</span>
                                    @endphp
                                @enderror
                            @endif
                        </div>


                        <button type="submit" class="btn">Sign up</button>
                        <div class="register-link">
                            <p>Already have an account? <a href="{{ route('login') }}">Login Here</a></p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('ajax_scripts')
    <script src="{{ asset('assets/js/form-validation.js') }}"></script>
@endsection

<script>
    function goToLoginForm() {
        window.location.href = "{{ route('login') }}";
    }

    function togglePasswordVisibility(fieldId, toggleIcon) {
        var passwordField = document.getElementById(fieldId);
        var type = passwordField.type === 'password' ? 'text' : 'password';
        passwordField.type = type;

        // Toggle the icon class
        toggleIcon.classList.toggle('bx-show');
        toggleIcon.classList.toggle('bx-hide');
    }
</script>
