<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bill #{{ $billing->bill_number }}</title>
    <style>
        @page {
            size: A4;
            margin: 20mm;
        }

        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 11pt;
            margin: 0;
            padding: 0;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }

        img.logo {
            width: 80px;
            height: 80px;
            object-fit: contain;
            display: block;
            margin: 0 auto 10px;
        }

        .header h2 {
            margin: 5px 0;
            font-size: 20pt;
            color: #000;
        }

        .header p {
            margin: 3px 0;
            font-size: 10pt;
            color: #666;
        }

        .guest-info {
            margin: 20px 0;
            padding: 15px;
            background-color: #f5f5f5;
            border-left: 4px solid #333;
        }

        .guest-info p {
            margin: 5px 0;
            line-height: 1.6;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            page-break-inside: auto;
        }

        tr {
            page-break-inside: avoid;
            page-break-after: auto;
        }

        thead {
            display: table-header-group;
        }

        tbody {
            display: table-row-group;
        }

        table thead {
            background-color: #333;
            color: white;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            font-weight: bold;
            font-size: 10pt;
        }

        td {
            font-size: 10pt;
        }

        .text-right  { text-align: right; }
        .text-center { text-align: center; }

        table tfoot {
            background-color: #f9f9f9;
            font-weight: bold;
        }

        table tfoot th {
            background-color: transparent;
            color: #333;
            border-top: 2px solid #333;
        }

        .totals-section {
            margin: 20px 0;
            padding: 10px 15px;
            background-color: #f5f5f5;
        }

        .totals-section table {
            margin: 0;
        }

        .totals-section td {
            border: none;
            padding: 4px 8px;
        }

        .status-section {
            margin: 20px 0;
            padding: 10px;
            background-color: #f0f8ff;
            border-radius: 5px;
        }

        .footer {
            text-align: center;
            margin-top: 40px;
            padding-top: 20px;
            border-top: 1px solid #ddd;
            color: #666;
            font-size: 9pt;
        }

        .bill-title {
            font-size: 16pt;
            font-weight: bold;
            margin: 10px 0;
            color: #333;
            text-align: center;
        }
    </style>
</head>
<body>

@php
    use App\Models\HotelDetail;
    $hotel = HotelDetail::first();
@endphp

<div class="container">

    {{-- Hotel Header --}}
    <div class="header">
        @if($hotel && $hotel->logo)
            @php
                $logoPath = storage_path('app/public/' . $hotel->logo);
                $logoData = file_exists($logoPath)
                    ? 'data:image/' . pathinfo($logoPath, PATHINFO_EXTENSION) . ';base64,' . base64_encode(file_get_contents($logoPath))
                    : null;
            @endphp
            @if($logoData)
                <img src="{{ $logoData }}" class="logo" alt="Hotel Logo">
            @endif
        @endif
        <h2>{{ $hotel->name ?? 'Hotel Name' }}</h2>
        <p>
            {{ $hotel->address ?? '' }}<br>
            Tel: {{ $hotel->phone_number ?? 'N/A' }} | Email: {{ $hotel->email ?? 'N/A' }}<br>
            {{ $hotel->website ?? '' }}
        </p>
    </div>

    <div class="bill-title">BILLING INVOICE</div>

    {{-- Guest & Booking Information --}}
    <div class="guest-info">
        <p><strong>Guest Name:</strong> {{ $billing->booking->fname }} {{ $billing->booking->lname }}</p>
        <p><strong>Bill Number:</strong> {{ $billing->bill_number }}</p>
        <p><strong>Room Number:</strong> {{ $billing->booking->room_number }}</p>
        <p><strong>Check In:</strong> {{ \Carbon\Carbon::parse($billing->booking->check_in)->format('d M Y') }}</p>
        <p><strong>Check Out:</strong> {{ \Carbon\Carbon::parse($billing->booking->check_out)->format('d M Y') }}</p>
        <p><strong>Date Issued:</strong> {{ $billing->created_at->format('d M Y, h:i A') }}</p>
    </div>

    {{-- Billing Items Table --}}
    <table>
        <thead>
            <tr>
                <th style="width: 5%;">#</th>
                <th style="width: 40%;">Description</th>
                <th style="width: 10%;">Type</th>
                <th class="text-center" style="width: 10%;">Qty</th>
                <th class="text-right" style="width: 17%;">Unit Price (KES)</th>
                <th class="text-right" style="width: 18%;">Subtotal (KES)</th>
            </tr>
        </thead>
        <tbody>
            @foreach($billing->items as $index => $item)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $item->description }}</td>
                    <td>{{ ucfirst($item->type) }}</td>
                    <td class="text-center">{{ $item->quantity }}</td>
                    <td class="text-right">{{ number_format($item->amount, 2) }}</td>
                    <td class="text-right">{{ number_format($item->subtotal, 2) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Totals Breakdown --}}
    <div class="totals-section">
        <table style="width: 50%; margin-left: auto;">
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
                <td>Discount</td>
                <td class="text-right">- KES {{ number_format($billing->discount, 2) }}</td>
            </tr>
            @endif
            @if($billing->tax > 0)
            <tr>
                <td>Tax</td>
                <td class="text-right">KES {{ number_format($billing->tax, 2) }}</td>
            </tr>
            @endif
            <tr style="border-top: 2px solid #333; font-weight: bold; font-size: 12pt;">
                <td><strong>TOTAL AMOUNT</strong></td>
                <td class="text-right"><strong>KES {{ number_format($billing->total_amount, 2) }}</strong></td>
            </tr>
        </table>
    </div>

    {{-- Payment Status --}}
    <div class="status-section">
        <p><strong>Payment Status:</strong> <span style="text-transform: uppercase;">{{ $billing->payment_status }}</span></p>
        @if($billing->payment_method)
        <p><strong>Payment Method:</strong> {{ ucfirst(str_replace('_', ' ', $billing->payment_method)) }}</p>
        @endif
        @if($billing->due_date)
        <p><strong>Due Date:</strong> {{ \Carbon\Carbon::parse($billing->due_date)->format('d M Y') }}</p>
        @endif
        @if($billing->notes)
        <p><strong>Notes:</strong> {{ $billing->notes }}</p>
        @endif
    </div>

    {{-- Footer --}}
    <div class="footer">
        <p>Thank you for choosing {{ $hotel->name ?? 'our hotel' }}.</p>
        <p>For any inquiries, please contact us at {{ $hotel->phone_number ?? 'our office' }}.</p>
        <p style="margin-top: 15px; font-size: 8pt;">This is a computer-generated document. No signature required.</p>
    </div>

</div>
</body>
</html>