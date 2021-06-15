@extends('layouts.front')
@section('title')
    Account Secuirity - Route: P2P Trading Platform
@endsection
@section('content')
    <section id="dashboard">
        <div class="container-fluid">
            <div class="row">
                <div class="container">
                    <div class="row justify-content-center">

                        @if (session()->has('message'))
                            <p class="alert alert-info">
                                {{ session()->get('message') }}
                            </p>
                        @endif
                        <form class="form-horizontal" method="POST" action="{{ route('verify.check') }}">
                            {{ csrf_field() }}

                            <div class="form-group">
                                <label for="one_time_password">One Time Password</label>

                                <div class="col-md-6">
                                    <input id="one_time_password" type="number" name="one_time_password" required autofocus>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary">
                                        Login
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
