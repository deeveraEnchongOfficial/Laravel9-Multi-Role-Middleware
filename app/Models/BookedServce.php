<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BookingList;

class BookedServce extends Model
{
    use HasFactory;

    protected $fillable = [
        'booking_lists_id',
        'services_id',
        'vehicle_lists_id',
        'user_id',
        'service_name',
        'service_amount',
        'status',
    ];

    public function booking_list()
    {
        return $this->belongsTo(BookingList::class);
    }
}
