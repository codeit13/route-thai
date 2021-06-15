<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;

class Currency extends Model
{
    use HasFactory,Mediable;

    protected $table='currency';
    protected $fillable=['type_id','name','icon','short_name','is_tradable','is_loanable','is_crypto','is_fiat','is_collateral'];

    public function currency_type()
    {
    	return $this->belongsTo('App\Models\CurrencyType','type_id','id');
    }

    public function deposit_address()
    {
        return $this->hasOne('App\Models\DepositAddress','currency_id','id');
    }

    public function collateral_address()
    {
        return $this->hasOne('App\Models\CollateralAddress','currency_id','id');
    }

    public function getUserTotalAttribute()
    {
	    $user=\Auth::user();
	    $total=$user->transactions()->where('status','approved')->where('type','deposit')->where('currency_id',$this->id)->sum('trans_amount');
        return ($total>0)?$total:'0.00000';
    }

    public function getUserBalanceAttribute()
    {
	    $user=\Auth::user();
	    $wallet=$user->wallet()->where('currency_id',$this->id)->where('wallet_type','!=',3);
        if($wallet->exists())
        {
            $wallet= $wallet->first()->coin;
        }
        else
        {
            $wallet='0.00000';
        }
        return $wallet;
    }

    public function getUserP2pBalanceAttribute()
    {
        $user = \Auth::user();
        $wallet = $user->wallet()->where('currency_id',$this->id)->where('wallet_type',3)->first();
        if($wallet)
        {
            $wallet=$wallet->current_balance;
        }
        else
        {
            $wallet='0.00000';
        }

        return $wallet;
    }

    public function getUserP2pTotalAttribute()
    {
        $user=\Auth::user();
        $wallet = $user->wallet()->where('currency_id',$this->id)->where('wallet_type',3)->first();
        if($wallet)
        {
            $wallet=$wallet->coin;
        }
        else
        {
            $wallet='0.00000';
        }

        return $wallet;
    }
    

}
