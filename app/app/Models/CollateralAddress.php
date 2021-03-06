<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;

class CollateralAddress extends Model
{
    use HasFactory;
    use Mediable;

    protected $table='collateral_address';
    protected $fillable=['currency_id','crypto_wallet_address','crypto_memo','updated_by','created_at'];

    public function currency() {
    	return $this->belongsTo('App\Models\Currency','currency_id','id');
    }
}