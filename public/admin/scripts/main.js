import {
    showMessage,
    handleDeleteSuccess,
    handleFormError,
    handleFormSuccess,
} from "../utils.js";
import { setupAjax, ajaxRequest } from "../ajaxSetup.js";

export function ready(...callbacks) {
    $(document).ready(function () {
        callbacks.forEach((callback) => callback());
    });
}

export function fetchContent(route, renderContent) {
    ajaxRequest(route, "GET", {}, renderContent, showMessage);
}
export function setupDeleteButton(route) {
    $(document).on("click", ".btn-delete", (e) => {
        const id = $(e.currentTarget).data("id");
        if (confirm("Are you sure you want to delete this?")) {
            ajaxRequest(
                route(id),
                "DELETE",
                {},
                (response) => handleDeleteSuccess(id,response.message),
                showMessage
            );
        }
    });
}

export function setupEditButton(route, populateEditForm) {
    $(document).on("click", ".btn-edit-stu", (e) => {
        const id = $(e.currentTarget).data("id");
        ajaxRequest(route(id), "GET", {}, populateEditForm, showMessage);
    
    
    });
}
export function setupAddForm(
    route,
    formSelector,
    modalSelector,
    renderContent,
    fetchRoute
) {
    $(formSelector).on("submit", (e) => {
        e.preventDefault();
        
        let formData = new FormData(e.currentTarget);
        ajaxRequest(
            route,
            "POST",
            formData,
            (response) =>{ handleFormSuccess(modalSelector, fetchRoute, renderContent,response.message);
                },
            (jqXHR) => handleFormError(jqXHR, modalSelector),
            false, // contentType
            false // processData
        );
    });
}
export function setupEditForm(route, method, formSelector, modalSelector, renderContent, fetchRoute) {
    $(formSelector).on("submit", (e) => {
        e.preventDefault();
        const id = $(formSelector + " #editId").val();
        let data;
        if (method === "POST") {
            data = new FormData(e.target);
        } else {
            data = $(e.currentTarget).serialize();
        }

        ajaxRequest(
            route.replace("PLACEHOLDER", id),
            method,
            data,
            (response) => handleFormSuccess(modalSelector, fetchRoute, renderContent,response.message),
            (jqXHR) => handleFormError(jqXHR, modalSelector)
        );
    });
}

ready(setupAjax);
