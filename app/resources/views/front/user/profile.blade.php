@extends('layouts.front')
@section('title')
Basic Info - Route: P2P Trading Platform
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
                         <h2>Basic Info</h2>
                         <i class="fal fa-user-circle"></i>
                         <div class="user_data username">
                            <h5> <span>{{ Auth::user()->name }} </span> @if(Auth::user()->is_username_updated == false)
                              <a href="#" data-toggle="modal" data-target="#usernameUpdate"><i class="fal fa-edit"></i></a></h5> 
                              @endif
                         </div>
                         <h6>@php $minFill = 4; echo preg_replace_callback('/^(.)(.*?)([^@]?)(?=@[^@]+$)/u',function ($m) use ($minFill) {return $m[1] . str_repeat("*", max($minFill, mb_strlen($m[1], 'UTF-8'))) . ($m[3] ?: $m[0]); }, Auth::user()->email ); @endphp | {{ substr(Auth::user()->mobile, 0, -6) . "****".substr(Auth::user()->mobile, -2)}} <img src=" {{ asset('front/img/verified.svg') }}"></h6>
                         <p>Last login time: 2021-05-04 22:19:31 <span>IP: 103.103.162.223</span>
                         </p>
                      </div>
                   </div>
                   <div class="row row-eq-height">
                      <div class="col-lg-6 col-xs-12 flush-left  xs-flush">
                         <div class="card pd_card an_card">
                            <h2>Identity Verification <span><img src=" {{ asset('front/img/shild.svg') }}"> Verified</span></h2> 
                            <div class="iverify">
                               <h3>Personal Information</h3>
                               <p><i class="fal fa-check"></i> Basic Information</p>
                               <ul>
                                  <ul>
                                     <li>Name <span>Shavez Mirza</span></li>
                                     <li>ID Number <span>KMHP****H</span></li>
                                  </ul>
                               </ul>
                               <p><i class="fal fa-check"></i> ID & Face Verification</p>
                               <p><i class="fal fa-long-arrow-right"></i> Upload a photo of your ID</p>
                               <p><i class="fal fa-long-arrow-right"></i> Take a picture of yourself to verify your identity</p>
                            </div>
                         </div>
                      </div>
                      <div class="col-lg-6 col-xs-12 flush-right  xs-flush">
                         <div class="card pd_card an_card">
                            <h2>Advanced Verification <span><img src=" {{ asset('front/img/shild.svg') }}"> Verified</span></h2>
                            <div class="iverify">
                               <h3>Address verification</h3>
                               <p><i class="fal fa-check"></i> Why include your residential address?</p>
                               <p><i class="fal fa-long-arrow-right"></i> Further increase deposit limits for some fiat channels</p>
                            </div>
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>
 @if(Auth::user()->is_username_updated == false)
      @include('front.user._updateUsername')
 @endif
 @endsection
