<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Affiliate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'website',
        'commission_rate',
        'payment_info',
        'status',
        'referral_code'
    ];

    protected $casts = [
        'commission_rate' => 'float'
    ];

    public function referrals()
    {
        return $this->hasMany(AffiliateReferral::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($affiliate) {
            $affiliate->referral_code = self::generateReferralCode();
            $affiliate->status = $affiliate->status ?? 'active';
        });
    }

    protected static function generateReferralCode()
    {
        do {
            $code = strtoupper(substr(md5(uniqid()), 0, 8));
        } while (static::where('referral_code', $code)->exists());

        return $code;
    }
}
