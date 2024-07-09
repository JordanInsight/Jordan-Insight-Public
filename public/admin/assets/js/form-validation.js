$(function () {
    "use strict";

    $("#signupForm").validate({
        rules: {
            first_name: {
                required: true,
                minlength: 3,
            },
            last_name: {
                required: true,
                minlength: 3,
            },
            email: {
                required: true,
                email: true,
            },
            password: {
                required: true,
                passwordStrength: true,
            },
            password_confirmation: {
                required: true,
                minlength: 8,
                equalTo: "#password",
            },
        },
        messages: {
            first_name: {
                required: "Please enter your first name",
                minlength: "First name must consist of at least 3 characters",
            },
            last_name: {
                required: "Please enter your last name",
                minlength: "Last name must consist of at least 3 characters",
            },
            email: "Please enter a valid email address",
            password: {
                required: "Please provide a password",
            },
            password_confirmation: {
                required: "Please confirm your password",
                minlength: "Your password must be at least 8 characters long",
                equalTo: "Please enter the same password as above",
            },
        },
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            if (element.parent(".input-group").length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element, errorClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
        },
    });

    $("#changePasswordForm").validate({
        rules: {
            recent_password: {
                required: true,
                minlength: 8,
            },
            new_password: {
                required: true,
                minlength: 8,
            },
            "new_password_confirmation": {
                required: true,
                minlength: 8,
                equalTo: '[name="new_password"]',
            },
        },
        messages: {
            recent_password: {
                required: "Please enter your current password",
                minlength: "Your password must be at least 8 characters long",
            },
            new_password: {
                required: "Please enter a new password",
                minlength:
                    "Your new password must be at least 8 characters long",
            },
            "confirm-password": {
                required: "Please confirm your new password",
                minlength: "Your password must be at least 8 characters long",
                equalTo: "Please enter the same password as above",
            },
        },
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            if (element.parent(".input-group").length) {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        highlight: function (element, errorClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass("is-invalid").addClass("is-valid");
        },
    });
});
