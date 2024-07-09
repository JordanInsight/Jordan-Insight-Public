@extends('layout.base')
@section('content')
    <section class="page-header"
        style="background-image: url({{ asset('assets/images/backgrounds/hotel-background.png') }});">
        <div class="container">
            <h2>Hotels</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('base') }}">Home</a></li>
                <li><span>Hotels</span></li>
            </ul>
        </div>
    </section>

    <section class="hotel-two hotel-list">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">

                    <div class="hotel-sorter-one">
                        <h3 id="hotel-count">0 Hotels Found</h3>
                        <div class="hotel-sorter-one__right">
                            <div class="hotel-sorter-one__select">
                                <select name="sort-by" id="sort-by" class="selectpicker" onchange="fetchHotels()">
                                    <option value="Sort">Sort</option>
                                    <option value="By Reviews">By Reviews</option>
                                    <option value="By Price">By Price</option>
                                </select>
                            </div>
                        </div>
                    </div>


                    <div id="hotel-list"></div>

                    <div class="post-pagination" id="pagination">
                        <!-- Pagination links will be appended here by JavaScript -->
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="hotel-sidebar">
                        <div class="hotel-sidebar__sorter-wrap">
                            <!-- Price Filter -->
                            <div class="hotel-sidebar__sorter-single">
                                <div class="hotel-sidebar__sorter-top">
                                    <h3>Price</h3>
                                    <button class="hotel-sidebar__sorter-toggler"><i class="fa fa-angle-down"></i></button>
                                </div>
                                <div class="hotel-sidebar__sorter-content">
                                    <div class="hotel-sidebar__price-range">
                                        <div class="form-group">
                                            <p>$<span id="min-value-rangeslider">0</span> - $<span
                                                    id="max-value-rangeslider">1000</span></p>
                                        </div>
                                        <div class="range-slider-price" id="range-slider-price"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Review Score Filter -->
                            <div class="hotel-sidebar__sorter-single">
                                <div class="hotel-sidebar__sorter-top">
                                    <h3>Review Score</h3>
                                    <button class="hotel-sidebar__sorter-toggler"><i class="fa fa-angle-down"></i></button>
                                </div>
                                <div class="hotel-sidebar__sorter-content">
                                    <div class="hotel-sidebar__sorter-inputs">
                                        <!-- Dynamic checkboxes for each star -->
                                        @for ($i = 5; $i >= 1; $i--)
                                            <p>
                                                <input type="checkbox" id="review-{{ $i }}" name="radio-group">
                                                <label for="review-{{ $i }}">
                                                    @for ($j = 1; $j <= 5; $j++)
                                                        <i class="fa fa-star {{ $j <= $i ? 'active' : '' }}"></i>
                                                    @endfor
                                                </label>
                                            </p>
                                        @endfor
                                    </div>
                                </div>
                            </div>

                            <!-- Cities Filter -->
                            <div class="hotel-sidebar__sorter-single">
                                <div class="hotel-sidebar__sorter-top">
                                    <h3>Cities</h3>
                                    <button class="hotel-sidebar__sorter-toggler"><i class="fa fa-angle-down"></i></button>
                                </div>
                                <div class="hotel-sidebar__sorter-content">
                                    <div class="hotel-sidebar__sorter-inputs">
                                        @foreach ($cities as $city)
                                            <p>
                                                <input type="checkbox" id="city-{{ $city->id }}" name="city-checkbox"
                                                    value="{{ $city->city_name }}">
                                                <label for="city-{{ $city->id }}" style="color: #082740">
                                                    <i class="fa fa-city city-icon" style="color: #ffa801"></i>
                                                    {{ $city->city_name }}
                                                </label>
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
@endsection

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/nouislider/distribute/nouislider.min.css">
<script src="https://cdn.jsdelivr.net/npm/nouislider/distribute/nouislider.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        var minPrice = 0;
        var maxPrice = 1000;
        initializeSlider(minPrice, maxPrice);
        fetchHotels(); // Fetch hotels initially

        $('#sort-by').change(fetchHotels); // Add change listener to sort dropdown

        // Event listener for changes in price range or checkboxes
        document.querySelector('#range-slider-price').noUiSlider.on('set', fetchHotels);
        $('input[type="checkbox"]').change(fetchHotels);
    });

    var priceSlider = document.getElementById('range-slider-price');
    noUiSlider.create(priceSlider, {
        start: [0, 1000],
        connect: true,
        range: {
            'min': 0,
            'max': 1000
        }
    });

    priceSlider.noUiSlider.on('update', function(values, handle) {
        $('#min-value-rangeslider').text(Math.round(values[0]));
        $('#max-value-rangeslider').text(Math.round(values[1]));
    });

    function fetchHotels(page = 1) {
        var sortBy = $('#sort-by').val() || 'By Date';
        var minPrice = $('#min-value-rangeslider').text();
        var maxPrice = $('#max-value-rangeslider').text();
        var reviewScores = [];
        $('input[name="radio-group"]:checked').each(function() {
            reviewScores.push(this.id.split('-')[1]);
        });
        var cities = [];
        $('input[name="city-checkbox"]:checked').each(function() {
            cities.push($(this).val());
        });

        var fetchUrl =
            `/pages/hotel/fetch?page=${page}&sort_by=${sortBy}&min_price=${minPrice}&max_price=${maxPrice}&ratings=${reviewScores.join(',')}&cities=${cities.join(',')}`;

        $.ajax({
            url: fetchUrl,
            type: 'GET',
            success: function(response) {
                if (response.data && response.data.length > 0) {
                    renderHotels(response.data);
                    $('#hotel-count').text(`${response.total} Hotels Found`);
                    renderPagination(response);
                } else {
                    $('#hotel-list').html('<p>No hotels found.</p>');
                    $('#hotel-count').text('0 Hotels Found');
                    $('#pagination').html('');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching hotels:', error);
                $('#hotel-list').html('<p>Error loading hotels. Please try again later.</p>');
                $('#hotel-count').text('0 Hotels Found');
                $('#pagination').html('');
            }
        });
    }

    function renderHotels(hotels) {
        let html = '';
        hotels.forEach(hotel => {
            const avgPrice = (parseFloat(hotel.min_price) + parseFloat(hotel.max_price)) / 2;
            html += `
        <div class="hotel-two__single hotel-one__single">
            <div class="hotel-two__image-wrap">
                <div class="hotel-one__image">
                    <img src="${hotel.image ? '/uploads/Hotel/' + hotel.image : 'assets/images/default/hotel-default.webp'}" alt="">
                    <a href="${hotel.website}" class="image-overlay-link"><i class="fa fa-long-arrow-alt-right"></i></a>
                </div>
            </div>
            <div class="hotel-one__content">
                <div class="hotel-two__top">
                    <div class="hotel-two__top-left">
                        <div class="hotel-one__stars">
                            <i class="fa fa-star"></i> ${hotel.rating} Superb
                        </div>
                        <h3><a href="${hotel.website}">${hotel.hotel_name}</a></h3>
                    </div>
                    <div class="hotel-two__right">
                        <p><span>$ ${avgPrice.toFixed(2)}</span> <br> Per Night</p>
                    </div>
                </div>

                <div class="hotel-two__text">
                    <p>${hotel.description}</p>
                </div>
                <ul class="hotel-one__meta list-unstyled">
                    <li><a href="#"><i class="far fa-map"></i> ${hotel.location.city.city_name}</a></li>
                </ul>
            </div>
        </div>`;
        });
        $('#hotel-list').html(html);
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
                `<a href="#" onclick="fetchHotels(${previousPage}); return false;"><i class="fa fa-angle-left"></i></a>`;
        }

        for (let page = 1; page <= last_page; page++) {
            html +=
                `<a href="#" class="${page === current_page ? 'active' : ''}" onclick="fetchHotels(${page}); return false;">${page.toString().padStart(2, '0')}</a>`;
        }

        if (nextPage) {
            html +=
                `<a href="#" onclick="fetchHotels(${nextPage}); return false;"><i class="fa fa-angle-right"></i></a>`;
        }

        $('#pagination').html(html);
    }

    function initializeSlider(minPrice, maxPrice) {
        var priceSlider = document.getElementById('range-slider-price');
        if (priceSlider) {
            if (priceSlider.noUiSlider) {
                priceSlider.noUiSlider.destroy(); // Ensure no duplicates
            }
            noUiSlider.create(priceSlider, {
                start: [minPrice, maxPrice],
                connect: true,
                range: {
                    'min': minPrice,
                    'max': maxPrice
                }
            });

            priceSlider.noUiSlider.on('update', function(values, handle) {
                $('#min-value-rangeslider').text(Math.round(values[0]));
                $('#max-value-rangeslider').text(Math.round(values[1]));
            });
        }
    }
</script>
