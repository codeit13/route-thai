@extends('layouts.front')
@section('title')
    Route: P2P Trading Platform
@endsection
@section('header-bar')
<div class="progress-section visible-xs">
				<label><span class="one">{{__("Releasing")}}&nbsp;{{$transaction->currency->short_name}}</span>
					<div id="app"></div>
				</label>
			</div>
			@include('front.sell.sub_header')
@endsection
@section('content')
	<section id="main-heading" class="panding-payment hidden-xs">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-sm-12 col-xs-12 text-left">
						<h1>{{__("Releasing")}}&nbsp;{{$transaction->currency->short_name}}</h1>
					</div>
				</div>
			</div>
		</section>
		<section id="payment-mode">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 hidden-xs col-sm-12 col-xs-12">
						<h4>{{__("Expect to receive payment in")}} <span id="timer">00:00:31</span> <a class="visible-xs" href="#"  data-toggle="modal" data-target="#exampleModal2"><img src="{{asset('front/img/icon-26.png')}}" alt=""/></a></h4>
					</div>
					<div class="col-lg-12 visible-xs col-sm-12 col-xs-12">
						{{--<h4 class="i-weil-sell">{{__("I will sell  ")}}<span class="red-c">{{$transaction->trans_amount}} {{$transaction->currency->short_name}}</span> <a  href="#" data-toggle="modal" data-target="#exampleModal2"><img src="{{asset('front/img/icon-26.png')}}" alt=""></a></h4> --}}
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
												<div id="ID5522365196_BTC">	<span style="font-weight:normal;">{{$transaction->trans_amount}}&nbsp; {{$transaction->currency->short_name}}</span>
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
												<div id="ID5522365196_BTC">	<span style="font-weight:normal;">{{number_format($transaction->quantity,2)}} &nbsp;{{$transaction->fiat_currency->short_name}}</span>
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-lg-12 col-sm-12 col-12">
										<p class="yellow-bg">ATTEBTION! Do not release crypto before confirming the money (availble balance) has arrived in your payment account. DO NOT trust anyone claims to be customer support in this chat</p>
									</div>
								</div>
								<div class="row seller-payment">
									<div class="col-lg-12 col-sm-12 col-12">
										<div class="row">
											<div class="col-lg-12 MethodPayment col-sm-12 col-12">
												<h6>Seller’s payment method <i class="fa fa-angle-down" aria-hidden="true"></i></h6>
											</div>
											<div class="col-lg-12 text-left intro  col-sm-12 col-12">
												@foreach($transaction->user->user_payment_method as $payment_method)


													@if($payment_method->hasMedia('icon'))
    
                                           <a href="#">

											<img src="{{$payment_method->firstMedia('icon')->getUrl()}}" alt="{{__($payment_method->payment_method->name)}}"/>

											</a> 

											@endif

												
												


												@endforeach
											
											</div>
										</div>
									</div>
									<div id="PaymentImps">

										@foreach($transaction->user->user_payment_method as $pindex => $payment_method)


										<div class="payment-line @if(count($transaction->user->user_payment_method)-1==$pindex) b-last-none @endif ">
											<div class="row">
												<div class="col-lg-12 col-sm-12 col-12">
													<h3> <a href="#">@if($payment_method->hasMedia('icon'))
    
                                          

											<img src="{{$payment_method->firstMedia('icon')->getUrl()}}" alt="{{__($payment_method->payment_method->name)}}"/>

									
											@endif</a>{{__($payment_method->payment_methods->name)}}</h3>
												</div>
												<div class="field">
													<div class="row">
														<div class="col-lg-6 col-sm-6 col-6">
															<label class="gray-c">{{__('Full Name')}}</label>
														</div>
														<div class="col-lg-6 text-right col-sm-6 col-6">
															<label>{{__($payment_method->full_name??$payment_method->user->name)}}</label>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-6 col-sm-6 col-6">
															<label class="gray-c">{{__($payment_method->account_label)}}</label>
														</div>
														<div class="col-lg-6 text-right col-sm-6 col-6">
															<label>{{$payment_method->account_number}}</label>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-6 col-sm-6 col-6">
															<label class="gray-c">{{__($payment_method->code_label)}}</label>
														</div>
														<div class="col-lg-6 text-right col-sm-6 col-6">
															<label>{{$payment_method->code}}</label>
														</div>
													</div>
												</div>
											</div>
										</div>
                              @endforeach


									
										<!--
										<div class="payment-line b-last-none">
											<div class="row">
												<div class="col-lg-12 col-sm-12 col-12">
													<h3> <a href="#"><img src="{{asset('front/img/icon-23.png')}}" alt=""/></a>UPI</h3>
												</div>
												<div class="field">
													<div class="row">
														<div class="col-lg-6 col-sm-6 col-6">
															<label class="gray-c">Full Name</label>
														</div>
														<div class="col-lg-6 text-right col-sm-6 col-6">
															<label>UPI ID</label>
														</div>
													</div>
													<div class="row">
														<div class="col-lg-6 col-sm-6 col-6">
															<label class="gray-c">Shavez Mirza</label>
														</div>
														<div class="col-lg-6 text-right col-sm-6 col-6">
															<label>9027022303@paytm</label>
														</div>
													</div>
												</div>
											</div>
										</div>
										-->
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 flush  space-xs col-sm-12 col-12">
							<div class="row">
								<div class="col-lg-9 col-sm-9 col-8">	<a href="#" class="btn-success Appeal">Appeal</a>
								</div>
								{{-- <div class="col-lg-3 col-sm-3 col-4">	<a href="{{route('payment.order.cancel',$transaction->trans_id)}}" class="btn-success cancel">Cancel</a>
								</div> --}}
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
						<p><span class="sst">3. </span>Please complete the payment within the specified time, and be sure to click “Transferred, Next”. After the seller confirms the payment, the system will transfer the digital assets to your account.</p>
						<p><span class="sst">4. </span>If the buyer cancels orders 3 times a day, he/she will no longer be able to to trade for the rest of the day.</p>
						<p><span class="sst">5. </span>After 5 pm on weekdays or during non-working days, please limit each transaction within 50,000 CNY, otherwise it will be delayed.</p>
					</div>
				</div>
			</div>
		</section>
		@endsection
		@section('page_scripts')
		<script type="text/javascript" src="{{asset('front/js/time_slider.js')}}"></script>
		<script type="text/javascript">
    var message_url = '{{ route('message.index') }}';
    var message_save_url = '{{ route('message.store') }}';
    var token = "{{ csrf_token() }}";
</script>
<script type="text/javascript" src="{{asset('front/js/chat.js')}}"></script>
<script type="text/javascript">

	        var minutes='00';
			var hours='00';
			var seconds='00';

			@if(isset($buyer_request->expiry_time))

			hours='{{$buyer_request->expiry_time->hours}}';
			minutes='{{$buyer_request->expiry_time->minutes}}';
			seconds='{{$buyer_request->expiry_time->seconds}}';




			@endif

		const opts = {
				DOMselector: '#app',
				sliders: [
					{
						radius: 40,
						min:0,
						max: {{$transaction->timer*60}},
						step: 10,
						initialValue:{{($buyer_request->expiry_in*60 >0)?$buyer_request->expiry_in*60:0}},

						timer:(minutes<10?"0"+minutes:minutes)+':'+(seconds<10?"0"+seconds:seconds),

						color: '#00c98e',
						displayName: 'Value 3'
					}
				]
			};


			
			// instantiate the slider
			const slider = new Slider(opts);
			slider.draw();

			function updateSliderRange(m,s)
			{


				if(opts.sliders[0].initialValue>0){
              $('#app').html('');

			opts.sliders[0].timer=m+':'+s;

			var rr=new Slider(opts);
			rr.draw();
		   }
		}
			


			
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

				$(".MethodPayment").click(function(){
					$("#PaymentImps").toggle();
					$(".intro").toggle();
					$(".MethodPayment h6").toggleClass('intro-new');
				});
			 });


		

			
			document.getElementById('timer').innerHTML =hours+":"+
  minutes + ":" + seconds;

startTimer();



function startTimer() {
  var presentTime = document.getElementById('timer').innerHTML;
  var timeArray = presentTime.split(/[:]+/);
  var h=timeArray[0];
  var m = timeArray[1];
  var s = checkSecond((timeArray[2] - 1));
  var regex = /\d/;



  
  if(s==59){
    

   

  	if(m==0 && h >0)
  	{
  		m=59;
  	}
  	else
  	{
  	m=m-1;


  	}




 //console.log(m);

  }


  	if(m<10 && m!=0)
  	{
  				
  		m=m.toString().replace("0",''); 
  		m="0"+m;
  		
  	}

  	if(m==0)
  	{
  		m="00";
  	}

  	

  	if(m==59 && s==59 && h>=1){

  		h=h-1;
  		//m=59;
  	}

  	if(h<10 && h!=0)
  	{
  				
  		h=h.toString().replace("0",''); 
  		h="0"+h;
  		
  	}

  	if(h==0)
  	{
  		h="00";
  	}
  //if(m<0){alert('timer completed')}

  updateSliderRange(m,s);
  
  document.getElementById('timer').innerHTML =h+ ":"+
    m + ":" + s;
  if(s==0 && h==0 && m==0)
{
	setTimeout(function()
	{
	window.location.reload();

},1000);

	return false;
}
  setTimeout(startTimer, 1000);
}

function checkSecond(sec) {
  if (sec < 10 && sec >= 0) {sec = "0" + sec}; // add zero in front of numbers < 10
  if (sec < 0) {sec = "59"};
  return sec;
}

check_payment_status()

function check_payment_status()
{
	$.get('{{route("payment.order.status",$transaction->trans_id)}}',function(response)
	{
		if(response.status)
		{
			if(response.action=='reload')
			{
				window.location.reload();
			}
			else if(response.action!='stay')
			{
				window.location.href=response.action;
			}
		}
	})
}
setInterval(check_payment_status,10000);
		</script>
@endsection    