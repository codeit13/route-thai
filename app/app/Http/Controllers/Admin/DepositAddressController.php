<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepositAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currencies=\App\Models\Currency::all();
        $addresses=\App\Models\DepositAddress::paginate(10);
       
        return view('back.deposit-address',compact("addresses","currencies","request"));
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
        $request->validate(['address'=>'required','currency'=>'required']);

        $row=['address'=>$request->address,'admin_id'=>auth()->id()];

        if(\App\Models\DepositAddress::updateOrCreate(['currency_id'=>$request->currency],$row))
        {
            return redirect()->back()->with('success','The address is attaced to the currency');
        }

        else
        {
            return redirect()->back()->with('warning','Unable to perform this action. Please try again later.');
        }
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
    public function edit(\App\Models\DepositAddress $deposit_address)
    {
        $currencies=\App\Models\Currency::all();
        $addresses=\App\Models\DepositAddress::paginate(10);

       
        return view('back.deposit-address',compact("addresses","deposit_address","currencies"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, \App\Models\DepositAddress $deposit_address)
    {

        $deposit_address->address=$request->address;
        $deposit_address->currency_id=$request->currency;

        if($deposit_address->save())
        {
             return redirect()->route('admin.deposit.address')->with('success','The address is attaced to the currency');
        }
        else
        {
            return redirect()->back()->with('warning','Unable to perform this action. Please try again later.');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(\App\Models\DepositAddress $deposit_address)
    {
         if($deposit_address->delete())
        {
            return redirect()->back()->with('success','The address is detached from the currency');
        }

        else
        {
            return redirect()->back()->with('warning','Unable to perform this action. Please try again later.');
        }
    }
}
