@extends('layouts.front_auth')
<link href="{{ asset('front/css/flags.css')}}" rel="stylesheet" />
<link href="{{ asset('front/css/intlTelInput.css')}}" rel="stylesheet" />
<style>
    .iti.iti--allow-dropdown {
        width: 100%;
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
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <p class="error msg"></p>
                                <form method="POST" id="loginform" action="{{ route('otp.register') }}">
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
                                            @error('email')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Password</label>
                                                <input type="password"
                                                    class="form-control @error('password') is-invalid @enderror"
                                                    name="password" required id="exampleInputPassword1" placeholder=""
                                            name="password">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Phone Number</label>
                                                <input type="tel" value="{{ old('mobile')}}" class="form-control" id="mobile_no"
                                                    aria-describedby="emailHelp" required placeholder="Enter mobile No" name="mobile">
                                                <label id="mobile-no-err"></label>
                                            </div>

                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1" required>
                                                <label class="form-check-label" for="exampleCheck1">I have read and agree to
                                                    the Terms of Service. Routes Terms</label>
                                            </div>
                                            <button type="submit"  class="btn btn-primary">Create
                                                Account</button>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <button type="button" class="btn btn-primary submit-login" disabled>Create Account</button>
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
        $('#mobile_no').on('keyup',function(){
            var dis = $(this);
            if(dis.val().length == 10){
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
                        setTimeout( function() { $('.otp').show(); }, 800); 
                    },
                    error: function (event) { 
                        
                    },
                });
                    } else
                return false;
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
                    success: function (data) {
                        $('.submit-login').attr('disabled',false);
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
    var input = document.querySelector("#mobile_no");
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
    $('#mobile_no').on("keyup", function() {
        var dis = $(this);
            let mobileNo = iti.getNumber();
            let phone_Validity;
            $(this).val(mobileNo);
            if(dis.val().length > 10){
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
                  if (res.status == 'OK') {
                    phone_Validity = false;
                    cls  = 'text-success';
                  } else if (res.status == 'NOT OK') {
                    phone_Validity = true;
                    cls  = 'text-danger';
                  }
                  if (!phone_Validity) {
                    $('#phone').removeClass('is-valid');
                    $('#phone').addClass('is-invalid');                    
                  } else {
                    $('#phone').removeClass('is-invalid');
                    $('#phone').addClass('is-valid');
                  }
                  $('#mobile-no-err').html("<label class='"+ cls +"'>"+res.message+"</label>");

                },
                error: function(xhr, ajaxOptions, thrownError) {
                  console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
            });
        } else $('#mobile-no-err').html("");
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
                cls  = 'text-success';
                } else if (res.status == 'NOT OK') {
                email_Validity = true;
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
            ('#email-err').html("");
        }
    });
});
</script>
@endsection