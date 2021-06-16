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
        'name', 'email', 'password','mobile','default_currency', 'two_factor_code','two_factor_expires_at',
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

    public function total_orders()
    {
        return $this->hasMany('App\Models\Transaction','user_id','id')->where('status','approved');
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
    public function payment_methods()
    {
        return $this->hasMany('App\Models\UserPaymentMethod','user_id','id');
    }

    public function generateTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = rand(100000, 999999);
        $this->two_factor_expires_at = now()->addMinutes(10);
        $this->save();
    }
    public function resetTwoFactorCode()
    {
        $this->timestamps = false;
        $this->two_factor_code = null;
        $this->two_factor_expires_at = null;
        $this->save();
    }    
    public function loans()
    {
        return $this->hasMany('App\Models\Loan','user_id','id');
    }
    public function routeNotificationForTelegram()
    {
        return $this->telegram_user_id;
    }
    public function routeNotificationForLineNotify($notification)
    {
        return $this->notify_token;
    }


    public function setGoogle2faSecretAttribute($value)
    {
        $this->attributes['google2fa_secret'] = encrypt($value);
    }

    /**
     * Decrypt the user's google_2fa secret.
     *
     * @param  string  $value
     * @return string
     */
    public function getGoogle2faSecretAttribute($value)
    {
        return !empty($value) ? decrypt($value) : '';
    }
}