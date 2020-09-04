<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Day extends JsonResource
{
    public function toArray($request)
    {
        return [
            'checkIn' => $this->checkIn,
            'checkOut' => $this->checkOut,
            'date' => $this->date,
            'id' => $this->id,
            'user_id' => $this->user_id,
            'totalWorkedTime' => $this->getTimeWorkedInADay()
        ];
    }
}