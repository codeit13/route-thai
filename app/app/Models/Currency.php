<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;

class Currency extends Model
{
    use HasFactory,Mediable;

    protected $table='currency';

     protected $attributes = [
       'user_total' => '0.00000000',
    ];

    public function currency_type()
    {
    	return $this->belongsTo('App\Models\CurrencyType','type_id','id');
    }




    public function getUserTotalAttribute()
{
	$user=\Auth::user();
	$total=$user->transactions()->where('status','approved')->where('type',1)->where('currency_id',$this->id)->sum('trans_amount');
    return ($total>0)?$total:'0.00000000';
}

 public function getUserBalanceAttribute()
{
	$user=\Auth::user();
	$wallet=$user->wallet()->where('currency_id',$this->id);
    if($wallet->exists())
    {
        $wallet=$wallet->sum('coin');
    }
    else
    {
    	$wallet='0.00000000';
    }

    return $wallet;
}

}
