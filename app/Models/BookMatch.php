<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookMatch extends Model
{
    use HasFactory;

    protected $fillable=[
        'applicant_name',
        'email',
        'phone',
        'match_id',
    ];

    public function match(){
        return $this->belongsTo(TeamMatch::class,'match_id');
    }
}
