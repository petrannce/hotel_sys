<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ArrayExport;

class ReportController extends Controller
{
    public function generate(Request $request)
    {
        $type = $request->get('type');
        $format = $request->get('format', 'pdf'); // pdf | csv | excel
        $from = $request->get('from_date');
        $to = $request->get('to_date');

        // 👇 Define report mapping
        $reports = [

            'users' => [
                'model' => \App\Models\User::class,
                'relations' => [],
                'columns' => ['fname', 'lname', 'username', 'email', 'phone', 'role', 'created_at'],
                'title' => 'Users Report',
                'date_field' => 'created_at',
            ],

            'employees' => [
                'model' => \App\Models\Employee::class,
                'relations' => [],
                'columns' => ['fname', 'lname', 'username', 'email', 'employee_id', 'join_date', 'phone', 'department', 'designation', 'created_at'],
                'title' => 'Employees Report',
                'date_field' => 'created_at',
            ],

            'designations' => [
                'model' => \App\Models\Designation::class,
                'relations' => [],
                'columns' => ['name', 'department', 'created_at'],
                'title' => 'Designations Report',
                'date_field' => 'created_at',
            ],

            'departments' => [
                'model' => \App\Models\Department::class,
                'relations' => [],
                'columns' => ['name', 'created_at'],
                'title' => 'Departments Report',
                'date_field' => 'created_at',
            ],

            'services' => [
                'model' => \App\Models\Service::class,
                'relations' => [],
                'columns' => ['name', 'department', 'created_at'],
                'title' => 'Services Report',
                'date_field' => 'created_at',
            ],

            'service_requests' => [
                'model' => \App\Models\ServiceRequest::class,
                'relations' => [],
                'columns' => ['request_id', 'room', 'service', 'employee', 'description', 'status', 'created_at'],
                'title' => 'Service Requests Report',
                'date_field' => 'created_at',
            ],

            'clients' => [
                'model' => \App\Models\Client::class,
                'relations' => [],
                'columns' => ['fname', 'lname', 'username', 'email', 'client_id', 'phone', 'created_at'],
                'title' => 'Clients Report',
                'date_field' => 'created_at',
            ],

            'contacts' => [
                'model' => \App\Models\Contact::class,
                'relations' => [],
                'columns' => ['name', 'email', 'message', 'checkbox', 'created_at'],
                'title' => 'Contacts Report',
                'date_field' => 'created_at',
            ],

            'rooms' => [
                'model' => \App\Models\Room::class,
                'relations' => [],
                'columns' => ['name', 'number', 'description', 'price', 'created_at'],
                'title' => 'Rooms Report',
                'date_field' => 'created_at',
            ],

            'bookings' => [
                'model' => \App\Models\Booking::class,
                'relations' => ['room'],
                'columns' => ['fname', 'lname', 'room.name', 'room_number', 'check_in', 'check_out', 'price', 'status', 'created_at'],
                'title' => 'Bookings Report',
                'date_field' => 'created_at',
            ],

        ];

        if (!array_key_exists($type, $reports)) {
            return back()->with('error', 'Invalid report type selected.');
        }

        $config = $reports[$type];

        $query = $config['model']::with($config['relations']);

        // Apply date filters dynamically
        if ($from && $to) {
            $query->whereBetween($config['date_field'], [$from, $to]);
        } elseif ($from) {
            $query->whereDate($config['date_field'], '>=', $from);
        } elseif ($to) {
            $query->whereDate($config['date_field'], '<=', $to);
        }

        $data = $query->get();

        $filters = [
            'from_date' => $from,
            'to_date' => $to,
        ];

        // PDF Export
        if ($format === 'pdf') {
            $pdf = Pdf::loadView('admin.reports.universal', [
                'title' => $config['title'],
                'columns' => $config['columns'],
                'data' => $data,
                'filters' => $filters,
            ])->setPaper('a4', 'landscape');

            return $pdf->download(strtolower(str_replace(' ', '_', $config['title'])) . '.pdf');
        }

        // CSV / Excel Export
        $rows = $data->map(function ($item) use ($config) {
            $row = [];
            foreach ($config['columns'] as $col) {
                $row[$col] = data_get($item, $col, '—');
            }
            return $row;
        });

        $export = new ArrayExport($rows->toArray());

        if ($format === 'csv') {
            return Excel::download($export, strtolower($type) . '-report.csv', \Maatwebsite\Excel\Excel::CSV);
        }

        if ($format === 'excel') {
            return Excel::download($export, strtolower($type) . '-report.xlsx', \Maatwebsite\Excel\Excel::XLSX);
        }

        return back()->with('error', 'Invalid format selected.');
    }
}
