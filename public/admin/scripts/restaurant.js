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
    fetchRestaurants: window.routes.fetchRestaurants,
    addRestaurant: window.routes.addRestaurant,
    editRestaurant: (id) =>
        window.routes.editRestaurant.replace("ID_PLACEHOLDER", id),
    updateRestaurant: window.routes.updateRestaurant,
    deleteRestaurant: (id) =>
        window.routes.deleteRestaurant.replace("PLACEHOLDER", id),
};

ready(
    () => setupDeleteButton(routes.deleteRestaurant),
    () => setupEditButton(routes.editRestaurant, populateEditForm),
    () => fetchContent(routes.fetchRestaurants, renderRestaurant),
    () =>
        setupAddForm(
            routes.addRestaurant,
            "#addForm",
            "#addModal",
            renderRestaurant,
            routes.fetchRestaurants
        ),
    () =>
        setupEditForm(
            routes.updateRestaurant,
            'POST',
            "#edit-form",
            "#editModal",
            renderRestaurant,
            routes.fetchRestaurants
        ),
);
 
 
function renderRestaurant(response) {
    const tbody = $("tbody").empty();
    response.restaurants.forEach((item) => {
        tbody.append(renderTableRow(item));
    });
}

function renderTableRow(item) {
    let actionButtons = generateActionButtons(item.id);
    return `
        <tr id="tr_${item.id}">
            <td>${item.id}</td>
            <td>${item.restaurant_name}</td>
            <td>${item.location.location_name}</td>
            <td id="description">${item.rating}</td>
            <td id="description">${item.description}</td>
            <td id="description">${item.cuisine}</td>
            <td id="description">${item.min_price}</td>
            <td id="description">${item.max_price}</td>
            
            <td><img src="${window.location.origin +'/Storage/Restaurant/' + item.image}" /></td>
            ${actionButtons}
        </tr>
    `;
}


function populateEditForm(response) {   
    $("#eName").val(response.restaurant.restaurant_name);
    $("#eDescription").val(response.restaurant.description);
    $("#eLocation_id").val(response.restaurant.location_id);
    $("#eCuisine").val(response.restaurant.cuisine);
    $("#eMax_price").val(response.restaurant.max_price);
    $("#eMin_price").val(response.restaurant.min_price);
    $("#eRating").val(response.restaurant.rating);
    $("#editId").val(response.restaurant.id);
}
 