<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoanRepayRequest extends Model
{
    use HasFactory;

    protected $fillable=['currency_id','loan_currency_id','collateral_amount','loan_amount','loan_repayment_amount','crypto_wallet_address','user_id','on_wallet','collateral_method'];

 public function loan_request()
  {
    return $this->belongsTo('App\Models\Loan','loan_opening_id','id');
  }

   public function loan_currency()
    {
      return $this->belongsTo('App\Models\Currency','loan_currency_id','id');
    }

     public function collateral_currency()
    {
      return $this->belongsTo('App\Models\Currency','currency_id','id');
    }

      public function user()
    {
      return $this->belongsTo('App\Models\User','user_id','id');
    }

}
