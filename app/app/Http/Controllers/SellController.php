<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\Wallet;
use App\Models\Transaction;
use App\Models\Message;
use App\Models\UserPaymentMethod;
use App\Http\Traits\GenerateTransIDTrait;

use App\Models\User;
use Auth;

use App\Notifications\Notify;

class SellController extends Controller
{
	use GenerateTransIDTrait;
    /**
     * Show the form for creating a new sell.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
    	$step = $request->get('step');
        $trans_id = $request->get('trans_id');

        $transcation =  Transaction::where('trans_id',$trans_id)
                                        ->where('status','pending')
                                        ->where('type','sell')
                                        ->first();

    	$crypto_currencies = Currency::where('is_tradable',1)->where('type_id',1)->get();
    	$fiat_currencies = Currency::where('type_id',2)->get();
        $crypto_ids = $crypto_currencies->pluck('id');

        $current_balance = Wallet::toOptionList(['wallet_type'=>3,'user_id'=>auth()->user()->id]);
        $default_fiat_currency = (auth()->user()->default_currency != '')?Currency::find(auth()->user()->default_currency):Currency::where('type_id',2)->first();
    	
    	if ($step == 2) {
            $sell_data = $request->session()->get('sell_data');
            $selected_currency = Currency::find($sell_data['currency_id']);
            $selected_fiat_currency = Currency::find($sell_data['fiat_currency_id']);
            $user_payment_methods = UserPaymentMethod::with('payment_methods')
                                                        ->with('user')
                                                        ->where('user_id',auth()->user()->id)
                                                        ->where('status','active')
                                                        ->get();
            
    		return view('front.sell.confirm_sell',compact(
                'sell_data',
                'selected_currency',
                'selected_fiat_currency',
                'user_payment_methods',
                'current_balance',
                'transcation',
                'trans_id'
            ));
    	}else{
            // dd($crypto_currencies);
	    	return view('front.sell.index',compact(
	    		'crypto_currencies',
                'default_fiat_currency',
	    		'fiat_currencies',
                'current_balance',
                'transcation',
                'trans_id'
	    	));
    	}
    }

    /**
     * Store a newly created sell in session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveSell(Request $request){
    	$data = $request->all();

    	$this->validate($request,[
    		'currency_id' => 'required',
    		'fiat_currency_id' => 'required',
    		'quantity' => 'required',
    		'trans_amount' => 'required',
    	],[
    		'currency_id.required' => 'Select crypto',
    		'fiat_currency_id.required' => 'Select currency',
    		'quantity.required' => 'Enter quantity',
    		'trans_amount.required' => 'Enter amount',
    	]);
    	
    	$request->session()->put('sell_data', $data);
    	$redirect_url = route('sell.create',['step'=>2]);
		return response()->json(['success'=>true,'redirect_url'=>$redirect_url]);
    }
    /**
     * Store a newly created sell in session.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirmSell(Request $request){
        $user = Auth::user();
        $data = $request->session()->get('sell_data');
        $trans_id = $data['trans_id']; 
        if ($data['trans_id'] == '') {
            $trans_id = $this->generateID();
        }
        $selected_currency = Currency::find($data['currency_id']);
        $selected_fiat_currency = Currency::find($data['fiat_currency_id']);

        $save_sell = Transaction::firstOrNew(['trans_id'=>$trans_id]);
        $save_sell->fill($data);
        $save_sell->trans_id = $trans_id;
        $save_sell->user_id = auth()->user()->id;
        $save_sell->user_payment_method_id = auth()->user()->user_payment_method()->value('id');
        $save_sell->type = 'sell';
        $save_sell->timer = 30;
        $save_sell->save();
        $request->session()->forget('sell_data');
        $response_data = [
            'currency_image' => $selected_currency->getMedia('icon')->first()->getUrl(),
            'currency_name'  => $selected_currency->name,
            'quantity_main'  => $data['quantity'],
            'price_main'     => $data['trans_amount']." ".$selected_fiat_currency->short_name,
            'created_at'     => date('Y-m-d H:i:s',strtotime($save_sell->created_at))
        ];
        $request->session()->forget('sell_data');
        
        $user = Auth::user();
        $Message = "[Route-Thai] P2P Order (Ending with " . substr($trans_id, -4) . ") of " . $data['quantity'] . " " . $selected_currency->name . " has been Successfully created. You will be notified when buyer gets matched.";
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

        return response()->json(['success'=>true,'data'=>$response_data],200);
    }

    /**
     * show buyer request
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function buyRequest($trans_id){
        $transcation = Transaction::with(['buyer_requests'=>function($query){
                                            $query->where('status','!=','cancel');
                                        }])
                                        ->with('currency')
                                        ->with('fiat_currency')
                                        ->withCount(['buyer_requests'=>function($query){
                                            $query->where('status','!=','cancel');
                                        }])
                                        ->where('trans_id',$trans_id)->first();
        
        if ($transcation->buyer_requests_count >0) {
            $user_payment_methods = UserPaymentMethod::with('payment_methods')
                                                        ->with('user')
                                                        ->where('user_id',auth()->user()->id)
                                                        ->where('status','active')
                                                        ->get();
            return view('front.sell.buy_request',compact(
                'user_payment_methods',
                'transcation'
            ));
        }

        return redirect()->back();
    }

    /**
     * check valid buyer exits or not
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function buyRequestConfrim($trans_id){
        $transcation = Transaction::where('trans_id',$trans_id)->first();
        $buyer_trans = $transcation->receiver_id;
        $check_paid = $transcation->buyer_requests->first();
     
        if ($buyer_trans != '' and $check_paid->status == 'pending') {
            $url = route('sell.confirm_receipt',['trans_id'=>$trans_id]);
            return response()->json(['success'=>true,'url'=>$url]);            
        }

        return response()->json(['success'=>false]);
    }

    /**
     * confrim receipt of buyer
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function confirmReceipt($trans_id){
        $transcation = Transaction::with('buyer_requests')
                                        ->with('buyer_trans')
                                        ->with('currency')
                                        ->with('fiat_currency')
                                        ->withCount('buyer_requests')
                                        ->where('trans_id',$trans_id)->first();

        $user_payment_methods = UserPaymentMethod::with('payment_methods')
                                                        ->with('user')
                                                        ->where('user_id',auth()->user()->id)
                                                        ->where('status','active')
                                                        ->get();                                        
        return view('front.sell.confrim_receipt',compact(
            'transcation',
            'user_payment_methods'
        ));
    }

    /**
     * check valid buyer exits or not
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderSuccess($trans_id){
        $transcation = Transaction::with('buyer_requests')
                                        ->with('buyer_trans')
                                        ->withCount('buyer_requests')
                                        ->where('trans_id',$trans_id)->first();
            
        if ($transcation->buyer_requests_count > 0) {
            $user = Auth::user();
            $transcation->update(['status'=>'approved']);
            $transcation->buyer_trans->update(['status'=>'approved','receiver_id'=>$transcation->id]);
            $transcation->buyer_requests->first()->update(['status'=>'paid']);
            $amount = $transcation->quantity;
            $seller_wallet_update = Wallet::firstOrNew([
                                                'currency_id'=>$transcation->currency_id,
                                                'user_id'=>$transcation->user_id,
                                                'wallet_type'=>3
                                            ]);
            $seller_wallet_update->coin = $seller_wallet_update->coin-$amount;
            $seller_wallet_update->user_id = $transcation->user_id;
            $seller_wallet_update->save();

            $buyer_wallet_update = Wallet::firstOrNew([
                                                'currency_id'=>$transcation->currency_id,
                                                'user_id'=>$transcation->buyer_trans->user_id,
                                                'wallet_type'=>3
                                            ]);
            $buyer_wallet_update->coin = $buyer_wallet_update->coin+$amount;
            $buyer_wallet_update->user_id = $transcation->buyer_trans->user_id;
            $buyer_wallet_update->save();                                            

            Message::where('from_user',$transcation->user_id)
                        ->where('to_user',$transcation->buyer_trans->user_id)
                        ->delete();

            Message::where('to_user',$transcation->user_id)
                        ->where('from_user',$transcation->buyer_trans->user_id)
                        ->delete();                        

            $user_payment_methods = UserPaymentMethod::with('payment_methods')
                                                        ->with('user')
                                                        ->where('user_id',auth()->user()->id)
                                                        ->where('status','active')
                                                        ->get();     
                                 
            // Message for Seller
            $Message = "[Route-Thai] P2P Order (Ending with " . substr($transcation->trans_id, -4) . ") has been completed. You have released " . $transcation->quantity . " " . $transcation->currency->name . " to the buyer.";
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

            return view('front.sell.success',compact(
                'transcation',
                'user_payment_methods'
            ));
        }

        if ($transcation->status == 'approved') {
            $transcation = Transaction::with('buyer_requests')
                                        ->with('buyer_trans')
                                        ->withCount('buyer_requests')
                                        ->where('trans_id',$trans_id)->first();

            $user_payment_methods = UserPaymentMethod::with('payment_methods')
                                                        ->with('user')
                                                        ->where('user_id',auth()->user()->id)
                                                        ->where('status','active')
                                                        ->get();                                           
            $show = true;                                                        
            return view('front.sell.success',compact(
                'transcation',
                'user_payment_methods',
                'show'
            ));   
        }

        return redirect()->route('home');
    }

    //delete sell
    public function destroy($trans_id){
        $user = Auth::user();
        $user_id = auth()->user()->id;

        $transcation = Transaction::where('trans_id',$trans_id)
                                        ->where('status','pending')
                                        ->where('user_id',$user_id)
                                        ->first();                           

        if ($transcation) {
            $transcation->delete();

            $Message = "[Route-Thai] P2P Order (Ending with " . substr($trans_id, -4) . ") has been deleted.";
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

            return redirect()->back()->with('message_type','success')
                                        ->with('message','Ad removed successfully');
        }

        return redirect()->back()->with('message_type','danger')
                                        ->with('message','Something went wrong');
    }
}
