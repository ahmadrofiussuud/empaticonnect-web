<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Beneficiary extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'guardian_id',
        'name',
        'disability_type',
        'emergency_contact',
        'notes',
    ];

    // Relationships
    public function guardian()
    {
        return $this->belongsTo(User::class, 'guardian_id');
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
