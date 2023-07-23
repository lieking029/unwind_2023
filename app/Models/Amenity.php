<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Amenity extends Model
{

    protected $fillable = [
        'resort_id',
        'name'
    ];

    use HasFactory;

    public function resort() : BelongsTo
    {
        return $this->belongsTo(Resort::class);
    }

}
