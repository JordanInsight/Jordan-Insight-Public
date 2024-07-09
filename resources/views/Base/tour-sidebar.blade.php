@extends('layout.base')
@section('content')

    <style>
        .text-black {
            color: var(--thm-black) !important;
        }

        h3{
            color:var(--thm-black);
            font-family: var(--thm-font);
        }

        .make-tour-section {
            text-align: center;
            background-color: #f8f9fa;
            padding: 50px 20px;
            margin: 40px auto;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            max-width: 60%;
            position: relative;
            background-image: url('{{ asset('assets/images/backgrounds/make-tour.png') }}');
            background-position: bottom right;
            background-repeat: no-repeat;
            background-size: contain;
            overflow: hidden;
            /* Ensure children are clipped to the padding box */
            transition: background-color 0.5s ease;
        }

        .make-tour-section::before {
            content: "";
            position: absolute;
            top: 20px;
            left: 20px;
            width: 50px;
            height: 50px;
            background-color: #007bff;
            /* Change the color to match your theme */
            border-radius: 50%;
            /* Circle shape */
            box-shadow:
                60px 60px 0 0 #6c757d,
                /* Gray circle */
                120px 120px 0 0 #17a2b8;
            /* Teal circle */
            animation: float 5s infinite;
            /* Floating animation */
            transition: all 0.5s ease;
        }

 
        @keyframes float {
            0% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-20px);
            }

            100% {
                transform: translateY(0);
            }
        }

        .make-tour-section h1 {
            font-size: 2em;
            color: #343a40;
            margin-bottom: 20px;
            z-index: 1;
            /* Ensure text is above background */
            position: relative;
        }

        .make-tour-btn {
            background-color: #ffa801;
            color: #fff;
            border: none;
            border-radius: 25px;
            padding: 15px 30px;
            cursor: pointer;
            font-size: 1.2em;
            transition: background-color 0.3s ease;
            text-decoration: none;
            z-index: 1;
            /* Ensure button is above background */
            position: relative;
        }

        .make-tour-btn:hover {
            background-color: #e68901;
        }

        /* Optional: Uncomment if using link inside button */
        /* .make-tour-btn a {
                color: #fff;
                text-decoration: none;
            } */
        .autocomplete-results {
            position: absolute;
            background: #fff;
            border: 1px solid #ddd;
            width: calc(100% - 40px);
            /* Adjust width as needed */
            max-height: 200px;
            overflow-y: auto;
            z-index: 1000;
            list-style: none;
            padding: 0;
            margin: 0;
            margin-top: 5px;
            /* Space between input and results */
        }

        .autocomplete-results li {
            display: flex;
            align-items: center;
            padding: 10px;
            cursor: pointer;
        }

        .autocomplete-results li img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .autocomplete-results li div {
            display: flex;
            flex-direction: column;
        }

        .autocomplete-results li:hover {
            background-color: #f1f1f1;
        }

        .autocomplete-results li .city-name {
            font-weight: bold;
            color: #333;
        }

        .autocomplete-results li .city-details {
            color: #666;
        }
    </style>

    <section class="page-header"
        style="background-image: url('{{ asset('assets/images/backgrounds/page-header-contact.png') }}');">
        <div class="container">
            <h2>Tours with Sidebar</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="{{ route('base') }}">Home</a></li>
                <li><span>Tours</span></li>
            </ul>
        </div>
    </section>

    <section>
        <div class="make-tour-section">
            <h1 class="text-black">Make Your Tour</h1>
            <button id="createTripButton" class="make-tour-btn">Create your own trip</button>
            <!-- Uncomment this line if you want to add a link to the button -->
        </div>
    </section>



    <div id="sidebar" class="sidebar">
        <div class="sidebar-content">
            <span id="closeSidebar" class="close-btn">&times;</span>
            <h1 class="text-black">Create a Trip</h1>
            <form id="createTripForm" action="{{ route('userPlan.index') }}" method="POST">
                @csrf
                <label for="tripName">Trip name</label>
                <input type="text" id="tripName" name="tourName" placeholder="e.g., Summer vacation in Greece">
                <label for="destination">Destination</label>
                <input type="search" id="destination" name="city" placeholder="Where to?">
                <label for="">
                    <ul id="searchResults" class="autocomplete-results"></ul>
                </label>
                <br>
                <input type="hidden" id="cityId" name="cityId">

                <label for="dates">Dates or Length of stay</label>
                <div id="calendar"></div>

                <div class="form-buttons">
                    <button type="button" id="cancelButton">Cancel</button>
                    <button type="submit">Create trip</button>
                </div>
            </form>
        </div>
    </div>
    <div id="overlay" class="overlay"></div>
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
                                                    name="review-checkbox">
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


<script src="https://cdn.jsdelivr.net/npm/nouislider/distribute/nouislider.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
        });
        var minPrice = 0;
        var maxPrice = {{ $maxPrice }};
        initializeSlider(minPrice, maxPrice);

        fetchTours();


        $('#sort-by').change(fetchTours);

        document.querySelector('#range-slider-price').noUiSlider.on('set', fetchTours);
        $('input[type="checkbox"]').change(fetchTours);

        initializeManualTourForm();
        $("#sidebar").removeClass("wide");
        $("#overlay").removeClass("show");

    });

    function initializeManualTourForm() {
        let selectedDates = [];
        let currentDate = new Date();

        $("#createTripButton").click(function() {
            $("#sidebar").addClass("wide");
            $("#overlay").addClass("show");
            loadCalendar(currentDate);
        });

        $("#closeSidebar, #overlay, #cancelButton").click(function() {
            $("#sidebar").removeClass("wide");
            $("#overlay").removeClass("show");
        });

        function loadCalendar(date) {
            const calendar = $("#calendar");
            calendar.empty();

            const calendarHeader = $(`
            <div id="calendar-header">
                <button id="prevMonth">&lt;</button>
                <span>${date.toLocaleString("default", { month: "long" })} ${date.getFullYear()}</span>
                <button id="nextMonth">&gt;</button>
            </div>
        `);

            calendar.append(calendarHeader);

            $("#prevMonth").click(function() {
                currentDate.setMonth(currentDate.getMonth() - 1);
                loadCalendar(currentDate);
            });

            $("#nextMonth").click(function() {
                currentDate.setMonth(currentDate.getMonth() + 1);
                loadCalendar(currentDate);
            });

            const calendarDays = $('<div id="calendar-days"></div>');

            const firstDay = new Date(
                date.getFullYear(),
                date.getMonth(),
                1
            ).getDay();
            const lastDate = new Date(
                date.getFullYear(),
                date.getMonth() + 1,
                0
            ).getDate();

            for (let i = 0; i < firstDay; i++) {
                calendarDays.append("<div></div>");
            }

            for (let i = 1; i <= lastDate; i++) {
                const dateDiv = $(`<div>${i}</div>`);
                dateDiv.click(() => selectDate(date.getFullYear(), date.getMonth(), i));
                calendarDays.append(dateDiv);
            }

            calendar.append(calendarDays);
            updateCalendar();
        }

        function selectDate(year, month, day) {
            const date = new Date(year, month, day);

            if (selectedDates.length === 2) {
                selectedDates = [];
            }

            selectedDates.push(date);

            if (selectedDates.length === 2 && selectedDates[0] > selectedDates[1]) {
                selectedDates.reverse();
            }

            if (selectedDates.length === 2) {
                const allDates = getAllDates(selectedDates[0], selectedDates[1]);
                selectedDates = allDates;
            }

            updateCalendar();
        }

        function updateCalendar() {
            const calendarDays = $("#calendar-days").children();
            calendarDays.removeClass("selected range");

            if (selectedDates.length > 0) {
                const startDate = selectedDates[0];
                const startDayIndex = startDate.getDate() + new Date(startDate.getFullYear(), startDate.getMonth(), 1)
                    .getDay() - 1;
                $(calendarDays[startDayIndex]).addClass("selected");

                if (selectedDates.length > 1) {
                    for (let i = 1; i < selectedDates.length - 1; i++) {
                        const date = selectedDates[i];
                        const dayIndex = date.getDate() + new Date(date.getFullYear(), date.getMonth(), 1).getDay() - 1;
                        $(calendarDays[dayIndex]).addClass("range");
                    }
                    const endDate = selectedDates[selectedDates.length - 1];
                    const endDayIndex = endDate.getDate() + new Date(endDate.getFullYear(), endDate.getMonth(), 1)
                        .getDay() - 1;
                    $(calendarDays[endDayIndex]).addClass("selected");
                }
            }
        }

        function getAllDates(startDate, endDate) {
            const dates = [];
            let currentDate = new Date(startDate);
            while (currentDate <= endDate) {
                dates.push(new Date(currentDate));
                currentDate.setDate(currentDate.getDate() + 1);
            }
            return dates;
        }

        function formatDate(date) {
            const month = (date.getMonth() + 1).toString().padStart(2, "0");
            const day = date.getDate().toString().padStart(2, "0");
            const year = date.getFullYear();
            return `${year}-${day}-${month}`;
        }

        function getMonthName(date) {
            return date.toLocaleString("default", {
                month: "long"
            });
        }

        $("#destination").on("input", function() {
            let query = $(this).val();
            if (query.length >= 1) {
                searchCities(query);
            } else {
                $('#searchResults').empty(); // Clear results if query is too short
            }
        });

        function searchCities(query) {
            $.ajax({
                url: "{{ route('search.cities') }}",
                type: 'GET',
                data: {
                    query: query
                },
                success: function(data) {
                    displaySearchResults(data);
                },
                error: function(xhr, status, error) {
                    console.error("Error fetching cities:", error);
                }
            });
        }

        function displaySearchResults(cities) {
            let resultsContainer = $('#searchResults');
            resultsContainer.empty(); // Clear any existing results

            cities.forEach(city => {
                let cityItem = $(`
                <li>
                    <div>
                        <span class="city-name">${city.city_name}</span>
                    </div>
                </li>
            `).click(function() {
                    $('#destination').val(city.city_name);
                    $('#cityId').val(city.id);
                    resultsContainer.empty();
                });

                resultsContainer.append(cityItem);
            });
        }

        $("form").on("submit", function(e) {
            e.preventDefault();

            const formattedDates = selectedDates.map((date) => formatDate(date));
            const numberOfDays = selectedDates.length;
            const monthName = getMonthName(selectedDates[0]);

            const formData = {
                tourName: $("#tripName").val(),
                city: $("#destination").val(),
                cityId: $("#cityId").val(),
                selectedDates: formattedDates,
                monthName: monthName,
                numberOfDays: numberOfDays,
            };
            const queryString = $.param(formData);
            const url = "http://127.0.0.1:8000/userPlan?" + queryString;

            $.ajax({
                url: $(this).attr("action"),
                type: "GET",
                data: formData,
                success: function(response) {

                    window.location.href = url;
                    $("#sidebar").removeClass("wide");
                    $("#overlay").removeClass("show");
                },
                error: function(xhr, status, error) {
                    console.error("Error creating trip:", error);
                },
            });
        });
    }

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

        var fetchUrl =
            `/pages/tour/fetch?page=${page}&sort_by=${sortBy}&min_price=${minPrice}&max_price=${maxPrice}&cities=${cities.join(',')}&categories=${categories.join(',')}`;

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
            const categories = tour.categories.join(', ');
            html += `
            <div class="tour-two__single tour-one__single">
                <div class="tour-two__image-wrap">
                    <div class="tour-one__image">
                        ${tour.image ? `<img src="/uploads/post_images/${tour.image}" alt="">` : `<img src="{{ asset('assets/images/default/post-default.webp') }}" alt="Default Image">`}
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
                        <li><a href="/tour-details/${tour.id}"><i class="far fa-clock"></i> ${tour.total_number_of_days} Days</a></li>
                      
                        <li><a href="/tour-details/${tour.id}"><i class="fa fa-tag"></i> ${categories}</a></li>
                        <li><a href="/tour-details/${tour.id}"><i class="far fa-map"></i> ${tour.city.city_name}</a></li>
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
                `<a href="#" onclick="fetchTours(${previousPage}); return false;"><i class="fa fa-angle-left"></i></a>`;
        }

        for (let page = 1; page <= last_page; page++) {
            html +=
                `<a href="#" class="${page === current_page ? 'active' : ''}" onclick="fetchTours(${page}); return false;">${page.toString().padStart(2, '0')}</a>`;
        }

        if (nextPage) {
            html +=
                `<a href="#" onclick="fetchTours(${nextPage}); return false;"><i class="fa fa-angle-right"></i></a>`;
        }

        $('#pagination').html(html);
    }
</script>
