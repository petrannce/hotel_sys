<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Client;
use App\Models\ServiceRequest;
use App\Models\Booking;
use App\Models\User;
use App\Models\Room;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function admin()
    {
        $users = User::all();
        $services = Service::all();
        $employees = Employee::all();
        $clients = Client::all();
        $service_requests = ServiceRequest::all();
        $bookings = Booking::all();
        $departments = \App\Models\Department::all();
        $designations = \App\Models\Designation::all();
        $clientsCount = User::where('role', 'client')->count();
       // Count total rooms by summing the number field
    $totalRooms = Room::sum('number');

    // Debugging: Log total rooms count
    \Log::info('Total Rooms: ' . $totalRooms); // Log total rooms

    // Count the total number of booked rooms
    // Assuming `room_id` references the `id` in `rooms` and booking each booked room counts once
    $bookedRooms = Booking::select('room_id')
        ->groupBy('room_id')
        ->havingRaw('COUNT(room_id) > 0')
        ->count('room_id');

    // Calculate unbooked rooms
    $unbookedRooms = $totalRooms - $bookedRooms;
        return view('admin.dashboard.admin', [
            'users' => $users,
            'services' => $services,
            'employees' => $employees,
            'clients' => $clients,
            'service_requests' => $service_requests,
            'bookings' => $bookings,
            'departments' => $departments,
            'designations' => $designations,
            'clientsCount' => $clientsCount,
            'totalRooms' => $totalRooms,
            'bookedRooms' => $bookedRooms,
            'unbookedRooms' => $unbookedRooms,
        ]);
    }

public function employee()
{
    $user = Auth::user();

    // If the logged-in user is not admin, fetch their employee record
    $employee = null;
    if ($user && $user->role !== 'admin') {
        $employee = Employee::where('email', $user->email)->first();
    }

    // Shared data for both roles
    $departments = Department::all();
    $designations = Designation::all();
    $services = Service::all();
    $rooms = Room::all();
    $bookings = Booking::all();
    $employees = Employee::all();
    $users = User::all();

    // Optional: dynamic dashboard info
    $attendanceStatus = 'present';
    $tomorrowMessage = "Team meeting scheduled for tomorrow at 10 AM";
    $upcomingEvents = [
        [
            'date' => now()->addDays(2),
            'message' => 'Weekly staff meeting',
            'icon' => 'users',
        ],
        [
            'date' => now()->addDays(4),
            'message' => 'Client visit and room inspection',
            'icon' => 'briefcase',
        ],
    ];

    return view('admin.dashboard.employee', compact(
        'employee',
        'departments',
        'designations',
        'services',
        'rooms',
        'bookings',
        'employees',
        'users',
        'attendanceStatus',
        'tomorrowMessage',
        'upcomingEvents'
    ));
}

    public function client()
    {
        $user = Auth::user();

    // Get current booking for the logged-in client
    $currentBooking = Booking::where('fname', $user->fname)
        ->where('lname', $user->lname)
        ->whereDate('check_in', '<=', now())
        ->whereDate('check_out', '>=', now())
        ->first();

    // Get upcoming bookings
    $upcomingBookings = Booking::where('fname', $user->fname)
        ->where('lname', $user->lname)
        ->whereDate('check_in', '>', now())
        ->orderBy('check_in', 'asc')
        ->take(3)
        ->get();

    // Get service requests for this user’s room (if any)
    $serviceRequests = ServiceRequest::where('room', optional($currentBooking)->room_number)->latest()->take(5)->get();

    // All available services (for recommendations)
    $services = Service::all();

    return view('admin.dashboard.guest', compact(
        'user',
        'currentBooking',
        'upcomingBookings',
        'serviceRequests',
        'services'
    ));
    }
}