@extends('layout.base')
@section('content')
    <section class="page-header"
        style="background-image: url({{ asset('assets/images/backgrounds/restaurant-background.png') }});">
        <div class="container">
            <h2>Restaurants </h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('base') }}">Home</a></li>
                <li><span>Restaurants</span></li>
            </ul>
        </div>
    </section>

    <section class="restaurant-two restaurant-list">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="restaurant-sorter-one">
                        <h3 id="restaurant-count">0 Restaurants Found</h3>
                        <div class="restaurant-sorter-one__right">
                            <div class="restaurant-sorter-one__select">
                                <select name="sort-by" id="sort-by" class="selectpicker" onchange="fetchRestaurants()">
                                    <option value="Sort">Sort</option>
                                    <option value="By Reviews">By Reviews</option>
                                    <option value="By Price">By Price</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="restaurant-list"></div>

                    <div class="post-pagination" id="pagination">
                        <!-- Pagination links will be appended here by JavaScript -->
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="restaurant-sidebar">
                        <div class="restaurant-sidebar__sorter-wrap">
                            <!-- Price Filter -->
                            <div class="restaurant-sidebar__sorter-single">
                                <div class="restaurant-sidebar__sorter-top">
                                    <h3>Price</h3>
                                    <button class="restaurant-sidebar__sorter-toggler"><i
                                            class="fa fa-angle-down"></i></button>
                                </div>
                                <div class="restaurant-sidebar__sorter-content">
                                    <div class="restaurant-sidebar__price-range">
                                        <div class="form-group">
                                            <p>$<span id="min-value-rangeslider">0</span> - $<span
                                                    id="max-value-rangeslider">1000</span></p>
                                        </div>
                                        <div class="range-slider-price" id="range-slider-price"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Review Score Filter -->
                            <div class="restaurant-sidebar__sorter-single">
                                <div class="restaurant-sidebar__sorter-top">
                                    <h3>Review Score</h3>
                                    <button class="restaurant-sidebar__sorter-toggler"><i
                                            class="fa fa-angle-down"></i></button>
                                </div>
                                <div class="restaurant-sidebar__sorter-content">
                                    <div class="restaurant-sidebar__sorter-inputs">
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
                            <div class="restaurant-sidebar__sorter-single">
                                <div class="restaurant-sidebar__sorter-top">
                                    <h3>Cities</h3>
                                    <button class="restaurant-sidebar__sorter-toggler"><i
                                            class="fa fa-angle-down"></i></button>
                                </div>
                                <div class="restaurant-sidebar__sorter-content">
                                    <div class="restaurant-sidebar__sorter-inputs">
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
        fetchRestaurants(); // Fetch restaurants initially

        $('#sort-by').change(fetchRestaurants); // Add change listener to sort dropdown

        // Event listener for changes in price range or checkboxes
        document.querySelector('#range-slider-price').noUiSlider.on('set', fetchRestaurants);
        $('input[type="checkbox"]').change(fetchRestaurants);
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

    function fetchRestaurants(page = 1) {
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
            `/pages/restaurant/fetch?page=${page}&sort_by=${sortBy}&min_price=${minPrice}&max_price=${maxPrice}&ratings=${reviewScores.join(',')}&cities=${cities.join(',')}`;

        $.ajax({
            url: fetchUrl,
            type: 'GET',
            success: function(response) {
                if (response.data && response.data.length > 0) {
                    renderRestaurants(response.data);
                    $('#restaurant-count').text(`${response.total} Restaurants Found`);
                    renderPagination(response);
                } else {
                    $('#restaurant-list').html('<p>No restaurants found.</p>');
                    $('#restaurant-count').text('0 Restaurants Found');
                    $('#pagination').html('');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching restaurants:', error);
                $('#restaurant-list').html('<p>Error loading restaurants. Please try again later.</p>');
                $('#restaurant-count').text('0 Restaurants Found');
                $('#pagination').html('');
            }
        });
    }

    function renderRestaurants(restaurants) {
        let html = '';
        restaurants.forEach(restaurant => {
            const avgPrice = (parseFloat(restaurant.min_price) + parseFloat(restaurant.max_price)) / 2;
            html += `
        <div class="restaurant-two__single restaurant-one__single">
            <div class="restaurant-two__image-wrap">
                <div class="restaurant-one__image">
                    <img src="${restaurant.image ? '/uploads/Restaurant/' + restaurant.image : 'assets/images/default/restaurant-default.webp'}" alt="">
                    <a href="#" class="image-overlay-link"><i class="fa fa-long-arrow-alt-right"></i></a>
                </div>
            </div>
            <div class="restaurant-one__content">
                <div class="restaurant-two__top">
                    <div class="restaurant-two__top-left">
                        <div class="restaurant-one__stars">
                            <i class="fa fa-star"></i> ${restaurant.rating} Superb
                        </div>
                        <h3><a href="#">${restaurant.restaurant_name}</a></h3>
                    </div>
                    <div class="restaurant-two__right">
                        <p><span>$ ${avgPrice.toFixed(2)}</span> <br> Per Meal</p>
                    </div>
                </div>

                <div class="restaurant-two__text">
                    <p>${restaurant.description}</p>
                </div>
                <ul class="restaurant-one__meta list-unstyled">
                    <li><a href="#"><i class="far fa-map"></i> ${restaurant.location.city.city_name}</a></li>
                </ul>
            </div>
        </div>`;
        });
        $('#restaurant-list').html(html);
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
                `<a href="#" onclick="fetchRestaurants(${previousPage}); return false;"><i class="fa fa-angle-left"></i></a>`;
        }

        for (let page = 1; page <= last_page; page++) {
            html +=
                `<a href="#" class="${page === current_page ? 'active' : ''}" onclick="fetchRestaurants(${page}); return false;">${page.toString().padStart(2, '0')}</a>`;
        }

        if (nextPage) {
            html +=
                `<a href="#" onclick="fetchRestaurants(${nextPage}); return false;"><i class="fa fa-angle-right"></i></a>`;
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
