<?php

namespace App\Http\Controllers;

use App\Models\LoanRequest;
use Illuminate\Http\Request;
use App\Models\Loan;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.loan.history');
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
        //
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
    public function edit(Loan $loan)
    {
        return view('front.loan.detail');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LoanRequest  $loanRequest
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request, Loan $loan)
    {
        return view('front.loan.status');
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
