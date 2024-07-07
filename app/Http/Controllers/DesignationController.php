<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Designation;
use App\Models\Department;

class DesignationController extends Controller
{

    public function index()
    {
        $designations = Designation::all();
        $departments = Department::all();
        return view('admin.employee.designation',compact('designations','departments'));
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
        // Check if the designation already exists
        $designation = Designation::where('name', $request->name)->first();
        if ($designation) {
            // Rollback the transaction if designation exists
            DB::rollBack();
            return redirect()->back()->with('error', 'Designation already exists.');
        }

        // Create a new designation
        $designation = new Designation();
        $designation->name = $request->name;
        $designation->department = $request->department;
        $designation->save();

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
        $designation = Designation::find($id);
        return view('admin.employee.editdesignation',compact('designation'));
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
        // Check if the designation already exists
        $designation = Designation::where('name', $request->name)->first();
        if ($designation) {
            // Rollback the transaction if designation exists
            DB::rollBack();
            return redirect()->back()->with('error', 'Designation already exists.');
        }

        // Update the designation
        $designation = Designation::find($id);
        $designation->name = $request->name;
        $designation->department = $request->department;
        $designation->save();

        // Commit the transaction
        DB::commit();
        return redirect()->route('designation.index')->with('success', 'Designation updated successfully.');
        
    } catch (\Exception $e) {
        // Rollback the transaction in case of an error
        DB::rollBack();
        return redirect()->back()->with('error', $e->getMessage());
    }
    }

    public function destroy($id)
    {
        $designation = Designation::find($id);
        $designation->delete();
        return redirect()->back()->with('success', 'Designation deleted successfully.');
    }
}