<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Currency;

class SettingsController extends Controller
{
    
   public function index(){

       $crypto_currencies=[];
       return view('back.settings');
   }     

   public function update(Request $request){
       
        // dd($request);

    echo '<pre>';print_r($request->all());die;
        if($request->has('tradable_coins')) {
           Currency::whereIn('short_name',$request->tradable_coins)->update(['is_tradable' => 1]);
        }
        if($request->has('loanable_coins')) {
            Currency::whereIn('short_name',$request->loanable_coins)->update(['is_loanable' => 1]);
        }
        return redirect()->route('admin.settings');
    }
}
