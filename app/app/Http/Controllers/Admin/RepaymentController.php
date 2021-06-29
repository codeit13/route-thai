<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoanRepayRequest;
use App\Notifications\Notify;
use Yajra\Datatables\Datatables;

class RepaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        return view('back.loan.repayments');
    }


    public function repayment_requests(Request $request)
    {
       
        $repayments = LoanRepayRequest::select('loan_repay_requests.*')->leftJoin('loans as loan_request','loan_request.id','=','loan_repay_requests.loan_opening_id')->with(['user','loan_currency','collateral_currency','loan_request']);



        
             $repayments=$repayments->where('loan_repay_requests.status','pending');

        //echo '<pre>';print_r($repayments->get()->toArray());die;

        



          return $this->makeTable($repayments);
       
    }


    public function makeTable($repayments)
    {
        return Datatables::of($repayments)

          ->orderColumn('loan_repay_requests.id', '-id $1')

           

        

           ->addColumn('detail_link',function($loan){
              return '<a class="text-info" href="'.route('admin.loan.show',['loan'=>$loan->loan_request->loan_id]).'">
                       Details
                      </a>';
           })
            ->addColumn('action', function ($loan) {

                $action='<div class="dropdown">';

                      switch($loan->status){


                      case 'pending':

                      $action.='
                       <a class="btn btn-sm btn-icon-only text-info d-inline-flex w-25" href="'.route('admin.loan.show',['loan'=>$loan->loan_request->loan_id]).'">
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
           ->editColumn('loan_request.repay_date',function($loan)
           {
              return date('d-m-Y',strtotime($loan->loan_request->repay_date));
           })
           

            ->addColumn('user', function ($loan) {
                return '<div class="media-body text-left">
                      <span class="name mb-0 text-sm">'.$loan->loan_request->user->name.'</span>
                    </div>
                    <small class="text-muted d-table-row">'.$loan->loan_request->user->email.'</small>';
            })

             ->editColumn('loan_request.term_percentage', function ($loan) {
                return $loan->loan_request->term_percentage.'% ('.$loan->loan_request->duration.' '.$loan->loan_request->duration_type.')';
            })

            ->editColumn('loan_amount',function($loan){
                $loan_info='<div class="media align-items-center">
                      <a href="#" class="rounded-circle mr-2">';
                      if($loan->loan_request->loan_currency->hasMedia('icon'))
                      {
                         $loan_info.='<img alt="Image placeholder" width="20" src="'.$loan->loan_request->loan_currency->firstMedia('icon')->getUrl().'">';
                      }
                        
                    $loan_info.=' </a>
                      <div class="media-body text-left">
                        <span class="name mb-0 text-sm">'.$loan->loan_request->loan_amount.'</span>
                      </div>
                    </div>';

                    return $loan_info;

            })

            ->editColumn('loan_repayment_amount',function($loan){
                $loan_info='<div class="media align-items-center">
                      <a href="#" class="rounded-circle mr-2">';
                      if($loan->loan_currency->hasMedia('icon'))
                      {
                         $loan_info.='<img alt="Image placeholder" width="20" src="'.$loan->loan_currency->firstMedia('icon')->getUrl().'">';
                      }
                        
                    $loan_info.=' </a>
                      <div class="media-body text-left">
                        <span class="name mb-0 text-sm">'.$loan->loan_repayment_amount.'</span>
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
            ->rawColumns(['collateral_info','loan_amount','user','action','detail_link','loan_repayment_amount'])
            ->make(true);
    }


}
