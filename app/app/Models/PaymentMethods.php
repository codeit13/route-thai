<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Plank\Mediable\Mediable;

class PaymentMethods extends Model
{
    use HasFactory, Mediable;
    protected $table = 'payment_methods';
    protected $fillable = ['name', 'status'];

}
