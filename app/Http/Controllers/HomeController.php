<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Client;
use App\Models\ServiceRequest;
use App\Models\Booking;
use App\Models\User;
use App\Models\Room;

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
        return view('admin.dashboard.admin', compact('users','employees', 'clients', 'service_requests', 'bookings', 'clientsCount', 'unbookedRooms', 'departments', 'designations'));
    }

    public function employee()
    {
        return view('admin.dashboard.employee');
    }

    public function client()
    {
        return view('admin.dashboard.guest');
    }
}