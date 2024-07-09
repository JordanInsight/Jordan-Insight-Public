// admin-login-validation.js
function validateAdminLoginForm() {
    var email = document.getElementById('admin-email').value.trim();
    var password = document.getElementById('admin-password').value;
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/; // Simple email regex for demonstration

    // Validate email format
    if (!emailRegex.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    // Check password length
    if (password.length < 8) { // Assuming you want a minimum length
        alert("Your password must be at least 8 characters long.");
        return false;
    }

    return true; // If all validations pass, allow form submission
}

document.addEventListener('DOMContentLoaded', function() {
    const adminLoginForm = document.getElementById('admin-login-form');

    // Attach the validation function to the form submit event
    if (adminLoginForm) {
        adminLoginForm.onsubmit = validateAdminLoginForm;
    }
});
