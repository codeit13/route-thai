@extends('layouts.front')
@section('title')
    Route: P2P Trading Platform | {{__($walletType->type)}} Wallet
@endsection



@section('content')

<div class="progress-section visible-xs">
	<h2>{{__($walletType->type)}} {{__('Wallet')}}</h2>
</div>
<section id="wallet-content">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 xs-content visible-xs col-sm-12 col-12">
				
				<div class="col-12">
					<div class="row">
						<div class="col-6">
							<h6>Fiat and Spot balance</h6>
							<h2>0.00000 <span>BTC</span></h2>
							<h5>≈ $0.00000</h5>
						</div>
						<div class="col-6">
							<h6>Fiat and Spot balance</h6>
							<h2>0.00000 <span>BTC</span></h2>
							<h5>≈ $0.00000</h5>
						</div>
					</div>
				</div>	
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 hidden-xs col-sm-12 col-12">
				<div class="white-box">
					<div class="row">
						<div class="col-lg-6 col-sm-6 col-6">
							<h3>{{__($walletType->type)}} {{__('Wallet')}} <a onclick="toggleBalance(this)" href="#"><i class="fa fa-eye-slash"  aria-hidden="true"></i> {{__('Hide Balance')}}</a></h3>
						</div>
						<div class="col-lg-6 text-right col-sm-6 col-6">
							<a data-toggle="modal" data-target="#exampleModalnew" class="btn-primary">{{__('Transfer')}}</a>
							<a href="#" class="btn-success">{{ __('Deposit')}}
							</a>
							<a class="mobile-tag" href="#"><img src="{{asset('front/img/icon-13.png')}}" alt=""/></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 hidden-xs col-sm-12 col-12" id="balanceDiv">
				<div class="white-box">

					<div class="row" id="balanceHide" style="display: none;">
						<div class="col-lg-4 col-sm-4 col-6">
							<h6>P2P balance</h6>
							<h2>******** <span>********</span></h2>
							<h5> ********</h5>
						</div>
						<div class="col-lg-4 col-sm-4 col-6">
							<h6>Fiat balance</h6>
							<h2>******** <span>********</span></h2>
							<h5> ********</h5>
						</div>
					</div>


					<div class="row" id="balanceShow">
						<div class="col-lg-4 col-sm-4 col-6">
							<h6>P2P balance</h6>
							<h2>0.00000 <span>BTC</span></h2>
							<h5>≈ $0.00000</h5>
						</div>
						<div class="col-lg-4 col-sm-4 col-6">
							<h6>Fiat balance</h6>
							<h2>0.00000<span>BTC</span></h2>
							<h5>≈ $0.00000</h5>
						</div>
					</div>


				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 hidden-xs col-sm-12 col-12">
				<div class="white-box">
					<div class="row">
						<div class="col-lg-5 col-sm-5 col-12">
							<input type="Search" placeholder="Search Coin"/>
						</div>
						<div class="col-lg-4 col-sm-4 col-6">
							<label><input type="checkbox"/> Hide Small Balances</label>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 col-sm-12 col-12 xs-flush">
				<div class="white-box">
					<div class="row three_buttons visible-xs">
						<div class="col-xs-12">
							<a href="#" class="btn-success"><i class="fas fa-coins"></i> Buy</a>
							<a href="#" class="btn-primary"><i class="fal fa-chart-line"></i> Sell</a>
							<a href="#" class="btn-primary"><i class="fal fa-chart-line"></i> Transfer</a>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 xs-flush col-sm-12 col-12">
							<table class="loan_main_table">
								<thead>
									<tr>
											@php 

										$query_coin='asc';

										if(isset($request->coin) && $request->coin=='asc')
										{
											$query_coin='desc';
										}

										$query_amount='asc';

										if(isset($request->amount) && $request->amount=='asc')
										{
											$query_amount='desc';
										}


										@endphp

										<th>Coin <a href="{{route('wallet.p2p').'?coin='.$query_coin}}"><i class="fa fa-sort" aria-hidden="true"></i></a></th>
										<th>Available  <a href="{{route('wallet.p2p').'?amount='.$query_amount}}"><i class="fa fa-sort" aria-hidden="true"></i></a></th>
										<th>Intrade</th>
										<th>Total</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>

									@foreach($currencies as $currency)
									<tr>
										<td>
											 @if($currency->hasMedia('icon'))
											<img style="max-width: 28px;" src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{$currency->name}}"/>

											@endif
											<label>{{__($currency->short_name)}}<br><span>{{__($currency->name)}}</span></label>
										</td>
										<td>{{$currency->user_p2p_balance}}</td>
										<td>{{$currency->user_p2p_total-$currency->user_p2p_balance}}</td>
										<td>{{$currency->user_p2p_total}}</td>
										<td class="center_small">
											<a href="{{route('p2p.exchange')}}" class="btn-success"><i class="fas fa-coins"></i> Buy</a>
											<a href="{{route('sell.create')}}" class="btn-primary"><i class="fal fa-chart-line"></i> Sell</a>
											<a href="{{route('p2p.exchange')}}" class="btn-primary"><i class="fal fa-chart-line"></i> Transfer</a>
										</td>
									</tr>
									@endforeach
									
								</tbody>
							</table>	
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 text-center nav-pagi hidden-xs col-sm-12 col-12">

							{{ $currencies->links('front._inc._paginator') }}
						
						</div>
					</div>
				</div>
				<div class="col-lg-12 text-center visible-xs col-sm-12 col-12 no_more">
					<a href="#" class="load-more">Load More</a>
				</div>
			</div>
		</div>
	</div>
</section>

<!-- Modal -->
<div class="modal alert_poup fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
	<div class="modal-content">
	   <div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
		  <span aria-hidden="true">&times;</span>
		  </button>
	   </div>
	   <div class="modal-body">
		  <img src="{{ asset('img/Image 17.png') }}" class="header_img" alt="">
		  <img src="{{ asset('img/coin_base.svg')}}" class="header_img"  alt="">
		  <img src="{{ asset('img/bitCoinBig.svg')}}" class="header_img"  alt="">
		  <h2>10.99%</h2>
		  <a href="#" class="btn-primary btn" class="close" data-dismiss="modal" aria-label="Close">Close this alert</a>
	   </div>
	</div>
 </div>
</div>

@include('front.components.transfer-modal')



@endsection

@section('page_scripts')
<script> 

		var wallets=@json($wallets);

var currencies=@json($currencies);

    $(document).ready(function(){
        $('.bxslider').bxSlider({
            auto:false,
            controls:true,
            pager:false,
            slideWidth: 280,
            minSlides: 1,
            maxSlides: 4,
            moveSlides: 1,
            slideMargin: 0,
            speed: 300,
            touchEnabled: true
        });


    });

    function toggleBalance(selector) {


  var x = document.getElementById("balanceHide");
  var y=document.getElementById('balanceShow');
  if (x.style.display == "none") {
    x.style.display = "flex";
    y.style.display="none";
    selector.innerHTML='<i class="fa fa-eye-slash"  aria-hidden="true"></i> {{__("Hide Balance")}}</a>';
  } else {
    x.style.display = "none";
      y.style.display="flex";
    selector.innerHTML='<i class="fa fa-eye"  aria-hidden="true"></i> {{__("Show Balance")}}</a>';
  }
}
</script>

@include('front._inc.transfer-js')


@endsection     