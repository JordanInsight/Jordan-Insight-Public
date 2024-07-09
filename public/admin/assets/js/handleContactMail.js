 const routes = {
        addMessage: window.location.origin +'/admin/message',
    };
    $(document).ready(function() {
        setupAjax();
        bindEvents();
    });

    function setupAjax() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }

    function bindEvents() {
        $('#contact-form').on('submit', e => {
            // console.log(e.currentTarget.value());
            formData = new FormData(e.currentTarget);
            e.preventDefault();
            ajaxRequest(routes.addMessage, 'POST', $(e.currentTarget).serialize(), () => {
                    handleFormSuccess();
                    $('#contact-form input').val('');
                    $('#contact-form textarea').val('');

                },
                showMessage);
        });
    }

    function ajaxRequest(url, method, data, successCallback, errorCallback) {
        $.ajax({
            url,
            type: method,
            data,

            success: successCallback,
            error: errorCallback
        });
    }


    function handleFormSuccess() {
        showMessage('Message sent successfully', 'alert-success');
    }

    function showMessage(text, alertClass, error = null) {
        if (error) {
            console.error(error);
            text = 'An error occurred. Please try again';
            alertClass = 'alert-danger';
        }
        $('#message').addClass('alert ' + alertClass).text(text).show();
        setTimeout(function() {
            $('#message').hide().removeClass('alert ' + alertClass);
        }, 500); // Hide the message after 5 seconds
    }
    