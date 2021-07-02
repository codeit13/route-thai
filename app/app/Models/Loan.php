<?php

namespace App\Models;

use Google\Cloud\Firestore\FirestoreClient;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable=['loan_id','currency_id','collateral_amount','loan_currency_id','loan_amount','duration','duration_type','min_price','max_price','interest_value','price_down_value','term_percentage','term_id','on_wallet','collateral_currency_rate','loan_repayment_amount','has_close_price','close_price','is_agree','loan_currency_rate','request_type','loan_opening_id','crypto_wallet_address','repay_amount_usdt'];

    protected $dates = ['repay_date'];

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

public function getFrontStatusAttribute()
{
   return ucwords(str_replace('_',' ',$this->attributes['status']=='approved'?'in_progress':$this->attributes['status']));
}

  public function repay_request()
  {
    return $this->hasOne('App\Models\LoanRepayRequest','loan_opening_id','id')->where('status','!=','rejected');
  }

  public function save_Loan_To_Firebase($data) {
    $projectId = "routethai-loan-liquidation";
        
        $db = new FirestoreClient([
            'projectId' => $projectId,
            'keyFile' => json_decode(file_get_contents(base_path(env('GOOGLE_APPLICATION_CREDENTIALS'))), true),
        ]);

        $value = $db->collection('loans')->document($data->id)->set((array)$data);

    return $value;
}

  public function loan_request()
  {
    return $this->belongsTo('App\Models\Loan','loan_opening_id');
  }
}
