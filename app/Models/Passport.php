<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Passport extends Model
{
    use HasFactory;

    protected $fillable=[
        'applicant_name',
        'email',
        'phone',
        'country',
        'passport_quantity',
        'user_id',
        'status'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
