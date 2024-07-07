<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use App\Models\Employee;
use App\Models\Department;
use App\Models\Designation;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function index()
    {

        $employees = Employee::all();
        $departments = Department::all();
        $designations = Designation::all();
        return view('admin.employee.index',compact('employees','departments','designations'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'employee_id' => 'required',
            'join_date' => 'required|date_format:Y-m-d',
            'phone' => 'required|digits:10',
            'department' => 'required',
            'designation' => 'required',
        ]);

        //dd($request->all());

        // Begin a database transaction
        DB::beginTransaction();
        
        try {
            // Check if the employee already exists
            $employee = Employee::where('employee_id', $request->employee_id)->first();
            if ($employee) {
                // Rollback the transaction if employee exists
                DB::rollBack();
                return redirect()->back()->with('error', 'Employee already exists.');
            }

            // Create a new employee
            $employee = new Employee();
            $employee->fname = $request->fname;
            $employee->lname = $request->lname;
            $employee->username = $request->username;
            $employee->email = $request->email;
            $employee->password = Hash::make($request->password);
            $employee->employee_id = $request->employee_id;
            $employee->join_date = $request->join_date;
            $employee->phone = $request->phone;
            $employee->department = $request->department;
            $employee->designation = $request->designation;

            // Debugging: Check if employee object is correct
            Log::info('Employee object before save:', ['employee' => $employee->toArray()]);
            //dd($employee);

            $employee->save();

            // Debugging: Check if the save was successful
            Log::info('Employee saved successfully.');

            // Commit the transaction
            DB::commit();
            
            return redirect()->back()->with('success', 'Employee created successfully.');
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();
            Log::error('Error creating employee:', ['error' => $e->getMessage()]);
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
    

    public function edit($id)
    {
        $employee = Employee::find($id);
        $departments = Department::all();
        $designations = Designation::all();
        return view('admin.employee.editemployee',compact('employee','departments','designations'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'username' => 'required',
            'email' => 'required',
            'employee_id' => 'required',
            'join_date' => 'required',
            'phone' => 'required',
            'department' => 'required',
            'designation' => 'required',
        ]);

        // Begin a database transaction
        DB::beginTransaction();
        
        try {
            // Check if the employee already exists
            $employee = Employee::where('employee_id', $request->employee_id)->where('id', '!=', $id)->first();
            if ($employee) {
                // Rollback the transaction if employee exists
                DB::rollBack();
                return redirect()->back()->with('error', 'Employee already exists.');
            }

            // Update the employee
            $employee = Employee::find($id);
            $employee->fname = $request->fname;
            $employee->lname = $request->lname;
            $employee->username = $request->username;
            $employee->email = $request->email;
            $employee->employee_id = $request->employee_id;
            $employee->join_date = $request->join_date;
            $employee->phone = $request->phone;
            $employee->department = $request->department;
            $employee->designation = $request->designation;
            $employee->save();

            // Commit the transaction
            DB::commit();
            return redirect()->route('employee.index')->with('success', 'Employee updated successfully.');
            
        } catch (\Exception $e) {
            // Rollback the transaction in case of an error
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function destroy($id)
    {
        $employee = Employee::find($id);
        $employee->delete();
        return redirect()->back()->with('success', 'Employee deleted successfully.');
    }

       
}