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
    public function index()
    {
        return view('front.p2p-wallet');
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



        $transaction=['quantity'=>$request->quantity,
                     'currency_id'=>$request->coin_id,
                     'type'=>1,
                     'trans_amount'=>$request->quantity
                     ];

        $user=\App\Models\User::find(1);

       $transaction=$user->transactions()->create($transaction);

       $transaction->trans_id=generate_unique_id();

       $transaction->save();

        echo '<pre>';print_r($transaction);die;
        
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
