<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Department;
use App\Models\Service;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::latest()->get();
        $departments = Department::all();
        return view('admin.service.inventory', compact('services','departments'));
    }

    public function create()
    {
        return view('service.create');
    }

    public function store(Request $request)
    {
           // Validate the request
    $request->validate([
        'name' => 'required',
        'department' => 'required',
    ]);

    // Begin a database transaction
    DB::beginTransaction();
    
    try {
        // Check if the service already exists
        $service = Service::where('name', $request->name)->first();
        if ($service) {
            // Rollback the transaction if service exists
            DB::rollBack();
            return redirect()->back()->with('error', 'Service already exists.');
        }

        // Create a new service
        $service = new Service();
        $service->name = $request->name;
        $service->department = $request->department;
        $service->save();

        // Commit the transaction
        DB::commit();
        return redirect()->back()->with('success', 'Designation added successfully.');
        
    } catch (\Exception $e) {
        // Rollback the transaction in case of an error
        DB::rollBack();
        return redirect()->back()->with('error', $e->getMessage());
    }
    }

    public function edit($id)
    {
        $service = Service::find($id);
        return view('admin.service.editinventory', compact('service'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
    $request->validate([
        'name' => 'required',
        'department' => 'required',
    ]);

    // Begin a database transaction
    DB::beginTransaction();
    
    try {

        // Create a new service
        $service = Service::find($id);
        $service->name = $request->name;
        $service->department = $request->department;
        $service->save();

        // Commit the transaction
        DB::commit();
        return redirect()->route('service.index')->with('success', 'Service updated successfully.');
        
    } catch (\Exception $e) {
        // Rollback the transaction in case of an error
        DB::rollBack();
        return redirect()->back()->with('error', $e->getMessage());
    }
    }

    public function destroy($id)
    {
        $service = Service::find($id);
        $service->delete();
        return redirect()->back()->with('success', 'Service deleted successfully.');
    }
    
}