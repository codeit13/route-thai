<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;

use App\Http\Traits\UniqueLoanIDTrait;

class LoanController extends Controller
{
    use UniqueLoanIDTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $loans=auth()->user()->loans;

        return view('front.loan.history',compact('loans'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $currencies=\App\Models\Currency::where('is_crypto',1)->get();

       // $fiat_currencies=\App\Models\Currency::where('is_fiat',1)->get();

        $ExchangeRatesService=new \App\Services\ExchangeRatesService;

        $crypto_rates=$ExchangeRatesService->crypto_rates();

      //  $fiat_rates=$ExchangeRatesService->fiat_rates();

        $terms=\App\Models\LoanTerms::all();

        $loanSettings=\App\Models\Settings::whereIn('setting_code',['loan_price_down_limit','loan_max_percentage','loan_min_percentage'])->get();

      //  $price_down=(object)(['percentage'=>5]);
        


        $wallets=auth()->user()->wallet;

        



        

        return view('front.loan.request',compact('currencies','wallets','crypto_rates','terms','loanSettings'));
    }


    public function initialize(Request $request)
    {
        $rules=['collateral_amount'=>'required|numeric','currency_id'=>'required|integer','loan_currency'=>'required|integer','term'=>'required|integer'];
        if($request->has('is_wallet'))
        {
            $rules['collateral_amount']=['required',new \App\Rules\CheckWalletBalance($request)];
        }

        if($request->has('set_close_price'))
        {
            $rules['close_price']=['required','numeric'];
        }



       
        
       

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
                             'interest_value'=>2.1,
                             'price_down_percentage'=>$loan_detail->price_down_value,
                             'term_percentage'=>$loan_detail->term_detail->terms_percentage,
                             'term_id'=>$loan_detail->term_detail->id,
                             'on_wallet'=>$loan_detail->on_wallet??0,'collateral_currency_rate'=>$loan_detail->usdt,'loan_repayment_amount'=>$loan_detail->loan_repayment,
                             'has_close_price'=>$loan_detail->set_close_price??0,
                             'close_price'=>$loan_detail->close_price,
                             'is_agree'=>$request->agree,
                        );
        }

        $user=auth()->user();

        $loan=$user->loans()->create($loan_data);

        $message='Your loan request is created and pending for approval.';

        if(isset($loan_detail->is_wallet))
        {
            $wallet=$user->wallet()->where('currency_id',$loan_detail->currency_id)->where('wallet_type',1)->first();

            $wallet->coin=$wallet->coin-$loan_detail->collateral_amount;

            $wallet->save();

            $loanWallet=$user->wallet()->where('currency_id',$loan_detail->loan_currency->id)->where('wallet_type',4)->first();

            if($loanWallet)
            {
                $loanWallet->coin=$loanWallet->coin+$loan_detail->loan_amount;
            }
            else
            {
                $newWallet=array('currency_id'=>$loan_detail->loan_currency->id,
                                 'coin'=>$loan_detail->loan_amount,
                                 'wallet_type'=>4,
                                 '');
                $user->wallet()->create($newWallet);
            }

            $loan->status='approved';

            $loan->save();

            $message='Your loan request is approved successfully.';
        }

     

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





          return view('front.loan.request-detail',compact('loan_detail'));
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoanRequest  $loanRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        //
    }


    public function repay($loan)
    {
          echo 'in-progress';
    }

    public function close($loan)
    {
        echo 'in-progress';
    }

    public function loan_data($request)
    {

       

       




         $loan_detail = (object)$request->session()->get('loan_detail');

         $loan_detail->collateral_currency=\App\Models\Currency::find($loan_detail->currency_id);

         $loan_detail->loan_currency=\App\Models\Currency::find($loan_detail->loan_currency
         );

         $loan_detail->term_detail=\App\Models\LoanTerms::find($loan_detail->term);

         

         $filteredCryptoExchangeRow=$this->get_crypto_exchange_row($loan_detail->collateral_currency);

    //console.log(filteredCryptoExchangeRow);return false;

        $usdtPrice=number_format((float)$filteredCryptoExchangeRow->lastPrice, 2, '.', '');



        $loan_variables=$this->loan_settings();

        $loan_detail->settings=$loan_variables;

        $loan_detail->price_down_value=number_format((float)($usdtPrice*((float)$loan_variables->loan_price_down_limit)/100),2,'.','');

        $loan_detail->usdt=$usdtPrice;





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

            $newUpdateLoanPrice=number_format(($newUpdateLoanPrice - ($newUpdateLoanPrice * (100-$loan_detail->term_detail->terms_percentage) / 100)),2,".","");

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

        $Interest=($newUpdateLoanPrice*2.1*($timeDuration/30)/100);




        $newUpdateLoanPrice=number_format((float)($newUpdateLoanPrice)+(float)($Interest),5,".","");

        $loan['loan_repayment']=$newUpdateLoanPrice;


        return $loan;


      }

            
    }

    public function loan_settings()
    {

        $loanSettings=\App\Models\Settings::whereIn('setting_code',['loan_price_down_limit','loan_max_percentage','loan_min_percentage'])->get();


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

}
