<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable=['currency_id','type','trans_amount'];

    public function currency()
    {
         return $this->belongsTo('App\Models\Currency','currency_id','id');
    }

    public function user()
    {
    	return $this->belongsTo('App\Models\User','user_id','id');
    }
}
