@extends('layouts.admin.header')
@section('content')

<!-- Page Content -->
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Designations</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Designations</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_designation"><i
                        class="fa fa-plus"></i> Add Designation</a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped custom-table mb-0 datatable">
                    <thead>
                        <tr>
                            <th style="width: 30px;">#</th>
                            <th>Designation </th>
                            <th>Department </th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach ($designations as $designation)

                        <tr>
                            <td>{{$loop->index +1}}</td>
                            <td>{{$designation->name}}</td>
                            <td>{{$designation->department}}</td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item"
                                            href="{{route('designation.edit', $designation->id)}}"><i
                                                class="fa fa-pencil m-r-5"></i>
                                            Edit</a>
                                        <a class="dropdown-item"
                                            href="{{route('designation.destroy', $designation->id)}}"
                                            data-toggle="modal" data-target="#delete_designation"><i
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

<!-- Add Designation Modal -->
<div id="add_designation" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Designation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('designation.store')}}" method="post">
                    @csrf

                    <div class="form-group">
                        <label>Designation Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="name">
                    </div>
                    <div class="form-group">
                        <label>Department <span class="text-danger">*</span></label>
                        <select class="select" name="department">
                            <option value="">Select Department</option>
                            @foreach ($departments as $department)
                            <option value="{{$department->name}}">{{$department->name}}</option>
                            @endforeach

                        </select>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Designation Modal -->

<!-- Delete Designation Modal -->
<div class="modal custom-modal fade" id="delete_designation" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Designation</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        @if(isset($designation))
                        <form method="POST" action="{{ route('designation.destroy', $designation->id) }}">
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
<!-- /Delete Designation Modal -->

@endsection