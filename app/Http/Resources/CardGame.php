<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class CardGame extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        // return parent::toArray($request);
        return [
            'name'=> $this->name,
            'userScore'=> $this->userScore,
            'compScore'=> $this->compScore,
            'userWon'=> $this->userWon,
            'created_at' => $this->created_at
        ];
    }
}
