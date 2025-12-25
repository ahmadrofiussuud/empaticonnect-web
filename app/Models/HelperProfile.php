<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class HelperProfile extends Model
{
    protected $table = 'helpers_profile';

    protected $fillable = [
        'user_id',
        'tier',
        'skills',
        'is_verified',
        'hourly_rate',
        'availability_status',
        'rating',
    ];

    protected $casts = [
        'skills' => 'array',
        'is_verified' => 'boolean',
        'hourly_rate' => 'decimal:2',
        'rating' => 'decimal:2',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scopes for filtering
    public function scopeVerified(Builder $query): Builder
    {
        return $query->where('is_verified', true);
    }

    public function scopeAvailable(Builder $query): Builder
    {
        return $query->where('availability_status', 'available');
    }

    public function scopeByTier(Builder $query): Builder
    {
        return $query->orderByRaw("CASE WHEN tier = 'pro_care' THEN 1 ELSE 2 END");
    }

    public function scopeByRating(Builder $query): Builder
    {
        return $query->orderByDesc('rating');
    }
}
