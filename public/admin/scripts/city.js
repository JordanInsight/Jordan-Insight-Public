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
    fetchCities: window.routes.fetchCities,
    addCity: window.routes.addCity,
    editCity: id => window.routes.editCity.replace('ID_PLACEHOLDER', id),
    updateCity: window.routes.updateCity,
    deleteCity: id => window.routes.deleteCity.replace('PLACEHOLDER', id)
};
ready(
    () => setupDeleteButton(routes.deleteCity),
    () => setupEditButton(routes.editCity, populateEditForm),
    () => fetchContent(routes.fetchCities, renderCity),
    () =>
        setupAddForm(
            routes.addCity,
            "#addForm",
            "#addModal",
            renderCity,
            routes.fetchCities
        ),
    () =>
        setupEditForm(
            routes.updateCity,
            'PUT',
            "#edit-form",
            "#editModal",
            renderCity,
            routes.fetchCities
        ),
);


 
function renderCity(response) {
    const tbody = $('tbody').empty();
    
    response.cities.forEach(column => {
        tbody.append(renderRow(column));
    });
}

function renderRow(column) {
    let actionButtons = generateActionButtons(column.id);
    return `
                    <tr id="tr_${column.id}">
                        <td>${column.id}</td>
                        <td>${column.city_name}</td>
                        ${actionButtons}
                    </tr>
                `
}


function populateEditForm(response) {
    $('#eName').val(response.city.city_name);
    $('#editId').val(response.city.id);
} 