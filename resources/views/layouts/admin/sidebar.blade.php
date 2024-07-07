<!-- Sidebar -->
<div class="sidebar" id="sidebar">
    <div class="sidebar-inner slimscroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-dashboard"></i> <span> Dashboard</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{route('admin.dashboard')}}">Admin Dashboard</a></li>
                        <li><a href="{{route('employee.dashboard')}}">Employee Dashboard</a></li>
                        <li><a href="{{route('client.dashboard')}}">Client Dashboard</a></li>
                    </ul>
                </li>
                <li class="menu-title">
                    <span>Employees</span>
                </li>
                <li class="submenu">
                    <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Employees</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{route('employee.index')}}">All Employees</a></li>
                        <li><a href="{{route('department.index')}}">Departments</a></li>
                        <li><a href="{{route('designation.index')}}">Designations</a></li>
                    </ul>
                </li>
                <li class="menu-title">
                    <span>Service Management</span>
                </li>
                <li class="submenu">
                    <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Services</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{route('service.index')}}">All Services</a></li>
                        <li><a href="{{route('request.index')}}">Service assignment</a></li>
                    </ul>
                </li>
                <li>
                    <a href="{{route('request.create')}}"><i class="la la-users"></i> <span>Request Service</span></a>
                </li>
                <li class="menu-title">
                    <span>Booking Management</span>
                </li>
                <li class="submenu">
                    <a href="#" class="noti-dot"><i class="la la-user"></i> <span> Bookings</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{route('booking.index')}}">All Bookings</a></li>

                    </ul>
                </li>
                <li class="menu-title">
                    <span>Client Management</span>
                </li>
                <li class="submenu">
                    <a href="#" class="noti-dot"><i class="la la-users"></i> <span> Clients</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a href="{{route('client.index')}}">All Clients</a></li>

                    </ul>
                </li>
                <li class="menu-title">
                    <span>Administration</span>
                </li>
                <li>
                    <a href="{{route('user.index')}}"><i class="la la-user-plus"></i> <span>Users</span></a>
                </li>
            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->