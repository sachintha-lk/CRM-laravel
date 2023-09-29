<?php

use App\Enums\UserRolesEnum;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/test', [App\Http\Controllers\AdminDashboardHome::class, 'index'])->name('test');

Route::get('/', function () {
    return view('web.home');
})->name('home');

Route::get('/services', [App\Http\Controllers\DisplayService::class, 'index'])->name('services');
Route::get('/services/{slug}', [App\Http\Controllers\DisplayService::class, 'show'])->name('view-service');

// Route::get('/services/{id}', [App\Http\Controllers\ServiceDisplay::class, 'show'])->name('services.show');
Route::get('/deals', [App\Http\Controllers\DisplayDeal::class, 'index'])->name('deals');


// Users needs to be logged in for these routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [App\Http\Controllers\DashboardHomeController::class, 'index'])->name('dashboard');

        // middleware to give access only for admin
        Route::middleware([
            'validateRole:Admin'
        ])->group(function () {
            Route::resource('manageusers', App\Http\Controllers\UserController::class)->name('index', 'manageusers');
            Route::put('manageusers/{id}/suspend', [App\Http\Controllers\UserSuspensionController::class, 'suspend'])->name('manageusers.suspend');
            Route::put('manageusers/{id}/activate', [App\Http\Controllers\UserSuspensionController::class, 'activate'])->name('manageusers.activate');

            Route::get('managelocations', function () {
                return view('dashboard.manage-locations.index');
            })->name('managelocations');

        });

        // middlleware to give access only for admin and employee
        Route::middleware([
            'validateRole:Admin,Employee'
        ])->group(function () {
            Route::get('manageservices', function () {
                return view('dashboard.manage-services.index');
            })->name('manageservices');

            Route::get('managedeals', function () {
                return view('dashboard.manage-deals.index');
            })->name('managedeals');

            Route::get('managecategories', function () {
                return view('dashboard.manage-categories.index');
            })->name('managecategories' );

            Route::get('managecategories/create', function () {
                return view('dashboard.manage-categories.index');
            })->name('managecategories.create');

            Route::get('manageappointments', function () {
                return view('dashboard.manage-appointments.index');
            })->name('manageappointments');
        });

        Route::middleware([
            'validateRole:Customer'
        ])->group(function () {

            // Get the cart of the user that is not paid
            Route::get('cart', [App\Http\Controllers\CartController::class, 'index'])->name('cart');

            // Add a service to the cart
            Route::post('cart', [App\Http\Controllers\CartController::class, 'store'])->name('cart.store');

            // Remove item from cart
            Route::delete('cart/item/{cart_service_id}', [App\Http\Controllers\CartController::class, 'removeItem'])->name('cart.remove-item');

            // Remove a service from the cart
            Route::delete('cart/{id}', [App\Http\Controllers\CartController::class, 'destroy'])->name('cart.destroy');

            // Checkout the cart
            Route::post('cart/checkout', [App\Http\Controllers\CartController::class, 'checkout'])->name('cart.checkout');

            // Get the appointments of the user
//            Route::get('appointments', [App\Http\Controllers\AppointmentController::class, 'index'])->name('appointments');
//
//            // View an appointment
//            Route::get('appointments/{appointment_code}', [App\Http\Controllers\AppointmentController::class, 'show'])->name('appointments.show');
//
//            // Cancel an appointment
//            Route::delete('appointments/{appointment_code}', [App\Http\Controllers\AppointmentController::class, 'destroy'])->name('appointments.destroy');




        });
    });
});
