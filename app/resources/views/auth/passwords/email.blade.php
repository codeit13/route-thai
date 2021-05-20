@extends('layouts.front_auth')

<link href="{{ asset('front/css/flags.css')}}" rel="stylesheet" />
<link href="{{ asset('front/css/intlTelInput.css')}}" rel="stylesheet" />
<style>
.error{
    color:red !important;
    text-align: left !important;
}
.iti.iti--allow-dropdown {
    width: 100%;
}
.iti.iti--allow-dropdown input#mobile
{
    padding-left:45px;
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
                                  <form method="POST"  id="loginform" action="{{ route('passwords.reset') }}">
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
                                        <label for="exampleInputEmail1">{{__('Enter Registered Mobile No')}}</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" name="mobile" value="{{ old('mobile') }}" required id="mobile"
                                            aria-describedby="emailHelp" autocomplete="e-m-a-i-l" autofocus>
                                            <label id="mobile-no-err"></label>
                                    </div>
                                    <div class="form-group otp" style="display: none">
                                        <label for="exampleInputEmail1">OTP</label>
                                        <input type="text" class="form-control" id="otp"
                                            aria-describedby="emailHelp" placeholder="Enter OTP" name="otp">
                                        <input type="hidden" id="session_id" value="">    
                                        <p class="not_m mb-0 resend-btn text-left"><b class="time"><a href="javascript:void(0)" disabled> Resend OTP </a> &nbsp;<label id="timer"></label>
                                        </b></p>
                                        <p class="otp-msg mb-0 text-left"></p>
                                    </div>
                                    <button type="button" id="send-otp" class="btn btn-primary">{{__("Send OTP")}}</button>
                                    <button type="submit" style="display: none" id="chanage-password" class="btn btn-primary">{{__("Change Password")}}</button>
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
<script src="{{ asset('front/js/intlTelInput.js')}}"></script>
<script>
var defaultCount = 300;
var count=defaultCount;
var send = 1;
var counter = null;
    $('#send-otp').click(function(e) {
        e.preventDefault();
        var dis = $('#mobile');
            $.ajax({
                url: "{{ route('send.otp')}}",
                headers: {
                    'X-CSRF-Token': "{{ csrf_token() }}"
                },
                method: "POST",
                async: true,
                cache: false,
                data: { _token: "{{ csrf_token() }}", mobile: dis.val() },
                dataType: "json",
                success: function (data) {    
                    $('#session_id').val(data.Details);
                    $('#send-otp').hide();
                    $('.otp').show();
                    $('#chanage-password').show();
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
            if(dis.val().length == 6){
                $.ajax({
                    url: "{{ route('verify.otp')}}",
                    method: "POST",
                    headers: {
                       'X-CSRF-Token': "{{ csrf_token() }}"
                    },
                    data: { _token: "{{ csrf_token() }}", code: dis.val(), sessionid:$('#session_id').val(), mobile: $('#mobile').val() },
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
        url: "{{ route('send.otp')}}",
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
    var input = document.querySelector("#mobile");
    let iti = intlTelInput(input, {
        dropdownContainer: document.body,
        geoIpLookup: function(callback) {
        $.get("http://ipinfo.io", function() {}, "jsonp").always(function(resp) {
            var countryCode = (resp && resp.country) ? resp.country : "";
            callback(countryCode);
        });
        },
        initialCountry: "th",
        utilsScript: "{{ asset('front/js/utils.js')}}",
    });

    $('#mobile').on("keyup", function() {
        var dis = $(this);
            let mobileNo = iti.getNumber();
            let phone_Validity;
            $(this).val(mobileNo);
            if(dis.val().length > 11){
              $('#send-otp').attr('disabled',true);
              jQuery.ajax({
                type: 'POST',
                url: "{{ route('mobile-check') }}",
                data: {
                  action: "mobile-no-check",
                  mobile: mobileNo,
                  _token: "{{ csrf_token() }}"
                },
                success: function(res) {
                  cls = '';
                  msg = '';
                  if (res.status == 'OK') {
                    phone_Validity = false;
                    cls  = 'text-danger';
                    msg = 'The entered mobile no is not registered. Please check once before trying.'
                  } else {
                    phone_Validity = true;
                    cls  = 'text-success';
                  }
                  if (!phone_Validity) {
                    $('#mobile').removeClass('is-valid');
                    $('#mobile').addClass('is-invalid');
                    $('#mobile-no-err').html("<label class='"+ cls +"'>"+msg+"</label>");     
                    $('#send-otp').attr('disabled',true);
                  } else {
                    $('#mobile').removeClass('is-invalid');
                    $('#mobile').addClass('is-valid');
                    $('#mobile-no-err').html("<label class='"+ cls +"'>"+msg+"</label>");
                    $('#send-otp').attr('disabled',false);
                  }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                  console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        }
    });
</script>
@endsection
@endsection
