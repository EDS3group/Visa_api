<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SchoolResource extends JsonResource
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
            'nationality'=>$this->nationality,
            'mode_of_finance'=>$this->mode_of_finance,
            'major_of_study'=>$this->major_of_study,
            'qualification'=>$this->qualification,
            'grade'=>$this->grade,
            'call_from'=>$this->call_from,
            'call_to'=>$this->call_to,
            'status'=>$this->status,
            'user_id'=>$this->user
        ];
    }
}
