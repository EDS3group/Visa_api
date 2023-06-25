<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VisaResource extends JsonResource
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
            'status'=>$this->status,
            'bank_statment_image'=>$this->bank_statment_image,
            'job_letter_image'=>$this->job_letter_image,
            'user'=>$this->user
        ];
    }
}
