@extends('layouts.front')
@section('title')
    Route: Loan Request
@endsection
@section('page_styles')
	<link type="text/css" rel="stylesheet" href="{{asset('front/css/datepicker.css')}}" />

@endsection

@section('content')

  <section id="banner_search" class="loans-deshboard desh-2 visible-xs">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 text-center col-sm-12 col-12">
               <h2><img src="{{asset('front/img/img-6.png')}}" alt=""/> Loan Processing</h2>
            </div>
         </div>
      </div> 
   </section>
	<section id="your-application">
		<div class="container">
			<div class="l-coins visible-xs">
				<div class="row tb-l one-1">
					<div class="col-lg-7 col-sm-6 col-6">
					  <h5 class="visible-xs">LOANABLE COINS</h5>
					  <h3 class="hidden-xs loan-d">Loan Details</h3>
					</div>
					 <div class="col-lg-5 text-right col-sm-6 col-6">
						<p>
							<img src="{{asset('front/img/bitcoin.png')}}" alt=""/>
							<img src="{{asset('front/img/icon-5.png')}}" alt=""/>
							<img src="{{asset('front/img/icon-6.png')}}" alt=""/>
							<img src="{{asset('front/img/icon-7.png')}}" alt=""/>
						</p>
					</div>
				</div>
			</div>	
			<div class="row tb-l">
				<div class="col-lg-7 col-sm-12 col-12">
					<div class="row">
						<div class="col-lg-6 col-sm-6 col-6">
							<label>Order Date:Date:{{$loan->created_at->isoFormat('Do-MMMM-Y')}}<span>|</span> {{$loan->created_at->isoFormat('h:mm a')}}</label>
						</div>
						<div class="col-lg-6 text-right col-sm-6 col-6">
							<label>Order Number: {{$loan->loan_id}}</label>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-sm-12 col-12">
							<div class="white-box">
								<div class="row m-bottom">
									<div class="col-lg-4 xs-flush-right col-sm-4 col-5">
										<h6>My Collateral is</h6>
										<h5><b>{{$loan->collateral_amount}}</b> &nbsp;{{__($loan->collateral_currency->short_name)}}&nbsp;
											@if($loan->collateral_currency->hasMedia('icon'))
										 <img style="max-width:28px;" src="{{$loan->collateral_currency->firstMedia('icon')->getUrl()}}" alt="{{$loan->collateral_currency->short_name}}"/>

										 @endif</h5>
									</div>
									<div class="col-lg-4 col-sm-4 col-7">
										<h6>Current value</h6>
										<p>
										@if($loan->collateral_currency->hasMedia('icon'))
										 <img style="max-width:28px;" src="{{$loan->collateral_currency->firstMedia('icon')->getUrl()}}" alt="{{$loan->collateral_currency->short_name}}"/>

										 @endif

										 {{$loan->collateral_currency->short_name}}:<b>{{number_format($loan->current_value,2)}}</b> USDT <a href="#"><!-- +0.73%; --></a></p>
									</div>
									<div class="col-lg-4 col-sm-4 col-6">
										<h6>Loan Term Value</h6>
										<h5><b>{{$loan->term_percentage}}%</b><br><span>{{$loan->duration}}{{$loan->duration_type}}</span></h5>
									</div>
									<div class="col-lg-4 visible-xs col-sm-4 col-6">
										<h6>Close price set at</h6>
										<h5><b>{{number_format($loan->close_price,2,'.','')??'Not Set'}}</b> USDT</h5>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-4 hidden-xs col-sm-4 col-6">
										<h6>Close price set at</h6>
										<h5><b>{{number_format($loan->close_price,2,'.','')??'Not Set'}}</b> USDT</h5>
									</div>
									<div class="col-lg-4 col-sm-4 col-6">
										<h6>Loan to be repaid</h6>
									<h5><b class="green">{{number_format($loan->loan_repayment_amount,5,".","")}}</b> {{$loan->loan_currency->short_name}}</h5>
									</div>
									<div class="col-lg-4 text-right visible-xs col-sm-4 col-6">
										<h6>PDL</h6>
										<h5><a>+0.73%;</a></h5>
									</div>
									<div class="col-lg-4 col-sm-4 col-12">
										<a href="{{route('loan.history')}}" class="btn-info">Go Back</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-5 hidden-xs text-center col-sm-5 col-12">
					@switch($loan->status)

					@case('approved')

					<h3>Your Loan is approved</h3>
					<img src="{{asset('front/img/loan_app.png')}}" alt=""/>

					@break

					@case('pending')

					<h3>Your application is
being processed</h3>
					<img src="{{asset('front/img/loan_process.png')}}" alt=""/>

					@break

					@endswitch
				</div>
			</div>
		</div> 
	</section>


@endsection


@section('page_scripts')


@endsection