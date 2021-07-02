<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User; 
use App\Models\Loan;
use App\Notifications\Notify;
use Yajra\Datatables\Datatables;


class LoanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return view('back.loan.index');
    }

    public function loans()
    {
        return view('back.loan.loans');
    }

    public function loanData()
    {
       // echo 'fsdflslf';die;
        $loans = Loan::with(['user','loan_currency','collateral_currency'])->whereIn('status',['pending']);

          return $this->makeTable($loans);
        
       //return Datatables::of($loans)->make(true);
    }

    public function loanUpdated(Request $request)
    {
       // echo 'fsdflslf';die;
        $loans = Loan::with(['user','loan_currency','collateral_currency'])->whereNotIn('status',['pending']);

        if($request->status)
        {
            $loans=$loans->where('status',$request->status);
        }

          return $this->makeTable($loans);
        
       //return Datatables::of($loans)->make(true);
    }


    public function makeTable($loans)
    {
        return Datatables::of($loans)

           ->addColumn('detail_link',function($loan){
              return '<a class="text-info" href="'.route('admin.loan.show',['loan'=>$loan->loan_id]).'">
                       Details
                      </a>';
           })
            ->addColumn('action', function ($loan) {

                $action='<div class="dropdown">';

                      switch($loan->status){


                      case 'pending':

                      $action.='
                       <a class="btn btn-sm btn-icon-only text-info d-inline-flex w-25" href="'.route('admin.loan.show',['loan'=>$loan->loan_id]).'">
                        <i class="fa fa-info m-auto"></i>
                      </a>
                      <a class="btn btn-sm btn-icon-only text-success w-25 d-inline-flex"  href="'.route('admin.loan.update.status',['id'=>$loan->id, 'status'=>'approved']).'">
                        <i class="fa fa-check m-auto"></i>
                      </a>

                      <a class="btn btn-sm btn-icon-only text-danger d-inline-flex w-25" href="'.route('admin.loan.update.status',['id'=>$loan->id, 'status'=>'rejected']).'">
                        <i class="fa fa-times m-auto"></i>
                      </a>
                       '; 



                      break;


                      case 'approved':

                     $action.=' <span class="btn-sm text-green p-0" style="margin:0 -12px;">APPROVED</span>';


                      break;


                       case 'rejected':
                     
                    $action.='<span class="btn-sm text-red p-0" style="margin:0 -12px;">REJECTED</span>';

                      break;

                      default:
                       
                     $action.='<span class="btn-sm text-red p-0" style="margin:0 -12px;">'.strtoupper($loan->status).'</span>';


                      break;


                      }

                    $action.='</div>'; 
                    return $action;
            })

            ->addColumn('user', function ($loan) {
                return '<div class="media-body text-left">
                      <span class="name mb-0 text-sm">'.$loan->user->name.'</span>
                    </div>';
            })

             ->editColumn('term_percentage', function ($loan) {
                return $loan->term_percentage.'% ('.$loan->duration.' '.$loan->duration_type.')';
            })

            ->editColumn('loan_amount',function($loan){
                $loan_info='<div class="media align-items-center">
                      <a href="#" class="rounded-circle mr-2">';
                      if($loan->loan_currency->hasMedia('icon'))
                      {
                         $loan_info.='<img alt="Image placeholder" width="20" src="'.$loan->loan_currency->firstMedia('icon')->getUrl().'">';
                      }
                        
                    $loan_info.=' </a>
                      <div class="media-body text-left">
                        <span class="name mb-0 text-sm">'.$loan->loan_amount.'</span>
                      </div>
                    </div>';

                    return $loan_info;

            })
            ->editColumn('created_at',function($loan)
            {
               return date('d-m-Y', strtotime($loan->created_at));
            })

            ->addColumn('collateral_info',function($loan){
                $collateral_info='<div class="media align-items-center">
                      <a href="#" class="rounded-circle mr-2">';
                      if($loan->collateral_currency->hasMedia('icon'))
                      {
                         $collateral_info.='<img alt="Image placeholder" width="20" src="'.$loan->collateral_currency->firstMedia('icon')->getUrl().'">';
                      }
                        
                    $collateral_info.=' </a>
                      <div class="media-body text-left">
                        <span class="name mb-0 text-sm">'.$loan->collateral_amount.'</span>
                      </div>
                    </div>';

                    return $collateral_info;
            })


            ->removeColumn('password')
            ->rawColumns(['collateral_info','loan_amount','user','action','detail_link'])
            ->make(true);
    }

    public function updateStatus($id, $status){
        
            $loan_detail = Loan::find($id);
            $loan_detail->status = trim($status);

            $user=$loan_detail->user;
            

         if($status=='approved')
        {

            $wallet=$user->wallet()->where('wallet_type',1)->where('currency_id',$loan_detail->currency_id)->first();

           // $wallet->coin=$wallet->coin-$loan_detail->collateral_amount;

           // $wallet->save();

            $loanWallet=$user->wallet()->where('currency_id',$loan_detail->loan_currency->id)->where('wallet_type',4)->first();

            if($loanWallet)
            {
                $loanWallet->coin=$loanWallet->coin+$loan_detail->loan_amount;
                $loanWallet->save();
            }
            else
            {
                $newWallet=array('currency_id'=>$loan_detail->loan_currency->id,
                                 'coin'=>$loan_detail->loan_amount,
                                 'wallet_type'=>4,
                                 '');
                $user->wallet()->create($newWallet);
            }

            $repay_date=$this->repay_date($loan_detail);

            $loan_detail->repay_date=$repay_date;

            $loan_detail->status='approved';

            $loan_detail->save();

           

            $notification='[Route-Thai] Loan request (Ending with '.substr($loan_detail->loan_id,-4).') with Collateral of '.$loan_detail->collateral_amount.' '.$loan_detail->collateral_currency->short_name.' and Loan amount '.$loan_detail->loan_amount.' '.$loan_detail->loan_currency->short_name.', Validity of '.$loan_detail->duration.' '.$loan_detail->duration_type.' has been successfully approved. The Loan amount transferred to your Loan wallet.';
        }
        elseif ($status=='rejected') {

            $loan_detail->status='rejected';

            $loan_detail->save();

            $notification='[Route-Thai] Loan request (Ending with '.substr($loan_detail->loan_id,-4).') with Collateral of '.$loan_detail->collateral_amount.' '.$loan_detail->collateral_currency->short_name.' and Loan amount '.$loan_detail->loan_amount.' '.$loan_detail->loan_currency->short_name.', Validity of '.$loan_detail->duration.' '.$loan_detail->duration_type.' has been rejected. Please contact support for more details.';
        }

        elseif ($status=='close') {

            $loan_detail->status='close';

            $loan_detail->save();

            $notification='[Route-Thai] Loan request (Ending with '.substr($loan_detail->loan_id,-4).') with Collateral of '.$loan_detail->collateral_amount.' '.$loan_detail->collateral_currency->short_name.' and Loan amount '.$loan_detail->loan_amount.' '.$loan_detail->loan_currency->short_name.', Validity of '.$loan_detail->duration.' '.$loan_detail->duration_type.' has been successfully closed .';
        }

          Notify::sendMessage([
            'sms_notification' => $user->sms_notification,
            'mobile' => $user->mobile,
            'telegram_notification' => $user->telegram_notification,
            'telegram_user_id' => $user->telegram_user_id,
            'line_notification' => $user->line_notification,
            'line_user_id' => $user->line_user_id,
            'email_notification' => $user->email_notification,
            'email_id' => $user->email,
            'Message' => $notification,
        ]);

        return redirect()->back()->with('success','Loan status is updated successfully.');


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
        $loan=Loan::whereLoanId($id)->first();

        $loan->usdt_currency=\App\Models\Currency::where('short_name','USDT')->first();

        $loan->current_value='0.000';

     //   $loan->current_value=$this->get_crypto_exchange_row($loan->collateral_currency)->lastPrice;

      //  echo '<pre>';print_r($loan->toArray());die;

        return view('back.loan.loan-detail',compact('loan'));
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

        $user = User::with('user_payment_methods')->find($id);
        $user->user_payment_methods->delete();
        $user->transactions->delete();
        $user->delete();
        return redirect()->route('admin.users')->with('message','The user has been deleted.');
    }

       public function get_crypto_exchange_row($cryptoRow)
{
    $ExchangeRatesService=new \App\Services\ExchangeRatesService;



     $crypto_rates=collect(json_decode($ExchangeRatesService->crypto_rates()));

     $this->crypto_exchange_rates=$crypto_rates;


    $crypto_exchange_row= $crypto_rates->filter(function($row) use($cryptoRow){

       

       return $row->symbol==$cryptoRow->short_name.'USDT';
    })->first();

    if($cryptoRow->short_name=='USDT')
    {
        return (object)[
    "symbol"=>"USDT",
    "priceChange"=> "-0.55308000",
    "priceChangePercent"=>"-31.201",
    "weightedAvgPrice"=> "1.57545245",
    "prevClosePrice"=> "1.77265000",
    "lastPrice"=> "1.00000000",
    "lastQty"=> "41.00000000",
    "bidPrice"=> "1.21599000",
    "bidQty"=> "640.00000000",
    "askPrice"=> "1.21973000",
    "askQty"=> "117.00000000",
    "openPrice"=>"1.77265000",
    "highPrice"=>"1.89057000",
    "lowPrice"=>"1.12100000",
    "volume"=>"131974930.00000000",
    "quoteVolume"=>"207920226.31104000",
    "openTime"=> 1623067237426,
    "closeTime"=> 1623153637426,
    "firstId"=> 1071985,
    "lastId"=> 1727494,
    "count"=>655510
       ];
    }

     // echo '<pre>';print_r($crypto_exchange_row);die;


    return $crypto_exchange_row;

}

public function repay_date($loan)
{
    if($loan->duration_type=='month')
    {
        $repay_date=\Carbon\Carbon::now()->addMonths($loan->duration);
    //echo '<pre> tt1';print_r($repay_date);die;

    }

    if($loan->duration_type=='year')
    {
        $repay_date=\Carbon\Carbon::now()->addYears($loan->duration);
    }
    if($loan->duration_type=='days')
    {
        $repay_date=\Carbon\Carbon::now()->addDays($loan->duration);
    }

   // echo '<pre> tt';print_r($repay_date);die;

    return $repay_date;
}

}
