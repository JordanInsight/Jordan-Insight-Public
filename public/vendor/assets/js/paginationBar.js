let renderFunction = () => {};
function setupAjax() {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });
}

$(document).ready(function () {
    setupAjax();

    setTimeout(() => {
        $(document).on("click", ".btn-link", function (e) {
            e.preventDefault();
            const url = $(this).attr("href");
            fetchPage(url, renderFunction);
        });
    }, 500);
});
function createPaginationItem(
    content,
    url,
    isActive = false,
    isDisabled = false
) {
    let itemClass = `page-item ${isActive ? "active" : ""} ${
        isDisabled ? "disabled" : ""
    }`;
    let linkClass = `page-link ${isActive ? "" : "btn-link"}`;
    return $(
        `<li class="${itemClass}"><a class="${linkClass}" href="${url}">${content}</a></li>`
    );
}

function addFirstAndPrevious(list , response) {
    list.append(createPaginationItem("First", response.first_page_url));
    list.append(createPaginationItem("«", response.prev_page_url));
}

function addPageNumbers(list, currentPage, totalPages, path, range) {
    let startPage = Math.max(currentPage - range, 1);
    let endPage = Math.min(currentPage + range, totalPages);

    for (let i = startPage; i <= endPage; i++) {
        list.append(
            createPaginationItem(i, `${path}?page=${i}`, currentPage === i)
        );
    }
}
function addNextAndLast(list, response) {
    list.append(createPaginationItem("»", response.next_page_url));
    list.append(createPaginationItem("Last", response.last_page_url));
}
export function renderPaginationBar(response, renderFunctions) {
    const paginationBar = $("#pagination-bar").empty();
    const tfoot = $("#footer").empty();
    const totalPages = response.last_page;
    const currentPage = response.current_page;
    const range = 5; // This is the range of page numbers to show around the current page
    const paginationList = $('<ul class="pagination"></ul>');
    renderFunction = renderFunctions;
    addFirstAndPrevious(paginationList , response);
    addPageNumbers(
        paginationList,
        currentPage,
        totalPages,
        response.path,
        range
    );
    addNextAndLast(paginationList, response);

    paginationBar.append(paginationList);
    tfoot.append(paginationBar);
}

function fetchPage(url, renderFunction) {
    $.ajax({
        url: url,
        method: "get",
        success: function (response) {
            renderPaginationBar(response); // Call to render pagination bar
            renderFunction(response); // Render the projects with the given response
        },
        error: function (error) {},
    });
}
