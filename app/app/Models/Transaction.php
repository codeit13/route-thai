<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;


class Transaction extends Model
{
    use HasFactory,Mediable;

    protected $fillable=['trans_id','user_id','receiver_id','balance_before_trans','status','timer','user_payment_method_id','type','quantity','fiat_currency_id','currency_id','type','trans_amount','address'];

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
