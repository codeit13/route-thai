<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
         $currency_types=\App\Models\CurrencyType::all();

      $currentCurrency='';

      $type='';

      $user=\Auth::user();
       

      $walletType=new \App\Models\CurrencyType;

      $transaction_type=$request->type??'';


      if($type)
        {

         // $walletType=$walletType->find($type);
          $currencies=\App\Models\Currency::where('type_id',$type)->get();

        }
        else
        {
            $currencies=\App\Models\Currency::where('type_id',$currency_types[0]->id)->get();
             //$type=$currency_types[0]->id;
        }

      

        if($transaction_type)
        {

        $transactions= $user->transactions()->where('type',$transaction_type);
        }
        else
        {
        $transactions= $user->transactions()->where(function($query){
                  $query->where('type','sell')->orWhere('type','buy');
        });

        }

        if($request->status)
        {
          $transactions=$transactions->where('status',$request->status);
        }

        if($request->start_date)
        {
            $start_date = date('Y-m-d',strtotime($request->start_date));

          //echo '<pre>';print_r($start_date);die;
            $transactions=$transactions->whereDate('created_at', '>=', $start_date);
        }

        if($request->end_date)
        {
            $end_date = date('Y-m-d',strtotime($request->end_date));

          //echo '<pre>';print_r($start_date);die;
            $transactions=$transactions->whereDate('created_at', '<=', $end_date);
        }

        if($request->currency && !$request->search)
        {
          $transactions=$transactions->where('currency_id',$request->currency);

          $currentCurrency=$request->currency;
        }

        if($request->search)
        {
          $transactions=$transactions->whereHas('currency', function ($query)use ($request) {
                                          $query->where('name','like',$request->search.'%')->orWhere('short_name','like',$request->search.'%');

                                        });

        }
    

    //->whereHas('currency', function ($query)use ($type,$request) {
                                        //   $query->where('type_id',$type);
      

                                        // })


         $transactions= $transactions->orderBy('created_at','desc')->paginate(10)->withQueryString();

          
       // echo '<pre>';print_r($transactions->toArray());die;


     

        return view('front.trade.history',compact('transactions','currencies','currency_types','walletType','currentCurrency','request'));
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
    public function show($id)
    {
        //
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
}
