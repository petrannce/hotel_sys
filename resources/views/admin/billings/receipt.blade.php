@extends('layouts.backend.print')

@section('title', 'Receipt - ' . ($billing->booking->fname ?? 'Guest') . ' ' . ($billing->booking->lname ?? ''))

@section('content')
    <div class="container-fluid">

        @php
            $hotel = \App\Models\HotelDetail::first();
        @endphp

        <div id="receiptPrint" class="p-3" style="max-width: 80mm; margin: auto; font-family: 'Courier New', Courier, monospace;">

            {{-- Hotel Header --}}
            <div class="text-center">
                @if($hotel && $hotel->logo)
                    @php
                        $logoPath = storage_path('app/public/' . $hotel->logo);
                        $logoExists = file_exists($logoPath);
                    @endphp
                    @if($logoExists)
                        <img src="{{ asset($hotel->logo) }}" alt="Logo"
                            style="max-width:60px; max-height:60px; margin-bottom:5px; display:block; margin-left:auto; margin-right:auto;">
                    @endif
                @endif
                <h5 style="margin:5px 0; font-size:16px; font-weight:bold;">{{ $hotel->name ?? 'Hotel Name' }}</h5>
                <div style="font-size:11px; line-height:1.4;">
                    {{ $hotel->address ?? '' }}<br>
                    Tel: {{ $hotel->phone_number ?? '' }}<br>
                    {{ $hotel->email ?? '' }}
                </div>
                <hr style="border:none; border-top: 1px dashed #000; margin:8px 0;">
            </div>

            {{-- Receipt Title --}}
            <div class="text-center" style="margin:5px 0;">
                <strong style="font-size:14px;">RECEIPT</strong>
            </div>

            {{-- Guest & Booking Info --}}
            <div style="font-size:12px; margin-bottom:8px;">
                <strong>Guest:</strong> {{ $billing->booking->fname }} {{ $billing->booking->lname }}<br>
                <strong>Bill No:</strong> {{ $billing->bill_number }}<br>
                <strong>Room:</strong> {{ $billing->booking->room_number }}<br>
                <strong>Check In:</strong> {{ \Carbon\Carbon::parse($billing->booking->check_in)->format('d M Y') }}<br>
                <strong>Check Out:</strong> {{ \Carbon\Carbon::parse($billing->booking->check_out)->format('d M Y') }}<br>
                <strong>Date:</strong> {{ $billing->created_at->timezone('Africa/Nairobi')->format('d M Y, h:i A') }}
            </div>

            <hr style="border:none; border-top: 1px dashed #000; margin:5px 0;">

            {{-- Items List --}}
            <table style="width:100%; font-size:11px; border-collapse:collapse;">
                <thead>
                    <tr style="border-bottom: 1px solid #000;">
                        <th style="text-align:left; padding:3px 0; font-weight:bold;">Item</th>
                        <th style="text-align:center; padding:3px 5px; font-weight:bold;">Qty</th>
                        <th style="text-align:right; padding:3px 0; font-weight:bold;">Amount</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($billing->items as $item)
                        <tr style="border-bottom: 1px dashed #ddd;">
                            <td style="text-align:left; padding:5px 0;">{{ $item->description }}</td>
                            <td style="text-align:center; padding:5px 5px;">{{ $item->quantity }}</td>
                            <td style="text-align:right; padding:5px 0;">{{ number_format($item->subtotal, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <hr style="border:none; border-top: 1px solid #000; margin:8px 0;">

            {{-- Totals --}}
            <table style="width:100%; font-size:12px; margin-bottom:5px;">
                <tr>
                    <td style="text-align:left; padding:2px 0;">Room Charges:</td>
                    <td style="text-align:right; padding:2px 0;">KES {{ number_format($billing->room_charges, 2) }}</td>
                </tr>
                @if($billing->service_charges > 0)
                <tr>
                    <td style="text-align:left; padding:2px 0;">Service Charges:</td>
                    <td style="text-align:right; padding:2px 0;">KES {{ number_format($billing->service_charges, 2) }}</td>
                </tr>
                @endif
                @if($billing->discount > 0)
                <tr>
                    <td style="text-align:left; padding:2px 0;">Discount:</td>
                    <td style="text-align:right; padding:2px 0;">- KES {{ number_format($billing->discount, 2) }}</td>
                </tr>
                @endif
                @if($billing->tax > 0)
                <tr>
                    <td style="text-align:left; padding:2px 0;">Tax:</td>
                    <td style="text-align:right; padding:2px 0;">KES {{ number_format($billing->tax, 2) }}</td>
                </tr>
                @endif
            </table>

            <hr style="border:none; border-top: 1px solid #000; margin:5px 0;">

            <table style="width:100%; font-size:13px; margin-bottom:5px;">
                <tr>
                    <td style="text-align:left; padding:3px 0;"><strong>TOTAL:</strong></td>
                    <td style="text-align:right; padding:3px 0; font-weight:bold; font-size:14px;">
                        KES {{ number_format($billing->total_amount, 2) }}
                    </td>
                </tr>
                <tr>
                    <td style="text-align:left; padding:3px 0;">Status:</td>
                    <td style="text-align:right; padding:3px 0;">
                        <strong>{{ strtoupper($billing->payment_status) }}</strong>
                    </td>
                </tr>
                @if($billing->payment_method)
                <tr>
                    <td style="text-align:left; padding:3px 0;">Method:</td>
                    <td style="text-align:right; padding:3px 0;">
                        {{ ucfirst(str_replace('_', ' ', $billing->payment_method)) }}
                    </td>
                </tr>
                @endif
            </table>

            <hr style="border:none; border-top: 1px dashed #000; margin:8px 0;">

            {{-- Footer --}}
            <div class="text-center" style="font-size:11px; line-height:1.5;">
                <p style="margin:5px 0;">Thank you for staying with us!</p>
                <p style="margin:5px 0;">We hope to see you again.</p>
                @if($hotel && $hotel->website)
                    <p style="margin:5px 0;">{{ $hotel->website }}</p>
                @endif
                <p style="margin:8px 0; font-size:9px;">
                    Printed: {{ now()->timezone('Africa/Nairobi')->format('d/m/Y h:i A') }}
                </p>
            </div>
        </div>

        {{-- Print Button --}}
        <div class="text-center mt-4 no-print" id="printButton">
            <button onclick="window.print()" class="btn btn-primary btn-round">
                <i class="fa fa-print"></i> Print Receipt
            </button>
        </div>
    </div>

    {{-- Print Styles --}}
    <style>
        @page {
            size: 80mm auto;
            margin: 0;
        }

        body { margin: 0; padding: 0; }

        #receiptPrint { background: white; }

        @media print {
            body { background: #fff; margin: 0; padding: 0; }

            body * { visibility: hidden; }

            #receiptPrint, #receiptPrint * { visibility: visible; }

            #receiptPrint {
                position: absolute;
                left: 0;
                top: 0;
                width: 80mm;
                padding: 5mm;
                margin: 0;
            }

            .no-print, #printButton, button, .btn,
            nav, header, footer, .sidebar {
                display: none !important;
                visibility: hidden !important;
            }

            img { max-width: 60px !important; height: auto !important; display: block !important; }

            * {
                -webkit-print-color-adjust: exact !important;
                print-color-adjust: exact !important;
            }
        }

        @media screen {
            #receiptPrint {
                border: 1px solid #ddd;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
                margin-top: 20px;
                margin-bottom: 20px;
                background: white;
            }
        }
    </style>

    <script>
        document.addEventListener('keydown', function(e) {
            if (e.ctrlKey && e.key === 'p') {
                e.preventDefault();
                window.print();
            }
        });
    </script>
@endsection