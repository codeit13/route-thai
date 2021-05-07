@extends('layouts.front')
@section('title')
    Route: P2P Trading Platform
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
                <h4>Please confirm you have receive the payment. <span class="red-c visible-xs">1.0000 BTC</span> <a class="visible-xs" href="#" data-toggle="modal" data-target="#exampleModal2"><img src="img/icon-26.png" alt=""></a></h4>
            </div>
            <div class="col-lg-12 visible-xs col-sm-12 col-xs-12">
                <h4 class="i-weil-sell">I will sell  <span class="red-c">1.0000 BTC</span> <a  href="#" data-toggle="modal" data-target="#exampleModal2"><img src="img/icon-26.png" alt=""></a></h4>
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
                                        <div id="Price"><span>Types of Currency</span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 xs-right col-sm-12 col-6">
                                        <div id="ID5268172_USD__10_s"><img src="img/bitcoin.png" alt=""/><span class="hidden-xs">Bitcoin</span><span class="visible-xs red-c">BTC</span>
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
                                        <div id="ID5522365196_BTC">	<span style="font-weight:normal;">1.0000</span>
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
                                        <div id="ID5522365196_BTC">	<span style="font-weight:normal;">400500 INR</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12 col-sm-12 col-12">
                                <p class="black-c">Please check the following account and confirm the receipt of payment
                                from ( RAKESH MEHRA )</p>
                            </div>
                        </div>
                        <div class="row seller-payment">
                            <div class="col-lg-12 col-sm-12 col-12">
                                <div class="row">
                                    <div class="col-lg-12 MethodPayment col-sm-12 col-12">
                                        <h6>Seller’s payment method <i class="fa fa-angle-down" aria-hidden="true"></i></h6>
                                    </div>
                                    <div class="col-lg-12 text-left intro  col-sm-12 col-12">
                                        <a href="#">
                                            <img src="img/icon-25.png" alt="" />
                                        </a>
                                        <a href="#">
                                            <img src="img/icon-24.png" alt="" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div id="PaymentImps">
                                <div class="payment-line">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-12">
                                            <h3> <a href="#"><img src="img/icon-24.png" alt=""/></a>IMPS</h3>
                                        </div>
                                        <div class="field">
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-6 col-6">
                                                    <label class="gray-c">Full Name</label>
                                                </div>
                                                <div class="col-lg-6 text-right col-sm-6 col-6">
                                                    <label>Shavez Mirza</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-6 col-6">
                                                    <label class="gray-c">Bank Account Number</label>
                                                </div>
                                                <div class="col-lg-6 text-right col-sm-6 col-6">
                                                    <label>5027101002482</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-6 col-6">
                                                    <label class="gray-c">IFSC CODE</label>
                                                </div>
                                                <div class="col-lg-6 text-right col-sm-6 col-6">
                                                    <label>CNRB0005027</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="payment-line b-last-none">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-12">
                                            <h3> <a href="#"><img src="img/icon-25.png" alt=""/></a>Bank Transfer (India)</h3>
                                        </div>
                                        <div class="field">
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-6 col-6">
                                                    <label class="gray-c">Full Name</label>
                                                </div>
                                                <div class="col-lg-6 text-right col-sm-6 col-6">
                                                    <label>Shavez Mirza</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-6 col-6">
                                                    <label class="gray-c">Bank Account Number</label>
                                                </div>
                                                <div class="col-lg-6 text-right col-sm-6 col-6">
                                                    <label>5027101002482</label>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6 col-sm-6 col-6">
                                                    <label class="gray-c">IFSC CODE</label>
                                                </div>
                                                <div class="col-lg-6 text-right col-sm-6 col-6">
                                                    <label>CNRB0005027</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--
                                <div class="payment-line b-last-none">
                                    <div class="row">
                                        <div class="col-lg-12 col-sm-12 col-12">
                                            <h3> <a href="#"><img src="img/icon-23.png" alt=""/></a>UPI</h3>
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
                        <div class="col-lg-9 col-sm-9 col-8">	<a href="#" class="btn-success">Confirm receipt</a>
                        </div>
                        <div class="col-lg-3 col-sm-3 col-4">	<a href="#" class="btn-success cancel">Appeal</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 hidden-xs visible-sm col-sm-6 col-12">
                <div class="card chat  p-payment">
                    <div class="chat_box">
                        <h2 class="head_box bit"><img src="img/bitcoin.png" alt=""/> ⚡ OrianyellaB ⚡</h2>
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
                                                <img src="img/paperclip.png">
                                            </a>
                                        </div>
                                        <div class="col-lg-10 flush col-sm-7 col-8">
                                            <input type="text" name="" placeholder="Enter your message here">
                                        </div>
                                        <div class="col-lg-1 col-sm-3 col-2 xs-center xs-flush">
                                            <div class="send_box">
                                                <button>
                                                    <img src="img/icon-green.png">
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
@endsection