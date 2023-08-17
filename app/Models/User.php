<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserTypeEnum;
use Laravel\Passport\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'fullname',
        'phone_number',
        'dob',
        'my_referral_code',
        'referral_code_used',
        'is_verified',
        'avatar',
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

    public function associatedResorts(): BelongsToMany
    {
        return $this->belongsToMany(Resort::class, 'user_resort'); // using the pivot table resort_user
    }

    public function resorts(): HasMany
    {
        return $this->hasMany(Resort::class);
    }

    public function oneTimePasswords(): HasMany {
        return $this->hasMany(OneTimePassword::class);
    }

    public function address(): HasOne {
        return $this->hasOnne(Address::class);
    }

    public function wishlists(): HasMany {
        return $this->hasMany(Wishlist::class);
    }

    public function isAdmin()
    {
        return $this->hasRole(UserTypeEnum::Admin);
    }

    public function isMerchant()
    {
        return $this->hasRole(UserTypeEnum::Merchant);
    }

    public function isClient()
    {
        return $this->hasRole(UserTypeEnum::Client);
    }
    public function isSubHost()
    {
        return $this->hasRole(UserTypeEnum::SubHost);
    }

}
