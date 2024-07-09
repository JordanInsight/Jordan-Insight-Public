@extends('layout.base')
@section('content')
    <section class="page-header" style="background-image: url({{ asset('assets/images/backgrounds/car-background.png') }});">
        <div class="container">
            <h2>Cars</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('base') }}">Home</a></li>
                <li><span>Cars</span></li>
            </ul>
        </div>
    </section>

    <section class="car-list">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="car-sorter-one">
                        <h3 id="car-count">0 Cars Found</h3>
                        <div class="car-sorter-one__right">
                            <div class="car-sorter-one__select">
                                <select name="sort-by" id="sort-by" class="selectpicker" onchange="fetchCars()">
                                    <option value="Sort">Sort</option>
                                    <option value="By Price">By Price</option>
                                    <option value="By Model">By Model</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="car-list"></div>

                    <div class="post-pagination" id="pagination">
                        <!-- Pagination links will be appended here by JavaScript -->
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="car-sidebar">
                        <div class="car-sidebar__sorter-wrap">
                            <!-- Price Filter -->
                            <div class="car-sidebar__sorter-single">
                                <div class="car-sidebar__sorter-top">
                                    <h3>Price</h3>
                                    <button class="car-sidebar__sorter-toggler"><i class="fa fa-angle-down"></i></button>
                                </div>
                                <div class="car-sidebar__sorter-content">
                                    <div class="car-sidebar__price-range">
                                        <div class="form-group">
                                            <p>Up to $<span id="price-value-rangeslider">1000</span></p>
                                        </div>
                                        <div class="range-slider-price" id="range-slider-price"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Model Filter -->
                            <div class="car-sidebar__sorter-single">
                                <div class="car-sidebar__sorter-top">
                                    <h3>Model</h3>
                                    <button class="car-sidebar__sorter-toggler"><i class="fa fa-angle-down"></i></button>
                                </div>
                                <div class="car-sidebar__sorter-content">
                                    <div class="car-sidebar__sorter-inputs">
                                        @foreach ($models as $model)
                                            <p>
                                                <input type="checkbox" id="model-{{ $model }}" name="model-checkbox"
                                                    value="{{ $model }}">
                                                <label for="model-{{ $model }}">{{ $model }}</label>
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- Seats Filter -->
                            <div class="car-sidebar__sorter-single">
                                <div class="car-sidebar__sorter-top">
                                    <h3>Seats</h3>
                                    <button class="car-sidebar__sorter-toggler"><i class="fa fa-angle-down"></i></button>
                                </div>
                                <div class="car-sidebar__sorter-content">
                                    <div class="car-sidebar__sorter-inputs">
                                        @foreach ($seats as $seat)
                                            <p>
                                                <input type="checkbox" id="seat-{{ $seat }}" name="seat-checkbox"
                                                    value="{{ $seat }}">
                                                <label for="seat-{{ $seat }}">{{ $seat }} seats</label>
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Booking Modal -->
    <div id="bookingModal" class="modal fade" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title">Book a Car</h1>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="bookingForm" action="{{ route('checkout') }}" method="GET">
                        <div class="form-group">
                            <label for="startDate">Start Date</label>
                            <input type="date" class="form-control" id="startDate" name="start_date" required>
                        </div>
                        <div class="form-group">
                            <label for="endDate">End Date</label>
                            <input type="date" class="form-control" id="endDate" name="end_date" required>
                        </div>
                        <div class="form-group">
                            <label for="phone">Phone</label>
                            <input type="text" class="form-control" id="phone" name="phone" required>
                        </div>
                        <input type="hidden" id="carId" name="car_id">
                        <button type="submit" class="btn btn-primary">Book Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nouislider/distribute/nouislider.min.css">
<script src="https://cdn.jsdelivr.net/npm/nouislider/distribute/nouislider.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    function setCarId(carId) {
        $('#carId').val(carId);
    }

    $(document).ready(function() {
        var maxPrice = 1000;
        initializeSlider(maxPrice);
        fetchCars(); // Fetch cars initially

        // Initialize selectpicker
        $('.selectpicker').selectpicker();

        $('#sort-by').change(fetchCars); // Add change listener to sort dropdown

        // Event listener for changes in price range or checkboxes
        document.querySelector('#range-slider-price').noUiSlider.on('set', fetchCars);
        $('input[type="checkbox"]').change(fetchCars);

        // Set min attribute for startDate input to today's date
        var today = new Date().toISOString().split('T')[0];
        $('#startDate').attr('min', today);

        // Handle date validation
        $('#startDate').change(function() {
            var startDate = $(this).val();
            $('#endDate').attr('min', startDate);
        });

        $('#endDate').change(function() {
            var startDate = $('#startDate').val();
            var endDate = $(this).val();
            if (endDate < startDate) {
                alert('End date cannot be before start date.');
                $(this).val(startDate);
            }
        });

        // Handle form submission
        $('#bookingForm').submit(function() {
            var carId = $('#carId').val();
            $(this).append(`<input type="hidden" name="car_id" value="${carId}">`);
        });

        $('.image-overlay-link').on('click', function() {
            var carId = $(this).data('car-id');
            setCarId(carId);
        });
    });




    var priceSlider = document.getElementById('range-slider-price');
    noUiSlider.create(priceSlider, {
        start: [1000],
        connect: [true, false],
        range: {
            'min': 0,
            'max': 1000
        }
    });

    priceSlider.noUiSlider.on('update', function(values, handle) {
        $('#price-value-rangeslider').text(Math.round(values[0]));
    });

    function fetchCars(page = 1) {
        var sortBy = $('#sort-by').val() || 'By Date';
        var price = $('#price-value-rangeslider').text();
        var models = [];
        $('input[name="model-checkbox"]:checked').each(function() {
            models.push($(this).val());
        });
        var seats = [];
        $('input[name="seat-checkbox"]:checked').each(function() {
            seats.push($(this).val());
        });

        var fetchUrl =
            `/pages/car/fetch?page=${page}&sort_by=${sortBy}&price=${price}&models=${models.join(',')}&seats=${seats.join(',')}`;

        $.ajax({
            url: fetchUrl,
            type: 'GET',
            success: function(response) {
                if (response.data && response.data.length > 0) {
                    renderCars(response.data);
                    $('#car-count').text(`${response.total} Cars Found`);
                    renderPagination(response);
                } else {
                    $('#car-list').html('<p>No cars found.</p>');
                    $('#car-count').text('0 Cars Found');
                    $('#pagination').html('');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching cars:', error);
                $('#car-list').html('<p>Error loading cars. Please try again later.</p>');
                $('#car-count').text('0 Cars Found');
                $('#pagination').html('');
            }
        });
    }

    function renderCars(cars) {
        let html = '';
        cars.forEach(car => {
            const price = car.price ? parseFloat(car.price).toFixed(2) : 'N/A';
            html += `
        <div class="car-two__single car-one__single">
            <div class="car-two__image-wrap">
                <div class="car-one__image">
                    ${car.image ? `<img src="/uploads/Car/${car.image}" alt="Image for ${car.car_name}">` : `<img src="{{ asset('assets/images/default/car-default.png') }}" alt="Default Image">`}
                    <a href="#" class="image-overlay-link" data-toggle="modal" data-target="#bookingModal" onclick="setCarId(${car.id})"><i class="fa fa-long-arrow-alt-right"></i></a>
                </div>
            </div>
            <div class="car-one__content">
                <div class="car-two__top">
                    <div class="car-two__top-left">
                        <h3><a href="#">${car.car_name}</a></h3>
                    </div>
                    <div class="car-two__right">
                        <p><span>$ ${price}</span> <br> Per Day</p>
                    </div>
                </div>
                <div class="car-two__text">
                </div>
                <ul class="car-one__meta list-unstyled">
                    <li><a href="#"><i class="fa fa-car"></i> Model: ${car.model}</a></li>
                </ul>
            </div>
        </div>`;
        });
        $('#car-list').html(html);
    }

    function renderPagination(response) {
        let html = '';
        const {
            current_page,
            last_page
        } = response;
        const previousPage = current_page > 1 ? current_page - 1 : null;
        const nextPage = current_page < last_page ? current_page + 1 : null;

        if (previousPage) {
            html +=
                `<a href="#" onclick="fetchCars(${previousPage}); return false;"><i class="fa fa-angle-left"></i></a>`;
        }

        for (let page = 1; page <= last_page; page++) {
            html +=
                `<a href="#" class="${page === current_page ? 'active' : ''}" onclick="fetchCars(${page}); return false;">${page.toString().padStart(2, '0')}</a>`;
        }

        if (nextPage) {
            html += `<a href="#" onclick="fetchCars(${nextPage}); return false;"><i class="fa fa-angle-right"></i></a>`;
        }

        $('#pagination').html(html);
    }

    function initializeSlider(maxPrice) {
        var priceSlider = document.getElementById('range-slider-price');
        if (priceSlider) {
            if (priceSlider.noUiSlider) {
                priceSlider.noUiSlider.destroy(); // Ensure no duplicates
            }
            noUiSlider.create(priceSlider, {
                start: [maxPrice],
                connect: [true, false],
                range: {
                    'min': 0,
                    'max': maxPrice
                }
            });

            priceSlider.noUiSlider.on('update', function(values, handle) {
                $('#price-value-rangeslider').text(Math.round(values[0]));
            });
        }
    }
</script>
