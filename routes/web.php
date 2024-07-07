<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ServiceRequestController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\UserController;
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
    return view('auth.login');
});

Auth::routes();

Route::get('/admin', [HomeController::class, 'admin'])->name('admin.dashboard')->middleware('auth');
Route::get('/employee/dashboard', [HomeController::class, 'employee'])->name('employee.dashboard')->middleware('auth');
Route::get('/client/dashboard', [HomeController::class, 'client'])->name('client.dashboard')->middleware('auth');

Route::get('/employee', [EmployeeController::class, 'index'])->name('employee.index')->middleware('auth');
Route::get('/employee/create', [EmployeeController::class, 'create'])->name('employee.create')->middleware('auth');
Route::post('/employee/store', [EmployeeController::class, 'store'])->name('employee.store')->middleware('auth');
Route::get('/employee/{id}/edit', [EmployeeController::class, 'edit'])->name('employee.edit')->middleware('auth');
Route::put('/employee/{id}/update', [EmployeeController::class, 'update'])->name('employee.update')->middleware('auth');
Route::delete('/employee/{id}/delete', [EmployeeController::class, 'destroy'])->name('employee.destroy')->middleware('auth');

Route::get('/designation', [DesignationController::class, 'index'])->name('designation.index')->middleware('auth');
Route::get('/designation/create', [DesignationController::class, 'create'])->name('designation.create')->middleware('auth');
Route::post('/designation/store', [DesignationController::class, 'store'])->name('designation.store')->middleware('auth');
Route::get('/designation/{id}/edit', [DesignationController::class, 'edit'])->name('designation.edit')->middleware('auth');
Route::put('/designation/{id}/update', [DesignationController::class, 'update'])->name('designation.update')->middleware('auth');
Route::delete('/designation/{id}/delete', [DesignationController::class, 'destroy'])->name('designation.destroy')->middleware('auth');

Route::get('/department', [DepartmentController::class, 'index'])->name('department.index')->middleware('auth');
Route::get('/department/create', [DepartmentController::class, 'create'])->name('department.create')->middleware('auth');
Route::post('/department/store', [DepartmentController::class, 'store'])->name('department.store')->middleware('auth');
Route::get('/department/{id}/edit', [DepartmentController::class, 'edit'])->name('department.edit')->middleware('auth');
Route::put('/department/{id}/update', [DepartmentController::class, 'update'])->name('department.update')->middleware('auth');
Route::delete('/department/{id}/delete', [DepartmentController::class, 'destroy'])->name('department.destroy')->middleware('auth');

Route::get('/service', [ServiceController::class, 'index'])->name('service.index')->middleware('auth');
Route::get('/service/create', [ServiceController::class, 'create'])->name('service.create')->middleware('auth');
Route::post('/service/store', [ServiceController::class, 'store'])->name('service.store')->middleware('auth');
Route::get('/service/{id}/edit', [ServiceController::class, 'edit'])->name('service.edit')->middleware('auth');
Route::put('/service/{id}/update', [ServiceController::class, 'update'])->name('service.update')->middleware('auth');
Route::delete('/service/{id}/delete', [ServiceController::class, 'destroy'])->name('service.destroy')->middleware('auth');

Route::get('/request', [ServiceRequestController::class, 'index'])->name('request.index')->middleware('auth');
Route::get('/request/create', [ServiceRequestController::class, 'create'])->name('request.create')->middleware('auth');
Route::post('/request/store', [ServiceRequestController::class, 'store'])->name('request.store')->middleware('auth');
Route::get('/request/{id}/edit', [ServiceRequestController::class, 'edit'])->name('request.edit')->middleware('auth');
Route::put('/request/{id}/update', [ServiceRequestController::class, 'update'])->name('request.update')->middleware('auth');
Route::delete('/request/{id}/delete', [ServiceRequestController::class, 'destroy'])->name('request.destroy')->middleware('auth');
Route::patch('/service-request/{id}/status', [ServiceRequestController::class, 'updateStatus'])->name('service-request.updateStatus');

Route::get('/booking', [BookingController::class, 'index'])->name('booking.index')->middleware('auth');
Route::get('/booking/create', [BookingController::class, 'create'])->name('booking.create')->middleware('auth');
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store')->middleware('auth');
Route::get('/booking/{id}/edit', [BookingController::class, 'edit'])->name('booking.edit')->middleware('auth');
Route::put('/booking/{id}/update', [BookingController::class, 'update'])->name('booking.update')->middleware('auth');
Route::delete('/booking/{id}/delete', [BookingController::class, 'destroy'])->name('booking.destroy')->middleware('auth');

Route::get('/client', [ClientController::class, 'index'])->name('client.index')->middleware('auth');
Route::get('/client/create', [ClientController::class, 'create'])->name('client.create')->middleware('auth');
Route::post('/client/store', [ClientController::class, 'store'])->name('client.store')->middleware('auth');
Route::get('/client/{id}/edit', [ClientController::class, 'edit'])->name('client.edit')->middleware('auth');
Route::put('/client/{id}/update', [ClientController::class, 'update'])->name('client.update')->middleware('auth');
Route::delete('/client/{id}/delete', [ClientController::class, 'destroy'])->name('client.destroy')->middleware('auth');

Route::get('/user', [UserController::class, 'index'])->name('user.index')->middleware('auth');
Route::get('/user/create', [UserController::class, 'create'])->name('user.create')->middleware('auth');
Route::post('/user/store', [UserController::class, 'store'])->name('user.store')->middleware('auth');
Route::get('/user/{id}/edit', [UserController::class, 'edit'])->name('user.edit')->middleware('auth');
Route::put('/user/{id}/update', [UserController::class, 'update'])->name('user.update')->middleware('auth');
Route::delete('/user/{id}/delete', [UserController::class, 'destroy'])->name('user.destroy')->middleware('auth');