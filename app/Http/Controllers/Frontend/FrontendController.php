<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Contact;
use App\Models\Room;
use App\Models\Gallery;

class FrontendController extends Controller
{
    public function index()
    {
        $rooms = Room::all();
        $gallery = Gallery::all();
        return view('frontend.home.index', compact('rooms', 'gallery'));
    }  
    
    public function about()
    {
        return view('frontend.home.about');
    }

    public function contact()
    {
        return view('frontend.home.contact');
    }

    public function contactStore(Request $request)
{
    // Validate the incoming request data
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'message' => 'required|string',
        'checkbox' => 'required|boolean' // Ensure checkbox is validated
    ]);

    // Assuming you have a Contact model to handle the data saving
    $contact = new Contact();
    $contact->name = $validatedData['name'];
    $contact->email = $validatedData['email'];
    $contact->message = $validatedData['message'];
    $contact->checkbox = $validatedData['checkbox']; // Use 'checkbox' as key

    // Save the contact information
    $contact->save();

    return response()->json(['success' => true, 'message' => 'Message sent successfully!']);
}

    public function checkout()
    {
        return view('frontend.home.billing');
    }
}
