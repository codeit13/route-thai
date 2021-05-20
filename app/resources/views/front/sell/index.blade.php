@extends('layouts.front')
@section('title')
Route: P2P Trading Platform - sell crypto
@endsection
@section('header-bar')
<div class="container">
	<div class="row">
		<div class="col-lg-12 col-sm-12 col-xs-12 flush">
			<ul class="mini_links">
				<li class="active"><a href="#">P2P</a>
				</li>
				<li><a href="#">Express</a>
				</li>
			</ul>
		</div>
	</div>
</div>
@endsection
@section('content')
<section id="main-heading" class="panding-payment hidden-xs csss">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-sm-12 col-xs-12 text-left">
                <h1>Sell Crypto</h1>
            </div>
        </div>
    </div>
</section>
<section id="content" class="banktransfer padning-payment sellers">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 offest-sm-3 col-sm-6 col-12">
                <div class="white-box">
                	{{ Form::open(['id'=>'save_sell']) }}
	                    <div class="field">
	                        <label>Choose Crypto to Sell</label>
	                        <div class="dropdown currency_two three_coins crypto">
	                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                            	<img src="{{ $crypto_currencies->first()->getMedia('icon')->first()->getUrl() }}" alt="" id="img_main_1"> 
	                            		<span id="text_1" style="color: black">{{ $crypto_currencies->first()->short_name }} <span>{{ $crypto_currencies->first()->name }}</span></span>
	                            </button>
	                            <input type="hidden" name="currency_id" id="currency_id" value="{{ $crypto_currencies->first()->id }}">
	                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
	                            	@foreach($crypto_currencies as $single_currency_id)
		                                <a class="dropdown-item" href="javascript:void(0)" 
						                	data-img="{{ $single_currency_id->getMedia('icon')->first()->getUrl() }}"
						                	data-name="{{ $single_currency_id->name }}"
						                	data-short_name="{{ $single_currency_id->short_name }}"
						                	data-currency="{{ $single_currency_id->id }}"
						                	onclick="selectCurrency(this,'currency_id','img_main_1','text_1')">
						                    <img src="{{ $single_currency_id->getMedia('icon')->first()->getUrl() }}" alt="">
						                    {{ $single_currency_id->short_name }} 
						                    <span>{{ $single_currency_id->name }}</span>
						                </a>
	                            	@endforeach
	                            </div>
	                        </div>
	                        <span class="text-danger" id="currency_id_error"></span>
	                    </div>
	                    <div class="field">
						    <label>Choose Currency to Sell</label>
						    <div class="dropdown currency_two three_coins crypto">
						        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						            <img src="{{ $fiat_currencies->first()->getMedia('icon')->first()->getUrl() }}" alt="" id="img_main_2"> 
						            <span style="color: black" id="text_2">{{ $fiat_currencies->first()->short_name }} <span>{{ $fiat_currencies->first()->name }}</span></span>
						        </button>
						        <input type="hidden" name="fiat_currency_id" id="fiat_currency_id" value="{{ $fiat_currencies->first()->id }}">
						        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						            @foreach($fiat_currencies as $single_fiat_currency_id)
						                <a class="dropdown-item" href="javascript:void(0)" 
						                	data-img="{{ $single_fiat_currency_id->getMedia('icon')->first()->getUrl() }}"
						                	data-name="{{ $single_fiat_currency_id->name }}"
						                	data-short_name="{{ $single_fiat_currency_id->short_name }}"
						                	data-currency="{{ $single_fiat_currency_id->id }}"
						                	onclick="selectCurrency(this,'fiat_currency_id','img_main_2','text_2')">
						                    <img src="{{ $single_fiat_currency_id->getMedia('icon')->first()->getUrl() }}" alt="">
						                    {{ $single_fiat_currency_id->short_name }} 
						                    <span>{{ $single_fiat_currency_id->name }}</span>
						                </a>
						            @endforeach
						        </div>
						    </div>
						    <span class="text-danger" id="fiat_currency_id_error"></span>
						</div>
	                    <div class="field">
	                        <label>Total Quantity</label>
	                        <input type="number" name="quantity" placeholder="Enter Quantity"/>
	                        <span class="text-danger" id="quantity_error"></span>
	                    </div>
	                    <div class="field">
	                        <label>Total Price</label>
	                        <input type="text" name="trans_amount" placeholder="Enter Price"/>
	                        <span class="size">Refrence Price is 75.25</span><br>
	                        <span class="text-danger" id="trans_amount_error"></span>
	                    </div>
	                {{ Form::close() }}
                </div>
                <h6>Sell with 0 fee</h6>
                <div class="row">
                    <div class="col-lg-9 col-sm-9 col-8">	
                    	<a href="javascript:void(0)" onclick="saveSell()" class="btn-success sell">Sell</a>
                    </div>
                    <div class="col-lg-3 col-sm-3 col-4">	
                    	<a href="#" class="btn-success cancel">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row hidden-xs">
            <div class="col unknow">
                <h2>Tips</h2>
                <p><span class="sst">1. </span>Please do not include any information about BTC, ETH, USDT, BNB and other digital asset names in the transfer notes to prevent payment from being intercepted or bank funds being frozen.</p>
                <p><span class="sst">2. </span>Your payment will go directly to the seller's account. The digital assets sold by the seller during the transaction will be handled by the platform.</p>
                <p><span class="sst">3. </span>Please complete the payment within the specified time, and be sure to click “Transferred, Next”. After the seller confirms the payment, the system will transfer the digital assets to your account.</p>
                <p><span class="sst">4. </span>If the buyer cancels orders 3 times a day, he/she will no longer be able to to trade for the rest of the day.</p>
                <p><span class="sst">5. </span>After 5 pm on weekdays or during non-working days, please limit each transaction within 50,000 CNY, otherwise it will be delayed.</p>
            </div>
        </div>
    </div>
</section>
@endsection
@section('page_scripts')
	<script src="{{asset('front/js/jquery_form.min.js') }}"></script>
	<script>
		function selectCurrency(current_obj,input_id,image_id,text_id){
			var current_obj = $(current_obj);
			var current_image = current_obj.attr('data-img');
			var current_name = current_obj.attr('data-name');
			var current_short_name = current_obj.attr('data-short_name');
			var current_currency = current_obj.attr('data-currency');

			$('#'+input_id).val(current_currency);
			$('#'+image_id).attr('src',current_image);
			$('#'+text_id).html(current_short_name+'<span> '+current_name+'</span>');

			console.log(current_image,current_name,current_short_name,current_currency)
		}

		function saveSell(){
			var form_id = 'save_sell';
			$('body').find('button').prop('disabled', true);

			$('#'+form_id).ajaxSubmit({
				url: '{{ route("sell.save_sell") }}',
				type : 'POST',
				dataType: 'json',
				beforeSubmit : function(){
					$("[id$='_error']").empty();
				},
				success:function(result){
					if (result.success == true) {
						window.location = result.redirect_url;
						$('#'+form_id)[0].reset();
					}
					$('body').find('button').prop('disabled', false);
				},
				error:function(resobj){
					console.log(resobj.responseJSON.message)

					$.each(resobj.responseJSON.errors, function(k,v){
						var id_arr = k.split('.');
						$('#'+id_arr[0]+'_error').text(v);
					});
					$('body').find('button').prop('disabled', false);
				}
			});
		}
	</script>
@stop