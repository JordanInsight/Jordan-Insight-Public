import {
    handleFormError
} from '/admin/assets/js/handleFormError.js';
import {
    renderPaginationBar
} from "/admin/assets/js/paginationBar.js";
const routes = {
    fetchProjects: window.routes.fetchProjects,
    searchFilter: window.routes.searchFilter,
    addProject: window.routes.addProject,
    editProject: id => window.routes.editProject.replace('ID_PLACEHOLDER', id),
    updateProject: window.routes.updateProject,
    deleteProject: id => window.routes.deleteProject.replace('PLACEHOLDER', id)
};

$(document).ready(function() {
    setupAjax();
    fetchProjects();
    bindEvents();
});

function setupAjax() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
}

//fetch the projects always with ajax
function fetchProjects() {
    ajaxRequest(routes.fetchProjects, "GET", {}, renderProjects, showMessage);
}

function bindEvents() {

    //edit button clicked
    $(document).on('click', '.btn-edit-stu', e => {
        const id = $(e.currentTarget).data('id');
        ajaxRequest(routes.editProject(id), 'GET', {}, populateEditForm, showMessage);
    });

    $('#searchForm').on('submit', function(e) {
        e.preventDefault();
        ajaxRequest(
            routes.searchFilter,
            'POST',
            new FormData(this),
            renderProjects,
            showMessage
        );
        // $('#searchForm').trigger('reset');
    });

    $('#resetButton').on('click', function() {
        fetchProjects();
    }   
    );


    //add from submit
    $('#addForm').on('submit', function(e) {
        e.preventDefault();
        ajaxRequest(
            routes.addProject,
            'POST',
            new FormData(this),
            function(response) {
                handleFormSuccess('#addModal');
                $('#addForm').trigger('reset');
            },
            function(jqXHR, textStatus, errorThrown) {
                handleFormError(jqXHR, '#addModal');
            }
        );
    });
    //edit form submit
    $('#edit-form').on('submit', function(e) {
        e.preventDefault();
        const id = $('#editId').val();

        ajaxRequest(
            routes.updateProject.replace('PLACEHOLDER', id),
            'POST',
            new FormData(this),
            function(response) {
                handleFormSuccess('#editModal');
            },
            function(jqXHR, textStatus, errorThrown) {
                handleFormError(jqXHR, '#editModal');
            }
        );
    });
    //Click delete button
    $(document).on('click', '.btn-delete-project', e => {
        const id = $(e.currentTarget).data('id');
        ajaxRequest(routes.deleteProject(id), 'DELETE', {}, () => handleDeleteSuccess(id), showMessage);
    });
}

function ajaxRequest(url, method, data, successCallback, errorCallback) {
    $.ajax({
        url,
        type: method,
        data,
        contentType: false,
        processData: false,
        dataType: "json",
        success: successCallback,
        error: errorCallback
    });
}

function renderProjects(response) {
    const tbody = $('tbody').empty();
    const tfoot = $('tfoot');
    //render sponors rows
    response.projects.data.forEach(item => {
        tbody.append(renderTableRow(item));
    });
    tfoot.append(renderPaginationBar(response.projects, renderProjects));
}

function renderTableRow(item) {
    return (`
    <tr id="tr_${item.id}">
        <td>${item.id}</td>
        <td>${item.name}</td>
        <td>${item.description}</td>
        <td>${item.location}</td>
        <td>${item.category.name}</td>
        <td><img src="${window.location.origin +'/' + item.image}" /></td>
        <td>${item['start date']}</td>
        <td>${item['finish date']}</td>
        <td><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target=".Editser" data-id="${item.id}" class="btn btn-info btn-edit-stu">Edit</a></td>
        <td><a href="javascript:void(0)" data-id="${item.id}" class="btn btn-danger btn-delete-project">Delete</a></td>
    </tr>`);
}

function populateEditForm(response) {
    $('#eName').val(response.project.name);
    $('#eDescription').val(response.project.description);
    $('#eLocation').val(response.project.location);
    $('#eStart_date').val(response.project['start date']);
    $('#eFinish_date').val(response.project['finish date']);
    $('#eCategory').val(response.project.category_id);
    $('#editId').val(response.project.id);
}




function handleFormSuccess(modalSelector) {
    $(modalSelector).modal('hide');
    fetchProjects();
    showMessage('Operation successful', 'alert-success');
}

function handleDeleteSuccess(id) {
    $(`#tr_${id}`).slideUp('slow');
    showMessage('News Deleted successfully', 'alert-success');
}

function showMessage(text, alertClass, error = null) {
    if (error) {
        console.error(error);
        text = 'An error occurred. Please try again';
        alertClass = 'alert-danger';
    }
    $('#message').addClass(alertClass).text(text).fadeIn().delay(500).fadeOut();
}