@extends('layouts.front')
@section('title')
    2FA - Add Google Authenticator  - Route: P2P Trading Platform
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
                                <h3 class="panel-heading text-center">Set up Google Authenticator</h3>
                                <div class="panel-body pt-2" style="text-align: center;">
                                    <span>Set up your two factor authentication by scanning the barcode below. Alternatively, you can use the code {{ $qrcode }}</span>
                                    <div> <img src="{{ $QR_Image }}"> </div>
                                    <span>You must set up your Google Authenticator app before continuing. You will be unable to login otherwise</span>
                                    <div class="pt-2">
                                        <form action="{{ route('user.security.2fa.google.save')}}" method="post">
                                            @csrf()
                                            <input name="secret" type="hidden" value="{{ $qrcode }}">
                                            <button type="submit" class="btn btn-primary">Complete Registration</button>
                                        </form>
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
@endsection
