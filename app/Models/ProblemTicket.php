<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProblemTicket extends Model
{
    use HasFactory;

    protected $fillable=[
        'message',
        'status',
        'user_id',
        'topic',
        'subject'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ticketReply(){
        return $this->hasMany(TicketReply::class)->orderBy('created_at', 'asc');
    }
}
