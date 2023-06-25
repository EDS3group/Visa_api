<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserVisaResource extends JsonResource
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
            'center_apply'=>$this->center_apply,
            'date'=>$this->date,
            'country'=>$this->country,
            'travelers_number'=>$this->travelers_number,
            'relation'=>$this->relation,
            'coupon'=>$this->coupon,
            'total_price'=>$this->total_price,
            'visa_information'=>$this->visaInformation
        ];
    }
}
