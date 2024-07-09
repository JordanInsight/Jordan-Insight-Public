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

                    {{-- Display success message --}}
                    @if (session('success'))
                        <div class="alert success-message">
                            {{ session('success') }}
                        </div>
                    @endif
                    
                    <form action="{{ route('sendResetLink') }}" method="POST">
                        @csrf
                        <h1><a href="{{ route('base') }}"><img src="{{ asset('assets/images/logo-dark.png') }}"
                                    alt="Jordan Insight Home" height="" width="200px"></a></h1><br>
                        <h1>Password Reset</h1>
                        <p>Please enter your email.</p>
                        <div class="input-box">
                            <input type="email" id="login-email" name="email" value="{{ old('email') }}"
                                placeholder="Email" required>
                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                fill="none">
                                <style>
                                    @keyframes open {
                                        0% {
                                            transform: translateX(10px) scale(0);
                                            transform-origin: 50% 100%
                                        }

                                        to {
                                            transform: scale(1);
                                            transform-origin: 50% 100%
                                        }
                                    }
                                </style>
                                <rect width="12" height="10" x="6" y="8.804" stroke="#fff" stroke-width="1.5"
                                    rx="2">
                                </rect>
                                <path fill="#ffff99" stroke="#fff" stroke-width="1.5"
                                    d="M9 6.196a1 1 0 011-1h4a1 1 0 011 1v5.082a1 1 0 01-.37.777l-2.006 1.628a1 1 0 01-1.263-.002l-1.993-1.626A1 1 0 019 11.28V6.196z"
                                    style="animation:open 2s cubic-bezier(.49,.39,.35,1.06) both infinite"></path>
                                <path stroke="#fff" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M8.465 11.413l3.573 2.783 3.497-2.783"></path>
                            </svg>
                            {{-- In your email input section --}}
                            @error('email')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="btn">Send Email</button>
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
