@extends('layouts.front')
@section('title')
Change Email Address - Route: P2P Trading Platform
@endsection
@section('content')
<section id="dashboard">
    <div class="container-fluid">
       <div class="row">
        @include('front.user._sidebar') 
        <div class="col-lg-10 col-xs-12 flush">
            <div class="security">
                <div class="col-lg-12 flush xs-space col-sm-12 col-12">
                    <p>Security <img src="{{ asset('front/img/cart-1.png') }}" alt=""/> Device Management</p>
                    <div class="col-lg-4 offset-lg-4 flush xs-center col-sm-6 offset-sm-3 col-12">
                        <form method="post" action="{{ route('user.updateEmail.verify') }}"> 
                            @csrf()
                            <h3>Chagne Email Address</h3>
                            <div class="white-email">
                                <div class="field">
                                    <div class="col-lg-12 text-center col-sm-12 col-12">
                                        <h5>Security verification</h5>
                                        <p>To secure your account, please complete the
                                        following verification.</p>
                                        <label>E-mail verification code</label>
                                        <input type="text" placeholder=""/>
                                    </div>	
                                    <div class="col-lg-12 text-left col-sm-12 col-12">
                                        <span>Enter the 6 digit code received by sha***@gmail.com.</span>
                                    </div>	
                                    <div class="col-lg-12 text-center col-sm-12 col-12">
                                        <a href="#">Send Code</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-10 offset-lg-1 text-center col-sm-12 col-12">
                                <button type="submit">Submit</button>
                            </div>
                        </form>	
                    </div>	
                </div>	
            </div>
        </div>
    </div>
</div>
</section>
@endsection