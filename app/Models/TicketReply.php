<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    use HasFactory;

    protected $fillable=[
        'message',
        'problem_ticket_id',
        'sender_type',
        'sender_id'
    ];

    public function ProblemTicket(){
        return $this->belongsTo(ProblemTicket::class);
    }
}
