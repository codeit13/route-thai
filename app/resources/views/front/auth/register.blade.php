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
                                <h2>{{ __('Create a free account') }}</h2>
                                <p>{{ __('Welcome to Route') }}</p>
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                            aria-controls="home" aria-selected="true">Email</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                            aria-controls="profile" aria-selected="false">Mobile</a>
                                    </li>
                                </ul>
                                <form method="POST" id="loginform" action="{{ route('register') }}">
                                    @csrf
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                                            aria-labelledby="home-tab">
                                            <p></p>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Email address</label>
                                                <input type="email"
                                                    class="form-control @error('email') is-invalid @enderror" name="email"
                                                    value="{{ old('email') }}" required id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" placeholder="" name="email">
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

                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                                <label class="form-check-label" for="exampleCheck1">I have read and agree to
                                                    the Terms of Service. Routes Terms</label>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Create
                                                Account</button>
                                    </div>
                                    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                        <div class="form-group">
                                            <p></p>
                                            <label for="exampleInputEmail1">Phone Number</label>
                                            <input type="text" class="form-control" id="mobile_no"
                                                aria-describedby="emailHelp" placeholder="Enter mobile No" name="mobile">
                                        </div>
                                        <div class="form-group otp" style="display: none">
                                            <p></p>
                                            <label for="exampleInputEmail1">OTP</label>
                                            <input type="text" class="form-control" id="otp"
                                                aria-describedby="emailHelp" placeholder="Enter OTP" name="otp">
                                            <input type="hidden" id="session_id" value="">    
                                        </div>
                                        <button type="button" class="btn btn-primary submit-login" disabled>Create Account</button>
                                    </div>
                                </form>
                            </div>
                   
                        <p class="not_m">Already a member? <a href="login.html">Sign in</a></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@section('page_scripts')
    <script>
        $('#send-otp').click(function() {
            $("#profile-tab").trigger('click');
        });
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
@endsection
{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection

@section('page_script')
<script>
    $(document).ready(function() {
        $("#hide").click(function() {
            $(".alertbox").hide();
        });
        $("#show").click(function() {
            $(".alertbox").show();
        });
    });

</script>
@endsection
