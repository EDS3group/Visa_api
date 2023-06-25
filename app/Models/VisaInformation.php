<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaInformation extends Model
{
    use HasFactory;
    protected $fillable=[
        'first_name',
        'last_name',
        'passport_image',
        'national_image',
        'shengen_visa_image',
        'social_status',
        // 'bank_statment_image',
        // 'job_letter_image',
        'family_id_image',
        'visa_id'
    ];

    public function visa(){
        return $this->belongsTo(Visa::class);
    }
    public function getFamilyIdImageAttribute($value){
        $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        return ($value == null ? '' : $actual_link . 'visa/' . $value);
    }
    // public function getJobLetterImageAttribute($value)
    // {
    //     $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
    //     return ($value == null ? '' : $actual_link . 'visa/' . $value);
    // }
    // public function getBankStatmentImageAttribute($value)
    // {
    //     $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
    //             return ($value == null ? '' : $actual_link . 'visa/' . $value);

    // }
    public function getShengenVisaImageAttribute($value)
    {
        $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
                return ($value == null ? '' : $actual_link . 'visa/' . $value);

    }
    public function getNationalImageAttribute($value)
    {
        $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
                return ($value == null ? '' : $actual_link . 'visa/' . $value);

    }
    public function getPassportImageAttribute($value)
    {
        $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
                return ($value == null ? '' : $actual_link . 'visa/' . $value);
    }
}
