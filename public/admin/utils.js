import {fetchContent}  from './scripts/main.js';


export function generateActionButtons(id) {
    return `
        <td><a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target=".Editser" data-id="${id}" class="btn btn-info btn-edit-stu">Edit</a></td>
        <td><a href="javascript:void(0)" data-id="${id}" class="btn btn-danger btn-delete">Delete</a></td>
    `;
}
export function handleFormSuccess(modalSelector,fetchRoute,renderContent,message) {
    $(modalSelector + " input").val("");
    $(modalSelector).modal("hide");
    fetchContent(fetchRoute,renderContent);
    showMessage(message, "alert-success");
}
export function showMessage(text, alertClass, error = null) {
    if (error) {
        console.error(error);
        text = 'An error occurred. Please try again';
        alertClass = 'alert-danger';
    }
    $('#message').addClass(alertClass).text(text).fadeIn().delay(500).fadeOut();
}

export function handleDeleteSuccess(id, message) {
    $(`#tr_${id}`).slideUp('slow');
    showMessage(message, 'alert-success');
}
function addErrorClassToFields(errors, modalSelector) {
    
    for (const field in errors) {
     
        const inputField = $(`${modalSelector} input[name=${field}]`);
       
        inputField.addClass("is-invalid");
    }
}

function removeErrorClassOnInput(modalSelector) {
    $(modalSelector + " input").on("input", function () {
        $(this).removeClass("is-invalid");
    });
}

function displayErrorMessages(errors, modalSelector) {
    let errorMessages = "<ul>";

    for (const field in errors) {
        errorMessages += `<li>${errors[field]}</li>`;
    }

    errorMessages += "</ul>";

    const errorMessageElement = $(`${modalSelector} .error-messages`);
    errorMessageElement.html(errorMessages).show();

    return errorMessageElement;
}

function hideErrorMessagesAfterDelay(errorMessageElement, modalSelector) {
    setTimeout(() => {
        errorMessageElement.fadeOut("slow", function () {
            $(`${modalSelector} input`).removeClass("is-invalid");
        });
    }, 2000);
}

export function handleFormError(jqXHR, modalSelector) {
    if (jqXHR.status === 422) {
        const errors = jqXHR.responseJSON.errors;

        addErrorClassToFields(errors, modalSelector);
        removeErrorClassOnInput(modalSelector);

        const errorMessageElement = displayErrorMessages(errors, modalSelector);
        hideErrorMessagesAfterDelay(errorMessageElement, modalSelector);
    }
}
