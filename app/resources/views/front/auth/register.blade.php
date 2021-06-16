@extends('layouts.front_auth')
<link href="{{ asset('front/css/flags.css')}}" rel="stylesheet" />
<link href="{{ asset('front/css/intlTelInput.css')}}" rel="stylesheet" />
<style>    
.iti.iti--allow-dropdown {
    width: 100%;
}
</style>
@section('title')
    Register
@endsection
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
                                <h2>{{ __('Create a free account') }}</h2>
                                <p>{{ __('Welcome to Route') }}</p>
                                <p class="error">
                                    @if ($message = Session::get('message'))
                                    <div class="alert alert-danger alert-block">
                                        <a type="button" class="close" data-dismiss="alert">×</a>	
                                            <strong>{{ $message }}</strong>
                                    </div>
                                    @endif
                                </p>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li class="mb-0">{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <p class="error msg"></p>
                                <form method="POST" id="loginform" action="{{ route('register') }}">
                                    @csrf
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                                            aria-labelledby="home-tab">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror"
                                                    value="{{ old('email') }}" required id="email"
                                                    aria-describedby="emailHelp" placeholder="" name="email">
                                                    <label id="email-err"></label>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required id="password" placeholder=""
                                            name="password">
                                            <span toggle="#password" class="fa fa-fw fa-eye field-icon toggle-password"></span>
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
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                                <label class="form-check-label" for="exampleCheck1">I have read and agree to
                                                    the Terms of Service. Routes Terms</label>
                                            </div>
                                            <button type="submit" id="send-otp" class="btn btn-primary" >Send OTP</button>
                                            <button type="submit"  id="register" class="btn btn-primary" style="display: none">Create Account</button>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <button type="button" class="btn btn-primary submit-login">Send OTP</button>
                                        <button type="button" class="btn btn-primary submit-login" >Create Account</button>
                                    </div>
                                </form>
                            </div>
                   
                        <p class="not_m">Already a member? <a href="{{ route('login') }}">Sign in</a></p>
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
     $('#send-otp').click(function(e) {
        e.preventDefault();
        var dis = $('#email');
        if($('#password-field').val() != '') {
            $.ajax({
                url: "{{ route('send.otp.register')}}",
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                method: "POST",
                async: true,
                cache: false,
                data: { _token: "{{ csrf_token() }}", email: dis.val() },
                dataType: "json",
                success: function (data) {    
                    $('#session_id').val(data.session_id);
                    $('#send-otp').hide().attr('type','button');
                    $('.otp').show();
                    $('#register').show();
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
                data: { _token: "{{ csrf_token() }}", code: dis.val(), sessionid:$('#session_id').val(), email: $('#email').val() },
                dataType: "json",
                async: true,
                cache: false,
                beforeSend:function(){
                    $('.otp-msg').html("Checking...");
                },
                success: function (data) {
                if(data.code == 1) {
                    $('#send-otp').hide();
                    $('.otp-msg').html("The OTP is verified successfully.").addClass('text-green');
                    $('.resend-btn').hide();
                    $('#register').attr('disabled',false).trigger('click');
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
    
    // $(document).find('#otp').on('change',function(){
    //     var dis = $(this);
    //     console.log('started');
    //     if(dis.val().length == 6){
    //         $.ajax({
    //             url: "{{ route('verify.otp')}}",
    //             method: "POST",
    //             headers: {
    //                 'X-CSRF-Token': "{{ csrf_token() }}"
    //             },
    //             data: { _token: "{{ csrf_token() }}", code: dis.val(), sessionid:$('#session_id').val(), mobile: $('#mobile_no').val() },
    //             dataType: "json",
    //             async: true,
    //             cache: false,
    //             success: function (data) {
    //                 $('.submit-login').attr('disabled',false);
    //             },
    //             error: function (event) { 
                    
    //             },
    //         });
    //     }
    //     else {
    //         console.log('errors');
    //         return false; 
    //     }
    // });
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"></script>
<script src="{{ asset('front/js/intlTelInput.js')}}"></script>
<script src="{{ asset('front/js/jquery.flagstrap.js')}}"></script>
<script>
$(document).ready(function() {
    $("#hide").click(function() {
        $(".alertbox").hide();
    });
    $("#show").click(function() {
        $(".alertbox").show();
    });
    // var input = document.querySelector("#mobile_no");
    // let iti = intlTelInput(input, {
    //     dropdownContainer: document.body,
    //     geoIpLookup: function(callback) {
    //     $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
    //         var countryCode = (resp && resp.country) ? resp.country : "";
    //         callback(countryCode);
    //     });
    //     },
    //     initialCountry: "th",
    //     utilsScript: "{{ asset('front/js/utils.js')}}",
    // });
    // $('#mobile_no').on("keyup", function() {
    //     var dis = $(this);
    //         let mobileNo = iti.getNumber();
    //         let phone_Validity;
    //         $(this).val(mobileNo);
    //         if(dis.val().length > 10){
    //           jQuery.ajax({
    //             type: 'POST',
    //             url: "{{ route('mobile-check') }}",
    //             data: {
    //               action: "mobile-no-check",
    //               mobile: mobileNo,
    //               _token: "{{ csrf_token() }}"
    //             },
    //             success: function(res) {
    //               cls = '';
    //               if (res.status == 'OK') {
    //                 phone_Validity = false;
    //                 cls  = 'text-success';
    //               } else if (res.status == 'NOT OK') {
    //                 phone_Validity = true;
    //                 cls  = 'text-danger';
    //               }
    //               if (!phone_Validity) {
    //                 $('#phone').removeClass('is-valid');
    //                 $('#phone').addClass('is-invalid');                    
    //               } else {
    //                 $('#phone').removeClass('is-invalid');
    //                 $('#phone').addClass('is-valid');
    //               }
    //               $('#mobile-no-err').html("<label class='"+ cls +"'>"+res.message+"</label>");

    //             },
    //             error: function(xhr, ajaxOptions, thrownError) {
    //               console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
    //             }
    //         });
    //     } else $('#mobile-no-err').html("");
    // });
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
                email_Validity = true;
                cls  = 'text-success';
                } else if (res.status == 'NOT OK') {
                email_Validity = false;
                cls  = 'text-danger';
                }
                if (!email_Validity) {
                $('#email').removeClass('is-valid');
                $('#email').addClass('is-invalid');                    
                } else {
                $('#email').removeClass('is-invalid');
                $('#email').addClass('is-valid');
                }
                $('#email-err').html("<label class='"+ cls +"'>"+res.message+"</label>");

            },
            error: function(xhr, ajaxOptions, thrownError) {
                console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });
        } else {
            $('#email-err').html("");
        }
    });
});

$(".toggle-password").click(function() {

$(this).toggleClass("fa-eye fa-eye-slash");
var input = $($(this).attr("toggle"));
if (input.attr("type") == "password") {
  input.attr("type", "text");
} else {
  input.attr("type", "password");
}
});

</script>
@endsection