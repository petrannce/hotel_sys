<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotelDetail extends Model
{
    use HasFactory;

    protected $table = 'hotel_details';

    protected $fillable = [
        'name',
        'address',
        'phone_number',
        'email',
        'website',
        'logo',
        'image',
    ];
}
