@extends('layouts.front')
@section('title')
    Route: P2P Trading Platform
@endsection
@section('content')

<section id="wallet-content" class="request">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 hidden-xs col-sm-12 col-12">
				<div class="white-box">
					<div class="row">
						<div class="col-lg-6 col-sm-6 col-6">
							<h3>Request Asset</h3>
						</div>
						<div class="col-lg-6 text-right col-sm-6 col-6">
							<a href="#" class="btn-success">Transfer</a>
							<a href="#" class="btn-primary">P2P Trading</a>
							<a class="mobile-tag" href="#"><img src="img/icon-13.png" alt=""/></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12  col-sm-12 col-12">
				<div class="white-box m-top-0">
					<ul class="janral-head">
						@foreach($currency_types as $index => $currency_type)
						<li class="{{($index==0)?'active':''}}"><a href="#">{{__($currency_type->type)}}</a></li>

						@endforeach
					
						<li class="last"><a href="#"><img src="{{asset('front/img/icon-13.png')}}" alt=""/></a></li>
					</ul>
					<div class="row">
						<div class="col-lg-6 p-text col-sm-6 col-12">
							<form method="POST" action="{{ route('wallet.create.deposit') }}">
								@csrf

								@foreach($currency_types as $index => $currency_type)

								@if($index==0)



								<div class="field">
									<label>Coin</label>

									<ul class="btc">
										@foreach($currency_type->currency as $cIndex=> $currency)

										



										<li data-value="{{$currency->id}}" class="{{$cIndex==0?'init':''}}">

											@if($currency->hasMedia('icon'))
    
                                      

											<img src="{{asset($currency->firstMedia('icon')->getUrl())}}" alt=""/> 

											@endif

											{{__($currency->short_name)}} <span>{{__($currency->name)}}</span></li>

									<!-- 	<li data-value="value 1"><img src="{{asset('front/img/bitcoin.png')}}" alt=""/> BTC <span>Bitcoin</span></li>
										<li data-value="value 2"><img src="{{asset('front/img/icon-5.png')}}" alt=""/> ETH <span>Ethereum</span></li>
										<li data-value="value 3"><img src="{{asset('front/img/icon-6.png')}}" alt=""/> BNB <span>BNB</span></li> -->

										@endforeach
									</ul>
									<input type="hidden" name="currency_id" id="coin_id" value="1"/>

									<span class="total">Total balance: <b>0.00000000 BTC</b></span>
								</div>

								@endif

								@endforeach
								<div class="field qq">
									<!-- <label>Quantity</label> -->
									<div class="form-group">
                                        <label for="quantity">{{__('Quantity')}}</label>
                                        <input type="text" name="quantity" class="form-control @error('quantity') is-invalid @enderror"   required="" id="quantity" aria-describedby="emailHelp" autocomplete="e-m-a-i-l" autofocus="">
                                    </div>
                                     @error('quantity')
                                <p class="invalid-value" role="alert">
                                    <strong>{{ $message }}</strong>
                                </p>
                                @enderror
								</div>
								<div class="field">
									<div class="input-group">
										<div class="custom-file">
											<input type="file" class="custom-file-input" id="inputGroupFile01">
											<label class="custom-file-label" for="inputGroupFile01">Upload</label>
										</div>
									</div>
								</div>
								<div class="field">
									<button type="submit">Request</button>
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
							<div class="white-box">
								<ul class="nav nav-tabs" id="myTab" role="tablist">
									<li class="nav-item">
										<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">BTC</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">BEP2</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">BEP20 (BSC)</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="contact-tab" data-toggle="tab" href="#erc" role="tab" aria-controls="erc" aria-selected="false">ERC20</a>
									</li>
									<li class="nav-item">
										<a class="nav-link" id="contact-tab" data-toggle="tab" href="#btc" role="tab" aria-controls="btc" aria-selected="false">BTC(SegWit)</a>
									</li>
								</ul>
								<div class="col-lg-12 xs-flush heading-p text-center col-sm-12 col-12">
									<p>Network Name: Bitcoin(BTC)&nbsp;&nbsp;Average arrival time: 1 minutes  </p>
								</div>
								<div class="tab-content" id="myTabContent">
									<div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
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
														<img class="small_mobiledd" src="img/icon-14.png" alt=""/>
													</div>
												</div>
											</div>	
										</div>
										<div class="col-12 btc-c">
											<div class="row">
												<div class="col-lg-9 col-sm-8 col-8">
													<h5>Send only BTC to this deposit address.</h5>
													<p>Sending coin or token other than BTC to this address may
													result in the loss of your deposit.</p>
												</div>
												<div class="col-lg-3 text-center col-sm-4 col-4">
													<img class="small_mobile" src="img/icon-15.png" alt=""/>
												</div>
											</div>
										</div>	
									</div>
									<div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
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
														<img src="img/icon-14.png" alt=""/>
													</div>
												</div>
											</div>	
										</div>
										<div class="col-12 btc-c">
											<div class="row">
												<div class="col-lg-9 col-sm-8 col-8">
													<h5>Send only BTC to this deposit address.</h5>
													<p>Sending coin or token other than BTC to this address may
													result in the loss of your deposit.</p>
												</div>
												<div class="col-lg-3 text-center col-sm-4 col-4">
													<img src="img/icon-15.png" alt=""/>
												</div>
											</div>
										</div>	
									</div>
									<div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">...</div>
									<div class="tab-pane fade" id="erc" role="tabpanel" aria-labelledby="contact-tab">...</div>
									<div class="tab-pane fade" id="btc" role="tabpanel" aria-labelledby="contact-tab">...</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

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
<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body text-center">
				<img src="img/icon-16.png" alt=""/>
				<h6>You have successfully completed the request</h6>
				<h4>Please wait until your assets<br>
				gets allocated</h4>
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

    $('#coin_id').val(coin_id);
});
</script>
@endsection    