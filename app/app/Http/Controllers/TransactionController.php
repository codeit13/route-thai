<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\CurrencyType;
use MediaUploader;
use App\Http\Traits\GenerateTransIDTrait;

class TransactionController extends Controller
{
  use GenerateTransIDTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$type='',$typename='')
    {

   // echo '<pre>';print_r($request->all());die;
      $currency_types=\App\Models\CurrencyType::where('id','!=',3)->get();

      $currentCurrency='';

      $currencies=[];

      $user=\Auth::user();
       

      $walletType=new \App\Models\CurrencyType;

      $transaction_type=$request->type??'deposit';


      if($type)
        {

          $walletType=$walletType->find($type);
         // $currencies=\App\Models\Currency::whereIn('id',)->get();

        }
        else
        {
            //$currencies=\App\Models\Currency::where('type_id',$currency_types[0]->id)->get();
             $type=1;
        }

        $transactions= $user->transactions()->where('type',$transaction_type);

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


         $transactions= $transactions->whereHas('currency', function ($query)use ($type,$request) {
                                          $query->where('type_id',$type);
      

                                        })->orderby('trans_amount','desc')->paginate(10)->withQueryString();

          

         $filters=$user->transactions()->whereHas('currency', function ($query)use ($type,$request) {
                                          $query->where('type_id',$type);
      

                                        })->get();


      return view('front.wallet.wallet-history',compact('transactions','currencies','currency_types','walletType','currentCurrency','request','filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type='',$typename='',$currency='',$currencyname='')
    {   

      $currency_type='is_crypto';

         if($type==2)
         {
            $currency_type='is_fiat';
         }

        $currency_types=\App\Models\CurrencyType::where('id','!=',3)->get();

        $wallets=\Auth::user()->wallet()->get();
        

        
        $currentCurrency=$currency;


        $walletType=new \App\Models\CurrencyType;

        if($type)
        {

          $walletType=$walletType->find($type);
          $currencies=\App\Models\Currency::where($currency_type,1)->get();

        }
        else
        {
            $currencies=\App\Models\Currency::where($currency_type,1)->get();
        }

       
       $allCurrencies=$this->sortedCurrencies();


       //echo '<pre>';print_r($allCurrencies->toArray());die;

        return view('front.wallet.wallet-deposit',compact('currency_types','walletType','currencies','currentCurrency','wallets','allCurrencies'));

       

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

    
        $request->validate(['quantity' =>'required|numeric|gt:0','currency_id'=>'required|numeric','transaction_image'=>'required|image']);


        $fileName=time().'____'.$request->file('transaction_image')->getClientOriginalName();

       $media=\MediaUploader::fromSource($request->transaction_image)
                               ->useFilename($fileName)
                              ->toDirectory('transactions')
                               ->upload();

       $type='deposit'; 

       
        if($this->makeTransaction($request,$type,$media))
        {

          return redirect()->back()->with('success','The deposit request is created.');

        }






       

       

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request,$type=1)
    {
        $currency_type='is_crypto';

         if($type==2)
         {
            $currency_type='is_fiat';
         }

          $user = Auth::user();



         $walletTypes=\App\Models\CurrencyType::where('id','!=',3)->get();

          $currencies=new \App\Models\Currency;




        $currencies=$currencies->select('currency.*')->leftJoin('wallet', function($join) {
      $join->on('currency.id', '=', 'wallet.currency_id')->where('user_id',auth()->id())->whereIn('wallet_type',[1,2]);
    })->where($currency_type,1);


           if($request->coin)
          {
            $currencies=$currencies->orderBy('short_name',$request->coin);
          }

          $amount_order='desc';

          if($request->amount)
          {
             $amount_order=$request->amount;
          }





       $currencies= $currencies->orderby('wallet.coin',$amount_order)->paginate(10)->withQueryString();

      //    echo '<pre>';print_r($currencies->toArray());die;


     

        $walletType = \App\Models\CurrencyType::find($type);

          $wallets=\Auth::user()->wallet()->get();

        $allCurrencies=$this->sortedCurrencies();


 
        return view('front.wallet.wallet-transactions',compact('walletType','currencies','walletTypes','wallets','allCurrencies','request'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function withdraw_history($type='',$typename='')
    {
        $currency_type='is_crypto';

         if($type==2)
         {
            $currency_type='is_fiat';
         }

      $currency_types=\App\Models\CurrencyType::where('id','!=',3)->get();
       

      $walletType=new \App\Models\CurrencyType;


      if($type)
        {

          $walletType=$walletType->find($type);
          $currencies=\App\Models\Currency::where($currency_type,1)->get();

        }
        else
        {
            $currencies=\App\Models\Currency::where('type_id',1)->where($currency_type,1)->get();

             $type=$currency_types[0]->id;
        }

        $transactions= \App\Models\Transaction::where('type',2)
                                  ->whereHas('currency', function ($query)use ($type) {
                                          $query->where($currency_type,1);

                                        })->paginate(10);


      return view('front.wallet.wallet-withdraw-history',compact('transactions','currencies','currency_types','walletType'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_withdraw($type='',$typename='',$currency='',$currencyname='')
    {
      $currency_type='is_crypto';

         if($type==2)
         {
            $currency_type='is_fiat';
         }

        $currency_types=\App\Models\CurrencyType::where('id','!=',3)->get();

        
        $currentCurrency=$currency;

        $wallets=\Auth::user()->wallet()->get();
        //$wallets=\Auth::user()->wallet()->where('wallet_type','!=',3)->get();



        $walletType=new \App\Models\CurrencyType;

        if($type)
        {

          $walletType=$walletType->find($type);
          $currencies=\App\Models\Currency::where($currency_type,1)->get();

        }
        else
        {
            $currencies=\App\Models\Currency::where($currency_type,1)->get();
        }

           $allCurrencies=$this->sortedCurrencies();




        return view('front.wallet.wallet-withdraw',compact('currency_types','walletType','currencies','currentCurrency','wallets','allCurrencies'));

       

    }


     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store_withdraw(Request $request)
    {

    
        $request->validate(['quantity' =>['required','gt:0','numeric',new \App\Rules\CheckWalletBalance($request)],'currency_id'=>'required|numeric','address'=>'required']);

        $type='withdraw';  //for withdraw
 
        if($this->makeTransaction($request,$type))
        {

          return redirect()->back()->with('success','The withdraw request is created.');

        }
       
    }

    public function makeTransaction($request,$type,$media='')
    {
         $user = Auth::user();

         $wallet_type=\App\Models\Currency::find($request->currency_id)->type_id;


        $wallet=$user->wallet()->where('currency_id',$request->currency_id)->whereIn('wallet_type',[1,2])->first();


        $balance_before_trans=$wallet?$wallet->coin:0;

         $wallet_column=$type=='deposit'?'wallet_to':'wallet_from';
      
        $request->merge(['type'=>$type,
                         'trans_amount'=>$request->quantity,
                          $wallet_column=>$wallet_type,
                         ]);

       $transaction = $user->transactions()->create($request->all());
     
       if($media)
       {
         
          $transaction->attachMedia($media,'file');

       }

       $transaction->trans_id = $this->generateID();

       $transaction->balance_before_trans = $balance_before_trans;

       return $transaction->save();
    }

     public function p2p(Request $request)
    {
          $user = Auth::user();



         //$walletTypes=\App\Models\CurrencyType::where('id','!=',3)->get();


            $currencies=new \App\Models\Currency;




        $currencies=$currencies->select('currency.*')->leftJoin('wallet', function($join) {
      $join->on('currency.id', '=', 'wallet.currency_id')->where('user_id',auth()->id())->where('wallet_type',3);
    })->where('is_tradable',1);


           if($request->coin)
          {
            $currencies=$currencies->orderBy('short_name',$request->coin);
          }

          $amount_order='desc';

          if($request->amount)
          {
             $amount_order=$request->amount;
          }




          $currencies=$currencies->orderBy('wallet.coin',$amount_order)->paginate(10)->withQueryString();


     

        $walletType = \App\Models\CurrencyType::find(3);

        $wallets=\Auth::user()->wallet()->get();

        $allCurrencies=$this->sortedCurrencies();


 
        return view('front.wallet.p2p-wallet',compact('walletType','currencies','wallets','allCurrencies','request'));
    }


    public function loanWallet(Request $request)
    {
         $user = Auth::user();



         //$walletTypes=\App\Models\CurrencyType::where('id','!=',3)->get();


            $currencies=new \App\Models\Currency;




        $currencies=$currencies->select('currency.*')->leftJoin('wallet', function($join) {
      $join->on('currency.id', '=', 'wallet.currency_id')->where('user_id',auth()->id())->where('wallet_type',4);
    })->where('is_loanable',1);


           if($request->coin)
          {
            $currencies=$currencies->orderBy('short_name',$request->coin);
          }

          $amount_order='desc';

          if($request->amount)
          {
             $amount_order=$request->amount;
          }




          $currencies=$currencies->orderBy('wallet.coin',$amount_order)->paginate(10)->withQueryString();


     

       // $walletType = \App\Models\CurrencyType::find(4);

        $wallets=\Auth::user()->wallet()->get();

        $allCurrencies=$this->sortedCurrencies();


 
        return view('front.wallet.loan-wallet',compact('currencies','wallets','allCurrencies','request'));
    }


    public function sortedCurrencies()
    {
      

      $currencies=\App\Models\Currency::all();

      $sorted_currencies=$existing_currencies=[];

     

      foreach ($currencies as $key => $currency) {

     

            if($currency->hasMedia('icon')){
             $currency->img=$currency->firstMedia('icon')->getUrl();

      
              $sorted_currencies[]=$currency->toArray();

      


        }
      }

     //echo '<pre>';print_r($currencies);die;

      return $sorted_currencies;
    }


    public function transfer(Request $request)
    {
         $type=1;

         $wallet_to=3;

         if($request->wallet_from=='3')
         {
             $type=3;

             $wallet_to=1;
         }

        // echo '<pre>';print_r($wallet_to);die;

         $request->merge(['currency_id'=>$request->transfer_currency_id]);
       
         $request->validate(['transfer_quantity' =>['required','numeric','gt:0',new \App\Rules\CheckWalletBalance($request,$type)],'transfer_currency_id'=>'required|numeric','wallet_from'=>'required','wallet_to'=>'required']);
          $user=auth()->user();

         $wallet=$user->wallet()->where('currency_id',$request->currency_id)->where('wallet_type',$type)->first();


        $balance_before_trans=$wallet?$wallet->coin:0;


         $transaction=array('trans_amount'=>$request->transfer_quantity,'wallet_from'=>$type,'wallet_to'=>$wallet_to,'type'=>'transfer','currency_id'=>$request->currency_id,'balance_before_trans'=>$balance_before_trans,'trans_id'=>$this->generateID());


         if($transaction=$user->transactions()->create($transaction))
         {  
            $this->updateUserWallet($transaction,$wallet);

            $transaction->status='approved';

            $transaction->save();

           return redirect()->back()->with('success','The transfer request is created.');
            
             
         }

         else
         {
            return redirect()->back()->with('error','The transfer request is not created.');
         }

    }

    public function updateUserWallet($transaction,$fromWallet)
    {
        $user=auth()->user();

        $toWallet=$user->wallet()->where('currency_id',$transaction->currency_id)->where('wallet_type',$transaction->wallet_to)->first();

        if($toWallet)
        {
            $toWallet->coin=$toWallet->coin+$transaction->trans_amount;
            $toWallet->save();
        }
        else
        {
             $toWallet=array('coin'=>$transaction->trans_amount,'currency_id'=>$transaction->currency_id,'wallet_type'=>$transaction->wallet_to);

             $user->wallet()->create($toWallet);
        }

           $fromWallet->coin=$fromWallet->coin-$transaction->trans_amount;

           $fromWallet->save();
    }

   


     
}
