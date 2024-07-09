import {
    ready,
    setupDeleteButton,
    setupEditButton,
    fetchContent,
    setupAddForm,
    setupEditForm,
} from "/admin/scripts/main.js";

import { generateActionButtons } from "../utils.js";

const routes = {
    fetchTours: window.routes.fetchTours,
    addTour: window.routes.addTour,
    editTour: (id) => window.routes.editTour.replace("ID_PLACEHOLDER", id),
    updateTour: (id) => window.routes.updateTour.replace("PLACEHOLDER", id),
    deleteTour: (id) => window.routes.deleteTour.replace("PLACEHOLDER", id),
    showTour: (id) => window.routes.showTour.replace("ID_PLACEHOLDER", id),
    fetchCategories: window.routes.fetchCategories,
};

let categories = [];

ready(
    () => fetchContent(routes.fetchTours, renderTour),
    () =>
        setupAddForm(
            routes.addTour,
            "#addForm",
            "#addModal",
            renderTour,
            routes.fetchTours
        ),
    () =>
        setupEditForm(
            routes.updateTour,
            "POST",
            "#editForm",
            "#editModal",
            renderTour,
            routes.fetchTours
        ),
    () => setupDeleteButton(routes.deleteTour),
    () => setupEditButton(routes.editTour, populateEditForm)
);

function renderTour(response) {
    const tbody = $("tbody").empty();
    response.tours.forEach((tour) => {
        tbody.append(renderTableRow(tour));
    });
}

function renderTableRow(tour) {
    const actionButtons = generateActionButtons(tour.id);
    return `
        <tr id="tr_${tour.id}">
            <td>${tour.id}</td>
            <td>${tour.tour_name}</td>
            <td>${tour.budget}</td>
            <td>${tour.start_date}</td>
            <td>${tour.end_date}</td>
            <td>${tour.number_of_people}</td>
            <td>${tour.type}</td>
            <td>${tour.created_by}</td>
            <td><img src="${
                window.location.origin + "/uploads/Tour/" + tour.image
            }" /></td>
            <td><button class="btn btn-info" onclick="showDetails(${
                tour.id
            })">Show Details</button></td>
            ${actionButtons}
        </tr>
    `;
}

function showDetails(tourId) {
    $.get(routes.showTour(tourId), function (tour) {
        let details = `
            <table class="table">
                <tr><th>Tour Name</th><td>${tour.tour_name}</td></tr>
                <tr><th>Budget</th><td>${tour.budget}</td></tr>
                <tr><th>Start Date</th><td>${tour.start_date}</td></tr>
                <tr><th>End Date</th><td>${tour.end_date}</td></tr>
                <tr><th>Number of People</th><td>${
                    tour.number_of_people
                }</td></tr>
                <tr><th>Type</th><td>${tour.type}</td></tr>
                <tr><th>Created By</th><td>${tour.created_by}</td></tr>
                <tr><th>Image</th><td><img src="${
                    window.location.origin + "/uploads/Tour/" + tour.image
                }" /></td></tr>
            </table>
            <h4>Days:</h4>
            ${tour.tour_days
                .map(
                    (day) => `
                <h5>Day ${day.day_number}</h5>
                ${day.day_activities
                    .map(
                        (activity) => `
                    <p>Activity Type: ${activity.activity_type}</p>
                    <p>Additional Details: ${activity.additional_details}</p>
                `
                    )
                    .join("")}
            `
                )
                .join("")}
        `;

        $("#tourDetailsModal .modal-body").html(details);
        $("#tourDetailsModal").modal("show");
    });
}

window.showDetails = showDetails;

function populateEditForm(response) {
    const tour = response.tour;
    $("#editTourName").val(tour.tour_name);
    $("#editBudget").val(tour.budget);
    $("#editStartDate").val(tour.start_date);
    $("#editEndDate").val(tour.end_date);
    $("#editNumberOfPeople").val(tour.number_of_people);
    $("#editType").val(tour.type);
    $("#editTourId").val(tour.id);

    const daysContainer = $("#editDaysContainer");
    daysContainer.empty();
    tour.tour_days.forEach((day) => {
        const activities = categories
            .map(
                (category) =>
                    `<option value="${category.id}">${category.category_name}</option>`
            )
            .join("");
        const dayHtml = `
            <div id="edit_day_${day.day_number}">
                <h5>Day ${day.day_number}</h5>
                <button type="button" class="btn btn-secondary" onclick="addEditDayActivity(${
                    day.day_number
                })">Add Activity</button>
                <div id="edit_activitiesContainer_${day.day_number}">
                    ${day.day_activities
                        .map(
                            (activity) => `
                        <div class="activity">
                            <label>Activity Type</label>
                            <select name="edit_activity_type_${day.day_number}[]" class="form-select">${activities}</select>
                            <label>Additional Details</label>
                            <input type="text" name="edit_additional_details_${day.day_number}[]" class="form-control" value="${activity.additional_details}" />
                        </div>
                    `
                        )
                        .join("")}
                </div>
                <hr>
            </div>
        `;
        daysContainer.append(dayHtml);
    });

    $("#editModal").modal("show");
}

window.addEditDayActivity = function (day) {
    const activities = categories
        .map(
            (category) =>
                `<option value="${category.id}">${category.category_name}</option>`
        )
        .join("");
    $("#edit_activitiesContainer_" + day).append(`
        <div class="activity">
            <label>Activity Type</label>
            <select name="edit_activity_type_${day}[]" class="form-select">${activities}</select>
            <label>Additional Details</label>
            <input type="text" name="edit_additional_details_${day}[]" class="form-control" />
        </div>
    `);
};

window.updateTour = function () {
    const tourData = new FormData($("#editForm")[0]);

    ajaxRequest(
        routes.updateTour($("#editTourId").val()),
        "POST",
        tourData,
        (response) => {
            showMessage(response.message, "alert-success");
            $("#editModal").modal("hide");
            fetchContent(routes.fetchTours, renderTour);
        },
        handleFormError
    );
};

function deleteTour(id) {
    if (confirm("Are you sure you want to delete this tour?")) {
        ajaxRequest(
            routes.deleteTour(id),
            "DELETE",
            {},
            (response) => {
                showMessage(response.message, "alert-success");
                fetchContent(routes.fetchTours, renderTour);
            },
            handleFormError
        );
    }
}

window.deleteTour = deleteTour;

function nextStep() {
    const totalDays = $("#numberOfDays").val();
    $("#addModal").modal("hide");
    $("#specifyDaysModal").modal("show");
    generateDaysForm(totalDays);
}

window.nextStep = nextStep;

function generateDaysForm(totalDays) {
    const daysContainer = $("#daysContainer").empty();
    for (let i = 1; i <= totalDays; i++) {
        daysContainer.append(`
            <div id="day_${i}">
                <h5>Day ${i}</h5>
                <button type="button" class="btn btn-secondary" onclick="addDayActivity(${i})">Add Activity</button>
                <div id="activitiesContainer_${i}"></div>
                <hr>
            </div>
        `);
    }
}

window.addDayActivity = function (day) {
    const activities = categories
        .map(
            (category) =>
                `<option value="${category.id}">${category.category_name}</option>`
        )
        .join("");
    $("#activitiesContainer_" + day).append(`
        <div class="activity">
            <label>Activity Type</label>
            <select name="activity_type_${day}[]" class="form-select">${activities}</select>
            <label>Additional Details</label>
            <input type="text" name="additional_details_${day}[]" class="form-control" />
        </div>
    `);
};

window.finishTour = function () {
    const tourData = new FormData($("#addForm")[0]);
    const daysData = new FormData($("#specifyDaysForm")[0]);

    const combinedData = new FormData();
    for (const [key, value] of tourData.entries()) {
        combinedData.append(key, value);
    }
    for (const [key, value] of daysData.entries()) {
        combinedData.append(key, value);
    }

    ajaxRequest(
        routes.addTour,
        "POST",
        combinedData,
        (response) => {
            showMessage(response.message, "alert-success");
            $("#specifyDaysModal").modal("hide");
            fetchContent(routes.fetchTours, renderTour);
        },
        handleFormError
    );
};

$(document).ready(function () {
    $.get(routes.fetchCategories, function (response) {
        categories = response.categories;
    });
});
