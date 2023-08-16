<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\TemporaryFile
 *
 * @property int $id
 * @property string $folder
 * @property string $file_name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\TemporaryFileFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile query()
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile whereFileName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile whereFolder($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|TemporaryFile whereUpdatedAt($value)
 * @mixin \Eloquent
 */

class TemporaryFiles extends Model
{
    use HasFactory;

    protected $fillable = [
        'folder',
        'file_name'
    ];

}
