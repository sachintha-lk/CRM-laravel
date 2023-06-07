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

Route::get('/', function () {
    return view('web.home');
})->name('home');

Route::get('/services', [App\Http\Controllers\ServiceDisplay::class, 'index'])->name('services');

// Users needs to be logged in for these routes
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    
    Route::get('/dashboard', function () {

        return view('dashboard.index');
    })->name('dashboard');

    // middleware give access only for admin
    Route::middleware([
        'validateRole:Admin'
        ])->group(function () {

            Route::resource('dashboard/manageusers', App\Http\Controllers\UserController::class)->name('index','manageusers');
            Route::put('dashboard/manageusers/{id}/suspend', [App\Http\Controllers\UserSuspensionController::class, 'suspend'])->name('manageusers.suspend');
            Route::put('dashboard/manageusers/{id}/activate', [App\Http\Controllers\UserSuspensionController::class, 'activate'])->name('manageusers.activate');

    });


    // middlleware to give access only for admin and employee
    Route::middleware([
        'validateRole:Admin,Employee'
        ])->group(function () {
            
         
            // Route::resource('dashboard/manageservices', App\Http\Controllers\ManageService::class)->name('index','manageservices');
            Route::get('dashboard/manageservices', function () {
                return view('dashboard.manage-services.index');
            })->name('manageservices');
          
            Route::get('dashboard/managedeals', function () {
                return view('dashboard.manage-deals.index');
            })->name('managedeals');

            // Route::resource('dashboard/managedeals', App\Http\Controllers\ManageDeals::class)->name('index','managedeals');

            // Route::get('dashboard/manageservices', function() {
            //     return view('dashboard.manage-services.index');
            // })->name('manageservices');
            // Route::get('dashboard/manageservices/create', function ()
            // {
            //     return view('dashboard.manage-services.create');
            // } )->name('manageservices.create');
            

    });

});



