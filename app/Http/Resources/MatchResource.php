<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MatchResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this->id,
            'champion_name'=>$this->champion_name,
            'first_team'=>$this->firstTeam,
            'second_team'=>$this->secondTeam,
            'stadum_name'=>$this->stadum_name,
            'date'=>$this->date,
            'time'=>$this->time,
            'number_of_tickets'=>$this->number_of_tickets,
            'ticket_price'=>$this->ticket_price,
        ];
    }
}
