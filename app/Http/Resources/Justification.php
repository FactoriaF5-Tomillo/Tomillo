<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Justification extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'file' => $this->file,
            'description' => $this->description,
            'approved' => $this->approved,
            'user' => $this->user,
            'start_date' => $this->start_date,
            'end_date' => $this->end_date,
        ];
    }
}