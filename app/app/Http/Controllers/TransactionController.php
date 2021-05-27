<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CurrencyType;
use MediaUploader;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$type='',$typename='')
    {

   // echo '<pre>';print_r($request->all());die;
      $currency_types=\App\Models\CurrencyType::where('id','!=',3)->get();

      $currentCurrency='';

      $user=\Auth::user();
       

      $walletType=new \App\Models\CurrencyType;

      $transaction_type=$request->type??'deposit';


      if($type)
        {

          $walletType=$walletType->find($type);
          $currencies=\App\Models\Currency::where('type_id',$type)->get();

        }
        else
        {
            $currencies=\App\Models\Currency::where('type_id',$currency_types[0]->id)->get();
             $type=$currency_types[0]->id;
        }

        $transactions= $user->transactions()->where('type',$transaction_type);

        if($request->status)
        {
          $transactions=$transactions->where('status',$request->status);
        }

        if($request->start_date)
        {
            $start_date = date('Y-m-d',strtotime($request->start_date));

          //echo '<pre>';print_r($start_date);die;
            $transactions=$transactions->whereDate('created_at', '>=', $start_date);
        }

        if($request->end_date)
        {
            $end_date = date('Y-m-d',strtotime($request->end_date));

          //echo '<pre>';print_r($start_date);die;
            $transactions=$transactions->whereDate('created_at', '<=', $end_date);
        }

        if($request->currency && !$request->search)
        {
          $transactions=$transactions->where('currency_id',$request->currency);

          $currentCurrency=$request->currency;
        }

        if($request->search)
        {
          $transactions=$transactions->whereHas('currency', function ($query)use ($request) {
                                          $query->where('name','like',$request->search.'%')->orWhere('short_name','like',$request->search.'%');

                                        });

        }


         $transactions= $transactions->whereHas('currency', function ($query)use ($type,$request) {
                                          $query->where('type_id',$type);
      

                                        })->paginate(10)->withQueryString();

          


      return view('front.wallet.wallet-history',compact('transactions','currencies','currency_types','walletType','currentCurrency','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type='',$typename='',$currency='',$currencyname='')
    {

        $currency_types=\App\Models\CurrencyType::where('id','!=',3)->get();

        $wallets=\Auth::user()->wallet()->get();
        

        
        $currentCurrency=$currency;


        $walletType=new \App\Models\CurrencyType;

        if($type)
        {

          $walletType=$walletType->find($type);
          $currencies=\App\Models\Currency::where('type_id',$type)->get();

        }
        else
        {
            $currencies=\App\Models\Currency::where('type_id',$currency_types[0]->id)->get();
        }

       
       $allCurrencies=\App\Models\Currency::all();

        return view('front.wallet.wallet-deposit',compact('currency_types','walletType','currencies','currentCurrency','wallets','allCurrencies'));

       

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    
        $request->validate(['quantity' =>'required|numeric','currency_id'=>'required|numeric','transaction_image'=>'required']);


        $fileName=time().'____'.$request->file('transaction_image')->getClientOriginalName();

       $media=\MediaUploader::fromSource($request->transaction_image)
                               ->useFilename($fileName)
                              ->toDirectory('transactions')
                               ->upload();

       $type='deposit'; 


        if($this->makeTransaction($request,$type,$media))
        {

          return redirect()->back()->with('success','The deposit request is created.');

        }






       

       

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($type=1)
    {
          $user = Auth::user();



         $walletTypes=\App\Models\CurrencyType::where('id','!=',3)->get();

          $currencies=\App\Models\Currency::where('type_id',$type)->paginate(10);


     

        $walletType = \App\Models\CurrencyType::find($type);


 
        return view('front.wallet.wallet-transactions',compact('walletType','currencies','walletTypes'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function withdraw_history($type='',$typename='')
    {
      $currency_types=\App\Models\CurrencyType::where('id','!=',3)->get();
       

      $walletType=new \App\Models\CurrencyType;


      if($type)
        {

          $walletType=$walletType->find($type);
          $currencies=\App\Models\Currency::where('type_id',$type)->get();

        }
        else
        {
            $currencies=\App\Models\Currency::where('type_id',$currency_types[0]->id)->get();
             $type=$currency_types[0]->id;
        }

        $transactions= \App\Models\Transaction::where('type',2)
                                  ->whereHas('currency', function ($query)use ($type) {
                                          $query->where('type_id',$type);

                                        })->paginate(10);


      return view('front.wallet.wallet-withdraw-history',compact('transactions','currencies','currency_types','walletType'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_withdraw($type='',$typename='',$currency='',$currencyname='')
    {

        $currency_types=\App\Models\CurrencyType::where('id','!=',3)->get();

        
        $currentCurrency=$currency;

        $wallets=\Auth::user()->wallet()->where('wallet_type','!=',3)->get();



        $walletType=new \App\Models\CurrencyType;

        if($type)
        {

          $walletType=$walletType->find($type);
          $currencies=\App\Models\Currency::where('type_id',$type)->get();

        }
        else
        {
            $currencies=\App\Models\Currency::where('type_id',$currency_types[0]->id)->get();
        }

           $allCurrencies=\App\Models\Currency::all();


        return view('front.wallet.wallet-withdraw',compact('currency_types','walletType','currencies','currentCurrency','wallets','allCurrencies'));

       

    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_withdraw(Request $request)
    {

    
        $request->validate(['quantity' =>['required','numeric',new \App\Rules\CheckWalletBalance($request)],'currency_id'=>'required|numeric','address'=>'required']);

        $type='withdraw';  //for withdraw
 
        if($this->makeTransaction($request,$type))
        {

          return redirect()->back()->with('success','The withdraw request is created.');

        }
       
    }

    public function makeTransaction($request,$type,$media='')
    {
         $user = Auth::user();


        $wallet=$user->wallet()->where('currency_id',$request->currency_id)->first();


        $balance_before_trans=$wallet?$wallet->sum('coin'):0;

      
        $request->merge(['type'=>$type,
                         'trans_amount'=>$request->quantity,
                         ]);

       $transaction = $user->transactions()->create($request->all());
     
       if($media)
       {
         
          $transaction->attachMedia($media,'file');

       }

       $transaction->trans_id = generate_unique_id();

       $transaction->balance_before_trans = $balance_before_trans;

       return $transaction->save();
    }

     public function p2p()
    {
          $user = Auth::user();



         //$walletTypes=\App\Models\CurrencyType::where('id','!=',3)->get();

          $currencies=\App\Models\Currency::where('type_id',1)->paginate(10);


     

        $walletType = \App\Models\CurrencyType::find(3);


 
        return view('front.wallet.p2p-wallet',compact('walletType','currencies'));
    }


     
}
