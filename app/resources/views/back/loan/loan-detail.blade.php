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
                            <li class="{{ in_array($loan->status, ['approved','close','paid']) ? "active" : "" }}">
                                <p>Loan In Progress</p><br><span>2</span>
                            </li>
                             <li class="{{ in_array($loan->status, ['approved','close','paid']) ? "active" : "" }}">
                                <p>Loan Approved</p><br><span>3</span>
                            </li>

                            <li class="{{ in_array($loan->status, ['close','paid']) ? "active" : "" }}">
                                <p>Loan Repaid</p><br><span>4</span>
                            </li>

                            <li class="{{ in_array($loan->status, ['close','paid']) ? "active" : "" }}">
                                <p>Loan Close</p><br><span>5</span>
                            </li>

                           {{--
                                                                                  <li class="{{ in_array($loan->status, ['rejected']) ? "active" : "d-none" }}">
                                                                                      <p>Loan Rejected</p><br><span>3</span>
                                                                                  </li>--}}
                            </ul>
                        </div>
                    </div>
                    <a href="{{route('admin.loan.update.status',['id'=>$loan->id, 'status'=>'approved'])}}" class="btn btn-primary text-white {{ $loan->status == 'pending' ? "" : "d-none" }}">Change to Approved</a>
                    <a href="{{route('admin.loan.update.status',['id'=>$loan->id, 'status'=>'rejected'])}}" class="btn btn-primary  text-white {{ $loan->status == 'pending' ? "" : "d-none" }}" >Change to Rejected</a>


                  {{--  <a class="btn btn-primary text-white {{ $trans->status == 'approved' ? "disabled" : "d-none" }}" id="btn-status-change-from-">ORDER FINISHED</a>
                                                        <a class="btn btn-primary text-white {{ $trans->status == 'rejected' ? "disabled" : "d-none" }}" id="btn-status-change-from-">ORDER REJECTED</a>
                                                        <a data-value="rejected" class="btn btn-primary statusUpdate text-white {{ $trans->status == 'pending' || $trans->status == 'in_progress' ? "" : "d-none" }}" id="change-to-uploaded">Change to Rejected</a> --}}
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

                            <img class="mb-1" style="width:20px;height:20px;" src="{{$loan->loan_currency->firstMedia('icon')->getUrl()}}"/>

                          {{ $loan->loan_amount }} {{ $loan->loan_currency->short_name }}

                        </div>
                    </div>

                     <div class="d-inline-flex col-md-12 mt-1">

                         <div class="col-md-5 text-left">

                            Interest:

                        </div>

                        <div class="col-md-7 text-left">

                            <img class="mb-1" style="width:20px;height:20px;" src="{{$loan->loan_currency->firstMedia('icon')->getUrl()}}"/>
{{ $loan->loan_repayment_amount-$loan->loan_amount }} {{ $loan->loan_currency->short_name }}

                        </div>
                    </div>
                     <div class="d-inline-flex col-md-12 mt-1">

                        <div class="col-md-5 text-left">

                            Repayment:

                        </div>

                        <div class="col-md-7 text-left">

                            <img class="mb-1" style="width:20px;height:20px;" src="{{$loan->loan_currency->firstMedia('icon')->getUrl()}}"/>

                            {{ $loan->loan_repayment_amount }} {{ $loan->loan_currency->short_name }}

                        </div>

                    </div>



                    </div>

                    

                    </div>



                </div>
            </div>
      
        <div class="row row-eq-height space-inner">
            @php 

                            $days=$loan->duration;

                          if($loan->duration_type=='month')
                          {
                            $days=$loan->duration*30;
                          }
                          if($loan->duration_type=='year')
                          {
                              $days=$loan->duration*365;
                          }

                          $repay_date=$loan->created_at->addDays($days);

                          $days=\Carbon\Carbon::now()->diffInDays($repay_date);

                          $loan_repay_detail=$loan->repay_request;

                        



                            @endphp
            <div class="col-xs-12 col">
    <div class="card inner-tabs">
                    <h2 class="text-left">Repay Details</h2>
                     @if(!in_array($loan->status,['pending','rejected']) && $loan_repay_detail)
                    <ul class="details nospace">
                         <li>Loan Repaid Date: <b>
                           

                          {{$repay_date->isoFormat('Do-MMMM,Y')}}| {{$repay_date->isoFormat('h:mm a')}} ( {{$days}} days left)


                         

                        </b></li>

                        <li>Loan Repay Repa: <b>
                           

                          {{$repay_date->isoFormat('Do-MMMM,Y')}}| {{$repay_date->isoFormat('h:mm a')}} ( {{$days}} days left)


                         

                        </b></li>

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

                             @if(!in_array($loan->status,['pending','rejected','auto_close','close']))    
                           

                          {{$repay_date->isoFormat('Do-MMMM,Y')}}| {{$repay_date->isoFormat('h:mm a')}} ( {{$days}} days left)

                          @else

                          N/A

                           @endif
                         

                        </b></li>
                      

                         

                        <li>Loan Request Type:<b>{{$loan->on_wallet?'wallet':'custom'}} </b></li>

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
@section('page_scripts')
<script>
$('.statusUpdate').on('click',function(e){
    e.preventDefault();
    var status = $(this).data('value');
    var id = $(this).data('id');
     $.ajax({
        type:'POST',
        dataType:'JSON',
        async:true,
        url:"{{ route('admin.trade.update.status') }}",
        data:{ status : status,id:{{ $loan->id }}, _token: "{{ csrf_token() }}" },
        success:function(data) {
           $('.msg'+id).html(data.message).show();
           setTimeout(function() { $(".msg"+id).hide() }, 2000);
           location.reload();      
        }
     });
});
</script>
@endsection
@endsection
