@extends('layouts.front')
@section('title')
Route: P2P Trading Platform
@endsection
@section('header-bar')
<div class="progress-section visible-xs">
    <label>
        <span class="one">Pending Payment</span>
        <div id="app"></div>
    </label>
</div>
@include('front.sell.sub_header_buy')
@endsection
@section('content')
<section id="main-heading" class="panding-payment hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-left">
                <h1>{{__('Pending Payment')}}</h1>
            </div>
        </div>
    </div>
</section>
<section id="payment-mode">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12">
                <h4>Payment to be made <span id="timer">00:00:31</span> <a class="visible-xs" href="#"  data-toggle="modal" data-target="#exampleModal2"><img src="{{asset('front/img/icon-26.png')}}" alt=""/></a></h4>
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
                                        <div id="ID5522365196_BTC">	<span style="font-weight:normal;">{{$transaction->quantity}}</span>
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
                                        <div id="ID5522365196_BTC">	<span style="font-weight:normal;">{{$transaction->trans_amount}} &nbsp;{{$transaction->fiat_currency->short_name??''}}</span>
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
                                    <div class="col-lg-12 col-sm-12 col-7 MethodPayment">
                                        <h6>Seller???s payment method <i class="fa fa-angle-down" aria-hidden="true"></i></h6>
                                    </div>
                                    <div class="col-lg-12 text-left xs-right col-sm-12 col-5 intro">
                                        @foreach($transaction->user->user_payment_method as $payment_method)
                                            @if($payment_method->payment_methods->hasMedia('icon'))
                                            <a href="#">
                                            <img src="{{$payment_method->payment_methods->getMedia('icon')->first()->getUrl()}}" alt="{{__($payment_method->payment_methods->name)}}"/>
                                            </a> 
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6 col-12">
                                <div class="row">
                                    <div class="col-lg-12 col-sm-12 col-6">
                                        <h6>{{__('Email or Username')}}</h6>
                                    </div>
                                    <div class="col-lg-12 top-xs text-left col-sm-12 col-6">	<a href="mailto:{{$transaction->user->email}}">{{$transaction->user->email}}</a>
                                    </div>
                                </div>
                            </div>
                            <div id="PaymentImps">
                                @foreach($transaction->user->user_payment_method as $single_user_payment_method)
                                    <div class="payment-line  @if($transaction->user->user_payment_method->last()) b-last-none @endif">
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
                <div class="col-lg-12 flush space-xs col-sm-12 col-12">
                    <p class="untext">Please confirm that you have successfully transferred the money to the seller through the following payment method.</p>
                </div>
                <div class="col-lg-12 flush  space-xs col-sm-12 col-12">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12">	<a href="{{route('payment.order.release',$transaction->trans_id)}}" class="btn-success">{{__('Transferred, Next')}}</a>
                        </div>
                        {{-- <div class="col-lg-3 col-sm-3 col-4">	<a href="{{route('payment.order.cancel',['transaction'=>$transaction->trans_id])}}" class="btn-success cancel">Cancel</a>
                        </div> --}}
                    </div>
                    <div class="row">
                        <div class="col-lg-12 hidden-xs col-sm-12 col-12">
                            <p class="untext-2">Please make a payment within {{$transaction->timer}}:00 mins, otherwise, the order will be cancelled.</p>
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
<div class="modal fade" id="exampleModal3" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-lg-12 col-sm-12 text-center col-12">
                    <h3>{{__('Select Payment Method')}}</h3>
                </div>
                <div class="row">
                    @foreach($transaction->user->user_payment_method as $payment_method)
                    <div class="col-lg-4 border-right-one col-sm-4 col-12">
                        <h4 class="xs-left text-center">
                            @if($payment_method->payment_methods->hasMedia('icon'))
                            <img src="{{$payment_method->payment_methods->firstMedia('icon')->getUrl()}}" alt="{{__($payment_method->payment_methods->name??'')}}"/>
                            @endif
                            <br>{{__($payment_method->payment_methods->name??"")}}
                        </h4>
                        <div class="row">
                            <div class="col-lg-12 xs-left text-center col-sm-12 col-6">
                                <label class="gray-c">{{__('Full Name')}}</label>
                            </div>
                            <div class="col-lg-12 xs-left text-center col-sm-12 col-6">
                                <label>{{__($payment_method->full_name??$payment_method->user->name??"")}}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 xs-left text-center col-sm-12 col-6">
                                <label class="gray-c">{{__($payment_method->account_label)}}</label>
                            </div>
                            <div class="col-lg-12 xs-left text-center col-sm-12 col-6">
                                <label>{{$payment_method->account_number}}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 xs-left text-center col-sm-12 col-6">
                                <label class="gray-c">{{__($payment_method->code_label)}}</label>
                            </div>
                            <div class="col-lg-12 xs-left text-center col-sm-12 col-6">
                                <label>{{$payment_method->code}}</label>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="col-lg-8 offset-lg-2 top-space col-sm-8 offset-sm-2 col-12">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-12">	<a href="{{route('payment.order.release',$transaction->trans_id)}}" class="btn-success">{{__('Transferred, Next')}}</a>
                        </div>
                        {{-- <div class="col-lg-3 col-sm-3 col-4">	<a href="{{route('payment.order.cancel',$transaction->trans_id)}}" class="btn-success cancel">{{__('Cancel')}}</a>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('page_scripts')
<script type="text/javascript" src="{{asset('front/js/time_slider.js')}}"></script>
<script type="text/javascript">
    var message_url = '{{ route('message.index') }}';
    var message_save_url = '{{ route('message.store') }}';
    var token = "{{ csrf_token() }}";
</script>
<script>
    $(".MethodPayment").click(function(){
        $("#PaymentImps").toggle();
        $(".intro").toggle();
        $(".MethodPayment h6").toggleClass('intro-new');
    });
</script>
<script type="text/javascript" src="{{asset('front/js/chat.js')}}"></script>
<script type = "text/javascript" >
    var minutes = '00';
	var hours = '00';
	var seconds = '00';

	@if(isset($buyer_request->expiry_time))
		hours = '{{$buyer_request->expiry_time->hours}}';
		minutes = '{{$buyer_request->expiry_time->minutes}}';
		seconds = '{{$buyer_request->expiry_time->seconds}}';
	@endif

	const opts = {
	    DOMselector: '#app',
	    sliders: [{
	        radius: 40,
	        min: 0,
	        max: {{$transaction->timer * 60}},
	        step: 10,
	        initialValue: {{($transaction->getTime() * 60 > 0) ? $transaction->getTime() * 60: 0}},
	        timer: (minutes < 10 ? "0" + minutes : minutes) + ':' + (seconds < 10 ? "0" + seconds : seconds),
	        color: '#00c98e',
	        displayName: 'Value 3'
	    }]
	};
	// instantiate the slider
	const slider = new Slider(opts);
	slider.draw();

	function updateSliderRange(m, s) {
	    if (opts.sliders[0].initialValue > 0) {
	        $('#app').html('');
	        opts.sliders[0].timer = m + ':' + s;
	        var rr = new Slider(opts);
	        rr.draw();
	    }
	}

	$(document).ready(function() {
	    $('.bxslider').bxSlider({
	        auto: false,
	        controls: true,
	        pager: false,
	        slideWidth: 280,
	        minSlides: 1,
	        maxSlides: 4,
	        moveSlides: 1,
	        slideMargin: 0,
	        speed: 300,
	        touchEnabled: true
	    });
	    $("#footer ul li.Company:first-child").click(function() {
	        $("ul.Company-main li").toggle();
	    });
	    $("#footer ul li.Individuals:first-child").click(function() {
	        $("ul.Individuals-main li").toggle();
	    });
	    $("#footer ul li.Learn:first-child").click(function() {
	        $("ul.Learn-main li").toggle();
	    });
	    $("#footer ul li.Support:first-child").click(function() {
	        $("ul.Support-main li").toggle();
	    });
	});

	document.getElementById('timer').innerHTML = hours + ":" + minutes + ":" + seconds;
	startTimer();

	function startTimer() {
	    var presentTime = document.getElementById('timer').innerHTML;
	    var timeArray = presentTime.split(/[:]+/);
	    var h = timeArray[0];
	    var m = timeArray[1];
	    var s = checkSecond((timeArray[2] - 1));
	    var regex = /\d/;

	    if (s == 59) {
	        if (m == 0 && h > 0) {
	            m = 59;
	        } else {
	            m = m - 1;
	        }
	    }

	    if (m < 10 && m != 0) {
	        m = m.toString().replace("0", '');
	        m = "0" + m;
	    }

	    if (m == 0) {
	        m = "00";
	    }
	    if (m == 59 && s == 59 && h >= 1) {
	        h = h - 1;
	    }

	    if (h < 10 && h != 0) {
	        h = h.toString().replace("0", '');
	        h = "0" + h;
	    }

	    if (h == 0) {
	        h = "00";
	    }
	    updateSliderRange(m, s);
	    document.getElementById('timer').innerHTML = h + ":" + m + ":" + s;

	    if (s == 0 && h == 0 && m == 0) {
	        setTimeout(function() {
	            window.location.reload();
	        }, 1000);
	        return false;
	    }
	    setTimeout(startTimer, 1000);
	}

	function checkSecond(sec) {
    	if (sec < 10 && sec >= 0) {
        	sec = "0" + sec
    	}; // add zero in front of numbers < 10
    	if (sec < 0) {
        	sec = "59"
    	};
    	return sec;
	} 
</script>
@endsection