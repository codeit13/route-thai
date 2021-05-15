<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(\App\Models\Transaction $transaction)
    {
        $buyer_request=$transaction->checkBuyerRequest();

        if(isset($buyer_request->is_expired) && $buyer_request->is_expired)
        {
            return redirect()->route('payment.order.cancel',$transaction->id);
        }
        elseif(!$buyer_request)
        {

            $user=\Auth::user();

            $user->buyer_request()->create(['transaction_id'=>$transaction->id]);

            $buyer_request=$transaction->checkBuyerRequest();

           

        }
        elseif($buyer_request=='exists')
        {
            redirect()->back();
        }

         //echo '<pre>';print_r($transaction->toArray());die;
       
       return view('front.payment.payment-request',compact('transaction','buyer_request'));
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

    public function cancel(\App\Models\Transaction $transaction)
    {
       // $user_id=\Auth::user()->id;

        $buyer_request =$transaction->checkBuyerRequest(); 
        if(isset($buyer_request->is_expired))
        {
            unset($buyer_request->is_expired,$buyer_request->expiry_in);

            $buyer_request->status='cancel';

            $buyer_request->save();
        }

           return view('front.payment.payment-request-cancel',compact('transaction'));
    }

    public function confirm(\App\Models\Transaction $transaction)
    {
        $buyer_request=$transaction->checkBuyerRequest();

        if(isset($buyer_request->is_expired) && $buyer_request->is_expired)
        {
            return redirect()->route('payment.order.cancel',$transaction->id);
        }
        elseif(!$buyer_request || $buyer_request=='exists')
        {

            redirect()->back();
            
        }
        elseif(!$buyer_request->is_expired)
        {

            $transaction->createBuyerTransaction();
           // unset($buyer_request->is_expired,$buyer_request->expiry_in);

            //$buyer_request->status='paid';

           // $buyer_request->save();

           return view('front.payment.payment-request-success',compact('transaction'));
        }
    }


}
