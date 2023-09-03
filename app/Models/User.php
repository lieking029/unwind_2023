<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserTypeEnum;
use App\Models\Transaction;
use Laravel\Passport\HasApiTokens;
use Nagy\LaravelRating\Traits\CanRate;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles, CanRate;

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
        return $this->belongsToMany(Resort::class, 'user_property'); // using the pivot table resort_user
    }

    public function properties   (): HasMany
    {
        return $this->hasMany(Property::class);
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

    public function transactions(): HasMany {
        return $this->hasMany(Transaction::class);
    }

    public function amenities() : HasMany
    {
        return $this->hasMany(Amenity::class);
    }

    public function addons() : HasMany
    {
        return $this->hasMany(Addon::class);
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
