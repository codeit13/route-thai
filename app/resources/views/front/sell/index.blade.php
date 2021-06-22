@extends('layouts.front')
@section('title')
Route: P2P Trading Platform - sell crypto
@endsection
@section('header-bar')
	@include('front.sell.sub_header')
@endsection
@section('content')
<section id="content" class="banktransfer padning-payment sellers">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 offest-sm-3 col-sm-6 col-12">
            	<br>
                <div class="white-box">
                	@if(isset($transcation))
                		{{ Form::model($transcation,['id'=>'save_sell']) }}
                	@else
                		{{ Form::open(['id'=>'save_sell']) }}
                	@endif
                		{{ Form::hidden('trans_id',$trans_id,[]) }}
	                    <div class="field">
	                        <label>Choose Crypto to Sell</label>
	                        <div class="dropdown currency_two three_coins crypto">
	                        	@if(isset($transcation))
	                        		<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                            	<img src="{{ $transcation->currency->first()->getMedia('icon')->first()->getUrl() }}" alt="" id="img_main_1"> 
		                            	<span id="text_1" style="color: black">{{ $transcation->currency->first()->short_name }} <span>{{ $transcation->currency->first()->name }}</span></span>
		                            </button>
	                        	@else
		                            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                            	<img src="{{ $crypto_currencies->first()->getMedia('icon')->first()->getUrl() }}" alt="" id="img_main_1"> 
		                            	<span id="text_1" style="color: black">{{ $crypto_currencies->first()->short_name }} <span>{{ $crypto_currencies->first()->name }}</span></span>
		                            </button>
	                        	@endif
	                            {{ Form::hidden('currency_id',(isset($transcation->currency_id))?$transcation->currency_id:$crypto_currencies->first()->id,['id'=>'currency_id']) }}
	                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
	                            	@foreach($crypto_currencies as $single_currency_id)
		                                <a class="dropdown-item some_padding" href="javascript:void(0)" 
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
						    <label>Choose Fiat Currency</label>
						    <div class="dropdown currency_two three_coins crypto">
						    	@if(isset($transcation))
							        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							            <img src="{{ $transcation->fiat_currency->getMedia('icon')->first()->getUrl() }}" alt="" id="img_main_2"> 
							            <span style="color: black" id="text_2">{{ $transcation->fiat_currency->short_name }} <span>{{ $transcation->fiat_currency->name }}</span></span>
							        </button>
						    	@else
						    		<button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							            <img src="{{ $default_fiat_currency->getMedia('icon')->first()->getUrl() }}" alt="" id="img_main_2"> 
							            <span style="color: black" id="text_2">{{ $default_fiat_currency->short_name }} <span>{{ $default_fiat_currency->name }}</span></span>
							        </button>
						    	@endif
						        {{ Form::hidden('fiat_currency_id',(isset($transcation->fiat_currency_id))?$transcation->fiat_currency_id:$default_fiat_currency->id,['id'=>'fiat_currency_id']) }}
						        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
						            @foreach($fiat_currencies as $single_fiat_currency_id)
						                <a class="dropdown-item some_padding" href="javascript:void(0)" 
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
	                        {{ Form::number('quantity',null,['id'=>'quantity','placeholder'=>'Enter Quantity']) }}
	                        <span class="size">Total balance: <b id="totalBalance"></b> <a href="javascript:void(0)" onclick="setMax()">Use Max</a></span><br>
	                        <span class="text-danger" id="quantity_error"></span>
	                    </div>
	                    <div class="field">
	                        <label>Total Price</label>
	                        {{ Form::number('trans_amount',null,['id'=>'trans_amount','placeholder'=>'Enter Price']) }}
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
    </div>
</section>
@include('front.sell.tips')
@endsection
@section('page_scripts')
	<script src="{{asset('front/js/jquery_form.min.js') }}"></script>
	<script>
		var coin_balance = JSON.parse('<?= json_encode($current_balance,true) ?>');
		var current_short_name = '{{ $crypto_currencies->first()->short_name }}';
		var current_coin_balance = 0;
		var current_coin_text = '';

		function setMax(){
			$('#quantity').val(current_coin_balance);
		}

		$('#currency_id').change(function(){
			var currency_id = $(this).val();
			if (coin_balance[currency_id] != undefined) {
				current_coin_balance = coin_balance[currency_id];
				current_coin_text = current_coin_balance+" "+current_short_name;
				$('#totalBalance').text(current_coin_balance+" "+current_short_name)
			}else{
				current_coin_balance = 0;
				current_coin_text = current_coin_balance+" "+current_short_name;
			}
			$('#totalBalance').text(current_coin_balance+" "+current_short_name)
			$('#quantity_error').text('');
		});
		$('#currency_id').trigger('change');

		$('#quantity').change(function(){
			var quantity = $(this).val();
			$('#quantity_error').text('');
			if (quantity > current_coin_balance) {
				$('#quantity_error').text('You can only sell less than '+current_coin_text+'.')
			}
		});

		function selectCurrency(current_obj,input_id,image_id,text_id){
			var current_obj = $(current_obj);
			var current_image = current_obj.attr('data-img');
			var current_name = current_obj.attr('data-name');
			current_short_name = current_obj.attr('data-short_name');
			var current_currency = current_obj.attr('data-currency');

			$('#'+input_id).val(current_currency).trigger('change');
			$('#'+image_id).attr('src',current_image);
			$('#'+text_id).html(current_short_name+'<span> '+current_name+'</span>');
			$('#quantity').val('');
			console.log(current_image,current_name,current_short_name,current_currency)
		}

		function saveSell(){
			var quantity = $('#quantity').val();
			if (quantity > current_coin_balance) {
				$('#quantity_error').text('You can only sell less than '+current_coin_text+'.')
			}else{
				startLoader();
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
						stopLoader();
					},
					error:function(resobj){
						console.log(resobj.responseJSON.message)

						$.each(resobj.responseJSON.errors, function(k,v){
							var id_arr = k.split('.');
							$('#'+id_arr[0]+'_error').text(v);
						});
						$('body').find('button').prop('disabled', false);
						stopLoader();
					}
				});
			}
		}
	</script>
@stop