@extends('layout.base')
@section('content')
    <section class="page-header" style="background-image: url({{ asset('assets/images/backgrounds/blogWallpaper.png') }});">
        <div class="container">
            <h2>Tours with Sidebar</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="index.html">Home</a></li>
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
                                    <option value="By Budget">By Budget</option>
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
                            <!-- Budget Filter -->
                            <div class="tour-sidebar__sorter-single">
                                <div class="tour-sidebar__sorter-top">
                                    <h3>Budget</h3>
                                    <button class="tour-sidebar__sorter-toggler"><i class="fa fa-angle-down"></i></button>
                                </div>
                                <div class="tour-sidebar__sorter-content">
                                    <div class="tour-sidebar__budget-range">
                                        <div class="form-group">
                                            <p>$<span id="min-value-rangeslider">0</span> - $<span id="max-value-rangeslider">1000</span></p>
                                        </div>
                                        <div class="range-slider-budget" id="range-slider-budget"></div>
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
                            <div class="tour-sidebar__sorter-single">
                                <div class="tour-sidebar__sorter-top">
                                    <h3>Cities</h3>
                                    <button class="tour-sidebar__sorter-toggler"><i class="fa fa-angle-down"></i></button>
                                </div>
                                <div class="tour-sidebar__sorter-content">
                                    <div class="tour-sidebar__sorter-inputs">
                                        @foreach ($cities as $city)
                                            <p>
                                                <input type="checkbox" id="city-{{ $city->id }}" name="city-checkbox" value="{{ $city->city_name }}">
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
        var minBudget = 0;
        var maxBudget = 1000;
        initializeSlider(minBudget, maxBudget);
        fetchTours(); // Fetch tours initially

        $('#sort-by').change(fetchTours); // Add change listener to sort dropdown

        // Event listener for changes in budget range or checkboxes
        document.querySelector('#range-slider-budget').noUiSlider.on('set', fetchTours);
        $('input[type="checkbox"]').change(fetchTours);
    });

    var budgetSlider = document.getElementById('range-slider-budget');
    noUiSlider.create(budgetSlider, {
        start: [0, 1000],
        connect: true,
        range: {
            'min': 0,
            'max': 1000
        }
    });

    budgetSlider.noUiSlider.on('update', function(values, handle) {
        $('#min-value-rangeslider').text(Math.round(values[0]));
        $('#max-value-rangeslider').text(Math.round(values[1]));
    });

    function fetchTours(page = 1) {
        var sortBy = $('#sort-by').val() || 'By Date';
        var minBudget = $('#min-value-rangeslider').text();
        var maxBudget = $('#max-value-rangeslider').text();
        var reviewScores = [];
        $('input[name="radio-group"]:checked').each(function() {
            reviewScores.push(this.id.split('-')[1]);
        });
        var cities = [];
        $('input[name="city-checkbox"]:checked').each(function() {
            cities.push($(this).val());
        });

        var fetchUrl =
            `/pages/tour/fetch?page=${page}&sort_by=${sortBy}&min_budget=${minBudget}&max_budget=${maxBudget}&ratings=${reviewScores.join(',')}&cities=${cities.join(',')}`;

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
            html += `
        <div class="tour-two__single tour-one__single">
            <div class="tour-two__image-wrap">
                <div class="tour-one__image">
                    <img src="${tour.image ? '/uploads/Tour/' + tour.image : 'assets/images/default/tour-default.webp'}" alt="">
                    <a href="${tour.website}" class="image-overlay-link"><i class="fa fa-long-arrow-alt-right"></i></a>
                </div>
            </div>
            <div class="tour-one__content">
                <div class="tour-two__top">
                    <div class="tour-two__top-left">
                        <div class="tour-one__stars">
                            <i class="fa fa-star"></i> ${tour.rating} Superb
                        </div>
                        <h3><a href="${tour.website}">${tour.tour_name}</a></h3>
                    </div>
                    <div class="tour-two__right">
                        <p><span>$ ${tour.budget}</span> <br> Per Person</p>
                    </div>
                </div>

                <div class="tour-two__text">
                    <p>${tour.description}</p>
                </div>
                <ul class="tour-one__meta list-unstyled">
                    <li><a href="tour-details.html"><i class="far fa-map"></i> ${tour.location.city.city_name}</a></li>
                </ul>
            </div>
        </div>`;
        });
        $('#tour-list').html(html);
    }

    function renderPagination(response) {
        let html = '';
        const { current_page, last_page } = response;
        const previousPage = current_page > 1 ? current_page - 1 : null;
        const nextPage = current_page < last_page ? current_page + 1 : null;

        if (previousPage) {
            html += `<a href="#" onclick="fetchTours(${previousPage}); return false;"><i class="fa fa-angle-left"></i></a>`;
        }

        for (let page = 1; page <= last_page; page++) {
            html += `<a href="#" class="${page === current_page ? 'active' : ''}" onclick="fetchTours(${page}); return false;">${page.toString().padStart(2, '0')}</a>`;
        }

        if (nextPage) {
            html += `<a href="#" onclick="fetchTours(${nextPage}); return false;"><i class="fa fa-angle-right"></i></a>`;
        }

        $('#pagination').html(html);
    }

    function initializeSlider(minBudget, maxBudget) {
        var budgetSlider = document.getElementById('range-slider-budget');
        if (budgetSlider) {
            if (budgetSlider.noUiSlider) {
                budgetSlider.noUiSlider.destroy(); // Ensure no duplicates
            }
            noUiSlider.create(budgetSlider, {
                start: [minBudget, maxBudget],
                connect: true,
                range: {
                    'min': minBudget,
                    'max': maxBudget
                }
            });

            budgetSlider.noUiSlider.on('update', function(values, handle) {
                $('#min-value-rangeslider').text(Math.round(values[0]));
                $('#max-value-rangeslider').text(Math.round(values[1]));
            });
        }
    }
</script>
