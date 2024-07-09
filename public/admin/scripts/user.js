import {
    ready,
    setupDeleteButton,
    setupEditButton,
    fetchContent,
    setupEditForm,
} from "/admin/scripts/main.js";

import { generateActionButtons } from "../utils.js";
const routes = {
    fetchUsers: window.routes.fetchUsers,
    editUser: (id) => window.routes.editUser.replace("ID_PLACEHOLDER", id),
    updateUser: window.routes.updateUser,
    deleteUser: (id) => window.routes.deleteUser.replace("PLACEHOLDER", id),
};

ready(
    () => setupDeleteButton(routes.deleteUser),
    () => setupEditButton(routes.editUser, populateEditForm),
    () => fetchContent(routes.fetchUsers, renderUsers),
    () =>
        setupEditForm(
            routes.updateUser,
            "POST",
            "#edit-form",
            "#editModal",
            renderUsers,
            routes.renderUsers
        )
);

function renderUsers(response) {
    const tbody = $("tbody").empty();
    console.log(response.users);
    response.users.forEach((item) => {
        tbody.append(renderTableRow(item));
    });
}

function renderTableRow(item) {
    let actionButtons = generateActionButtons(item.id);
    return `
                <tr  id="tr_${item.id}">
                            <td>${item.id}</td>
                            <td>${item.first_name}</td>
                            <td>${item.last_name}</td>
                            <td>${item.email}</td>
                            <td>${item.is_admin}</td>
                            <td><img src="${
                                window.location.origin +
                                "/uploads/Users/" +
                                item.image
                            }" /></td>
                            ${actionButtons}
                        </tr>
                `;
}

function populateEditForm(response) {
    console.log(response.user);
    $("#eIs_admin").val(response.user.is_admin);
    $("#editId").val(response.user.id);
}
