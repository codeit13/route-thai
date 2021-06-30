@extends('layouts.back')
@section('title')
    Trade Details |
@endsection
@section('content')
<style type="text/css">
.form-wizard .form-wizard-steps li:last-child::before {
    width: 0% !important;
}

.form-wizard .form-wizard-steps li{
    width: 20% !important;
}

    
</style>
    <div class="container-fluid mt-6 team-members transaction">
        <div class="row row-eq-height">
            <div class="col-lg-8 col-xs-12">
                <div class="card text-center trade">
                    <h2 class="text-left">Loan Status</h2>
                    <div class="form-wizard">
                        <div class="form-wizard-header text-center">
                            <ul class="list-unstyled form-wizard-steps clearfix">
                            <li class="active">
                                <p>Loan Started</p><br><span>1</span>
                            </li>
                            <li class="{{ in_array($loan->status, ['approved','repaid','close','paid']) ? "active" : "" }}">
                                <p>Loan In Progress</p><br><span>2</span>
                            </li>
                           

                            <li class="{{ in_array($loan->status, ['close','paid','repaid']) ? "active" : "" }}">
                                <p>Loan Repaid</p><br><span>3</span>
                            </li>

                             <li class="{{ in_array($loan->status, ['liquidate']) ? "active" : "" }}">
                                <p>Loan liquidated</p><br><span>4</span>
                            </li>

                            @if($loan->status=='rejected')

                               <li class="active">
                                <p>Loan Rejected</p><br><span>5</span>
                            </li>

                          @else

                            <li class="{{ in_array($loan->status, ['close','paid']) ? "active" : "" }}">
                                <p>Loan Closed</p><br><span>5</span>
                            </li>

                              @endif

                           {{--
                                                                                  <li class="{{ in_array($loan->status, ['rejected']) ? "active" : "d-none" }}">
                                                                                      <p>Loan Rejected</p><br><span>3</span>
                                                                                  </li>--}}
                            </ul>
                        </div>
                    </div>
                    <a href="{{route('admin.loan.update.status',['id'=>$loan->id, 'status'=>'approved'])}}" class="btn btn-success text-white p-1 {{ $loan->status == 'pending' ? "" : "d-none" }}">Change to Approved</a>

                    @if($loan->repay_request && $loan->repay_request->status !='approved')

                    @if($loan->repay_request->collateral_method != 'wallet')

                     <a onclick="return confirm_action(this);" href="{{route('admin.repayment.update.status',['id'=>$loan->repay_request->id, 'status'=>'approved'])}}" class="btn btn-success text-white p-1 {{ $loan->status == 'approved' ? "" : "d-none" }}">Change To Repaid</a>

                     @else

                     <a  href="{{route('admin.repayment.update.status',['id'=>$loan->repay_request->id, 'status'=>'approved'])}}" class="btn btn-success text-white p-1 {{ $loan->status == 'approved' ? "" : "d-none" }}">Change To Repaid</a>

                     @endif


                     @endif

                        @if($loan->status == 'repaid')

                     <a  href="{{route('admin.loan.update.status',['id'=>$loan->id, 'status'=>'close'])}}" class="btn btn-success text-white p-1 {{ $loan->status == 'repaid' ? "" : "d-none" }}">Change To Close</a>

                     @endif

                    <a href="{{route('admin.loan.update.status',['id'=>$loan->id, 'status'=>'rejected'])}}" class="btn btn-danger p-1  text-white {{ $loan->status == 'pending' ? "" : "d-none" }}" >Change to Rejected</a>


                </div>
            </div>
            <div class="col-lg-4 col-xs-12">
                <div class="card trade">
                    <h2 class="text-left">General Loan Details</h2>

                    <div class="row pt-3">
                        <div class="d-inline-flex col-md-12 mt-1">

                        <div class="col-md-5 text-left">

                            Collateral:

                        </div>

                        <div class="col-md-7 text-left">

                            <img class="mb-1" style="width:20px;height:20px;" src="{{$loan->collateral_currency->firstMedia('icon')->getUrl()}}"/>

                           {{ $loan->collateral_amount }} {{ $loan->collateral_currency->short_name }}

                        </div>
                    </div>

                     <div class="d-inline-flex col-md-12 mt-1">

                        <div class="col-md-5 text-left">

                            Loan:

                        </div>

                        <div class="col-md-7 text-left">

                            <img class="mb-1" style="width:20px;height:20px;" src="{{$loan->usdt_currency->firstMedia('icon')->getUrl()}}"/>

                          {{ $loan->loan_amount*$loan->loan_currency_rate }} {{ $loan->usdt_currency->short_name }}

                        </div>
                    </div>

                     <div class="d-inline-flex col-md-12 mt-1">

                         <div class="col-md-5 text-left">

                            Interest:

                        </div>

                        <div class="col-md-7 text-left">

                            <img class="mb-1" style="width:20px;height:20px;" src="{{$loan->usdt_currency->firstMedia('icon')->getUrl()}}"/>
{{ ($loan->loan_repayment_amount-$loan->loan_amount)*$loan->loan_currency_rate }} {{ $loan->usdt_currency->short_name }}

                        </div>
                    </div>
                     <div class="d-inline-flex col-md-12 mt-1">

                        <div class="col-md-5 text-left">

                            Repayment:

                        </div>

                        <div class="col-md-7 text-left">

                            <img class="mb-1" style="width:20px;height:20px;" src="{{$loan->usdt_currency->firstMedia('icon')->getUrl()}}"/>

                            {{ $loan->loan_repayment_amount*$loan->loan_currency_rate }} {{ $loan->usdt_currency->short_name }}

                        </div>

                    </div>



                    </div>

                    

                    </div>



                </div>
            </div>
      
        <div class="row row-eq-height space-inner">
            @php 


                          $days=\Carbon\Carbon::now()->diffInDays($loan->repay_date);

                          $loan_repay_detail=$loan->repay_request;

                        



                            @endphp
            <div class="col-xs-12 col">
    <div class="card inner-tabs">
                    <h2 class="text-left">Repay Details</h2>
                     @if(!in_array($loan->status,['pending','rejected']) && $loan_repay_detail)
                    <ul class="details nospace">
                         <li>Loan Repaid Date: <b>
                           

                          {{$loan->repay_date->isoFormat('Do-MMMM,Y')}}| {{$loan->repay_date->isoFormat('h:mm a')}} ( {{$days}} days left)


                         

                        </b></li>

                        <li>Repay Request Date: 
                           

                          <b>{{$loan_repay_detail->created_at->isoFormat('Do-MMMM,Y')}}| {{$loan_repay_detail->created_at->isoFormat('h:mm a')}}</b>

                             </li>

                             <li>Repay Currency: 
                           

                         <b>
                            @if($loan_repay_detail->loan_currency->hasMedia('icon'))
       
                          <img class="mb-1" style="width:20px;height:20px;" src="{{$loan_repay_detail->loan_currency->firstMedia('icon')->getUrl()}}"/> 

                          @endif

                          {{$loan_repay_detail->loan_currency->short_name}} </b>

                             </li>

                              <li>Loan Repaid Amount: <b>
                           

                          {{$loan_repay_detail->loan_repayment_amount}}  {{$loan_repay_detail->loan_currency->short_name}}


                         

                        </b></li>

                        <li>Loan Repaid Method: <b>

                            @if($loan_repay_detail->collateral_method=='wallet')

                            Wallet

                            @else

                            Manual Deposit

                            @endif
                           
                          </b></li>

                            @if($loan_repay_detail->collateral_method != 'wallet')

                            <li>
                                  Collateral Wallet Address: <b>{{$loan_repay_detail->crypto_wallet_address}}</b>
                            </li>


                            @endif



                    </ul>
                       @else
                       <ul class="details nospace">
                    <li><b>N/A</b></li>
                    </ul>

                    @endif
                </div>
        </div>


         <div class="col-xs-12 col">
    <div class="card inner-tabs">

                    <h2 class="text-left">Loan Details</h2>

                        

                    <ul class="details nospace">

                           <li>Loan Id: <b>{{$loan->loan_id}}</b></li>
                        
                          <li>Loan Created: <b>{{$loan->created_at->isoFormat('Do-MMMM,Y')}}| {{$loan->created_at->isoFormat('h:mm a')}}</b></li>

                                     
                         <li>Loan Repay Date: <b>

                             @if(!in_array($loan->status,['rejected','auto_close','close','pending']))    
                           

                          {{$loan->repay_date->isoFormat('Do-MMMM,Y')}}| {{$loan->repay_date->isoFormat('h:mm a')}} ( {{$days}} days left)

                          @else

                          N/A

                           @endif
                         

                        </b></li>
                      

                         

                        <li>Loan Request Type:<b>{{$loan->on_wallet?'Wallet':'Manual Deposit'}} </b></li>

                        <li>Collateral:<b> <img class="mb-1" style="width:20px;height:20px;" src="{{$loan->collateral_currency->firstMedia('icon')->getUrl()}}"/> {{$loan->collateral_currency->short_name}} </b></li>

                        <li>Collateral Live Price  : <b>{{number_format($loan->current_value,2)}} USDT</b></li>
                        <li>Locked Price : <b>{{number_format($loan->collateral_currency_rate,2)}} USDT</b> </li>
                        <li>Price Down Limit: <b>{{$loan->price_down_percentage}} USDT</b><span> </span></li>
                        <li>Close Price: <b>@if($loan->close_price){{number_format($loan->close_price,2,'.','')}} USDT @else N/A  @endif</b></li>
                        <li>Loan Term:<b>{{$loan->term_percentage}}% ( {{$loan->duration}}{{$loan->duration_type}} )</b></li>
                        <li>Loan Interest:<b>{{$loan->interest_value}}% </b></li>


                    </ul>
                </div>
        </div>
    </div>

     <div class="row row-eq-height space-inner">
            <div class="col-xs-12 col">
    <div class="card inner-tabs">
                    <h2 class="text-left">User Details</h2>
                    <ul class="details nospace">
                        <li>Username : <b>{{ $loan->user->name }}</b></li>
                        <li>Email : <b>{{ $loan->user->email }}</b></li>
                        <li>Mobile Number: <b>{{ ($loan->user->mobile)?$loan->user->mobile:"N/A" }}</b></li>
                        <li>Line ID: <b>{{ ($loan->user->line_number)?$loan->user->line_number:"N/A" }}</b></li>
                    </ul>
                </div>
        </div>


        
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background:#151c31 !important;color: white !important;">
        <h5 class="modal-title text-light" id="exampleModalLabel">Suggestion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Collateral transferred manually.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="button" class="btn btn-primary" onclick="markAsDone()">Yes</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('page_scripts')
<script type="text/javascript">

    var current_repay_request='';

 
  function confirm_action(selector)
  {
    current_repay_request=$(selector).attr('href');

     $('#confirmModal').modal('show');

     return false;

     
  }

  function markAsDone()
  {
    window.location.href=current_repay_request;
  }

</script>
@endsection
