@extends('layouts.front')
@section('title')
    Route: Loan Request
@endsection
@section('page_styles')
	<link type="text/css" rel="stylesheet" href="{{asset('front/css/datepicker.css')}}" />

@endsection

@section('content')

@php
$loan_variables=[];
foreach($loanSettings as $loan_setting)
{
	 $loan_variables[$loan_setting->setting_code]=$loan_setting->setting_value;
}

$loan_variables=(object)$loan_variables;

@endphp

  <section id="banner_search" class="loans-deshboard">
      <div class="container">
         <div class="row">
            <div class="col-lg-7 col-sm-6 col-9">
               <h2>Get perfect loan for you</h2>
				<p>Route provides an all-in-one staking solution. Let us do the work, 
				while you earn the rewards.</p>
            </div>
			 <div class="col-lg-5 text-right col-sm-6 col-3">
				<img src="{{asset('front/img/img-5.png')}}" alt=""/>
            </div>
         </div>
      </div> 
   </section>
   <section id="loans-deshboard-new">
      <div class="container">
         <div class="row tb-l">
            <div class="col-lg-7 col-sm-6 col-6">

			  <h5 class="visible-xs">LOANABLE COINS</h5>

              <h3 class="hidden-xs">Get Instant Loan</h3>

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
            <div class="col-lg-7 col-sm-6 col-6">
              <label class="main">Enter your loan details</label>
            </div>
			 <div class="col-lg-5 btc text-right col-sm-6 col-6">

				<p id="backend-current-usd-rate"><img src="{{asset('front/img/sm-icon-1.png')}}" alt=""/>&nbsp; BTC:<b>1,797,994.87</b> USD <span></span> <a href="#"></a></p>

            </div>
         </div>
         <form action="{{route('loan.initialize')}}" method="post" id="backend-loan-form">

         	@csrf
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-12">
					<div class="white-box">
						<div class="space-normal">
							<div class="row">
								<div class="col-lg-5 col-12 col-sm-4">
									<div class="row">
										<div class="col-lg-4 col-sm-4 col-5">
											<label>My Collateral is</label>
										</div>
										<div class="col-lg-8 text-right col-sm-8 col-7">
											<label class="sm-size">Total balance: <b id="totalBalance">0.00000000 BTC</b></label>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-12">
											<div class="multi_form">
												<div class="dropdown currencyDropdown currency_two three_coins crypto">

												  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                              @if( isset($currencies[0]) && $currencies[0]->hasMedia('icon'))

													<img src="{{$currencies[0]->firstMedia('icon')->getUrl()}}" alt="{{__($currencies[0]->name)}}"> {{__($currencies[0]->short_name)}}

													@else

													<span>{{__('Not Available')}}</span>

													@endif


												  </button>
												  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">


                           @foreach($currencies as $cIndex=> $currency)


                            <a class="dropdown-item" data-id="{{$currency->id}}" href="#">

                                 @if($currency->hasMedia('icon'))
    
                                      

                      <img src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 

                      @endif

                      {{__($currency->short_name)}} 


                            </a>

                            @endforeach
											



												  </div>

												  <input type="hidden" name="currency_id" id="coin_id" value="{{$currencies[0]->id??''}}">
												</div>
												<input type="text" name="collateral_amount" id="collateral_quantity" value="">
											</div>

											  @error('collateral_amount')
                                <p class="invalid-value text-danger" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </p>
                                @enderror
											  @error('currency_id')
                                <p class="invalid-value text-danger" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </p>
                                @enderror
										</div>
									</div>
								</div>
								<div class="xs-v visible-xs">
									<div class="col-lg-12 col-sm-12 col-12">
										<label><input type="checkbox" name="is_wallet" id="" class="backend-is-wallet-mobile" /> Use Wallet Balance</label>
									</div>
								</div>
								<div class="col-lg-4  col-12 col-sm-4">
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-12">
											<label>Loan Amount</label>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-12">
											<div class="multi_form">
												<div class="backend-fiat-dropdown dropdown currency_two three_coins crypto">
												  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												   @if( isset($currencies[0]) && $currencies[0]->hasMedia('icon'))

													<img src="{{$currencies[0]->firstMedia('icon')->getUrl()}}" alt="{{__($currencies[0]->name)}}"> {{__($currencies[0]->short_name)}}

													@else

													<span>{{__('Not Available')}}</span>

													@endif
												  </button>
												  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">

												  	@foreach($currencies as $cIndex=> $currency)


                            <a class="dropdown-item" data-id="{{$currency->id}}" href="#">

                                 @if($currency->hasMedia('icon'))
    
                                      

                      <img src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 

                      @endif

                      {{__($currency->short_name)}} 



                            </a>

                            @endforeach
											
												  </div>
                                            <input type="hidden" name="loan_currency" id="backend-fiat-coin-id" value="{{$currencies[0]->id??''}}">

												</div>
												<input style="width:65%;" type="text" name="loan_amount" readonly="" id="backend-loan-amount" value="">
											</div>
											  @error('loan_currency')
                                <p class="invalid-value text-danger" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </p>
                                @enderror
										</div>
									</div>
								</div>
								<div class="col-lg-3  xs-top col-12 col-sm-4">
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-12">
											<label>Loan Term Value</label>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-12">
											<div class="days">
												<div class="row">


													@foreach($terms as $tIndex=> $term)


													<div class="col-lg-4  col-4 col-sm-4">
														<a class="@if($tIndex==0)active @endif" href="javascript:void(0)" onclick="activeThisTerm(this,{{$term->id}})">
															<b>{{$term->terms_percentage}}%</b><br>
															{{$term->no_of_duration}} {{$term->duration_type}}
														</a>
													</div>
												@endforeach

                                    <input type="hidden" name="term" id="backend-loan-term-id" value="{{$terms[0]->id}}">
												</div>
											</div>

											  @error('term')
                                <p class="invalid-value text-danger" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </p>
                                @enderror

										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 hidden-xs check col-sm-12 col-12">
									<label><input type="checkbox" name="is_wallet" class="backend-is-wallet" /> Use Wallet Balance</label>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 col-sm-12 col-12">
									<div class="loan-duration">
										<div class="row">
											<div class="col-lg-4 b-right col-sm-4 col-12">
												<h5>Loan Duration</h5>
												<h4 id="backend-term-days">{{$terms[0]->no_of_duration??30}} {{$terms[0]->duration_type}}</h4>
												<p>The interest rate 2.1% will be charge on the loan amount.</p>
											</div>
											<div class="col-lg-4 b-right col-sm-4 col-12">
												<h5>Price down limit</h5>
												<h4 id="backend-price-down-limit">{{$loan_variables->loan_price_down_limit}}% or <plimit>35279.76 </plimit><span id="backend-limit-text">BTC/USDT</span></h4>
												<!-- <p>Add more collateral and extend PDL</p> -->
											</div>
											<div class="col-lg-4 col-sm-4 col-12">
												<h5>Loan repayment</h5>
												<h4 id="backend-loan-repayment">----</h4>
												<p>Full repayment required only for full collateral return.</p>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>	
						<div class="close-price">
							<div class="row">
								<div class="col-lg-8 b-right col-sm-8 col-12">
									<label><input type="checkbox" name="set_close_price" id="backend-set-close-price" /> Set close price at  <formL><input type="number" name="close_price" id="backend-close-price" placeholder="Enter amount"/><button type="button">USDT</button></formL>
                                  
                                   @error('close_price')
                                <p class="invalid-value text-danger" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </p>
                                @enderror

									</label>
								</div>
								<div class="col-lg-4 col-sm-4 col-12">
									<div class="row">
										<div class="col-lg-12 text-right col-sm-12 col-12">
											<p>Min: <span id="backend-min-price">1,797,994.87</span> USDT &nbsp;&nbsp; <mark>Max: <span id="backend-max-price">1,797,994.87</span> USDT</mark></p>
										</div>
									</div>	
									<div class="row">
										<div class="col-lg-12 text-right col-sm-12 col-12">
											<p><a href="#">Know More</a></p>
										</div>
									</div>	
								</div>
							</div>
						</div>
						<div class="final-loan">
							<div class="row">
								<div class="col-lg-6 col-sm-6 col-12">
									<div class="row">
										<div class="col-lg-6 col-sm-6 col-12">
											<label>Final Loan Amount</label>
											<h3 id="backend-final-loan-amount">-----</h3>
										</div>
										<div class="col-lg-6 col-sm-6 col-12">
											<label>Collateral Amount</label>
											<h3 id="backend-collateral-amount">-----</h3>
										</div>
									</div>
								</div>
								<div class="col-lg-6 read col-sm-6 col-12">
									<div class="row">
										<div class="col-lg-6 col-sm-6 col-12">
										<!-- 	<label><input type="checkbox"/> I have read and I agree to <a href="#">Route Staking Service Agreement</a></label> -->
										</div>
										<div class="col-lg-6 col-sm-6 col-12">
											<a href="javascript:void(0)" onclick="submitthisForm()" class="btn-info" data-bs-toggle="modal" data-bs-target="#exampleModalloan">GET LOAN</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


		</form>
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
			<div class="how-to-start">
				<div class="container">
					<div class="row">
						<div class="col-lg-12 text-center col-sm-12 col-xs-12">
							<h2>How to start?</h2>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-sm-6 col-xs-12 text-center">
							<img class="hide_dark" src="{{asset('front/img/how_to_process.png')}}" alt="">
							<img class="show_white" src="{{asset('front/img/how_to_process_white.png')}}" alt="">
						</div>
						<div class="col-lg-6 col-sm-6 col-xs-12">
							<ul>
								<li>Borrower creates a loan request.</li>
								<li>Transfer borrower’s Collateral Assets to our platform.</li>
								<li>Borrower gets a loan from Binance.</li>
								<li>Once loan and interest are repaid, crypto assets will
								be returned to the borrower.</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
      </div> 
   </section>


@endsection


@section('page_scripts')

<script type="text/javascript">

	var error=0;

	function submitthisForm()
	{
		error=0;

		if($('[name="currency_id"]').val()=='')
		{
			$('[name="currency_id"]').parents('.multi_form').eq(0).after('<p class="text-danger text-bold validateError">{{__("The collateral Coin is required.")}}</p>');

			error=1;
		}

		if(($('[name="collateral_amount"]').val()<=0 || $('[name="collateral_amount"]').val()=='') || isNaN($('[name="collateral_amount"]').val()))
		{
			$('[name="collateral_amount"]').parents('.multi_form').eq(0).after('<p class="text-danger text-bold validateError">{{__("The collateral amount is required and must be number.")}}</p>');

			  error=1;
		}

		if($('[name="loan_currency"]').val()=='')
		{
			$('[name="loan_currency"]').parents('.multi_form').eq(0).after('<p class="text-danger text-bold validateError">{{__("The loan Coin is required.")}}</p>');

			    error=1;
		}

		if(!error)
		{

		    $('#backend-loan-form').submit();

		}
	}

	var wallets=@json($wallets);

var currencies=@json($currencies);


var crypto_exchange_rates={!! $crypto_rates !!};


var usdPrice=0;

var terms=@json($terms);

var term=@json($terms[0]??'');

var price_down_limit='{{$loan_variables->loan_price_down_limit}}';

var set_price_min='{{$loan_variables->loan_min_percentage}}';

var set_price_max='{{$loan_variables->loan_max_percentage}}';


// crypto_exchange_rates.forEach(function(v,i){
// 	console.log(v);

// 	return false;
// })



	

</script>

@include('front.loan.request-script')


@endsection