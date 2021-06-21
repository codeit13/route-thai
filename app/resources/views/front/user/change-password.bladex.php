@extends('layouts.front')
@section('title')
Change Password - Route: P2P Trading Platform
@endsection
@section('content')

<section id="dashboard">
    <div class="container-fluid">
       <div class="row">
          @include('front.user._sidebar')
          <div class="col-lg-10 col-xs-12 flush">
             <div class="content_dashboard">
                <div class="container">
                  
                   <div class="row row-eq-height pt-5">
                     
                      <div class="col-lg-6 col-xs-12 flush-left  xs-flush">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                           <ul>
                              @foreach ($errors->all() as $error)
                                 <li class="mb-0">{{ $error }}</li>
                              @endforeach
                           </ul>
                        </div>
                        @endif 
                        <form action="{{ route('user.change.password.save') }}" id="change_password" method="post" enctype="multipart/form-data">
                           @csrf()
                        <div class="card pd_card an_card auto_card">
                            <h2>
                                Change Password
                            </h2> 
                            <div class="iverify baccount">
                               <div class="form">
                                  <div class="form-group">
                                     <label>Current Password</label>
                                     <input type="password"  name="current_password" placeholder="Enter Current Password" autocomplete="werewrwer">
                                  </div>
                                  <div class="form-group">
                                     <label>New Password</label>
                                     <input type="password"  name="new_password" placeholder="Enter New Password" autocomplete="werewrwer">
                                  </div>
                                  <div class="form-group">
                                     <label>Confirm Password</label>
                                     <input type="text"  name="new_confirm_password"  placeholder="Confirm New Password" autocomplete="werewrwer">
                                  </div>
                                   
                               </div>
                            </div>
                         </div>
                         {{-- <div class="col-lg-12 flush  space-xs col-sm-12 col-12"> --}}
                            <div class="row">
                               <div class="col-lg-12 col-sm-8 col-12">  <button type="submit" class="btn-success long_btn">Change Password</button>
                               </div>
                            </div>
                         {{-- </div> --}}
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
