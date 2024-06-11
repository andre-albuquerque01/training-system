<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TrainingType extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'trainingType';

    protected $primaryKey = 'idTrainingType';

    protected $fillable = [
        'name',
        'description',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function training(): HasMany
    {
        return $this->hasMany(TrainingWorkOut::class, 'trainingType_id', 'idTrainingType');
    }
    
}
