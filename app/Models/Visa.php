<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visa extends Model
{
    use HasFactory;
    protected $fillable=[
        'center_apply',
        'date',
        'country',
        'travelers_number',
        'relation',
        'coupon',
        'total_price',
        'user_id',
        'status',
        'sponsor_name',
        'bank_statment_image',
        'job_letter_image',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function visaInformation(){
        return $this->hasMany(VisaInformation::class);
    }

    public function getBankStatmentImageAttribute($value){
        $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        return ($value == null ? '' : $actual_link . 'visa/' . $value);
    }

    public function getJobLetterImageAttribute($value){
        $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        return ($value == null ? '' : $actual_link . 'visa/' . $value);
    }

}
