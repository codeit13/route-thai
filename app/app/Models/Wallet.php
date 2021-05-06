<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $table='wallet';

    public function user()
    {
    	return $this->belongsTo('App\Models\User','user_id','id');
    }


}
