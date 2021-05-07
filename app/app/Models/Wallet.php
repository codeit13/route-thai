<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $table='wallet';

    protected $fillable=['coin','currency_id'];

    public function user()
    {
    	return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function currency()
    {
    	return $this->belongsTo('App\Models\Currency','currency_id','id');
    }


}
