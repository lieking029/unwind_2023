<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class PropertyType extends Model
{

    protected $fillable = [
        'name'
    ];

    use HasFactory;

    public function resort() : HasOne
    {
        return $this->hasOne(Resort::class);
    }

}
