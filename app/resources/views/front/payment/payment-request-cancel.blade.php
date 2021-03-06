@extends('layouts.front')
@section('title')
    Route: P2P Trading Platform
@endsection
@section('header-bar')
<div class="progress-section visible-xs">
				<h2>{{__('Order Cancel')}}</h2>
			</div>
			@include('front.sell.sub_header_buy')
@endsection
@section('content')
	<section id="main-heading" class="panding-payment hidden-xs csss">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-sm-12 col-xs-12 text-left">
						<h1>{{__('Order Cancelled')}}</h1>
					</div>
				</div>
			</div>
		</section>
		<section id="content" class="banktransfer padning-payment confirm-receipt">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 xs-flush col-sm-6 col-xs-12">
						<h2 class="suborder">{{__('Order cancelled')}}</h2>
						<h4 class="suborder">If you have any questions, please contact customer service.</h4>
						<div class="card padding-0">
							<div class="created-time">
								<div class="row">
									<div class="col-lg-6 text-left col-sm-6 col-6">
										<h6>{{__('Created time')}}</h6>
										<h5>{{$transaction->created_at}}</h5>
									</div>
									<div class="col-lg-6 text-left  col-sm-6 col-6">
										<h6>{{__('Order number')}}</h6>
										<h5>{{$transaction->trans_id}}</h5>
									</div>
								</div>
							</div>
							<div class="used-box">
								<div class="row mini_hr">
									<div class="col-lg-4 col-sm-4 col-12">
										<div class="row">
											<div class="col-lg-12 col-sm-12 col-6">
												<div id="Price"><span>{{__('Types of Currency')}}</span>
												</div>
											</div>
											<div class="col-lg-12 xs-right col-sm-12 col-6">
												<div id="ID5268172_USD__10_s">@if($transaction->currency->hasMedia('icon'))
    
                                      

											<img class="coin_image" src="{{$transaction->currency->firstMedia('icon')->getUrl()}}" alt="{{__($transaction->currency->name)}}"/> 

											@endif

													<span class="hidden-xs">{{__($transaction->currency->name)}}</span><span class="visible-xs red-c">{{__($transaction->currency->short_name)}}</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-sm-4 col-12">
										<div class="row">
											<div class="col-lg-12 col-sm-12 col-6">
												<div id="Available">	<span>{{__("Quantity")}}</span>
												</div>
											</div>
											<div class="col-lg-12 xs-right col-sm-12 col-6">
												<div id="ID5522365196_BTC">	<span style="font-weight:normal;">{{$transaction->quantity}}&nbsp; {{$transaction->currency->short_name}}</span>
												</div>
											</div>
										</div>
									</div>
									<div class="col-lg-4 col-sm-4 col-12">
										<div class="row">
											<div class="col-lg-12 col-sm-12 col-6">
												<div id="Available">	<span>{{__("Price")}}</span>
												</div>
											</div>
											<div class="col-lg-12 xs-right col-sm-12 col-6">
												<div id="ID5522365196_BTC">	<span style="font-weight:normal;">{{ $transaction->trans_amount }} &nbsp;{{$transaction->fiat_currency->short_name}}</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 col-sm-12 col-12">
										<p>Payment method can't be displayed for this order</p>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 flush  space-xs col-sm-12 col-12">
							<div class="row">
								<div class="col-lg-6 offset-lg-3 xs-center col-sm-6 offset-sm-3 col-12">	<a href="#" class="btn-success cancel Support">Support</a>
								</div>
							</div>
						</div>
					</div>
					@include('front.sell.chat')
				</div>
				<div class="row hidden-xs">
					<div class="col unknow">
						<h2>Tips</h2>
						<p><span class="sst">1. </span>Please do not include any information about BTC, ETH, USDT, BNB and other digital asset names in the transfer notes to prevent payment from being intercepted or bank funds being frozen.</p>
						<p><span class="sst">2. </span>Your payment will go directly to the seller's account. The digital assets sold by the seller during the transaction will be handled by the platform.</p>
						<p><span class="sst">3. </span>Please complete the payment within the specified time, and be sure to click ???Transferred, Next???. After the seller confirms the payment, the system will transfer the digital assets to your account.</p>
						<p><span class="sst">4. </span>If the buyer cancels orders 3 times a day, he/she will no longer be able to to trade for the rest of the day.</p>
						<p><span class="sst">5. </span>After 5 pm on weekdays or during non-working days, please limit each transaction within 50,000 CNY, otherwise it will be delayed.</p>
					</div>
				</div>
			</div>
		</section>
		@endsection
		@section('page_scripts')
		<script type="text/javascript">
		    var message_url = '{{ route('message.index') }}';
		    var message_save_url = '{{ route('message.store') }}';
		    var token = "{{ csrf_token() }}";
		</script>
		<script type="text/javascript" src="{{asset('front/js/chat.js')}}"></script>
		<script type="text/javascript">
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
				$("#footer ul li.Company:first-child").click(function(){
					$("ul.Company-main li").toggle();
				});
				$("#footer ul li.Individuals:first-child").click(function(){
					$("ul.Individuals-main li").toggle();
				});
				$("#footer ul li.Learn:first-child").click(function(){
					$("ul.Learn-main li").toggle();
				});
				$("#footer ul li.Support:first-child").click(function(){
					$("ul.Support-main li").toggle();
				});
			 });
		</script>
@endsection    