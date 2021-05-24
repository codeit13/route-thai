<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PaymentMethods;
use App\Models\UserPaymentMehods;
use App\Http\Requests\AddPaymentMethodRequest;
use Auth;

class UserPaymentMethodsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_methods = PaymentMethods::all();
        return view('front.user.payments',compact('payment_methods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($mode)
    {
        $payment_method = PaymentMethods::where('name',$mode)->first();
        return view('front.user.add_payment',compact('payment_method'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddPaymentMethodRequest $request)
    {
        // dd($request);
        $pm = $request->except('_token');
        $pm['payment_method_id'] = (int)$request->payment_method_id;
        $pm['user_id'] = Auth::user()->id;
        $pMethod  = UserPaymentMehods::create($pm);
        if($request->hasFile('qr-code')) {
            $media = MediaUploader::fromSource($request->file('qr-code'))
                ->toDestination('uploads', 'payment/qrs')
                ->upload();
                $pMethod->attachMedia($media, ['qr']);
        }
        return redirect()->route('user.payments')->with('message','The payment method has been added.');
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
        $user_payment_method = UserPaymentMehods::find($id);
        $payment_method = PaymentMethods::find($user_payment_method->payment_method_id);
        
        return view('front.user.edit_payment',compact('payment_method','user_payment_method'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddPaymentMethodRequest $request, $id)
    {   
        $upm = UserPaymentMehods::find($id);
        $upm->account_number = $request->account_number;
        $upm->account_label = $request->account_label;
        $upm->ifs_code = $request->has('ifs_code') ? $request->ifs_code : $upm->ifs_code; 
        $upm->bank_name = $request->has('bank_name') ? $request->bank_name : $upm->bank_name;
        $upm->type = $request->has('type') ? $request->type : $upm->type;
        $upm->update();
        return redirect()->route('user.payments')->with('message','The payment method has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        UserPaymentMehods::destroy($id);
        return redirect()->route('user.payments')->with('message','The payment method has been deleted.');
    }
}
