<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Justification extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'approved' => $this->approved,
            'user' => $this->user,
        ];
    }
}