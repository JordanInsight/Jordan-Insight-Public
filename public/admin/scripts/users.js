import {
    ready,
    setupDeleteButton,
    setupEditButton,
    fetchContent,
    setupEditForm,
} from "/admin/scripts/main.js";
 
import {generateActionButtons} from '../utils.js';
const routes = {
    fetchUsers: window.routes.fetchUsers,
    editUser: (id) =>
        window.routes.editUser.replace("ID_PLACEHOLDER", id),
    updateUser: window.routes.updateUser,
    deleteUser: (id) =>
        window.routes.deleteUser.replace("PLACEHOLDER", id),
};

ready(
    () => setupDeleteButton(routes.deleteUser),
    () => setupEditButton(routes.editUser, populateEditForm),
    () => fetchContent(routes.fetchUsers, renderUsers),
    () =>
        setupEditForm(
            routes.updateUser,
            'POST',
            "#edit-form",
            "#editModal",
            renderUsers,
            routes.fetchUsers
        ),
);
 
 
function renderUsers(response) {
    const tbody = $("tbody").empty();
    response.users.forEach((item) => {
        tbody.append(renderTableRow(item));
    });
}

function renderTableRow(item) {
    let actionButtons = generateActionButtons(item.id);
    return `
        <tr id="tr_${item.id}">
            <td>${item.id}</td>
            <td>${item.first_name}</td>
            <td>${item.last_name}</td>
            <td>${item.email}</td>
            <td>${item.role.role_name}</td>
            
            <td><img src="${window.location.origin +'/uploads/user_profile_pictures/' + item.user_pfp}" /></td>
            ${actionButtons}
        </tr>
    `;
}


function populateEditForm(response) {   
    $("#editId").val(response.user.id); // Assuming response.user.id holds the ID //هاي لازم تنحط عشان يوخد ال userID and send it with the response so it can git the right user 
    $("#edit-form").attr("action", routes.updateUser.replace("PLACEHOLDER", response.user.id));
    $("#eRole").val(response.user.role_id); // Set the role dropdown
}
 