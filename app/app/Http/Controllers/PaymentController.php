<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Auth;

use App\Notifications\LaravelTelegramNotification;
use LINE;

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

        // $transaction=\App\Models\Transaction::where('trans_id',$transaction)->first();

        // $buyer_request=$transaction->checkBuyerRequest();

        // if(isset($buyer_request->is_expired) && $buyer_request->is_expired)
        // {
        //     return redirect()->route('payment.order.cancel',$transaction->trans_id);
        // }
        // else if(isset($buyer_request->is_expired) && !$buyer_request->is_expired && $buyer_request->status=='pending')
        // {
        //     return redirect()->route('payment.order.release',$transaction->trans_id);
        // }
        // elseif(!$buyer_request)
        // {
        //     $user=\Auth::user();
        //     $user->buyer_request()->create(['transaction_id'=>$transaction->id]);

        //     $transaction->sendMessage([$transaction->user->mobile],'Your ad has been matched and its pending payment');

        //     $buyer_request=$transaction->checkBuyerRequest();

        // }
        // elseif($buyer_request=='exists')
        // {
        //     return redirect()->back();
        // }

        $transaction=\App\Models\Transaction::where('trans_id',$transaction)
                                                ->where('user_id','!=',auth()->user()->id)
                                                ->first();
        
        if ($transaction) {

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
                $transaction->sendMessage([$transaction->user->mobile],'Your ad has been matched and its pending payment');
                $buyer_request=$transaction->checkBuyerRequest();

            }
            elseif($buyer_request=='exists')
            {
                return redirect()->back();
            }

            return view('front.payment.payment-request',compact('transaction','buyer_request'));
        }    

        return redirect()->back();                                            
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
        $user = Auth::user();
        $transaction=\App\Models\Transaction::where('trans_id',$transaction)->first();
        $buyer_request =$transaction->checkBuyerRequest(); 
        if(isset($buyer_request->is_expired))
        {
            unset($buyer_request->is_expired,$buyer_request->expiry_in);
            $buyer_request->status='cancel';
            $buyer_request->save();
        }
        if($user->telegram_notification) {
            $user->notify(new LaravelTelegramNotification([
                'text' => "Buyer Controller:: Order Cancelled",
                'telegram_user_id' => $user->telegram_user_id,
                ]));
            }
        if($user->line_notification) {
            LINE::pushmessage(
                $user->line_user_id,
                new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('Buyer Controller:: Order Cancelled.')
            );
        }
        return view('front.payment.payment-request-cancel',compact('transaction'));
    }

    public function release($transaction)
    {   $user = Auth::user();
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

             $transaction->sendMessage([$transaction->user->mobile],'Payment for your ad has been completed.');
             if($user->telegram_notification) {
                $user->notify(new LaravelTelegramNotification([
                    'text' => "Buyer Controller:: Payment for your Ad has been completed.",
                    'telegram_user_id' => $user->telegram_user_id,
                    ]));
                }
            if($user->line_notification) {
                LINE::pushmessage(
                    $user->line_user_id,
                    new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('Buyer Controller:: Payment for your Ad has been completed.')
                );
            }
            return view('front.payment.payment-request-release',compact('transaction','buyer_request'));
        }
        return view('front.payment.payment-request-release',compact('transaction','buyer_request'));
    }

    public function confirm($transaction)
    {   
        $user = Auth::user();
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
            if($user->telegram_notification) {
                $user->notify(new LaravelTelegramNotification([
                    'text' => "Buyer Controller:: Transaction completed.",
                    'telegram_user_id' => $user->telegram_user_id,
                    ]));
                }
            if($user->line_notification) {
                LINE::pushmessage(
                    $user->line_user_id,
                    new \LINE\LINEBot\MessageBuilder\TextMessageBuilder('Buyer Controller:: Transaction completed.')
                );
            }
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
