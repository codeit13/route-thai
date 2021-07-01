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
   <section id="loans-deshboard-new" class="desh-2 instant">
      <div class="container">
         <div class="row tb-l">
            <div class="col-lg-7 col-sm-6 col-6">
			  <h5 class="visible-xs">LOANABLE COINS</h5>
              <h3 class="hidden-xs loan-d">Loan Details</h3>
            </div>
			 <div class="col-lg-5 text-right col-sm-6 col-6">
				<p>
					@foreach($collateral_currencies as $cl_currency)

					@if($cl_currency->hasMedia('icon'))

					<img style="width: 28px;" src="{{$cl_currency->firstMedia('icon')->getUrl()}}" alt="{{$cl_currency->short_name}}"/>

					@endif


					@endforeach
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
											<h4>{{$loan_detail->loan_amount}} <span>{{$loan_detail->loan_currency->short_name}}</span></h4>
										</div>
									</div>
								</div>
								<div class="col-lg-3 tb-x col-sm-3 col-12">
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-6">
											<label>Loan Term Value</label>
										</div>
										<div class="col-lg-12 xs-right col-sm-12 col-6">
											<h4>{{$loan_detail->term_detail->terms_percentage}}% <span>{{$loan_detail->term_detail->no_of_duration}} {{$loan_detail->term_detail->duration_type}}</span></h4>
										</div>
									</div>
								</div>
								<div class="col-lg-3 tb-x col-sm-3 col-12">
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-6">
											<label>Close price set at</label>
										</div>
										<div class="col-lg-12 xs-right col-sm-12 col-6">	
											@if(isset($loan_detail->close_price) && $loan_detail->close_price)
											<h4>{{$loan_detail->close_price}} <span>USDT</span></h4>
											@endif
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="space-normal">
							<div class="row">
								<div class="col-lg-12 col-sm-12 col-12 xs-flush">
									<div class="loan-duration">
										<div class="row">
											<div class="col-lg-4 b-right col-sm-4 col-12">
												<h5>Loan Duration</h5>
												<h4>{{$loan_detail->term_detail->no_of_duration}} &nbsp;{{$loan_detail->term_detail->duration_type}}</h4>
												<p>The interest rate {{$loan_detail->settings->loan_interest_rate}}% will be charge on the loan amount.</p>
											</div>
											<div class="col-lg-4 b-right col-sm-4 col-12">
												<h5>Price down limit</h5>
												<h4>{{$loan_detail->settings->loan_price_down_limit}}% or {{$loan_detail->price_down_value}} <span> USDT</span></h4>
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
						<div class="col-lg-12 col-sm-12 col-12 xs-flush">
							@if(isset($loan_detail->collateral_currency->collateral_address)&& $loan_detail->collateral_currency->collateral_address->crypto_wallet_address && !(isset($loan_detail->is_wallet)))
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
												<p>Network Name: <b>{{$loan_detail->collateral_currency->name}}({{$loan_detail->collateral_currency->short_name}})</b><br>
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
												<p><b>{{$loan_detail->collateral_currency->collateral_address->crypto_wallet_address}}</b></p>
												<div class="row">
													<div class="col-lg-12 col-sm-12 col-12">
														<label>Memo</label>
														<p><b>{{$loan_detail->collateral_currency->collateral_address->crypto_memo}}</b></p>
													</div>
												</div>
											</div>
											<div class="col-lg-6 text-right col-sm-6 col-6">
												<ul class="loan_code">
													<li><a href="#"><i class="fa fa-clone" aria-hidden="true"></i></a></li>
													<!-- <li><a href="#"><i class="fa fa-qrcode" aria-hidden="true"></i></a></li> -->
													<li class="css-11nldkw">
																	<a href="#"><i class="fa fa-qrcode" aria-hidden="true"></i></a>
																	<div class="QrCode css-jac2fa"><div class="css-ghsb4z"></div>
																	@if(isset($loan_detail->collateral_currency->collateral_address) && $loan_detail->collateral_currency->collateral_address->hasMedia('qr_code'))

																	<canvas height="120" width="120" style="height: 120px; width: 120px; background: url({{$loan_detail->collateral_currency->collateral_address->firstMedia('qr_code')->getUrl()}});"></canvas>

																	@endif
																</div>
																</li>
												</ul>
											</div>
										</div>
									</div>
								</div>		
							</div>

							@endif
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
											<h3>{{$loan_detail->loan_repayment}}<span>&nbsp;{{$loan_detail->loan_currency->short_name}}</span></h3>
										</div>
										<div class="col-lg-6 col-sm-6 col-12">
											<label>Collateral Amount</label>
											<h3>{{$loan_detail->collateral_amount}}<span>&nbsp;{{$loan_detail->collateral_currency->short_name}}</span></h3>
										</div>
									</div>
								</div>
								<div class="col-lg-6 read col-sm-6 col-12">

									<form action="{{route('loan.store')}}" method="post" id="loanForm">
										@csrf

									<div class="row">
										<div class="col-lg-6 col-sm-6 col-12">
											<label><input type="checkbox" name="agree" id="backend-i-agree" value="1" /> I have read and I agree to <a href="#">Route Staking Service Agreement</a></label>
										</div>
										<div class="col-lg-6 col-sm-6 col-12">
											<a href="javascript:void()" onclick="submitForm()" class="btn-info">GET LOAN</a>
										</div>
									</div>
									@error('agree')
                                <p class="invalid-value text-danger" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </p>
                                @enderror

								</form>

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
						<a href="{{route('loan.history')}}" class="btn-success">View All</a>
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
												<td>{{$loan->front_status}}</td>
												<td><a href="{{route('loan.show.detail',['loan'=>$loan->loan_id])}}">View Details</a></td>

											</tr>

											@endforeach
								</tbody>
							</table>
						</div>	
					</div>
					<div class="col-lg-12 visible-xs col-sm-12 col-12 xs-flush">
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
												<td>{{$loan->front_status}}</td>
												<td><a href="{{route('loan.show.detail',['loan'=>$loan->loan_id])}}">View Details</a></td>
											</tr>
										</tbody>
									</table>
								</div>

								@endforeach
					</div>
				</div>
			</div>
      </div> 
   </section>

    <div class="modal" id="exampleModalloan" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
               </button>
            </div>
            <div class="modal-body text-center">
				<img src="{{asset('front/img/img-7.png')}}" alt=""/>
				<p>I confirm that I have made deposit of my collateral 
				to the wallet address shown in this page.</p>
				<a href="#" onclick="confirmSubmit()" class="btn-primary">I Understand</a>
            </div>
         </div>
      </div>
   </div>


@endsection


@section('page_scripts')

<script type="text/javascript">
	
	function submitForm()
	{
		$('.validateError').remove();

	  if($('#backend-i-agree').prop('checked')==true)
	  {
         $('#backend-i-agree').css('border','1px solid black');
         @if(!(isset($loan_detail->is_wallet)))
         $('#exampleModalloan').modal('show');
         @else
        $('#loanForm').submit();
        @endif

	  }
	  else
	  {
	  	$('#backend-i-agree').css('border','2px solid #dc3545');


         $('#loanForm').append('<p class="text-danger text-bold validateError">{{__("The agree field is required.")}}</p>');


	  }
	}

	function confirmSubmit()
	{
        $('#loanForm').submit();

	}
</script>


@endsection