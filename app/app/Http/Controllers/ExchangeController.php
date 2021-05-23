<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class ExchangeController extends Controller
{
    public function index(Request $request){
    	$transactions = Transaction::where('status','pending')
    								 	->where('type','sell')
    								 	->where('user_id','!=',auth()->user()->id)
    								 	->get();

		echo"<pre>";
		print_r($transactions);
		exit;    								 	

    	return view('front.exchange');
    }
}
