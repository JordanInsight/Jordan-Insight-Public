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
    fetchHistoricalSites: window.routes.fetchHistoricalSites,
    addHistoricalSite: window.routes.addHistoricalSite,
    editHistoricalSite: (id) =>
        window.routes.editHistoricalSite.replace("ID_PLACEHOLDER", id),
    updateHistoricalSite: window.routes.updateHistoricalSite,
    deleteHistoricalSite: (id) =>
        window.routes.deleteHistoricalSite.replace("PLACEHOLDER", id),
};

ready(
    () => setupDeleteButton(routes.deleteHistoricalSite),
    () => setupEditButton(routes.editHistoricalSite, populateEditForm),
    () => fetchContent(routes.fetchHistoricalSites, renderHistoricalSite),
    () =>
    setupAddForm(
        routes.addHistoricalSite,
        "#addForm",
        "#addModal",
        renderHistoricalSite,
        routes.fetchHistoricalSites
    ),
() =>
    setupEditForm(
        routes.updateHistoricalSite,
        'POST',
        "#edit-form",
        "#editModal",
        renderHistoricalSite,
        routes.fetchHistoricalSites
    ),
);

function renderHistoricalSite(response) {
    const tbody = $("tbody").empty();
    response.historicalSites.forEach((item) => {
        tbody.append(renderTableRow(item));
    });
}

function renderTableRow(item) {
    let actionButtons = generateActionButtons(item.id);
    return `
        <tr id="tr_${item.id}">
            <td>${item.id}</td>
            <td>${item.site_name}</td>
            <td>${item.location.location_name}</td>
            <td >${item.rating}</td>
            <td id="description">${item.description}</td>
            <td >${item.entry_fees}</td>
            <td >${item.opening_hours}</td>
            <td><img src="${
                window.location.origin + "/uploads/HistoricalSite/" + item.image
            }" /></td>
            ${actionButtons}
        </tr>
    `;
}

function populateEditForm(response) {
    $("#eName").val(response.historicalSite.site_name);
    $("#eDescription").val(response.historicalSite.description);
    $("#eLocation_id").val(response.historicalSite.location_id);
    $("#eEntry_fees").val(response.historicalSite.entry_fees);
    $("#eOpening_hours").val(response.historicalSite.opening_hours);
    $("#eRating").val(response.historicalSite.rating);
    $("#editId").val(response.historicalSite.id);
}
