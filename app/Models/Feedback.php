<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    use HasFactory;

    protected $fillable = [
        'feedback',
        'user_id',
        'trip_id',
    ];


    public function trip(): BelongsTo {
        return $this->belongsTo(Trip::class);
    }

    public function user(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function resort(): BelongsTo {
        return $this->belongsTo(Resort::class);
    }
}
