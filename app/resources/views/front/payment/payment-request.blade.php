	@extends('layouts.front')
@section('title')
    Route: P2P Trading Platform
@endsection
@section('header-bar')
<div class="progress-section visible-xs">
				<label><span class="one">Pending Payment</span>
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
						<h1>Pending Payment</h1>
					</div>
				</div>
			</div>
		</section>
		<section id="payment-mode">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-sm-12 col-xs-12">
						<h4>Payment to be made <span>00:00:31</span> <a class="visible-xs" href="#"  data-toggle="modal" data-target="#exampleModal2"><img src="{{asset('front/img/icon-26.png')}}" alt=""/></a></h4>
					</div>
				</div>
			</div>
		</section>
		<section id="content" class="banktransfer padning-payment">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 xs-flush col-sm-6 col-xs-12">
						<div class="card padding-0">
							<div class="created-time">
								<div class="row">
									<div class="col-lg-6 text-left col-sm-6 col-6">
										<h6>Created time</h6>
										<h5>2021-03-29 11:56:29</h5>
									</div>
									<div class="col-lg-6 text-left  col-sm-6 col-6">
										<h6>Order number</h6>
										<h5>20209736948558385152</h5>
									</div>
								</div>
							</div>
							<div class="used-box">
								<div class="row mini_hr">
									<div class="col-lg-4 col-sm-4 col-12">
										<div class="row">
											<div class="col-lg-12 col-sm-12 col-6">
												<div id="Price">	<span>Amount</span>
												</div>
											</div>
											<div class="col-lg-12 xs-right col-sm-12 col-6">
												<div id="ID5268172_USD__10_s">	<span>$ 250.00</span>
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
												<div id="ID5522365196_BTC">	<span style="font-weight:normal;">1 USD</span>
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
												<div id="ID5522365196_BTC">	<span style="font-weight:normal;">250 USDT</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 col-sm-12 col-12">
										<p class="yellow-bg">The following is the sellers' payment info. Please make sure the money is transferred from an account you own, matching your verified name. Money will NOT be transferred automatically by the platform.</p>
									</div>
								</div>
								<div class="row seller-payment">
									<div class="col-lg-6 col-sm-6 col-12">
										<div class="row">
											<div class="col-lg-12 col-sm-12 col-7">
												<h6 style="cursor:pointer;" data-toggle="modal" data-target="#exampleModal3">Seller’s payment method</h6>
											</div>
											<div class="col-lg-12 text-left xs-right col-sm-12 col-5">
												<a href="#">
													<img src="{{asset('front/img/icon-25.png')}}" alt="" />
												</a>
												<a href="#">
													<img src="{{asset('front/img/icon-24.png')}}" alt="" />
												</a>
												<a href="#">
													<img src="{{asset('front/img/icon-23.png')}}" alt="" />
												</a>
											</div>
										</div>
									</div>
									<div class="col-lg-6 col-sm-6 col-12">
										<div class="row">
											<div class="col-lg-12 col-sm-12 col-6">
												<h6>Email or Username</h6>
											</div>
											<div class="col-lg-12 top-xs text-left col-sm-12 col-6">	<a href="mailto:admin@gmail.com">admin@gmail.com</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 flush space-xs col-sm-12 col-12">
							<p class="untext">Please confirm that you have successfully transferred the money to the seller through the following payment method.</p>
						</div>
						<div class="col-lg-12 flush  space-xs col-sm-12 col-12">
							<div class="row">
								<div class="col-lg-9 col-sm-9 col-8">	<a href="#" class="btn-success">Transferred, Next</a>
								</div>
								<div class="col-lg-3 col-sm-3 col-4">	<a href="#" class="btn-success cancel">Cancel</a>
								</div>
							</div>
							<div class="row">
								<div class="col-lg-12 hidden-xs col-sm-12 col-12">
									<p class="untext-2">Please make a payment within 15:00 mins, otherwise, the order will be cancelled.</p>
								</div>
							</div>
						</div>
					</div>
					<div class="col-lg-6 hidden-xs visible-sm col-sm-6 col-12">
						<div class="card chat  p-payment">
							<div class="chat_box">
								<h2 class="head_box bit"><img src="{{asset('front/img/bitcoin.png')}}" alt=""/> ⚡ OrianyellaB ⚡</h2>
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
														<img src="{{asset('front/img/paperclip.png')}}">
													</a>
												</div>
												<div class="col-lg-10 flush col-sm-7 col-8">
													<input type="text" name="" placeholder="Enter your message here">
												</div>
												<div class="col-lg-1 col-sm-3 col-2 xs-center xs-flush">
													<div class="send_box">
														<button>
															<img src="{{asset('front/img/icon-green.png')}}">
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
				<div class="row hidden-xs">
					<div class="col unknow">
						<h2>Tips</h2>
						<p><span class="sst">1. </span>Please do not include any information about BTC, ETH, USDT, BNB and other digital asset names in the transfer notes to prevent payment from being intercepted or bank funds being frozen.</p>
						<p><span class="sst">2. </span>Your payment will go directly to the seller's account. The digital assets sold by the seller during the transaction will be handled by the platform.</p>
						<p><span class="sst">3. </span>Please complete the payment within the specified time, and be sure to click “Transferred, Next”. After the seller confirms the payment, the system will transfer the digital assets to your account.</p>
						<p><span class="sst">4. </span>If the buyer cancels orders 3 times a day, he/she will no longer be able to to trade for the rest of the day.</p>
						<p><span class="sst">5. </span>After 5 pm on weekdays or during non-working days, please limit each transaction within 50,000 CNY, otherwise it will be delayed.</p>
					</div>
				</div>
			</div>
		</section>

		<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="col-lg-12 col-sm-12 text-center col-12">
							<h3>Select Payment Method</h3>
						</div>
						<div class="row">
							<div class="col-lg-4 border-right-one col-sm-4 col-12">
								<h4 class="xs-left text-center"><img src="{{asset('front/img/icon-24.png')}}"><br>IMPS</h4>
								<div class="row">
									<div class="col-lg-12 xs-left text-center col-sm-12 col-6">
										<label class="gray-c">Full Name</label>
									</div>
									<div class="col-lg-12 xs-left text-center col-sm-12 col-6">
										<label>Shavez Mirza</label>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 xs-left text-center col-sm-12 col-6">
										<label class="gray-c">Bank Account Number</label>
									</div>
									<div class="col-lg-12 xs-left text-center col-sm-12 col-6">
										<label>5027101002482</label>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 xs-left text-center col-sm-12 col-6">
										<label class="gray-c">IFSC CODE</label>
									</div>
									<div class="col-lg-12 xs-left text-center col-sm-12 col-6">
										<label>CNRB0005027</label>
									</div>
								</div>
							</div>
							<div class="col-lg-4 border-right-one col-sm-4 col-12">
								<h4 class="xs-left text-center"><img src="{{asset('front/img/icon-25.png')}}"><br>Bank Transfer (India)</h4>
								<div class="row">
									<div class="col-lg-12 xs-left text-center col-sm-12 col-6">
										<label class="gray-c">Full Name</label>
									</div>
									<div class="col-lg-12 xs-left text-center col-sm-12 col-6">
										<label>Shavez Mirza</label>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 xs-left text-center col-sm-12 col-6">
										<label class="gray-c">Bank Account Number</label>
									</div>
									<div class="col-lg-12 xs-left text-center col-sm-12 col-6">
										<label>5027101002482</label>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 xs-left text-center col-sm-12 col-6">
										<label class="gray-c">IFSC CODE</label>
									</div>
									<div class="col-lg-12 xs-left text-center col-sm-12 col-6">
										<label>CNRB0005027</label>
									</div>
								</div>
							</div>
							<div class="col-lg-4  col-sm-4 col-12">
								<h4 class="xs-left text-center"><img src="{{asset('front/img/icon-23.png')}}"><br>UPI</h4>
								<div class="row">
									<div class="col-lg-12 xs-left text-center col-sm-12 col-6">
										<label class="gray-c">Full Name</label>
									</div>
									<div class="col-lg-12 xs-left text-center col-sm-12 col-6">
										<label>Shavez Mirza</label>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 xs-left text-center col-sm-12 col-6">
										<label class="gray-c">UPI ID</label>
									</div>
									<div class="col-lg-12 xs-left text-center col-sm-12 col-6">
										<label>9027022303@paytm</label>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-8 offset-lg-2 top-space col-sm-8 offset-sm-2 col-12">
							<div class="row">
								<div class="col-lg-9 col-sm-9 col-8">	<a href="#" class="btn-success">Transferred, Next</a>
								</div>
								<div class="col-lg-3 col-sm-3 col-4">	<a href="#" class="btn-success cancel">Cancel</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		@endsection
		@section('page_scripts')
		<script type="text/javascript" src="{{asset('front/js/app.js')}}"></script>
<script type="text/javascript">

		const opts = {
				DOMselector: '#app',
				sliders: [
					{
						radius: 40,
						min: 0,
						max: 200,
						step: 10,
						initialValue: 0,
						color: '#00c98e',
						displayName: 'Value 3'
					}
				]
			};
			
			// instantiate the slider
			const slider = new Slider(opts);
			slider.draw();

			
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