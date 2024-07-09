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
    fetchCarReservations: window.routes.fetchCarReservations,
    fetchTourReservations: window.routes.fetchTourReservations,
    fetchAvailableCars: window.routes.fetchAvailableCars,
    addReservation: window.routes.addReservation,
    editReservation: (id) =>
        window.routes.editReservation.replace("ID_PLACEHOLDER", id),
    updateReservation: (id) =>
        window.routes.updateReservation.replace("PLACEHOLDER", id),
    deleteReservation: (id) =>
        window.routes.deleteReservation.replace("PLACEHOLDER", id),
};

ready(
    () => setupDeleteButton(routes.deleteReservation),
    () => setupEditButton(routes.editReservation, populateEditForm),
    () => fetchContent(routes.fetchCarReservations, renderCarReservations),
    () => fetchContent(routes.fetchTourReservations, renderTourReservations),
    () =>
        setupAddForm(
            routes.addReservation,
            "#addCarReservationForm",
            "#addCarReservationModal",
            renderCarReservations,
            routes.fetchCarReservations
        ),
    () =>
        setupAddForm(
            routes.addReservation,
            "#addTourReservationForm",
            "#addTourReservationModal",
            renderTourReservations,
            routes.fetchTourReservations
        ),
    () =>
        setupEditForm(
            routes.updateReservation,
            "POST",
            "#editCarReservationForm",
            "#editCarReservationModal",
            renderCarReservations,
            routes.fetchCarReservations
        ),
    () =>
        setupEditForm(
            routes.updateReservation,
            "POST",
            "#editTourReservationForm",
            "#editTourReservationModal",
            renderTourReservations,
            routes.fetchTourReservations
        )
);

document.addEventListener("DOMContentLoaded", function () {
    $("#addCarReservationModal").on("show.bs.modal", function () {
        fetchAvailableCars();
    });
});

function fetchAvailableCars() {
    $.ajax({
        url: routes.fetchAvailableCars,
        method: "GET",
        success: function (response) {
            const carSelect = $("#car_id");
            const editCarSelect = $("#edit_car_id");
            carSelect.empty();
            editCarSelect.empty();
            response.cars.forEach((car) => {
                carSelect.append(new Option(car.car_name, car.id));
                editCarSelect.append(new Option(car.car_name, car.id));
            });
        },
        error: function (xhr) {
            console.error("Error fetching available cars:", xhr);
        },
    });
}

function renderCarReservations(response) {
    const tbody = $("#carReservationsTable").empty();
    response.reservations.forEach((item) => {
        tbody.append(renderCarTableRow(item));
    });
}

function renderCarTableRow(item) {
    let actionButtons = generateActionButtons(item.id);
    return `
        <tr id="tr_${item.id}">
            <td>${item.id}</td>
            <td>${item.user.first_name} ${item.user.last_name}</td>
            <td>${item.car.car_name}</td>
            <td>${item.reservation_date}</td>
            <td>${item.start_date}</td>
            <td>${item.end_date}</td>
            <td>${item.phone}</td>
            ${actionButtons}
        </tr>
    `;
}

function renderTourReservations(response) {
    const tbody = $("#tourReservationsTable").empty();
    response.reservations.forEach((item) => {
        tbody.append(renderTourTableRow(item));
    });
}

function renderTourTableRow(item) {
    let actionButtons = generateActionButtons(item.id);
    return `
        <tr id="tr_${item.id}">
            <td>${item.id}</td>
            <td>${item.user.first_name} ${item.user.last_name}</td>
            <td>${item.tour.tour_name}</td>
            <td>${item.reservation_date}</td>
            <td>${item.start_date}</td>
            <td>${item.end_date}</td>
            <td>${item.phone}</td>
            ${actionButtons}
        </tr>
    `;
}

function populateEditForm(response) {
    const reservation = response.reservation;
    if (reservation.car_id) {
        $("#editCarReservationId").val(reservation.id);
        $("#edit_car_user_id").val(reservation.user_id);
        $("#edit_car_id").val(reservation.car_id);
        $("#edit_car_start_date").val(reservation.start_date);
        $("#edit_car_end_date").val(reservation.end_date);
        $("#edit_car_phone").val(reservation.phone);
        $("#editCarReservationModal").modal("show");
    } else if (reservation.tour_id) {
        $("#editTourReservationId").val(reservation.id);
        $("#edit_tour_user_id").val(reservation.user_id);
        $("#edit_tour_id").val(reservation.tour_id);
        $("#edit_tour_start_date").val(reservation.start_date);
        $("#edit_tour_end_date").val(reservation.end_date);
        $("#edit_tour_phone").val(reservation.phone);
        $("#editTourReservationModal").modal("show");
    }
}

$(document).on("submit", "#editCarReservationForm", function (e) {
    e.preventDefault();
    const id = $("#editCarReservationId").val();
    const originalCarId = $("#original_car_id").val();
    const newCarId = $("#edit_car_id").val();

    $.ajax({
        url: routes.updateReservation(id),
        method: "POST",
        data: $(this).serialize(),
        success: function (response) {
            if (originalCarId !== newCarId) {
                fetchAvailableCars(); // Refresh the available cars list after status update
            }
            fetchContent(routes.fetchCarReservations, renderCarReservations);
            $("#editCarReservationModal").modal("hide");
        },
        error: function (xhr) {
            console.error("Error updating reservation:", xhr);
        },
    });
});
