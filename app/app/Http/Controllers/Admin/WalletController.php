<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $currencyTypes=\App\Models\CurrencyType::all();

        $type=$request->type;





        $currencies=new \App\Models\Currency;


        if($type==1)
            {
                $currencies=$currencies->where('is_crypto',1);
            }
        if($type==2)
        {
                $currencies=$currencies->where('is_fiat',1);

        }   

         if($type==3)
        {
                $currencies=$currencies->where('is_tradable',1)->where('is_crypto',1);

        }     
          
                $currencies=$currencies->get();
            


        $balances=new \App\Models\Wallet;

        if($type)
            {
           
            // $balances=$balances->whereHas('currency', function ($query)use ($type) {
            //                               $query->where('type_id',$type);

            //                             });

                $balances=$balances->where('wallet_type',$type);

             }

             if($request->currency)
             {
                $balances=$balances->where('currency_id',$request->currency);
             }
            


            $balances=$balances->paginate(10)->withQueryString();

            

        return view('back.wallet.wallet-balance',compact("balances",'currencyTypes','request','currencies'));
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
