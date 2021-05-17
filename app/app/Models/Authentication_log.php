<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Authentication_log extends Model
{
    use HasFactory;

    protected $table = 'authentication_log';
    protected $fillable = ['continent_code','continent_name','country_code','country_name','region_code','region_name','city','zip','latitude','longitude','country_flag','country_flag_emoji','country_flag_emoji_unicode','calling_code'];
    protected $casts = [
        'login_at' => 'datetime',
        'logout_at' => 'datetime',
    ];
    public $timestamps = false;

}
