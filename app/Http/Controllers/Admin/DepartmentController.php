<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Department;

class DepartmentController extends Controller
{

    public function index()
    {
        $departments = Department::all();
        return view('admin.employee.department', compact('departments'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
        ]);

        // Begin a database transaction
        DB::beginTransaction();

        try {
            // Check if the department already exists
            $department = Department::where('name', $request->name)->first();
            if ($department) {
                // Rollback the transaction if department exists
                DB::rollBack();
                return redirect()->back()->with('error', 'Department already exists.');
            }

            // Create a new department
            $department = new Department();
            $department->name = $request->name;
            $department->save();

            // Commit the transaction
            DB::commit();
            return redirect()->back()->with('success', 'Department added successfully.');

        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function edit($id)
    {
        $department = Department::find($id);
        return view('admin.employee.editdepartment', compact('department'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'name' => 'required',
        ]);

        // Begin a database transaction
        DB::beginTransaction();

        try {
            // Check if the department to be updated exists
            $department = Department::findOrFail($id);

            // Check if the new department name already exists (excluding the current department)
            $existingDepartment = Department::where('name', $request->name)->where('id', '!=', $id)->first();
            if ($existingDepartment) {
                // Rollback the transaction if the department name already exists
                DB::rollBack();
                return redirect()->back()->with('error', 'Another department with this name already exists.');
            }

            // Update the department's name
            $department->name = $request->name;
            $department->save();

            // Commit the transaction
            DB::commit();
            return redirect()->route('department.index')->with('success', 'Department updated successfully.');

        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $department = Department::find($id);
        $department->delete();
        return redirect()->back()->with('success', 'Department deleted successfully.');
    }

    public function report(Request $request)
    {
        $query = Department::query();

        if ($request->from_date) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->to_date) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $departments = $query->latest()->paginate(10);

        return view('admin.department.reports', [
            'departments' => $departments,
            'canExport' => true
        ]);
    }
}