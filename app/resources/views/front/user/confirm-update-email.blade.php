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
                    <p>Security <img src="{{ asset('front/img/cart-1.png') }}" alt=""/> Confirm verification code </p>
                    <div class="col-lg-4 offset-lg-4 flush xs-center col-sm-6 offset-sm-3 col-12">
                        <form method="post" action="{{ route('user.updateEmail.verify.code') }}"> 
                            @csrf()
                            <h3>Verfication code</h3>
                            <div class="white-email">
                                <div class="field">
                                    <div class="col-lg-12 text-center col-sm-12 col-12">
                                        <h5>Security verification</h5>
                                        <p>To secure your account, please complete the following verification.</p>
                                        <label>E-mail verification code</label>
                                        <input type="text" placeholder="" name="code" />
                                    </div>
                                    <br/>
                                    <div class="col-lg-12 text-left col-sm-12 col-12">
                                        <span>Enter the 6 digit code received by @php $minFill = 4; echo preg_replace_callback('/^(.)(.*?)([^@]?)(?=@[^@]+$)/u',function ($m) use ($minFill) {return $m[1] . str_repeat("*", max($minFill, mb_strlen($m[1], 'UTF-8'))) . ($m[3] ?: $m[0]); }, Auth::user()->email ); @endphp</span>
                                    </div>
                                    <input type="hidden" name="email" value="{{ $request->new_email }}">
                                    <input type="hidden" name="session_id" value="{{ $data['session_id']}}">
                                    <p class="not_m mb-0 resend-btn text-center"><b class="time"><a href="javascript:void(0)" disabled> Resend OTP </a> &nbsp;<label id="timer"></label>
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

@section('page_scripts')

<script>

var defaultCount = 300;
var count=defaultCount;
var send = 1;
var counter = null;

function timer()
{
    count = count-1;
    if (count <= 0)
    {
        clearInterval(counter);
        $('.time a').attr('onclick',"sendOTP()")
        $("#timer").html('');
        return;
    }
    var minutes = Math.floor(count / 60);
    var seconds = count - minutes * 60;
    var html = "in ";
    if(minutes > 0 ) html = html + minutes + " mins ";
    if(seconds > 0 ) html = html + seconds + " secs ";
    $("#timer").html(html);

}
timer();
</script>    
@endsection