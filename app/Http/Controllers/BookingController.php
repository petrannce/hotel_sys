<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use illuminate\Support\Facades\Log;
use App\Models\Booking;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::all();
        return view('admin.booking.index',compact('bookings'));
    }

    public function create()
    {
        return view('admin.booking.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'room' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
        ]);

        //dd($request->all());

        // Begin a database transaction
    DB::beginTransaction();
    
    try {

        // Create a new booking
        $booking = new Booking();
        $booking->client_id = $request->client_id;
        $booking->room = $request->room;
        $booking->check_in = $request->check_in;
        $booking->check_out = $request->check_out;

        //dd($booking);
        $booking->save();

        // Commit the transaction
        DB::commit();
        return redirect()->back()->with('success', 'Booking added successfully.');
        
    } catch (\Exception $e) {
        // Rollback the transaction in case of an error
        DB::rollBack();
        return redirect()->back()->with('error', $e->getMessage());
        
    }
    }

    public function edit($id)
    {
        $booking = Booking::find($id);
        return view('admin.booking.edit_booking',compact('booking'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'client_id' => 'required',
            'room' => 'required',
            'check_in' => 'required',
            'check_out' => 'required',
        ]);

        dd($request->all());

        // Begin a database transaction
    DB::beginTransaction();
    
    try {
        // Check if the booking already exists
        $booking = Booking::where('client_id', $request->client_id)
            ->where('room', $request->room)
            ->where('check_in', $request->check_in)
            ->where('check_out', $request->check_out)
            ->first();
        if ($booking) {
            // Rollback the transaction if booking exists
            DB::rollBack();
            return redirect()->back()->with('error', 'Booking already exists.');
        }

        // Update the booking
        $booking = Booking::find($id);
        $booking->client_id = $request->client_id;
        $booking->room = $request->room;
        $booking->check_in = $request->check_in;
        $booking->check_out = $request->check_out;
        $booking->save();

        // Commit the transaction
        DB::commit();
        return redirect()->back()->with('success', 'Booking updated successfully.');
        
    } catch (\Exception $e) {
        // Rollback the transaction in case of an error
        DB::rollBack();
        return redirect()->back()->with('error', $e->getMessage());
        
    }
    }

    public function destroy($id)
    {
        $booking = Booking::find($id);
        $booking->delete();
        return redirect()->back()->with('success', 'Booking deleted successfully.');
    }

    
}