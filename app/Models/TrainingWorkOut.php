<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TrainingWorkOut extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'trainingWorkOut';

    protected $primaryKey = 'idTrainingWorkOut';

    protected $fillable = [
        'trainingType_id',
        'workOut_id',
    ];

    public function workOut(): BelongsTo
    {
        return $this->belongsTo(WorkOut::class, 'workOut_id', 'idWorkOut');
    }    

    public function trainingType(): BelongsTo
    {
        return $this->belongsTo(TrainingType::class, 'trainingType_id');
    }
}
