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
    if (jqXHR.status === 400) {
        const errors = jqXHR.responseJSON;

        addErrorClassToFields(errors, modalSelector);
        removeErrorClassOnInput(modalSelector);

        const errorMessageElement = displayErrorMessages(errors, modalSelector);
        hideErrorMessagesAfterDelay(errorMessageElement, modalSelector);
    }
}
