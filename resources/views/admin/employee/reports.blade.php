@extends('layouts.admin.header')
@section('content')

<!-- Page Content -->
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Employee Report</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Employee</a></li>
                    <li class="breadcrumb-item active">Report</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                @if(isset($canExport) && $canExport)
                <form method="POST" action="{{ route('reports.generate') }}" target="_blank" style="display:inline;">
                    @csrf
                    <input type="hidden" name="type" value="employees">
                    <input type="hidden" name="from_date" value="{{ request('from_date') }}">
                    <input type="hidden" name="to_date" value="{{ request('to_date') }}">
                    <input type="hidden" name="department" value="{{ request('department') }}">
                    <input type="hidden" name="designation" value="{{ request('designation') }}">
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-file-pdf-o"></i> Export PDF
                    </button>
                </form>
                @endif
                <a href="{{ route('employee.index') }}" class="btn btn-secondary ml-2">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    @include('layouts.partials.filter', [
        'filterRoute' => route('employees.report'),
        'reportRoute' => route('reports.generate'),
        'extraFilters' => [],
        'type' => 'employees',
    ])

    <!-- Results Summary -->
    <div class="row mb-3">
        <div class="col-md-12">
            <small class="text-muted">
                Showing {{ $employees->firstItem() ?? 0 }} - {{ $employees->lastItem() ?? 0 }}
                of {{ $employees->total() }} employees
                @if(request('from_date') || request('to_date'))
                    &nbsp;|&nbsp; Period:
                    <strong>{{ request('from_date') ?? '—' }}</strong> →
                    <strong>{{ request('to_date') ?? '—' }}</strong>
                @endif
                @if(request('department'))
                    &nbsp;|&nbsp; Department: <strong>{{ request('department') }}</strong>
                @endif
                @if(request('designation'))
                    &nbsp;|&nbsp; Designation: <strong>{{ request('designation') }}</strong>
                @endif
            </small>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>*</th>
                            <th>Name</th>
                            <th>Employee ID</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>Department</th>
                            <th>Designation</th>
                            <th class="text-nowrap">Join Date</th>
                            <th class="text-nowrap">Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($employees as $employee)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $employee->fname }} {{ $employee->lname }}</td>
                            <td>{{ $employee->employee_id }}</td>
                            <td>{{ $employee->email }}</td>
                            <td>{{ $employee->phone }}</td>
                            <td>{{ $employee->department }}</td>
                            <td>{{ $employee->designation }}</td>
                            <td>{{ $employee->join_date }}</td>
                            <td>{{ $employee->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="9" class="text-center">No employees found for the selected filters.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $employees->appends(request()->query())->links() }}
            </div>

        </div>
    </div>

</div>
<!-- /Page Content -->

@endsection