<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\VendorTourController;
use Illuminate\Support\Facades\Route;


use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProfileController;
use App\Http\Controllers\AdminTourController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\CityController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\TourDetailsController;
use App\Http\Controllers\TourStandardController;
use App\Http\Controllers\UserPlanFetchController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HistoricalSiteController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TourReservationController;
use App\Http\Controllers\UserPlanController;

use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\VendorController;
use App\Models\Role;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------

| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['admin']], function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('index');
    Route::post('/profile/{user}/update', [AdminProfileController::class, 'update'])->name('admin.profile.update');
    Route::post('/admin/profile/{user}/upload-image', [AdminProfileController::class, 'uploadProfileImage'])->name('profile.upload-image');
    Route::post('/admin/profile/update/password/{user}', [UserProfileController::class, 'updatePassword'])->name('user.profile.update.password');


    Route::get('city/fetch', [CityController::class, 'fetch'])->name('city.fetch');
    Route::resource('city', CityController::class);

    Route::get('role/fetch', [RoleController::class, 'fetch'])->name('role.fetch');
    Route::resource('role', RoleController::class);


    Route::get('location/fetch', [LocationController::class, 'fetch'])
        ->name('location.fetch');


    Route::resource('location', LocationController::class);

    Route::get('Category/fetch', [CategoryController::class, 'fetch'])->name('Category.fetch');
    Route::post('Category/{Category}', [CategoryController::class, 'update'])->name('Category.update');
    Route::resource('Category', CategoryController::class)->except('update');

    Route::get('hotel/fetch', [HotelController::class, 'fetch'])->name('hotel.fetch');
    Route::post('hotel/{hotel}', [HotelController::class, 'update'])->name('hotel.update');
    Route::resource('hotel', HotelController::class)->except('update');


    Route::get('restaurant/fetch', [RestaurantController::class, 'fetch'])->name('restaurant.fetch');
    Route::post('restaurant/{restaurant}', [RestaurantController::class, 'update'])->name('restaurant.update');
    Route::resource('restaurant', RestaurantController::class)->except('update');

    Route::get('historicalSite/fetch', [HistoricalSiteController::class, 'fetch'])->name('historicalSite.fetch');
    Route::post('historicalSite/{historicalSite}', [HistoricalSiteController::class, 'update'])->name('historicalSite.update');
    Route::resource('historicalSite', HistoricalSiteController::class)->except('update', 'create', 'show');


    Route::get('user/fetch', [UsersController::class, 'fetch'])->name('user.fetch');
    Route::post('user/{user}', [UsersController::class, 'update'])->name('user.update');
    Route::resource('user', UsersController::class)->except('update', 'store');

    Route::get('reservation/fetch/cars', [ReservationController::class, 'fetchCarReservations'])->name('reservation.fetch.cars');
    Route::get('reservation/fetch/tours', [ReservationController::class, 'fetchTourReservations'])->name('reservation.fetch.tours');
    Route::get('reservation/fetch/available-cars', [ReservationController::class, 'fetchAvailableCars'])->name('reservation.fetch.available-cars');
    Route::post('reservation/{reservation}', [ReservationController::class, 'update'])->name('reservation.update');
    Route::resource('reservation', ReservationController::class)->except(['update']);

    Route::get('activity/fetch', [ActivityController::class, 'fetch'])->name('activity.fetch');
    Route::post('activity/{activity}', [ActivityController::class, 'update'])->name('activity.update');
    Route::resource('activity', ActivityController::class)->except('update');

    Route::get('car/fetch', [CarController::class, 'fetch'])->name('car.fetch');
    Route::post('car/{car}', [CarController::class, 'update'])->name('car.update');
    Route::resource('car', CarController::class)->except('update');

    Route::get('tour', [AdminTourController::class, 'index'])->name('tour.index');
    Route::get('tour/fetch', [AdminTourController::class, 'fetchTours'])->name('tour.fetch');
    Route::post('tour', [AdminTourController::class, 'store'])->name('tour.store');
    Route::get('tour/{tour}', [AdminTourController::class, 'show'])->name('tour.show');
    Route::put('tour/{tour}', [AdminTourController::class, 'update'])->name('tour.update');
    Route::delete('tour/{tour}', [AdminTourController::class, 'destroy'])->name('tour.destroy');
    Route::get('activities', [AdminTourController::class, 'fetchActivities']);
    Route::get('historical-sites', [AdminTourController::class, 'fetchHistoricalSites']);
    Route::get('restaurants', [AdminTourController::class, 'fetchRestaurants']);
});

Route::group(['prefix' => 'vendor', 'as' => 'vendor.', 'middleware' => ['vendor']], function () {
    Route::get('/dashboard', [VendorController::class, 'dashboard'])->name('index');
    Route::post('/profile/{user}/update', [VendorController::class, 'update'])->name('profile.update');
    Route::post('/vendor/profile/{user}/upload-image', [VendorController::class, 'uploadProfileImage'])->name('profile.upload-image');
    Route::post('/vendor/profile/update/password/{user}', [VendorController::class, 'updatePassword'])->name('user.profile.update.password');

    Route::get('car/fetch', [CarController::class, 'fetch'])->name('car.fetch');
    Route::post('car/{car}', [CarController::class, 'update'])->name('car.update');
    Route::get('car', [CarController::class, 'vendorIndex'])->name('car.index');
    Route::resource('car', CarController::class)->except('update', 'index');


    Route::get('tour', [VendorTourController::class, 'index'])->name('tour.index');
    Route::get('tour/fetch', [VendorTourController::class, 'fetchTours'])->name('tour.fetch');
    Route::post('tour', [VendorTourController::class, 'store'])->name('tour.store');
    Route::get('tour/{tour}', [VendorTourController::class, 'show'])->name('tour.show');
    Route::put('tour/{tour}', [VendorTourController::class, 'update'])->name('tour.update');
    Route::delete('tour/{tour}', [VendorTourController::class, 'destroy'])->name('tour.destroy');
    Route::get('activities', [VendorTourController::class, 'fetchActivities']);
    Route::get('historical-sites', [VendorTourController::class, 'fetchHistoricalSites']);
    Route::get('restaurants', [VendorTourController::class, 'fetchRestaurants']);
});



Route::get('/', [MainController::class, 'index'])->name('base');

Route::get('/contact', [MainController::class, 'contact'])->name('contact');
Route::get('/About', [MainController::class, 'about'])->name('about');

Route::get('/admin/login', [LoginController::class, 'showAdminLoginForm'])->name('admin.login.view');
Route::post('/admin/login', [LoginController::class, 'handleAdminLogin'])->name('admin.login');

Route::get('/vendor/login', [LoginController::class, 'showVendorLoginForm'])->name('vendor.login.view');
Route::post('/vendor/login', [LoginController::class, 'handleVendorLogin'])->name('vendor.login');



Route::get('/', [MainController::class, 'index'])->name('base');
Route::get('/destinations', [MainController::class, 'destinations'])->name('destinations');
Route::get('/destinations/amman', [MainController::class, 'destinationsAmman'])->name('destinationsAmman');
Route::get('/destinations/deadsea', [MainController::class, 'destinationsDeadsea'])->name('destinationsDeadsea');
Route::get('/destinations/petra', [MainController::class, 'destinationsPetra'])->name('destinationsPetra');
Route::get('/destinations/ajloun', [MainController::class, 'destinationsAjloun'])->name('destinationsAjloun');
Route::get('/destinations/aqaba', [MainController::class, 'destinationsAqaba'])->name('destinationsAqaba');
Route::get('/destinations/jerash', [MainController::class, 'destinationsJerash'])->name('destinationsJerash');
Route::get('/destinations/madaba', [MainController::class, 'destinationsMadaba'])->name('destinationsMadaba');
Route::get('/destinations/wadirum', [MainController::class, 'destinationsWadirum'])->name('destinationsWadirum');
Route::get('/destinations/zarqa', [MainController::class, 'destinationsZarqa'])->name('destinationsZarqa');


Route::get('/pages/hotel', [MainController::class, 'pageHotel'])->name('pageHotel');
Route::get('/pages/hotel/fetch', [MainController::class, 'pageHotelFetch'])->name('pageHotelFetch');


Route::get('/pages/tour', [MainController::class, 'pageTour'])->name('pageTour');
Route::get('/pages/tour/fetch', [MainController::class, 'pageTourFetch'])->name('pageTourFetch');

Route::get('/pages/historical-site', [MainController::class, 'pageHistoricalSite'])->name('pageHistoricalSite');
Route::get('/pages/historical-site/fetch', [MainController::class, 'pageHistoricalSiteFetch'])->name('pageHistoricalSiteFetch');

Route::get('/search-cities', [CityController::class, 'search'])->name('search.cities');
Route::get('/pages/restaurant', [MainController::class, 'pageRestaurant'])->name('pageRestaurant');
Route::get('/pages/restaurant/fetch', [MainController::class, 'pageRestaurantFetch'])->name('pageRestaurantFetch');

Route::get('/pages/activity', [MainController::class, 'pageActivity'])->name('pageActivity');
Route::get('/pages/activity/fetch', [MainController::class, 'pageActivityFetch'])->name('pageActivityFetch');

Route::get('/pages/car', [MainController::class, 'pageCar'])->name('pageCar');
Route::get('/pages/car/fetch', [MainController::class, 'pageCarFetch'])->name('pageCarFetch');


Route::middleware(['auth'])->group(function () {
    Route::get('/checkout', [ReservationController::class, 'checkout'])->name('checkout');
    Route::post('/checkout/payment', [ReservationController::class, 'processPayment'])->name('checkout.payment');
    Route::get('/reservation/success', [ReservationController::class, 'reservationSuccess'])->name('reservation.success');
});


Route::middleware(['auth'])->group(function () {
    Route::get('/tour/checkout', [TourReservationController::class, 'checkout'])->name('tour.checkout');
    Route::post('/tour/checkout/payment', [TourReservationController::class, 'processPayment'])->name('tour.checkout.payment');
    Route::get('/tour/reservation/success', [TourReservationController::class, 'reservationSuccess'])->name('tour.reservation.success');
});







Route::prefix('userPlan')->name('userPlan.')->middleware('auth')->group(function () {
    // Group for UserPlanController which responsible for creating a new user plan 
    Route::controller(UserPlanController::class)->group(function () {

        Route::post('/createNewTour', 'createNewTour')->name('createNewTour');
        // Route::post('/ManualTour', 'manualTour')->name('manualTour');
        // Route::get('/ManualTour', 'showProcessedTour')->name('showProcessedTour');
    });

    // Group for UserPlanFetchController which responsible for fetching data for the user plan
    Route::controller(UserPlanFetchController::class)->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/city/restaurants/{city_id}', 'showRestaurants')->name('restaurants');
        Route::get('/city/activities/{city_id}', 'showActivities')->name('activities');
        Route::get('/city/historicalSites/{city_id}', 'showHistoricalSites')->name('historicalSites');
        Route::get('/restaurants/cuisines/{restaurant_ids}', 'showCuisine')->name('restaurantsCuisines');
        Route::get('/category/{category}', 'showEntitiesByCategory')->name('category');
    });
});



//Route::get('/tour-sidebar', [MainController::class, 'tourSidebar'])->name('tour');
Route::get('/tour-sidebar/userPlan', [UserPlanController::class, 'index'])->name('userPlan');
Route::post('tour-sidebar/userPlan', [UserPlanController::class, 'showeOptions'])->name('userPlan.update');
Route::get('/city/restaurants/{hotel_id}', [UserPlanController::class, 'showRestaurants'])->name('userPlan.restaurants');



// Group all routes under a common prefix 'blog' and apply a name prefix 'blog.'
Route::prefix('/blog')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('blog');
    Route::get('/fetch', [BlogController::class, 'fetch'])->name('blog.fetch');
    Route::get('/search', [BlogController::class, 'postSearch'])->name('post.search');
    Route::get('/details/{id}', [BlogController::class, 'postDetails'])->name('post.details');
    Route::get('/details/fetch/{id}', [BlogController::class, 'fetchPostDetails'])->name('fetch.post.details');
    Route::get('/fetch-recent', [BlogController::class, 'fetchRecentPosts'])->name('blog.fetch.recent');
    Route::post('/{postId}/like', [BlogController::class, 'toggleLike'])->name('post.like')->middleware('auth');
    Route::post('/{post}/comments/{comment}/like', [BlogController::class, 'toggleCommentLike'])->name('comment.like')->middleware('auth');
});

// Authenticated Routes (assuming BlogController handles all)
Route::controller(BlogController::class)->group(function () {
    Route::post('/blog/post/store', 'store')->name('blog.post.store');
    Route::post('/blog/post/{post}/update', 'updatePost')->name('post.update')->middleware('auth');
    Route::delete('/blog/post/{post}/delete', 'deletePost')->name('post.delete')->middleware('auth');
    Route::post('/blog/post-comment/{postId}', 'storeComment')->name('post-comment');
    Route::post('/blog/comment/{comment}/update', 'updateComment')->name('comment.update')->middleware('auth');
    Route::delete('/blog/comment/{comment}/delete', 'deleteComment')->name('comment.delete')->middleware('auth');
});


Route::get('login', [LoginController::class, 'index'])->middleware('guest')->name('login');
Route::post('login', [LoginController::class, 'login'])->middleware('guest');

Route::get('register', [RegisterController::class, 'index'])->middleware('guest')->name('register');
Route::post('register', [RegisterController::class, 'register'])->middleware('guest');

Route::post('logout', [LogoutController::class, 'logout'])->name('logout');
Route::post('admin/logout', [LogoutController::class, 'Adminlogout'])->name('admin.logout');
Route::post('vendor/logout', [LogoutController::class, 'Vendorlogout'])->name('vendor.logout');



// Group all routes under a common prefix 'user/profile' and apply a name prefix 'user.profile.'
Route::prefix('user/profile')->name('user.profile.')->middleware('auth')->group(function () {
    Route::controller(UserProfileController::class)->group(function () {
        Route::get('/{user}', 'show')->name('show');
        Route::get('/fetch/{user}', 'fetch')->name('fetch');
        Route::post('/picture/{user}', 'uploadProfileImage')->name('picture');
        Route::post('/create/post/{user}', 'store')->name('post');
        Route::post('/setting/update/{user}', 'updatePofile')->name('update');
        Route::post('/setting/update/password/{user}', 'updatePassword')->name('update.password');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/user/profile/{user}', [UserProfileController::class, 'show'])->name('user.profile');
    Route::get('/user/profile/fetch/{user}', [UserProfileController::class, 'fetch'])->name('user.profile.fetch');
    Route::post('/user/profile/picture/{user}', [UserProfileController::class, 'uploadProfileImage'])->name('user.profile.picture');

    Route::post('/user/profile/create/post/{user}', [UserProfileController::class, 'store'])->name('user.profile.post');
});


Route::get('/user/forgot/password', [ResetPasswordController::class, 'showForgotPasswordForm'])->name('forgotPasswordForm');
Route::post('/user/forgot/password', [ResetPasswordController::class, 'sendResetLink'])->name('sendResetLink');
Route::get('/user/reset/password/{token}', [ResetPasswordController::class, 'showResetPasswordForm'])->name('resetPasswordForm');
Route::post('/user/reset/password', [ResetPasswordController::class, 'resetPassword'])->name('resetPassword');


Route::get('/tour-standard', [TourStandardController::class, 'index'])->name('tour-standard.index');
Route::get('/tour-standard/fetch', [TourStandardController::class, 'fetch'])->name('tour-standard.fetch');
Route::get('/tour-standard/search', [TourStandardController::class, 'searchFetch'])->name('tour-standard.search');

Route::get('/tour-details/{tour}', [TourDetailsController::class, 'index'])->name('tour-details.index');


Route::resource('review', ReviewController::class);
