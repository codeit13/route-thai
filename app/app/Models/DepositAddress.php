<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;


class DepositAddress extends Model
{
    use HasFactory;
    use Mediable;


    protected $fillable=['address','currency_id','admin_id'];


    public function currency()
    {
    	return $this->belongsTo('App\Models\Currency','currency_id','id');
    }
}
