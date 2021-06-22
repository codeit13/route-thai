@extends('layouts.front')
@section('title')
    Route: Loan Request
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

		.dropdown.currency_two.three_coins.crypto button#dropdownMenuButton img {
    float: left !important;
    width: 18px;
    margin-right: 10px;
    margin-top: 6px;
}

.dropdown.currency_two.three_coins button#dropdownMenuButton{
	padding-top: 0;
	background: #f6f6f6 !important;
	border: none !important;
}

.dropdown.currency_two.three_coins button#dropdownMenuButton::after{
	float: revert;
}


	</style>

@endsection

@section('content')

@php

$loanUsdt=$loan->loan_currency_rate;
$current_loan_currency=$loan->loan_currency_id;



@endphp

  <section id="banner_search" class="loans-deshboard desh-2 visible-xs">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 text-center col-sm-12 col-12">
               <h2><img src="{{asset('front/img/img-6.png')}}" alt=""/> Repay Loan</h2>
            </div>
         </div>
      </div> 
   </section>
	<section id="your-application" class="repay-details">
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
                        
							@break;

							@endswitch
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-sm-6 col-6">
							<label>Order Date:{{$loan->created_at->isoFormat('Do-MMMM-Y')}} <span>|</span> {{$loan->created_at->isoFormat('h:mm a')}}</label>
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
										</h5>
									</div>
									<div class="col-lg-4 col-sm-4 col-7">
										<h6>Current value</h6>
										

										 {{$loan->collateral_currency->short_name}}: <b>{{number_format($loan->current_value,2)}}</b> USDT <a href="#"><!-- +0.73%; --></a></p>
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
									<div class="col-lg-4 xs-text-right col-sm-4 col-6">
										<h6>PDL</h6>
										<h5><a>+0.73%;</a></h5>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 col-sm-12 col-5">
						<!-- 	<a href="{{route('loan.close',$loan->loan_id)}}" class="btn-info close-now">Close now</a> -->
						</div>
						<!-- <div class="visible-xs xs-l-flush col-7">
							<a href="#" class="btn-info repay-now">REPAY LOAN</a>
							<p class="red-position">Repay to 8 days (21st Sep, 2021 14:23)</p>
						</div> -->
					</div>
				</div>
				<div class="col-lg-5 repay col-sm-12 col-12">
					<h3 class="hidden-xs">Repay Loan <a href="#"><img src="{{asset('front/img/close-new.png')}}" alt=""/></a></h3>
					<div class="use-wallet">
						<form action="{{route('loan.close.request',$loan->loan_id)}}" method="post" id="backend-loan-repay-form">
							@csrf
						<div class="crypto-b">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<li class="nav-item">
									<a class="nav-link active show backend-loan-method" data-type="wallet" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Use wallet Balance</a>
								</li>
								<li class="nav-item">
									<a class="nav-link backend-loan-method" data-type="custom" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Use Crypto Balance</a>
								</li>
							</ul>

							<input type="hidden" name="payment_method" class="backend-loan-payment-method" value="wallet">

							<input type="hidden" name="loan_amount" value="{{$loan->loan_amount}}">
							<input type="hidden" name="loan_repayment_amount" value="{{$loan->loan_repayment_amount}}">

						</div>
						<div class="tab-content" id="myTabContent">
							<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
								<div class="amount">
									<h5>Repayment amount</h5>
									<div class="usd-amound">
										<div class="row">

											<div class="col-lg-6 col-sm-6 col-6">
												<!-- <button>USD <img src="{{asset('front/img/cart-new.png')}}" alt=""/></button> -->
												<div class="dropdown currencyDropdown currency_two three_coins crypto">

													@foreach($currencies as $cIndex=> $currency)

													@if($currency->id== $loan->loan_currency_id)

													@php 

													$created_button=1;





													@endphp

												  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                              @if($currency->hasMedia('icon'))

													<img src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"> {{__($currency->short_name)}}

													@endif

													


												  </button>
												  @endif

												  @endforeach

												  @if(count($currencies) < 0 )
                                                 <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                             <span>Not available</span>

													


												  </button>

												  @elseif(!(isset($created_button)))

												  @php 

													$current_loan_currency=$currencies[0]->id;


												  @endphp

											 <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

  

                                 @if($currencies[0]->hasMedia('icon'))
    
                                      

                      <img src="{{$currencies[0]->firstMedia('icon')->getUrl()}}" alt="{{__($currencies[0]->name)}}"/> 

                      @endif

                      {{__($currencies[0]->short_name)}} 


                            


													


												  </button>
 
												  @endif
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

												  <input type="hidden" name="currency_id" class="backend-coin-class"  value="{{$current_loan_currency??''}}">

												</div>

											</div>	


											<div class="col-lg-6 text-right col-sm-6 col-6 backend-loan-repayment">
											 {{$loan->loan_repayment_amount}}
											</div>
										</div>	

									</div>
									@error('loan_repayment_amount')
                                <p class="invalid-value text-danger" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </p>
                                @enderror
								</div>
								<div class="wallet-b">
									<p class="backend-wallet-balance">Wallet Blance: <b>{{$loan->loan_currency->user_balance??0.00000}}</b> {{$loan->loan_currency->short_name}}</p>

								


									
									<div class="row tb-w">
										<div class="col-lg-6 col-sm-6 col-6">
											<label>Repaid Principal</label>
										</div>
										<div class="col-lg-6 text-right col-sm-6 col-6">
											<label class="backend-loan-principal"><b>{{$loan->loan_amount}}</b> {{$loan->loan_currency->short_name}}</label>
										</div>
									</div>
									<div class="row tb-w">
										<div class="col-lg-6 col-sm-6 col-6">
											<label>Repaid Interest</label>
										</div>
										<div class="col-lg-6 text-right col-sm-6 col-6">
											<label class="backend-loan-interest"><b>{{$loan->loan_repayment_amount-$loan->loan_amount}}</b> {{$loan->loan_currency->short_name}}</label>
										</div>
									</div>
									<div class="row tb-w">
										<div class="col-lg-6 col-sm-6 col-6">
											<label class="black-c"><b>Total</b></label>
										</div>
										<div class="col-lg-6 text-right col-sm-6 col-6">
											<label class="backend-loan-total"><b>{{$loan->loan_repayment_amount}}</b>{{$loan->loan_currency->short_name}}</label>
										</div>
									</div>
								</div>
								<div class="collateral-w">
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-12">
											<h5>Collateral wallet details</h5>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-12">
											<input type="text" name="crypto_wallet_address" placeholder="Enter your wallet address"/>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 col-sm-6 hidden-xs visible-sm col-6">
											<img src="{{asset('front/img/bitcoin-new.png')}}" alt=""/>
										</div>
										<div class="col-lg-6 text-right col-sm-6 col-12">
											<a href="javascript:void(0)" onclick="submitForm()" class="btn-info">Confirm repayment</a>
										</div>
									</div>
								</div>
							</div>	
							<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
								<div class="amount">
									<h5>Repayment amount</h5>
									<div class="usd-amound">
										<div class="row">
											<div class="col-lg-6 col-sm-6 col-6">
													<div class="dropdown currencyDropdown currency_two three_coins crypto">

														@foreach($currencies as $cIndex=> $currency)

													@if($currency->id== $loan->loan_currency_id)

													@php 

													$created_button=1;





													@endphp

												  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                              @if($currency->hasMedia('icon'))

													<img src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"> {{__($currency->short_name)}}

													@endif

													


												  </button>
												  @endif

												  @endforeach

												  @if(count($currencies) < 0 )
                                                 <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                                             <span>Not available</span>

													


												  </button>

												  @elseif(!(isset($created_button)))

												  @php 

													$current_loan_currency=$currencies[0]->id;


												  @endphp

											 <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

  

                                 @if($currencies[0]->hasMedia('icon'))
    
                                      

                      <img src="{{$currencies[0]->firstMedia('icon')->getUrl()}}" alt="{{__($currencies[0]->name)}}"/> 

                      @endif

                      {{__($currencies[0]->short_name)}} 


                            


													


												  </button>
 
												  @endif
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

												  <input type="hidden" name="currency_id" class="backend-coin-class"  value="{{$current_loan_currency??''}}">

												</div>
											</div>	
											<div class="col-lg-6 text-right col-sm-6 col-6 backend-loan-repayment">
												 {{$loan->loan_repayment_amount}}
											</div>
										</div>	
									</div>
								</div>
								<div class="wallet-b">
										<p class="backend-wallet-balance">Wallet Blance: <b>{{$loan->loan_currency->user_balance??0.00000}}</b> {{$loan->loan_currency->short_name}}</p>
									<div class="row tb-w">
										<div class="col-lg-6 col-sm-6 col-6">
											<label>Repaid Principal</label>
										</div>
										<div class="col-lg-6 text-right col-sm-6 col-6">
											<label class="backend-loan-principal"><b>{{$loan->loan_amount}}</b> {{$loan->loan_currency->short_name}}</label>
										</div>
									</div>
									<div class="row tb-w">
										<div class="col-lg-6 col-sm-6 col-6">
											<label>Repaid Interest</label>
										</div>
										<div class="col-lg-6 text-right col-sm-6 col-6">
											<label class="backend-loan-interest"><b>{{$loan->loan_repayment_amount-$loan->loan_amount}}</b> {{$loan->loan_currency->short_name}}</label>
										</div>
									</div>
									<div class="row tb-w">
										<div class="col-lg-6 col-sm-6 col-6">
											<label class="black-c"><b>Total</b></label>
										</div>
										<div class="col-lg-6 text-right col-sm-6 col-6">
											<label class="backend-loan-total"><b>{{$loan->loan_repayment_amount}}</b></label>
										</div>
									</div>
								</div>
								<div class="col-lg-12 col-sm-12 col-12">
									<div class="network-w">
										<div class="row">
											<div class="col-lg-6 b-right col-sm-6 col-12">
												<label>Loan Repayment Address <img src="{{asset('front/img/bitcoin.png')}}" alt=""/></label>
												<p>Network Name: <b>BTC</b><br>
												Average arrival time: <b>1 minutes</b></p>
											</div>
											<div class="col-lg-6 col-sm-6 col-12">
												<label>Address</label>
												<div class="row top-n">
													<div class="col-lg-9 col-sm-9 col-9">
														<p>1JFAe8qq9wshJRLkdia3
														zZ94Nk9VLc4W3y</p>
													</div>	
													<div class="col-lg-3 col-sm-3 col-3 flush-left">
														<img src="{{asset('front/img/icon-14.png')}}" alt=""/>
													</div>	
												</div>	
											</div>
										</div>
									</div>
								</div>	
								<div class="collateral-w">
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-12">
											<h5>Collateral wallet details</h5>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-12">
											<input type="text" name="crypto_wallet_address" placeholder="Enter your wallet address"/>
										</div>
									</div>
									<div class="row">
										<div class="col-lg-6 col-sm-6 hidden-xs visible-sm col-6">
											<img src="{{asset('front/img/bitcoin-new.png')}}" alt=""/>
										</div>
										<div class="col-lg-6 text-right col-sm-6 col-12">
											<a href="javascript:void(0)" onclick="submitForm()" class="btn-info">Confirm repayment</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>

				</form>


				</div>
			</div>
		</div> 
	</section>

	@endsection

	@section('page_scripts')

	<script type="text/javascript">

		var currencies=@json($currencies);

		var crypto_exchange_rates=@json($crypto_exchange_rates);

		var wallets=@json($wallets);


		function submitForm()
		{
			$('#backend-loan-repay-form').submit();
		}
		
		$(document).ready(function(){

	$(".currencyDropdown .dropdown-menu .dropdown-item").on("click", function(e) { e.preventDefault();

      var currency_id=$(this).attr('data-id');

   //changeShowBalance(currency_id);


    $('.backend-coin-class').val(currency_id);

    $('.currencyDropdown .dropdown-toggle').html($(this).html());

    updateBalance();

 // showCurrencyRate();

 
});

	$(document).on('click','.backend-loan-method',function()
	{
		if($(this).attr('data-type')=='wallet')
		{
			$('.backend-loan-payment-method').val('wallet');
		}
		else
		{
			$('.backend-loan-payment-method').val('');

		}
	})

});

		function get_currency_row_by_id(currency_id)
    {

	var currency=currencies.find(function(currency)
    {
       return currency.id==currency_id;
    })

    return currency;
    }

wallet_balance();

		function updateBalance()
		{
			var coin= $('.backend-coin-class').val();

			var cryptoRow=get_currency_row_by_id(coin);

			var filteredCryptoExchangeRow=get_crypto_exchange_row(cryptoRow);

		//	wallet_balance();

   	//console.log(cryptoRow);
           usdtPrice=parseFloat(filteredCryptoExchangeRow.lastPrice);

           var loan_amount=parseFloat('{{$loan->loan_amount}}');

           var repay_amount=parseFloat('{{$loan->loan_repayment_amount}}');

           var newUsdt=usdtPrice/parseFloat('{{$loanUsdt}}');

           console.log(newUsdt,usdtPrice);

           var only_loan_amount=(loan_amount/newUsdt).toFixed(5);

           var newLoanAmount=(repay_amount/newUsdt).toFixed(5);

           var newInterest=((repay_amount-loan_amount)/newUsdt).toFixed(5);

           var loan_currency='{{$loan->loan_currency_id}}';

           if(cryptoRow.id==loan_currency)
           {
           	  newLoanAmount=repay_amount;

           	  only_loan_amount=loan_amount;

           	  newInterest=(repay_amount-loan_amount).toFixed(5);
           }


           $('[name="loan_amount"]').val(only_loan_amount);
           $('[name="loan_repayment_amount"]').val(newLoanAmount);




           

           $('.backend-loan-total').html('<b>'+newLoanAmount+'</b>&nbsp;'+cryptoRow.short_name);

           $('.backend-loan-repayment').html(newLoanAmount);

           $('.backend-loan-interest').html('<b>'+newInterest+'</b>&nbsp;'+cryptoRow.short_name);

           $('.backend-loan-principal').html('<b>'+only_loan_amount+'</b>&nbsp;'+cryptoRow.short_name);



         wallet_balance();


		}

		function get_crypto_exchange_row(cryptoRow)
{
	var crypto_exchange_row= crypto_exchange_rates.find(function(v,i){

		//console.log(v);

	   return v.symbol==cryptoRow.short_name+'USDT';
	})

	if(cryptoRow.short_name=='USDT')
	{
		return {
    "symbol": "USDT",
    "priceChange": "-0.55308000",
    "priceChangePercent": "-31.201",
    "weightedAvgPrice": "1.57545245",
    "prevClosePrice": "1.77265000",
    "lastPrice": "1.00000000",
    "lastQty": "41.00000000",
    "bidPrice": "1.21599000",
    "bidQty": "640.00000000",
    "askPrice": "1.21973000",
    "askQty": "117.00000000",
    "openPrice": "1.77265000",
    "highPrice": "1.89057000",
    "lowPrice": "1.12100000",
    "volume": "131974930.00000000",
    "quoteVolume": "207920226.31104000",
    "openTime": 1623067237426,
    "closeTime": 1623153637426,
    "firstId": 1071985,
    "lastId": 1727494,
    "count": 655510
       }
	}

	//console.log(crypto_exchange_row);

	return crypto_exchange_row;

}

function wallet_balance()
{

	var coin_id=$('.backend-coin-class').val();
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

   // balance=balance+' '+currencyRow.short_name;

    if( balanceRow && typeof balanceRow.coin !='undefined')
    {
         balance=balanceRow.coin;

       
    }

    var loan_repay_currency=currencyRow.loan_repay_currency;

    var crypto_address='<div class="network-w"><div class="row"><div class="col-lg-6 b-right col-sm-6 col-12"> <label>Loan Repayment Address';

    if(currencyRow.image_url.length)
    {

    crypto_address+='<img style="width:28px;" src="'+currencyRow.image_url+'" alt="'+currencyRow.short_name+'">';
    }

    crypto_address+='</label><p>Network Name: <b>'+currencyRow.short_name+'</b><br> Average arrival time: <b>1 minutes</b></p></div><div class="col-lg-6 col-sm-6 col-12"> <label>Address</label><div class="row top-n"><div class="col-lg-9 col-sm-9 col-9"><p>'+loan_repay_currency.crypto_wallet_address+'</p></div><div class="col-lg-3 col-sm-3 col-3 flush-left"> <img src="http://127.0.0.1:8000/front/img/icon-14.png" alt=""></div></div></div></div></div>';

    $('.network-w').replaceWith(crypto_address);

   // console.log(crypto_address);

    $('.backend-wallet-balance').html('Wallet Blance:<b>'+balance+'</b>'+currencyRow.short_name);
}
	</script>


	@endsection