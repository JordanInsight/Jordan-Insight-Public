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
    fetchRoles: window.routes.fetchRoles,
    addRole: window.routes.addRole,
    editRole: id => window.routes.editRole.replace('ID_PLACEHOLDER', id),
    updateRole: window.routes.updateRole,
    deleteRole: id => window.routes.deleteRole.replace('PLACEHOLDER', id)
};
ready(
    () => setupDeleteButton(routes.deleteRole),
    () => setupEditButton(routes.editRole, populateEditForm),
    () => fetchContent(routes.fetchRoles, renderRole),
    () =>
        setupAddForm(
            routes.addRole,
            "#addForm",
            "#addModal",
            renderRole,
            routes.fetchRoles
        ),
    () =>
        setupEditForm(
            routes.updateRole,
            'PUT',
            "#edit-form",
            "#editModal",
            renderRole,
            routes.fetchRoles
        ),
);


 
function renderRole(response) {
    const tbody = $('tbody').empty();

    
    response.Roles.forEach(column => {
        tbody.append(renderRow(column));
    });
}

function renderRow(column) {
    let actionButtons = generateActionButtons(column.id);
    return `
                    <tr id="tr_${column.id}">
                        <td>${column.id}</td>
                        <td>${column.role_name}</td>
                        ${actionButtons}
                    </tr>
                `
}


function populateEditForm(response) {
    $('#eName').val(response.role.role_name);
    $('#editId').val(response.role.id);
} 