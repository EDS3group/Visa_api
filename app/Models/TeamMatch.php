<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TeamMatch extends Model
{
    use HasFactory;

     protected $fillable=[
        'champion_name_ar',
        'champion_name_en',
        'first_team',
        'second_team',
        'stadum_name_ar',
        'stadum_name_en',
        'date',
        'time',
        'number_of_tickets',
        'ticket_price',
     ];

     public function firstTeam(){
         return $this->belongsTo(Team::class,'first_team');
     }

     public function secondTeam(){
        return $this->belongsTo(Team::class,'second_team');
    }
}
