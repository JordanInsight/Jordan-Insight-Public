import {
    ready,
    setupDeleteButton,
    setupEditButton,
    fetchContent,
    setupAddForm,
    setupEditForm,
} from "/admin/scripts/main.js";
 
import {generateActionButtons} from '../utils.js';
const routes = {
    fetchHotels: window.routes.fetchHotels,
    addHotel: window.routes.addHotel,
    editHotel: (id) =>
        window.routes.editHotel.replace("ID_PLACEHOLDER", id),
    updateHotel: window.routes.updateHotel,
    deleteHotel: (id) =>
        window.routes.deleteHotel.replace("PLACEHOLDER", id),
};

ready(
    () => setupDeleteButton(routes.deleteHotel),
    () => setupEditButton(routes.editHotel, populateEditForm),
    () => fetchContent(routes.fetchHotels, renderHotel),
    () =>
        setupAddForm(
            routes.addHotel,
            "#addForm",
            "#addModal",
            renderHotel,
            routes.fetchHotels
        ),
    () =>
        setupEditForm(
            routes.updateHotel,
            'POST',
            "#edit-form",
            "#editModal",
            renderHotel,
            routes.fetchHotels
        ),
);
 
 
function renderHotel(response) {
    const tbody = $("tbody").empty();
    
    response.hotels.forEach((item) => {
        tbody.append(renderTableRow(item));
    });
}

function renderTableRow(item) {
    let actionButtons = generateActionButtons(item.id);
    return `
                <tr  id="tr_${item.id}">
                            <td>${item.id}</td>
                            <td>${item.hotel_name}</td>
                            <td>${item.location.location_name}</td>
                            <td id="rating">${item.rating}</td>
                            <td id="description">${item.description}</td>
                            <td id="website">${item.website}</td>
                            <td id="min_price">${item.min_price}</td>
                            <td id="max_price">${item.max_price}</td>
                            <td><img src="${window.location.origin +'/uploads/Hotel/' + item.image}" /></td>
                            ${actionButtons}
                        </tr>
                `;
}

function populateEditForm(response) {   
    $("#eName").val(response.hotel.hotel_name);
    $("#eDescription").val(response.hotel.description);
    $("#eWebsite").val(response.hotel.website);
    $("#eLocation_id").val(response.hotel.location_id);
    $("#eMin_price").val(response.hotel.min_price);
    $("#eMax_price").val(response.hotel.max_price);
    $("#eRating").val(response.hotel.rating);
    $("#editId").val(response.hotel.id);
}
 