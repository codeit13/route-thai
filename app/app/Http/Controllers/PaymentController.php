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
    public function show($transaction)
    {
        $transaction=\App\Models\Transaction::where('trans_id',$transaction)->first();

        $buyer_request=$transaction->checkBuyerRequest();



        if(isset($buyer_request->is_expired) && $buyer_request->is_expired)
        {
            return redirect()->route('payment.order.cancel',$transaction->trans_id);
        }
       else if(isset($buyer_request->is_expired) && !$buyer_request->is_expired && $buyer_request->status=='pending')
        {
            return redirect()->route('payment.order.release',$transaction->trans_id);
        }
        elseif(!$buyer_request)
        {

            $user=\Auth::user();

            $user->buyer_request()->create(['transaction_id'=>$transaction->id]);

            $buyer_request=$transaction->checkBuyerRequest();

           

        }
        elseif($buyer_request=='exists')
        {
            return redirect()->back();
        }



         
       
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

    public function cancel($transaction)
    {
       

        $transaction=\App\Models\Transaction::where('trans_id',$transaction)->first();

        $buyer_request =$transaction->checkBuyerRequest(); 
        if(isset($buyer_request->is_expired))
        {
            unset($buyer_request->is_expired,$buyer_request->expiry_in);

            $buyer_request->status='cancel';

            $buyer_request->save();
        }

           return view('front.payment.payment-request-cancel',compact('transaction'));
    }

    public function release($transaction)
    {
        $transaction=\App\Models\Transaction::where('trans_id',$transaction)->first();

        $buyer_request=$transaction->checkBuyerRequest();

        if(isset($buyer_request->is_expired) && $buyer_request->is_expired)
        {
            return redirect()->route('payment.order.cancel',$transaction->trans_id);
        }
        elseif(!$buyer_request || $buyer_request=='exists')
        {

             return redirect()->back();
            
        }
        elseif(!$buyer_request->is_expired && $buyer_request->status=='open')
        {

            $buyer_request=$transaction->createBuyerTransaction();
      

           return view('front.payment.payment-request-release',compact('transaction','buyer_request'));
        }

         return view('front.payment.payment-request-release',compact('transaction','buyer_request'));
    }


    public function confirm($transaction)
    {
        $transaction=\App\Models\Transaction::where('trans_id',$transaction)->first();

        $buyer_request=$transaction->checkBuyerRequest();

        if(isset($buyer_request->is_expired) && $buyer_request->is_expired)
        {
            return redirect()->route('payment.order.cancel',$transaction->trans_id);
        }
        elseif(!$buyer_request || $buyer_request=='exists')
        {

            return redirect()->back();
            
        }
        elseif(!$buyer_request->is_expired && $buyer_request->status=='paid')
        {

           $buyer_request->delete();

           return view('front.payment.payment-request-success',compact('transaction'));
        }
        else
        {
            return redirect()->back();
        }
    }

    public function status($transaction)
    {
        $transaction=\App\Models\Transaction::where('trans_id',$transaction)->first();

        $buyer_request=$transaction->checkBuyerRequest();

        if(isset($buyer_request->is_expired) && $buyer_request->is_expired)
        {
            return array('status'=>1,'action'=>'reload','message'=>'order is expired');
        }
        elseif(!$buyer_request || $buyer_request=='exists')
        {

            return array('status'=>1,'action'=>'reload','message'=>'order is invalid');
            
        }
        elseif(!$buyer_request->is_expired && $buyer_request->status=='paid')
        {

           return array('status'=>1,'action'=>route("payment.order.confirm",$transaction->trans_id),'message'=>'order is completed');
        }

        else
        {
            return array('status'=>1,'action'=>'stay','message'=>'wait for approve');
        }
    }


}
