<?php

namespace App\Models;

use App\Models\User;
use App\Models\Resort;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'merchant_id',
        'amount_due',
        'payment_method',
        'reference_number',
        'property_id',
    ];

    protected $casts = [
        'amount_due' => 'float',
    ];


    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function merchant(): BelongsTo {
        return $this->belongsTo(User::class, 'merchant_id');
    }

    public function property(): BelongsTo {
        return $this->belongsTo(Property::class);
    }
}
