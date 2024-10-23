<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\Gallery;
use App\Models\Room;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::latest()->get();
        $rooms = Room::all();
        return view('admin.gallery.index', compact('galleries','rooms'));
    }

    public function create()
    {
        return view('admin.gallery.create');
    }

    public function store(Request $request)
    {

        //dd($request->all());
        $request->validate([
            'name' => 'required',
            'image' => 'required',
        ]);

        // Begin a database transaction
        DB::beginTransaction();
        
        try {

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalName();
                $image->move('public/galleries');
            }

            // Create a new gallery
            $gallery = new Gallery();
            $gallery->name = $request->name;
            $gallery->image = $request->image;
            $gallery->save();

            // Commit the transaction
            DB::commit();
            return redirect()->route('admin.gallery.index')->with('success', 'Gallery created successfully.');

        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $gallery = Gallery::find($id);
        return view('admin.gallery.edit', compact('gallery'));
    }

    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'image' => 'required',
        ]);

        // Begin a database transaction
        DB::beginTransaction();
        
        try {

            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/gallery', $imageName);
            }

            // Create a new gallery
            $gallery = Gallery::find($id);
            $gallery->name = $request->name;
            $gallery->image = $request->image;
            $gallery->save();

            // Commit the transaction
            DB::commit();
            return redirect()->route('admin.gallery.index')->with('success', 'Gallery updated successfully.');

        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $gallery = Gallery::find($id);
        $gallery->delete();
        return redirect()->back()->with('success', 'Gallery deleted successfully.');
    }
}
