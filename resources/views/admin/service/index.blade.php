@extends('layouts.admin.header')
@section('content')

<!-- Page Content -->
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Service Requests</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Requests</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_request"><i
                        class="fa fa-plus"></i>
                    Add Request</a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-md-12">
            <div class="card-group m-b-30">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <span class="d-block">Pending Requests</span>
                            </div>
                            <div>
												<span class="text-success">{{ number_format($statusPercentages['pending'], 2) }}%</span>
											</div>
                        </div>
                        <h3 class="mb-3">{{ $statusCounts['pending'] }}</h3>
                        <div class=" progress mb-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;"
                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <span class="d-block">Closed Requests</span>
                            </div>
                            <div>
												<span class="text-success">{{ number_format($statusPercentages['closed'], 2) }}%</span>
											</div>
                        </div>
                        <h3 class="mb-3">{{ $statusCounts['closed'] }}</h3>
                        <div class="progress mb-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;"
                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <span class="d-block">In Progress Requests</span>
                            </div>
                            <div>
												<span class="text-success">{{ number_format($statusPercentages['in_progress'], 2) }}%</span>
											</div>
                        </div>
                        <h3 class="mb-3">{{ $statusCounts['in_progress'] }}</h3>
                        <div class="progress mb-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;"
                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3">
                            <div>
                                <span class="d-block">On Hold Requests</span>
                            </div>
                            <div>
												<span class="text-success">{{ number_format($statusPercentages['on_hold'], 2) }}%</span>
											</div>
                        </div>
                        <h3 class="mb-3">{{ $statusCounts['on_hold'] }}</h3>
                        <div class="progress mb-2" style="height: 5px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%;"
                                aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search Filter -->
    <div class="row filter-row">
        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
            <div class="form-group form-focus">
                <input type="text" class="form-control floating">
                <label class="focus-label">Employee Name</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
            <div class="form-group form-focus select-focus">
                <select class="select floating">
                    <option> -- Select -- </option>
                    <option> Pending </option>
                    <option> Approved </option>
                    <option> Returned </option>
                </select>
                <label class="focus-label">Status</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
            <div class="form-group form-focus">
                <div class="cal-icon">
                    <input class="form-control floating datetimepicker" type="text" name="from_date" value="{{ request()->get('from_date') }}">
                </div>
                <label class="focus-label">From</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
            <div class="form-group form-focus">
                <div class="cal-icon">
                    <input class="form-control floating datetimepicker" type="text" name="to_date" value="{{ request()->get('to_date') }}">
                </div>
                <label class="focus-label">To</label>
            </div>
        </div>
        <div class="col-sm-6 col-md-3 col-lg-3 col-xl-2 col-12">
        <button type="submit" class="btn btn-success btn-block">Search</button>
        </div>
    </div>
    <!-- /Search Filter -->

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table mb-0 datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Room</th>
                            <th>Assigned Staff</th>
                            <th>Created Date</th>
                            <th class="text-center">Status</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($service_requests as $service_request)


                        <tr>
                            <td>{{$loop->index +1}}</td>
                            <td>{{$service_request->room}}</td>
                            <td>{{$service_request->employee}}</td>
                            <td>{{$service_request->created_at}}</td>
                            <td class="text-center">
                                <div class="dropdown action-label">
                                    <a class="btn btn-white btn-sm btn-rounded dropdown-toggle" href="#"
                                        data-toggle="dropdown" aria-expanded="false">
                                        <i class="fa fa-dot-circle-o text-danger"></i> {{$service_request->status}}
                                        </a><div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                    @foreach(['pending' => 'text-info', 'on_hold' => 'text-danger', 'closed' => 'text-success', 'in_progress' => 'text-success'] as $status => $color)
                                        <form action="{{ route('service-request.updateStatus', ['id' => $service_request->id]) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="{{ $status }}">
                                            <button type="submit" class="dropdown-item" style="cursor: pointer; border: none; background: none;">
                                                <i class="fa fa-dot-circle-o {{ $color }}"></i> {{ ucfirst(str_replace('_', ' ', $status)) }}
                                            </button>
                                        </form>
                                    @endforeach
                                </div>
                                </div>
                            </td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{route('request.edit', $service_request->id)}}"><i
                                                class="fa fa-pencil m-r-5"></i> Edit</a>
                                        <a class="dropdown-item"
                                            href="{{route('request.destroy', $service_request->id)}}"
                                            data-toggle="modal" data-target="#delete_service"><i
                                                class="fa fa-trash-o m-r-5"></i>
                                            Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>

                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /Page Content -->

<!-- Add Request Modal -->
<div id="add_request" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('request.store')}}" method="POST">
                    @csrf

                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Request Id</label>
                                <input class="form-control" type="text" name="request_id">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Room No</label>
                                <input class="form-control" type="text" name="room">
                            </div>
                        </div>
                    </div>
                    <div class="row">

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Services</label>
                                <select class="select" name="service">
                                    <option value="">-</option>
                                    @foreach ($services as $service)
                                    <option value="{{$service->name}}">{{$service->name}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Assign Employee</label>
                                <select class="select" name="employee">
                                    <option value="">-</option>
                                    @foreach ($employees as $employee)
                                    <option value="{{$employee->name}}">{{$employee->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea class="form-control" name="description"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Ticket Modal -->

<!-- Delete Service Modal -->
<div class="modal custom-modal fade" id="delete_service" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Service request</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        @if(isset($service_request))
                        <form method="POST" action="{{ route('request.destroy', $service_request->id) }}">
                            @endif
                            @csrf
                            @method('DELETE')

                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary continue-btn"
                                            style="width: 212px; height: 49px;">Delete</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-primary cancel-btn" data-dismiss="modal"
                                            style="width: 212px; height: 49px;">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Service Modal -->

@endsection