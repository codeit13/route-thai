@extends('layouts.front_auth')
@section('title')
    OTP Verification
@endsection
@section('content')
<section id="main-content" class="login_page">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-7 hidden-xs col-sm-7 col-xs-12 text-center flush">
				<div class="side_image">
					<div class="tableRow">
						<div class="tableCell">
							<img src="{{ asset('front/img/phone_otp.png') }}" alt="">
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-5 col-sm-5 col-xs-12 flush">
				<div class="tableRow">
					<div class="tableCell">
						<div class="login_forms">
							<h2>Account Verification</h2>
							<p>Please enter the 6 digit verification code that was 
							send to <b>{{ $request->mobile }}</b>.  The code is valid for 10 minutes.</p>
                            <form action="{{ route('register') }}" method="POST">
                                @csrf()
							  <div class="form-group">
							  	<label>Enter verification code</label>
								<div class="d-flex flex-row mt-5"><input type="text" class="form-control otp" autofocus="" name="otp[]" maxlength="1"><input type="text" class="form-control otp" name="otp[]" maxlength="1"><input type="text" class="form-control otp" name="otp[]" maxlength="1"><input type="text" class="form-control otp" name="otp[]" maxlength="1"><input type="text" class="form-control otp" name="otp[]" maxlength="1"><input type="text" class="form-control otp" name="otp[]" maxlength="1"></div>
                              </div>
                              <button type="submit" id="send-otp" class="btn btn-primary">Verify & Create
                                Account</button>
                              <input type="hidden" name="email" value="{{ $request->email }}">
                              <input type="hidden" name="mobile" value="{{ $request->mobile }}">
                              <input type="hidden" name="password" value="{{ $request->password }}">
                              <input type="hidden" name="session" value="{{ json_decode($data)->Details }}">
							</form>
							<p class="not_m text-left">Resend Email - <b class="time">(30)</b></p>
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
$(".otp").keyup(function () {
    if (this.value.length == this.maxLength) {
      $(this).next('.otp').focus();
    }
});
</script>
@endsection