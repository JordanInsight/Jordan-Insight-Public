@extends('layout.base')
@section('content')
    <section class="page-header" style="background-image: url({{ asset('assets/images/backgrounds/tour-background.png') }});">
        <div class="container">
            <h2>Tours</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('base') }}">Home</a></li>
                <li><span>Tours</span></li>
            </ul>
        </div>
    </section>

    <section class="tour-two tour-list">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="tour-sorter-one">
                        <h3 id="tour-count">0 Tours Found</h3>
                        <div class="tour-sorter-one__right">
                            <div class="tour-sorter-one__select">
                                <select name="sort-by" id="sort-by" class="selectpicker" onchange="fetchTours()">
                                    <option value="Sort">Sort</option>
                                    <option value="By Reviews">By Reviews</option>
                                    <option value="By Price">By Price</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="tour-list"></div>

                    <div class="post-pagination" id="pagination">
                        <!-- Pagination links will be appended here by JavaScript -->
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="tour-sidebar">
                        <div class="tour-sidebar__sorter-wrap">
                            <!-- Price Filter -->
                            <div class="tour-sidebar__sorter-single">
                                <div class="tour-sidebar__sorter-top">
                                    <h3>Price</h3>
                                    <button class="tour-sidebar__sorter-toggler"><i class="fa fa-angle-down"></i></button>
                                </div>
                                <div class="tour-sidebar__sorter-content">
                                    <div class="tour-sidebar__price-range">
                                        <div class="form-group">
                                            <p>$<span id="min-value-rangeslider">0</span> - $<span
                                                    id="max-value-rangeslider">{{ $maxPrice }}</span></p>
                                        </div>
                                        <div class="range-slider-price" id="range-slider-price"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Review Score Filter -->
                            <div class="tour-sidebar__sorter-single">
                                <div class="tour-sidebar__sorter-top">
                                    <h3>Review Score</h3>
                                    <button class="tour-sidebar__sorter-toggler"><i class="fa fa-angle-down"></i></button>
                                </div>
                                <div class="tour-sidebar__sorter-content">
                                    <div class="tour-sidebar__sorter-inputs">
                                        <!-- Dynamic checkboxes for each star -->
                                        @for ($i = 5; $i >= 1; $i--)
                                            <p>
                                                <input type="checkbox" id="review-{{ $i }}"
                                                    name="review-checkbox" value="{{ $i }}">
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
                            <div class="tour-sidebar__sorter-single">
                                <div class="tour-sidebar__sorter-top">
                                    <h3>Cities</h3>
                                    <button class="tour-sidebar__sorter-toggler"><i class="fa fa-angle-down"></i></button>
                                </div>
                                <div class="tour-sidebar__sorter-content">
                                    <div class="tour-sidebar__sorter-inputs">
                                        @foreach ($cities as $city)
                                            <p>
                                                <input type="checkbox" id="city-{{ $city->id }}" name="city-checkbox"
                                                    value="{{ $city->id }}">
                                                <label for="city-{{ $city->id }}" style="color: #082740">
                                                    <i class="fa fa-city city-icon" style="color: #ffa801"></i>
                                                    {{ $city->city_name }}
                                                </label>
                                            </p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>

                            <!-- Categories Type Filter -->
                            <div class="tour-sidebar__sorter-single">
                                <div class="tour-sidebar__sorter-top">
                                    <h3>Categories</h3>
                                    <button class="tour-sidebar__sorter-toggler"><i class="fa fa-angle-down"></i></button>
                                </div>
                                <div class="tour-sidebar__sorter-content">
                                    <div class="tour-sidebar__sorter-inputs">
                                        @foreach ($categories as $category)
                                            <p>
                                                <input type="checkbox" id="category-{{ $category->id }}"
                                                    name="category-checkbox" value="{{ $category->id }}">
                                                <label for="category-{{ $category->id }}" style="color: #082740">
                                                    <i class="fa fa-tag" style="color: #ffa801"></i>
                                                    {{ $category->category_name }}
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
        var maxPrice = {{ $maxPrice }};
        initializeSlider(minPrice, maxPrice);

        // Check if the URL contains search parameters
        var urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('place') || urlParams.has('when') || urlParams.has('type')) {
            // Fetch tours based on search filters
            fetchSearch();
        } else {
            // Fetch tours normally
            fetchTours();
        }

        $('#sort-by').change(function() {
            fetchToursOrSearch();
        });

        document.querySelector('#range-slider-price').noUiSlider.on('set', function() {
            fetchToursOrSearch();
        });

        $('input[type="checkbox"]').change(function() {
            fetchToursOrSearch();
        });
    });

    function initializeSlider(minPrice, maxPrice) {
        var priceSlider = document.getElementById('range-slider-price');
        if (priceSlider) {
            if (!priceSlider.noUiSlider) {
                noUiSlider.create(priceSlider, {
                    start: [minPrice, maxPrice],
                    connect: true,
                    step: 1,
                    range: {
                        'min': minPrice,
                        'max': maxPrice
                    }
                });
            } else {
                priceSlider.noUiSlider.updateOptions({
                    start: [minPrice, maxPrice],
                    step: 1,
                    range: {
                        'min': minPrice,
                        'max': maxPrice
                    }
                });
            }

            priceSlider.noUiSlider.on('update', function(values, handle) {
                var minVal = parseFloat(values[0]).toFixed(2);
                var maxVal = parseFloat(values[1]).toFixed(2);

                $('#min-value-rangeslider').text(minVal);
                $('#max-value-rangeslider').text(maxVal);
            });
        }
    }

    function fetchToursOrSearch(page = 1) {
        var urlParams = new URLSearchParams(window.location.search);
        if (urlParams.has('place') || urlParams.has('when') || urlParams.has('type')) {
            fetchSearch(page);
        } else {
            fetchTours(page);
        }
    }

    function fetchTours(page = 1) {
        var sortBy = $('#sort-by').val() || 'By Date';
        var minPrice = parseFloat($('#min-value-rangeslider').text());
        var maxPrice = parseFloat($('#max-value-rangeslider').text());

        var cities = [];
        $('input[name="city-checkbox"]:checked').each(function() {
            cities.push($(this).val());
        });

        var categories = [];
        $('input[name="category-checkbox"]:checked').each(function() {
            categories.push($(this).val());
        });

        var ratings = [];
        $('input[name="review-checkbox"]:checked').each(function() {
            ratings.push($(this).val());
        });

        var fetchUrl =
            `/tour-standard/fetch?page=${page}&sort_by=${sortBy}&min_price=${minPrice}&max_price=${maxPrice}&cities=${cities.join(',')}&categories=${categories.join(',')}&ratings=${ratings.join(',')}`;

        $.ajax({
            url: fetchUrl,
            type: 'GET',
            success: function(response) {
                if (response.data && response.data.length > 0) {
                    renderTours(response.data);
                    $('#tour-count').text(`${response.total} Tours Found`);
                    renderPagination(response);
                } else {
                    $('#tour-list').html('<p>No tours found.</p>');
                    $('#tour-count').text('0 Tours Found');
                    $('#pagination').html('');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching tours:', error);
                $('#tour-list').html('<p>Error loading tours. Please try again later.</p>');
                $('#tour-count').text('0 Tours Found');
                $('#pagination').html('');
            }
        });
    }

    function fetchSearch(page = 1) {
        var sortBy = $('#sort-by').val() || 'By Date';
        var minPrice = parseFloat($('#min-value-rangeslider').text());
        var maxPrice = parseFloat($('#max-value-rangeslider').text());

        var cities = [];
        $('input[name="city-checkbox"]:checked').each(function() {
            cities.push($(this).val());
        });

        var categories = [];
        $('input[name="category-checkbox"]:checked').each(function() {
            categories.push($(this).val());
        });

        var ratings = [];
        $('input[name="review-checkbox"]:checked').each(function() {
            ratings.push($(this).val());
        });

        var urlParams = new URLSearchParams(window.location.search);
        var place = urlParams.get('place');
        var when = urlParams.get('when');
        var type = urlParams.get('type');

        var fetchUrl =
            `/tour-standard/search?page=${page}&sort_by=${sortBy}&min_price=${minPrice}&max_price=${maxPrice}&cities=${cities.join(',')}&categories=${categories.join(',')}&ratings=${ratings.join(',')}&place=${place}&when=${when}&type=${type}`;

        $.ajax({
            url: fetchUrl,
            type: 'GET',
            success: function(response) {
                if (response.data && response.data.length > 0) {
                    renderTours(response.data);
                    $('#tour-count').text(`${response.total} Tours Found`);
                    renderPagination(response);
                } else {
                    $('#tour-list').html('<p>No tours found.</p>');
                    $('#tour-count').text('0 Tours Found');
                    $('#pagination').html('');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching tours:', error);
                $('#tour-list').html('<p>Error loading tours. Please try again later.</p>');
                $('#tour-count').text('0 Tours Found');
                $('#pagination').html('');
            }
        });
    }

    function renderTours(tours) {
        let html = '';
        tours.forEach(tour => {
            const budgetPerPerson = parseFloat(tour.budget);
            const ratingText = tour.rating && tour.rating > 0 ? `${tour.rating}` : 'No rating yet';
            const categories = tour.categories ? tour.categories.join(', ') : 'No categories';
            html += `
        <div class="tour-two__single tour-one__single">
            <div class="tour-two__image-wrap">
                <div class="tour-one__image">
                    <img src="${tour.image ? '/uploads/Tour/' + tour.image : 'assets/images/default/tour-default.webp'}" alt="">
                    <a href="/tour-details/${tour.id}" class="image-overlay-link"><i class="fa fa-long-arrow-alt-right"></i></a>
                </div>
            </div>
            <div class="tour-one__content">
                <div class="tour-two__top">
                    <div class="tour-two__top-left">
                        <div class="tour-one__stars">
                            ${tour.rating && tour.rating > 0 ? `<i class="fa fa-star"></i> ${tour.rating}` : 'No rating yet'}
                        </div>
                        <h3><a href="/tour-details/${tour.id}">${tour.tour_name}</a></h3>
                    </div>
                    <div class="tour-two__right">
                        <p><span>$ ${budgetPerPerson.toFixed(2)}</span> <br> Per Person</p>
                    </div>
                </div>

                <div class="tour-two__text">
                    <p>${tour.description ? tour.description : 'No description available'}</p>
                </div>
                <ul class="tour-one__meta list-unstyled">
                    <li><a href="#"><i class="far fa-clock"></i> ${tour.total_number_of_days} Days</a></li>
                    <li><a href="#"><i class="far fa-user-circle"></i> ${tour.number_of_people}</a></li>
                    <li><a href="#"><i class="fa fa-tag"></i> ${categories}</a></li>
                    <li><a href="#"><i class="far fa-map"></i> ${tour.city.city_name}</a></li>
                </ul>
            </div>
        </div>`;
        });
        $('#tour-list').html(html);
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
                `<a href="#" onclick="fetchToursOrSearch(${previousPage}); return false;"><i class="fa fa-angle-left"></i></a>`;
        }

        for (let page = 1; page <= last_page; page++) {
            html +=
                `<a href="#" class="${page === current_page ? 'active' : ''}" onclick="fetchToursOrSearch(${page}); return false;">${page.toString().padStart(2, '0')}</a>`;
        }

        if (nextPage) {
            html +=
                `<a href="#" onclick="fetchToursOrSearch(${nextPage}); return false;"><i class="fa fa-angle-right"></i></a>`;
        }

        $('#pagination').html(html);
    }
</script>
