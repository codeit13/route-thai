@extends('layouts.front')
@section('title')
Account Secuirity - Route: P2P Trading Platform
@endsection
@section('content')
<section id="dashboard">
    <div class="container-fluid">
       <div class="row">
        @include('front.user._sidebar')
        <div class="col-lg-10 col-xs-12 flush">
            <div class="account-security">
                <div class="col-lg-12 col-sm-12 col-12">
                    <h3>Account Security <span>3/4</span></h3>
                </div>	
                <div class="col-lg-12 account-s col-sm-12 col-12">
                    <ul>
                        <li>Enable 2FA</li>
                        <li>Verified</li>
                        <li>Enable Anti-phishing Code</li>
                        <li>Turn-on withdrawal whitelist</li>
                    </ul>
                </div>
                <div class="col-lg-12  col-sm-12 col-12">
                    <div class="row">
                        <div class="col-lg-6 col-sm-6 col-12">
                            <div class="fa-box-white">
                                <h5>2FA</h5>
                                <div class="field">
                                    <div class="row">
                                        <div class="col-lg-9 col-sm-7 col-8">
                                            <label class="text">
                                                <img src="{{ asset('front/img/security-1.png') }}" alt=""/>
                                                Security Key<br>
                                                <a href="#">What is Security Key?</a>
                                            </label>
                                        </div>
                                        <div class="col-lg-3 text-right col-sm-5 col-4">
                                            <a href="#" class="btn-info">Set Up</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="row">
                                        <div class="col-lg-9 col-sm-7 col-8">
                                            <label class="text">
                                                <img src="{{ asset('front/img/security-2.png') }}" alt=""/>
                                                Google Authentication<br>
                                                <span>Used for withdrawals and security modifications</span>
                                            </label>
                                        </div>
                                        <div class="col-lg-3 text-right col-sm-5 col-4">
                                            @if(Auth::user()->google2fa_secret != '')
                                            <button type="button" class="btn btn-sm btn-toggle" data-toggle="button" aria-pressed="true" autocomplete="off">
                                                <div class="handle"></div>
                                            </button>
                                            @else
                                                <a href="{{ route('user.security.2fa.google.add') }}" class="btn-info">Set Up</a>
                                            @endif 
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="row">
                                        <div class="col-lg-9 col-sm-7 col-8">
                                            <label class="text">
                                                <img src="{{ asset('front/img/security-3.png') }}" alt=""/>
                                                SMS Authentication<br>
                                                <span>Used for withdrawals and security modifications</span>
                                            </label>
                                        </div>
                                        <div class="col-lg-3 text-right col-sm-5 col-4">
                                            <button type="button" class="btn btn-sm btn-toggle" data-toggle="button" aria-pressed="false" autocomplete="off">
                                                <div class="handle"></div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="field">
                                    <div class="row">
                                        <div class="col-lg-9 col-sm-7 col-8">
                                            <label class="text">
                                                <img src="{{ asset('front/img/security-4.png') }}" alt=""/>
                                                E-mail Address<br>
                                                <span>Used for withdrawals and security modifications</span>
                                            </label>
                                        </div>
                                        <div class="col-lg-3 text-right col-sm-5 col-4">
                                            <a href="{{ route('user.updateEmail') }}" class="btn-info change">Change</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="fa-box-white device">
                                <div class="field">
                                    <div class="row">
                                        <div class="col-lg-9 col-sm-7 col-8">
                                            <label>
                                                Device Management
                                            </label>
                                        </div>
                                        <div class="col-lg-3 text-right col-sm-5 col-4">
                                            <a href="{{ route('user.deviceManagement') }}" class="btn-info change">Manage</a>
                                        </div>
                                    </div>
                                </div>
                            </div>	
                        </div>
                        <div class="col-lg-6 xs-btn col-sm-6 col-12">
                            <div class="fa-box-white">
                                <div class="field">
                                    <h4>Anti-phishing Code</h4>
                                    <p>By setting up an Anti-Phishing Code, you will be able to tell if your
                                    notification emails are coming from Binance or phishing attempts.</p>
                                    <div class="col-lg-12 text-center col-sm-12 col-12">
                                        <a href="#" class="btn-info">Enable</a>
                                    </div>
                                </div>
                            </div>
                            <div class="fa-box-white">
                                <div class="field">
                                    <h4>Account Activity <span>Last login: {{ Auth::user()->lastLoginAt() ?? now() }}</span></h4>
                                    <p>Suspicious account activity? <b><i>Disable account</i></b></p>
                                    <div class="col-lg-12 text-center col-sm-12 col-12">
                                        <a href="#" class="btn-info change">More</a>
                                    </div>
                                </div>
                            </div>
                            <div class="fa-box-white device">
                                <div class="field">
                                    <div class="row">
                                        <div class="col-lg-9 col-sm-7 col-8">
                                            <label>
                                               Password
                                            </label>
                                        </div>
                                        <div class="col-lg-3 text-right col-sm-5 col-4">
                                            <a href="#" class="btn-info change">Change</a>
                                        </div>
                                    </div>
                                </div>
                            </div>	
                        </div>
                    </div>
                </div>	
            </div>
        </div>
    </div>
</div>
</section>
@endsection