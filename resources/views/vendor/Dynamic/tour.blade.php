@extends('layout.vendorbase')
@section('title', 'Tour')
@section('content')
    @include('partials._sidebarVendor')
    <div class="page-wrapper">
        <div class="page-content">
            <div id="message" class="alert" style="display: none;"></div>
            <h2 class="card-title">Tour</h2>
            <x-add-element-button element="Tour" onclick="showAddTourModal()" />
            <x-data-table>
                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>Tour Name</th>
                        <th>Description</th>
                        <th>Budget</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Number of People</th>
                        <th>Created By</th>
                        <th>Image</th>
                        <th>Show Details</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody class="text-center"></tbody>
            </x-data-table>
        </div>
    </div>

    <!-- Add Tour Modal -->
    <x-modal id="addTourModal" class="Addservice" title="Add Tour" action="javascript:void(0)" formId="addTourForm"
        enctype="multipart/form-data">
        @method('POST')
        <form id="addTourForm">
            <x-input-field name="tour_name" label="Tour Name" id="tourName" />
            <x-textarea-field name="description" label="Description" id="description" />
            <x-input-field name="budget" label="Budget" id="budget" />
            <x-input-field name="start_date" label="Start Date" id="startDate" type="date" />
            <x-input-field name="end_date" label="End Date" id="endDate" type="date" />
            <x-input-field name="number_of_people" label="Number of People" id="numberOfPeople" type="number" />
            <x-input-field name="image" label="Image" id="image" type="file" />
            <x-input-field name="days" label="Number of Days" id="numberOfDays" type="number" />
            <button type="button" class="btn btn-primary" onclick="nextStep()">Next</button>
        </form>
    </x-modal>

    <!-- Specify Days Modal -->
    <x-modal id="specifyDaysModal" class="Addservice" title="Specify Days" action="javascript:void(0)"
        formId="specifyDaysForm">
        <div id="daysContainer"></div>
        <button type="button" class="btn btn-primary" onclick="finishTour()">Finish</button>
    </x-modal>

    <!-- Edit Tour Modal -->
    <x-modal id="editTourModal" class="Addservice" title="Edit Tour" action="javascript:void(0)" formId="editTourForm"
        enctype="multipart/form-data" :submitButton="''">
        @method('PUT')
        <form id="editTourForm">
            <x-input-field name="tour_name" label="Tour Name" id="editTourName" />
            <x-textarea-field name="description" label="Description" id="editDescription" />
            <x-input-field name="budget" label="Budget" id="editBudget" />
            <x-input-field name="start_date" label="Start Date" id="editStartDate" type="date" />
            <x-input-field name="end_date" label="End Date" id="editEndDate" type="date" />
            <x-input-field name="number_of_people" label="Number of People" id="editNumberOfPeople" type="number" />
            <x-input-field name="image" label="Image" id="editImage" type="file" />
            <button type="button" class="btn btn-primary" onclick="addEditDay()">Add Day</button>
            <div id="editDaysContainer"></div>
            <button type="button" class="btn btn-primary" onclick="finishEditTour()">Save</button>
        </form>
    </x-modal>

    <!-- Show Details Modal -->
    <x-modal id="tourDetailsModal" class="Addservice" title="Tour Details" action="javascript:void(0)"
        formId="tourDetailsForm">
        <div class="modal-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tour Name</th>
                        <th>Description</th>
                        <th>Budget</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Number of People</th>
                        <th>Created By</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody id="tourDetailsTableBody">
                    <!-- Tour details will be injected here -->
                </tbody>
            </table>
            <h4>Days and Activities</h4>
            <div id="tourDaysDetails">
                <!-- Tour days and activities will be injected here -->
            </div>
        </div>
    </x-modal>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const categories = @json($categories);

        window.routes = {
            fetchTours: "{{ route('vendor.tour.fetch') }}",
            addTour: "{{ route('vendor.tour.store') }}",
            editTour: "{{ route('vendor.tour.update', '') }}/",
            showTour: "{{ route('vendor.tour.show', '') }}/"
        };

        window.showAddTourModal = function() {
            $('#addTourForm')[0].reset();
            $('#addTourModal').modal('show');
        }

        window.nextStep = function() {
            let budget = parseFloat($('#budget').val());
            if (isNaN(budget) || budget < 0) {
                showMessage('Please enter a valid budget amount.', 'alert-danger');
                return;
            }

            let startDate = new Date($('#startDate').val());
            let endDate = new Date($('#endDate').val());
            let totalDays = parseInt($('#numberOfDays').val());

            let dateDiff = (endDate - startDate) / (1000 * 60 * 60 * 24) + 1; 

            if (totalDays > dateDiff) {
                showMessage('Number of days cannot be more than the difference between the start and end dates.', 'alert-danger');
                return;
            }

            $('#addTourModal').modal('hide');
            $('#specifyDaysModal').modal('show');
            generateDaysForm(totalDays);
        }

        function generateDaysForm(totalDays) {
            $('#daysContainer').empty();
            for (let i = 1; i <= totalDays; i++) {
                $('#daysContainer').append(`
                    <div id="day_${i}">
                        <h5>Day ${i}</h5>
                        <button type="button" class="btn btn-secondary" onclick="addActivity(${i})">Add Activity</button>
                        <div id="activitiesContainer_${i}"></div>
                        <hr>
                    </div>
                `);
            }
        }

        window.addActivity = function(day) {
            const categoryOptions = categories.map(category =>
                `<option value="${category.id}">${category.category_name}</option>`).join('');

            const activityTypeSelectId = `activityType_${day}_${Date.now()}`;
            const referableIdSelectId = `referable_id_${day}_${Date.now()}`;
            const referableTypeId = `referable_type_${day}_${Date.now()}`;

            $('#activitiesContainer_' + day).append(`
                <div class="activity">
                    <div class="mb-3">
                        <label for="${activityTypeSelectId}" class="form-label">Activity Type:</label>
                        <select id="${activityTypeSelectId}" name="activity_type_${day}[]" class="form-select form-select-lg mb-3">
                            ${categoryOptions}
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="${referableIdSelectId}" class="form-label">Activity:</label>
                        <select id="${referableIdSelectId}" name="referable_id_${day}[]" class="form-select form-select-lg mb-3"></select>
                    </div>
                    <div class="mb-3">
                        <label for="additional_details_${day}[]" class="form-label">Additional Details:</label>
                        <input type="text" id="additional_details_${day}_${Date.now()}" name="additional_details_${day}[]" class="form-control" />
                    </div>
                    <input type="hidden" id="${referableTypeId}" name="referable_type_${day}[]" value="" />
                </div>
            `);

            $(`#${activityTypeSelectId}`).change(function() {
                fetchReferableEntities(day, $(`#${activityTypeSelectId}`).val(), referableIdSelectId, referableTypeId);
            });
        }

        function fetchReferableEntities(day, categoryId, referableIdSelectId, referableTypeId) {
            let url = '';
            if (categoryId == 1) { // Adventure
                url = `/vendor/activities`;
            } else if (categoryId == 2) { // Historical Site
                url = `/vendor/historical-sites`;
            } else if (categoryId == 3) { // Culinary
                url = `/vendor/restaurants`;
            }

            $.get(url, function(response) {
                let options = '';
                if (categoryId == 1) {
                    response.activities.forEach(activity => {
                        options += `<option value="${activity.id}">${activity.activity_name}</option>`;
                    });
                    $(`#${referableTypeId}`).val('App\\Models\\Activity');
                } else if (categoryId == 2) {
                    response.historicalSites.forEach(site => {
                        options += `<option value="${site.id}">${site.site_name}</option>`;
                    });
                    $(`#${referableTypeId}`).val('App\\Models\\HistoricalSite');
                } else if (categoryId == 3) {
                    response.restaurants.forEach(restaurant => {
                        options += `<option value="${restaurant.id}">${restaurant.restaurant_name}</option>`;
                    });
                    $(`#${referableTypeId}`).val('App\\Models\\Restaurant');
                }
                $(`#${referableIdSelectId}`).html(options);
            });
        }

        window.finishTour = function() {
            const tourData = new FormData($('#addTourForm')[0]);
            const daysData = new FormData($('#specifyDaysForm')[0]);

            const combinedData = new FormData();
            for (const [key, value] of tourData.entries()) {
                combinedData.append(key, value);
            }
            for (const [key, value] of daysData.entries()) {
                combinedData.append(key, value);
            }

            $.ajax({
                url: window.routes.addTour,
                method: 'POST',
                data: combinedData,
                processData: false,
                contentType: false,
                success: function(response) {
                    showMessage(response.message, 'alert-success', 'specifyDaysModal');
                    fetchTours();
                },
                error: function(xhr) {
                    showMessage(xhr.responseText, 'alert-danger');
                }
            });
        }

        window.fetchTours = function() {
            $.get(window.routes.fetchTours, function(response) {
                const tbody = $("tbody").empty();
                response.tours.forEach(tour => {
                    tbody.append(renderTableRow(tour));
                });
            });
        }

        function renderTableRow(tour) {
            return `
                <tr id="tr_${tour.id}">
                    <td>${tour.id}</td>
                    <td>${tour.tour_name}</td>
                    <td>${tour.description}</td>
                    <td>${tour.budget}</td>
                    <td>${tour.start_date}</td>
                    <td>${tour.end_date}</td>
                    <td>${tour.number_of_people}</td>
                    <td>${tour.created_by}</td>
                    <td><img src="${window.location.origin + '/uploads/Tour/' + tour.image}" width="50" height="50" /></td>
                    <td><button class="btn btn-info" onclick="showDetails(${tour.id})">Show Details</button></td>
                    <td><button class="btn btn-warning" onclick="editTour(${tour.id})">Edit</button></td>
                    <td><button class="btn btn-danger" onclick="deleteTour(${tour.id})">Delete</button></td>
                </tr>
            `;
        }

        window.showDetails = function(tourId) {
            $.get(window.routes.showTour + tourId, function(tour) {
                const tourDetails = `
                    <tr>
                        <td>${tour.tour_name}</td>
                        <td>${tour.description}</td>
                        <td>${tour.budget}</td>
                        <td>${tour.start_date}</td>
                        <td>${tour.end_date}</td>
                        <td>${tour.number_of_people}</td>
                        <td>${tour.created_by}</td>
                        <td><img src="${window.location.origin + '/uploads/Tour/' + tour.image}" width="50" height="50" /></td>
                    </tr>
                `;
                $('#tourDetailsTableBody').html(tourDetails);

                let daysDetails = '';
                tour.tour_days.forEach(day => {
                    daysDetails += `
                        <h5>Day ${day.day_number}</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Activity Type</th>
                                    <th>Activity Name</th>
                                    <th>Additional Details</th>
                                </tr>
                            </thead>
                            <tbody>
                    `;
                    day.day_activities.forEach(activity => {
                        const activityTypeName = activity.activity_category ?
                            activity.activity_category.category_name : activity
                            .activity_type;
                        const activityName = activity.referable ? activity.referable
                            .activity_name || activity.referable.site_name ||
                            activity.referable.restaurant_name : 'N/A';
                        daysDetails += `
                            <tr>
                                <td>${activityTypeName}</td>
                                <td>${activityName}</td>
                                <td>${activity.additional_details}</td>
                            </tr>
                        `;
                    });
                    daysDetails += `
                            </tbody>
                        </table>
                    `;
                });
                $('#tourDaysDetails').html(daysDetails);

                $('#tourDetailsModal').modal('show');
            });
        }

        window.editTour = function(tourId) {
            fetchAllEntities().then(() => {
                $.get(window.routes.showTour + tourId, function(tour) {
                    $('#editTourName').val(tour.tour_name);
                    $('#editDescription').val(tour.description);
                    $('#editBudget').val(tour.budget);
                    $('#editStartDate').val(tour.start_date);
                    $('#editEndDate').val(tour.end_date);
                    $('#editNumberOfPeople').val(tour.number_of_people);

                    $('#editDaysContainer').empty();
                    tour.tour_days.forEach(day => {
                        const dayContainerId = `editDay_${day.day_number}`;
                        $('#editDaysContainer').append(`
                            <div id="${dayContainerId}" class="day-container" data-day-id="${day.id}">
                                <h5>Day ${day.day_number}</h5>
                                <input type="hidden" class="day-number" value="${day.day_number}">
                                <button type="button" class="btn btn-secondary" onclick="addEditActivity('${day.day_number}')">Add Activity</button>
                                <button type="button" class="btn btn-danger" onclick="removeEditDay(this)">Remove Day</button>
                                <div id="editActivitiesContainer_${day.day_number}"></div>
                                <hr>
                            </div>
                        `);

                        day.day_activities.forEach(activity => {
                            addEditActivity(day.day_number, activity);
                        });
                    });

                    $('#editTourModal').data('tourId', tour.id);
                    $('#editTourModal').modal('show');
                });
            });
        }

        function fetchAllEntities() {
            return Promise.all([
                $.get('/vendor/activities', function(response) {
                    window.activities = response.activities;
                }),
                $.get('/vendor/historical-sites', function(response) {
                    window.historicalSites = response.historicalSites;
                }),
                $.get('/vendor/restaurants', function(response) {
                    window.restaurants = response.restaurants;
                })
            ]);
        }

        window.addEditDay = function() {
            const newDayNumber = $('#editDaysContainer > div').length + 1;
            const dayContainerId = `editDay_${newDayNumber}`;
            $('#editDaysContainer').append(`
                <div id="${dayContainerId}" class="day-container" data-day-id="">
                    <h5>Day ${newDayNumber}</h5>
                    <input type="hidden" class="day-number" value="${newDayNumber}">
                    <button type="button" class="btn btn-secondary" onclick="addEditActivity('${newDayNumber}')">Add Activity</button>
                    <button type="button" class="btn btn-danger" onclick="removeEditDay(this)">Remove Day</button>
                    <div id="editActivitiesContainer_${newDayNumber}"></div>
                    <hr>
                </div>
            `);
        }

        window.addEditActivity = function(dayId, activity = null) {
            const categoryOptions = categories.map(category =>
                `<option value="${category.id}">${category.category_name}</option>`).join('');

            const activityTypeSelectId = `editActivityType_${dayId}_${Date.now()}`;
            const referableIdSelectId = `editReferable_id_${dayId}_${Date.now()}`;
            const referableTypeId = `editReferable_type_${dayId}_${Date.now()}`;
            const additionalDetailsId = `editAdditional_details_${dayId}_${Date.now()}`;

            $('#editActivitiesContainer_' + dayId).append(`
                <div class="activity-container" data-activity-id="${activity ? activity.id : ''}">
                    <div class="mb-3">
                        <label for="${activityTypeSelectId}" class="form-label">Activity Type:</label>
                        <select id="${activityTypeSelectId}" name="edit_activity_type_${dayId}[]" class="form-select form-select-lg mb-3">
                            ${categoryOptions}
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="${referableIdSelectId}" class="form-label">Activity:</label>
                        <select id="${referableIdSelectId}" name="edit_referable_id_${dayId}[]" class="form-select form-select-lg mb-3"></select>
                    </div>
                    <div class="mb-3">
                        <label for="${additionalDetailsId}" class="form-label">Additional Details:</label>
                        <input type="text" id="${additionalDetailsId}" name="edit_additional_details_${dayId}[]" class="form-control" />
                    </div>
                    <input type="hidden" id="${referableTypeId}" name="edit_referable_type_${dayId}[]" value="" />
                    <button type="button" class="btn btn-danger" onclick="removeEditActivity(this)">Remove Activity</button>
                </div>
            `);

            if (activity) {
                $(`#${activityTypeSelectId}`).val(activity.activity_type);
                $(`#${additionalDetailsId}`).val(activity.additional_details);
                fetchReferableEntitiesForEdit(dayId, activity.activity_type, referableIdSelectId, referableTypeId, activity.referable_id);
            }

            $(`#${activityTypeSelectId}`).change(function() {
                fetchReferableEntitiesForEdit(dayId, $(`#${activityTypeSelectId}`).val(), referableIdSelectId, referableTypeId);
            });
        }

        window.removeEditActivity = function(button) {
            $(button).closest('.activity-container').remove();
        }

        window.removeEditDay = function(button) {
            $(button).closest('.day-container').remove();
            $('#editDaysContainer').children().each((index, element) => {
                $(element).find('h5').text(`Day ${index + 1}`);
                $(element).attr('id', `editDay_${index + 1}`);
                $(element).find('.day-number').val(index + 1);
            });
        }

        function fetchReferableEntitiesForEdit(dayId, categoryId, referableIdSelectId, referableTypeId, selectedId = null) {
            let url = '';
            if (categoryId == 1) { // Adventure
                url = `/vendor/activities`;
            } else if (categoryId == 2) { // Historical Site
                url = `/vendor/historical-sites`;
            } else if (categoryId == 3) { // Culinary
                url = `/vendor/restaurants`;
            }

            $.get(url, function(response) {
                let options = '';
                if (categoryId == 1) {
                    response.activities.forEach(activity => {
                        options += `<option value="${activity.id}" ${selectedId == activity.id ? 'selected' : ''}>${activity.activity_name}</option>`;
                    });
                    $(`#${referableTypeId}`).val('App\\Models\\Activity');
                } else if (categoryId == 2) {
                    response.historicalSites.forEach(site => {
                        options += `<option value="${site.id}" ${selectedId == site.id ? 'selected' : ''}>${site.site_name}</option>`;
                    });
                    $(`#${referableTypeId}`).val('App\\Models\\HistoricalSite');
                } else if (categoryId == 3) {
                    response.restaurants.forEach(restaurant => {
                        options += `<option value="${restaurant.id}" ${selectedId == restaurant.id ? 'selected' : ''}>${restaurant.restaurant_name}</option>`;
                    });
                    $(`#${referableTypeId}`).val('App\\Models\\Restaurant');
                }
                $(`#${referableIdSelectId}`).html(options);
            });
        }

        window.finishEditTour = function() {
            const tourId = $('#editTourModal').data('tourId');
            const tourData = new FormData($('#editTourForm')[0]);

            const days = [];
            $('#editDaysContainer > div').each(function(index, dayDiv) {
                const dayNumber = $(dayDiv).attr('id').split('_')[1];
                const dayId = $(dayDiv).attr('data-day-id');
                const day = {
                    id: dayId,
                    day_number: dayNumber,
                    activities: []
                };

                $(dayDiv).find('.activity-container').each(function(index, activityDiv) {
                    const activity = {
                        id: $(activityDiv).attr('data-activity-id'),
                        activity_type: $(activityDiv).find('select[name^="edit_activity_type_"]').val(),
                        additional_details: $(activityDiv).find('input[name^="edit_additional_details_"]').val(),
                        referable_id: parseInt($(activityDiv).find('select[name^="edit_referable_id_"]').val()),
                        referable_type: $(activityDiv).find('input[name^="edit_referable_type_"]').val()
                    };
                    day.activities.push(activity);
                });

                days.push(day);
                fetchTours();
            });

            tourData.append('days', JSON.stringify(days));
            tourData.append('_method', 'PUT');

            $.ajax({
                url: `${window.routes.editTour}${tourId}`,
                method: 'POST',
                data: tourData,
                processData: false,
                contentType: false,
                success: function(response) {
                    showMessage(response.message, 'alert-success', 'editTourModal');
                    fetchTours();
                },
                error: function(xhr) {
                    showMessage(xhr.responseText, 'alert-danger');
                }
            });
        }

        window.deleteTour = function(tourId) {
            if (confirm("Are you sure you want to delete this tour?")) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                $.ajax({
                    url: `${window.routes.editTour}${tourId}`,
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    success: function(response) {
                        showMessage(response.message);
                        fetchTours();
                    },
                    error: function(xhr) {
                        showMessage(xhr.responseText, 'alert-danger');
                    }
                });
            }
        }

        function showMessage(message, type = 'alert-success') {
            $('.modal').modal('hide'); 
            const messageDiv = $('#message');
            messageDiv.removeClass().addClass(`alert ${type}`).text(message).show();
            setTimeout(() => {
                messageDiv.hide();
            }, 3000);
        }

        fetchTours();
    });
</script>
