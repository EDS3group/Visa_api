<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TeamResource extends JsonResource
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
            'image'=>$this->image,
            'name_ar'=>$this->name_ar,
            'name_en'=>$this->name_en,
            'type'=>$this->type,
            'coach'=>$this->coach,
            'description_ar'=>$this->description_ar,
            'description_en'=>$this->description_en,
        ];
    }
}
