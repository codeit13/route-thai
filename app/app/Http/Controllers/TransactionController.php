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
    public function index($type='',$typename='')
    {
      $currency_types=\App\Models\CurrencyType::all();
       

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

        $transactions= \App\Models\Transaction::where('type',1)
                                  ->whereHas('currency', function ($query)use ($type) {
                                          $query->where('type_id',$type);

                                        })->paginate(10);


      return view('front.wallet.wallet-deposit-history',compact('transactions','currencies','currency_types','walletType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type='',$typename='',$currency='',$currencyname='')
    {

        $currency_types=\App\Models\CurrencyType::all();

        
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


        return view('front.wallet.wallet-deposit',compact('currency_types','walletType','currencies','currentCurrency'));

       

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

       $type=1;  //for deposit


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
    public function show($type)
    {
          $user = Auth::user();


    //     $transactions=$user->transactions()->select('*')->selectRaw('sum(trans_amount) as total')->where('status','approved')->whereHas('currency', function ($query)use ($type) {
    //     $query->where('type_id',$type);
    // })->groupBy('currency_id')->paginate(10);

          $currencies=\App\Models\Currency::where('type_id',$type)->paginate(10);


     

        $walletType = \App\Models\CurrencyType::find($type);


 
        return view('front.wallet.wallet-transactions',compact('walletType','currencies'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function withdraw_history($type='',$typename='')
    {
      $currency_types=\App\Models\CurrencyType::all();
       

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

        $currency_types=\App\Models\CurrencyType::all();

        
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


        return view('front.wallet.wallet-withdraw',compact('currency_types','walletType','currencies','currentCurrency'));

       

    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_withdraw(Request $request)
    {

    
        $request->validate(['quantity' =>'required|numeric','currency_id'=>'required|numeric','address'=>'required']);

        $type=2;  //for withdraw
 
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
}
