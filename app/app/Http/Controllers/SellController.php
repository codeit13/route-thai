<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Currency;
use App\Models\Transaction;
use App\Models\UserPaymentMethod;
use App\Http\Traits\GenerateTransIDTrait;

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
    	$crypto_currencies = Currency::where('type_id',1)->get();
    	$fiat_currencies = Currency::where('type_id',2)->get();
    	
    	if ($step == 2) {
    		return view('front.sell.confirm_sell');
    	}else{
	    	return view('front.sell.index',compact(
	    		'crypto_currencies',
	    		'fiat_currencies'
	    	));
    	}
    }

    /**
     * Store a newly created sell in storage.
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
    	// $trans_id = $this->generateID();

    	// $save_sell = Transaction::firstOrNew(['trans_id'=>$trans_id]);
    	// $save_sell->fill($data);
    	// $save_sell->user_id = auth()->user()->id;
    	// $save_sell->user_payment_method_id = auth()->user()->payment_methods()->value('id');
    	// $save_sell->type = 'sell';
    	// $save_sell->save();

    	$redirect_url = route('sell.create',['step'=>2]);
		return response()->json(['success'=>true,'redirect_url'=>$redirect_url]);
    }
}
