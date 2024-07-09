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
    fetchLocations: window.routes.fetchLocations,
    addLocation: window.routes.addLocation,
    editLocation: (id) =>
        window.routes.editLocation.replace("ID_PLACEHOLDER", id),
    updateLocation: window.routes.updateLocation,
    deleteLocation: (id) =>
        window.routes.deleteLocation.replace("PLACEHOLDER", id),
};
ready(
    () => setupDeleteButton(routes.deleteLocation),
    () => setupEditButton(routes.editLocation, populateEditForm),
    () => fetchContent(routes.fetchLocations, renderLocation),
    () =>
        setupAddForm(
            routes.addLocation,
            "#addForm",
            "#addModal",
            renderLocation,
            routes.fetchLocations
        ),
    () =>
        setupEditForm(
            routes.updateLocation,
            "PUT",
            "#edit-form",
            "#editModal",
            renderLocation,
            routes.fetchLocations
        )
);

function renderLocation(response) {
    const tbody = $("tbody").empty();

    response.locations.forEach((column) => {
        tbody.append(renderRow(column));
    });
}

function renderRow(column) {
    let actionButtons = generateActionButtons(column.id);
    return `
                    <tr id="tr_${column.id}">
                        <td>${column.id}</td>
                        <td>${column.location_name}</td>
                        <td>${column.city.city_name}</td>
                        ${actionButtons}
                    </tr>
                `;
}

function populateEditForm(response) {
    $("#eName").val(response.location.location_name);
    $("eCity_id").val(response.location.city_id);
    $("#editId").val(response.location.id);
}
