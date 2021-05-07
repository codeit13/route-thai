@extends('layouts.front_auth')

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
                                    <p></p>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{__('Email address')}}</label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required id="email"
                                            aria-describedby="emailHelp" autocomplete="e-m-a-i-l" autofocus>
                                    </div>
                                    <p></p>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">{{__("Password")}}</label>
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" required id="exampleInputPassword1" autocomplete="cc-additional-name">
                                    </div>
                                    <div class="form-group otp" style="display: none">
                                        <label for="exampleInputEmail1">OTP</label>
                                        <input type="text" class="form-control" id="otp"
                                            aria-describedby="emailHelp" placeholder="Enter OTP" name="otp">
                                        <input type="hidden" id="session_id" value="">    
                                    </div>
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">Remember me</label>
                                        <a href="{{ route('password.request') }}">{{__("Forgot Password?")}}</a>
                                    </div>
                                    <button type="button" id="send-otp" class="btn btn-primary">{{__("Sign In")}}</button>
                               
                                <p class="not_m">{{__("New on our platform?")}} <a href="{{ route('register') }}">{{__("Create an account")}}</a></p>
                            </div>
                            <div class="tab-pane fade" id="profile" role="tabpanel" >
                                <p></p>
                                <div class="form-group otp">
                                    <p></p>
                                    <label for="exampleInputEmail1">OTP</label>
                                    <input type="text" class="form-control" id="otp"
                                        aria-describedby="emailHelp" placeholder="Enter OTP" name="otp">
                                    <input type="hidden" id="session_id" value="">    
                                </div>
                                <button type="submit" class="btn btn-primary">Login</button>
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
    $('#send-otp').click(function(e) {
        e.preventDefault();
        $("#profile-tab").trigger('click'); 
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
                        setTimeout( function() { $('.otp').show(); }, 800); 
                    },
                    error: function (event) { 
                        
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
                    success: function (data) {
                        $('#send-otp').hide();
                        $('#create-account').show();
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/6.4.1/js/intlTelInput.min.js"></script>
@endsection

    {{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-value" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
