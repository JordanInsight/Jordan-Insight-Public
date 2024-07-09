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
    fetchCategories: window.routes.fetchCategories,
    addCategory: window.routes.addCategory,
    editCategory: (id) =>
        window.routes.editCategory.replace("ID_PLACEHOLDER", id),
    updateCategory: window.routes.updateCategory,
    deleteCategory: (id) =>
        window.routes.deleteCategory.replace("PLACEHOLDER", id),
};

ready(
    () => setupDeleteButton(routes.deleteCategory),
    () => setupEditButton(routes.editCategory, populateEditForm),
    () => fetchContent(routes.fetchCategories, renderCategory),
    () =>
        setupAddForm(
            routes.addCategory,
            "#addForm",
            "#addModal",
            renderCategory,
            routes.fetchCategories
        ),
    () =>
        setupEditForm(
            routes.updateCategory,
            'POST',
            "#edit-form",
            "#editModal",
            renderCategory,
            routes.fetchCategories
        ),
);
 
 
function renderCategory(response) {
    const tbody = $("tbody").empty();
    response.Categories.forEach((item) => {
        tbody.append(renderTableRow(item));
    });
}

function renderTableRow(item) {
    let actionButtons = generateActionButtons(item.id);
    return `
                <tr  id="tr_${item.id}">
                            <td>${item.id}</td>
                            <td>${item.category_name}</td>
                            ${actionButtons}
                        </tr>
                `;
}

function populateEditForm(response) {
     
    $("#eName").val(response.Category.category_name);
    $("#editId").val(response.Category.id);
}
 