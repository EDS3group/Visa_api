<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;

    protected $fillable=[
        'applicant_name',
        'email',
        'phone',
        'country',
        'nationality',
        'mode_of_finance',
        'major_of_study',
        'qualification',
        'grade',
        'call_from',
        'call_to',
        'user_id',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
