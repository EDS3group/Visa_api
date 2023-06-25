<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProblemTicketResource extends JsonResource
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
            'message'=>$this->message,
            'subject'=>$this->subject,
            'topic'=>$this->topic,
            'user_info'=>$this->user,
            'status'=>$this->status,
            'replies'=>$this->ticketReply,
        ];
    }
}
