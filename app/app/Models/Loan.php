<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable=['loan_id','currency_id','collateral_amount','loan_currency_id','loan_amount','duration','duration_type','min_price','max_price','interest_value','price_down_percentage','term_percentage','term_id','on_wallet','collateral_currency_rate','loan_repayment_amount','has_close_price','close_price','is_agree','loan_currency_rate','request_type','loan_opening_id','crypto_wallet_address'];

    public function loan_currency()
    {
    	return $this->belongsTo('App\Models\Currency','loan_currency_id','id');
    }
    public function user()
    {
    	return $this->belongsTo('App\Models\User','user_id','id');
    }

    public function collateral_currency()
    {
    	return $this->belongsTo('App\Models\Currency','currency_id','id');
    }

    public function getLoanDateAttribute()
{
    return \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('d/m/Y');
}

  public function repay_request()
  {
    return $this->hasOne('App\Models\LoanRepayRequest','loan_opening_id','id');
  }



}
