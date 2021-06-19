<link href="{{ asset('front/css/intlTelInput.css')}}" rel="stylesheet" />
<div class="modal fade" id="addMobileNo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog model-centered" role="document">
        <form action="{{ route('user.update.mobile') }}" method="post">
            @csrf()
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Mobile No</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <label> Mobile No: </label>
                    <input class="form-control" id="mobile_no" type="text" name="mobile">
                    <span id="mobile-no-err" class="usr-msg"></span>

                    <div class="form-group otp" style="display: none">
                        <label for="exampleInputEmail1">OTP</label>
                        <input type="text" class="form-control" id="otp" aria-describedby="emailHelp" placeholder="Enter OTP" name="otp">

                        <input type="hidden" id="session_id" value="">    
                        <p class="not_m mb-0 resend-btn text-left"><b class="time"><a href="javascript:void(0)" disabled> Resend OTP </a> &nbsp;<label id="timer"></label>
                        <p class="otp-msg mb-0 text-left"></p>
                        <p class="email-msg mb-0 text-left"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="send-otp">Send OTP</button>
                    <button type="submit" class="btn btn-primary save-mobile" id="update" style="display:none" disabled>Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
@push('extra_scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.14/js/utils.js"></script>
<script src="{{ asset('front/js/intlTelInput.js')}}"></script>
<script src="{{ asset('front/js/jquery.flagstrap.js')}}"></script>
<script>
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
    $('#mobile_no').focusout(function() {
        var dis = $(this);
            let mobileNo = iti.getNumber();
            let phone_Validity;
            $(this).val(mobileNo);
            
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
                    $('#mobile_no').removeClass('is-valid');
                    $('#mobile_no').addClass('is-invalid');                    
                  } else {
                    $('#mobile_no').removeClass('is-invalid');
                    $('#mobile_no').addClass('is-valid');
                  }
                  $('#mobile-no-err').html("<label class='"+ cls +"'>"+res.message+"</label>");

                },
                error: function(xhr, ajaxOptions, thrownError) {
                  console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
                }
              });
            
    });
    $('#send-otp').click(function(e) {
        e.preventDefault();
        var dis = $('#mobile_no');
        if($('#password-field').val() != '') {
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
                    $('#send-otp').hide().attr('type','button');
                    $('.otp').show();
                    $('#mobile-no-err').hide();
                    $('#update').show();
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
//    $('.save-mobile').on('click',function(e){
//         e.preventDefault();
//         $.ajax({
//             type:'POST',
//             dataType:'JSON',
//             url:"{{ route('user.update.mobile') }}",
//             data:{ mobile : $('#mobile_no').val(), _token: "{{ csrf_token() }}" },
//             success:function(data) {
//                $('.toggle-msg').html(data.message).show();
//                setTimeout(function() { $(".toggle-msg").hide() }, 2000);
//                $('#addMobileNo .close').trigger('click');
//             }
//          });
//    });
   var defaultCount = 300;
    var count=defaultCount;
    var send = 1;
    var counter = null;
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
    $(document).find('#otp').focusout(function(){
        var dis = $(this);
        $.ajax({
            url: "{{ route('verify.otp.mobile')}}",
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
                $('#update').attr('disabled',false).trigger('click');
            } else {
                $('.otp-msg').html("The OTP is Invalid.").addClass('text-danger').removeClass('text-green');
            }
            },
            error: function (event) { 
                
            },
        });
    });
</script>
@endpush

