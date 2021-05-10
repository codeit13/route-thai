@extends('layouts.front')
@section('title')
    Route: P2P Trading Platform
@endsection
@section('content')
<section id="wallet-content" class="request crypto order-history">
		<div class="container">
			<div class="row">
				<div class="col-lg-12  col-sm-12 col-12">
					<div class="white-box" style="background:none; box-shadow:none;">
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-12">
								<h3>{{__('Withdraw History')}}</h3>
							</div>
						</div>

						<div class="row">
							<div class="white-box" style="background:none; box-shadow:none;">
                              <ul class="janral-head">
						@foreach($currency_types as $index => $currency_type)


						@if(isset($walletType->id) && $walletType->id==$currency_type->id)

						<li class="active"><a href="#">{{__($currency_type->type)}}</a></li>
						@elseif(!isset($walletType->id) && $index==0)
						<li class="active"><a href="#">{{__($currency_type->type)}}</a></li>
						@else
						<li class=""><a href="{{route('wallet.withdraw.history',['type'=>$currency_type->id,'typename'=>strtolower($currency_type->type)])}}">{{__($currency_type->type)}}</a></li>
						@endif


						

						@endforeach
					
						<li class="last"><a href="#"><img src="{{asset('front/img/icon-13.png')}}" alt=""/></a></li>
					</ul>

						</div>
					</div>
						<div class="head-xs visible-xs">
							<div class="row">
								<div class="col-7">
									<div class="row">
										<div class="col-12">
											<label>{{__('Date')}}</label>
										</div>
									</div>
									<div class="row">
										<div class="col-6 sp-right">
											<input id="datepicker" type="text" placeholder="22/04/2021"/>
										</div>
										<div class="col-6 sp-left">
											<input id="datepickertwo" type="text" placeholder="22/04/2021"/>
										</div>
									</div>
								</div>
								<div class="col-5 sp-left">
									<div class="row">
										<div class="col-12">
											<label>{{__('Types of Currency')}}</label>
										</div>
									</div>
									<div class="dropdown currency_two three_coins crypto">
									  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									    <img src="{{asset('front/img/bitcoin.png')}}" alt=""> BTC <span>Bitcoin</span>
									  </button>
									  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          								<a class="dropdown-item" href="#"><img src="{{asset('front/img/bitcoin.png')}}" alt=""> BTC <span>Bitcoin</a>
									    <a class="dropdown-item" href="#"><img src="{{asset('front/img/icon-5.png')}}" alt=""> ETH <span>Ethereum</a>
									    <a class="dropdown-item" href="#"><img src="{{asset('front/img/icon-6.png')}}" alt=""> BNB <span>BNB</span></a>
									  </div>
									</div>
								</div>
							</div>
							<div class="col-12 flush">
								<label>Status</label>
							</div>
							<div class="row">
								<div class="col-4">
									<select>
										<option>All</option>
										<option>All</option>
									</select>
								</div>
								<div class="col-8">
									<input class="coin" type="search" placeholder="Search Coin Name" />
								</div>
							</div>	
						</div>	
						<div class="row hidden-xs">
							<div class="col-lg-12 col-sm-12 col-12">
								<table class="order-history-table">
									<thead>
										<tr>
											<th colspan="2">Date</th>
											<th>Types of Currency</th>
											<th style="width:110px;">Order Type</th>
											<th>Status</th>
											<th></th>
										</tr>
									</thead>
									<tbody>


										<tr>
											<td><input class="date" id="datepickerthree" type="text" placeholder="22/04/2021"/></td>
											<td><input class="date" id="datepickerfour" type="text" placeholder="22/04/2021"/></td>
											<td style="width:180px; display:inline-block;">
												<div class="dropdown currency_two three_coins crypto">
												  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
												    <img src="{{asset('front/img/bitcoin.png')}}" alt=""> BTC <span>Bitcoin</span>
												  </button>
												  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		              								<a class="dropdown-item" href="#"><img src="{{asset('front/img/bitcoin.png')}}" alt=""> BTC <span>Bitcoin</a>
												    <a class="dropdown-item" href="#"><img src="{{asset('front/img/icon-5.png')}}" alt=""> ETH <span>Ethereum</a>
												    <a class="dropdown-item" href="#"><img src="{{asset('front/img/icon-6.png')}}" alt=""> BNB <span>BNB</span></a>
												  </div>
												</div>
											</td>
											<td>
												<select>
													<option>Buy</option>
													<option>Buy</option>
												</select>
											</td>
											<td>
												<select>
													<option>All</option>
													<option>All</option>
												</select>
											</td>
											<td><input class="coin" type="search" placeholder="Search Coin Name" /></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-12 history-details with-history hidden-xs view-c  col-sm-12 col-12">
								<table>
									<thead>
										<tr>
											<th>{{__('Currecny')}}</th>
											<th>Date</th>
											<th class="text-center">{{__('Quantity')}}</th>
											<th class="text-center">{{__('Details')}}</th>
											<th>{{__('Status')}}</th>
										</tr>
									</thead>
									<tbody>

										@foreach($transactions as $tindex => $transaction)
										<tr class="top-radius">
											<td class="top-left-radius">
												@if($transaction->currency->hasMedia('icon'))
    
                                      

											<img src="{{$transaction->currency->firstMedia('icon')->getUrl()}}" alt="{{__($transaction->currency->name)}}"/> 

											@endif

											<label>{{__($transaction->currency->short_name)}} <br><span>{{__($transaction->currency->name)}}</span>
												</label>
											</td>
											<td>{{$transaction->created_at->format('d/m/Y')}}<span>&nbsp;&nbsp;{{$transaction->created_at->format('h:i:s')}}</span></td>
											<td class="text-center">{{$transaction->trans_amount}}</td>
											<td class="text-center">{{$transaction->address}}</td>

											@switch($transaction->status)

											@case('pending')

											<td class="top-right-radius"><img src="{{asset('front/img/icon-27.png')}}" alt="">{{__('In progress')}}</td>

											@break

											@case('approved')

											<td class="top-right-radius"><img src="{{asset('front/img/icon-28.png')}}" alt="">{{__('Approved')}}</td>

											@break

											@case('rejected')

											<td class="top-right-radius"><img src="{{asset('front/img/icon-29.png')}}" alt="">{{__('Rejected')}}</td>

											@break

											@endswitch
											
										</tr>

										@endforeach
										
									</tbody>
								</table>
							</div>
							
							<div class="col-lg-12 xs-flush only-xs visible-xs  col-sm-12 col-12">
								<table>
									<tbody>
										<tr class="first text-left">
											<td>2021-03-29 11:56:29</td>
										</tr>
										<tr>
											<td>
												<label>
													<img src="{{asset('front/img/bitcoin.png')}}" alt=""/>
													BTC <span>Bitcoin</span>
												</label>
											</td>
											<td>
												<span>Quantity</span>1.0000
											</td>
											<td class="w-details"><a href="#" class="btn-success">View File</a></td>
											<td class="code"><img src="{{asset('front/img/icon-27.png')}}" alt=""/> In Progress</td>
										</tr>
										<tr class="first text-left">
											<td>2021-03-29 11:56:29</td>
										</tr>
										<tr>
											<td>
												<label>
													<img src="{{asset('front/img/icon-5.png')}}" alt=""/>
													ETH <span>Ethereum</span>
												</label>
											</td>
											<td>
												<span>Quantity</span>1.0000
											</td>
											<td class="w-details"><a href="#" class="btn-success">View File</a></td>
											<td class="code"><img src="{{asset('front/img/icon-27.png')}}" alt=""/> In Progress</td>
										</tr>
										<tr>
											<td>
												<label>
													<img src="{{asset('front/img/icon-5.png')}}" alt=""/>
													ETH <span>Ethereum</span>
												</label>
											</td>
											<td>
												<span>Quantity</span>1.0000
											</td>
											<td class="w-details"><a href="#" class="btn-success">View File</a></td>
											<td class="code"><img src="{{asset('front/img/icon-27.png')}}" alt=""/> In Progress</td>
										</tr>
									</tbody>
								</table>	
							</div>
						</div>
						<div class="row">
						<div class="col-lg-12 text-center nav-pagi hidden-xs col-sm-12 col-12">

							{{ $transactions->links('front._inc._paginator') }}
						
						</div>
					</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	@endsection

@section('page_scripts')
<script src="js/main.js"></script> <!-- Gem jQuery -->
	<script src="js/bootstrap-datepicker.js"></script>
		<script>
		$('#datepicker').datepicker('toggle');
		$('#datepickertwo').datepicker('toggle');
		$('#datepickerthree').datepicker('toggle');
		$('#datepickerfour').datepicker('toggle');
	</script>
	<script type="text/javascript">
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
			$("#footer ul li.Company:first-child").click(function(){
				$("ul.Company-main li").toggle();
			});
			$("#footer ul li.Individuals:first-child").click(function(){
				$("ul.Individuals-main li").toggle();
			});
			$("#footer ul li.Learn:first-child").click(function(){
				$("ul.Learn-main li").toggle();
			});
			$("#footer ul li.Support:first-child").click(function(){
				$("ul.Support-main li").toggle();
			});
		 });
	</script>
	<script type="text/javascript">
		$('.btn-toggle').click(function() {
		    $(this).find('.btn').toggleClass('active');  
		    
		    if ($(this).find('.btn-primary').length>0) {
		    	$(this).find('.btn').toggleClass('btn-primary');
		    }
		    if ($(this).find('.btn-danger').length>0) {
		    	$(this).find('.btn').toggleClass('btn-danger');
		    }
		    if ($(this).find('.btn-success').length>0) {
		    	$(this).find('.btn').toggleClass('btn-success');
		    }
		    if ($(this).find('.btn-info').length>0) {
		    	$(this).find('.btn').toggleClass('btn-info');
		    }
		    
		    $(this).find('.btn').toggleClass('btn-default');
		       
		});
		
		$('form').submit(function(){
		  var radioValue = $("input[name='options']:checked").val();
		  if(radioValue){
		     alert("You selected - " + radioValue);
		   };
		    return false;
		});
	</script>
	<script>
		$("ul.btc").on("click", ".init", function() {
		    $(this).closest("ul.btc").children('li:not(.init)').toggle();
		});
		
		var allOptions = $("ul.btc").children('li:not(.init)');
		$("ul.btc").on("click", "li:not(.init)", function() {
		    allOptions.removeClass('selected');
		    $(this).addClass('selected');
		    $("ul.btc").children('.init').html($(this).html());
		    allOptions.toggle();
		});
	</script>
	@endsection