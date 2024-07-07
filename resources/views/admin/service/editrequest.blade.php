@extends('layouts.admin.header')
@section('content')

<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Edit Service Requests</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Edit Service Requests</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Service Requests</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('request.update', $service_request->id)}}" method="POST">
                        @csrf
                        @METHOD('PUT')

                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Request ID</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="request_id" value="{{ $service_request->request_id }}" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Room No</label>
                            <div class="col-md-10">
                                <input type="text" class="form-control" name="room" value="{{ $service_request->room }}">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Services</label>
                            <div class="col-md-10">
                                <select class="form-control" name="service">
                                    <option value="">-- Select --</option>
                                    @foreach ($services as $service)
                                    <option value="{{ $service->name }}">{{ $service->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Employees</label>
                            <div class="col-md-10">
                                <select class="form-control" name="employee">
                                    <option value="">-- Select --</option>
                                    @foreach ($employees as $employee)
                                    <option value="{{$employee->fname}} {{$employee->lname}}">{{$employee->fname}}
                                        {{$employee->lname}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-form-label col-md-2">Description</label>
                            <div class="col-md-10">
                                <textarea rows="5" cols="5" class="form-control" placeholder="Enter text here"
                                    name="description">{{ $service_request->description }}</textarea>
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