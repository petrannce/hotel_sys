@extends('layouts.admin.header')

@section('content')

<!-- Page Content -->
<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <h3 class="page-title">Roles & Permissions</h3>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
    <div class="col-sm-4 col-md-4 col-lg-4 col-xl-3">
        <a href="#" class="btn btn-primary btn-block" data-toggle="modal" data-target="#add_role">
            <i class="fa fa-plus"></i> Add Roles
        </a>
        <div class="roles-menu">
            <ul>
                @foreach ($roles as $role)
                    <li id="role-{{ $role->id }}" class="role-item">
                        <a href="javascript:void(0);" onclick="activateRole({{ $role->id }})">
                            {{ $role->name }}
                            <span class="role-action">
                                <span class="action-circle large" data-toggle="modal" data-target="#edit_role">
                                    <i class="material-icons">edit</i>
                                </span>
                                <span class="action-circle large delete-btn" data-toggle="modal"
                                    data-target="#delete_role">
                                    <i class="material-icons">delete</i>
                                </span>
                            </span>
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    
    <div class="col-sm-8 col-md-8 col-lg-8 col-xl-9">
        <h6 class="card-title m-b-20">Module Access</h6>
        <div class="m-b-30" id="permissions-section" style="display: none;">
            <ul class="list-group notification-list" id="permissions-list">
                <!-- All permissions will be listed here, checked based on the selected role -->
            </ul>
        </div>
    </div>
</div>
</div>
<!-- /Page Content -->

<!-- Add Role Modal -->
<div id="add_role" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Role Name <span class="text-danger">*</span></label>
                        <input class="form-control" type="text">
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Add Role Modal -->

<!-- Edit Role Modal -->
<div id="edit_role" class="modal custom-modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content modal-md">
            <div class="modal-header">
                <h5 class="modal-title">Edit Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Role Name <span class="text-danger">*</span></label>
                        <input class="form-control" value="Team Leader" type="text">
                    </div>
                    <div class="submit-section">
                        <button class="btn btn-primary submit-btn">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /Edit Role Modal -->

<!-- Delete Role Modal -->
<div class="modal custom-modal fade" id="delete_role" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Role</h3>
                    <p>Are you sure want to delete?</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <a href="javascript:void(0);" class="btn btn-primary continue-btn">Delete</a>
                        </div>
                        <div class="col-6">
                            <a href="javascript:void(0);" data-dismiss="modal"
                                class="btn btn-primary cancel-btn">Cancel</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /Delete Role Modal -->

<script>
    function activateRole(roleId) {
        // Remove 'active' class from all role items
        const roleItems = document.querySelectorAll('.role-item');
        roleItems.forEach(item => {
            item.classList.remove('active');
        });

        // Add 'active' class to the clicked role
        const activeRoleItem = document.getElementById(`role-${roleId}`);
        if (activeRoleItem) {
            activeRoleItem.classList.add('active');
        }

        // Optionally, call the function to show permissions for the selected role
        showPermissions(roleId);
    }
</script>


<script>
    const allPermissions = [
        @foreach ($permissions as $permission)
            { name: "{{ $permission->name }}", id: {{ $permission->id }} },
        @endforeach
    ];

    const rolePermissions = {
        @foreach ($roles as $role)
            {{ $role->id }}: [
                @foreach ($role->permissions as $permission)
                    {{ $permission->id }},
                @endforeach
            ],
        @endforeach
    };

    function activateRole(roleId) {
        // Remove 'active' class from all role items
        const roleItems = document.querySelectorAll('.role-item');
        roleItems.forEach(item => {
            item.classList.remove('active');
        });

        // Add 'active' class to the clicked role
        const activeRoleItem = document.getElementById(`role-${roleId}`);
        if (activeRoleItem) {
            activeRoleItem.classList.add('active');
        }

        // Show permissions associated with the selected role
        showPermissions(roleId);
    }

    function showPermissions(roleId) {
        const permissionsList = document.getElementById('permissions-list');
        permissionsList.innerHTML = ''; // Clear existing permissions

        // Get current permissions for the selected role
        const currentRolePermissions = rolePermissions[roleId] || [];

        // Build permissions UI with all permissions, checking those that are active for the role
        allPermissions.forEach(permission => {
            const isChecked = currentRolePermissions.includes(permission.id);

            const listItem = document.createElement('li');
            listItem.classList.add('list-group-item');
            listItem.innerHTML = `
                ${permission.name}
                <div class="status-toggle">
                    <input type="checkbox" id="permission-${permission.id}" class="check" ${isChecked ? 'checked' : ''}>
                    <label for="permission-${permission.id}" class="checktoggle">checkbox</label>
                </div>
            `;
            permissionsList.appendChild(listItem);
        });

        // Show the permissions section
        document.getElementById('permissions-section').style.display = 'block';
    }
</script>

@endsection