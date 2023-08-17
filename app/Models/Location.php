<?php

namespace App\Models;

use App\Models\Resort;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'resort_id',
        'street_number',
        'postal_code',
        'barangay_district',
        'street_name',
        'description',
    ];


    public function resort() : BelongsTo
    {
        return $this->belongsTo(Resort::class);
    }
}
