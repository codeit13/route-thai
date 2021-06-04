@extends('layouts.front')
@section('title')
Payment Methods - Route: P2P Trading Platform
@endsection
@section('content')

<section id="dashboard">
    <div class="container-fluid">
       <div class="row">
          @include('front.user._sidebar')
          <div class="col-lg-10 col-xs-12 flush">
             <div class="content_dashboard">
                <div class="container">
                   <div class="row">
                      <div class="col user_details"> 
                         <div class="row">
                            <div class="col-lg-6 col-xs-12">
                               <nav aria-label="breadcrumb">
                                 <ol class="breadcrumb">
                                   <li class="breadcrumb-item"><a href="payment.html">Payment Method</a></li>
                                   <li class="breadcrumb-item active" aria-current="page">New {{ $payment_method->name }} Payment Method</li>
                                 </ol>
                               </nav>
                            </div>
                            <div class="col-lg-6 col-xs-12 text-center">
                               
                            </div>
                         </div>
                      </div>
                   </div>
                   @if ($errors->any())
                        <div class="alert alert-danger">
                              <ul>
                                 @foreach ($errors->all() as $error)
                                    <li class="mb-0">{{ $error }}</li>
                                 @endforeach
                              </ul>
                        </div>
                     @endif
                   <div class="row row-eq-height">
                      <div class="col-lg-6 col-xs-12 flush-left  xs-flush">
                        <form action="{{ route('user.payment.save') }}" id="add_method" method="post" enctype="multipart/form-data">
                           @csrf()
                        <div class="card pd_card an_card auto_card">
                            <h2>
                                @if($payment_method->hasMedia('icon'))
                                    <img src="{{ $payment_method->firstMedia('icon')->getUrl() }}"> 
                                @endif
                              {{ $payment_method->name }} 
                            </h2> 
                            <div class="iverify baccount">
                               <div class="form">
                                  <div class="form-group">
                                     <label>Account Name</label>
                                     <input type="text"  name="account_label" value="{{old('account_label') }}" placeholder="Enter Account Name">
                                  </div>
                                  
                                  @if($payment_method->name == 'Bank' || $payment_method->name == 'IMPS')
                                  <div class="form-group">
                                     <label>Bank account number</label>
                                     <input type="text"  name="account_number" value="{{old('account_number') }}" placeholder="Enter your Bank Account Number">
                                  </div>
                                  <div class="form-group">
                                     <label>Bank name</label>
                                     <input type="text"  name="bank_name" value="{{old('bank_name') }}" placeholder="Enter Bank Name">
                                  </div>
                                  <div class="form-group">
                                     <label>IFSC code</label>
                                     <input type="text"  name="ifs_code" value="{{old('ifs_code') }}" placeholder="Enter IFSC Code">
                                  </div>
                                  <div class="form-group">
                                     <label>Account Type (Optional)</label>
                                     <select  name="type" class="form-control">
                                        <option value="">Choose Account Type</option>
                                        <option value="current" {{ old('type') == 'current' ? 'selected':'' }}>Current</option>
                                        <option value="saving" {{ old('type') == 'saving' ? 'selected':'' }}>Saving</option>
                                     </select>
                                     {{-- <input type="text"  name="type" value="{{old('type') }}" placeholder="Specify the account type ( Current / Saving )"> --}}
                                  </div>
                                  @elseif($payment_method->name == 'UPI')
                                  <div class="form-group">
                                    <label>UPI ID</label>
                                    <input type="text"  name="account_number" value="{{old('account_number') }}" placeholder="Enter your UPI ID">
                                 </div>
                                 <div class="form-group">
                                    <label>Payment QR Code (Optional)</label>
                                     <div class="image-upload">
                                      <input type="file"  name="qr-code" id="logo" onchange="fileValue(this)" accept=".jpg, .jpeg, .png, .bmp" alt="QR Code" >
                                      <label for="logo" class="upload-field" id="file-label">
                                          <div class="file-thumbnail">
                                              <img id="image-preview" src="{{ asset('front/img/upload.png') }}">
                                              <h3 id="filename">
                                              </h3>
                                              <p ></p>
                                          </div>
                                      </label>
                                  </div>
                                    <h3 class="file_info"> Drag and Drop </h3><p>(JPG/JPEG/PNG/BMP, less than 1MB)</p>
                                 </div>
                                  @endif
                                <input type="hidden"  name="payment_method_id" value="{{ $payment_method->id }}">
                               </div>
                            </div>
                         </div>
                         <span><b>Tips</b></span>
                         <p>When you sell your cryptocurrency, the added payment method will be shown to the buyer during the transaction. To accept cash transfer ,please make sure the information is correct.</p>
                         <div class="col-lg-12 flush  space-xs col-sm-12 col-12">
                            <div class="row">
                               <div class="col-lg-4 col-sm-4 col-4  xs-flush">  <a href="{{ route('user.payments') }}" class="btn-success cancel short_btn">Cancel</a>
                               </div>
                               <div class="col-lg-8 col-sm-8 col-8">  <button type="submit" class="btn-success long_btn">Confirm</button>
                               </div>
                            </div>
                         </div>
                        </form>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>
 @section('page_scripts')
 <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
 <script type="text/javascript">
    function fileValue(value) {
        var path = value.value;
        var extenstion = path.split('.').pop();
        if(extenstion == "jpg" || extenstion == "svg" || extenstion == "jpeg" || extenstion == "png"|| extenstion == "gif"){
            document.getElementById('image-preview').src = window.URL.createObjectURL(value.files[0]);
            var filename = path.replace(/^.*[\\\/]/, '').split('.').slice(0, -1).join('.');
            document.getElementById("filename").innerHTML = filename;
        }else{
            alert("File not supported. Kindly Upload the Image of below given extension ")
        }
    }
</script>
   <script>
         $("#add_method").validate({
            ignore:'hidden',
            rules: {
               "account_label":  { 'required':true},
               "account_number":  { 'required':true, @if($payment_method->name !== 'UPI') 'number':true,'minlength':9 ,'maxlength':18 @else regex: '/^[\w.-]+@[\w.-]+$/' @endif},
               "bank_name":  { 'required':$('input[name=bank_name]').length > 0  },
               "ifs_code":  { 'required':$('input[name=ifs_code]').length > 0 },
               "type":  { 'required':$('input[name=type]').length > 0 },
               "payment_method_id":  { 'required':true },
            },
            message:{
               "account_label":  { 'required':'The Account name is required.'},
               "account_number":  { 'required':'The Account number is required.','number':"The Account number should be numeric value.",'minlength':"The Account Number must have 9 digits." ,'maxlength':'The Account Number can\'t be longer than 18 digits.' },
               "bank_name":  { 'required':'The Bank_name is required.' },
               "ifs_code":  { 'required':'The IFSC is required.'},
               "type":  { 'required':'The Account Type is required.'},
            },
            submitHandler: function(form) {
                  $(form).ajaxSubmit();
               }
         });
   </script>
@endsection
@endsection
