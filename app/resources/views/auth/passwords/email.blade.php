@extends('layouts.front_auth')
<style>
.error{
    color:red !important;
    text-align: left !important;
}
</style>
@section('content')
    <section id="main-content" class="login_page">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-7 col-sm-7 col-xs-12 text-center flush">
                    <div class="side_image">
                        <div class="tableRow">
                            <div class="tableCell">
                                <img src="{{ asset('front/img/login_ve.png') }}" alt="">
                            </div>
                        </div>
                    </div> 
                </div>
                <div class="col-lg-5 col-sm-5 col-xs-12 flush">
                    <div class="tableRow">
                        <div class="tableCell">
                            <div class="login_forms">
                                <a class="navbar-brand  dark-mode-img dark-logo" href={{ route('home') }}>
									<img src="{{ asset('front/img/logo.png') }}" class="black-logo" alt="">
									<img src="{{ asset('front/img/logo.png') }}" class="white_logo" alt="">
                                </a>                               
                                <h2>{{ __('Reset Password') }}</h2>
                                  <form method="POST"  id="loginform" action="{{ route('password.email') }}">
                                    @csrf
                                  <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        @error('email')
                                        <p class="error" role="alert">
                                            {{ $message }}
                                        </p>
                                        @enderror
                                        @error('password')
                                        <p class="invalid-value" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </p>
                                        @enderror
                                    <p class="msg error"></p>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{__('Email address')}}</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required id="email"
                                            aria-describedby="emailHelp" autocomplete="e-m-a-i-l" autofocus>
                                    </div>
                                    <button type="submit" id="reset" class="btn btn-primary">{{__("Send Password Reset Link")}}</button>
                                    <p class="not_m">{{__("New on our platform?")}} <a href="{{ route('register') }}">{{__("Create an account")}}</a></p>
                                </div>
                            </form>
                          </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@section('page_scripts')
<script>
var defaultCount = 300;
var count=defaultCount;
var send = 1;
var counter = null;
    $('#send-otp').click(function(e) {
        e.preventDefault();
        var dis = $('#email');
                $.ajax({
                    url: "{{ route('send.otp.login')}}",
                    headers: {
                       'X-CSRF-Token': "{{ csrf_token() }}"
                    },
                    method: "POST",
                    async: true,
                    cache: false,
                    data: { _token: "{{ csrf_token() }}", email: dis.val() },
                    dataType: "json",
                    success: function (data) {    
                        $('#session_id').val(data.Details);
                        $('#send-otp').hide();
                        $('.otp').show();
                        $('#login').show();
                        counter = setInterval(timer, 1000);
                    },
                    error: function (data) {
                        console.log(data); 
                        response = JSON.parse(data.responseText);
                        $(response.errors).each(function(index,value){
                            $('p.msg').html(value.email);
                            $('p.msg').fadeOut(3000)
                        })
                    },
                });
        }); 
        
        $(document).find('#otp').on('change',function(){
            var dis = $(this);
            console.log('started');
            if(dis.val().length == 6){
                $.ajax({
                    url: "{{ route('verify.otp')}}",
                    method: "POST",
                    headers: {
                       'X-CSRF-Token': "{{ csrf_token() }}"
                    },
                    data: { _token: "{{ csrf_token() }}", code: dis.val(), sessionid:$('#session_id').val(), mobile: $('#mobile_no').val() },
                    dataType: "json",
                    async: true,
                    cache: false,
                    beforeSend:function(){
                        $('.otp-msg').html("Checking...");
                    },
                    success: function (data) {
                    if(data.Status == 'Success') {
                        $('#send-otp').hide();
                        $('.otp-msg').html("The OTP is verified successfully.").addClass('text-green');
                        $('.resend-btn').hide();
                        $('#login').attr('disabled',false).trigger('click');
                    } else {
                        $('.otp-msg').html("The OTP is Invalid.").addClass('text-danger').removeClass('text-green');
                    }
                    },
                    error: function (event) { 
                        
                    },
                });
            }
            else {
                console.log('errors');
                return false; 
        }
    });
 
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


function sendOTP(){
    var dis = $('#email');
	$.ajax({
        url: "{{ route('send.otp.login')}}",
        headers: {
            'X-CSRF-Token': "{{ csrf_token() }}"
        },
        method: "POST",
        async: true,
        cache: false,
        data: { _token: "{{ csrf_token() }}", email: dis.val() },
		dataType: "json",
		success: function (data) {
			$('#session_id').val(data.Details);
			send++;
			count = defaultCount * send;
			setInterval(timer, 500*send);
			$('.msg').html("The OTP has been sent.");
			$('.time a').attr('onclick',"")
			setTimeout( function() { $('.msg').html("") }, 3500); 
		},
		error: function (event) { 
			
		},
	}); 
}
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/6.4.1/js/intlTelInput.min.js"></script>
@endsection
@endsection
