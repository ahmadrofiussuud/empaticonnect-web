<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    protected $fillable = [
        'booking_id',
        'log_message',
        'log_time',
    ];

    protected $casts = [
        'log_time' => 'datetime',
    ];

    // Relationship
    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }
}
