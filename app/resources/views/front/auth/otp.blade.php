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
							<p class="msg"></p>
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
                              <input type="hidden" id="session_id" name="session" value="{{ json_decode($data)->Details }}">
							</form>
							
							<p class="not_m text-left"><b class="time"><a href="javascript:void(0)" disabled> Resend OTP </a> &nbsp;<label id="timer"></label>
							</b></p>
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
@endsection

@section('page_scripts')
<script>
$(".otp").keyup(function () {
    if (this.value.length == this.maxLength) {
      $(this).next('.otp').focus();
    }
});
var defaultCount = 300;
var count=defaultCount;
var send = 1;
var counter=setInterval(timer, 1000); //1000 will  run it every 1 second

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
	
	$.ajax({
		url: "{{ route('send.otp') }}",
		headers: {
			'X-CSRF-Token': "{{ csrf_token() }}"
		},
		method: "POST",
		async: true,
		cache: false,
		data: { _token: "{{ csrf_token() }}", mobile: $('input[name=mobile]').val() },
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
@endsection