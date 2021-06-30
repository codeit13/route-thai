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
                @if(Auth::user()->google2fa_secret != '')
                <div class="col-lg-12 flush xs-space col-sm-12 col-12 verification">
                    <p>Security <img src="{{ asset('front/img/cart-1.png') }}" alt=""/> Verification </p>
                    <div class="col-lg-4 offset-lg-4 flush xs-center col-sm-6 offset-sm-3 col-12">
                        <form method="post" action="#"> 
                            @csrf()
                            <div class="row">
                                <div class="col-lg-12 col-12  col-sm-12 flush">
                                    <h3 class="text-center mb-3">Verification</h3>
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
                                        <label>Authenicator Code</label>
                                        <input type="password"  name="auth_code" placeholder="Enter Verification Code" id="auth_code" autocomplete="werewrwer">
                                     </div>
                                    </div>
                                </div>	
                            </div>	
                            <div class="row">
                                <div class="col-lg-10 offset-lg-1 text-center col-sm-12 col-12">
                                    <button id="verification" type="submit">Verify</button>
                                </div>
                            </div>	
                        </form>	
                    </div>	
                </div>	
                @endif
                <div class="col-lg-12 flush xs-space col-sm-12 col-12 change-password @if(Auth::user()->google2fa_secret != '') d-none @endif">
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

                                     <div class="field">
                                        <label>OTP</label>
                                        <input type="text" name="otp"  placeholder="OTP - Sent over your registered email" autocomplete="werewrwer">
                                     </div>
                                     <input name="session_id" type="hidden" id="session_id">
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

@section('page_scripts')
<script>
    @if(Auth::user()->google2fa_secret != '')
    $('#verification').on('click',function(e){
        e.preventDefault();
        $.ajax({
            type:'POST',
            dataType:'JSON',
            url:"{{ route('user.activity.verify.2fa') }}",
            data:{ code : $('#auth_code').val(), _token: "{{ csrf_token() }}" },
            success:function(data) {
                if(data.status == 'success'){
                    $('.change-password').removeClass('d-none');
                    $('.verification').fadeOut();
                    $('.change-password').removeClass('d-none').fadeIn();
                    localStorage.setItem('2fa-verified',true);                    
                }
            }
         });
    });
    @else
        otp();
    @endif

    $(window).load(function(){  
        if(localStorage.getItem('2fa-verified') == "true"){
            otp();
        }
    })


    function otp(){
        $('.change-password').removeClass('d-none');
        $('.verification').fadeOut();
        $('.change-password').removeClass('d-none').fadeIn();
        $.ajax({
            type:'GET',
            url:"{{ route('user.sendOTP','email') }}",
            success:function(data) {   
                $('#session_id').val(data.session_id);
            }
        });
    }
</script>
@endsection