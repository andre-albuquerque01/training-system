<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
    ];
}
