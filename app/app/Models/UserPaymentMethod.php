<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;

class UserPaymentMethod extends Model
{
    use HasFactory,Mediable;

    protected $fillable= [
    	'account_number',
    	'account_label',
    	'user_id',
    	'payment_method_id',
    	'status',
    	'code',
    	'code_label'
   	];
}
