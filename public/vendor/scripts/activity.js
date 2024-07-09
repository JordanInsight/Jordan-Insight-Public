import {
    ready,
    setupDeleteButton,
    setupEditButton,
    fetchContent,
    setupAddForm,
    setupEditForm,
} from "/vendor/scripts/main.js";

import { generateActionButtons } from "../utils.js";

const routes = {
    fetchActivities: window.routes.fetchActivities,
    addActivity: window.routes.addActivity,
    editActivity: (id) =>
        window.routes.editActivity.replace("ID_PLACEHOLDER", id),
    updateActivity: (id) =>
        window.routes.updateActivity.replace("PLACEHOLDER", id),
    deleteActivity: (id) =>
        window.routes.deleteActivity.replace("PLACEHOLDER", id),
};

ready(
    () => setupDeleteButton(routes.deleteActivity),
    () => setupEditButton(routes.editActivity, populateEditForm),
    () => fetchContent(routes.fetchActivities, renderActivities),
    () =>
        setupAddForm(
            routes.addActivity,
            "#addForm",
            "#addModal",
            renderActivities,
            routes.fetchActivities
        ),
    () =>
        setupEditForm(
            routes.updateActivity,
            "POST",
            "#edit-form",
            "#editModal",
            renderActivities,
            routes.fetchActivities
        )
);

function renderActivities(response) {
    const tbody = $("tbody").empty();

    response.activities.forEach((item) => {
        tbody.append(renderTableRow(item));
    });
}

function renderTableRow(item) {
    let actionButtons = generateActionButtons(item.id);
    return `
        <tr id="tr_${item.id}">
            <td>${item.id}</td>
            <td>${item.activity_name}</td>
            <td>${item.location.location_name}</td>
            <td>${item.category.category_name}</td>
            <td>${item.description}</td>
            <td>${item.activity_type}</td>
            <td>${item.duration}</td>
            <td>${item.price}</td>
            <td>${item.start_date}</td>
            <td>${item.end_date}</td>
            <td><img src="${
                window.location.origin + "/uploads/activities/" + item.image
            }" /></td>            <td>${item.rating}</td>
            ${actionButtons}
        </tr>
    `;
}

function populateEditForm(response) {
    const activity = response.activity;
    $("#eName").val(activity.activity_name);
    $("#eLocation_id").val(activity.location_id);
    $("#eCategory_id").val(activity.category_id);
    $("#eDescription").val(activity.description);
    $("#eActivity_type").val(activity.activity_type);
    $("#eDuration").val(activity.duration);
    $("#ePrice").val(activity.price);
    $("#eStart_date").val(activity.start_date);
    $("#eEnd_date").val(activity.end_date);
    $("#eRating").val(activity.rating);
    $("#editId").val(activity.id);
}

$(document).on("submit", "#edit-form", function (e) {
    e.preventDefault();
    const id = $("#editId").val();
    const updateUrl = routes.updateActivity(id);

    const formData = new FormData(this);
    $.ajax({
        url: updateUrl,
        method: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $("#editModal").modal("hide");
            fetchContent(routes.fetchActivities, renderActivities);
        },
        error: function (xhr) {
            console.error("Error updating activity:", xhr);
        },
    });
});
