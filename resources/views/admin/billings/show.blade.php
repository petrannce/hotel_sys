@extends('layouts.admin.header')
@section('content')

<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Invoice</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('billing.index') }}">Billing</a></li>
                    <li class="breadcrumb-item active">{{ $billing->bill_number }}</li>
                </ul>
            </div>
            <div class="col-auto float-right ml-auto">
                <a href="{{ route('billing.edit', $billing->id) }}" class="btn btn-primary mr-2">
                    <i class="fa fa-pencil"></i> Edit
                </a>
                <button onclick="window.print()" class="btn btn-secondary">
                    <i class="fa fa-print"></i> Print
                </button>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-md-12">
            <div class="card" id="invoice-card">
                <div class="card-body">

                    <!-- Invoice Header -->
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            @php $hotel = \App\Models\HotelDetail::first(); @endphp
                            @if($hotel)
                                @if($hotel->logo)
                                    <img src="{{ asset($hotel->logo) }}" alt="Logo"
                                        style="height: 60px; width: auto; object-fit: contain; margin-bottom: 10px;">
                                @endif
                                <h4 class="mb-1">{{ $hotel->name }}</h4>
                                <p class="text-muted mb-0" style="font-size: 13px;">{{ $hotel->address }}</p>
                                <p class="text-muted mb-0" style="font-size: 13px;">{{ $hotel->phone_number }} | {{ $hotel->email }}</p>
                                <p class="text-muted mb-0" style="font-size: 13px;">{{ $hotel->website }}</p>
                            @endif
                        </div>
                        <div class="col-sm-6 text-right">
                            <h3 class="mb-1">INVOICE</h3>
                            <p class="mb-1"><strong>Bill No:</strong> {{ $billing->bill_number }}</p>
                            <p class="mb-1"><strong>Date:</strong> {{ $billing->created_at->format('d M Y') }}</p>
                            @if($billing->due_date)
                                <p class="mb-1"><strong>Due Date:</strong> {{ \Carbon\Carbon::parse($billing->due_date)->format('d M Y') }}</p>
                            @endif
                            <span class="badge badge-{{
                                $billing->payment_status === 'paid' ? 'success' :
                                ($billing->payment_status === 'partial' ? 'warning' : 'danger')
                            }}" style="font-size: 14px; padding: 6px 12px;">
                                {{ strtoupper($billing->payment_status) }}
                            </span>
                        </div>
                    </div>

                    <hr>

                    <!-- Guest & Booking Info -->
                    <div class="row mb-4">
                        <div class="col-sm-6">
                            <h6 class="text-muted text-uppercase mb-2" style="font-size: 11px; letter-spacing: 1px;">Billed To</h6>
                            <p class="mb-0"><strong>{{ $billing->booking->fname }} {{ $billing->booking->lname }}</strong></p>
                        </div>
                        <div class="col-sm-6 text-right">
                            <h6 class="text-muted text-uppercase mb-2" style="font-size: 11px; letter-spacing: 1px;">Booking Details</h6>
                            <p class="mb-0"><strong>Room:</strong> {{ $billing->booking->room_number }}</p>
                            <p class="mb-0"><strong>Check In:</strong> {{ \Carbon\Carbon::parse($billing->booking->check_in)->format('d M Y') }}</p>
                            <p class="mb-0"><strong>Check Out:</strong> {{ \Carbon\Carbon::parse($billing->booking->check_out)->format('d M Y') }}</p>
                        </div>
                    </div>

                    <!-- Bill Items Table -->
                    <div class="table-responsive mb-4">
                        <table class="table table-bordered">
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

                    <!-- Totals -->
                    <div class="row">
                        <div class="col-md-6">
                            @if($billing->notes)
                            <div>
                                <h6 class="text-muted text-uppercase mb-1" style="font-size: 11px; letter-spacing: 1px;">Notes</h6>
                                <p style="font-size: 13px;">{{ $billing->notes }}</p>
                            </div>
                            @endif
                            @if($billing->payment_method)
                            <p style="font-size: 13px;"><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $billing->payment_method)) }}</p>
                            @endif
                        </div>
                        <div class="col-md-4 ml-auto">
                            <table class="table table-sm">
                                <tr>
                                    <td>Room Charges</td>
                                    <td class="text-right">KES {{ number_format($billing->room_charges, 2) }}</td>
                                </tr>
                                <tr>
                                    <td>Service Charges</td>
                                    <td class="text-right">KES {{ number_format($billing->service_charges, 2) }}</td>
                                </tr>
                                @if($billing->discount > 0)
                                <tr>
                                    <td class="text-danger">Discount</td>
                                    <td class="text-right text-danger">- KES {{ number_format($billing->discount, 2) }}</td>
                                </tr>
                                @endif
                                @if($billing->tax > 0)
                                <tr>
                                    <td>Tax</td>
                                    <td class="text-right">KES {{ number_format($billing->tax, 2) }}</td>
                                </tr>
                                @endif
                                <tr style="border-top: 2px solid #333; font-size: 15px;">
                                    <td><strong>Total</strong></td>
                                    <td class="text-right"><strong>KES {{ number_format($billing->total_amount, 2) }}</strong></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        .page-header, .btn, .breadcrumb { display: none !important; }
        #invoice-card { border: none !important; box-shadow: none !important; }
    }
</style>

@endsection