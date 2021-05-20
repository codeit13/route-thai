@extends('layouts.back_auth')
@section('title')
   Login | Admin | Route P2P2 Exchange Network 
@endsection
@section('content')
<style>
body {
    background:#161625;
}
</style>
<div class="container-fluid">
    <div class="tableRow">
      <div class="tableCell">
        <div class="row">
          <div class="col-xl-6 col-xs-12 col-sm-6">
            <div class="form_login">
              <a class="navbar-brand" href="javascript:void(0)">
                <img src="{{ asset('front/img/logo.png') }}">
              </a>
              <h2 class="text-white">Welcome Back!</h2>
              <h1 class="text-white">Login in to your account</h1>
              <form method="POST" action="{{ route('admin.login') }}">
                @csrf
                <div class="form-group">
                    <label for="example-email-input" class="form-control-label text-white">Email</label>
                    <input class="form-control form-control-alternative @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus type="email" placeholder="Enter your email" id="example-email-input">
                </div>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
                <div class="form-group">
                    <label for="example-password-input" class="form-control-label text-white">Password</label>
                    <input id="password-field" class="form-control form-control-alternative @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" type="password" placeholder="Enter your password" id="example-password-input">
                    <span toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password"></span>
                </div>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input form-control-alternative" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                  <label class="custom-control-label text-white" for="customCheck1">Remember me</label>
                  <!-- <a href="#" class="fg-password">Forgot password?</a> -->
                </div>
                <div class="form-group">
                  <input type="submit" name="" value="Login" class="btn btn-primary">
                </div>
              </form>
            </div>
          </div>
          <div class="col-xl-6 col-xs-12 col-sm-6">
            <div class="side-image login">
              <img src="{{ asset('back/img/login_page.png') }}">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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
                                    <span class="invalid-feedback" role="alert">
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
@section('page_scripts')
<script>
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
@endsection

