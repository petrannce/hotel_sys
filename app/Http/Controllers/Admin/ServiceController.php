<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
        return view('admin.service.inventory', compact('services', 'departments'));
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
            return redirect()->back()->with('success', 'Service added successfully.');

        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $service = Service::findOrFail($id);
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
            $service = Service::findOrFail($id);
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
        $service = Service::findOrFail($id);
        $service->delete();
        return redirect()->back()->with('success', 'Service deleted successfully.');
    }

    public function report(Request $request)
    {
        $request->validate([
            'from_date' => 'nullable|date',
            'to_date' => 'nullable|date|after_or_equal:from_date',
            'department' => 'nullable|string',
        ]);

        $query = Service::query();

        if ($request->from_date) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }

        if ($request->to_date) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        if ($request->department) {
            $query->where('department', $request->department);
        }

        $services = $query->latest()->paginate(10);
        $departments = Department::all();

        // Don't calculate status - services don't have status
        return view('admin.service.reports', [
            'services' => $services,
            'departments' => $departments,
            'canExport' => true,
            'filters' => $request->only(['from_date', 'to_date', 'department'])
        ]);
    }

}