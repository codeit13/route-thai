<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;
use App\Http\Traits\GenerateTransIDTrait;

class Transaction extends Model
{
    use HasFactory,Mediable;
    use GenerateTransIDTrait;

    protected $fillable=['trans_id','user_id','receiver_id','balance_before_trans','status','timer','user_payment_method_id','type','quantity','fiat_currency_id','currency_id','type','trans_amount','address'];

    /**
     * Get the quantity in 00.0000 format.
     *
     * @param  string  $value
     * @return string
     */
    public function getQuantityAttribute($value)
    {
        return number_format((float)$value, 5, '.', '');
    }

    /**
     * Get the trans_amount in 00.0000 format.
     *
     * @param  string  $value
     * @return string
     */
    public function getTransAmountAttribute($value)
    {
        return number_format((float)$value, 5, '.', '');
    }

    public function currency()
    {
        return $this->belongsTo('App\Models\Currency','currency_id','id');
    }

    public function fiat_currency()
    {
        return $this->belongsTo('App\Models\Currency','fiat_currency_id','id');
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
    public function buyer_trans()
    {
        return $this->hasOne('App\Models\Transaction','id','receiver_id');
    }

    public function checkBuyerRequest()
    {
        $user=\Auth::user();
        $request=$this->buyer_requests()->where('transaction_id',$this->id)->first();
        //$this->timer=$this->timer*60;
        //echo '<pre>';print_r($this->timer);die;

        if(isset($request->updated_at) && ($this->timer*60 < $this->getRequestTime($request->updated_at) || $request->status=='cancel'))
        {
            $request->is_expired=true;

            return $request;
        }
        else if(isset($request->updated_at) && $this->timer*60 > $this->getRequestTime($request->updated_at))
        {
            $request->is_expired=false;
            $request->expiry_in=floor(($this->timer)-($this->getRequestTime($request->updated_at)/60));
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

    public function getTime(){
        $buyer = $this->buyer_requests->first();
        return floor(($this->timer)-($this->getRequestTime($buyer->updated_at)/60));
    }

    public function getRequestTime($date)
    {
        $diff_in_seconds=strtotime(\Carbon\Carbon::now())-strtotime($date);       
        return $diff_in_seconds;
    }

    public function createBuyerTransaction()
    {
        $user=\Auth::user();

        $buyer_request=$this->buyer_requests->where('user_id',$user->id)->first();

        if($trans=$user->transactions()->create($this->toArray()))
        {
            $trans->trans_id= $this->generateID();
            $trans->type= 'buy';
            $trans->save();
            $buyer_request->status='pending';
            $buyer_request->save();

            $this->update(['receiver_id'=>$trans->id]);
        }
        return $this->checkBuyerRequest();   
    }
}