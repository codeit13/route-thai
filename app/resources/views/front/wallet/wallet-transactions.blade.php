@extends('layouts.front')
@section('title')
    Route: P2P Trading Platform | {{__($walletType->type)}} Wallet
@endsection
@section('content')


<section id="wallet-content">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 xs-content visible-xs col-sm-12 col-12">
				<ul>
					<li class="active"><a href="#">P2P Wallet</a></li>
					<li><a href="#">Fiat Wallet</a></li>
					<li><a href="#"><img src="img/icon-13.png" alt=""/></a></li>
				</ul>
				<div class="col-12">
					<div class="row">
						<div class="col-6">
							<h6>Fiat and Spot balance</h6>
							<h2>0.00000000 <span>BTC</span></h2>
							<h5>≈ $0.000000</h5>
						</div>
						<div class="col-6">
							<h6>Fiat and Spot balance</h6>
							<h2>0.00000000 <span>BTC</span></h2>
							<h5>≈ $0.000000</h5>
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
							<a href="#" class="btn-primary">Buy</a>
							<a href="{{route('wallet.deposit',['type'=>$walletType->id,'typename'=>strtolower($walletType->type)])}}" class="btn-success">{{ __('Deposit')}}
							</a>
							<a class="mobile-tag" href="#"><img src="img/icon-13.png" alt=""/></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 hidden-xs col-sm-12 col-12" id="balanceDiv">
				<div class="white-box">
					<div class="row">
						<div class="col-lg-4 col-sm-4 col-6">
							<h6>P2P balance</h6>
							<h2>0.00000000 <span>BTC</span></h2>
							<h5>≈ $0.000000</h5>
						</div>
						<div class="col-lg-4 col-sm-4 col-6">
							<h6>Fiat balance</h6>
							<h2>0.00000000 <span>BTC</span></h2>
							<h5>≈ $0.000000</h5>
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
			<div class="col-lg-12 col-sm-12 col-12">
				<div class="white-box">
					<div class="row">
						<div class="col-lg-12 xs-flush col-sm-12 col-12">
							<table>
								<thead>
									<tr>
										<th>Coin <i class="fa fa-sort" aria-hidden="true"></i></th>
										<th>Total <i class="fa fa-sort" aria-hidden="true"></i></th>
										<th>Available <i class="fa fa-sort" aria-hidden="true"></i></th>
										<th>Action <i class="fa fa-sort" aria-hidden="true"></i></th>
									</tr>
								</thead>
								<tbody>

									@foreach($currencies as $currency)
									<tr>
										<td>
											<img src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{$currency->name}}"/>
											<label>{{__($currency->short_name)}}<br><span>{{__($currency->name)}}</span></label>
										</td>
										<td>{{$currency->user_total}}</td>

										<td>{{$currency->user_balance}}</td>
										<td>
											<a href="{{route('wallet.deposit',['type'=>$walletType->id,'typename'=>strtolower($walletType->type),'currency'=>$currency->id,'currencyname'=>strtolower($currency->name)])}}" class="btn-success">Deposit</a>
											<a href="{{route('wallet.withdraw',['type'=>$walletType->id,'typename'=>strtolower($walletType->type),'currency'=>$currency->id,'currencyname'=>strtolower($currency->name)])}}" class="btn-primary">P2P Trading</a>
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
				<div class="col-lg-12 text-center visible-xs col-sm-12 col-12">
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




@endsection

@section('page_scripts')
<script> 
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
  var x = document.getElementById("balanceDiv");
  if (x.style.display === "none") {
    x.style.display = "block";
    selector.innerHTML='<i class="fa fa-eye-slash"  aria-hidden="true"></i> {{__("Hide Balance")}}</a>';
  } else {
    x.style.display = "none";
    selector.innerHTML='<i class="fa fa-eye"  aria-hidden="true"></i> {{__("Show Balance")}}</a>';
  }
}
</script>
@endsection     