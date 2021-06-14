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
                                    <div class="panel-heading">Set up Google Authenticator</div>
                                    <div class="panel-body" style="text-align: center;">
                                        <p>Set up your two factor authentication by scanning the barcode below.
                                            Alternatively, you can use the code {{ $qrcode }}</p>
                                        <div>
                                            <img src="{{ $QR_Image }}">
                                        </div>
                                        <p>You must set up your Google Authenticator app before continuing. You will be
                                            unable to login otherwise</p>
                                        <div>
                                            <form action="{{ route('user.secuirity.2fa.google.save')}}" method="post">
                                            @csrf()
                                            <input name="secret" type="hidden" value="{{ $qrcode }}">
                                                <button type="submit" class="btn-primary">Complete Registration</button>
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
