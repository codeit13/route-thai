<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Currency;

class ExchangeController extends Controller
{
    public function index(Request $request){
    	$transactions = Transaction::with('currency')
                                    ->with('fiat_currency')
                                    ->where('status','pending')
								 	->where('type','sell')
                                    ->withCount(['buyer_requests'=>function($query){
                                        $query->where('status','open');
                                    }])
								 	->where('user_id','!=',auth()->user()->id);

        if ($request->get('search') != '') {
            $transactions->where('trans_amount','>=',$request->get('search'));
        }

        if ($request->get('currency_id') != '') {
            $transactions->where('currency_id',$request->get('currency_id'));
        }

        if ($request->get('fiat_currency_id') != '') {
            $transactions->where('fiat_currency_id',$request->get('fiat_currency_id'));
        }

		$transactions = $transactions->get();		

        $crypto_currencies = Currency::where('type_id',1)->get();
        $fiat_currencies = Currency::where('type_id',2)->get();                                    					 	          
    	return view('front.exchange',compact(
            'transactions',
            'crypto_currencies',
            'fiat_currencies'
        ));
    }
}