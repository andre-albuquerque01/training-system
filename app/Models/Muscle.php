<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Muscle extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'muscle';

    protected $primaryKey = 'idMuscle';

    protected $fillable = [
        'name',
        'user_id',
        'workOut_id',
    ];
    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function workOut(): BelongsTo
    {
        return $this->belongsTo(WorkOut::class, 'workOut_id');
    }
}
