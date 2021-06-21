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
                    <p>Security <img src="{{ asset('front/img/cart-1.png') }}" alt=""/> Change Password </p>
                    <div class="col-lg-4 offset-lg-4 flush xs-center col-sm-6 offset-sm-3 col-12">
                       
                        <form method="post" action="{{ route('user.change.password.save') }}"> 
                            @csrf()
                            <div class="row">
                                <div class="col-lg-12 col-12  col-sm-12 flush">
                                    <h3 class="text-center mb-3">Chagne Password</h3>
                                    @if ($errors->any())
                                    <div class="alert alert-danger">
                                       <ul>
                                          @foreach ($errors->all() as $error)
                                             <li class="mb-0">{{ $error }}</li>
                                          @endforeach
                                       </ul>
                                    </div>
                                    @endif 
                                    <div class="white-email change">
                                    <div class="field">
                                        <label>Current Password</label>
                                        <input type="password"  name="current_password" placeholder="Enter Current Password" autocomplete="werewrwer">
                                     </div>
                                     <div class="field">
                                        <label>New Password</label>
                                        <input type="password"  name="new_password" placeholder="Enter New Password" autocomplete="werewrwer">
                                     </div>
                                     <div class="field">
                                        <label>Confirm Password</label>
                                        <input type="text"  name="new_confirm_password"  placeholder="Confirm New Password" autocomplete="werewrwer">
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