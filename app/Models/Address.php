<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Address extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'home_address',
        'barangay',
        'city',
        'region',
        'country',
        'user_id'
    ];


    public function property() : BelongsTo
    {
        return $this->belongsTo(Property::class);
    }
}
