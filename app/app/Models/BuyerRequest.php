<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerRequest extends Model
{
    use HasFactory;

    protected $fillable=['transaction_id'];


    public function getExpiryTimeAttribute()
{
	        $expiry= new \stdclass();

	        $init= ($this->transaction->timer*60)-$this->transaction->getRequestTime($this->updated_at);


            $expiry->hours = floor($init / 3600);
            $expiry->minutes = floor(($init / 60) % 60);
            $expiry->seconds = $init % 60;

            return $expiry;

}

public function transaction()
{
	return $this->belongsTo('App\Models\Transaction','transaction_id','id');
}

}
