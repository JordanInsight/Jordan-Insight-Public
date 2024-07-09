export function setupAjax() {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
}

export function ajaxRequest(url, method, data, successCallback, errorCallback) {
    let options = {
        url,
        type: method,
        data,
        dataType: "json",
        success: successCallback,
        error: errorCallback,
    };

    if (data instanceof FormData) {
        options.contentType = false;
        options.processData = false;
    } else {
        options.contentType = 'application/x-www-form-urlencoded; charset=UTF-8';
        options.processData = true;
    }

    $.ajax(options);
}