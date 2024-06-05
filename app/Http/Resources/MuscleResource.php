<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MuscleResource extends JsonResource
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
            'id' => $this->idMuscle,
            'name' => $this->name,
            'updated_at' => $this->updated_at,
            'userId' => $this->user_id,
            'workout' => WorkResource::collection($this->whenLoaded('workOut')),
        ];
    }
}
