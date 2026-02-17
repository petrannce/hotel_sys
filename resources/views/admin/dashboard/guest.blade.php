@extends('layouts.admin.header')

@section('content')
<div class="content container-fluid">

    <!-- Welcome -->
    <div class="row">
        <div class="col-md-12">
            <div class="welcome-box shadow-sm p-3 rounded d-flex align-items-center">
                <div class="welcome-img me-3">
                    <img alt="Profile" src="{{ asset('assets/img/profiles/avatar-02.jpg') }}" class="rounded-circle" width="80">
                </div>
                <div class="welcome-det">
                    <h3 class="fw-bold mb-1">Welcome back, {{ ucfirst($user->fname) }}</h3>
                    <p class="text-muted mb-0">{{ now()->format('l, d F Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Dashboard sections -->
    <div class="row mt-4">
        <div class="col-lg-8 col-md-8">

            <!-- Today -->
            <section class="dash-section mb-4">
                <h1 class="dash-sec-title mb-3">Today</h1>

                @if($currentBooking)
                    <div class="card border-0 shadow-sm p-3 mb-3">
                        <div class="d-flex align-items-center">
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-3" style="width:45px; height:45px;">
                                <i class="fa fa-bed"></i>
                            </div>
                            <div>
                                <h5 class="mb-1">You’re checked into Room {{ $currentBooking->room_number }}</h5>
                                <p class="text-muted mb-0">Enjoy your stay with us until {{ \Carbon\Carbon::parse($currentBooking->check_out)->format('l, d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="alert alert-info">You have no active bookings today.</div>
                @endif

                @if($serviceRequests->count())
                    <div class="timeline-container position-relative ps-4">
                        <div class="timeline-line position-absolute top-0 bottom-0 start-2" style="width: 3px; background: #e0e0e0; border-radius: 2px;"></div>
                        @foreach($serviceRequests as $request)
                            <div class="timeline-item d-flex mb-4 align-items-start">
                                <div class="timeline-icon flex-shrink-0 bg-success text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px; font-size: 18px; margin-right: 15px;">
                                    <i class="fa fa-concierge-bell"></i>
                                </div>
                                <div class="timeline-content bg-white border rounded-3 p-3 shadow-sm w-100" style="border-left: 4px solid #28a745;">
                                    <h5 class="mb-1 text-dark fw-semibold">{{ $request->service }}</h5>
                                    <p class="mb-0 text-muted" style="font-size: 14px;">Status: {{ ucfirst($request->status) }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No service requests yet.</p>
                @endif
            </section>

            <!-- Tomorrow & Upcoming -->
            <section class="dash-section">
                <h1 class="dash-sec-title mb-3">Upcoming Bookings</h1>
                @if($upcomingBookings->count())
                    <div class="timeline-container position-relative ps-4">
                        <div class="timeline-line position-absolute top-0 bottom-0 start-2" style="width: 3px; background: #e0e0e0; border-radius: 2px;"></div>
                        @foreach($upcomingBookings as $booking)
                            <div class="timeline-item d-flex mb-4 align-items-start">
                                <div class="timeline-icon flex-shrink-0 bg-warning text-white rounded-circle d-flex align-items-center justify-content-center shadow-sm" style="width: 40px; height: 40px; font-size: 18px; margin-right: 15px;">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div class="timeline-content bg-white border rounded-3 p-3 shadow-sm w-100" style="border-left: 4px solid #ffc107;">
                                    <h5 class="mb-1 text-dark fw-semibold">Room {{ $booking->room_number }}</h5>
                                    <p class="mb-0 text-muted" style="font-size: 14px;">
                                        Check-in: {{ \Carbon\Carbon::parse($booking->check_in)->format('l, d M Y') }}<br>
                                        Check-out: {{ \Carbon\Carbon::parse($booking->check_out)->format('l, d M Y') }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">No upcoming bookings found.</p>
                @endif
            </section>
        </div>

        <!-- Right sidebar -->
        <div class="col-lg-4 col-md-4">
            <section class="dash-section mb-4">
                <h1 class="dash-sec-title mb-3">Available Services</h1>
                <div class="list-group shadow-sm rounded">
                    @foreach($services as $service)
                        <div class="list-group-item d-flex justify-content-between align-items-center">
                            <span>{{ $service->name }}</span>
                            <span class="badge bg-primary">{{ ucfirst($service->department) }}</span>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</div>

<!-- Hover effects for timeline -->
<style>
.timeline-content {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}
.timeline-content:hover {
    transform: translateY(-3px);
    box-shadow: 0 6px 14px rgba(0,0,0,0.1);
}
</style>
@endsection
