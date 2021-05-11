<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaction;

class TransactionController extends Controller
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
    public function show($type,$name)
    {

        $transactions= Transaction::where('type',1)
                                  ->whereHas('currency', function ($query)use ($type) {
                                          $query->where('type_id',$type);

                                        })->get();

        return view('back.wallet.deposit-requests',compact('transactions'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show_withdraw($type='',$name='')
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


        $transactions= Transaction::where('type',2)
                                  ->whereHas('currency', function ($query)use ($type) {
                                          $query->where('type_id',$type);

                                        })->get();

        return view('back.wallet.withdraw-requests',compact('transactions','currency_types','walletType'));
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

    public function changeStatus($type,\App\Models\Transaction $transaction,$status)
    {
       if($transaction->status!='rejected' && $transaction->status!='approved'){

        if($status=='approved'){
            $this->updateUserWallet($transaction,$type);
        }
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
        if($transaction->user->wallet()->where('currency_id',$transaction->currency_id)->exists())
        {
            $wallet=$transaction->user->wallet()->where('currency_id',$transaction->currency_id)->first();

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
             $transaction->user->wallet()->create(['coin'=>$transaction->trans_amount,'currency_id'=>$transaction->currency_id]);
        }
    }
}
