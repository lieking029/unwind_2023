<?php

namespace App\Models;

use App\Models\Resort;
use App\Models\Feedback;
use App\Enums\TripStatusEnum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trip extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'resort_id',
        'user_id',
        'start_date',
        'end_date',
        'status',
        'price',
        'reference_number',
        'participants_count',
        'is_rated',
    ];

    protected $casts = [
        'status' => TripStatusEnum::class,
        'is_rated' => 'boolean',
    ];


    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function feedback(): HasOne {
        return $this->hasOne(Feedback::class);
    }
}
