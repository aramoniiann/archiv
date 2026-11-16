<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DifficultyResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'learning_id' => $this->learning_id,
            'subject' => $this->subject,
            'description' => $this->description,
            'level' => $this->level,
            'status' => $this->status,
            'resolved_at' => $this->resolved_at,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'learning' => LearningResource::make($this->whenLoaded('learning')),
        ];
    }
}
