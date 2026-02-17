@extends('layouts.admin.header')
@section('content')

<!-- Page Content -->
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Designations Report</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('designation.index') }}">Designations</a></li>
                    <li class="breadcrumb-item active">Report</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                @if(isset($canExport) && $canExport)
                <form method="POST" action="{{ route('reports.generate') }}" target="_blank" style="display:inline;">
                    @csrf
                    <input type="hidden" name="type" value="designations">
                    <input type="hidden" name="from_date" value="{{ request('from_date') }}">
                    <input type="hidden" name="to_date" value="{{ request('to_date') }}">
                    <button type="submit" class="btn btn-danger">
                        <i class="fa fa-file-pdf-o"></i> Export PDF
                    </button>
                </form>
                @endif
                <a href="{{ route('designation.index') }}" class="btn btn-secondary ml-2">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    @include('layouts.partials.filter', [
        'filterRoute' => route('designations.report'),
        'reportRoute' => route('reports.generate'),
        'extraFilters' => [],
        'type' => 'designations',
    ])

    <!-- Results Summary -->
    <div class="row mb-3">
        <div class="col-md-12">
            <small class="text-muted">
                Showing {{ $designations->firstItem() ?? 0 }} - {{ $designations->lastItem() ?? 0 }}
                of {{ $designations->total() }} designations
                @if(request('from_date') || request('to_date'))
                    &nbsp;|&nbsp; Period:
                    <strong>{{ request('from_date') ?? '—' }}</strong> →
                    <strong>{{ request('to_date') ?? '—' }}</strong>
                @endif
            </small>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table mb-0">
                    <thead>
                        <tr>
                            <th style="width: 30px;">#</th>
                            <th>Designation</th>
                            <th>Department</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($designations as $designation)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td>{{ $designation->name }}</td>
                            <td>{{ $designation->department }}</td>
                            <td>{{ $designation->created_at->format('Y-m-d') }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center">No designations found for the selected filters.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-3">
                {{ $designations->appends(request()->query())->links() }}
            </div>

        </div>
    </div>
</div>
<!-- /Page Content -->

@endsection