<?php

use App\Http\Controllers\Admin\BillingController;
use App\Http\Controllers\Admin\HotelDetailsController;
use App\Http\Controllers\Admin\ReportController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\FrontendController;


use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Admin\DesignationController;
use App\Http\Controllers\Admin\DepartmentController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ServiceRequestController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoomController;
use App\Http\Controllers\Admin\GalleryController;

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
    Route::get('/galleries', 'galleries')->name('gallery');
    Route::get('/checkout', 'checkout')->name('checkout');
});

Auth::routes();

//admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {

    Route::resource('admin/roles', RoleController::class);
    Route::resource('admin/permissions', PermissionController::class);

    // Home route
    Route::controller(HomeController::class)->group(function () {
        Route::get('/admin/dashboard', 'admin')->name('admin.dashboard');
        Route::get('/employee/dashboard', 'employee')->name('employee.dashboard');
        Route::get('/client/dashboard', 'client')->name('client.dashboard');
    });

    // Report
    Route::controller(ReportController::class)->prefix('admin')->group(function () {
        Route::get('/reports/generate', 'generate')->name('reports.generate');
    });

    // Reports
    Route::controller(ReportsController::class)->prefix('admin')->group(function () {
        Route::get('/dashboard/reports', 'index')->name('dashboard.reports');
        Route::get('/dashboard/reports/filter', 'filterData')->name('reports.filterData');
        Route::get('/dashboard/reports/get-fields', 'getFields')->name('reports.getFields');
        Route::get('/dashboard/reports/field-values', 'getFieldValues')->name('reports.fieldValues');
    });

    // employee routes
    Route::controller(EmployeeController::class)->prefix('admin')->group(function () {
        Route::get('/employee', 'index')->name('employee.index');
        Route::get('/employee/create', 'create')->name('employee.create');
        Route::post('/employee/store', 'store')->name('employee.store');
        Route::get('/employee/{id}/edit', 'edit')->name('employee.edit');
        Route::put('/employee/{id}/update', 'update')->name('employee.update');
        Route::delete('/employee/{id}/delete', 'destroy')->name('employee.destroy');
        Route::get('/employees-report', 'report')->name('employees.report');
    });

    //designation
    Route::controller(DesignationController::class)->prefix('admin')->group(function () {
        Route::get('/designation', 'index')->name('designation.index');
        Route::get('/designation/create', 'create')->name('designation.create');
        Route::post('/designation/store', 'store')->name('designation.store');
        Route::get('/designation/{id}/edit', 'edit')->name('designation.edit');
        Route::put('/designation/{id}/update', 'update')->name('designation.update');
        Route::delete('/designation/{id}/delete', 'destroy')->name('designation.destroy');
        Route::get('/designations-report', 'report')->name('designations.report');
    });

    //department
    Route::controller(DepartmentController::class)->prefix('admin')->group(function () {
        Route::get('/department', 'index')->name('department.index');
        Route::get('/department/create', 'create')->name('department.create');
        Route::post('/department/store', 'store')->name('department.store');
        Route::get('/department/{id}/edit', 'edit')->name('department.edit');
        Route::put('/department/{id}/update', 'update')->name('department.update');
        Route::delete('/department/{id}/delete', 'destroy')->name('department.destroy');
        Route::get('/departments-report', 'report')->name('departments.report');
    });

    //service
    Route::controller(ServiceController::class)->prefix('admin')->group(function () {
        Route::get('/service', 'index')->name('service.index');
        Route::get('/service/create', 'create')->name('service.create');
        Route::post('/service/store', 'store')->name('service.store');
        Route::get('/service/{id}/edit', 'edit')->name('service.edit');
        Route::put('/service/{id}/update', 'update')->name('service.update');
        Route::delete('/service/{id}/delete', 'destroy')->name('service.destroy');
        Route::get('/services-report', 'report')->name('services.report');
    });

    //service request
    Route::controller(ServiceRequestController::class)->prefix('admin')->group(function () {
        Route::get('/service-request', 'index')->name('request.index');
        Route::get('/service-request/create', 'create')->name('request.create');
        Route::post('/service-request/store', 'store')->name('request.store');
        Route::get('/service-request/{id}/edit', 'edit')->name('request.edit');
        Route::put('/service-request/{id}/update', 'update')->name('request.update');
        Route::delete('/service-request/{id}/delete', 'destroy')->name('request.destroy');
        Route::patch('/service-request/{id}/status', 'updateStatus')->name('request.updateStatus');
    });

    //booking
    Route::controller(BookingController::class)->prefix('admin')->group(function () {
        Route::get('/booking', 'index')->name('booking.index');
        Route::get('/booking/create', 'create')->name('booking.create');
        Route::post('/booking/store', 'store')->name('booking.store');
        Route::get('/booking/{id}/edit', 'edit')->name('booking.edit');
        Route::put('/booking/{id}/update', 'update')->name('booking.update');
        Route::delete('/booking/{id}/delete', 'destroy')->name('booking.destroy');
        Route::get('/available-rooms', 'getAvailableRooms');
        Route::patch('/booking/{id}/status', 'updateStatus')->name('booking.updateStatus');
        Route::get('/bookings-report', 'report')->name('bookings.report');
    });

    //room
    Route::controller(RoomController::class)->prefix('admin')->group(function () {
        Route::get('/room', 'index')->name('room.index');
        Route::get('/room/create', 'create')->name('room.create');
        Route::post('/room/store', 'store')->name('room.store');
        Route::get('/room/{id}/edit', 'edit')->name('room.edit');
        Route::put('/room/{id}/update', 'update')->name('room.update');
        Route::delete('/room/{id}/delete', 'destroy')->name('room.destroy');
        Route::get('/available-rooms', 'getAvailableRooms');
        Route::patch('/room/{id}/status', 'updateStatus')->name('room.updateStatus');
        Route::get('/fetch-unbooked-rooms', 'fetchUnbookedRooms')->name('fetch-unbooked-rooms');
        Route::get('/rooms-report', 'report')->name('rooms.report');
    });

    // Gallery
    Route::controller(GalleryController::class)->prefix(('admin'))->group(function () {
        Route::get('/gallery', 'index')->name('gallery.index');
        Route::get('/gallery/create', 'create')->name('gallery.create');
        Route::post('/gallery/store', 'store')->name('gallery.store');
        Route::get('/gallery/{id}/edit', 'edit')->name('gallery.edit');
        Route::put('/gallery/{id}/update', 'update')->name('gallery.update');
        Route::delete('/gallery/{id}/delete', 'destroy')->name('gallery.destroy');
    });

    // Client management
    Route::controller(ClientController::class)->prefix('admin')->group(function () {
        Route::get('/client', 'index')->name('client.index');
        Route::get('/client/create', 'create')->name('client.create');
        Route::post('/client/store', 'store')->name('client.store');
        Route::get('/client/{id}/edit', 'edit')->name('client.edit');
        Route::put('/client/{id}/update', 'update')->name('client.update');
        Route::delete('/client/{id}/delete', 'destroy')->name('client.destroy');
        Route::get('/client/latest_id', 'latestId')->name('client.latest_id');
        Route::get('/clients-report', 'report')->name('clients.report');
    });

    // Billing and Invoices
    Route::controller(BillingController::class)->prefix('admin')->group(function () {
        Route::get('/billing', 'index')->name('billing.index');
        Route::get('/billing/create', 'create')->name('billing.create');
        Route::post('/billing', 'store')->name('billing.store');
        Route::get('/billing/{id}/edit', 'edit')->name('billing.edit');
        Route::put('/billing/{id}', 'update')->name('billing.update');
        Route::get('/billing/{id}', 'show')->name('billing.show');
        Route::delete('/billing/{id}', 'destroy')->name('billing.destroy');
        Route::get('/billing/{id}/invoice', 'generateInvoice')->name('billing.invoice');
        Route::get('/billing-report', 'report')->name('billing.report');
        Route::get('/billings/{billing}/receipt', 'showReceipt')->name('billing.receipt');
        Route::get('/billings/{billing}/download-pdf', 'downloadPDF')->name('billings.downloadPDF');
        Route::get('/billings/{id}/resend', [BillingController::class, 'resendEmail'])->name('billings.resendEmail');
    });

    // Hotel Details
    Route::controller(HotelDetailsController::class)->prefix('admin')->group(function () {
        Route::get('/hotel_details', 'index')->name('hotel_details.index');
        Route::get('/hotel_details/create', 'create')->name('hotel_details.create');
        Route::post('/hotel_details/store', 'store')->name('hotel_details.store');
        Route::get('/hotel_details/{id}/edit', 'edit')->name('hotel_details.edit');
        Route::put('/hotel_details/{id}/update', 'update')->name('hotel_details.update');
        Route::delete('/hotel_details/{id}/delete', 'destroy')->name('hotel_details.destroy');
    });

    // User management
    Route::controller(UserController::class)->prefix('admin')->group(function () {
        Route::get('/user', 'index')->name('user.index');
        Route::get('/user/create', 'create')->name('user.create');
        Route::post('/user/store', 'store')->name('user.store');
        Route::get('/user/{id}/edit', 'edit')->name('user.edit');
        Route::put('/user/{id}/update', 'update')->name('user.update');
        Route::delete('/user/{id}/delete', 'destroy')->name('user.destroy');
        Route::post('/change-role', 'changeRole')->name('change.role');
        Route::get('/users-report', 'report')->name('users.report');
    });

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
