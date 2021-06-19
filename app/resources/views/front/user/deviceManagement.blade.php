@extends('layouts.front')
@section('title')
Device Management - Route: P2P Trading Platform
@endsection
@section('content')
<section id="dashboard">
    <div class="container-fluid">
       <div class="row">
        @include('front.user._sidebar')
            <div class="col-lg-10 col-xs-12 flush">
                <div class="security">
                    <div class="col-lg-12 flush xs-space col-sm-12 col-12">
                        <p>Security <img src="{{ asset('front/img/cart-1.png') }}" alt=""/> Device Management</p>
                        <div class="col-lg-12 flush xs-center col-sm-12 col-12">
                            <h3>Device Management</h3>
                            <p class="gray">These devices are currently allowed to access your account</p>
                        </div>	
                    </div>	
                    <div class="table-responsive hidden-xs">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Device</th>
                                    <th>Date</th>
                                    <th>Location</th>
                                    <th>IP Address</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($authentications as $item) 
                                <tr>
                                    <td>{{ $item->user_agent }}</td>
                                    <td>{{ $item->login_at }}</td>
                                    <td>{{ $item->region_name }}, {{ $item->country_name }}</td>
                                    <td>{{ $item->ip_address }}</td>
                                    <td><a href="#">Delete</a></td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        
                    </div>
                    @if( Auth::user()->authentications->count() > $perpage)
                    <div class="pagination">
                        <ul> 
                            @php $total = ceil(Auth::user()->authentications->count() / $perpage) @endphp 
                            @for($i =1; $i<= $total; $i++)
                                <li @if($page == $i) class="active" @endif> <a href="{{ route('user.deviceManagement') }}?page={{$i}}"> {{ $i }} </a></li>    
                            @endfor
                            
                        </ul>
                    </div>
                    @endif
                    <div class="col-lg-12  xs-center visible-xs col-sm-12 col-12">
                        @foreach (auth()->user()->authentications as $item) 
                        <div class="head-table">
                            <p>{{ $item->user_agent }}</p>
                            <div class="bg-white-box">
                                <div class="row">
                                    <div class="col-lg-6 gray-c col-sm-6 col-5">
                                        <label>Date</label>
                                    </div>
                                    <div class="col-lg-6 text-right col-sm-6 col-7">
                                        <label>{{ $item->login_at }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 gray-c col-sm-6 col-5">
                                        <label>Location</label>
                                    </div>
                                    <div class="col-lg-6 text-right col-sm-6 col-7">
                                        <label>{{ $item->region_name }}, {{ $item->country_name }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 gray-c col-sm-6 col-5">
                                        <label>IP Address</label>
                                    </div>
                                    <div class="col-lg-6 text-right col-sm-6 col-7">
                                        <label>{{ $item->ip_address }}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6 gray-c col-sm-6 col-6">
                                        <label>Action</label>
                                    </div>
                                    <div class="col-lg-6 text-right col-sm-6 col-6">
                                        <label><a href="#">Delete</a></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection