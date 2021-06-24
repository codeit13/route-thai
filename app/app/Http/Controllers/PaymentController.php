<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use App\Models\BuyerRequest;
use Illuminate\Http\Request;
use App\Notifications\Notify;
use Auth;

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
                                                    ->first();
    
        if ($transaction->type == 'buy') {
            $transaction = Transaction::find($transaction->receiver_id);
        }
    
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
                $transaction->createBuyerTransaction();

                // Message for Buyer
                // $Message = "Your Buying Order is pending it\'s payment.\n Transaction ID: " . $transaction->trans_id;
                // Notify::sendMessage([
                //     'sms_notification' => $user->sms_notification,
                //     'mobile' => $user->mobile,
                //     'telegram_notification' => $user->telegram_notification,
                //     'telegram_user_id' => $user->telegram_user_id,
                //     'line_notification' => $user->line_notification,
                //     'line_user_id' => $user->line_user_id,
                //     'email_notification' => $user->email_notification,
                //     'email_id' => $user->email,
                //     'Message' => $Message,
                // ]);
                
                // Message for Seller
                $Message = "[Route-Thai] P2P Order (Ending with " . substr($transaction->id, -4) . ") of " . $transaction->quantity . " " . $transaction->currency->name . " has been successfully matched with a Buyer. Login now to complete the order.";
                Notify::sendMessage([
                    'sms_notification' => $transaction->user->sms_notification,
                    'mobile' => $transaction->user->mobile,
                    'telegram_notification' => $transaction->user->telegram_notification,
                    'telegram_user_id' => $transaction->user->telegram_user_id,
                    'line_notification' => $transaction->user->line_notification,
                    'line_user_id' => $transaction->user->line_user_id,
                    'email_notification' => $transaction->user->email_notification,
                    'email_id' => $transaction->user->email,
                    'Message' => $Message,
                ]);

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
            $transaction->buyer_trans->update(['rejected']);
        }
        $Message = "[Route-Thai] P2P Order (Ending with " . substr($transaction->id, -4) . ") has been canceled because payment was not transferred in time. Contact Customer Support if you have any questions.";

        // Message for Buyer
        Notify::sendMessage([
            'sms_notification' => $user->sms_notification,
            'mobile' => $user->mobile,
            'telegram_notification' => $user->telegram_notification,
            'telegram_user_id' => $user->telegram_user_id,
            'line_notification' => $user->line_notification,
            'line_user_id' => $user->line_user_id,
            'email_notification' => $user->email_notification,
            'email_id' => $user->email,
            'Message' => $Message,
        ]);

        // Message for Seller
        Notify::sendMessage([
            'sms_notification' => $transaction->user->sms_notification,
            'mobile' => $transaction->user->mobile,
            'telegram_notification' => $transaction->user->telegram_notification,
            'telegram_user_id' => $transaction->user->telegram_user_id,
            'line_notification' => $transaction->user->line_notification,
            'line_user_id' => $transaction->user->line_user_id,
            'email_notification' => $transaction->user->email_notification,
            'email_id' => $transaction->user->email,
            'Message' => $Message,
        ]);

        return view('front.payment.payment-request-cancel',compact('transaction'));
    }

    public function release($transaction)
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
        elseif(!$buyer_request->is_expired && $buyer_request->status=='open')
        {
            BuyerRequest::where('transaction_id',$transaction->id)
                            ->where('user_id',auth()->user()->id)
                            ->update(['status'=>'pending']);
            //  Message for Buyer
            // $Message = 'Payment for your Buy Order has been completed.';
            // Notify::sendMessage([
            //     'sms_notification' => $user->sms_notification,
            //     'mobile' => $user->mobile,
            //     'telegram_notification' => $user->telegram_notification,
            //     'telegram_user_id' => $user->telegram_user_id,
            //     'line_notification' => $user->line_notification,
            //     'line_user_id' => $user->line_user_id,
            //     'email_notification' => $user->email_notification,
            //     'email_id' => $user->email,
            //     'Message' => $Message,
            // ]);
            
            // Message for Seller
            $Message = "[Route-Thai] The buyer has marked P2P ( Order " . substr($transaction->trans_id, -4) . " ) as paid. Please release the crypto ASAP after confirming that payment has been received.";
            Notify::sendMessage([
                'sms_notification' => $transaction->user->sms_notification,
                'mobile' => $transaction->user->mobile,
                'telegram_notification' => $transaction->user->telegram_notification,
                'telegram_user_id' => $transaction->user->telegram_user_id,
                'line_notification' => $transaction->user->line_notification,
                'line_user_id' => $transaction->user->line_user_id,
                'email_notification' => $transaction->user->email_notification,
                'email_id' => $transaction->user->email,
                'Message' => $Message,
            ]);
            
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

            // Message for Buyer
            $Message = "[Route-Thai] P2P Order (Ending with " . substr($transaction->trans_id, -4) . ") has been completed. The seller has released " . $transaction->quantity . " " . $transaction->currency->name . " to your P2P wallet.";
            Notify::sendMessage([
                'sms_notification' => $user->sms_notification,
                'mobile' => $user->mobile,
                'telegram_notification' => $user->telegram_notification,
                'telegram_user_id' => $user->telegram_user_id,
                'line_notification' => $user->line_notification,
                'line_user_id' => $user->line_user_id,
                'email_notification' => $user->email_notification,
                'email_id' => $user->email,
                'Message' => $Message,
            ]);

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
