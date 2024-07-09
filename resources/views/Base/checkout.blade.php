@extends('layout.base')
@section('content')
    <div class="px-4 px-lg-0">
        <!-- For demo purpose -->
        <div class="container text-black py-5 text-center">
            <h1 class="display-4">Booking Details</h1>
            <p class="lead mb-0">Review your booking details and proceed to payment.</p>
        </div>
        <!-- End -->

        <div class="pb-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 p-5 bg-white rounded shadow-sm mb-5">
                        <!-- Booking details table -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead class="text-black">
                                    <tr>
                                        <th scope="col" class="border-0 bg-light">
                                            <div class="p-3 text-uppercase">Product</div>
                                        </th>
                                        <th scope="col" class="border-0 bg-light">
                                            <div class="py-3 text-uppercase">Price</div>
                                        </th>
                                        <th scope="col" class="border-0 bg-light">
                                            <div class="py-3 text-uppercase">Total Days</div>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row" class="border-0">
                                            <div class="p-3">
                                                <img src="{{ asset('uploads/Car/' . $car->image) }}" alt="Car Image"
                                                    width="200" class="img-fluid rounded shadow-sm">
                                                <div class="ml-3 d-inline-block align-middle">
                                                    <h1 class="mb-0">
                                                        <a href="#"
                                                            class="text-dark d-inline-block align-middle">{{ $car->car_name }}</a>
                                                    </h1>
                                                    <span class="text-muted font-weight-normal font-italic d-block">Model:
                                                        {{ $car->model }}</span>
                                                    <span class="text-muted font-weight-normal font-italic d-block">Phone:
                                                        {{ $phone }}</span>
                                                    <span class="text-muted font-weight-normal font-italic d-block">From:
                                                        {{ $start_date }}</span>
                                                    <span class="text-muted font-weight-normal font-italic d-block">To:
                                                        {{ $end_date }}</span>
                                                </div>
                                            </div>
                                        </th>
                                        <td class="border-0 align-middle">
                                            <strong class="larger-text text-black">${{ number_format($car->price, 2) }}</strong>
                                        </td>
                                        <td class="border-0 align-middle">
                                            <strong class="larger-text text-black">{{ $days }} days</strong>
                                        </td>
                                    </tr>
                                </tbody>

                                <tfoot class="text-black">
                                    <tr>
                                        <th colspan="2" class="text-right larger-text text-black">Total Price</th>
                                        <th class="font-weight-bold larger-text text-black">
                                            ${{ number_format($total_price, 2) }}</th>
                                    </tr>
                                </tfoot>

                            </table>
                        </div>
                        <!-- End -->
                    </div>
                </div>

                <div class="row py-5 p-4 bg-white rounded shadow-sm text-black">
                    <div class="col-lg-6">
                        <div class="bg-light rounded-pill px-4 py-3 text-uppercase font-weight-bold">Order Summary</div>
                        <div class="p-4">
                            <ul class="list-unstyled mb-4">
                                <li class="d-flex justify-content-between py-3 border-bottom larger-text text-black">
                                    <strong class="text-black">Total</strong>
                                    <h5 class="font-weight-bold">${{ number_format($total_price, 2) }}</h5>
                                </li>
                            </ul>
                            <form action="{{ route('checkout.payment') }}" method="POST">
                                @csrf
                                <input type="hidden" name="car_id" value="{{ $car->id }}">
                                <input type="hidden" name="car_name" value="{{ $car->car_name }}">
                                <input type="hidden" name="total" value="{{ $total_price }}">
                                <input type="hidden" name="start_date" value="{{ $start_date }}">
                                <input type="hidden" name="end_date" value="{{ $end_date }}">
                                <input type="hidden" name="phone" value="{{ $phone }}">
                                <button type="submit" class="btn thm-btn rounded-pill py-2 btn-block">Proceed to
                                    Payment</button>
                            </form>
                            <a href="{{ route('base') }}"
                                class="btn btn-danger rounded-pill py-2 btn-block mt-2">Cancel</a>

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

    .larger-text {
        font-size: 1.25rem;
    }

    .table th,
    .table td {
        padding: 1.5rem;
    }

    .img-fluid {
        max-width: 200px;
        height: auto;
    }

    .container {
        max-width: 1200px;
    }

    .text-black {
        color: #000 !important;
    }

    .bg-light {
        background-color: #f8f9fa !important;
    }

    .rounded-pill {
        border-radius: 50rem !important;
    }

    .text-uppercase {
        text-transform: uppercase !important;
    }
</style>
