<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
    public function show()
    {
        $transactions=\App\Models\Transaction::where('type',1)->get();
        return view('back.deposit-requests',compact('transactions'));
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

    public function changeStatus(\App\Models\Transaction $transaction,$status)
    {
       if($transaction->status!='rejected' && $transaction->status!='approved'){

        if($status=='approved'){
            $this->updateUserWallet($transaction);
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

    public function updateUserWallet($transaction)
    {
        if($transaction->user->wallet()->where('currency_id',$transaction->currency_id)->exists())
        {
            $wallet=$transaction->user->wallet()->where('currency_id',$transaction->currency_id)->first();

            $wallet->coin=$wallet->coin+$transaction->trans_amount;

            $wallet->save();



        }
        else
        {
             $transaction->user->wallet()->create(['coin'=>$transaction->trans_amount,'currency_id'=>$transaction->currency_id]);
        }
    }
}
