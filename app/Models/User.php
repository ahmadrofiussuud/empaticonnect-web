<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone_number',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relationships
    public function helperProfile()
    {
        return $this->hasOne(HelperProfile::class);
    }

    public function beneficiaries()
    {
        return $this->hasMany(Beneficiary::class, 'guardian_id');
    }

    public function guardianBookings()
    {
        return $this->hasMany(Booking::class, 'guardian_id');
    }

    public function helperBookings()
    {
        return $this->hasMany(Booking::class, 'helper_id');
    }

    // Helper methods
    public function isGuardian(): bool
    {
        return $this->role === 'guardian';
    }

    public function isHelper(): bool
    {
        return $this->role === 'helper';
    }

    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }
}
