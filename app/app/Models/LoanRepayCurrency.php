<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;


class LoanRepayCurrency extends Model
{
    use HasFactory,Mediable;

    protected $table='loan_repay_currency';
    protected $fillable=['currency_id','crypto_wallet_address','crypto_wallet_memo','updated_by','created_at'];

    public function currency() {
    	return $this->belongsTo('App\Models\Currency','currency_id','id');
    }
}