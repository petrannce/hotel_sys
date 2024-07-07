@extends('layouts.admin.header')
@section('content')

<!-- Page Content -->
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Bookings</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Bookings</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#create_booking"><i
                        class="fa fa-plus"></i> Create Booking</a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>Client Id</th>
                            <th>Room No</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($bookings as $booking)
                        <tr>
                            <td>{{$booking->client_id}}</td>
                            <td>{{$booking->room}}</td>
                            <td>{{$booking->check_in}} </td>
                            <td>{{$booking->check_out}} </td>
                            <td>
                                <div class="dropdown action-label">
                                    <a href="" class="btn btn-white btn-sm btn-rounded dropdown-toggle"
                                        data-toggle="dropdown" aria-expanded="false"><i
                                            class="fa fa-dot-circle-o text-danger"></i> High </a>
                                    <div class="dropdown-menu">
                                        <a class="dropdown-item" href="#"><i class="fa fa-dot-circle-o text-danger"></i>
                                            High</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="fa fa-dot-circle-o text-warning"></i> Medium</a>
                                        <a class="dropdown-item" href="#"><i
                                                class="fa fa-dot-circle-o text-success"></i> Low</a>
                                    </div>
                                </div>
                            </td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#edit_project"><i class="fa fa-pencil m-r-5"></i> Edit</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal"
                                            data-target="#delete_project"><i class="fa fa-trash-o m-r-5"></i> Delete</a>
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

<!-- Create Booking Modal -->
<div id="create_booking" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Create Booking</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('booking.store')}}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Client ID</label>
                                <input class="form-control" type="text" name="client_id" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Room No</label>
                                <input class="form-control" type="text" name="room" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Check In</label>
                                <div class="cal-icon">
                                    <input class="form-control datetimepicker" type="text" name="check_in" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Check out</label>
                                <div class="cal-icon">
                                    <input class="form-control datetimepicker" type="text" name="check_out" required>
                                </div>
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
<!-- /Create Booking Modal -->

<!-- Delete Booking Modal -->
<div class="modal custom-modal fade" id="delete_project" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Booking</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">

                    <div class="row">
                        @if(isset($booking))
                        <form method="POST" action="{{ route('booking.destroy', $booking->id) }}">
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
<!-- /Delete Booking Modal -->

@endsection