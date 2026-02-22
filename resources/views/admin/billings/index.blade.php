@extends('layouts.admin.header')
@section('content')

<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Billing</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Billing</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="{{ route('billing.create') }}" class="btn add-btn">
                    <i class="fa fa-plus"></i> Create Bill
                </a>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table id="dataTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Bill No.</th>
                            <th>Guest Name</th>
                            <th>Room No.</th>
                            <th>Check In</th>
                            <th>Check Out</th>
                            <th>Total (KES)</th>
                            <th>Payment Status</th>
                            <th>Payment Method</th>
                            <th class="text-right no-sort">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($billings as $billing)
                        <tr>
                            <td>{{ $loop->index + 1 }}</td>
                            <td><strong>{{ $billing->bill_number }}</strong></td>
                            <td>{{ $billing->booking->fname }} {{ $billing->booking->lname }}</td>
                            <td>{{ $billing->booking->room_number }}</td>
                            <td>{{ $billing->booking->check_in }}</td>
                            <td>{{ $billing->booking->check_out }}</td>
                            <td>{{ number_format($billing->total_amount, 2) }}</td>
                            <td>
                                @php
                                    $statusColors = [
                                        'unpaid'  => 'danger',
                                        'partial' => 'warning',
                                        'paid'    => 'success',
                                    ];
                                    $color = $statusColors[$billing->payment_status] ?? 'secondary';
                                @endphp
                                <span class="badge badge-{{ $color }}">
                                    {{ ucfirst($billing->payment_status) }}
                                </span>
                            </td>
                            <td>{{ ucfirst(str_replace('_', ' ', $billing->payment_method ?? '—')) }}</td>
                            <td class="text-right">
                                <div class="dropdown dropdown-action">
                                    <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown"
                                        aria-expanded="false"><i class="material-icons">more_vert</i></a>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="{{ route('billing.show', $billing->id) }}">
                                            <i class="fa fa-eye m-r-5"></i> View
                                        </a>
                                        <a class="dropdown-item" href="{{ route('billing.edit', $billing->id) }}">
                                            <i class="fa fa-pencil m-r-5"></i> Edit
                                        </a>
                                        <a class="dropdown-item" href="#"
                                            onclick="confirmDelete({{ $billing->id }})">
                                            <i class="fa fa-trash-o m-r-5"></i> Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10" class="text-center">No bills found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3">
                {{ $billings->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Delete Form (hidden) -->
<form id="delete-form" method="POST" action="" style="display:none;">
    @csrf
    @method('DELETE')
</form>

<!-- Delete Modal -->
<div class="modal custom-modal fade" id="delete_billing" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="form-header">
                    <h3>Delete Bill</h3>
                    <p>Are you sure you want to delete this bill? This cannot be undone.</p>
                </div>
                <div class="modal-btn delete-action">
                    <div class="row">
                        <div class="col-6">
                            <button type="button" class="btn btn-primary continue-btn"
                                style="width: 212px; height: 49px;"
                                onclick="document.getElementById('delete-form').submit()">Delete</button>
                        </div>
                        <div class="col-6">
                            <button type="button" class="btn btn-primary cancel-btn" data-dismiss="modal"
                                style="width: 212px; height: 49px;">Cancel</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function confirmDelete(id) {
        document.getElementById('delete-form').action = '/admin/billing/' + id;
        $('#delete_billing').modal('show');
    }
</script>

@endsection