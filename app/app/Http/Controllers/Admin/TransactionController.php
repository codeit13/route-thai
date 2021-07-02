<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Currency;
use App\Notifications\Notify;
use App\Models\PaymentMethod;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $crypto_currencies = Currency::where('is_tradable',1)->where('type_id',1)->pluck('short_name','id');
        $fiat_currencies = Currency::where('type_id',2)->pluck('short_name','id');
        $payment_methods = PaymentMethod::pluck('name','id');

        $sell = Transaction::where('type','sell');

        if ($request->get('currency') != '') {
            $sell = $sell->where('currency_id',$request->get('currency'));
        }

        if ($request->get('fiat_currency') != '') {
            $sell = $sell->where('fiat_currency_id',$request->get('fiat_currency'));
        }

        if ($request->get('payment_method_id') != '') {
            $sell = $sell->whereHas('user', function ($query) use ($request) {
                $query->whereHas('user_payment_method', function ($query) use ($request) {
                    $query->where('payment_method_id', $request->get('payment_method_id'));
                });
            });
            // $sell = $sell->where('user.user_payment_method.payment_method_id',$request->get('payment_method_id'));
        }

        $sell = $sell->orderBy('created_at','DESC')->get();


        return view('back.trades',compact(
            'sell',
            'crypto_currencies',
            'fiat_currencies',
            'payment_methods'
        ));
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
    public function show(Request $request,$type,$name)
    {
         
        $transactions= Transaction::where('type','deposit');


                        if($request->status)
                        {
                            $transactions=$transactions->where('status',$request->status);
                        }
                                 $transactions=$transactions->whereHas('currency', function ($query)use ($type) {
                                          $query->where('type_id',$type);

                                        })->paginate(10);

        return view('back.wallet.deposit-requests',compact('transactions','request','type','name'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_withdraw(Request $request,$type='',$name='')
    {

        $currency_types=\App\Models\CurrencyType::all();
       

        $walletType=new \App\Models\CurrencyType;


      if($type)
        {

          $walletType=$walletType->find($type);
         // $currencies=\App\Models\Currency::where('type_id',$type)->get();

        }
        else
        {
            //$currencies=\App\Models\Currency::where('type_id',$currency_types[0]->id)->get();
             $type=$currency_types[0]->id;
        }


        $transactions= Transaction::where('type','withdraw');


                        if($request->status)
                        {
                            $transactions=$transactions->where('status',$request->status);
                        }


                                  $transactions=$transactions->whereHas('currency', function ($query)use ($type) {
                                          $query->where('type_id',$type);

                                        })->paginate(10);

        return view('back.wallet.withdraw-requests',compact('transactions','currency_types','walletType','request','type','name'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function view($id)
    {
        $trans = Transaction::where('trans_id',$id)->first();
        return view('back.trade_details',compact('trans'));
    }

    public function updateStatus(Request $request){
        if($request->has('status') && !empty($request->status)) {
            $user = Transaction::find($request->id);
            $user->status = trim($request->status);
            $user->save();
            return response()->json(['status'=>'OK','message'=> __('The statuas has been updated.') ]);
        }
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

    public function changeStatus($type,\App\Models\Transaction $transaction,$status)
    {
       if($transaction->status!='rejected' && $transaction->status!='approved'){

        if($status=='approved'){
            $this->updateUserWallet($transaction,$type);
            // $type == "WITHDRAW";

        }
        if(strtoupper($type)=="WITHDRAW" && $status=="approved") {
            $Message = "[Route-Thai] Withdrawal Request of " . $transaction->quantity . " " . $transaction->currency->name . " has been successfully completed and transferred to your third-party wallet.";
        } else if(strtoupper($type)=="WITHDRAW" && $status=="rejected") {
            $Message = "[Route-Thai] Withdrawal Request of " . $transaction->quantity . " " . $transaction->currency->name . " has been rejected.";
        } else if(strtoupper($type)=="DEPOSIT" && $status=="approved") {
            $Message = "[Route-Thai] Deposit Request of " . $transaction->quantity . " " . $transaction->currency->name . " has been successfully approved and added to your wallet.";
        } else if(strtoupper($type)=="DEPOSIT" && $status=="rejected") {
            $Message = "[Route-Thai] Withdrawal Request of " . $transaction->quantity . " " . $transaction->currency->name . " has been rejected.";
        }

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
         $transaction->status=$status;

         $transaction->save();

         return redirect()->back()->with('success','The status is updated.');
       }
       else
       {
         return redirect()->back()->with('warning','No data affected.');

       }
    }

    public function updateUserWallet($transaction,$type)
    {
        if($transaction->user->wallet()->where('currency_id',$transaction->currency_id)->whereIn('wallet_type',[1,2])->exists())
        {
            $wallet=$transaction->user->wallet()->where('currency_id',$transaction->currency_id)->whereIn('wallet_type',[1,2])->first();

            if($type=='withdraw')
            {
            $wallet->coin=$wallet->coin-$transaction->trans_amount;
                  
            }
            else
            { 

            $wallet->coin=$wallet->coin+$transaction->trans_amount;

            }


            $wallet->save();



        }
        else
        {

             $currency_type=\App\Models\Currency::find($transaction->currency_id)->type_id;
             $transaction->user->wallet()->create(['coin'=>$transaction->trans_amount,'currency_id'=>$transaction->currency_id,'wallet_type'=>$currency_type]);


            
        }   


         // $sms_variables=['VAR1'=>$transaction->user->name,'VAR2'=>$type,'VAR3'=>$transaction->trans_amount,'VAR4'=>$transaction->currency->short_name,'VAR5'=>'approved'];


         //      $this->service = new \App\Services\SMSService();
         //      $res=$this->service->send(['+66630370558'],'RouteDWR',$sms_variables);




    }
    public function remove(Request $request){

        $id = $request['data'];
        foreach ($id as $key => $value) {
            
            Transaction::where('id',$value)->delete();
        }
        return response()->json(['status'=>'OK','message'=>  __('The record has been deleted.') ]);
    }
}
