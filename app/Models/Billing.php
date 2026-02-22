<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $fillable = [
        'bill_number',
        'booking_id',
        'room_charges',
        'service_charges',
        'discount',
        'tax',
        'total_amount',
        'payment_status',
        'payment_method',
        'due_date',
        'notes'
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function items()
    {
        return $this->hasMany(BillingItem::class);
    }
}
