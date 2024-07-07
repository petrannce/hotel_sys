@extends('layouts.admin.header')
@section('content')

<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Edit Designation</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('designation.index')}}">Designation</a></li>
                    <li class="breadcrumb-item active">Edit Designation</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-0">
                <div class="card-header">
                    <h4 class="card-title mb-0">Edit Designation</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('designation.update', $designation->id)}}" method="post"
                        enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{ __('Designation Name') }}</label>
                                            <input class="form-control" type="text" name="name"
                                                value="{{$designation->name}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{ __('Department') }}</label>
                                            <input class="form-control" type="text" name="department"
                                                value="{{$designation->department}}">
                                        </div>
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