@extends('layouts.admin.header')
@section('content')

<div class="content container-fluid">

    <!-- Page Header -->
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h3 class="page-title">Create Bill</h3>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('billing.index') }}">Billing</a></li>
                    <li class="breadcrumb-item active">Create Bill</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- /Page Header -->

    <div class="row">
        <div class="col-md-12">
            <div class="card mb-0">
                <div class="card-header">
                    <h4 class="card-title mb-0">New Bill</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('billing.store') }}" method="POST" id="billing-form">
                        @csrf

                        <!-- Step 1: Select Booking -->
                        <div class="row">
                            <div class="col-md-12">
                                <h5 class="mb-3" style="border-bottom: 1px solid #eee; padding-bottom: 8px;">
                                    1. Select Booking
                                </h5>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Booking <span class="text-danger">*</span></label>
                                    <select class="select form-control" name="booking_id" id="booking_select" required>
                                        <option value="">-- Select Booking --</option>
                                        @foreach ($bookings as $booking)
                                            <option value="{{ $booking->id }}"
                                                data-fname="{{ $booking->fname }}"
                                                data-lname="{{ $booking->lname }}"
                                                data-room="{{ $booking->room_number }}"
                                                data-checkin="{{ $booking->check_in }}"
                                                data-checkout="{{ $booking->check_out }}"
                                                data-price="{{ $booking->price }}">
                                                #{{ $booking->id }} — {{ $booking->fname }} {{ $booking->lname }}
                                                (Room {{ $booking->room_number }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>

                        <!-- Step 2: Booking Summary (auto-filled) -->
                        <div class="row" id="booking-summary" style="display:none;">
                            <div class="col-md-12">
                                <h5 class="mb-3 mt-3" style="border-bottom: 1px solid #eee; padding-bottom: 8px;">
                                    2. Booking Summary
                                </h5>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Guest Name</label>
                                    <input type="text" class="form-control" id="guest_name" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Room No.</label>
                                    <input type="text" class="form-control" id="room_number" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Check In</label>
                                    <input type="text" class="form-control" id="check_in" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Check Out</label>
                                    <input type="text" class="form-control" id="check_out" readonly>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <div class="form-group">
                                    <label>Nights</label>
                                    <input type="text" class="form-control" id="nights" readonly>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Room Charges (KES)</label>
                                    <input type="text" class="form-control" id="room_charges_display" readonly>
                                    <input type="hidden" name="room_charges" id="room_charges">
                                </div>
                            </div>
                        </div>

                        <!-- Step 3: Service Requests -->
                        <div class="row" id="services-section" style="display:none;">
                            <div class="col-md-12">
                                <h5 class="mb-3 mt-3" style="border-bottom: 1px solid #eee; padding-bottom: 8px;">
                                    3. Service Charges
                                </h5>
                                <p class="text-muted" style="font-size: 13px;">Select any service requests to include in this bill.</p>
                            </div>
                            <div class="col-md-12" id="service-requests-container">
                                <!-- Populated via JS -->
                            </div>
                            <div class="col-md-4 ml-auto text-right">
                                <p>Service Charges: <strong id="service_charges_display">KES 0.00</strong></p>
                                <input type="hidden" name="service_charges" id="service_charges" value="0">
                            </div>
                        </div>

                        <!-- Step 4: Adjustments & Payment -->
                        <div class="row" id="payment-section" style="display:none;">
                            <div class="col-md-12">
                                <h5 class="mb-3 mt-3" style="border-bottom: 1px solid #eee; padding-bottom: 8px;">
                                    4. Adjustments & Payment
                                </h5>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Discount (KES)</label>
                                    <input type="number" class="form-control" name="discount" id="discount" value="0" min="0" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Tax (KES)</label>
                                    <input type="number" class="form-control" name="tax" id="tax" value="0" min="0" step="0.01">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Payment Status <span class="text-danger">*</span></label>
                                    <select class="select form-control" name="payment_status" required>
                                        <option value="unpaid">Unpaid</option>
                                        <option value="partial">Partial</option>
                                        <option value="paid">Paid</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Payment Method</label>
                                    <select class="select form-control" name="payment_method">
                                        <option value="">-- Select --</option>
                                        <option value="cash">Cash</option>
                                        <option value="card">Card</option>
                                        <option value="mpesa">Mpesa</option>
                                        <option value="bank_transfer">Bank Transfer</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Due Date</label>
                                    <div class="cal-icon">
                                        <input type="text" class="form-control datetimepicker" name="due_date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>Notes</label>
                                    <textarea class="form-control" name="notes" rows="2" placeholder="Any additional notes..."></textarea>
                                </div>
                            </div>

                            <!-- Total Summary -->
                            <div class="col-md-12 mt-3">
                                <div class="card" style="background: #f9f9f9;">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-8"></div>
                                            <div class="col-md-4">
                                                <table class="table table-sm mb-0">
                                                    <tr>
                                                        <td>Room Charges</td>
                                                        <td class="text-right"><strong id="summary_room">KES 0.00</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Service Charges</td>
                                                        <td class="text-right"><strong id="summary_service">KES 0.00</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Discount</td>
                                                        <td class="text-right text-danger"><strong id="summary_discount">- KES 0.00</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td>Tax</td>
                                                        <td class="text-right"><strong id="summary_tax">KES 0.00</strong></td>
                                                    </tr>
                                                    <tr style="border-top: 2px solid #333;">
                                                        <td><strong>Total</strong></td>
                                                        <td class="text-right"><strong id="summary_total">KES 0.00</strong></td>
                                                    </tr>
                                                </table>
                                                <input type="hidden" name="total_amount" id="total_amount">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="text-right mt-4" id="submit-section" style="display:none;">
                            <a href="{{ route('billing.index') }}" class="btn btn-secondary mr-2">Cancel</a>
                            <button type="submit" class="btn btn-primary">Generate Bill</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // All service requests from controller
    const allServiceRequests = @json($serviceRequests);

    document.getElementById('booking_select').addEventListener('change', function () {
        const selected = this.options[this.selectedIndex];
        if (!selected.value) return;

        const fname    = selected.dataset.fname;
        const lname    = selected.dataset.lname;
        const room     = selected.dataset.room;
        const checkIn  = new Date(selected.dataset.checkin);
        const checkOut = new Date(selected.dataset.checkout);
        const price    = parseFloat(selected.dataset.price);
        const nights   = Math.max(Math.ceil((checkOut - checkIn) / (1000 * 60 * 60 * 24)), 1);
        const roomCharges = nights * price;

        document.getElementById('guest_name').value          = fname + ' ' + lname;
        document.getElementById('room_number').value         = room;
        document.getElementById('check_in').value            = selected.dataset.checkin;
        document.getElementById('check_out').value           = selected.dataset.checkout;
        document.getElementById('nights').value              = nights;
        document.getElementById('room_charges_display').value = 'KES ' + roomCharges.toFixed(2);
        document.getElementById('room_charges').value        = roomCharges;

        // Filter service requests by room
        const filtered = allServiceRequests.filter(sr => sr.room == room);
        const container = document.getElementById('service-requests-container');
        container.innerHTML = '';

        if (filtered.length > 0) {
            filtered.forEach(sr => {
                container.innerHTML += `
                    <div class="form-check mb-2 ml-2">
                        <input class="form-check-input service-check" type="checkbox"
                            name="service_request_ids[]" value="${sr.id}"
                            data-price="${sr.price}" id="sr_${sr.id}"
                            onchange="updateTotals()">
                        <label class="form-check-label" for="sr_${sr.id}">
                            <strong>${sr.service}</strong> — ${sr.description}
                            <span class="badge badge-secondary ml-2">KES ${parseFloat(sr.price).toFixed(2)}</span>
                            <span class="badge badge-info ml-1">${sr.status}</span>
                        </label>
                    </div>`;
            });
        } else {
            container.innerHTML = '<p class="text-muted ml-2">No service requests found for this room.</p>';
        }

        document.getElementById('booking-summary').style.display  = 'flex';
        document.getElementById('services-section').style.display  = 'block';
        document.getElementById('payment-section').style.display   = 'block';
        document.getElementById('submit-section').style.display    = 'block';

        updateTotals();
    });

    document.getElementById('discount').addEventListener('input', updateTotals);
    document.getElementById('tax').addEventListener('input', updateTotals);

    function updateTotals() {
        const roomCharges = parseFloat(document.getElementById('room_charges').value) || 0;
        let serviceCharges = 0;

        document.querySelectorAll('.service-check:checked').forEach(cb => {
            serviceCharges += parseFloat(cb.dataset.price) || 0;
        });

        const discount = parseFloat(document.getElementById('discount').value) || 0;
        const tax      = parseFloat(document.getElementById('tax').value) || 0;
        const total    = (roomCharges + serviceCharges - discount) + tax;

        document.getElementById('service_charges').value         = serviceCharges;
        document.getElementById('service_charges_display').innerText = 'KES ' + serviceCharges.toFixed(2);
        document.getElementById('summary_room').innerText        = 'KES ' + roomCharges.toFixed(2);
        document.getElementById('summary_service').innerText     = 'KES ' + serviceCharges.toFixed(2);
        document.getElementById('summary_discount').innerText    = '- KES ' + discount.toFixed(2);
        document.getElementById('summary_tax').innerText         = 'KES ' + tax.toFixed(2);
        document.getElementById('summary_total').innerText       = 'KES ' + total.toFixed(2);
        document.getElementById('total_amount').value            = total.toFixed(2);
    }
</script>

@endsection