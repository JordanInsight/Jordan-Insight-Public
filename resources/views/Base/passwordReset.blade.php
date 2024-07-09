{{-- register.blade.php --}}
@extends('layout.base')

@section('title', 'Reset Password')

<head>
    <link rel="stylesheet" href="{{ asset('assets/css/Log In.css') }}">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
@section('content')

    <style>
        main {
            background: url({{ asset('assets/images/default/p1.jpg') }}) no-repeat;
        }

        .error-message {
            color: red;
            font-size: 12px;
            margin-top: 10px;
            margin-bottom: 10px;
        }
    </style>


    <div class="container">
        <div class="row justify-content-center align-items-center" style="min-height: 100vh;">
            <div class="col-md-6 col-lg-4">

                <div class="wrapper">
                    <form action="{{ route('resetPassword') }}" method="POST">
                        @csrf
                        <input type="text" name="token" hidden value="{{$token}}">
                        <h1><a href="{{ route('base') }}"><img src="{{ asset('assets/images/logo-dark.png') }}"
                                    alt="Jordan Insight Home" height="" width="200px"></a></h1><br>
                        <h1>Password Reset</h1>
                        <p>Please enter new password</p>
                        <div class="input-box">
                            <input type="password" id="password" name="password" placeholder="Password" required>
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="none">
                                <style>
                                    @keyframes lock {
                                        0% {
                                            transform: translateY(-2px)
                                        }

                                        to {
                                            transform: translateY(0)
                                        }
                                    }
                                </style>
                                <path fill="#fff"
                                    d="M15.236 10.811a.736.736 0 01-.736-.736V8.811a2.5 2.5 0 00-5 0v5H8v-5a4 4 0 018 0v1.236a.764.764 0 01-.764.764z"
                                    style="animation:lock 1s cubic-bezier(1,-.43,0,1.29) both infinite alternate-reverse">
                                </path>
                                <path fill="#fff"
                                    d="M6.6 13.704a3 3 0 013-3h4.8a3 3 0 013 3v3a3 3 0 01-3 3H9.6a3 3 0 01-3-3v-3z">
                                </path>
                                <path fill="#fff"
                                    d="M9.6 11.454h4.8v-1.5H9.6v1.5zm7.05 2.25v3h1.5v-3h-1.5zm-2.25 5.25H9.6v1.5h4.8v-1.5zm-7.05-2.25v-3h-1.5v3h1.5zm2.25 2.25a2.25 2.25 0 01-2.25-2.25h-1.5a3.75 3.75 0 003.75 3.75v-1.5zm7.05-2.25a2.25 2.25 0 01-2.25 2.25v1.5a3.75 3.75 0 003.75-3.75h-1.5zm-2.25-5.25a2.25 2.25 0 012.25 2.25h1.5a3.75 3.75 0 00-3.75-3.75v1.5zm-4.8-1.5a3.75 3.75 0 00-3.75 3.75h1.5a2.25 2.25 0 012.25-2.25v-1.5zm1.543 5.198a.857.857 0 011.714 0v.104a.857.857 0 11-1.714 0v-.104z">
                                </path>
                            </svg>
                            {{-- In your password input section --}}
                            @error('password')
                                {{-- Change this line to handle password errors --}}
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="input-box">
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="none">
                                <style>
                                    @keyframes lock {
                                        0% {
                                            transform: translateY(-2px)
                                        }

                                        to {
                                            transform: translateY(0)
                                        }
                                    }
                                </style>
                                <path fill="#fff"
                                    d="M15.236 10.811a.736.736 0 01-.736-.736V8.811a2.5 2.5 0 00-5 0v5H8v-5a4 4 0 018 0v1.236a.764.764 0 01-.764.764z"
                                    style="animation:lock 1s cubic-bezier(1,-.43,0,1.29) both infinite alternate-reverse">
                                </path>
                                <path fill="#fff"
                                    d="M6.6 13.704a3 3 0 013-3h4.8a3 3 0 013 3v3a3 3 0 01-3 3H9.6a3 3 0 01-3-3v-3z">
                                </path>
                                <path fill="#fff"
                                    d="M9.6 11.454h4.8v-1.5H9.6v1.5zm7.05 2.25v3h1.5v-3h-1.5zm-2.25 5.25H9.6v1.5h4.8v-1.5zm-7.05-2.25v-3h-1.5v3h1.5zm2.25 2.25a2.25 2.25 0 01-2.25-2.25h-1.5a3.75 3.75 0 003.75 3.75v-1.5zm7.05-2.25a2.25 2.25 0 01-2.25 2.25v1.5a3.75 3.75 0 003.75-3.75h-1.5zm-2.25-5.25a2.25 2.25 0 012.25 2.25h1.5a3.75 3.75 0 00-3.75-3.75v1.5zm-4.8-1.5a3.75 3.75 0 00-3.75 3.75h1.5a2.25 2.25 0 012.25-2.25v-1.5zm1.543 5.198a.857.857 0 011.714 0v.104a.857.857 0 11-1.714 0v-.104z">
                                </path>
                            </svg>
                            {{-- In your password input section --}}
                            @error('password')
                                {{-- Change this line to handle password errors --}}
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>





@endsection

<script>
    function goToRegisterForm() {
        window.location.href = "{{ route('register') }}";
    }
</script>
