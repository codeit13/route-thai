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
                    <p>Security <img src="{{ asset('front/img/cart-1.png') }}" alt=""/> Change Email Address </p>
                    <div class="col-lg-4 offset-lg-4 flush xs-center col-sm-6 offset-sm-3 col-12">
                        <form method="post" action="{{ route('user.updateEmail.verify') }}"> 
                            @csrf()
                            <div class="row">
                                <div class="col-lg-12 col-12  col-sm-12 flush">
                                    <h3 class="text-center">Chagne Email Address</h3>
                                    <div class="white-email change">
                                        <div class="field">
                                            <label>New Email</label>
                                            <input type="email"/>
                                        </div>
                                        <div class="field">
                                            <label>Confirm Email</label>
                                            <input type="email"/>
                                        </div>
                                        <div class="field">
                                            <label>Password</label>
                                            <input id="password-field" type="password" class="form-control" name="password" value="">
                                            <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        </div>
                                    </div>
                                </div>	
                            </div>	
                            <div class="row">
                                <div class="col-lg-10 offset-lg-1 text-center col-sm-12 col-12">
                                    <button type="submit">Confirm</button>
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
@endsection