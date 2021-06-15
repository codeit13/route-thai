@extends('layouts.front')
@section('title')
Route: P2P Trading Platform - sell crypto
@endsection
@section('header-bar')
<div class="progress-section visible-xs">
	<h2><img src="{{ asset('front/img/check.png') }}" alt=""/> Order Completed </h2>
</div>
@include('front.sell.sub_header')
@endsection
@section('content')
<section id="main-heading" class="panding-payment hidden-xs">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-xs-12 text-left">
				<h1><img src="{{ asset('front/img/check.png') }}" alt=""/> Order Completed</h1>
			</div>
		</div>
	</div>
</section>
<section id="payment-mode">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-xs-12">
				<h4>Successfully Sold <span class="red-c">{{ $transcation->quantity }} {{ $transcation->currency->short_name }}</span> <a class="visible-xs" href="#" data-toggle="modal" data-target="#exampleModal2"><img src="{{ asset('front/img/icon-26.png') }}" alt=""></a></h4>
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
								<h5>{{ $transcation->created_at }}</h5>
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
								<p class="yellow-bg">ATTEBTION! Successfully transferred your 1BTC to the buyer's wallet</p>
							</div>
						</div>
						<div class="row seller-payment">
							<div class="col-lg-12 col-sm-12 col-12">
								<div class="row">
									<div class="col-lg-12 MethodPayment col-sm-12 col-12">
										<h6>Seller’s payment method <i class="fa fa-angle-down" aria-hidden="true"></i></h6>
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
				<div class="col-lg-12 flush experience  space-xs col-sm-12 col-12">
					<div class="col-lg-12 text-center col-sm-12 col-12">
						<p>How was your trading experience?</p>
					</div>
					<div class="row">
						<div class="col-lg-6 xs-center col-sm-6  col-6">	<a href="#" class="btn-success cancel"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Positive</a>
						</div>
						<div class="col-lg-6 xs-center col-sm-6  col-6">	<a href="#" class="btn-success cancel"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Negative</a>
						</div>
					</div>
				</div>
			</div>
			@include('front.sell.chat')
		</div>
	</div>
</section>
@include('front.sell.tips')
@stop
@section('page_scripts')
	<script type="text/javascript">
	    var message_url = '{{ route('message.index') }}';
	    var message_save_url = '{{ route('message.store') }}';
	    var token = "{{ csrf_token() }}";
	</script>
	<script type="text/javascript" src="{{asset('front/js/chat.js')}}"></script>
	<script>
		$(".MethodPayment").click(function(){
			$("#PaymentImps").toggle();
			$(".intro").toggle();
			$(".MethodPayment h6").toggleClass('intro-new');
		});
	</script>
@stop