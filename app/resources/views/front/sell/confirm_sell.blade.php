@extends('layouts.front')
@section('title')
Route: P2P Trading Platform - sell crypto
@endsection
@section('header-bar')
@include('front.sell.sub_header')
@endsection
@section('content')
	<section id="main-heading" class="panding-payment hidden-xs csss">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-sm-12 col-xs-12 text-left">
					<h1>Confirm Sell</h1>
				</div>
			</div>
		</div>
	</section>
	<section id="content" class="banktransfer padning-payment confirm-receipt sellers sellers-xs-white">
		<div class="container">
			<div class="row">
				<div class="col-lg-12 flush visible-xs btc-bg col-sm-12 col-xs-12">
					<h5>I will sell  <span>{{ $sell_data['quantity'] }} {{ $selected_currency->name }}</span></h5>
				</div>
				{{ Form::open(['id'=>'confirm_sell']) }}
					<div class="col-lg-6 offset-lg-3 offest-sm-3 col-sm-6 col-12">
						<div class="white-box">
							<div class="row mini_hr">
								<div class="col-lg-4 col-sm-4 col-12">
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-6">
											<div id="Price"><span>Types of Currency</span>
											</div>
										</div>
										<div class="col-lg-12 xs-right col-sm-12 col-6">
											<div id="ID5268172_USD__10_s"><img src="{{ $selected_currency->getMedia('icon')->first()->getUrl() }}" alt=""/ class="coin_image"><span class="hidden-xs">{{ $selected_currency->name }}</span><span class="visible-xs red-c">{{ $selected_currency->short_name }}</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-3 offset-lg-1 text-center col-sm-4 col-12">
									<div class="row">
										<div class="col-lg-12 col-sm-12 col-6">
											<div id="Available"><span>Quantity</span>
											</div>
										</div>
										<div class="col-lg-12 xs-right col-sm-12 col-6">
											<div id="ID5522365196_BTC">	<span style="font-weight:normal;">{{ $sell_data['quantity']}}</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-4 col-sm-4 col-12">
									<div class="row">
										<div class="col-lg-12 text-right col-sm-12 xs-left col-6">
											<div id="Available" class="text-right"><span>Price</span>
											</div>
										</div>
										<div class="col-lg-12 xs-right col-sm-12 col-6">
											<div id="ID5522365196_BTC" class="text-right">	<span style="font-weight:normal;">{{ $sell_data['trans_amount'] }} {{ $selected_fiat_currency->short_name }}</span>
											</div>
										</div>
									</div>
								</div>
								<div class="col-lg-12 hidden-xs col-sm-12 col-xs-12">
									<h5>I will sell  <span>{{ $sell_data['quantity'] }} {{ $selected_currency->short_name }}</span></h5>
								</div>
								<div class="col-lg-12 col-sm-12 col-xs-12">
									<div class="seller-payment">
										<div class="col-lg-12 col-sm-12 col-12">
											<div class="row">
												<div class="col-lg-12 MethodPayment flush col-sm-12 col-12">
													<h6>Seller’s payment method </h6>
												</div>
											</div>
										</div>
										@foreach($user_payment_methods as $single_user_payment_method)
											<div class="payment-line">
												<div class="col-lg-12 flush col-sm-12 col-12">
													<h3> <a href="javascript:void(0)"><img src="{{ $single_user_payment_method->payment_methods->getMedia('icon')->first()->getUrl() }}" alt=""/></a>{{ $single_user_payment_method->payment_methods->name }}</h3>
												</div>
												<div class="field">
													<div class="row">
														<div class="col-lg-6 col-sm-6 col-6">
															<label class="gray-c">Full Name</label>
														</div>
														<div class="col-lg-6 b-c text-right col-sm-6 col-6">
															<label>{{ $single_user_payment_method->user->name }}</label>
														</div>
													</div>
													@if($single_user_payment_method->account_label != '')
														<div class="row">
															<div class="col-lg-6 col-sm-6 col-6">
																<label class="gray-c">{{ $single_user_payment_method->account_label }}</label>
															</div>
															<div class="col-lg-6 b-c text-right col-sm-6 col-6">
																<label>{{ $single_user_payment_method->account_number }}</label>
															</div>
														</div>
													@endif
													@if($single_user_payment_method->code_label != '')
														<div class="row">
															<div class="col-lg-6 col-sm-6 col-6">
																<label class="gray-c">{{ $single_user_payment_method->code_label }}</label>
															</div>
															<div class="col-lg-6 b-c text-right col-sm-6 col-6">
																<label>{{ $single_user_payment_method->code }}</label>
															</div>
														</div>
													@endif
												</div>
											</div>
										@endforeach
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-lg-9 col-sm-9 col-8">	
								<a href="javascript:void(0)" onclick="confirmSell()" class="btn-success sell">Sell</a>
							</div>
							<div class="col-lg-3 col-sm-3 col-4">	
								<a href="#" class="btn-success cancel">Cancel</a>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</section>
	<div class="modal fade" id="exampleModal4" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="col-lg-12 text-center col-sm-12 col-xs-12">
						<h4><img src="{{ asset('front/img/check.png') }}" alt=""/> Your ad has been successfully posted.</h4>
						<h6>We will message you when your order is matched.</h6>
					</div>
					<div class="col-lg-12 text-center col-sm-12 col-xs-12">
						<h3>Sell Order</h3>
					</div>
					<div class="row tb-n">
						<div class="col-lg-6 text-right col-sm-6 col-6">
							<label>Types of Currency</label>
						</div>
						<div class="col-lg-6 text-left col-sm-6 col-6">
							<h5 id="currency_type"><img src="#" alt=""/></h5>
						</div>
					</div>
					<div class="row tb-n">
						<div class="col-lg-6 text-right col-sm-6 col-6">
							<label>Quantity</label>
						</div>
						<div class="col-lg-6 text-left col-sm-6 col-6">
							<h5 class="red-f" id="quantity_main"></h5>
						</div>
					</div>
					<div class="row tb-n">
						<div class="col-lg-6 text-right col-sm-6 col-6">
							<label>Price</label>
						</div>
						<div class="col-lg-6 text-left col-sm-6 col-6">
							<h5 id="price_main"></h5>
						</div>
					</div>
					<div class="row tb-n">
						<div class="col-lg-6 text-right col-sm-6 col-6">
							<label>Created time</label>
						</div>
						<div class="col-lg-6 text-left col-sm-6 col-6">
							<label id="created_at"></label>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	@include('front.sell.tips')
@stop
@section('page_scripts')
	<script src="{{asset('front/js/jquery_form.min.js') }}"></script>
	<script>
		function confirmSell(){
			var form_id = 'confirm_sell';
			$('body').find('button').prop('disabled', true);
			startLoader();
			$('#'+form_id).ajaxSubmit({
				url: '{{ route("sell.confirm_sell") }}',
				type : 'POST',
				dataType: 'json',
				beforeSubmit : function(){
					$("[id$='_error']").empty();
				},
				success:function(result){
					if (result.success == true) {
						var response_data = result.data;
						$('#'+form_id)[0].reset();

						$('#currency_type').text(response_data.currency_name);
						$('#currency_type').find('image').attr('src',response_data.currency_image);
						$('#quantity_main').text(response_data.quantity_main);
						$('#price_main').text(response_data.price_main);
						$('#created_at').text(response_data.created_at);
						$('#exampleModal4').modal('show');

						setTimeout(function(){ 
							window.location = '{{ route("p2p.exchange") }}';
						}, 2000);
					}
					$('body').find('button').prop('disabled', false);
					stopLoader();
				},
				error:function(resobj){
					$.each(resobj.responseJSON.errors, function(k,v){
						var id_arr = k.split('.');
						$('#'+id_arr[0]+'_error').text(v);
					});
					$('body').find('button').prop('disabled', false);
					stopLoader();
				}
			});
		}
	</script>
@stop