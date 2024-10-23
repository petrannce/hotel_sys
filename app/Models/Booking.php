<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'fname',
        'lname',
        'room_id',
        'room_number',
        'check_in',
        'check_out',
        'price',
        'status'
    ];

    // A booking belongs to a room
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
   
}