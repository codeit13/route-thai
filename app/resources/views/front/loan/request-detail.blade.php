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
               <h2><img src="{{asset('front/img/img-6.png')}}" alt=""/> Get Instant Loan</h2>
            </div>
         </div>
      </div> 
   </section>
   <section id="loans-deshboard-new" class="desh-2">
      <div class="container">
         <div class="row tb-l">
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
		  <div class="col-lg-12 text-left flush xs-f col-sm-12 col-12">
				<h3 class="visible-xs">Get Instant Loan</h3>
			</div>	
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-12">
					<div class="white-box">
						<div class="final-loan collateral">
							<div class="row">
								<div class="col-lg-3 tb-x col-sm-3 col-12">
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-6">
											<label>My Collateral is</label>
										</div>	
										<div class="col-lg-12 xs-right col-sm-12 col-6">
											<h4>{{$loan_detail->collateral_amount}} <span>{{__($loan_detail->collateral_currency->short_name)}}</span></h4>
										</div>
									</div>
								</div>
								<div class="col-lg-3 tb-x col-sm-3 col-12">
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-6">
											<label>Loan Amount</label>
										</div>
										<div class="col-lg-12 xs-right col-sm-12 col-6">	
											<h4>{{$loan_detail->loan_amount}}<span>{{$loan_detail->loan_currency->short_name}}</span></h4>
										</div>
									</div>
								</div>
								<div class="col-lg-3 tb-x col-sm-3 col-12">
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-6">
											<label>Loan Term Value</label>
										</div>
										<div class="col-lg-12 xs-right col-sm-12 col-6">
											<h4>{{$loan_detail->term_detail->terms_percentage}}% <br><span>{{$loan_detail->term_detail->no_of_duration}} &nbsp;{{$loan_detail->term_detail->duration_type}}</span></h4>
										</div>
									</div>
								</div>
								<div class="col-lg-3 tb-x col-sm-3 col-12">
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-6">
											<label>Close price set at</label>
										</div>
										<div class="col-lg-12 xs-right col-sm-12 col-6">	
											@if($loan_detail->close_price)
											<h4>{{$loan_detail->close_price}} <span>USDT</span></h4>
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="space-normal">
							<div class="row">
								<div class="col-lg-12 col-sm-12 col-12">
									<div class="loan-duration">
										<div class="row">
											<div class="col-lg-4 b-right col-sm-4 col-12">
												<h5>Loan Duration</h5>
												<h4>{{$loan_detail->term_detail->no_of_duration}} &nbsp;{{$loan_detail->term_detail->duration_type}}</h4>
												<p>The interest rate 2.1% will be charge on the loan amount.</p>
											</div>
											<div class="col-lg-4 b-right col-sm-4 col-12">
												<h5>Price down limit</h5>
												<h4>{{$loan_detail->settings->loan_price_down_limit}}% or {{$loan_detail->price_down_value}} <span>{{__($loan_detail->collateral_currency->short_name)}}/USDT</span></h4>
												<p>Add more collateral and extend PDL</p>
											</div>
											<div class="col-lg-4 col-sm-4 col-12">
												<h5>Loan repayment</h5>
												<h4>{{$loan_detail->loan_repayment}} <span>{{$loan_detail->loan_currency->short_name}}</span></h4>
												<p>Full repayment required only for full collateral return.</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>	
						<div class="col-lg-12 col-sm-12 col-12">
							<div class="collateral-deposit-details">
								<div class="row">
									<div class="col-lg-5 col-sm-5 col-12">
										<div class="row">
											<div class="col-lg-12 col-sm-12 col-12">
												<label>Collateral Deposit details</label>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-6 col-sm-6 col-6">
												<p>Network Name: <b>Bitcoin(BTC)</b><br>
												Average arrival time: <b>1 minutes</b></p>
											</div>
											<div class="col-lg-6 text-right col-sm-6 col-6">
												<img class="top-min" src="img/3602.png')}}" alt=""/>
											</div>
										</div>
									</div>	
									<div class="col-lg-7 col-sm-7 col-12">
										<div class="row">
											<div class="col-lg-12 col-sm-12 col-12">
												<label>Address</label>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-6 col-sm-6 col-6">
												<p><b>1JFAe8qq9wshJRLkdia3zZ94Nk9VLc4W3y</b></p>
												<div class="row">
													<div class="col-lg-12 col-sm-12 col-12">
														<label>Memo</label>
														<p><b>1JFAe8qq9wshJRLkdia3zZ94Nk9VLc4W3y</b></p>
													</div>
												</div>
											</div>
											<div class="col-lg-6 text-right col-sm-6 col-6">
												<ul class="loan_code">
													<li><a href="#"><i class="fa fa-clone" aria-hidden="true"></i></a></li>
													<li><a href="#"><i class="fa fa-qrcode" aria-hidden="true"></i></a></li>
												</ul>
											</div>
										</div>
									</div>
								</div>		
							</div>
						</div>
						<!-- <div class="close-price hidden-xs">
							<div class="row">
								<div class="col-lg-8 b-right col-sm-8 col-12">
									<label><input type="checkbox"/> Set close price at  <form><input type="text" placeholder="Enter amount"/><button type="submit">USD</button></form></label>
								</div>
								<div class="col-lg-4 col-sm-4 col-12">
									<p>Min: <span>1,797,994.87</span> USD &nbsp;&nbsp;Max: <span>1,797,994.87</span> USD</p>
									<p><a href="#">Know More</a></p>
								</div>
							</div>
						</div> -->
						<div class="final-loan">
							<div class="row">
								<div class="col-lg-6 col-sm-6 col-12">
									<div class="row">
										<div class="col-lg-6 col-sm-6 col-12">
											<label>Final Loan Amount</label>
											<h3>{{$loan_detail->loan_repayment}}<span>{{$loan_detail->loan_currency->short_name}}</span></h3>
										</div>
										<div class="col-lg-6 col-sm-6 col-12">
											<label>Collateral Amount</label>
											<h3>{{$loan_detail->collateral_amount}} <span>{{$loan_detail->collateral_currency->short_name}}</span></h3>
										</div>
									</div>
								</div>
								<div class="col-lg-6 read col-sm-6 col-12">
									<div class="row">
										<div class="col-lg-6 col-sm-6 col-12">
											<label><input type="checkbox"/> I have read and I agree to <a href="#">Route Staking Service Agreement</a></label>
										</div>
										<div class="col-lg-6 col-sm-6 col-12">
											<a href="#" class="btn-info">GET LOAN</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="my-loan-history">
				<div class="row">
					<div class="col-lg-6 col-sm-6 col-6">
						<h4>My Loan History</h4>
					</div>
					<div class="col-lg-6 text-right col-sm-6 col-6">
						<a href="#" class="btn-success">View All</a>
					</div>
				</div>
				<div class="row">
					<div class="col-lg-12 hidden-xs col-sm-12 col-12">
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
										<td>2212 <span>USD</span></td>
										<td>CDFKM9483</td>
										<td>23/05/2021</td>
										<td><img src="{{asset('front/img/bitcoin.png')}}" alt=""/> 2 BTC</td>
										<td>30 Days</td>
										<td>90%</td>
										<td>Paid</td>
										<td><a href="#">View Details</a></td>
									</tr>
									<tr>
										<td>23 <span>USD</span></td>
										<td>CDFKM9483</td>
										<td>23/05/2021</td>
										<td><img src="{{asset('front/img/bitcoin.png')}}" alt=""/> 2 BTC</td>
										<td>30 Days</td>
										<td>90%</td>
										<td class="red-c">UnPaid</td>
										<td><a href="#">View Details</a></td>
									</tr>
									<tr>
										<td>2212 <span>USD</span></td>
										<td>CDFKM9483</td>
										<td>23/05/2021</td>
										<td><img src="{{asset('front/img/bitcoin.png')}}" alt=""/> 2 BTC</td>
										<td>30 Days</td>
										<td>90%</td>
										<td>Paid</td>
										<td><a href="#">View Details</a></td>
									</tr>
									<tr>
										<td>23 <span>USD</span></td>
										<td>CDFKM9483</td>
										<td>23/05/2021</td>
										<td><img src="{{asset('front/img/bitcoin.png')}}" alt=""/> 2 BTC</td>
										<td>30 Days</td>
										<td>90%</td>
										<td class="red-c">UnPaid</td>
										<td><a href="#">View Details</a></td>
									</tr>
								</tbody>
							</table>
						</div>	
					</div>
					<div class="col-lg-12 visible-xs col-sm-12 col-12">
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
										<td>2212 <span>USD</span></td>
										<td>CDFKM9483</td>
										<td>23/05/2021</td>
										<td><img src="{{asset('front/img/bitcoin.png')}}" alt=""/> 2 BTC</td>
										<td>30 Days</td>
										<td>90%</td>
										<td>Paid</td>
										<td><a href="#">View Details</a></td>
									</tr>
								</tbody>
							</table>
						</div>	
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
										<td>2212 <span>USD</span></td>
										<td>CDFKM9483</td>
										<td>23/05/2021</td>
										<td><img src="{{asset('front/img/bitcoin.png')}}" alt=""/> 2 BTC</td>
										<td>30 Days</td>
										<td>90%</td>
										<td>Paid</td>
										<td><a href="#">View Details</a></td>
									</tr>
								</tbody>
							</table>
						</div>	
					</div>
				</div>
			</div>
      </div> 
   </section>


@endsection


@section('page_scripts')


@endsection