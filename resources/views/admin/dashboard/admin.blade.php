@extends('layouts.admin.header')
@section('content')

<!-- Page Content -->
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Welcome {{ Auth::user()->name }}! - {{ Auth::user()->roles[0]->name }}</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item active">Dashboard</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <!-- Summary Widgets -->
    <div class="row">
        @php
            $widgets = [
                ['icon' => 'fa-diamond', 'count' => $departments->count(), 'label' => 'Departments'],
                ['icon' => 'fa-building', 'count' => $unbookedRooms, 'label' => 'Unbooked Rooms'],
                ['icon' => 'fa-users', 'count' => $clientsCount, 'label' => 'Clients'],
                ['icon' => 'fa-user', 'count' => $bookings->count(), 'label' => 'Bookings'],
                ['icon' => 'fa-users', 'count' => $users->count(), 'label' => 'Users'],
                ['icon' => 'fa-user-plus', 'count' => $employees->count(), 'label' => 'Employees'],
                ['icon' => 'fa-ring', 'count' => $designations->count(), 'label' => 'Designations'],
                ['icon' => 'fa-briefcase', 'count' => $services->count(), 'label' => 'Services'],
            ];
        @endphp

        @foreach($widgets as $widget)
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="card dash-widget">
                    <div class="card-body">
                        <span class="dash-widget-icon"><i class="fa {{ $widget['icon'] }}"></i></span>
                        <div class="dash-widget-info">
                            <h3>{{ $widget['count'] }}</h3>
                            <span>{{ $widget['label'] }}</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- /Summary Widgets -->

    <!-- Charts Section -->
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-6 text-center">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Total Revenue</h3>
                            <div id="bar-charts"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 text-center">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">Sales Overview</h3>
                            <div id="line-charts"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Charts Section -->

</div>
<!-- /Page Content -->

@endsection