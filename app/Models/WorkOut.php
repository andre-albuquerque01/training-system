<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WorkOut extends Model
{
    use HasFactory;

    protected $table = 'workOuts';

    protected $primaryKey = 'idWorkOut';

    protected $fillable = [
        'name',
        'description',
        'image',
        'video',
        "muscle",
        "equipment",
        "difficulty",
        "duration",
        "calories",
        "weight",
        "repetition",
    ];

    public function muscle(): HasMany
    {
        return $this->hasMany(Muscle::class, 'idMuscle', 'idWorkOut');
    }
}
