<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PassportResource extends JsonResource
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
            'applicant_name'=>$this->applicant_name,
            'email'=>$this->email,
            'phone'=>$this->phone,
            'country'=>$this->country,
            'passport_quantity'=>$this->passport_quantity,
            'status'=>$this->status,
            'user'=>$this->user
        ];
    }
}
