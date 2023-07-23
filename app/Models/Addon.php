<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Addon extends Model
{

    protected $fillable = [
        'name',
        'resort_id'
    ];

    use HasFactory;

    public function resort() : BelongsTo
    {
        return $this->belongsTo(Resort::class);
    }

}
