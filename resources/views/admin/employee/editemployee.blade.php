@extends('layouts.admin.header')
@section('content')

<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Edit Employee</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('employee.index')}}">Employees</a></li>
                    <li class="breadcrumb-item active">Edit Employee</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-0">
                <div class="card-header">
                    <h4 class="card-title mb-0">Edit Employee</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('employee.update', $employee->id)}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{ __('First Name') }}</label>
                                            <input class="form-control" type="text" name="fname"
                                                value="{{$employee->fname}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{ __('Last Name') }}</label>
                                            <input class="form-control" type="text" name="lname"
                                                value="{{$employee->lname}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{ __('Username') }}</label>
                                            <input class="form-control" type="text" name="username"
                                                value="{{$employee->username}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{ __('Email') }}</label>
                                            <input class="form-control" type="text" name="email"
                                                value="{{$employee->email}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{ __('Password') }}</label>
                                            <input class="form-control" type="text" name="password">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{ __('Employee ID') }}</label>
                                            <input class="form-control" type="text" name="employee_id"
                                                value="{{$employee->employee_id}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{ __('Joining Date') }}</label>
                                            <input class="form-control" type="text" name="join_date"
                                                value="{{$employee->join_date}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{ __('Phone Number') }}</label>
                                            <input class="form-control" type="text" name="phone"
                                                value="{{$employee->phone}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Department') }}</label>
                                    <div>
                                        <select class="form-control" name="department">
                                            <option value="">Select Department</option>
                                            @foreach($departments as $department)
                                            <option value="{{ $department->name }}" @if($employee->department ==
                                                $department->name)
                                                selected
                                                @endif>{{ $department->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>{{ __('Designation') }}</label>
                                    <div>
                                        <select class="form-control" name="designation">
                                            <option value="">Select Designation</option>
                                            @foreach($designations as $designation)
                                            <option value="{{ $designation->name }}" @if($employee->designation ==
                                                $designation->name)
                                                selected
                                                @endif>{{ $designation->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection