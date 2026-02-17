@extends('layouts.admin.header')
@section('content')

    <div class="content container-fluid">

        <!-- Welcome Section -->
        <div class="row">
            <div class="col-md-12">
                <div class="welcome-box d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center">
                        <div class="welcome-img me-3">
                            <img alt="Profile" src="{{ asset('assets/img/profiles/avatar-02.jpg') }}" class="rounded-circle"
                                width="80">
                        </div>

                        <div class="welcome-det">
                            @if($employee)
                                <h3 class="fw-bold mb-1">
                                    Welcome, {{ strtoupper($employee->fname . ' ' . $employee->lname) }}
                                </h3>
                                <small class="text-secondary">
                                    Employee ID: <strong>{{ $employee->employee_id }}</strong> |
                                    Department: <strong>{{ $employee->department }}</strong> |
                                    Role: <strong>{{ $employee->designation }}</strong>
                                </small>
                            @else
                                <h3 class="fw-bold mb-1">
                                    Welcome, {{ strtoupper(Auth::user()->name ?? 'Admin') }}
                                </h3>
                                <small class="text-secondary">
                                    You are viewing the employee dashboard as Admin
                                </small>
                            @endif

                            <p class="text-muted mb-0">{{ now()->format('l, d F Y') }}</p>
                        </div>
                    </div>

                    @if($employee)
                        <a href="{{ route('employee.profile') }}" class="btn btn-primary btn-sm">View Profile</a>
                    @endif
                </div>
            </div>
        </div>

        <!-- Dashboard Sections -->
        <div class="row mt-4">
            <div class="col-lg-8 col-md-8">

                <!-- Today -->
                <section class="dash-section">
                    <h1 class="dash-sec-title">Today</h1>
                    <div class="dash-sec-content">
                        @if($attendanceStatus == 'sick')
                            <div class="dash-info-list">
                                <div class="dash-card text-danger">
                                    <div class="dash-card-container">
                                        <div class="dash-card-icon"><i class="fa fa-hourglass-o"></i></div>
                                        <div class="dash-card-content">
                                            <p>{{ $employee->fname ?? 'An employee' }} is off sick today</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($attendanceStatus == 'away')
                            <div class="dash-info-list">
                                <div class="dash-card text-warning">
                                    <div class="dash-card-container">
                                        <div class="dash-card-icon"><i class="fa fa-suitcase"></i></div>
                                        <div class="dash-card-content">
                                            <p>You are away today</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @elseif($attendanceStatus == 'remote')
                            <div class="dash-info-list">
                                <div class="dash-card text-info">
                                    <div class="dash-card-container">
                                        <div class="dash-card-icon"><i class="fa fa-building-o"></i></div>
                                        <div class="dash-card-content">
                                            <p>You are working from home today</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @else
                            <div class="dash-info-list">
                                <div class="dash-card text-success">
                                    <div class="dash-card-container">
                                        <div class="dash-card-icon"><i class="fa fa-check-circle"></i></div>
                                        <div class="dash-card-content">
                                            <p>You are present today. Keep it up!</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </section>

                <!-- Tomorrow -->
                <section class="dash-section">
                    <h1 class="dash-sec-title">Tomorrow</h1>
                    <div class="dash-sec-content">
                        <div class="dash-info-list">
                            <div class="dash-card">
                                <div class="dash-card-container">
                                    <div class="dash-card-icon"><i class="fa fa-calendar"></i></div>
                                    <div class="dash-card-content">
                                        <p>{{ $tomorrowMessage ?? 'No scheduled activities for tomorrow.' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                <!-- Next Seven Days -->
                <section class="dash-section mt-4">
                    <h1 class="dash-sec-title mb-3">Next Seven Days</h1>

                    @if($upcomingEvents && count($upcomingEvents))
                        <div class="timeline-container position-relative ps-4">
                            <div class="timeline-line position-absolute top-0 bottom-0 start-2"
                                style="width: 3px; background: #e0e0e0; border-radius: 2px;"></div>

                            @foreach($upcomingEvents as $event)
                                <div class="timeline-item d-flex mb-4 align-items-start">
                                    <!-- Icon -->
                                    <div class="timeline-icon flex-shrink-0 bg-primary text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm"
                                        style="width: 40px; height: 40px; font-size: 18px; margin-right: 15px;">
                                        <i class="fa fa-{{ $event['icon'] ?? 'calendar' }}"></i>
                                    </div>

                                    <!-- Event content -->
                                    <div class="timeline-content bg-white border rounded-3 p-3 shadow-sm w-100"
                                        style="border-left: 4px solid #6f42c1;">
                                        <h5 class="mb-1 text-dark fw-semibold">
                                            {{ $event['message'] }}
                                        </h5>
                                        <p class="mb-0 text-muted" style="font-size: 14px;">
                                            {{ \Carbon\Carbon::parse($event['date'])->format('l, d M Y') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-muted">No upcoming events this week.</p>
                    @endif
                </section>


            </div>
        </div>
    </div>

@endsection