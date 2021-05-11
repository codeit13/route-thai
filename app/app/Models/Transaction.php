<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;


class Transaction extends Model
{
    use HasFactory,Mediable;

    protected $fillable=['currency_id','type','trans_amount','address'];

    public function currency()
    {
         return $this->belongsTo('App\Models\Currency','currency_id','id');
    }

    public function user()
    {
    	return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function available_balance()
    {
    	return $this->user->wallet()->where('currency_id',$this->currency_id)->sum('coin');
    }
}
