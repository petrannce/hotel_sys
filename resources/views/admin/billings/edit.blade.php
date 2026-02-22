@extends('layouts.admin.header')
@section('content')

<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Edit Bill</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('billing.index') }}">Billing</a></li>
                    <li class="breadcrumb-item active">Edit — {{ $billing->bill_number }}</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show">
            {{ session('error') }}
            <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>
        </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-0">
                <div class="card-header">
                    <h4 class="card-title mb-0">{{ $billing->bill_number }}</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('billing.update', $billing->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Booking Info (read only) -->
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="mb-3" style="border-bottom: 1px solid #eee; padding-bottom: 8px;">
                                    Booking Details
                                </h5>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Guest Name</label>
                                    <input type="text" class="form-control"
                                        value="{{ $billing->booking->fname }} {{ $billing->booking->lname }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Room No.</label>
                                    <input type="text" class="form-control"
                                        value="{{ $billing->booking->room_number }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Check In</label>
                                    <input type="text" class="form-control"
                                        value="{{ $billing->booking->check_in }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Check Out</label>
                                    <input type="text" class="form-control"
                                        value="{{ $billing->booking->check_out }}" readonly>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Room Charges (KES)</label>
                                    <input type="text" class="form-control"
                                        value="{{ number_format($billing->room_charges, 2) }}" readonly>
                                </div>
                            </div>
                        </div>

                        <!-- Bill Items -->
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="mb-3 mt-2" style="border-bottom: 1px solid #eee; padding-bottom: 8px;">
                                    Bill Items
                                </h5>
                                <div class="table-responsive mb-3">
                                    <table class="table table-bordered table-sm">
                                        <thead style="background: #f3f3f3;">
                                            <tr>
                                                <th>#</th>
                                                <th>Description</th>
                                                <th>Type</th>
                                                <th class="text-center">Qty</th>
                                                <th class="text-right">Unit Price (KES)</th>
                                                <th class="text-right">Subtotal (KES)</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($billing->items as $index => $item)
                                            <tr>
                                                <td>{{ $index + 1 }}</td>
                                                <td>{{ $item->description }}</td>
                                                <td>
                                                    <span class="badge badge-{{ $item->type === 'room' ? 'primary' : 'info' }}">
                                                        {{ ucfirst($item->type) }}
                                                    </span>
                                                </td>
                                                <td class="text-center">{{ $item->quantity }}</td>
                                                <td class="text-right">{{ number_format($item->amount, 2) }}</td>
                                                <td class="text-right">{{ number_format($item->subtotal, 2) }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <!-- Adjustments -->
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="mb-3" style="border-bottom: 1px solid #eee; padding-bottom: 8px;">
                                    Adjustments & Payment
                                </h5>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Discount (KES)</label>
                                    <input type="number" class="form-control" name="discount"
                                        id="discount" value="{{ $billing->discount }}" min="0" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tax (KES)</label>
                                    <input type="number" class="form-control" name="tax"
                                        id="tax" value="{{ $billing->tax }}" min="0" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Payment Status <span class="text-danger">*</span></label>
                                    <select class="select form-control" name="payment_status" required>
                                        <option value="unpaid" {{ $billing->payment_status === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                                        <option value="partial" {{ $billing->payment_status === 'partial' ? 'selected' : '' }}>Partial</option>
                                        <option value="paid" {{ $billing->payment_status === 'paid' ? 'selected' : '' }}>Paid</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Payment Method</label>
                                    <select class="select form-control" name="payment_method">
                                        <option value="">-- Select --</option>
                                        <option value="cash" {{ $billing->payment_method === 'cash' ? 'selected' : '' }}>Cash</option>
                                        <option value="card" {{ $billing->payment_method === 'card' ? 'selected' : '' }}>Card</option>
                                        <option value="mpesa" {{ $billing->payment_method === 'mpesa' ? 'selected' : '' }}>Mpesa</option>
                                        <option value="bank_transfer" {{ $billing->payment_method === 'bank_transfer' ? 'selected' : '' }}>Bank Transfer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Due Date</label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker" name="due_date"
                                            value="{{ $billing->due_date }}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>Notes</label>
                                    <textarea class="form-control" name="notes" rows="2">{{ $billing->notes }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Live Total Summary -->
                        <div class="row mt-2">
                            <div class="col-md-4 ml-auto">
                                <div class="card" style="background: #f9f9f9;">
                                    <div class="card-body p-3">
                                        <table class="table table-sm mb-0">
                                            <tr>
                                                <td>Room Charges</td>
                                                <td class="text-right">KES {{ number_format($billing->room_charges, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td>Service Charges</td>
                                                <td class="text-right">KES {{ number_format($billing->service_charges, 2) }}</td>
                                            </tr>
                                            <tr>
                                                <td class="text-danger">Discount</td>
                                                <td class="text-right text-danger"><strong id="summary_discount">- KES {{ number_format($billing->discount, 2) }}</strong></td>
                                            </tr>
                                            <tr>
                                                <td>Tax</td>
                                                <td class="text-right"><strong id="summary_tax">KES {{ number_format($billing->tax, 2) }}</strong></td>
                                            </tr>
                                            <tr style="border-top: 2px solid #333;">
                                                <td><strong>Total</strong></td>
                                                <td class="text-right"><strong id="summary_total">KES {{ number_format($billing->total_amount, 2) }}</strong></td>
                                            </tr>
                                        </table>
                                        <input type="hidden" name="total_amount" id="total_amount" value="{{ $billing->total_amount }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-right mt-3">
                            <a href="{{ route('billing.show', $billing->id) }}" class="btn btn-secondary mr-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const roomCharges    = {{ $billing->room_charges }};
    const serviceCharges = {{ $billing->service_charges }};

    document.getElementById('discount').addEventListener('input', updateTotals);
    document.getElementById('tax').addEventListener('input', updateTotals);

    function updateTotals() {
        const discount = parseFloat(document.getElementById('discount').value) || 0;
        const tax      = parseFloat(document.getElementById('tax').value) || 0;
        const total    = (roomCharges + serviceCharges - discount) + tax;

        document.getElementById('summary_discount').innerText = '- KES ' + discount.toFixed(2);
        document.getElementById('summary_tax').innerText      = 'KES ' + tax.toFixed(2);
        document.getElementById('summary_total').innerText    = 'KES ' + total.toFixed(2);
        document.getElementById('total_amount').value         = total.toFixed(2);
    }
</script>

@endsection