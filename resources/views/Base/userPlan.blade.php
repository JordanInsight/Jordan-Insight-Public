@extends('layout.base')
@section('ajax_scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@endsection

@section('content')
    <style>
        .itinerary {
            width: 80%;
            margin: 20px auto;
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }

        h3,h2{
            font-family: var(--thm-font);
            
        }

        .dates {
            display: flex;
            justify-content: flex-start;
            gap: 15px;
            margin-bottom: 20px;
        }

        .date-btn {
            padding: 10px 20px;
            border: none;
            border-radius: 25px;
            background-color: #ffa801;
            color: #fff;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .date-btn:hover {
            background-color: #e68901;
        }

        .day {
            border-bottom: 1px solid #dee2e6;
            padding: 10px 0;
        }

        .day-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            cursor: pointer;
            padding: 10px;
            background-color: #e9ecef;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .day-header:hover {
            background-color: #dee2e6;
        }

        .day-header h3 {
            margin: 0;
            font-size: 1.2em;
            color: #343a40;
        }

        .day-header a {
            color: #ffa801;
            text-decoration: none;
            font-size: 0.9em;
        }

        .day-header a:hover {
            text-decoration: underline;
        }

        .day-header .arrow {
            font-size: 1.5em;
            color: #343a40;
        }

        .day-content {
            display: none;
            margin-top: 10px;
            padding: 10px;
            background-color: #f8f9fa;
            border-radius: 5px;
        }

        .details-container {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .vertical-line {
            width: 20px;
            height: 100%;
            border-left: 2px solid #343a40;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .circle-icon {
            background-color: #fff;
            border: 2px solid #343a40;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: absolute;
            top: -12.5px;
            /* Center the circle on the line */
        }

        .circle-icon i {
            color: #343a40;
        }

        .details-box {
            background-color: #fff;
            border: 1px solid #dee2e6;
            border-radius: 5px;
            padding: 10px;
            margin-left: 10px;
            flex: 1;
        }

        .details-box p {
            margin: 0;
            font-size: 0.9em;
            color: #343a40;
        }

        .add-btn {
            background-color: #ffa801;
            color: #fff;
            border: none;
            border-radius: 25px;
            padding: 8px 15px;
            cursor: pointer;
            font-size: 1em;
            transition: background-color 0.3s ease;
            margin-bottom: 10px;
        }

        .add-btn:hover {
            background-color: #e68901;
        }

        .button-row {
            display: none;
            margin: 10px 0;
            text-align: left;
        }

        .icon-btn {
            background: #fff;
            border: 2px solid #ced4da;
            border-radius: 50%;
            padding: 10px;
            margin: 0 5px;
            cursor: pointer;
            transition: background-color 0.3s ease, border-color 0.3s ease;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            position: relative;
        }

        .icon-btn i {
            font-size: 1.2em;
            color: #343a40;
        }

        .icon-btn:hover {
            background-color: #e9ecef;
            border-color: #adb5bd;
        }

        /* Tooltip styles */
        .icon-btn::after {
            content: attr(data-tooltip);
            position: absolute;
            bottom: 150%;
            left: 50%;
            transform: translateX(-50%);
            background-color: #343a40;
            color: #fff;
            padding: 5px 8px;
            border-radius: 5px;
            white-space: nowrap;
            font-size: 0.8em;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.3s;
        }

        .icon-btn:hover::after {
            opacity: 1;
        }

        .close-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            transition: background-color 0.3s ease;
        }

        .close-btn:hover {
            background-color: #c82333;
        }

        /* Overlay styles */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            /* Darker background */
            display: none;
            /* Hide by default */
            z-index: 1000;
            cursor: pointer;
            /* Make the overlay clickable */
        }

        /* Sidebar styles */
        .overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            /* Darker background */
            display: none;
            z-index: 1000;
            cursor: pointer;
        }

        .sidebar {
            position: fixed;
            top: 0;
            right: 0;
            width: 400px;
            height: 100%;
            background: #fff;
            box-shadow: -2px 0 10px rgba(0, 0, 0, 0.1);
            transform: translateX(100%);
            transition: transform 0.3s ease;
            z-index: 1001;
            display: flex;
            flex-direction: column;
            border-radius: 10px 0 0 10px;
        }

        .sidebar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            background: #e9ecef;
            border-bottom: 1px solid #dee2e6;
            border-radius: 10px 0 0 0;
        }

        .sidebar-header h2 {
            margin: 0;
            font-size: 1.5em;
            color: #343a40;
        }

        .sidebar-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .card {
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            display: flex;
            align-items: center;
            padding: 16px;
            max-width: 300px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            margin-bottom:15px 
        }

        .card img {
            width: 100px;
            height: 100px;
            background-color: #f0f0f0;
            border-radius: 4px;
            margin-right: 16px;
        }

        .card-content {
            display: flex;
            flex-direction: column;
        }

        .card-content h3 {
            margin: 0;
            font-size: 18px;
            color: #333;
        }

        .card-content p {
            margin: 4px 0;
            font-size: 14px;
            color: #666;
        }

        .card-content .rating {
            display: flex;
            align-items: center;
            margin-top: 8px;
        }

        .card-content .rating span {
            margin-left: 4px;
            font-size: 14px;
            color: #666;
        }

        .icon {
            font-size: 16px;
            color: #666;
        }

        .card.selected {
            border: 2px solid #ffa801;
        }


        .addActivity-btn {
            background-color: #ffa801;
            color: #fff;
            border: none;
            border-radius: 25px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 1em;
            text-align: center;
            margin: 20px auto 0 auto;
            display: block;
            transition: background-color 0.3s ease;
        }

        .addActivity-btn:hover {
            background-color: #e68901;
        }
    </style>
    <section class="page-header"
        style="background-image: url('{{ asset('assets/images/backgrounds/page-header-contact.png') }}');">
        <div class="container">
            <h2>Tours with Sidebar</h2>
            <ul class="thm-breadcrumb list-unstyled">
                <li><a href="index.html">Home</a></li>
                <li><span>Tours</span></li>
            </ul>
        </div>
    </section>

    <div class="itinerary">
        <div class="dates">
            @for ($i = 0; $i < $numberOfDays; $i++)
                <button id="day{{ $i + 1 }}-btn" class="date-btn">Day {{ $i + 1 }}</button>
            @endfor
        </div>
        @for ($i = 0; $i < $numberOfDays; $i++)
            <div id="day{{ $i + 1 }}" class="day">
                <div class="day-header">
                    <h3>Day {{ $i + 1 }}</h3>
                    <span class="arrow">&#9660;</span>
                </div>
                <div class="day-content">
                    <div class="details-container">
                        <div class="vertical-line">
                            <div class="circle-icon">
                                <i class="fas fa-plus"></i>
                            </div>
                        </div>
                        <div class="details-box" id="details-box-day{{ $i + 1 }}">
                            <!-- Activities will be rendered here -->
                            <p>
                                Add from your saves or search for items on Tripadvisor to build your day.
                            </p>
                        </div>
                    </div>
                    <button class="add-btn">+ Add</button>
                    <div class="button-row">
                        <button class="icon-btn activity-btn" data-tooltip="Activity"><i class="fas fa-hotel"></i></button>
                        <button class="icon-btn food-btn" data-tooltip="Food"><i class="fas fa-utensils"></i></button>
                        <button class="icon-btn historicalSite-btn" data-tooltip="historicalSite"><i
                                class="fas fa-map-marker-alt"></i></button>
                        <button class="icon-btn" data-tooltip="Close"><i class="fas fa-times"></i></button>
                    </div>
                </div>
            </div>
        @endfor
        <form action="javascript:void(0)" method="POST" id="submitTourForm">
            <input type="submit"  class ="date-btn" value="Finish Tour" style="margin-top:10px ">
        </form>
    </div>




    <div id="sidebar" class="sidebar">
        <div class="sidebar-content">
            <span id="closeSidebar" class="close-btn">&times;</span>
            <button class="close-btn" onclick="closeSidebar()">
                <i class="fas fa-times"></i>
            </button>
            <div class="sidebar-header">
                <h2 id="sidebar-title"></h2>
            </div>
            <div class="sidebar-content" id="sidebar-content">
                <!-- Dynamic content will be inserted here -->
            </div>
        </div>

    </div>
    <div id="overlay" class="overlay"></div>


    <script type="module">
        function toggleDay(dayId) {
            const day = $("#" + dayId);
            const content = day.find(".day-content");
            const arrow = day.find(".arrow");

            if (content.is(":visible")) {
                content.slideUp();
                arrow.html("&#9660;");
            } else {
                content.slideDown();
                arrow.html("&#9650;");
            }
        }

        $(document).ready(function() {
            const LOCAL_STORAGE_KEY = 'planActivities';
            const BASE_URL = "http://127.0.0.1:8000/userPlan";
            let selectedActivity = null;
            const totalDays = {{ $numberOfDays }};
            let planActivities = loadFromLocalStorage();

            $.ajaxSetup({
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
            });

            initialize();

            function setupDayButtons(numberOfDays) {
                for (let i = 1; i <= numberOfDays; i++) {
                    $(`#day${i}-btn`).click(function() {
                        toggleDay(`day${i}`);
                    });
                }
            }

            $(".day-header").click(function() {
                const dayId = $(this).closest(".day").attr("id");
                toggleDay(dayId);
            });

            $(".add-btn").click(function() {
                $(this).hide();
                $(this).siblings(".button-row").show();
            });

            $(".close-btn").click(function() {
                $(this).closest(".button-row").hide();
                $(this).closest(".day-content").find(".add-btn").show();
            });

            window.openSidebar = function(content, dayId) {
                $("#overlay").fadeIn();
                $("#sidebar").css("transform", "translateX(0)");
                $("#sidebar-title").text(content);
                $("#sidebar").data("day-id", dayId); // Store the day ID in the sidebar
            };

            window.closeSidebar = function() {
                $("#overlay").fadeOut();
                $("#sidebar").css("transform", "translateX(100%)");
            };

            $("#overlay").click(function() {
                closeSidebar();
            });

            function loadFromLocalStorage() {
                const savedActivities = localStorage.getItem(LOCAL_STORAGE_KEY);
                return savedActivities ? JSON.parse(savedActivities) : Array(totalDays).fill([]).map(() => []);
            }

            function saveToLocalStorage(activities) {
                localStorage.setItem(LOCAL_STORAGE_KEY, JSON.stringify(activities));
            }

            function renderStars(rating) {
                let stars = '';
                for (let i = 0; i < 5; i++) {
                    stars += i < rating ? '<span class="icon">⭐</span>' : '<span class="icon">☆</span>';
                }
                return stars;
            }

            function renderActivities(day) {
                const dayContainer = $(`#details-box-day${day}`);
                dayContainer.empty(); // Clear any existing activities

                const activitiesForDay = planActivities[day - 1]; // Adjust to zero-indexed array

                activitiesForDay.forEach(activity => {
                    const name = activity.restaurant_name || activity.site_name || activity.activity_name ||
                        'Unnamed Activity';
                    const description = activity.description || 'No description available';
                    const imagePath = window.location.origin + '/uploads/' + (activity.restaurant_name ?
                            'Restaurant' : activity.site_name ? 'HistoricalSite' : 'activities') + '/' +
                        activity.image;

                    const activityCard = $(`
                        <div class="card">
                            <img src="${imagePath}" alt="${name}">
                            <div class="card-content">
                                <h3>${name}</h3>
                                <p>${description}</p>
                            </div>
                        </div>
                    `);

                    dayContainer.append(activityCard);
                });
            }

            function addActivityToDay(day, activity) {
                planActivities[day - 1].push(activity); // Adjust to zero-indexed array
                saveToLocalStorage(planActivities);
                renderActivities(day);
                closeSidebar();
            }

            function initialize() {
                planActivities = loadFromLocalStorage();
                setupDayButtons(totalDays);

                for (let i = 1; i <= totalDays; i++) {
                    renderActivities(i);
                }

                // Add event listener for .add-btn to open the sidebar with appropriate content
                $(".add-btn").click(function() {
                    const dayId = $(this).closest(".day").attr("id").replace('day', '');
                    // openSidebar('Add Activity for Day ' + dayId, dayId);
                });

                // Set up the event listeners for the buttons inside the sidebar
                $(document).on('click', '.food-btn', function() {
                    let route = `${BASE_URL}/city/restaurants/${@json($city->id)}`;
                    const dayId = $(this).closest('.day').attr('id').replace('day', '');
                    openSidebar('Food', dayId);
                    loadSidebarContent(route, 'restaurant');
                });

                $(document).on('click', '.activity-btn', function() {
                    let route = `${BASE_URL}/city/activities/${@json($city->id)}`;
                    const dayId = $(this).closest('.day').attr('id').replace('day', '');
                    openSidebar('Adventure', dayId);
                    loadSidebarContent(route, 'Adventure');
                });

                $(document).on('click', '.historicalSite-btn', function() {
                    let route = `${BASE_URL}/city/historicalSites/${@json($city->id)}`;
                    const dayId = $(this).closest('.day').attr('id').replace('day', '');
                    openSidebar('Historical Sites', dayId);
                    loadSidebarContent(route, 'historicalSite');
                });

                $(document).on('click', '#confirmAddActivityBtn', function() {
                    const dayId = $("#sidebar").data("day-id");
                    if (dayId) {
                        if (selectedActivity) {
                            addActivityToDay(parseInt(dayId), selectedActivity);
                            selectedActivity = null;
                        } else {
                            console.log('No activity selected');
                        }
                    } else {
                        console.log('Could not determine the selected day.');
                    }

                });
            }

            function loadSidebarContent(url, type) {
                function renderStars(rating) {
                    let stars = '';
                    for (let i = 0; i < 5; i++) {
                        stars += i < rating ? '<span class="icon">⭐</span>' : '<span class="icon">☆</span>';
                    }
                    return stars;
                }

                $.ajax({
                    url: url,
                    method: 'GET',
                    success: function(response) {
                        $('#sidebar-content').html('');
                        let items = [];
                        switch (type) {
                            case 'restaurant':
                                items = response.restaurants;
                                break;
                            case 'historicalSite':
                                items = response.sites;
                                break;
                            case 'Adventure':
                                items = response.activities;
                                break;
                                // Add cases for other content types as needed
                        }

                        items.forEach(item => {
                            const card = $(`
        <div class="card">
            <img src="${window.location.origin + '/uploads/' + (type === 'restaurant' ? 'Restaurant' : type === 'historicalSite' ? 'HistoricalSite' : 'activities') + '/' + item.image}" alt="${item.restaurant_name || item.site_name || item.activity_name}">
            <div class="card-content">
                <h3>${item.restaurant_name || item.site_name || item.activity_name}</h3>
                <p>${item.cuisine || item.description }</p>
                <div class="rating">${renderStars(item.rating)}</div>
            </div>
        </div>
    `);

                            $('#sidebar-content').append(card);

                            card.click(function() {
                                $('.card').removeClass('selected');
                                card.addClass('selected');
                                selectedActivity = item;
                            });
                        });

                        $('#sidebar-content').append(
                            '<button id="confirmAddActivityBtn" class="addActivity-btn">Add Activity</button>'
                        );
                    },
                    error: function() {
                        $('#sidebar-content').html('<p>Failed to load content.</p>');
                    }
                });
            }

            $('#submitTourForm').submit(function(event) {
                event.preventDefault();
                const route = "http://127.0.0.1:8000/userPlan/createNewTour";
                $.ajax({
                    url: route,
                    type: 'POST',
                    data: {
                        tourDetails: planActivities,
                        month: "{{ $monthName }}",
                        selectedDays: @json($selectedDates),
                        tourName: "{{ $tourName }}",
                    },
                    success: function(response) {
                        // Clear planActivities from local storage
                        localStorage.removeItem('planActivities');

                        // Redirect to the provided URL
                        window.location.href = response.redirectUrl;
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error creating tour:', textStatus, errorThrown);
                    }
                });
            });

        });
    </script>
@endsection
