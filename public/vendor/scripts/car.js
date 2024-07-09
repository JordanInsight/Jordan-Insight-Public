import {
    ready,
    setupDeleteButton,
    setupEditButton,
    fetchContent,
    setupAddForm,
    setupEditForm,
} from "/vendor/scripts/main.js";
 
import {generateActionButtons} from '../utils.js';
const routes = {
    fetchCars: window.routes.fetchCars,
    addCar: window.routes.addCar,
    editCar: (id) =>
        window.routes.editCar.replace("ID_PLACEHOLDER", id),
    updateCar: window.routes.updateCar,
    deleteCar: (id) =>
        window.routes.deleteCar.replace("PLACEHOLDER", id),
};

ready(
    () => setupDeleteButton(routes.deleteCar),
    () => setupEditButton(routes.editCar, populateEditForm),
    () => fetchContent(routes.fetchCars, renderCar),
    () =>
        setupAddForm(
            routes.addCar,
            "#addForm",
            "#addModal",
            renderCar,
            routes.fetchCars
        ),
    () =>
        setupEditForm(
            routes.updateCar,
            'POST',
            "#edit-form",
            "#editModal",
            renderCar,
            routes.fetchCars
        ),
);
 
 
function renderCar(response) {
    const tbody = $("tbody").empty();
    
    response.cars.forEach((item) => {
        tbody.append(renderTableRow(item));
    });
}

function renderTableRow(item) {
    let actionButtons = generateActionButtons(item.id);
    return `
                <tr  id="tr_${item.id}">
                            <td>${item.id}</td>
                            <td>${item.car_name}</td>
                            <td>${item.model}</td>
                            <td>${item.type}</td>
                            <td>${item.number_of_seats}</td>
                            <td>${item.status}</td>
                            <td>${item.price}</td>
                            <td><img src="${window.location.origin +'/uploads/Car/' + item.image}" /></td>
                            ${actionButtons}
                        </tr>
                `;
}

function populateEditForm(response) {   
    $("#eName").val(response.car.car_name);
    $("#eModel").val(response.car.model);
    $("#eType").val(response.car.type);
    $("#eSeats").val(response.car.number_of_seats);
    $("#eStatus").val(response.car.status);
    $("#ePrice").val(response.car.price);
    $("#editId").val(response.car.id);
}
