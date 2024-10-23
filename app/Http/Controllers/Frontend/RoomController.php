<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Room;
use App\Models\Booking;

class RoomController extends Controller
{
    public function index()
    {
        $rooms = DB::table('rooms')->latest()->get();
        return view('frontend.room.index', compact('rooms'));
    }

    public function show($id)
{
    $room = Room::findOrFail($id);

    // Get all booked room numbers for this room ID
    $bookedRooms = Booking::where('room_id', $room->id)
                          ->where('status', '!=', 'pending')
                          ->pluck('room_number')->toArray();

    // Debugging line to check booked rooms
    //dd($bookedRooms); // This will show you the booked rooms.

    // Total number of rooms from the room details
    $totalRooms = $room->number; // Assuming 'number' contains total rooms
    $availableRooms = [];

    // Calculate available rooms
    for ($i = 1; $i <= $totalRooms; $i++) {
        if (!in_array($i, $bookedRooms)) {
            $availableRooms[] = $i; // Add to available rooms if not booked
        }
    }

    // Optionally, check the available rooms
    //dd($availableRooms); // This will show you the available rooms.

    return view('frontend.room.show', compact('room', 'availableRooms'));
}

public function store(Request $request)
{
    // Log request data for debugging
    \Log::info('Booking request:', $request->all());

    // Validate incoming request data
    $validatedData = $request->validate([
        'fname' => 'required',
        'lname' => 'required',
        'room_id' => 'required|exists:rooms,id',
        'room_number' => 'required|integer',
        'check_in' => 'required|date_format:Y-m-d', 
        'check_out' => 'required|date_format:Y-m-d|after:check_in',
        'price' => 'required|numeric',
    ]);

    // Create a new booking instance
    $booking = new Booking();
    $booking->fname = $validatedData['fname'];
    $booking->lname = $validatedData['lname'];
    $booking->room_id = $validatedData['room_id'];
    $booking->room_number = $validatedData['room_number'];
    $booking->check_in = $validatedData['check_in'];
    $booking->check_out = $validatedData['check_out'];
    $booking->price = $validatedData['price'];
    $booking->status = 'pending';

    $booking->save(); // Save the booking to the database

    // Return a JSON response
    return response()->json(['success' => true, 'message' => 'Booking created successfully!']);
}



}
