<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Yadahan\AuthenticationLog\AuthenticationLogable;


class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable, AuthenticationLogable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','mobile','default_currency'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function wallet()
    {
        return $this->hasMany('App\Models\Wallet','user_id','id')->with('currency');;
    }

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction','user_id','id');
    }

    public function buyer_request()
    {
        return $this->hasMany('App\Models\BuyerRequest','user_id','id');
    }


    public function currency()
    {
        return $this->belongsTo('App\Models\Currency','default_currency', 'id');
    }

    public function language()
    {
        return $this->belongsTo('App\Models\Language','default_language', 'id');
    }
    public function user_payment_method()
    {
        return $this->hasMany('App\Models\UserPaymentMethod','user_id','id');
    }
}