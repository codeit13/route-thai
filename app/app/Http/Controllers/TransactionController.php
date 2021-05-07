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
      return view('front.wallet-deposit-history');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currency_types  =  CurrencyType::all(); 
        return view('front.wallet-deposit',compact('currency_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    
        $request->validate(['quantity' =>'required','transaction_image']);

        $user = Auth::user();

        $wallet = $user->wallet()->where('currency_id',$request->currency_id)->first();


        $balance_before_trans = $wallet?$wallet->sum('coin'):0;

        $request->merge(['type'=>1,
                         'trans_amount'=>$request->quantity,
                         ]);

       $transaction = $user->transactions()->create($request->all());

       $media = MediaUploader::fromSource($request->transaction_image)
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

        $transactions = $user->transactions()->select('*')->selectRaw('sum(trans_amount) as total')->where('status','approved')->whereHas('currency', function ($query)use ($type) {
        $query->where('type_id',$type);
    })->groupBy('currency_id')->paginate(10);


        $walletType = \App\Models\CurrencyType::find($type);

 
        return view('front.wallet-transactions',compact('transactions','walletType'));
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
