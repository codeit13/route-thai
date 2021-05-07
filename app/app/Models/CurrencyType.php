<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyType extends Model
{
    use HasFactory;

    public function currency()
    {
    	return $this->hasMany('App\Models\Currency','type_id','id');
    }
}
