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
    public function receiver()
    {
    	return $this->belongsTo('App\Models\User','receiver_id','id');
    }

    public function available_balance()
    {
    	return $this->user->wallet()->where('currency_id',$this->currency_id)->sum('coin');
    }

    public function buyer_requests()
    {
        return $this->hasMany('App\Models\BuyerRequest','transaction_id','id');
    }

    public function hasBuyerRequest()
{
     $user=\Auth::user();
     $request=$this->buyer_requests()->where('user_id',$user->id)->first();

     //echo '<pre>';print_r($request->toArray());die;

     if($request && $this->timer < $this->getRequestTime($request))
     {
        return true;
     }
     else
     {
       
           return false;
     }
}

public function getRequestTime($request)
{
    $to = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i', $request->created_at);

    $from = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i',\Carbon\Carbon::now());


    $diff_in_minutes = $to->diffInMinutes($from);

     return $diff_in_minutes;
}

}
