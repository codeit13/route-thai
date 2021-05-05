<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;

class Currency extends Model
{
    use HasFactory,Mediable;

    protected $table='currency';

    public function currency_type()
    {
    	return $this->belongsTo('App\Models\CurrencyType','type_id','id');
    }
}
