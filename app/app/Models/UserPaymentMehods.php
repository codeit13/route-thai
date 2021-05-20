<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;

class UserPaymentMehods extends Model
{
    use HasFactory, Mediable;
    protected $table = 'user_payment_methods';
    
    protected $fillable = ['account_number', 'account_label', 'user_id', 'payment_method_id', 'status', 'ifs_code', 'bank_name', 'branch_name', 'branch_location', 'qr-code', 'type'];
    
    public function payment_methods(){
        return $this->belongsTo('App\Models\PaymentMethods','payment_method_id','id');
    }
}
