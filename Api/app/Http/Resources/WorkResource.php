<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkResource extends JsonResource
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
            'idWorkOut' => $this->idWorkOut,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
            'video' => $this->video,
            'muscle' => $this->muscle,
            'equipment' => $this->equipment,
            'difficulty' => $this->difficulty,
            'duration' => $this->duration,
            'calories' => $this->calories,
            'weight' => $this->weight,
            'repetition' => $this->repetition,
        ];
    }
}
