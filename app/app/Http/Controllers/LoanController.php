<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Traits\UniqueLoanIDTrait;

use App\Notifications\Notify;


class LoanController extends Controller
{
    use UniqueLoanIDTrait;

    public $crypto_exchange_rates;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $loans=auth()->user()->loans();

        $currentCurrency='';

        $currencies=\App\Models\Currency::whereIn('id',auth()->user()->loans()->pluck('currency_id'))->get();

         if($request->status)
        {
          $loans=$loans->where('status',$request->status);
        }

        if($request->start_date)
        {
            $start_date = date('Y-m-d',strtotime($request->start_date));

         
            $loans=$loans->whereDate('created_at', '>=', $start_date);
        }

        if($request->end_date)
        {
            $end_date = date('Y-m-d',strtotime($request->end_date));

          //echo '<pre>';print_r($start_date);die;
            $loans=$loans->whereDate('created_at', '<=', $end_date);
        }

        if($request->currency && !$request->search)
        {
          $loans=$loans->where('currency_id',$request->currency);

          $currentCurrency=$request->currency;
        }

        if($request->search)
        {

          $loans=$loans->whereHas('collateral_currency', function ($query)use ($request) {
                                          $query->where('name','like',$request->search.'%')->orWhere('short_name','like',$request->search.'%');

                                        });

        }


              $loans=$loans->orderBy('created_at','desc')->paginate(10)->withQueryString();

        //echo '<pre>';print_r($currencies->toArray());

        return view('front.loan.history',compact('loans','currencies','currentCurrency','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $currencies=\App\Models\Currency::where('is_crypto',1)->get();

        $loanable_currencies=\App\Models\Currency::where('is_loanable',1)->get();

        $collateral_currencies=\App\Models\Currency::where('is_collateral',1)->get();

       // $fiat_currencies=\App\Models\Currency::where('is_fiat',1)->get();

        $ExchangeRatesService=new \App\Services\ExchangeRatesService;

        $crypto_rates=$ExchangeRatesService->crypto_rates();

      //  $fiat_rates=$ExchangeRatesService->fiat_rates();

        $terms=\App\Models\LoanTerms::all();

        $loans=auth()->user()->loans()->orderBy('created_at','desc')->limit(5)->get();

        $loanSettings=\App\Models\Settings::whereIn('setting_code',['loan_price_down_limit','loan_max_percentage','loan_min_percentage','loan_interest_rate'])->get();

      //  $price_down=(object)(['percentage'=>5]);
        


         $wallets=auth()->user()->wallet()->where('wallet_type',1)->get();

        



        

        return view('front.loan.request',compact('currencies','wallets','crypto_rates','terms','loanSettings','loanable_currencies','collateral_currencies','loans'));
    }


    public function initialize(Request $request)
    {
        $rules=['collateral_amount'=>'required|numeric','currency_id'=>'required|integer','loan_currency'=>'required|integer','term'=>'required|integer'];





        if($request->has('is_wallet'))
        {
        
        //echo '<pre>';print_r($request->all());die;

            $rules['collateral_amount']=['required',new \App\Rules\CheckWalletBalance($request)];
        }

        if($request->has('set_close_price'))
        {
            $rules['close_price']=['required','numeric'];
        }


         $request->validate($rules);
       
        
       

        $request->session()->put('loan_detail', $request->all());



       

        return redirect()->route('loan.request.detail');





        //echo '<pre>';print_r($request->session());die;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->has('agree'))
        {
            $request->merge(array('agree',''));
        }

        $request->validate(['agree'=>'required']);

        $loan_detail=$this->loan_data($request);


       

        if($loan_detail)
        {
            $loan_data=array('loan_id'=>$this->generateID(),
                             'currency_id'=>$loan_detail->collateral_currency->id,'collateral_amount'=>$loan_detail->collateral_amount,
                             'loan_currency_id'=>$loan_detail->loan_currency->id,
                             'loan_amount'=>$loan_detail->loan_amount,
                             'duration'=>$loan_detail->term_detail->no_of_duration,
                             'duration_type'=>$loan_detail->term_detail->duration_type,
                             'min_price'=>$loan_detail->min_price,
                             'max_price'=>$loan_detail->max_price,
                             'interest_value'=>$loan_detail->settings->loan_interest_rate??'',
                             'price_down_value'=>$loan_detail->price_down_value,
                             'term_percentage'=>$loan_detail->term_detail->terms_percentage,
                             'term_id'=>$loan_detail->term_detail->id,
                             'on_wallet'=>$loan_detail->on_wallet??0,'collateral_currency_rate'=>$loan_detail->usdt,
                             'loan_repayment_amount'=>$loan_detail->loan_repayment,
                             'repay_amount_usdt'=>$loan_detail->loan_repayment*$loan_detail->loan_currency_rate,
                             'has_close_price'=>$loan_detail->set_close_price??0,
                             'close_price'=>$loan_detail->close_price??'',
                             'is_agree'=>$request->agree,
                             'loan_currency_rate'=>$loan_detail->loan_currency_rate,
                        );
        }

        $user=auth()->user();

        $loan=$user->loans()->create($loan_data);

        $message='Your loan request is created and pending for approval.';

        $notification='[Route-Thai] Loan request (Ending with '.substr($loan->loan_id,-4).') with Collateral of '.$loan->collateral_amount.' '.$loan->collateral_currency->short_name.' and Loan amount '.$loan->loan_amount.' '.$loan->loan_currency->short_name.', Validity of '.$loan->duration.' '.$loan->duration_type.' has been created. You will be notified when your Loan is approved.';

        if(isset($loan_detail->is_wallet))
        {
            $wallet=$user->wallet()->where('wallet_type',1)->where('currency_id',$loan_detail->currency_id)->first();

            $wallet->coin=$wallet->coin-$loan_detail->collateral_amount;

            $wallet->save();

            $loanWallet=$user->wallet()->where('currency_id',$loan_detail->loan_currency->id)->where('wallet_type',4)->first();

            if($loanWallet)
            {
                $loanWallet->coin=$loanWallet->coin+$loan_detail->loan_amount;
                $loanWallet->save();
            }
            else
            {
                $newWallet=array('currency_id'=>$loan_detail->loan_currency->id,
                                 'coin'=>$loan_detail->loan_amount,
                                 'wallet_type'=>4,
                                 '');
                $user->wallet()->create($newWallet);
            }

            $repay_date=$this->repay_date($loan_detail);

            $loan->repay_date=$repay_date;

            $loan->on_wallet=1;

            $loan->status='approved';

            $loan->save();

            $message='Your loan request is approved successfully.';

            $notification='[Route-Thai] Loan request (Ending with '.substr($loan->loan_id,-4).') with Collateral of '.$loan->collateral_amount.' '.$loan->collateral_currency->short_name.' and Loan amount '.$loan->loan_amount.' '.$loan->loan_currency->short_name.', Validity of '.$loan->duration.' '.$loan->duration_type.' has been successfully approved. The Loan amount transferred to your Loan wallet.';
        }

        $user = auth()->user();

          Notify::sendMessage([
            'sms_notification' => $user->sms_notification,
            'mobile' => $user->mobile,
            'telegram_notification' => $user->telegram_notification,
            'telegram_user_id' => $user->telegram_user_id,
            'line_notification' => $user->line_notification,
            'line_user_id' => $user->line_user_id,
            'email_notification' => $user->email_notification,
            'email_id' => $user->email,
            'Message' => $notification,
        ]);
         
          $request->session()->forget('loan_detail');
     

      return redirect()->route('loan.history')->with('success',$message);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\LoanRequest  $loanRequest
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        $loan_detail=$this->loan_data($request);

        //echo '<pre>';print_r($loan_detail);die;

        $loans=auth()->user()->loans()->latest()->limit(5)->get();


        $collateral_currencies=\App\Models\Currency::where('is_collateral',1)->get();


         //echo '<pre>';print_r($loan_detail->toArray());die;




          return view('front.loan.request-detail',compact('loan_detail','collateral_currencies','loans'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LoanRequest  $loanRequest
     * @return \Illuminate\Http\Response
     */
    public function edit($loan)
    {
        $loan=\App\Models\Loan::whereLoanId($loan)->first();

         if($loan->status=='pending')
        {
            return redirect()->route('loan.status',$loan->loan_id);
        }

        if($loan){

        $loan->current_value=$this->get_crypto_exchange_row($loan->collateral_currency)->lastPrice;



        $loans=auth()->user()->loans()->latest()->limit(5)->get();


        return view('front.loan.detail',compact('loan','loans'));
    }
    else
    {
        abort(404);
    }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LoanRequest  $loanRequest
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request,$loan)
    {
        $loan=\App\Models\Loan::whereLoanId($loan)->first();

        if($loan){

        $loan->current_value=$this->get_crypto_exchange_row($loan->collateral_currency)->lastPrice;


        return view('front.loan.status',compact('loan'));
    }
    else
    {
        abort(404);
    }
        
    }

    /**
     * close request the specified resource from storage.
     *
     * @param  \App\Models\Loan  $loan
     * @return \Illuminate\Http\Response
     */
    public function closeRequest(Request $request,$loan)
    {

      //  echo '<pre>';print_r($request->all());die;
       

        $rules=['currency_id'=>'required','loan_amount'=>'required','loan_repayment_amount'=>'required'];

        if($request->has('payment_method') && $request->payment_method=='wallet')
        {
            $rules['loan_repayment_amount']=['required',new \App\Rules\CheckWalletBalance($request,1)];
        }

        $request->validate($rules);

        $loan=\App\Models\Loan::whereLoanId($loan)->first();



        if($loan){

        $close_request=array('loan_opening_id'=>$loan->id,'currency_id'=>$loan->currency_id,'loan_currency_id'=>$request->currency_id,'collateral_amount'=>$loan->collateral_amount,'loan_amount'=>$request->loan_amount,'loan_repayment_amount'=>$request->loan_repayment_amount,'crypto_wallet_address'=>$request->crypto_wallet_address,'user_id'=>auth()->id(),
            'loan_currency_rate'=>$request->loan_currency_rate);

         if($request->payment_method=='wallet')
        {
            $close_request['on_wallet']=1;

        }

        $close_request['collateral_method']='wallet';

        $loan_close_request=$loan->repay_request()->create($close_request);

        $loan->status='repay_in_progress';

        $loan->save();


       


       

        return redirect()->route('loan.history')->with('success','Your repayment request is created.Please wait for the approval.');
    }
    else
    {
        abort(404);
    }


    }


    public function repay($loan)
    {


          $loan=\App\Models\Loan::whereLoanId($loan)->first();

        //  echo '<pre>';print_r($loan->repay_request->toArray());die;

           if($loan->status !='approved')
          {
            return redirect()->back();
          }

          $repay_setting=\App\Models\Settings::where('setting_code','loan_repay_currency_type')->first()->setting_value??1;



        if($loan){

        $loan->current_value=$this->get_crypto_exchange_row($loan->collateral_currency)->lastPrice;

        $crypto_exchange_rates=$this->crypto_exchange_rates;

        if($repay_setting==1)
        {
            $currencies=\App\Models\Currency::where('id',$loan->loan_currency_id)->with('loan_repay_currency')->get();

        }
        else
        {
            $currencies=\App\Models\Currency::with('loan_repay_currency')->has('loan_repay_currency')->get();
        }

        $currencies->filter(function($value)
        {
            $value->image_url='';
            $value->qr_code='';

            if($value->hasMedia('icon'))
            {
                $value->image_url=$value->firstMedia('icon')->getUrl();

            }
            if(isset($value->loan_repay_currency) && $value->loan_repay_currency->hasMedia('qr_code'))
            {
                $value->qr_code=$value->loan_repay_currency->firstMedia('qr_code')->getUrl();

            }

          //  $loan_detail->collateral_currency->collateral_address

        });

       // echo '<pre>';print_r($currencies->toArray());die;

           $wallets=auth()->user()->wallet()->where('wallet_type',1)->get();




        return view('front.loan.repay',compact('loan','crypto_exchange_rates','repay_setting','currencies','wallets'));
    }
    else
    {
        abort(404);
    }
    }

    public function close($loan)
    {
        echo 'in-progress';
    }

    public function loan_data($request)
    {

       

       




         $loan_detail = (object)$request->session()->get('loan_detail');

     //    echo '<pre>';print_r($loan_detail);die;

         $loan_detail->collateral_currency=\App\Models\Currency::find($loan_detail->currency_id);

         $loan_detail->loan_currency=\App\Models\Currency::find($loan_detail->loan_currency
         );

         $loan_detail->term_detail=\App\Models\LoanTerms::find($loan_detail->term);

         

         $filteredCryptoExchangeRow=$this->get_crypto_exchange_row($loan_detail->collateral_currency);

         $loanCrytoExchangeRow=$this->get_crypto_exchange_row($loan_detail->loan_currency);


    //console.log(filteredCryptoExchangeRow);return false;

        $usdtPrice=number_format((float)$filteredCryptoExchangeRow->lastPrice, 2, '.', '');



        $loan_variables=$this->loan_settings();

        $loan_detail->settings=$loan_variables;

        //echo '<pre>';print_r($loan_detail->settings);die;

        $loan_detail->price_down_value=number_format((float)($usdtPrice-$usdtPrice*((float)$loan_variables->loan_price_down_limit)/100),2,'.','');

        $loan_detail->usdt=$usdtPrice;

        $loan_detail->loan_currency_rate=number_format((float)$loanCrytoExchangeRow->lastPrice, 2, '.', '');





         // $('#backend-min-price').html(numberWithCommas((parseFloat(usdPrice)-parseFloat(usdPrice*parseFloat(set_price_min)/100)).toFixed(2)));



         //    $('#backend-max-price').html(numberWithCommas());
           $loan_detail->min_price=number_format((float)($usdtPrice)+(float)($usdtPrice*(float)($loan_variables->loan_min_percentage)/100),2,".","");
            
            $loan_detail->max_price=number_format((float)($usdtPrice)+(float)($usdtPrice*(float)($loan_variables->loan_max_percentage)/100),2,".","");

        $loan_amounts=$this->loan_amount($loan_detail->loan_currency,$filteredCryptoExchangeRow,$loan_detail);

        $loan_detail->loan_amount=$loan_amounts['loan_amount'];

        $loan_detail->loan_repayment=$loan_amounts['loan_repayment'];

       //echo '<pre>';print_r($loan_detail);die;




         return $loan_detail;

    }

    public function loan_amount($loan_currency,$filteredCryptoExchangeRow,$loan_detail)
    {
       

            $filteredLoanExchangeRow=$this->get_crypto_exchange_row($loan_currency);



            $newUpdateLoanPrice=(((float)($filteredCryptoExchangeRow->lastPrice)/(float)($filteredLoanExchangeRow->lastPrice))*$loan_detail->collateral_amount);
          //  console.log(newUpdateLoanPrice);

            $newUpdateLoanPrice=number_format(($newUpdateLoanPrice - ($newUpdateLoanPrice * (100-$loan_detail->term_detail->terms_percentage) / 100)),5,".","");

            $loan['loan_amount']=$newUpdateLoanPrice;



        if($newUpdateLoanPrice >0)
        {

       

           $timeDuration=$loan_detail->term_detail->no_of_duration;

        if($loan_detail->term_detail->duration_type=='month')
        {
           $timeDuration=$loan_detail->term_detail->no_of_duration*30;
        }

        if($loan_detail->term_detail->duration_type=='year')
        {
           $timeDuration=$loan_detail->term_detail->no_of_duration*12*30;
        }

         //console.log(timeDuration);

        $Interest=($newUpdateLoanPrice*(float)$loan_detail->settings->loan_interest_rate*($timeDuration/30)/100);




        $newUpdateLoanPrice=number_format((float)($newUpdateLoanPrice)+(float)($Interest),5,".","");

        $loan['loan_repayment']=$newUpdateLoanPrice;


        return $loan;


      }

            
    }

    public function loan_settings()
    {

        $loanSettings=\App\Models\Settings::whereIn('setting_code',['loan_price_down_limit','loan_max_percentage','loan_min_percentage','loan_interest_rate'])->get();


        $loan_variables=[];

      foreach($loanSettings as $loan_setting)
    {

     $loan_variables[$loan_setting->setting_code]=$loan_setting->setting_value;

    }

      $loan_variables=(object)$loan_variables;

      return $loan_variables;

    }


   public function get_crypto_exchange_row($cryptoRow)
{
    $ExchangeRatesService=new \App\Services\ExchangeRatesService;



     $crypto_rates=collect(json_decode($ExchangeRatesService->crypto_rates()));

     $this->crypto_exchange_rates=$crypto_rates;


    $crypto_exchange_row= $crypto_rates->filter(function($row) use($cryptoRow){

       

       return $row->symbol==$cryptoRow->short_name.'USDT';
    })->first();

    if($cryptoRow->short_name=='USDT')
    {
        return (object)[
    "symbol"=>"USDT",
    "priceChange"=> "-0.55308000",
    "priceChangePercent"=>"-31.201",
    "weightedAvgPrice"=> "1.57545245",
    "prevClosePrice"=> "1.77265000",
    "lastPrice"=> "1.00000000",
    "lastQty"=> "41.00000000",
    "bidPrice"=> "1.21599000",
    "bidQty"=> "640.00000000",
    "askPrice"=> "1.21973000",
    "askQty"=> "117.00000000",
    "openPrice"=>"1.77265000",
    "highPrice"=>"1.89057000",
    "lowPrice"=>"1.12100000",
    "volume"=>"131974930.00000000",
    "quoteVolume"=>"207920226.31104000",
    "openTime"=> 1623067237426,
    "closeTime"=> 1623153637426,
    "firstId"=> 1071985,
    "lastId"=> 1727494,
    "count"=>655510
       ];
    }

     // echo '<pre>';print_r($crypto_exchange_row);die;


    return $crypto_exchange_row;

}

public function repay_date($loan)
{
    if($loan->term_detail->duration_type=='month')
    {
        $repay_date=\Carbon\Carbon::now()->addMonths($loan->term_detail->no_of_duration);
    //echo '<pre> tt1';print_r($repay_date);die;

    }

    if($loan->term_detail->duration_type=='year')
    {
        $repay_date=\Carbon\Carbon::now()->addYears($loan->term_detail->no_of_duration);
    }
    if($loan->term_detail->duration_type=='days')
    {
        $repay_date=\Carbon\Carbon::now()->addDays($loan->term_detail->no_of_duration);
    }

   // echo '<pre> tt';print_r($repay_date);die;

    return $repay_date;
}



}
