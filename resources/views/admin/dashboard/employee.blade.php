@extends('layouts.admin.header')
@section('content')

<!-- Page Content -->
<div class="content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="welcome-box">
                <div class="welcome-img">
                    <img alt="" src="assets/img/profiles/avatar-02.jpg">
                </div>
                <div class="welcome-det">
                    <h3>Welcome, EMP-0012</h3>
                    <p>{{ now()->format('l, d F Y') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-md-8">
            <section class="dash-section">
                <h1 class="dash-sec-title">Today</h1>
                <div class="dash-sec-content">
                    <div class="dash-info-list">
                        <a href="#" class="dash-card text-danger">
                            <div class="dash-card-container">
                                <div class="dash-card-icon">
                                    <i class="fa fa-hourglass-o"></i>
                                </div>
                                <div class="dash-card-content">
                                    <p>Richard Miles is off sick today</p>
                                </div>
                                <div class="dash-card-avatars">
                                    <div class="e-avatar"><img src="assets/img/profiles/avatar-09.jpg" alt=""></div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="dash-info-list">
                        <a href="#" class="dash-card">
                            <div class="dash-card-container">
                                <div class="dash-card-icon">
                                    <i class="fa fa-suitcase"></i>
                                </div>
                                <div class="dash-card-content">
                                    <p>You are away today</p>
                                </div>
                                <div class="dash-card-avatars">
                                    <div class="e-avatar"><img src="assets/img/profiles/avatar-02.jpg" alt=""></div>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="dash-info-list">
                        <a href="#" class="dash-card">
                            <div class="dash-card-container">
                                <div class="dash-card-icon">
                                    <i class="fa fa-building-o"></i>
                                </div>
                                <div class="dash-card-content">
                                    <p>You are working from home today</p>
                                </div>
                                <div class="dash-card-avatars">
                                    <div class="e-avatar"><img src="assets/img/profiles/avatar-02.jpg" alt=""></div>
                                </div>
                            </div>
                        </a>
                    </div>

                </div>
            </section>

            <section class="dash-section">
                <h1 class="dash-sec-title">Tomorrow</h1>
                <div class="dash-sec-content">
                    <div class="dash-info-list">
                        <div class="dash-card">
                            <div class="dash-card-container">
                                <div class="dash-card-icon">
                                    <i class="fa fa-suitcase"></i>
                                </div>
                                <div class="dash-card-content">
                                    <p>2 people will be away tomorrow</p>
                                </div>
                                <div class="dash-card-avatars">
                                    <a href="#" class="e-avatar"><img src="assets/img/profiles/avatar-04.jpg"
                                            alt=""></a>
                                    <a href="#" class="e-avatar"><img src="assets/img/profiles/avatar-08.jpg"
                                            alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section class="dash-section">
                <h1 class="dash-sec-title">Next seven days</h1>
                <div class="dash-sec-content">
                    <div class="dash-info-list">
                        <div class="dash-card">
                            <div class="dash-card-container">
                                <div class="dash-card-icon">
                                    <i class="fa fa-suitcase"></i>
                                </div>
                                <div class="dash-card-content">
                                    <p>2 people are going to be away</p>
                                </div>
                                <div class="dash-card-avatars">
                                    <a href="#" class="e-avatar"><img src="assets/img/profiles/avatar-05.jpg"
                                            alt=""></a>
                                    <a href="#" class="e-avatar"><img src="assets/img/profiles/avatar-07.jpg"
                                            alt=""></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dash-info-list">
                        <div class="dash-card">
                            <div class="dash-card-container">
                                <div class="dash-card-icon">
                                    <i class="fa fa-user-plus"></i>
                                </div>
                                <div class="dash-card-content">
                                    <p>Your first day is going to be on Thursday</p>
                                </div>
                                <div class="dash-card-avatars">
                                    <div class="e-avatar"><img src="assets/img/profiles/avatar-02.jpg" alt=""></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="dash-info-list">
                        <a href="" class="dash-card">
                            <div class="dash-card-container">
                                <div class="dash-card-icon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div class="dash-card-content">
                                    <p>It's Spring Bank Holiday on Monday</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </section>
        </div>
    </div>

</div>
<!-- /Page Content -->

@endsection