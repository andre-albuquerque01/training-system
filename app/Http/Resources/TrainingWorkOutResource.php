<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainingWorkOutResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'idTrainingWorkOut' => $this->idTrainingWorkOut,
            'workOut' => new WorkResource($this->whenLoaded('workOut')),
        ];
    }
}
