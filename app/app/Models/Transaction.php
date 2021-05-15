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

    public function checkBuyerRequest()
{
     $user=\Auth::user();

     $request=$this->buyer_requests()->where('user_id',$user->id)->first();

     $this->timer=$this->timer*60;

     //echo '<pre>';print_r($this->timer);die;

     if($request && $this->timer < $this->getRequestTime($request->created_at))
     {
             $request->is_expired=true;

             return $request;
     }
     else if($request && $this->timer > $this->getRequestTime($request->created_at))
     {
             $request->is_expired=false;



             $request->expiry_in=floor(($this->timer/60)-($this->getRequestTime($request->created_at)/60));

            

             return $request;
     }
     else if($this->buyer_requests()->count())
     {
       
           return 'exists';
     }
     else
     {
         return null;
     }
}

public function getRequestTime($date)
{
    
    $diff_in_seconds=strtotime(\Carbon\Carbon::now())-strtotime($date);    
   
    return $diff_in_seconds;
}




}
