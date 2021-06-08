<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanRepayCurrency extends Model
{
    use HasFactory;

    protected $table='loan_repay_currency';
    protected $fillable=['currency_id','crypto_wallet_address','admin_id','created_at'];

    public function currency() {
    	return $this->belongsTo('App\Models\Currency','currency_id','id');
    }
}