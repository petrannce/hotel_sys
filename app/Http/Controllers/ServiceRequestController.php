<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\ServiceRequest;
use App\Models\Service;
use App\Models\Employee;

class ServiceRequestController extends Controller
{
    public function index(Request $request)
    {
         // Fetch the total number of service requests
    $query = ServiceRequest::query();

    // Apply date filters if provided
    if ($request->has('from_date') && $request->has('to_date')) {
        $fromDate = $request->input('from_date');
        $toDate = $request->input('to_date');
        $query->whereBetween('created_at', [$fromDate, $toDate]);
    }

    // Fetch the filtered results
    $totalRequests = $query->count();

         // Define the statuses you want to calculate percentages for
         $statuses = ['pending', 'on_hold', 'closed', 'in_progress'];
 
         // Initialize arrays to hold the counts and percentages
         $statusCounts = [];
         $statusPercentages = [];
 
         // Calculate the count and percentage for each status
         foreach ($statuses as $status) {
             $statusCount = ServiceRequest::where('status', $status)->count();
             $statusCounts[$status] = $statusCount;
             $statusPercentages[$status] = $totalRequests > 0 ? ($statusCount / $totalRequests) * 100 : 0;
         }
        
        $service_requests = ServiceRequest::all();
        $services = Service::all();
        $employees = Employee::all();
        return view('admin.service.index',compact('service_requests','services','employees','statusPercentages','statusCounts'));
    }

    public function create()
    {
        $services = Service::all();
        $employees = Employee::all();
        return view('admin.service.request',compact('services','employees'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'request_id' => 'required',
            'room' => 'required',
            'service' => 'required',
            'employee' => 'required',
            'description' => 'required',
        ]);

        // Begin a database transaction
    DB::beginTransaction();
    
    try {

        $service_request = new ServiceRequest();
        $service_request->request_id = $request->request_id;
        $service_request->room = $request->room;
        $service_request->service = $request->service;
        $service_request->employee = $request->employee;
        $service_request->description = $request->description;
        $service_request->save();

        // Commit the transaction
        DB::commit();
        return redirect()->route('request.index')->with('success', 'Service Request added successfully.');
        
    } catch (\Exception $e) {
        // Rollback the transaction in case of an error
        DB::rollBack();
        return redirect()->back()->with('error', $e->getMessage());
    }
    }

    public function edit($id)
    {
        $service_request = ServiceRequest::find($id);
        $services = Service::all();
        $employees = Employee::all();
        return view('admin.service.editrequest', compact('service_request','services','employees'));
    }

    public function update(Request $request, $id)
    {
        $service_request = ServiceRequest::find($id);
        $service_request->request_id = $request->request_id;
        $service_request->room = $request->room;
        $service_request->service = $request->service;
        $service_request->employee = $request->employee;
        $service_request->description = $request->description;
        $service_request->save();
        return redirect()->route('request.index')->with('success', 'Service Request updated successfully.');
    }

    public function destroy($id)
    {
        $service_request = ServiceRequest::find($id);
        $service_request->delete();
        return redirect()->route('request.index')->with('success', 'Service Request deleted successfully.');
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string|in:pending,on_hold,closed,in_progress'
        ]);

        $serviceRequest = ServiceRequest::findOrFail($id);
        $serviceRequest->status = $request->status;
        $serviceRequest->save();

        return redirect()->back()->with('success', 'Status updated successfully.');
        
    }

}