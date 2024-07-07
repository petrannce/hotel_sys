@extends('layouts.admin.header')
@section('content')

<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col">
                <h3 class="page-title">Edit Client</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('client.index')}}">Clients</a></li>
                    <li class="breadcrumb-item active">Edit Client</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-0">
                <div class="card-header">
                    <h4 class="card-title mb-0">Edit Client</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('client.update', $client->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('put')

                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{ __('First Name') }}</label>
                                            <input class="form-control" type="text" name="fname"
                                                value="{{$client->fname}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{ __('Last Name') }}</label>
                                            <input class="form-control" type="text" name="lname"
                                                value="{{$client->lname}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{ __('Username') }}</label>
                                            <input class="form-control" type="text" name="username"
                                                value="{{$client->username}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{ __('Email') }}</label>
                                            <input class="form-control" type="text" name="email"
                                                value="{{$client->email}}">
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
                                            <label>{{ __('Client ID') }}</label>
                                            <input class="form-control" type="text" name="client_id"
                                                value="{{$client->client_id}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>{{ __('Phone Number') }}</label>
                                            <input class="form-control" type="text" name="phone"
                                                value="{{$client->phone}}">
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