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

      $user=\Auth::user();
       

      $walletType=new \App\Models\CurrencyType;

      $transaction_type=$request->type??'deposit';


      if($type)
        {

          $walletType=$walletType->find($type);
          $currencies=\App\Models\Currency::where('type_id',$type)->get();

        }
        else
        {
            $currencies=\App\Models\Currency::where('type_id',$currency_types[0]->id)->get();
             $type=$currency_types[0]->id;
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
      

                                        })->paginate(10)->withQueryString();

          


      return view('front.wallet.wallet-history',compact('transactions','currencies','currency_types','walletType','currentCurrency','request'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($type='',$typename='',$currency='',$currencyname='')
    {

        $currency_types=\App\Models\CurrencyType::where('id','!=',3)->get();

        $wallets=\Auth::user()->wallet()->get();
        

        
        $currentCurrency=$currency;


        $walletType=new \App\Models\CurrencyType;

        if($type)
        {

          $walletType=$walletType->find($type);
          $currencies=\App\Models\Currency::where('type_id',$type)->get();

        }
        else
        {
            $currencies=\App\Models\Currency::where('type_id',$currency_types[0]->id)->get();
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

    
        $request->validate(['quantity' =>'required|numeric','currency_id'=>'required|numeric','transaction_image'=>'required']);


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
    public function show($type=1)
    {
          $user = Auth::user();



         $walletTypes=\App\Models\CurrencyType::where('id','!=',3)->get();

          $currencies=\App\Models\Currency::where('type_id',$type)->paginate(10);


     

        $walletType = \App\Models\CurrencyType::find($type);


 
        return view('front.wallet.wallet-transactions',compact('walletType','currencies','walletTypes'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function withdraw_history($type='',$typename='')
    {
      $currency_types=\App\Models\CurrencyType::where('id','!=',3)->get();
       

      $walletType=new \App\Models\CurrencyType;


      if($type)
        {

          $walletType=$walletType->find($type);
          $currencies=\App\Models\Currency::where('type_id',$type)->get();

        }
        else
        {
            $currencies=\App\Models\Currency::where('type_id',$currency_types[0]->id)->get();
             $type=$currency_types[0]->id;
        }

        $transactions= \App\Models\Transaction::where('type',2)
                                  ->whereHas('currency', function ($query)use ($type) {
                                          $query->where('type_id',$type);

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

        $currency_types=\App\Models\CurrencyType::where('id','!=',3)->get();

        
        $currentCurrency=$currency;

        $wallets=\Auth::user()->wallet()->get();
        //$wallets=\Auth::user()->wallet()->where('wallet_type','!=',3)->get();



        $walletType=new \App\Models\CurrencyType;

        if($type)
        {

          $walletType=$walletType->find($type);
          $currencies=\App\Models\Currency::where('type_id',$type)->get();

        }
        else
        {
            $currencies=\App\Models\Currency::where('type_id',$currency_types[0]->id)->get();
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

    
        $request->validate(['quantity' =>['required','numeric',new \App\Rules\CheckWalletBalance($request)],'currency_id'=>'required|numeric','address'=>'required']);

        $type='withdraw';  //for withdraw
 
        if($this->makeTransaction($request,$type))
        {

          return redirect()->back()->with('success','The withdraw request is created.');

        }
       
    }

    public function makeTransaction($request,$type,$media='')
    {
         $user = Auth::user();


        $wallet=$user->wallet()->where('currency_id',$request->currency_id)->where('wallet_type','!=',3)->first();


        $balance_before_trans=$wallet?$wallet->coin:0;

      
        $request->merge(['type'=>$type,
                         'trans_amount'=>$request->quantity,
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

     public function p2p()
    {
          $user = Auth::user();



         //$walletTypes=\App\Models\CurrencyType::where('id','!=',3)->get();

          $currencies=\App\Models\Currency::where('type_id',1)->paginate(10);


     

        $walletType = \App\Models\CurrencyType::find(3);


 
        return view('front.wallet.p2p-wallet',compact('walletType','currencies'));
    }


    public function sortedCurrencies()
    {
      

      $wallets=auth()->user()->wallet()->where('wallet_type','!=',2)->get();

      $currencies=$existing_currencies=[];

     

      foreach ($wallets as $key => $wallet) {

        if($wallet->coin > 0)
        {
            

            if($wallet->currency->hasMedia('icon')){
             $wallet->currency->img=$wallet->currency->firstMedia('icon')->getUrl();

        }
        else
        {
            $wallet->currency->img='';
        }

            // if(!in_array($wallet->currency_id,$existing_currencies))
            // {
              $wallet->currency->wallet_type=$wallet->wallet_type;
              $currencies[]=$wallet->currency->toArray();

            //   $existing_currencies[]=$wallet->currency_id;
               
            // }


        }
      }

     //echo '<pre>';print_r($currencies);die;

      return $currencies;
    }


    public function transfer(Request $request)
    {
         $type=1;

         $wallet_to=3;

         if($request->wallet_from=='p2p')
         {
             $type=3;

             $wallet_to=1;
         }

        // echo '<pre>';print_r($wallet_to);die;

         $request->merge(['currency_id'=>$request->transfer_currency_id]);
       
         $request->validate(['transfter_quantity' =>['required','numeric',new \App\Rules\CheckWalletBalance($request,$type)],'transfer_currency_id'=>'required|numeric','wallet_from'=>'required','wallet_to'=>'required']);
          $user=auth()->user();

         $wallet=$user->wallet()->where('currency_id',$request->currency_id)->where('wallet_type',$type)->first();


        $balance_before_trans=$wallet?$wallet->coin:0;


         $transaction=array('trans_amount'=>$request->transfter_quantity,'wallet_from'=>$type,'wallet_to'=>$wallet_to,'type'=>'transfer','currency_id'=>$request->currency_id,'balance_before_trans'=>$balance_before_trans,'trans_id'=>$this->generateID());


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
