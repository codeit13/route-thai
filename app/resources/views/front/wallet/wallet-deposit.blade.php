@extends('layouts.front')
@section('title')
    Route: P2P Trading Platform
@endsection
@section('content')
<div class="progress-section visible-xs">
	<h2>{{__('Request Asset')}}</h2>
</div>
<section id="wallet-content" class="request">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 hidden-xs col-sm-12 col-12">
				<div class="white-box">
					<div class="row">
						<div class="col-lg-6 col-sm-6 col-6">
							<h3>{{__('Request Asset')}}</h3>
						</div>
						<div class="col-lg-6 text-right col-sm-6 col-6">
							<a data-toggle="modal" data-target="#exampleModalnew" class="btn-success">{{__('Transfer')}}</a>
							<a href="{{route('p2p.exchange')}}" class="btn-primary">{{__('P2P Trading')}}</a>
							<a class="mobile-tag" href="#"><img src="{{asset('front/img/icon-13.png')}}" alt=""/></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12  col-sm-12 col-12 xs-flush">
				<div class="white-box m-top-0">
					<ul class="janral-head">
						@foreach($currency_types as $index => $currency_type)


						@if(isset($walletType->id) && $walletType->id==$currency_type->id)

						<li class="active"><a href="#">{{__($currency_type->type)}}</a></li>
						@elseif(!isset($walletType->id) && $index==0)
						<li class="active"><a href="#">{{__($currency_type->type)}}</a></li>
						@else
						<li class=""><a href="{{route('wallet.deposit',['type'=>$currency_type->id,'typename'=>strtolower($currency_type->type)])}}">{{__($currency_type->type)}}</a></li>
						@endif


						

						@endforeach
					
						<li class="last"><a href="#"><img src="{{asset('front/img/icon-13.png')}}" alt=""/></a></li>
					</ul>
					<div class="row">
						<div class="col-lg-6 p-text col-sm-6 col-12">
							<form method="POST" action="{{ route('wallet.create.deposit') }}" enctype="multipart/form-data">
								@csrf


							



								  <div class="field">
                    <label>{{__('Coin')}}</label>
                    <div class="dropdown currency_two three_coins crypto currencyDropdown">

                    	@php

                       if(!(isset($currenctCurrency)) && !$currentCurrency)
                      {
                          $currentCurrency=old("currency_id");
                      }

                        @endphp

                        @foreach($currencies as $cIndex=> $currency)

                    @if($currency->id==$currentCurrency)

                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                      @if($currency->hasMedia('icon'))
    
                                      

                      <img style="max-width: 28px;" src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 

                      @endif

                      {{__($currency->short_name)}} <span>{{__($currency->name)}}</span>
                      </button>
                      @endif

                      @endforeach

                      
                    @if(!$currentCurrency && isset($currencies[0]->id))



                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                      @if($currencies[0]->hasMedia('icon'))
    
                                      

                      <img style="max-width: 28px;" src="{{$currencies[0]->firstMedia('icon')->getUrl()}}" alt="{{__($currencies[0]->name)}}"/> 

                      @endif

                      {{__($currencies[0]->short_name)}} <span>{{__($currencies[0]->name)}}</span>
                      </button>



                    @endif



                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                           @foreach($currencies as $cIndex=> $currency)

                            <a class="dropdown-item" data-id="{{$currency->id}}" href="#">

                                 @if($currency->hasMedia('icon'))
    
                                      

                      <img style="max-width: 28px;" src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 

                      @endif

                      {{__($currency->short_name)}} <span>{{__($currency->name)}}</span>



                            </a>


                    @endforeach
                           <!--    <a class="dropdown-item" href="#"><img src="img/bitcoin.png" alt=""> BTC <span>Bitcoin</a>
                        <a class="dropdown-item" href="#"><img src="img/icon-5.png" alt=""> ETH <span>Ethereum</a>
                        <a class="dropdown-item" href="#"><img src="img/icon-6.png" alt=""> BNB <span>BNB</span></a> -->
                      </div>
                    </div>
                    <input type="hidden" name="currency_id" id="coin_id" value="{{($currentCurrency)?$currentCurrency:($currencies[0]->id??'')}}"/>
                          @error('currency_id')
                                <p class="invalid-value" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </p>
                                @enderror

                                <span class="total">{{__('Total balance')}}: <b id="totalBalance">0.00000000 {{__('BTC')}}</b></span>
                  </div>

						

						
								<div class="field qq">
									<!-- <label>Quantity</label> -->
									<div class="form-group">
                                        <label for="quantity">{{__('Quantity')}}</label>
                                        <input type="text" name="quantity" class="form-control @error('quantity') is-invalid @enderror"   required="" id="quantity" aria-describedby="emailHelp" autocomplete="e-m-a-i-l" autofocus="" value="{{old('quantity')}}">
                                    </div>
                                     @error('quantity')
                                <p class="invalid-value" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </p>
                                @enderror
								</div>
								<div class="field">
									<div class="input-group">
										<div class="custom-file">
											<input type="file" class="custom-file-input" id="inputGroupFile01" name="transaction_image">
											<label class="custom-file-label" for="inputGroupFile01">{{__('Upload')}}</label>
										</div>
									</div>

								</div>
								@error('transaction_image')
                                <p class="invalid-value" role="alert">
                                    <strong>{{__('This field is required.') }}</strong>
                                </p>
                                @enderror
								<div class="field">
									<button id="depositSubmit" type="submit">{{__('Request')}}</button>
									<!-- <button type="button" data-toggle="modal" data-target="#exampleModal1">Request</button> -->
								</div>
							</form>	
							<p>1. If you have deposited, please pay attention to the text messages,
							site letters and emails we send to you.</p>
							<p>2. Coins will be deposited after 1 network confirmations.</p>
							<p>3. Until 2 confirmations are made, an equivalent amount of your assets
							will be temporarily unavailable for withdrawals.</p>
						</div>
						<div class="col-lg-6 xs-flush col-sm-6 col-12">
								<div class="white-box deposite_second_sec">

									@foreach($currencies as $c_index => $currency)


										@php 

										$ulDisplay='d-none';

										if(isset($currentCurrency) && $currentCurrency==$currency->id)

										{

										   $ulDisplay='';
                                           
										}


										elseif($c_index==0 && !$currentCurrency)
										{
											$ulDisplay='';
										}

										@endphp

									<ul class="nav nav-tabs mainTabs {{$ulDisplay}}" id="MainTab__{{$currency->id}}" role="tablist">

										



										<li class="nav-item">	<a class="nav-link active" id="li_tab_{{$currency->id}}" data-toggle="tab" href="#currency_tab_{{$currency->id}}" role="tab" aria-controls="home" aria-selected="true">{{__($currency->short_name)}}</a>

										</li>
										

										{{--<li class="nav-item">	<a class="nav-link active" id="li_tab_{{$currency->id}}"data-toggle="tab" href="#currency_tab_{{$currency->id}}" role="tab" aria-controls="home" aria-selected="true">{{__($currency->short_name)}}</a></li>

										@else

										<li class="nav-item d-none">	<a class="nav-link" id="li_tab_{{$currency->id}}" data-toggle="tab" href="#currency_tab_{{$currency->id}}" role="tab" aria-controls="home" aria-selected="true">{{__($currency->short_name)}}</a></li>


										@endif --}}


										


								
									</ul>
									@endforeach
								<!-- 	<div class="col-lg-12 xs-flush heading-p text-center col-sm-12 col-12">
										<p>Network Name: Bitcoin(BTC)&nbsp;&nbsp;Average arrival time: 1 minutes</p>
									</div> -->
									

										@foreach($currencies as $c_index => $currency)

										@php 

										      $tab='';

										      $container='d-none';

                                             if($currentCurrency && $currentCurrency==$currency->id)
                                             {

                                             $tab='show active';

                                            $container='';

                                             }
                                             elseif($c_index==0 && !$currentCurrency)
                                             {

                                               $tab='show active';
                                            $container='';


                                             }
										
									


										@endphp

										<div class="tab-content containerTabs {{$container}}" id="myTabContent__{{$currency->id}}">

										<div class="tab-pane fade show active" id="currency_tab_{{$currency->id}}" role="tabpanel" aria-labelledby="home-tab">

												<div class="col-lg-12 xs-flush heading-p text-center col-sm-12 col-12 position-relative">
										<p>Network Name: {{__($currency->name)}}({{__($currency->short_name)}})&nbsp;&nbsp;Average arrival time: 1 minutes</p>
									</div>

									<h6 class="backend-copied-elem text-center position-relative" style="top:53px; z-index:1000;margin-top:-26px;display:none"><b style="padding:5px 17px;border-radius:4px;background:#8c8383;font-weight:normal;color: white;">Copy Successful</b></h6>

											<div class="gray-c" >

												

												<div class="col-12">
													<h6>{{__("Address")}}</h6>
												</div>
												<div class="col-12">
													<div class="row">
														<div class="col-6 col-sm-6 col-lg-6">
															<h3 class="backend-deposit-address">{{$currency->deposit_address->address??''}}</h3>
															<input type="hidden" class="backend-deposit-address-value" value="{{$currency->deposit_address->address??''}}" name="fdfsf">
														</div>
														<div class="col-6 text-right col-sm-6 col-lg-6">
															<!-- <img class="small_mobiledd" src="{{asset('front/img/icon-14.png')}}" alt=""> -->
															<ul>
																<li><a href="javascript:void(0)" data-bs-toggle="tooltip" data-bs-placement="top" onclick="copyAddress('{{$currency->deposit_address->address??''}}')" title="Copy Address"><i class="fa fa-clone" aria-hidden="true"></i></a></li>
																<li class="css-11nldkw">
																	<a href="#"><i class="fa fa-qrcode" aria-hidden="true"></i></a>
																	<div class="QrCode css-jac2fa"><div class="css-ghsb4z"></div>
																	@if(isset($currency->deposit_address) && $currency->deposit_address->hasMedia('qr_code'))

																	<canvas height="120" width="120" style="height: 120px; width: 120px; background: url({{$currency->deposit_address->firstMedia('qr_code')->getUrl()}});"></canvas>

																	@endif
																</div>
																</li>
															</ul>
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 btc-c">
												<div class="row">
													<div class="col-lg-9 col-sm-8 col-8">
														<h5>Send only {{__($currency->short_name)}} to this deposit address.</h5>
														<p>Sending coin or token other than {{__($currency->short_name)}} to this address may result in the loss of your deposit.</p>
													</div>
													<div class="col-lg-3 text-center col-sm-4 col-4">

														   @if($currency->hasMedia('icon'))
    
                                      

                      <img style="max-width: 48px;" class="small_mobile" src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 

                      @endif
													<!-- 	<img class="small_mobile" src="{{asset('front/img/icon-15.png')}}" alt=""> -->
													</div>
												</div>
											</div>
										</div>
										</div>

										@endforeach

									<!-- 	<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
											<div class="gray-c">
												<div class="col-12">
													<h6>Address</h6>
												</div>
												<div class="col-12">
													<div class="row">
														<div class="col-6 col-sm-6 col-lg-6">
															<h3>1JFAe8qq9wshJRLkdia3zZ94Nk9VLc4W3y</h3>
														</div>
														<div class="col-6 text-right col-sm-6 col-lg-6">
															<img src="img/icon-14.png" alt="">
														</div>
													</div>
												</div>
											</div>
											<div class="col-12 btc-c">
												<div class="row">
													<div class="col-lg-9 col-sm-8 col-8">
														<h5>Send only BTC to this deposit address.</h5>
														<p>Sending coin or token other than BTC to this address may result in the loss of your deposit.</p>
													</div>
													<div class="col-lg-3 text-center col-sm-4 col-4">
														<img src="img/icon-15.png" alt="">
													</div>
												</div>
											</div>
										</div>
										<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
										<div class="tab-pane fade" id="erc" role="tabpanel" aria-labelledby="contact-tab">...</div>
										<div class="tab-pane fade" id="btc" role="tabpanel" aria-labelledby="contact-tab">...</div> -->
									
								</div>
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@include('front.components.transfer-modal')

<!-- Modal -->
<div class="modal alert_poup fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
	<div class="modal-content">
	   <div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		  </button>
	   </div>
	   <div class="modal-body">
		  <img src="{{ asset('img/Image 17.png') }}" class="header_img" alt="">
		  <img src="{{ asset('img/coin_base.svg')}}" class="header_img"  alt="">
		  <img src="{{ asset('img/bitCoinBig.svg')}}" class="header_img"  alt="">
		  <h2>10.99%</h2>
		  <a href="#" class="btn-primary btn" class="close" data-dismiss="modal" aria-label="Close">Close this alert</a>
	   </div>
	</div>
 </div>
</div>


@endsection

@section('page_scripts')
<script> 

    $(document).ready(function(){
        $('.bxslider').bxSlider({
            auto:false,
            controls:true,
            pager:false,
            slideWidth: 280,
            minSlides: 1,
            maxSlides: 4,
            moveSlides: 1,
            slideMargin: 0,
            speed: 300,
            touchEnabled: true
        });

        
    });
</script>

<script>
var wallets=@json($wallets);

var currencies=@json($currencies);



$("ul.btc").on("click", ".init", function() {
    $(this).closest("ul.btc").children('li:not(.init)').toggle();
});

var allOptions = $("ul.btc").children('li:not(.init)');
$("ul.btc").on("click", "li:not(.init)", function() {
    allOptions.removeClass('selected');
    $(this).addClass('selected');
    $("ul.btc").children('.init').html($(this).html());
    allOptions.toggle();

    var coin_id=$(this).attr('data-value');

   
   changeShowBalance(coin_id);


    

    $('#coin_id').val(coin_id);
});

$(".currencyDropdown .dropdown-menu .dropdown-item").on("click", function(e) { e.preventDefault();

      var currency_id=$(this).attr('data-id');

   changeShowBalance(currency_id);


    $('#coin_id').val(currency_id);

    $('.currencyDropdown .dropdown-toggle').html($(this).html());

    $('.mainTabs').siblings(':not(.d-none)').addClass('d-none');

    //console.log($('#MainTab__'+currency_id));

    

    $('.containerTabs').siblings(':not(.d-none)').addClass('d-none');

    $('#MainTab__'+currency_id).removeClass('d-none');


    $('#myTabContent__'+currency_id).removeClass('d-none');


   
});

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

var currentCurrency='{{($currentCurrency)?$currentCurrency:$currencies[0]->id??''}}';


changeShowBalance(currentCurrency);

$(document).on('keyup','#quantity',function()
{

    var quantity=parseFloat($(this).val());

   
    if(quantity <=0)
    {
       $('#depositSubmit').attr('disabled',true).css('opacity','0.5');
    }
    else
    {
      
      $('#depositSubmit').attr('disabled',false).css('opacity','1.0');

    }

})

// function copyAddress(address)
// {
// 	console.log(address);
// }

function copyAddress(text) {
 const elem = document.createElement('textarea');
   elem.value = text;
   document.body.appendChild(elem);
   elem.select();
   document.execCommand('copy');
   document.body.removeChild(elem);
  document.execCommand("copy");

  $('.backend-copied-elem').css('display','block');

  setTimeout(function(){

  $('.backend-copied-elem').css('display','none');
   
  },1000);
}



</script>


@include('front._inc.transfer-js')

@endsection    