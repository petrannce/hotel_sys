<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'billing_id',
        'description',
        'type',
        'amount',
        'quantity',
        'subtotal'
    ];

    public function billing()
    {
        return $this->belongsTo(Billing::class);
    }
}
