<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\FrontendController;


use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\RoomController;
use App\Http\Controllers\GalleryController;

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

//frontend
Route::controller(FrontendController::class)->group(function () {
    Route::get('/', 'index')->name('home');
    Route::get('/about', 'about')->name('about');
    Route::get('/contact', 'contact')->name('contact');
    Route::post('/contact-store', 'contactStore')->name('contact.store');
    Route::get('/services', 'services')->name('services');
    Route::get('/service-details/{id}', 'serviceDetails')->name('service-details');
    Route::get('/service-requests', 'serviceRequests')->name('service-requests');
    Route::get('/rooms', 'rooms')->name('rooms');
    Route::get('/room-details/{id}', 'roomDetails')->name('room-details');
    Route::post('/booking', 'store')->name('store-booking');
    Route::get('/galleries', 'galleries')->name('galleries');
    Route::get('/checkout', 'checkout')->name('checkout');
});

Auth::routes();

//admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::resource('admin/roles', RoleController::class);
    Route::resource('admin/permissions', PermissionController::class);

    Route::get('/admin', [HomeController::class, 'admin'])->name('admin.dashboard');
    Route::get('/employee/dashboard', [HomeController::class, 'employee'])->name('employee.dashboard');
    Route::get('/client/dashboard', [HomeController::class, 'client'])->name('client.dashboard');

    // employee routes
    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/employee', 'index')->name('employee.index');
        Route::get('/employee/create', 'create')->name('employee.create');
        Route::post('/employee/store', 'store')->name('employee.store');
        Route::get('/employee/{id}/edit', 'edit')->name('employee.edit');
        Route::put('/employee/{id}/update', 'update')->name('employee.update');
        Route::delete('/employee/{id}/delete', 'destroy')->name('employee.destroy');
    });

    //designation
    Route::controller(DesignationController::class)->group(function () {
        Route::get('/designation', 'index')->name('designation.index');
        Route::get('/designation/create', 'create')->name('designation.create');
        Route::post('/designation/store', 'store')->name('designation.store');
        Route::get('/designation/{id}/edit', 'edit')->name('designation.edit');
        Route::put('/designation/{id}/update', 'update')->name('designation.update');
        Route::delete('/designation/{id}/delete', 'destroy')->name('designation.destroy');
    });

    //department
    Route::controller(DepartmentController::class)->group(function () {
        Route::get('/department', 'index')->name('department.index');
        Route::get('/department/create', 'create')->name('department.create');
        Route::post('/department/store', 'store')->name('department.store');
        Route::get('/department/{id}/edit', 'edit')->name('department.edit');
        Route::put('/department/{id}/update', 'update')->name('department.update');
        Route::delete('/department/{id}/delete', 'destroy')->name('department.destroy');
    });

    //service
    Route::controller(ServiceController::class)->group(function () {
        Route::get('/service', 'index')->name('service.index');
        Route::get('/service/create', 'create')->name('service.create');
        Route::post('/service/store', 'store')->name('service.store');
        Route::get('/service/{id}/edit', 'edit')->name('service.edit');
        Route::put('/service/{id}/update', 'update')->name('service.update');
        Route::delete('/service/{id}/delete', 'destroy')->name('service.destroy');
    });

    //service request
    Route::controller(ServiceRequestController::class)->group(function () {
        Route::get('/service-request', 'index')->name('request.index');
        Route::get('/service-request/create', 'create')->name('request.create');
        Route::post('/service-request/store', 'store')->name('request.store');
        Route::get('/service-request/{id}/edit', 'edit')->name('request.edit');
        Route::put('/service-request/{id}/update', 'update')->name('request.update');
        Route::delete('/service-request/{id}/delete', 'destroy')->name('request.destroy');
        Route::patch('/service-request/{id}/status', 'updateStatus')->name('request.updateStatus');
    });

    //booking
    Route::controller(BookingController::class)->group(function () {
        Route::get('/booking', 'index')->name('booking.index');
        Route::get('/booking/create', 'create')->name('booking.create');
        Route::post('/booking/store', 'store')->name('booking.store');
        Route::get('/booking/{id}/edit', 'edit')->name('booking.edit');
        Route::put('/booking/{id}/update', 'update')->name('booking.update');
        Route::delete('/booking/{id}/delete', 'destroy')->name('booking.destroy');
        Route::get('/available-rooms', 'getAvailableRooms');
        Route::patch('/booking/{id}/status', 'updateStatus')->name('booking.updateStatus');
    });

    //room

    Route::get('/room', [RoomController::class, 'index'])->name('room.index');
    Route::get('/room/create', [RoomController::class, 'create'])->name('room.create');
    Route::post('/room/store', [RoomController::class, 'store'])->name('room.store');
    Route::get('/room/{id}/edit', [RoomController::class, 'edit'])->name('room.edit');
    Route::put('/room/{id}/update', [RoomController::class, 'update'])->name('room.update');
    Route::delete('/room/{id}/delete', [RoomController::class, 'destroy'])->name('room.destroy');
    Route::get('/available-rooms', [RoomController::class, 'getAvailableRooms']);
    Route::patch('/room/{id}/status', [RoomController::class, 'updateStatus'])->name('room.updateStatus');
    Route::get('/fetch-unbooked-rooms', [RoomController::class, 'fetchUnbookedRooms'])->name('fetch-unbooked-rooms');

    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/create', [GalleryController::class, 'create'])->name('gallery.create');
    Route::post('/gallery/store', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('/gallery/{id}/edit', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('/gallery/{id}/update', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{id}/delete', [GalleryController::class, 'destroy'])->name('gallery.destroy');

    Route::get('/client', [ClientController::class, 'index'])->name('client.index');
    Route::get('/client/create', [ClientController::class, 'create'])->name('client.create');
    Route::post('/client/store', [ClientController::class, 'store'])->name('client.store');
    Route::get('/client/{id}/edit', [ClientController::class, 'edit'])->name('client.edit');
    Route::put('/client/{id}/update', [ClientController::class, 'update'])->name('client.update');
    Route::delete('/client/{id}/delete', [ClientController::class, 'destroy'])->name('client.destroy');
    Route::get('/client/latest_id', [ClientController::class, 'latestId'])->name('client.latest_id');

    Route::get('/user', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{id}/update', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{id}/delete', [UserController::class, 'destroy'])->name('user.destroy');

    Route::post('/change-role', [UserController::class, 'changeRole'])->name('change.role');


});

// client routes
Route::middleware(['auth', 'role:client|admin'])->group(function () {
    Route::get('/client/dashboard', [HomeController::class, 'client'])->name('client.dashboard');
    Route::get('/request/create', [ServiceRequestController::class, 'create'])->name('request.create');
});

// employee routes
Route::middleware(['auth', 'role:employee|admin'])->group(function () {
    Route::get('/employee/dashboard', [HomeController::class, 'employee'])->name('employee.dashboard');
    Route::get('/request', [ServiceRequestController::class, 'index'])->name('request.index');
});
