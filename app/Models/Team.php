<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasFactory;

    protected $fillable=[
        'image',
        'name_ar',
        'name_en',
        'type',
        'coach',
        'description_ar',
        'description_en',
    ];

    public function getImageAttribute($value){
        $actual_link = (isset($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . '/';
        return ($value == null ? '' : $actual_link . 'teams/' . $value);
    }
}
