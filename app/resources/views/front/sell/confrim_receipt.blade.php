@extends('layouts.front')
@section('title')
Route: P2P Trading Platform - sell crypto
@endsection
@section('header-bar')
<div class="progress-section visible-xs">
    <label>
        <span class="one">Pending Payment</span>
        <div id="app"></div>
    </label>
</div>
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-sm-12 col-xs-12 flush">
			<ul class="mini_links">
				<li class="active"><a href="#">P2P</a>
				</li>
				<li><a href="#">Express</a>
				</li>
			</ul>
		</div>
	</div>
</div>
@endsection
@section('content')
<section id="main-heading" class="panding-payment hidden-xs">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-xs-12 text-left">
				<h1>Confirm receipt</h1>
			</div>
		</div>
	</div>
</section>
<section id="payment-mode">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 hidden-xs col-sm-12 col-xs-12">
				<h4>Please confirm you have receive the payment in <span id="timer">00:00:31</span> <a class="visible-xs" href="#"  data-toggle="modal" data-target="#exampleModal2"><img src="{{ asset('front/img/icon-26.png') }}" alt=""/></a></h4>
			</div>
			<div class="col-lg-12 visible-xs col-sm-12 col-xs-12">
				<h4 class="i-weil-sell">I will sell  <span class="red-c">{{ $transcation->quantity }} {{ $transcation->currency->short_name }}</span> <a  href="#" data-toggle="modal" data-target="#exampleModal2"><img src="{{ asset('front/img/icon-26.png') }}" alt=""></a></h4>
			</div>
		</div>
	</div>
</section>
<section id="content" class="banktransfer padning-payment confirm-receipt">
	<div class="container">
		<div class="row">
			<div class="col-lg-6 xs-flush col-sm-6 col-xs-12">
				<div class="card padding-0">
					<div class="created-time">
						<div class="row">
							<div class="col-lg-6 text-left col-sm-6 col-6">
								<h6>Created time</h6>
								<h5>{{ $transcation->buyer_requests->first()->created_at }}</h5>
							</div>
							<div class="col-lg-6 text-left  col-sm-6 col-6">
								<h6>Order number</h6>
								<h5>{{ $transcation->trans_id }}</h5>
							</div>
						</div>
					</div>
					<div class="used-box">
						<div class="row mini_hr">
							<div class="col-lg-4 col-sm-4 col-12">
								<div class="row">
									<div class="col-lg-12 col-sm-12 col-6">
										<div id="Price"><span>Types of Currency</span>
										</div>
									</div>
									<div class="col-lg-12 xs-right col-sm-12 col-6">
										<div id="ID5268172_USD__10_s"><img src="{{ $transcation->currency->getMedia('icon')->first()->getUrl() }}" alt=""/><span class="hidden-xs">{{ $transcation->currency->name }}</span><span class="visible-xs red-c">{{ $transcation->currency->short_name }}</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-4 col-12">
								<div class="row">
									<div class="col-lg-12 col-sm-12 col-6">
										<div id="Available">	<span>Quantity</span>
										</div>
									</div>
									<div class="col-lg-12 xs-right col-sm-12 col-6">
										<div id="ID5522365196_BTC">	<span style="font-weight:normal;">{{ $transcation->quantity }}</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-lg-4 col-sm-4 col-12">
								<div class="row">
									<div class="col-lg-12 col-sm-12 col-6">
										<div id="Available">	<span>Price</span>
										</div>
									</div>
									<div class="col-lg-12 xs-right col-sm-12 col-6">
										<div id="ID5522365196_BTC">	<span style="font-weight:normal;">{{ $transcation->trans_amount }} {{ $transcation->fiat_currency->short_name }}</span>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-12">
								<p class="black-c">Please check the following account and confirm the receipt of payment
								from ( {{ $transcation->buyer_trans->user->name }} )</p>
							</div>
						</div>
						<div class="row seller-payment">
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="row">
									<div class="col-lg-12 MethodPayment col-sm-12 col-12">
										<h6>My payment method <i class="fa fa-angle-down" aria-hidden="true"></i></h6>
									</div>
									<div class="col-lg-12 text-left intro  col-sm-12 col-12">
										@foreach($user_payment_methods as $single_user_payment_method)
											<a href="javascript:void()">
												<img src="{{ $single_user_payment_method->payment_methods->getMedia('icon')->first()->getUrl() }}" alt="" />
											</a>
										@endforeach
									</div>
								</div>
							</div>
							<div id="PaymentImps">
								@foreach($user_payment_methods as $single_user_payment_method)
									<div class="payment-line  @if($user_payment_methods->last()) b-last-none @endif">
										<div class="col-lg-12 flush col-sm-12 col-12">
											<h3> <a href="javascript:void(0)"><img src="{{ $single_user_payment_method->payment_methods->getMedia('icon')->first()->getUrl() }}" alt=""/></a>{{ $single_user_payment_method->payment_methods->name }}</h3>
										</div>
										<div class="field">
											<div class="row">
												<div class="col-lg-6 col-sm-6 col-6">
													<label class="gray-c">Full Name</label>
												</div>
												<div class="col-lg-6 b-c text-right col-sm-6 col-6">
													<label>{{ $single_user_payment_method->user->name }}</label>
												</div>
											</div>
											@if($single_user_payment_method->account_label != '')
												<div class="row">
													<div class="col-lg-6 col-sm-6 col-6">
														<label class="gray-c">{{ $single_user_payment_method->account_label }}</label>
													</div>
													<div class="col-lg-6 b-c text-right col-sm-6 col-6">
														<label>{{ $single_user_payment_method->account_number }}</label>
													</div>
												</div>
											@endif
											@if($single_user_payment_method->code_label != '')
												<div class="row">
													<div class="col-lg-6 col-sm-6 col-6">
														<label class="gray-c">{{ $single_user_payment_method->code_label }}</label>
													</div>
													<div class="col-lg-6 b-c text-right col-sm-6 col-6">
														<label>{{ $single_user_payment_method->code }}</label>
													</div>
												</div>
											@endif
										</div>
									</div>
								@endforeach
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-12 flush  space-xs col-sm-12 col-12">
					<div class="row">
						<div class="col-lg-9 col-sm-9 col-8"><a href="{{ route('sell.order_success',['trans_id'=>$transcation->trans_id]) }}" class="btn-success">Confirm receipt</a>
						</div>
						<div class="col-lg-3 col-sm-3 col-4"><a href="#" class="btn-success cancel">Appeal</a>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-6 hidden-xs visible-sm col-sm-6 col-12">
				<div class="card chat  p-payment">
					<div class="chat_box">
						<h2 class="head_box bit"><img src="{{ asset('front/img/bitcoin.png') }}" alt=""/> ⚡ OrianyellaB ⚡</h2>
						<div class="chat_body">
							<div class="alert">ATTEBTION! DO NOT - release crypto before confirming the money (availble balance) has arrived in your payment account. DO NOT trust anyone claims to be customer support in this chat	<a href="#">Less</a>
							</div>
						</div>
						<div class="chat_footer">
							<form>
								<div class="form-group">
									<div class="row">
										<div class="col-lg-1 flush text-center col-sm-2 col-2">
											<a href="#">
												<img src="{{ asset('front/img/paperclip.png') }}">
											</a>
										</div>
										<div class="col-lg-10 flush col-sm-7 col-8">
											<input type="text" name="" placeholder="Enter your message here">
										</div>
										<div class="col-lg-1 col-sm-3 col-2 xs-center xs-flush">
											<div class="send_box">
												<button>
													<img src="{{ asset('front/img/icon-green.png') }}">
												</button>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
@include('front.sell.tips')
@stop
@section('page_scripts')
	<script>
		$(".MethodPayment").click(function(){
			$("#PaymentImps").toggle();
			$(".intro").toggle();
			$(".MethodPayment h6").toggleClass('intro-new');
		});
	</script>
	<script type="text/javascript" src="{{asset('front/js/time_slider.js')}}"></script>	
	@include('front.sell.timer',['buyer_request'=>$transcation->buyer_requests->first(),'transcation'=>$transcation])
@stop