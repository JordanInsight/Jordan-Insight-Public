@extends('layout.base')
@section('ajax_scripts')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@endsection
@section('content')
    <section class="trip-plan-section">
        <div class="card mt-3" style="border-radius: 10px; background-color: #e0f2f1">
            <div class="card-header" style="background-color: #ffffff">
                <h5 class="card-title" style="font-family: 'Roboto', sans-serif; font-weight: bold; color: #2b2b2b;">
                    @if (isset($numberOfDays))
                        <p style="font-size: 1.1em;">Number of Days Selected: <strong>{{ $numberOfDays }}</strong></p>
                        <h3 id="currentDay" style="font-size: 1.5em; margin-top: 0.5em;">Day 1:</h3>
                    @endif
                </h5>
            </div>
            <div id="loading" class="d-none text-center" style="margin: 20px 0;">
                <div class="spinner-border text-primary" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
                <p>Loading data, please wait...</p>
            </div>

            <div class="card-body">
                <form action="javascript:void(0)" method="POST" id="tripPlanForm">
                    @csrf
                    <input type="hidden" id="cityData" value="{{ json_encode($city) }}">
                    <div class="form-row">
                        <div class="form-group col-md-4 mb-3">
                            <label for="categories" style="font-weight: bold;">Trip Type</label>
                            <i class="fas fa-suitcase mr-2" style="color: #428bca" aria-hidden="true"></i>
                            <select name='category' class="selectpicker form-control" id="categories"
                                data-live-search="true">
                                <option value="">Select Trip Type</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-md-4 mb-3" id="cuisineSelect" style="display: none;">
                            <label for="restaurant" style="font-weight: bold;">Restaurants cuisines <small>(Choose
                                    three)</small></label>
                            <i class="fas fa-utensils mr-2" style="color: #428bca" aria-hidden="true"></i>
                            <div id="cuisines"></div>
                        </div>
                        <div class="form-group col-md-4 mb-3" id="historicalSitesSelect" style="display: none;">
                            <label for="historicalSites" style="font-weight: bold;">Historical Sites</label>
                            <i class="fas fa-monument mr-2" style="color: #428bca" aria-hidden="true"></i>
                            <div id="historicalSites"></div>
                        </div>
                        <div class="form-group col-md-4 mb-3" id="restaurants" style="display: none;">
                            <label for="restaurant" style="font-weight: bold;">Restaurants</label>
                            <i class="fas fa-utensils mr-2" style="color: #428bca" aria-hidden="true"></i>
                            <div id="restaurantsList"></div>
                        </div>
                    </div>
                    <div id="progress-bar-container" style="display: none;">
                        <div id="progress-bar"></div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="submitDayBtn">Submit Day</button>
                    <button type="button" class="btn btn-secondary" id="addActivityBtn">Add Activity</button>
                </form>

                <div id="activityList">
                    <h5 style="font-weight: bold;">Activities for <span id="activityDay">Day 1:</span></h5>
                    <ul id="activities" class="list-group"></ul>
                </div>

                <div id="allActivities"></div>
            </div>
        </div>
    </section>



    <div class="modal fade" id="editActivityModal" tabindex="-1" role="dialog" aria-labelledby="editActivityModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editActivityModalLabel" style="font-weight: bold;">Edit Activity</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="editCategories" style="font-weight: bold;">Trip Type</label>
                        <select name="editCategory" class="form-control" id="editCategories">
                            <option value="">Select Trip Type</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group" id="editCuisineSelect" style="display: none;">
                        <label for="editCuisines" style="font-weight: bold;">Restaurants cuisines</label>
                        <div id="editCuisines"></div>
                    </div>
                    <div class="form-group" id="editHistoricalSitesSelect" style="display: none;">
                        <label for="editHistoricalSites" style="font-weight: bold;">Historical Sites</label>
                        <div id="editHistoricalSites"></div>
                    </div>
                    <div class="form-group" id="editRestaurants" style="display: none;">
                        <label for="editRestaurant" style="font-weight: bold;">Restaurants</label>
                        <div id="editRestaurantsList"></div>
                    </div>
                    <button type="button" class="btn btn-primary" id="saveEditButton"
                        style="background-color: #ffb74d; border-color: #ffb74d;">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        .trip-plan-section .card-header {
            background-color: #ffffff;
        }

        .trip-plan-section .form-group label {
            color: #2b2b2b;
            font-weight: bold;
        }

        .trip-plan-section .form-group i {
            color: #428bca;
        }

        .trip-plan-section .btn-primary {
            background-color: #ffb74d;
            border-color: #ffb74d;
        }

        .trip-plan-section .btn-primary:hover {
            background-color: #ffa726;
            border-color: #ffa726;
        }

        .trip-plan-section .btn-secondary {
            background-color: #4fc3f7;
            border-color: #4fc3f7;
        }

        .trip-plan-section .btn-secondary:hover {
            background-color: #29b6f6;
            border-color: #29b6f6;
        }

        .trip-plan-section .card-body {
            padding: 20px;
        }

        .dropdown-menu>.dropdown-item:hover,
        .dropdown-menu>.dropdown-item:focus {
            background-color: #ffa726 !important;
            color: #fff !important;
        }

        .bootstrap-select .dropdown-menu li a {
            color: #333;
        }

        .bootstrap-select .dropdown-menu li a:hover {
            background-color: #ffa726 !important;
            color: #fff !important;
        }

        .bootstrap-select .dropdown-menu .selected {
            background-color: #ffa726 !important;
            color: #fff !important;
        }

        #activityList {
            background-color: #e0f2f1;
            border-radius: 10px;
            padding: 15px;
        }

        .list-group-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .list-group-item button {
            background-color: #4fc3f7;
            border: none;
            padding: 5px 10px;
            color: white;
            border-radius: 5px;
        }

        .day-activities {
            margin-top: 20px;
        }

        .day-activities h5 {
            font-weight: bold;
            color: #2b2b2b;
        }
    </style>
    <script src="{{ asset('assets/js/userPlan/userPlan.js') }}" type="module"></script>


    <script type="module">
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let currentDay = 1;
            const totalDays = {{ $numberOfDays }};
            let tripData = {};

            $('#tripPlanForm').submit(function(event) {
                event.preventDefault();
                saveActivity();
                if (currentDay < totalDays) {
                    currentDay++;
                    $('#currentDay').text(`Day ${currentDay}:`);
                    resetForm();
                } else {
                    completeTripPlanning();
                }
            });

            $('#addActivityBtn').click(function() {
                saveActivity();
                resetForm();
            });

            function saveActivity() {
                let formData = collectFormData();

                if (!tripData[`day${currentDay}`]) {
                    tripData[`day${currentDay}`] = [];
                }

                tripData[`day${currentDay}`].push(formData);
                updateActivitiesList();
            }

            function collectFormData() {
                let formData = {};

                $('input, select').each(function() {
                    const name = $(this).attr('name');
                    if (shouldIncludeField(name)) {
                        if ($(this).is(':checkbox')) {
                            if ($(this).is(':checked')) {
                                addValue(formData, name, $(this).val());
                            }
                        } else {
                            addValue(formData, name, $(this).val());
                        }
                    }
                });

                return formData;
            }

            function addValue(formData, name, value) {
                if (!formData[name]) {
                    formData[name] = [];
                }
                formData[name].push(value);
            }

            function shouldIncludeField(name) {
                const excludedFields = ['uri', 'ip', 'method', 'datasets-switcher', 'cuisines', 'search'];
                return name && !name.startsWith('_') && !excludedFields.includes(name);
            }

            function resetForm() {
                $('#tripPlanForm')[0].reset();
                resetUI();
            }

            function resetUI() {
                $('#categories').val('').selectpicker('refresh');
                $("#cuisines").empty();
                $("#cuisineSelect").hide();
                $("#historicalSites").empty();
                $("#historicalSitesSelect").hide();
                $("#restaurantsList").empty();
                $("#restaurants").hide();
            }

            function updateActivitiesList() {
                $("#activities").empty();
                if (tripData[`day${currentDay}`]) {
                    tripData[`day${currentDay}`].forEach((activity, index) => {
                        const activityHtml = `
                    <li class="list-group-item">
                        <strong>Day ${currentDay}:</strong>
                        <p>Category: ${activity.category ? activity.category.join(", ") : ''}</p>
                        ${activity.cuisines && activity.cuisines.length > 0 ? `<p>Cuisines: ${activity.cuisines.join(", ")}</p>` : ""}
                        ${activity.historicalSites && activity.historicalSites.length > 0 ? `<p>Historical Sites: ${activity.historicalSites.join(", ")}</p>` : ""}
                        ${activity.restaurants && activity.restaurants.length > 0 ? `<p>Restaurants: ${activity.restaurants.join(", ")}</p>` : ""}
                        <button type="button" class="btn btn-danger btn-sm delete-activity" data-day="${currentDay}" data-index="${index}">Delete</button>
                    </li>
                `;
                        $("#activities").append(activityHtml);
                    });
                }

                $(".delete-activity").click(function() {
                    const day = $(this).data("day");
                    const index = $(this).data("index");
                    deleteActivity(day, index);
                });
            }

            function deleteActivity(day, index) {
                tripData[`day${day}`].splice(index, 1);
                updateActivitiesList();
            }

            function submitTourDetails(allDaysData) {
                const route = "http://127.0.0.1:8000/userPlan/createNewTour";
                $.ajax({
                    url: route,
                    type: 'POST',
                    data: {
                        tourDetails: allDaysData,
                        month: "{{ $monthName }}",
                        selectedDays: @json($selectedDates),
                        tourName: "{{ $tourName }}",
                    },
                    success: function(response) {
                        window.location.href = response.redirectUrl;
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error creating tour:', textStatus, errorThrown);
                    }
                });
            }

            function retrieveAllDaysData() {
                let allDaysData = [];
                for (let i = 1; i <= totalDays; i++) {
                    allDaysData.push(tripData[`day${i}`] || []);
                }
                return allDaysData;
            }

            function completeTripPlanning() {
                let allDaysData = retrieveAllDaysData();
                submitTourDetails(allDaysData);
            }
        });
    </script>
@endsection
