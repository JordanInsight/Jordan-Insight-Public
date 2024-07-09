const cityData = JSON.parse($("#cityData").val());
const BASE_URL = "http://127.0.0.1:8000/userPlan";
let activities = []; // Local storage for activities

$(document).ready(function () {
    $("#categories").change(categoriesChange);
    $(document).on("change", "#cuisines input:checkbox", cuisinesChange);
    $("#addActivityBtn").click(addActivity);
    $("#submitDayBtn").click(submitDay);
    $(document).on("click", ".delete-activity", deleteActivity);
});

function makeRequest(route, successCallback) {
    $("#loading").removeClass("d-none");
    $(".card-body").addClass("d-none");

    $.get(route)
        .done(successCallback)
        .fail(function () {
            alert("An error occurred while fetching data. Please try again.");
        })
        .always(function () {
            $("#loading").addClass("d-none");
            $(".card-body").removeClass("d-none");
        });
}

function createCheckbox(id, value, label, name) {
    return `
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name=${name} value="${value}" id="${id}">
            <label class="form-check-label" for="${id}">
                ${label}
            </label>
        </div>
    `;
}

function populateCuisines(data) {
    $("#cuisines").empty();
    $.each(data.restaurants, function (index, restaurant) {
        $("#cuisines").append(
            `
            <div class="form-check">
                <input class="form-check-input" type="checkbox" name="cuisines" value="${restaurant[0].id}" id="cuisine${index}">
                <label class="form-check-label" for="cuisine${index}">
                ${restaurant[0].cuisine}
                </label>
            </div>
        `
        );
    });

    $("#cuisines").show();
    $("#cuisineSelect").show();
}

function populateHistoricalSites(data) {
    $("#historicalSites").empty();
    $.each(data.sites, function (index, site) {
        $("#historicalSites").append(
            createCheckbox(
                `site${index}_${site.id}`,
                site.id,
                site.site_name,
                "sites"
            )
        );
    });
    $("#historicalSites").show();
    $("#historicalSitesSelect").show();
}

function populateRestaurants(data) {
    $("#restaurantsList").empty();
    $.each(data.restaurantsByCuisines, function (cuisineIndex, cuisine) {
        $.each(cuisine, function (restaurantIndex, restaurant) {
            $("#restaurantsList").append(
                createCheckbox(
                    `cuisine${cuisineIndex}_${restaurantIndex}`,
                    restaurant.id,
                    restaurant.restaurant_name,
                    "restaurants"
                )
            );
        });
    });
    $("#restaurants").show();
    $("#restaurantsList").show();
}

function categoriesChange() {
    let categoryId = $("#categories").val();
    let route = `${BASE_URL}/category/${categoryId}`;

    if (+categoryId === 1) {
        route = `${BASE_URL}/city/restaurants/${cityData.id}`;
        makeRequest(route, populateCuisines);
    } else if (+categoryId === 2) {
        route = `${BASE_URL}/city/historicalSites/${cityData.id}`;
        makeRequest(route, populateHistoricalSites);
    }
}

function cuisinesChange() {
    let checkedBoxes = $("#cuisines input:checkbox:checked");

    if (checkedBoxes.length >= 3) {
        let restaurant_ids = $.map(checkedBoxes, function (box) {
            return $(box).val();
        });

        const route = `${BASE_URL}/restaurants/cuisines/${restaurant_ids}`;
        makeRequest(route, populateRestaurants);
    } else {
        $("#restaurantsList").empty();
        $("#restaurants").hide();
        $("#restaurantsList").hide();
    }
}

function addActivity() {
    const selectedCategory = $("#categories option:selected").text();
    const selectedCuisines = $("#cuisines input:checkbox:checked").map(function() {
        return $(this).next("label").text();
    }).get();
    const selectedHistoricalSites = $("#historicalSites input:checkbox:checked").map(function() {
        return $(this).next("label").text();
    }).get();
    const selectedRestaurants = $("#restaurantsList input:checkbox:checked").map(function() {
        return $(this).next("label").text();
    }).get();

    const dayNumber = $("#currentDay").text().split(" ")[1];
    const activityId = new Date().getTime(); // Generate a unique ID for the activity
    const activity = {
        id: activityId,
        day: dayNumber,
        category: selectedCategory,
        cuisines: selectedCuisines,
        historicalSites: selectedHistoricalSites,
        restaurants: selectedRestaurants
    };
    activities.push(activity);
    updateActivitiesList();
}

function submitDay() {
    addActivity();
    const currentDay = parseInt($("#currentDay").text().split(" ")[1]);
    const nextDay = currentDay + 1;
    $("#currentDay").text(`Day ${nextDay}:`);
    $("#activityDay").text(`Day ${nextDay}:`);
}

function deleteActivity() {
    const activityId = $(this).data("id");
    activities = activities.filter(activity => activity.id !== activityId);
    updateActivitiesList();
}

function updateActivitiesList() {
    $("#activities").empty();
    activities.forEach(activity => {
        const activityHtml = `
            <li class="list-group-item">
                <strong>Day ${activity.day}:</strong>
                <p>Category: ${activity.category}</p>
                ${activity.cuisines.length > 0 ? `<p>Cuisines: ${activity.cuisines.join(", ")}</p>` : ""}
                ${activity.historicalSites.length > 0 ? `<p>Historical Sites: ${activity.historicalSites.join(", ")}</p>` : ""}
                ${activity.restaurants.length > 0 ? `<p>Restaurants: ${activity.restaurants.join(", ")}</p>` : ""}
                <button type="button" class="btn btn-danger btn-sm delete-activity" data-id="${activity.id}">Delete</button>
            </li>
        `;
        $("#activities").append(activityHtml);
    });
}
