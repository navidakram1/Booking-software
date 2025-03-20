<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone',
        'address',
        'date_of_birth',
        'gender',
        'avatar',
        'role',
        'email_verified_at',
        'last_login_at',
        'preferences',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'date_of_birth' => 'date',
        'preferences' => 'array',
        'password' => 'hashed',
    ];

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function preferences()
    {
        return $this->hasMany(CustomerPreference::class);
    }

    public function loyaltyPoints()
    {
        return $this->hasMany(LoyaltyPoint::class);
    }

    public function favorites()
    {
        return $this->belongsToMany(Service::class, 'user_favorites');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    /**
     * Check if the user is an admin.
     *
     * @return bool
     */
    public function isAdmin(): bool
    {
        return $this->role === 'admin';
    }

    public function scopeCustomers($query)
    {
        return $query->where('role', 'customer');
    }

    public function getAvatarUrlAttribute()
    {
        if ($this->avatar) {
            return asset('storage/avatars/' . $this->avatar);
        }
        return 'https://ui-avatars.com/api/?name=' . urlencode($this->name) . '&color=7F9CF5&background=EBF4FF';
    }

    public function getFullAddressAttribute()
    {
        return $this->address ?? 'No address provided';
    }

    public function isCustomer()
    {
        return $this->role === 'customer';
    }

    public function hasVerifiedEmail()
    {
        return !is_null($this->email_verified_at);
    }

    public function getBookingCount()
    {
        return $this->bookings()->count();
    }

    public function getCompletedBookingCount()
    {
        return $this->bookings()->where('status', 'completed')->count();
    }

    public function getLastBooking()
    {
        return $this->bookings()->latest()->first();
    }

    public function getFavoriteServices()
    {
        return $this->favorites;
    }

    public function toggleFavorite(Service $service)
    {
        return $this->favorites()->toggle($service);
    }
}
