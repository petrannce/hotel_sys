<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Room;

class RoomController extends Controller
{
    public function index(){

        $rooms = Room::all();
        return view('admin.room.index', compact('rooms'));
    }
    
    public function store(Request $request)
{

    $request->validate([
        'name' => 'required',
        'number' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
    ]);

    //dd($request->all());
    
    try {
        $room = Room::create([
            'name' => $request->name,
            'number' => $request->number,
            'description' => $request->description,
            'price' => $request->price,
        ]);
    
        return redirect()->route('room.index')->with('success', 'Room created successfully!');
    } catch (\Exception $e) {
        // Handle the exception and redirect back with an error message
        return redirect()->back()->withErrors(['error' => 'Failed to create room: ' . $e->getMessage()]);
    }
}

    public function show($id)
    {
        
    }
    
    public function edit($id)
    {
            $room = Room::findOrFail($id);
            return view('admin.room.edit', compact('room'));
    }

    public function update(Request $request, $id)
    {
            // Validate the request
        $request->validate([
            'name' => 'required',
            'number' => 'required',
            'description' => 'required',
            'price' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', 
        ]);

        try {
            DB::beginTransaction();

            // Retrieve the blog by its ID
            $room = Room::findOrFail($id);

            // Handle image file upload
            if ($request->hasFile('image')) {
                try {
                    $image = $request->file('image');
                    $image_name = time().'.'.$image->getClientOriginalExtension();
                    $image->move('public/rooms', $image_name);
                    $room->image = $image_name;
                } catch (\Exception $e) {
                    DB::rollBack();
                    // Handle file upload error
                    return redirect()->back()->withInput();
                }
            }

            // Update the blog post
            $room->name = $request->name;
            $room->number = $request->number;
            $room->description = $request->description;
            $room->price = $request->price;
            $room->save();

            DB::commit();

            return redirect()->route('room.index');
        } catch (\Exception $e) {
            DB::rollBack();

            // Handle database update error

            return redirect()->back()->withInput();
        }
    }

 
    public function destroy($id)
    {

        DB::table('rooms')->where('id', $id)->delete();
        return redirect()->back();

    }

    public function fetchUnbookedRooms(Request $request)
{
    // Get the selected room type from the request
    $roomType = $request->get('room_type');

    // Fetch all rooms with the selected room type
    $rooms = Room::where('name', $roomType)->get();

    // Get the ids of already booked rooms (rooms currently booked)
    $bookedRoomIds = Booking::whereIn('room_id', $rooms->pluck('id'))->pluck('room_id');

    // Get the unbooked rooms by excluding booked room ids
    $unbookedRooms = Room::where('name', $roomType)
                          ->whereNotIn('id', $bookedRoomIds)
                          ->get();

    // Return the unbooked rooms as a JSON response
    return response()->json([
        'unbooked_rooms' => $unbookedRooms
    ]);
}
}
