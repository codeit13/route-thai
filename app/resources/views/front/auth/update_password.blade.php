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
                                <h2>{{ __('Change Password') }}</h2>
                                  <form method="POST"  id="passwordForm" action="{{ route('passwords.update') }}">
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
                                        <label for="exampleInputEmail1">{{__('Password')}}</label>
                                        <input type="text" class="form-control @error('email') is-invalid @enderror" placeholder="Password" name="password" value="{{ old('mobile') }}" required id="password" aria-describedby="emailHelp" autocomplete="e-m-a-i-l" autofocus>
                                        <label id="mobile-no-err"></label>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">{{__("Confirm Password")}}</label>
                                        <input type="text" class="form-control" aria-describedby="emailHelp" placeholder="Confirm Password" name="confirm_password">
                                        <input type="hidden" name="mobile" value="{{ $request->mobile}}">    
                                        <p class="otp-msg mb-0 text-left"></p>
                                    </div>
                                    <button type="submit" id="send-otp" class="btn btn-primary">{{__("Change Password")}}</button>
                                </div>
                            </form>
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
            </div>
        </div>
    </section>
@section('page_scripts')
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script src="{{ asset('front/js/intlTelInput.js')}}"></script>
<script>
jQuery('#passwordForm').validate({
rules : {
    password : {
        minlength : 5
    },
    confirm_password : {
        minlength : 5,
        equalTo : "#password"
    }
}
});
</script>
@endsection
@endsection
