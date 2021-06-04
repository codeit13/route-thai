@extends('layouts.front')
@section('title')
    Route: Loan Request
@endsection
@section('page_styles')
	<link type="text/css" rel="stylesheet" href="{{asset('front/css/datepicker.css')}}" />

@endsection

@section('content')

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

				<p><img src="{{asset('front/img/sm-icon-1.png')}}" alt=""/>&nbsp; BTC:<b id="backend-current-usd-rate">1,797,994.87</b> USD <span>|</span> <a href="#">+0.73%</a></p>

            </div>
         </div>
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

                      {{__($currency->short_name)}} <span>{{__($currency->name)}}</span>



                            </a>

                            @endforeach
												<!-- 	<a class="dropdown-item" href="#"><img src="{{asset('front/img/bitcoin.png')}}" alt=""> BTC <span>Bitcoin</span></a>
													<a class="dropdown-item" href="#"><img src="{{asset('front/img/icon-5.png')}}" alt=""> ETH <span>Ethereum</span></a>
													<a class="dropdown-item" href="#"><img src="{{asset('front/img/icon-6.png')}}" alt=""> BNB <span>BNB</span></a> -->



												  </div>

												  <input type="hidden" name="currency_id" id="coin_id" value="{{$currencies[0]->id??''}}">
												</div>
												<input type="text" name="quantity" id="collateral_quantity" value="">
											</div>
										</div>
									</div>
								</div>
								<div class="xs-v visible-xs">
									<div class="col-lg-12 col-sm-12 col-12">
										<label><input type="checkbox"/> Use Wallet Balance</label>
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
												<div class="dropdown currency_two three_coins crypto">
												  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												   @if( isset($fiat_currencies[0]) && $fiat_currencies[0]->hasMedia('icon'))

													<img src="{{$fiat_currencies[0]->firstMedia('icon')->getUrl()}}" alt="{{__($fiat_currencies[0]->name)}}"> {{__($fiat_currencies[0]->short_name)}}

													@else

													<span>{{__('Not Available')}}</span>

													@endif
												  </button>
												  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start" style="position: absolute; transform: translate3d(0px, 47px, 0px); top: 0px; left: 0px; will-change: transform;">

												  	@foreach($fiat_currencies as $cIndex=> $currency)


                            <a class="dropdown-item" data-id="{{$currency->id}}" href="#">

                                 @if($currency->hasMedia('icon'))
    
                                      

                      <img src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 

                      @endif

                      {{__($currency->short_name)}} <span>{{__($currency->name)}}</span>



                            </a>

                            @endforeach
												<!-- 	<a class="dropdown-item" href="#"><img src="{{asset('front/img/bitcoin.png')}}" alt=""> BTC <span>Bitcoin</span></a>
													<a class="dropdown-item" href="#"><img src="{{asset('front/img/icon-5.png')}}" alt=""> ETH <span>Ethereum</span></a>
													<a class="dropdown-item" href="#"><img src="{{asset('front/img/icon-6.png')}}" alt=""> BNB <span>BNB</span></a> -->
												  </div>


												</div>
												<input style="width:65%;" type="text" name="" value="33899.8">
											</div>
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
													<div class="col-lg-4  col-4 col-sm-4">
														<a class="active" href="#">
															<b>90%</b><br>
															30 days
														</a>
													</div>
													<div class="col-lg-4  col-4 col-sm-4">
														<a class="" href="#">
															<b>90%</b><br>
															30 days
														</a>
													</div>
													<div class="col-lg-4  col-4 col-sm-4">
														<a class="" href="#">
															<b>90%</b><br>
															30 days
														</a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 hidden-xs check col-sm-12 col-12">
									<label><input type="checkbox"/> Use Wallet Balance</label>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 col-sm-12 col-12">
									<div class="loan-duration">
										<div class="row">
											<div class="col-lg-4 b-right col-sm-4 col-12">
												<h5>Loan Duration</h5>
												<h4>30 days</h4>
												<p>Extend at anytime by paying 701.88 USD (2.10%) 
												loan fee.</p>
											</div>
											<div class="col-lg-4 b-right col-sm-4 col-12">
												<h5>Price down limit</h5>
												<h4>5.00% or 35279.76 <span>BTC/USD</span></h4>
												<p>Add more collateral and extend PDL</p>
											</div>
											<div class="col-lg-4 col-sm-4 col-12">
												<h5>Loan repayment</h5>
												<h4>34124.81 <span>USD</span></h4>
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
									<label><input type="checkbox"/> Set close price at  <form><input type="text" placeholder="Enter amount"/><button type="submit">USD</button></form></label>
								</div>
								<div class="col-lg-4 col-sm-4 col-12">
									<div class="row">
										<div class="col-lg-12 text-right col-sm-12 col-12">
											<p>Min: <span>1,797,994.87</span> USD &nbsp;&nbsp; <mark>Max: <span>1,797,994.87</span> USD</mark></p>
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
											<h3>33422.93 <span>USD</span></h3>
										</div>
										<div class="col-lg-6 col-sm-6 col-12">
											<label>Collateral Amount</label>
											<h3>1.00 <span>BTC</span></h3>
										</div>
									</div>
								</div>
								<div class="col-lg-6 read col-sm-6 col-12">
									<div class="row">
										<div class="col-lg-6 col-sm-6 col-12">
											<label><input type="checkbox"/> I have read and I agree to <a href="#">Route Staking Service Agreement</a></label>
										</div>
										<div class="col-lg-6 col-sm-6 col-12">
											<a href="#" class="btn-info" data-bs-toggle="modal" data-bs-target="#exampleModalloan">GET LOAN</a>
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

	var wallets=@json($wallets);

var currencies=@json($currencies);

var crypto_exchange_rates={!! $crypto_rates !!};

var fiat_exchange_rates={!! $fiat_rates !!};

var usdPrice=0;

function numberWithCommas(x) {
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

function showCurrencyRate()
{
	var crypto_id=$('#coin_id').val();

	var cryptoRow=currencies.find(function(currency)
    {
       return currency.id==crypto_id;
    })

   

	var filteredCryptoExchangeRow=crypto_exchange_rates.find(function(v,i){

	   return v.symbol==cryptoRow.short_name+'USDT';
	})


	//$('#backend-current-usd-rate').text(numberWithCommas(parseFloat(filteredCryptoExchangeRow.lastPrice.toFixed(2))));

	usdPrice=filteredCryptoExchangeRow.lastPrice;



	console.log(filteredCryptoExchangeRow);
}

	$(".currencyDropdown .dropdown-menu .dropdown-item").on("click", function(e) { e.preventDefault();

      var currency_id=$(this).attr('data-id');

   changeShowBalance(currency_id);


    $('#coin_id').val(currency_id);

    $('.currencyDropdown .dropdown-toggle').html($(this).html());

  showCurrencyRate();


   
});

	var currentCurrency=$('#coin_id').val();

	changeShowBalance(currentCurrency);

function changeShowBalance(coin_id)
{

    var balance='0.00000';


    var balanceRow=wallets.filter(function(wallet){
          return wallet.currency_id==coin_id;
    })

    balanceRow=balanceRow[0];

    var currencyRow=currencies.filter(function(currency)
    {
       return currency.id==coin_id;
    })

    currencyRow=currencyRow[0];

    balance=balance+' '+currencyRow.short_name;

    if( balanceRow && typeof balanceRow.coin !='undefined')
    {
         balance=balanceRow.coin + ' '+currencyRow.short_name;
    }

    $('#totalBalance').text(balance);
}

$(document).on('keyup','#collateral_quantity',function()
{

    var quantity=parseFloat($(this).val());

    $(this).next('.validateError').remove();
  
    transferSelectedCurrencyBalance=parseFloat(transferSelectedCurrencyBalance);

    if(transferSelectedCurrencyBalance < quantity)
    {
      $(this).addClass('is-invalid');

      $(this).after('<p class="text-danger text-bold validateError">{{__("Withdraw quantity should be less than available balance.")}}</p>');
    }
    else
    {
      $(this).removeClass('is-invalid');

    }

})
	

</script>


@endsection