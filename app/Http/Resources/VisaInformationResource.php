<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class VisaInformationResource extends JsonResource
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
            'first_name'=>$this->first_name,
            'last_name'=>$this->last_name,
            'passport_image'=>$this->passport_image,
            'national_image'=>$this->national_image,
            'shengen_visa_image'=>$this->shengen_visa_image,
            'social_status'=>$this->social_status,
            // 'bank_statment_image'=>$this->bank_statment_image,
            // 'job_letter_image'=>$this->job_letter_image,
            'family_id_image'=>$this->family_id_image,
            'visa'=>new VisaResource($this->visa),
        ];
    }
}
