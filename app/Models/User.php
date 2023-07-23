<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserTypeEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'fullname',
        'phone_number',
        'dob',
        'my_referral_code',
        'referral_code_used',
        'email',
        'merchant_id',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'otp'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];


    public function isAdmin() {
        return $this->hasRole(UserTypeEnum::Admin);
    }

    public function isMerchant() {
        return $this->hasRole(UserTypeEnum::Merchant);
    }

    public function isClient() {
        return $this->hasRole(UserTypeEnum::Client);
    }
    public function isSubHost() {
        return $this->hasRole(UserTypeEnum::SubHost);
    }

    public function resorts() : BelongsToMany
    {
        return $this->belongsToMany(Resort::class);
    }

}
