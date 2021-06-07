<?php

namespace App\Http\Controllers;

use App\Models\LoanRequest;
use Illuminate\Http\Request;
use App\Models\Loan;

class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('front.loan.history');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $currencies=\App\Models\Currency::where('is_crypto',1)->get();

        $fiat_currencies=\App\Models\Currency::where('is_fiat',1)->get();

        $ExchangeRatesService=new \App\Services\ExchangeRatesService;

        $crypto_rates=$ExchangeRatesService->crypto_rates();

        $fiat_rates=$ExchangeRatesService->fiat_rates();

        $terms=array((object)['id'=>1,'days'=>30,'percentage'=>90],(object)['id'=>2,'days'=>30,'percentage'=>60],(object)['id'=>3,'days'=>60,'percentage'=>90]);

        $price_down=(object)(['percentage'=>5]);
        


        $wallets=auth()->user()->wallet;

        



        

        return view('front.loan.request',compact('currencies','wallets','fiat_currencies','crypto_rates','fiat_rates','terms','price_down'));
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
     * @param  \App\Models\LoanRequest  $loanRequest
     * @return \Illuminate\Http\Response
     */
    public function show(Loan $loan)
    {
       return view('front.loan.request-detail');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LoanRequest  $loanRequest
     * @return \Illuminate\Http\Response
     */
    public function edit(Loan $loan)
    {
        return view('front.loan.detail');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LoanRequest  $loanRequest
     * @return \Illuminate\Http\Response
     */
    public function status(Request $request, Loan $loan)
    {
        return view('front.loan.status');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LoanRequest  $loanRequest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Loan $loan)
    {
        //
    }
}
