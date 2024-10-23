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

                    @role('admin')
                        <li><a class="{{ Request::route()->getName() == 'admin.dashboard' ? 'active' : 'inactive' }}" href="{{route('admin.dashboard')}}">Admin Dashboard</a></li>
                    @endrole

                    @role('employee|admin')
                        <li><a class="{{ Request::route()->getName() == 'employee.dashboard' ? 'active' : 'inactive' }}" href="{{route('employee.dashboard')}}">Employee Dashboard</a></li>
                    @endrole

                    @role('client|admin')
                        <li><a class="{{ Request::route()->getName() == 'client.dashboard' ? 'active' : 'inactive' }}" href="{{route('client.dashboard')}}">Client Dashboard</a></li>
                    @endrole

                    </ul>
                </li>

                @role('admin')
                <li class="menu-title">
                    <span>Employees</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-user"></i> <span> Employees</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ Request::route()->getName() == 'employee.index' ? 'active' : 'inactive' }}" href="{{route('employee.index')}}">All Employees</a></li>
                        <li><a class="{{ Request::route()->getName() == 'department.index' ? 'active' : 'inactive' }}" href="{{route('department.index')}}">Departments</a></li>
                        <li><a class="{{ Request::route()->getName() == 'designation.index' ? 'active' : 'inactive' }}" href="{{route('designation.index')}}">Designations</a></li>
                    </ul>
                </li>

                @endrole

                @role('admin|employee')

                <li class="menu-title">
                    <span>Service Management</span>
                </li>
                <li class="submenu">
                    <a href="#"><i class="la la-user"></i> <span> Services</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">

                    @role('admin')
                        <li><a class="{{ Request::route()->getName() == 'service.index' ? 'active' : 'inactive' }}" href="{{route('service.index')}}">All Services</a></li>
                    @endrole

                    @role('employee|admin')
                        <li><a class="{{ Request::route()->getName() == 'request.index' ? 'active' : 'inactive' }}" href="{{route('request.index')}}">Service assignment</a></li>
                    @endrole

                    </ul>
                </li>

                @endrole

                @role('admin|client')
                <li>
                    <a class="{{ Request::route()->getName() == 'request.create' ? 'active' : 'inactive' }}" href="{{route('request.create')}}"><i class="la la-users"></i> <span>Request Service</span></a>
                </li>

                @endrole

                @role('admin')
                <li class="menu-title">
                    <span>Booking Management</span>
                </li>
                <li class="submenu">
                    <a href="#" ><i class="la la-user"></i> <span> Bookings</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ Request::route()->getName() == 'booking.index' ? 'active' : 'inactive' }}" href="{{route('booking.index')}}">All Bookings</a></li>

                    </ul>
                </li>
                <li class="submenu">
                    <a href="#" ><i class="la la-user"></i> <span> Rooms</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ Request::route()->getName() == 'room.index' ? 'active' : 'inactive' }}" href="{{route('room.index')}}">All Rooms</a></li>
                    </ul>
                </li>

                @endrole

                @role('admin')
                <li class="menu-title">
                    <span>Gallery </span>
                </li>
                <li>
                    <a class="{{ Request::route()->getName() == 'gallery.index' ? 'active' : 'inactive' }}" href="{{route('gallery.index')}}"><i class="la la-user-plus"></i> <span>Gallery</span></a>
                </li>

                @endrole


                @role('admin')
                <li class="menu-title">
                    <span>Client Management</span>
                </li>
                <li class="submenu">
                    <a href="#" ><i class="la la-users"></i> <span> Clients</span> <span
                            class="menu-arrow"></span></a>
                    <ul style="display: none;">
                        <li><a class="{{ Request::route()->getName() == 'client.index' ? 'active' : 'inactive' }}" href="{{route('client.index')}}">All Clients</a></li>

                    </ul>
                </li>
                @endrole

                @role('admin')
                <li class="menu-title">
                    <span>Administration</span>
                </li>
                <li>
                    <a class="{{ Request::route()->getName() == 'user.index' ? 'active' : 'inactive' }}" href="{{route('user.index')}}"><i class="la la-user-plus"></i> <span>Users</span></a>
                </li>

                @endrole

                @role('admin')
                <li class="menu-title">
                    <span>Roles & permission </span>
                </li>
                <li>
                    <a class="{{ Request::route()->getName() == 'roles.index' ? 'active' : 'inactive' }}" href="{{route('roles.index')}}"><i class="la la-user-plus"></i> <span>Roles</span></a>
                </li>

                @endrole
                

            </ul>
        </div>
    </div>
</div>
<!-- /Sidebar -->