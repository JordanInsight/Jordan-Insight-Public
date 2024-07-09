@extends('layout.base')
@section('content')
    <section class="page-header"
        style="background-image: url({{ asset('assets/images/backgrounds/activity-background.jpg') }});">
        <div class="container">
            <h2>Activities</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('base') }}">Home</a></li>
                <li><span>Activities</span></li>
            </ul>
        </div>
    </section>

    <section class="activity-two activity-list">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="activity-sorter-one">
                        <h3 id="activity-count">0 Activities Found</h3>
                        <div class="activity-sorter-one__right">
                            <div class="activity-sorter-one__select">
                                <select name="sort-by" id="sort-by" class="selectpicker" onchange="fetchActivities()">
                                    <option value="Sort">Sort</option>
                                    <option value="By Reviews">By Reviews</option>
                                    <option value="By Price">By Price</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div id="activity-list"></div>

                    <div class="post-pagination" id="pagination">
                        <!-- Pagination links will be appended here by JavaScript -->
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="activity-sidebar">
                        <div class="activity-sidebar__sorter-wrap">
                            <!-- Price Filter -->
                            <div class="activity-sidebar__sorter-single">
                                <div class="activity-sidebar__sorter-top">
                                    <h3>Price</h3>
                                    <button class="activity-sidebar__sorter-toggler"><i
                                            class="fa fa-angle-down"></i></button>
                                </div>
                                <div class="activity-sidebar__sorter-content">
                                    <div class="activity-sidebar__price-range">
                                        <div class="form-group">
                                            <p>Up to $<span id="price-value-rangeslider">1000</span></p>
                                        </div>
                                        <div class="range-slider-price" id="range-slider-price"></div>
                                    </div>
                                </div>
                            </div>
                            <!-- Review Score Filter -->
                            <div class="activity-sidebar__sorter-single">
                                <div class="activity-sidebar__sorter-top">
                                    <h3>Review Score</h3>
                                    <button class="activity-sidebar__sorter-toggler"><i
                                            class="fa fa-angle-down"></i></button>
                                </div>
                                <div class="activity-sidebar__sorter-content">
                                    <div class="activity-sidebar__sorter-inputs">
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
                            <div class="activity-sidebar__sorter-single">
                                <div class="activity-sidebar__sorter-top">
                                    <h3>Cities</h3>
                                    <button class="activity-sidebar__sorter-toggler"><i
                                            class="fa fa-angle-down"></i></button>
                                </div>
                                <div class="activity-sidebar__sorter-content">
                                    <div class="activity-sidebar__sorter-inputs">
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
        var maxPrice = 1000;
        initializeSlider(maxPrice);
        fetchActivities(); // Fetch activities initially

        $('#sort-by').change(fetchActivities); // Add change listener to sort dropdown

        // Event listener for changes in price range or checkboxes
        document.querySelector('#range-slider-price').noUiSlider.on('set', fetchActivities);
        $('input[type="checkbox"]').change(fetchActivities);
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

    function fetchActivities(page = 1) {
        var sortBy = $('#sort-by').val() || 'By Date';
        var price = $('#price-value-rangeslider').text();
        var reviewScores = [];
        $('input[name="radio-group"]:checked').each(function() {
            reviewScores.push(this.id.split('-')[1]);
        });
        var cities = [];
        $('input[name="city-checkbox"]:checked').each(function() {
            cities.push($(this).val());
        });

        var fetchUrl =
            `/pages/activity/fetch?page=${page}&sort_by=${sortBy}&price=${price}&ratings=${reviewScores.join(',')}&cities=${cities.join(',')}`;

        $.ajax({
            url: fetchUrl,
            type: 'GET',
            success: function(response) {
                if (response.data && response.data.length > 0) {
                    renderActivities(response.data);
                    $('#activity-count').text(`${response.total} Activities Found`);
                    renderPagination(response);
                } else {
                    $('#activity-list').html('<p>No activities found.</p>');
                    $('#activity-count').text('0 Activities Found');
                    $('#pagination').html('');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching activities:', error);
                $('#activity-list').html('<p>Error loading activities. Please try again later.</p>');
                $('#activity-count').text('0 Activities Found');
                $('#pagination').html('');
            }
        });
    }

    function renderActivities(activities) {
        let html = '';
        activities.forEach(activity => {
            const price = activity.price ? parseFloat(activity.price).toFixed(2) : 'N/A';
            html += `
        <div class="activity-two__single activity-one__single">
            <div class="activity-two__image-wrap">
                <div class="activity-one__image">
                    <img src="${activity.image ? '/uploads/activities/' + activity.image : 'assets/images/default/activity-default.webp'}" alt="">
                    <a href="#" class="image-overlay-link"><i class="fa fa-long-arrow-alt-right"></i></a>
                </div>
            </div>
            <div class="activity-one__content">
                <div class="activity-two__top">
                    <div class="activity-two__top-left">
                        <div class="activity-one__stars">
                            <i class="fa fa-star"></i> ${activity.rating} Superb
                        </div>
                        <h3><a href="#">${activity.activity_name}</a></h3>
                    </div>
                    <div class="activity-two__right">
                        <p><span>$ ${price}</span> <br> Per Activity</p>
                    </div>
                </div>

                <div class="activity-two__text">
                    <p>${activity.description}</p>
                </div>
                <ul class="activity-one__meta list-unstyled">
                    <li><a href="#"><i class="far fa-map"></i> ${activity.location.city.city_name}</a></li>
                </ul>
            </div>
        </div>`;
        });
        $('#activity-list').html(html);
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
                `<a href="#" onclick="fetchActivities(${previousPage}); return false;"><i class="fa fa-angle-left"></i></a>`;
        }

        for (let page = 1; page <= last_page; page++) {
            html +=
                `<a href="#" class="${page === current_page ? 'active' : ''}" onclick="fetchActivities(${page}); return false;">${page.toString().padStart(2, '0')}</a>`;
        }

        if (nextPage) {
            html +=
                `<a href="#" onclick="fetchActivities(${nextPage}); return false;"><i class="fa fa-angle-right"></i></a>`;
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
