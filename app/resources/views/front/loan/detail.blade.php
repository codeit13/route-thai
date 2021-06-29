@extends('layouts.front')
@section('title')
    Route: P2P Trading Platform
@endsection
@section('page_styles')


	<style type="text/css">
		#your-application span.rejected
		{
			    background: #f0dddd;
              line-height: 30px;
             color: #d0420c;
             font-size: 16px;
             font-weight: bold;
             display: inline-block;
             margin-top: 5px;
             padding: 0px 15px;
             border-radius: 18px;
             margin-top:43px;
		}
	</style>

@endsection

@section('content')

 <section id="banner_search" class="loans-deshboard desh-2 visible-xs">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 text-center col-sm-12 col-12">
               <h2><img src="{{asset('front/img/img-6.png')}}" alt=""/> Repay Loan</h2>
            </div>
         </div>
      </div> 
   </section>
	<section id="your-application" class="repay-details bottom-0">
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
				<div class="col-lg-12 col-sm-12 col-12">
					<div class="row">
						<div class="col-lg-6 col-sm-6 col-6">
							<h3>Loan Details</h3>
						</div>
						<div class="col-lg-6 text-right col-sm-6 col-6">
							@switch($loan->status)

							@case('pending')
							<span class="in-progress">In Progress</span>
							@break

							@case('rejected')

							<span class="rejected">Rejected</span>


							@break

							@case('approved')

							<span class="in-progress">Approved</span>
                        
							@break

							@default

							<span class="in-progress">{{ucwords($loan->status)}}</span>
							

							@break



							@endswitch
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-sm-6 col-6">
							<label>Order Date:{{$loan->created_at->isoFormat('Do-MMMM')}}

   <!-- 23rd may --> <span>|</span>&nbsp;{{$loan->created_at->isoFormat('h:mm a')}}<!--  14:34PM --></label>
						</div>
						<div class="col-lg-6 text-right col-sm-6 col-6">
							<label>Order Number: {{$loan->loan_id}}</label>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-sm-12 col-12">
							<div class="white-box">
								<div class="row">
									<div class="col-lg-2 xs-flush-right col-sm-4 col-6">
										<h6>My Collateral is</h6>
										<h5><b>{{$loan->collateral_amount}}</b> &nbsp;{{__($loan->collateral_currency->short_name)}}&nbsp;
											
										</h5>
									</div>
									<div class="col-lg-2 col-sm-4 col-6">
										<h6>Locked price</h6>
										<p>
											

										 <b>{{number_format($loan->collateral_currency_rate,2)}}<!-- 1,797,994.87 --></b> USDT <!-- <br><a href="#">+0.73%;</a> --></p>
									</div>

									<div class="col-lg-2 col-sm-4 col-6">
										<h6>Price Down Limit</h6>
										<h5><b>{{$loan->price_down_percentage}}</b><span> USDT</span></h5>
									</div>

									<div class="col-lg-2 col-sm-4 col-6">
										<h6>Loan Term Value</h6>
										<h5><b>{{$loan->term_percentage}}%</b><br><span>{{$loan->duration}}{{$loan->duration_type}}</span></h5>
									</div>
									<div class="col-lg-2 col-sm-4 col-6">
										<h6>Close price set at</h6>
										<h5><b>{{number_format($loan->close_price,2,'.','')??'Not Set'}}</b> USDT</h5>
									</div>
									<div class="col-lg-2 col-sm-4 col-6">
										<h6>Loan to be repaid</h6>
										<h5><b class="green">{{number_format($loan->loan_repayment_amount,5,".","")}}</b> {{$loan->loan_currency->short_name}}</h5>
									</div>

									<div class="col-lg-2 text-left visible-xs col-sm-4 col-6">
										<h6>Live Price</h6>
										<h5 class="float-left"><a>{{number_format($loan->current_value,2)}}</a></h5>
									</div>


									
								</div>
							</div>
						</div>
						<div class="col-lg-6 col-sm-8 col-5">
							<!-- <a href="{{route('loan.close',$loan->loan_id)}}" class="btn-info close-now">Close now</a> -->
						</div>

						@if($loan->status =='approved')
						<div class="col-lg-6 hidden-xs text-right pdl-2 col-sm-4 col-7">
							<label>Live Price: <span>{{number_format($loan->current_value,2)}} USDT</span> <a href="{{route('loan.repay',$loan->loan_id)}}" class="btn-info">Repay Loan</a></label>
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



							@endphp
							<p>Repay to {{$days}} days ({{$repay_date->isoFormat('Do-MMMM,Y')}}| {{$repay_date->isoFormat('h:mm a')}})</p>
						</div>


						<div class="col-lg-4 visible-xs text-right pdl-2 col-sm-4 col-7">
							<label><a href="{{route('loan.repay',$loan->loan_id)}}" class="btn-info">Repay Loan</a></label>
							<p>Repay to {{$days}} days ({{$repay_date->isoFormat('Do-MMMM,Y')}}| {{$repay_date->isoFormat('h:mm a')}})</p>
						</div>

						<div class="visible-xs xs-l-flush hidden-xs col-7">
							<a href="#" class="btn-info repay-now">REPAY LOAN</a>
							<p class="red-position">Repay to {{$days}} days (21st Sep, 2021 14:23)</p>
						</div>
						@endif
					</div>
				</div>
			</div>
		</div> 
	</section>
	<section id="loans-deshboard-new" class="repay">
      <div class="container">
		<div class="my-loan-history">
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-4">
					<h4>Other Loans</h4>
				</div>
				<div class="col-lg-6 visible-xs text-right col-sm-6 col-8">
					<a href="#" class="btn-success apply-for">+ Apply For newloan</a>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 hidden-xs col-sm-12 col-12 flush">
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>Loan Amount</th>
									<th>Order Number</th>
									<th>Order Date</th>
									<th>Collateral</th>
									<th>Loan Term</th>
									<th>LTV</th>
									<th>Status</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
									@foreach($loans as $loan)
											<tr>

												<td>{{$loan->loan_amount}} <span>{{$loan->loan_currency->short_name}}</span></td>
												<td>{{$loan->loan_id}}</td>
												<td>{{$loan->loan_date}}</td>
												<td>
													@if($loan->collateral_currency->hasMedia('icon'))
													<img style="max-width:28px;" src="{{$loan->collateral_currency->firstMedia('icon')->getUrl()}}" alt="{{$loan->collateral_currency->short_name}}"/>

													@endif

													{{$loan->collateral_amount}} {{$loan->collateral_currency->short_name}}</td>
												<td>{{$loan->duration}} &nbsp;{{$loan->duration_type}}</td>
												<td>{{$loan->term_percentage}}%</td>
												<td>{{ucwords($loan->status)}}</td>
												<td><a href="{{route('loan.show.detail',['loan'=>$loan->loan_id])}}">View Details</a></td>

											</tr>

											@endforeach
							</tbody>
						</table>
					</div>	
				</div>
				<div class="col-lg-12 visible-xs col-sm-12 col-12">
					@foreach($loans as $loan)
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th>Loan Amount</th>
												<th>Order Number</th>
												<th>Order Date</th>
												<th>Collateral</th>
												<th>Loan Term</th>
												<th>LTV</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>

											<tr>
												

														<td>{{$loan->loan_amount}} <span>{{$loan->loan_currency->short_name}}</span></td>
												<td>{{$loan->loan_id}}</td>
												<td>{{$loan->loan_date}}</td>
												<td>
													@if($loan->collateral_currency->hasMedia('icon'))
													<img style="max-width:28px;" src="{{$loan->collateral_currency->firstMedia('icon')->getUrl()}}" alt="{{$loan->collateral_currency->short_name}}"/>

													@endif

													{{$loan->collateral_amount}} {{$loan->collateral_currency->short_name}}</td>
												<td>{{$loan->duration}} &nbsp;{{$loan->duration_type}}</td>
												<td>{{$loan->term_percentage}}%</td>
												<td>{{ucwords($loan->status)}}</td>
												<td><a href="{{route('loan.show.detail',['loan'=>$loan->loan_id])}}">View Details</a></td>
											</tr>


										</tbody>
									</table>
								</div>

								@endforeach

				</div>
			</div>
		</div>
		<div class="apply-new-loan">
			<div class="row">
				<div class="col-lg-9 col-sm-8 col-12">
					<div class="row">
						<div class="col-lg-4 col-sm-4 col-12">
							<p>Lorem ipsum dolor sit amet,
							consectetur adipiscing elit, sed
							do eiusmod.</p>
						</div>
						<div class="col-lg-4 col-sm-4 col-12">
							<p>Lorem ipsum dolor sit amet,
							consectetur adipiscing elit, sed
							do eiusmod.</p>
						</div>
						<div class="col-lg-4 col-sm-4 col-12">
							<p>Lorem ipsum dolor sit amet,
							consectetur adipiscing elit, sed
							do eiusmod.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 text-right col-sm-4 col-12">
					<a href="{{route('loan.create')}}" class="btn-info">Apply new loan</a>
				</div>
			</div>
		</div>
      </div> 
   </section>

@endsection


@section('page_scripts')


@endsection