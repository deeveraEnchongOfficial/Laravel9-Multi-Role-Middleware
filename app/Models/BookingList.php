<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingList extends Model
{
    use HasFactory;

    protected $fillable = [
        'shop_id',
        'vehicle_lists_id',
        'client_name',
        'email',
        'address',
        'schedule_date',
        'total_amount',
        'status',
    ];
}