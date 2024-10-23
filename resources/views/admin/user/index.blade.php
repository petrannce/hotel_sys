@extends('layouts.admin.header')
@section('content')

<!-- Page Content -->
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Users</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Dashboard</a></li>
                    <li class="breadcrumb-item active">Users</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="#" class="btn add-btn" data-toggle="modal" data-target="#add_user"><i class="fa fa-plus"></i>
                    Add User</a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>*</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created Date</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td>{{$user->fname}} {{$user->lname}}</td>
                                <td>{{$user->email}}</td>
                                <td>
    <div class="dropdown action-label">
        <a href="#" class="btn btn-white btn-sm btn-rounded dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
            <i class="fa fa-dot-circle-o text-warning"></i> {{ $user->role }}
        </a>
        <div class="dropdown-menu">
            <form action="{{ route('change.role') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <button type="submit" name="role" value="admin" class="dropdown-item">
                    <i class="fa fa-dot-circle-o text-danger"></i> Admin
                </button>
            </form>
            <form action="{{ route('change.role') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <button type="submit" name="role" value="employee" class="dropdown-item">
                    <i class="fa fa-dot-circle-o text-warning"></i> Employee
                </button>
            </form>
            <form action="{{ route('change.role') }}" method="POST">
                @csrf
                <input type="hidden" name="id" value="{{ $user->id }}">
                <button type="submit" name="role" value="client" class="dropdown-item">
                    <i class="fa fa-dot-circle-o text-success"></i> Client
                </button>
            </form>
        </div>
    </div>
</td>


                                <td>{{$user->created_at}}</td>
                                <td class="text-right">
                                    <div class="dropdown dropdown-action">
                                        <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                            aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{route('user.edit', $user->id)}}"><i
                                                    class="fa fa-pencil m-r-5"></i>
                                                Edit</a>
                                            <a class="dropdown-item" href="{{route('user.destroy', $user->id)}}"
                                                data-toggle="modal" data-target="#delete_user"><i
                                                    class="fa fa-trash-o m-r-5"></i> Delete</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /Page Content -->

<!-- Add User Modal -->
<div id="add_user" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{route('user.store')}}" method="POST">
                    @csrf

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Name <span class="text-danger">*</span></label>
                                <input class="form-control" type="text" name="name">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Email <span class="text-danger">*</span></label>
                                <input class="form-control" type="email" name="email">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input class="form-control" type="password" name="password">
                            </div>
                        </div>
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add User Modal -->

<!-- Delete User Modal -->
<div class="modal custom-modal fade" id="delete_user" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete User</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">

                    <div class="row">
                        @if(isset($user))
                            <form method="POST" action="{{ route('user.destroy', $user->id) }}">
                        @endif
                            @csrf
                            @method('DELETE')

                            <div class="modal-btn delete-action">
                                <div class="row">
                                    <div class="col-6">
                                        <button type="submit" class="btn btn-primary continue-btn"
                                            style="width: 212px; height: 49px;">Delete</button>
                                    </div>
                                    <div class="col-6">
                                        <button type="button" class="btn btn-primary cancel-btn" data-dismiss="modal"
                                            style="width: 212px; height: 49px;">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete User Modal -->

<script>
$(document).ready(function () {
    $('.change-role').on('click', function (e) {
        e.preventDefault(); // Prevent the default anchor click behavior

        var role = $(this).data('role'); // Get the new role
        var userId = $(this).data('id'); // Get the user ID

        console.log('Changing role to:', role, 'for user ID:', userId); // Debugging log

        // Send the AJAX request
        $.ajax({
            url: '/change-role', // Update this URL to your actual route
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}', // Include CSRF token for security
                role: role,
                id: userId
            },
            success: function (response) {
                console.log('Response:', response); // Debugging log
                // Update the UI with the new role
                $('a[data-id="' + userId + '"]').closest('div.dropdown').find('a.btn').text(role);
                alert('Role updated successfully!');
            },
            error: function (xhr) {
                console.error('Error:', xhr); // Debugging log
                alert('Failed to update role: ' + xhr.responseText);
            }
        });
    });
});


</script>

@endsection