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
									<img src="{{ asset('front/img/dark-logo.png') }}" class="black-logo" alt="">
									<img src="{{ asset('front/img/logo.png') }}" class="white_logo" alt="">
								</a>
                                <h2>{{__("Welcome to Route")}}</h2>
                                <p>{{__("Please sign-in to your account and start the adventure")}}</p>
                               
                                  <form method="POST"  id="loginform" action="{{ route('login') }}">
                                    @csrf
                                  <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        @error('email')
                                        <p class="invalid-value" role="alert">
                                            <strong>{{ $message }}</strong>
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
                                            <label id="email-err"></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">{{__("Password")}}</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required id="password-field" autocomplete="cc-additional-name">
                                        <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                                        <label id="pswd-err"></label>
                                    </div>
                                    <div class="form-group otp" style="display: none">
                                        <label for="exampleInputEmail1">OTP</label>
                                        <input type="text" class="form-control" id="otp"
                                            aria-describedby="emailHelp" placeholder="Enter OTP" name="otp">
                                        <input type="hidden" id="session_id" value="">    
                                        <p class="not_m mb-0 resend-btn text-left"><b class="time"><a href="javascript:void(0)" disabled> Resend OTP </a> &nbsp;<label id="timer"></label>
                                        <p class="otp-msg mb-0 text-left"></p>
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" name="remember_me" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">{{__("Remember me")}}</label>
                                        <a href="{{ route('password.request') }}">{{__("Forgot Password?")}}</a>
                                    </div>
                                    {{-- <button type="submit" disabled style="display: none" id="send-otp" class="btn btn-primary">{{__("Send OTP")}}</button> --}}
                                    <button type="submit"  id="login" class="btn btn-primary">{{__("Sign In")}}</button>
                                    <p class="not_m">{{__("New on our platform?")}} <a href="{{ route('register') }}">{{__("Create an account")}}</a></p>
                                    <ul>
                                        <li>
                                            <div class="flot_btn">
                                                <div class="dark-light">
                                                    <i class="fa fa-moon-o" aria-hidden="true"></i>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
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
        if($('#password-field').val() != '') {
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
                    $('#send-otp').hide().attr('type','button');
                    $('.otp').show();
                    $('#login').show();
                    counter = setInterval(timer, 1000);
                },
                error: function (data) {
                    response = JSON.parse(data.responseText);
                    $(response.errors).each(function(index,value){
                        $('p.msg').html(value.email);
                        $('p.msg').fadeOut(3000)
                    })
                },
            }); 
        }
    }); 
        
    $(document).find('#otp').on('change keyup',function(){
        var dis = $(this);
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

$(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
        input.attr("type", "text");
        } else {
        input.attr("type", "password");
        }
});

$('#email').on("keyup", function() {
    var dis = $(this);
    let email_Validity;
    if(dis.val().length > 10){
        jQuery.ajax({
        type: 'POST',
        url: "{{ route('email-check') }}",
        data: {
            action: "email-check",
            email: dis.val(),
            _token: "{{ csrf_token() }}"
        },
        success: function(res) {
            cls = '';
            if (res.status == 'OK') {
            email_Validity = false;
            msg = 'The entered email id is invalid. Please check once.'
            cls  = 'text-danger';
            } else if (res.status == 'NOT OK') {
            email_Validity = true;
            msg = ''
            cls  = 'text-success';
            }
            if (!email_Validity) {
            $('#email').removeClass('is-valid');
            $('#email').addClass('is-invalid');                    
            } else {
            $('#email').removeClass('is-invalid');
            $('#email').addClass('is-valid');
            }
            $('#email-err').html("<label class='"+ cls +"'>"+msg+"</label>");

        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
    } else {
        $('#email-err').html("");
    }
});



$('#password-field').on("keyup change", function() {
    var dis = $(this);
    let email_Validity;
        jQuery.ajax({
        type: 'POST',
        url: "{{ route('user-check') }}",
        data: {
            action: "user-check",
            email:$('#email').val(),
            password: dis.val(),
            _token: "{{ csrf_token() }}"
        },
        success: function(res) {
            cls = '';
            if (res.status !== 'OK') {
                $('#send-otp').attr('disabled', true);
                $('#pswd-err').html("<label class='text-danger'>The entered password is wrong.</label>");
            } 
            else {
                $('#send-otp').attr('disabled', false);
                $('#pswd-err').html("");
            }
        },
        error: function(xhr, ajaxOptions, thrownError) {
            console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
        }
    });
});
</script>
@endsection
@endsection
