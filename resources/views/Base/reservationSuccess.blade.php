@extends('layout.base')
@section('content')
    <div class="px-4 px-lg-0">
        <!-- For demo purpose -->
        <div class="container text-black py-5 text-center">
            <h1 class="display-4">Reservation Successful</h1>
            <p class="lead mb-0">Thank you for booking with us. You will receive a confirmation email shortly.</p>
        </div>
        <!-- End -->

        <div class="pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
                        <div class="text-center">
                            <h1 class="text-success">Your reservation has been successfully completed!</h1>
                            <p class="lead text-black">You will be redirected to the home page shortly.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<style>
    body {
        min-height: 100vh;
    }

    .container {
        max-width: 1200px;
    }

    .text-black {
        color: #000 !important;
    }

    .bg-white {
        background-color: #fff !important;
    }

    .rounded {
        border-radius: 0.25rem !important;
    }

    .shadow-sm {
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
    }

    .text-success {
        color: #28a745 !important;
    }

    .text-center {
        text-align: center !important;
    }

    .lead {
        font-size: 1.25rem;
        font-weight: 300;
    }
</style>

<script>
    setTimeout(function() {
        window.location.href = "{{ route('base') }}";
    }, 3000); 
</script>
