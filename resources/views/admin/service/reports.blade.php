@extends('layouts.admin.header')
@section('content')

<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Service Reports</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Service Reports</li>
                </ul>
            </div>
        </div>
    </div>

    @include('layouts.partials.filter',[
        'filterRoute' => route('services.report'),
        'reportRoute' => route('reports.generate'),
        'extraFilters' => [],
        'type' => 'services',
    ])

    <!-- REMOVE THE STATUS CARDS SECTION -->

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table mb-0 datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Service Name</th>
                            <th>Department</th>
                            <th>Created Date</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($services as $service)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$service->name}}</td>
                            <td>{{$service->department}}</td>
                            <td>{{$service->created_at->format('d M Y')}}</td>
                            <td class="text-right">
                                <a href="{{route('service.edit', $service->id)}}" class="btn btn-sm btn-primary">
                                    <i class="fa fa-pencil"></i> Edit
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="mt-3">
                {{ $services->links() }}
            </div>
        </div>
    </div>
</div>

@endsection