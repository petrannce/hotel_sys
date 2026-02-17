<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HotelDetail;
use Illuminate\Http\Request;
use DB;

class HotelDetailsController extends Controller
{
    public function index()
    {
        $hotel_details = HotelDetail::first();
        return view('admin.hotel_details.index', compact('hotel_details'));
    }

    public function create()
    {
        return view('admin.hotel_details.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'address'      => 'required|string|max:255',
            'phone_number' => 'required|string|max:20',
            'email'        => 'required|email|max:255',
            'website'      => 'nullable|url|max:255',
            'logo'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        DB::beginTransaction();

        try {

            $hotel_detail = new HotelDetail();

            if ($request->hasFile('logo')) {
                $logo = $request->file('logo');

                $logoPath = public_path('hotels/logos');
                if (!file_exists($logoPath)) {
                    mkdir($logoPath, 0777, true);
                }

                $logo_name = time() . '_' . preg_replace('/\s+/', '_', $logo->getClientOriginalName());
                $logo->storeAs('hotels/logos', $logo_name, 'public');
                $hotel_detail->logo = 'hotels/logos/' . $logo_name;
            }

            if ($request->hasFile('image')) {
                $image = $request->file('image');

                $imagePath = public_path('hotels/images');
                if (!file_exists($imagePath)) {
                    mkdir($imagePath, 0777, true);
                }

                $image_name = time() . '_' . preg_replace('/\s+/', '_', $image->getClientOriginalName());
                $image->storeAs('hotels/images', $image_name, 'public');
                $hotel_detail->image = 'hotels/images/' . $image_name;
            }

            $hotel_detail->name         = $request->name;
            $hotel_detail->address      = $request->address;
            $hotel_detail->phone_number = $request->phone_number;
            $hotel_detail->email        = $request->email;
            $hotel_detail->website      = $request->website;

            $hotel_detail->save();

            DB::commit();

            return redirect()
                ->route('hotel_details.index')
                ->with('success', 'Hotel details created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function edit($id = null)
    {
        $hotel_detail = $id ? HotelDetail::find($id) : new HotelDetail;
        return view('backend.hotel_details.edit', compact('hotel_detail'));
    }

    public function update(Request $request, $id)
    {

        DB::beginTransaction();

        try {
            $hotel_detail = HotelDetail::findOrFail($id);
            $inline = $request->input('inline');

            // ✅ Handle Logo only
            if ($inline === 'logo' && $request->hasFile('logo')) {
                $logo = $request->file('logo');
                $logo_name = time() . '_' . preg_replace('/\s+/', '_', $logo->getClientOriginalName());
                 $logo->storeAs('hotels/logos', $logo_name, 'public');
                $hotel_detail->logo = 'hotels/logos/' . $logo_name;
                $hotel_detail->save();

                DB::commit();
                return redirect()->route('hotel_details.index')
                    ->with('success', 'Hotel logo updated successfully.');
            }

            // ✅ Handle Banner/Image only
            if ($inline === 'image' && $request->hasFile('image')) {
                $image = $request->file('image');
                $image_name = time() . '_' . preg_replace('/\s+/', '_', $image->getClientOriginalName());
                $image->storeAs('hotels/images', $image_name, 'public');
                $hotel_detail->image = 'hotels/images/' . $image_name;
                $hotel_detail->save();

                DB::commit();
                return redirect()->route('hotel_details.index')
                    ->with('success', 'Hotel banner updated successfully.');
            }

            // ✅ Handle full hotel details update
            if ($inline === null) {
                $request->validate([
                    'name'         => 'required|string|max:255',
                    'address'      => 'required|string|max:255',
                    'phone_number' => 'required|string|max:20',
                    'email'        => 'required|email|max:255',
                    'website'      => 'nullable|url|max:255',
                ]);

                $hotel_detail->name         = $request->name;
                $hotel_detail->address      = $request->address;
                $hotel_detail->phone_number = $request->phone_number;
                $hotel_detail->email        = $request->email;
                $hotel_detail->website      = $request->website;

                $hotel_detail->save();

                DB::commit();
                return redirect()->route('hotel_details.index')
                    ->with('success', 'Hotel details updated successfully.');
            }

            DB::rollBack();
            return redirect()->back()->with('error', 'Nothing to update.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update hotel details. ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        DB::table('hotel_details')->where('id', $id)->delete();
        return redirect()->route('hotel_details.index')->with('success', 'Hotel details deleted successfully');
    }
}