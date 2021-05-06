<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($type)
    {
        $user=\App\Models\User::find(1);

        $transactions=$user->transactions()->select('*')->selectRaw('sum(trans_amount) as total')->whereHas('currency', function ($query)use ($type) {
        $query->where('type_id',$type);
    })->groupBy('currency_id')->paginate(10);


        $walletType=\App\Models\CurrencyType::find($type);

 
        return view('front.wallet-transactions',compact('transactions','walletType'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $currency_types=\App\Models\CurrencyType::all();

    //     foreach($currency_types[0]->currency as $currency):
    //         echo '<pre>';print_r($currency->getMedia('icon')->first()->getDiskPath());die;

    // endforeach;

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



        $request->validate(['quantity'=>'required']);

         

        



        $user=\App\Models\User::find(1);

        $wallet=$user->wallet->find($request->currency_id);

        $balance_before_trans=$wallet->sum('coin');



        $request->merge(['type'=>1,
                         'trans_amount'=>$request->quantity,
                         ]);



       $transaction=$user->transactions()->create($request->all());

       $media=\MediaUploader::fromSource($request->transaction_image)
                               ->toDirectory('transactions')
                               ->upload();

       $transaction->attachMedia($media,'file');

       $transaction->trans_id=generate_unique_id();

       $transaction->balance_before_trans=$balance_before_trans;

       $transaction->save();



        return redirect()->back()->with('success','The deposit is created.');



       

       

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
