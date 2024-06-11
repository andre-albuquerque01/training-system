<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainingTypeResource extends JsonResource
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
            'id' => $this->idTrainingType,
            'name' => $this->name,
            'description' => $this->description,
            'updated_at' => $this->updated_at,
            'userId' => $this->user_id,
            'training' => TrainingWorkOutResource::collection($this->whenLoaded('training')),
        ];
    }
}
