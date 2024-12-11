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

Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index');
Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create');
Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store');
Route::get('/employee/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit');
Route::put('/employee/{id}/update', [EmployeeController::class, 'update'])->name('employee.update');
Route::delete('/employee/{id}/delete', [EmployeeController::class, 'destroy'])->name('employee.destroy');

Route::get('/designation', [DesignationController::class, 'index'])->name('designation.index');
Route::get('/designation/create', [DesignationController::class, 'create'])->name('designation.create');
Route::post('/designation/store', [DesignationController::class, 'store'])->name('designation.store');
Route::get('/designation/{id}/edit', [DesignationController::class, 'edit'])->name('designation.edit');
Route::put('/designation/{id}/update', [DesignationController::class, 'update'])->name('designation.update');
Route::delete('/designation/{id}/delete', [DesignationController::class, 'destroy'])->name('designation.destroy');

Route::get('/department', [DepartmentController::class, 'index'])->name('department.index');
Route::get('/department/create', [DepartmentController::class, 'create'])->name('department.create');
Route::post('/department/store', [DepartmentController::class, 'store'])->name('department.store');
Route::get('/department/{id}/edit', [DepartmentController::class, 'edit'])->name('department.edit');
Route::put('/department/{id}/update', [DepartmentController::class, 'update'])->name('department.update');
Route::delete('/department/{id}/delete', [DepartmentController::class, 'destroy'])->name('department.destroy');

Route::get('/service', [ServiceController::class, 'index'])->name('service.index');
Route::get('/service/create', [ServiceController::class, 'create'])->name('service.create');
Route::post('/service/store', [ServiceController::class, 'store'])->name('service.store');
Route::get('/service/{id}/edit', [ServiceController::class, 'edit'])->name('service.edit');
Route::put('/service/{id}/update', [ServiceController::class, 'update'])->name('service.update');
Route::delete('/service/{id}/delete', [ServiceController::class, 'destroy'])->name('service.destroy');

Route::get('/request', [ServiceRequestController::class, 'index'])->name('request.index');
Route::get('/request/create', [ServiceRequestController::class, 'create'])->name('request.create');
Route::post('/request/store', [ServiceRequestController::class, 'store'])->name('request.store');
Route::get('/request/{id}/edit', [ServiceRequestController::class, 'edit'])->name('request.edit');
Route::put('/request/{id}/update', [ServiceRequestController::class, 'update'])->name('request.update');
Route::delete('/request/{id}/delete', [ServiceRequestController::class, 'destroy'])->name('request.destroy');
Route::patch('/service-request/{id}/status', [ServiceRequestController::class, 'updateStatus'])->name('service-request.updateStatus');

Route::get('/booking', [BookingController::class, 'index'])->name('booking.index');
Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create');
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/{id}/edit', [BookingController::class, 'edit'])->name('booking.edit');
Route::put('/booking/{id}/update', [BookingController::class, 'update'])->name('booking.update');
Route::delete('/booking/{id}/delete', [BookingController::class, 'destroy'])->name('booking.destroy');
Route::get('/available-rooms', [BookingController::class, 'getAvailableRooms']);
Route::patch('/booking/{id}/status', [BookingController::class, 'updateStatus'])->name('booking.updateStatus');

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
