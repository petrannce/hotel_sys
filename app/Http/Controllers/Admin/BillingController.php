<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Billing;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\BillingItem;
use App\Models\ServiceRequest;
use DB;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class BillingController extends Controller
{
    public function index()
    {
        $billings = Billing::with('booking')->latest()->paginate(10);
        return view('admin.billing.index', compact('billings'));
    }

    public function create()
    {
        $bookings = Booking::whereDoesntHave('billing')
            ->whereIn('status', ['booked', 'closed'])
            ->get();

        return view('admin.billing.create', compact('bookings'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $booking = Booking::findOrFail($request->booking_id);

            // Calculate nights
            $checkIn = Carbon::parse($booking->check_in);
            $checkOut = Carbon::parse($booking->check_out);
            $nights = max($checkIn->diffInDays($checkOut), 1);

            $roomCharges = $nights * $booking->price;
            $serviceCharges = $request->service_charges ?? 0;
            $discount = $request->discount ?? 0;
            $tax = $request->tax ?? 0;
            $total = ($roomCharges + $serviceCharges - $discount) + $tax;

            // Create billing
            $billing = Billing::create([
                'bill_number' => 'BILL-' . strtoupper(uniqid()),
                'booking_id' => $booking->id,
                'room_charges' => $roomCharges,
                'service_charges' => $serviceCharges,
                'discount' => $discount,
                'tax' => $tax,
                'total_amount' => $total,
                'payment_status' => $request->payment_status,
                'payment_method' => $request->payment_method,
                'due_date' => $request->due_date,
                'notes' => $request->notes,
            ]);

            // Create room charge item
            BillingItem::create([
                'billing_id' => $billing->id,
                'description' => 'Room ' . $booking->room_number . ' (' . $nights . ' night(s))',
                'type' => 'room',
                'amount' => $booking->price,
                'quantity' => $nights,
                'subtotal' => $roomCharges,
            ]);

            // Create service charge items
            if ($request->has('service_request_ids')) {
                $serviceRequests = ServiceRequest::whereIn('id', $request->service_request_ids)->get();
                foreach ($serviceRequests as $sr) {
                    BillingItem::create([
                        'billing_id' => $billing->id,
                        'description' => $sr->service,
                        'type' => 'service',
                        'amount' => $sr->price,
                        'quantity' => 1,
                        'subtotal' => $sr->price,
                    ]);
                }
            }

            DB::commit();
            return redirect()->route('billing.index')
                ->with('success', 'Bill ' . $billing->bill_number . ' created successfully.');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create bill. ' . $e->getMessage());
        }
    }
    public function show($id)
    {
        $billing = Billing::with('booking', 'items')->findOrFail($id);
        return view('admin.billing.show', compact('billing'));
    }

    public function destroy($id)
    {
        $billing = Billing::findOrFail($id);
        $billing->delete();
        return redirect()->route('billing.index')
            ->with('success', 'Bill ' . $billing->bill_number . ' deleted successfully.');
    }

    public function receipt($id)
    {
        $billing = Billing::with(['booking', 'items'])->findOrFail($id);
        return view('admin.billings.receipt', compact('billing'));
    }

    public function downloadPDF($id)
    {
        $billing = Billing::with(['booking', 'items'])->findOrFail($id);

        // Generate PDF from the receipt view
        $pdf = Pdf::loadView('backend.billings.receipt_pdf', compact('billing'))
            ->setPaper('a4', 'portrait');

        // Download as PDF
        $filename = 'Bill_' . str_pad($billing->id, 5, '0', STR_PAD_LEFT) . '.pdf';
        return $pdf->download($filename);
    }
}
