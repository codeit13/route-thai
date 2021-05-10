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
    public function index()
    {
      $transactions=Auth::user()->transactions()->where('type',1)->get();

      return view('front.wallet-deposit-history',compact('transactions'));
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


        return view('front.wallet-deposit',compact('currency_types','walletType','currencies','currentCurrency'));

       

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    
        $request->validate(['quantity' =>'required','transaction_image'=>'required']);

        $user = Auth::user();


  



        $wallet=$user->wallet()->where('currency_id',$request->currency_id)->first();



        $balance_before_trans=$wallet?$wallet->sum('coin'):0;

      

        $request->merge(['type'=>1,
                         'trans_amount'=>$request->quantity,
                         ]);

       $transaction = $user->transactions()->create($request->all());


     

       $fileName=time().'____'.$request->file('transaction_image')->getClientOriginalName();

       $media=\MediaUploader::fromSource($request->transaction_image)
                               ->useFilename($fileName)
                              ->toDirectory('transactions')
                               ->upload();

       $transaction->attachMedia($media,'file');

       $transaction->trans_id = generate_unique_id();

       $transaction->balance_before_trans = $balance_before_trans;

       $transaction->save();



        return redirect()->back()->with('success','The deposit is created.');



       

       

        
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


 
        return view('front.wallet-transactions',compact('walletType','currencies'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function withdraw_history()
    {
      return view('front.wallet.wallet-withraw-history');
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
