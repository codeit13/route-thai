@extends('layouts.front')
@section('title')
    Route: P2P Trading Platform
@endsection
@section('page_styles')
	<link type="text/css" rel="stylesheet" href="{{asset('front/css/datepicker.css')}}" />

@endsection
@section('content')

@php

$existingCurrencies=$existingCurrencies2=$existingCurrencies3=$existingCurrencies1=[];

@endphp
<div class="progress-section visible-xs">
	<h2>@if($request->type=='withdraw')

								{{__('Withdraw History')}}


                          @else
								{{__('Deposit History')}}

								@endif</h2>
</div>
<section id="wallet-content" class="request crypto order-history hht">
		<div class="container">
			<div class="row  hidden-xs">
				<div class="col-lg-12  col-sm-12 col-12">
					<div class="white-box" style="">
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-12">


								<h3>
		                  @if($request->type=='withdraw')

								{{__('Withdraw History')}}


		                  @else
								{{__('Deposit History')}}

								@endif

							</h3>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12  col-sm-12 col-12">
					<div class="white-box" style="">
						<div class="row">
							<div class="white-box" style="background:none; box-shadow:none; margin: 0px 0px; padding: 0px 15px;">
                              <ul class="janral-head">


						@foreach($currency_types as $index => $currency_type)


						@if(isset($walletType->id) && $walletType->id==$currency_type->id)

						<li class="active"><a href="#">{{__($currency_type->type)}}</a></li>
						@elseif(!isset($walletType->id) && $index==0)
						<li class="active"><a href="#">{{__($currency_type->type)}}</a></li>
						@else
						<li class=""><a href="{{route('wallet.request.history',['type'=>$currency_type->id,'typename'=>strtolower($currency_type->type)]).'?type='.$request->type??''}}">{{__($currency_type->type)}}</a></li>
						@endif


						

						@endforeach
					
						<li class="last"><a href="#"><img src="{{asset('front/img/icon-13.png')}}" alt=""/></a></li>
					</ul>

						</div>
					</div>

						<div class="head-xs visible-xs">
							<form id="filterForm1" action="{{route('wallet.request.history',array('type'=>$walletType->id??'','typename'=>$walletType->type??''))}}" method="GET" >

								<input type="hidden" name="type">
							<div class="row">
								<div class="col-xs-12">
									<div class="row">
										<div class="col-12">
											<label>{{__('Date')}}</label>
										</div>
									</div>
									<div class="row">

										<div class="col-6 sp-right">
											<input type="date" id="reportdate" name="start_date" value="{{$request->start_date??''}}">
										</div>
										<div class="col-6 sp-left">
											<input type="date" id="reportdate" name="end_date" value="{{$request->end_date??''}}">
										</div>
									</div>
								</div>
								<div class="col-xs-12 sp-left">
									<div class="row">
										<div class="col-12">
											<label>{{__('Types of Currency')}}</label>
										</div>
									</div>
									<div class="dropdown currency_two three_coins crypto currencyDropdown">


									
													     @foreach($filters as $cIndex=> $trans_row)
													         @php
													     $currency=$trans_row->currency;
													     @endphp

													     @if(in_array($currency->id,$existingCurrencies2))

													     @continue;

													     @else 

													     @php
                                                     $existingCurrencies2[]=$currency->id;

                                                     @endphp

													     @endif

                    @if($currency->id==$currentCurrency)

                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                      @if($currency->hasMedia('icon'))
    
                                      

                      <img style="max-width: 28px;" src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 

                      @endif

                      {{__($currency->short_name)}} <span>{{__($currency->name)}}</span>
                      </button>
                      @endif

                      @endforeach

                      @if(!$currentCurrency)
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All
                                                </button>
                                                @endif

                      
  


                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                           @foreach($filters as $cIndex=> $trans_row)
													        @php
													     $currency=$trans_row->currency;
													     @endphp

													     @if(in_array($currency->id,$existingCurrencies3))

													     @continue;

													     @else 

													     @php
                                                     $existingCurrencies3[]=$currency->id;

                                                     @endphp

													     @endif

                            <a class="dropdown-item" data-id="{{$currency->id}}" href="#">

                                 @if($currency->hasMedia('icon'))
    
                                      

                      <img style="max-width: 28px;" src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 

                      @endif

                      {{__($currency->short_name)}} <span>{{__($currency->name)}}</span>



                            </a>


                    @endforeach


												</div>
												     <input type="hidden" name="currency" class="coin_id_class" id="coin_id" value="{{($currentCurrency)}}"/>
									</div>
								</div>
							</div>
							 <div class="row">
                            <div class="col-xs-12 flush">
                                <label>{{__("Status")}}</label>
                            </div>
                        </div>
							<div class="row">
								<div class="col-4">
								<select name="status" class="filter-type">

									<option value="">All</option>

													<option value="pending" @if($request->status=='pending') selected @endif>{{__('In Progress')}}</option>
													<option value="approved" @if($request->status=='approved') selected @endif>{{__('Approved')}}</option>
													<option value="rejected" @if($request->status=='rejected') selected @endif>{{__('Rejected')}}</option>
												</select>
								</div>
								<div class="col-8 xs-flush-right">
									<input class="coin" name="search" value="{{$request->search??''}}" type="search" placeholder="Search Coin Name" />
								</div>
							</div>	
						</form>
						</div>	




						<div class="row hidden-xs">
							<form id="filterForm" action="{{route('wallet.request.history',array('type'=>$walletType->id??'','typename'=>$walletType->type??''))}}" method="GET" >

							<div class="col-lg-12 col-sm-12 col-12">
								
								<table class="order-history-table">
									<thead>
										<tr>
											<th colspan="2">{{__('Date')}}</th>
											<th>{{__('Types of Currency')}}</th>
											<th style="width:110px;">{{__('Order Type')}}</th>
											<th>{{__('Status')}}</th>
											<th></th>
										</tr>
									</thead>
									<tbody>


										<tr>

											<td>

												<input type="date" id="reportdate" name="start_date" value="{{$request->start_date??''}}">
											<td><input type="date" id="reportdate" name="end_date" value="{{$request->end_date??''}}"></td>
											<td style="width:250px; display:inline-block;">
												<div class="dropdown currency_two three_coins crypto currencyDropdown">


													   @foreach($filters as $cIndex=> $trans_row)
													     @php
													     $currency=$trans_row->currency;
													     @endphp

													     @if(in_array($currency->id,$existingCurrencies))

													     @continue;

													     @else 

													     @php
                                                     $existingCurrencies[]=$currency->id;

                                                     @endphp

													     @endif

                    @if($currency->id==$currentCurrency)

                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                      @if($currency->hasMedia('icon'))
    
                                      

                      <img style="max-width: 28px;" src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 

                      @endif

                      {{__($currency->short_name)}} <span>{{__($currency->name)}}</span>
                      </button>
                      @endif

                      @endforeach

                        @if(!$currentCurrency)
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All</span>
                                                </button>
                                                @endif

                      
      



                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                      	    <a class="dropdown-item" data-id="" href="#">


                   All <span></span>



                            </a>

                         @foreach($filters as $cIndex=> $trans_row)
													     @php
													     $currency=$trans_row->currency;
													     @endphp

													     @if(in_array($currency->id,$existingCurrencies1))

													     @continue;

													     @else 

													     @php
                                                     $existingCurrencies1[]=$currency->id;

                                                     @endphp

													     @endif

                            <a class="dropdown-item" data-id="{{$currency->id}}" href="#">

                                 @if($currency->hasMedia('icon'))
    
                                      

                      <img style="max-width: 28px;" src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 

                      @endif

                      {{__($currency->short_name)}} <span>{{__($currency->name)}}</span>



                            </a>


                    @endforeach


												</div>
												     <input type="hidden" name="currency" class="coin_id_class" id="coin_id" value="{{($currentCurrency)}}"/>

											</td>
											<td>
												<select name="type" class="filter-type">
													<option value="">All</option>
													<option value="deposit" @if($request->type=='deposit') selected @endif >{{__('Deposit')}}</option>

													<option value="withdraw" @if($request->type=='withdraw') selected @endif>{{__('Withdraw')}}</option>

												

												</select>
											</td>
											<td>
												<select name="status" class="filter-type">
													<option value="">All</option>
													<option value="pending" @if($request->status=='pending') selected @endif>{{__('In Progress')}}</option>
													<option value="approved" @if($request->status=='approved') selected @endif>{{__('Approved')}}</option>
													<option value="rejected" @if($request->status=='rejected') selected @endif>{{__('Rejected')}}</option>
												</select>
											</td>
											<td><input  class="coin ml-0" value="{{$request->search??''}}" name="search" type="search" placeholder="Search Coin Name" /></td>
										</tr>
									</tbody>
								</table>
							
							</div>
							</form>
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
    
                                      

											<img style="max-width: 28px;" src="{{$transaction->currency->firstMedia('icon')->getUrl()}}" alt="{{__($transaction->currency->name)}}"/> 

											@endif

											<label>{{__($transaction->currency->short_name)}} <br><span>{{__($transaction->currency->name)}}</span>
												</label>
											</td>
											<td>{{$transaction->created_at->format('d/m/Y')}}<span>&nbsp;&nbsp;{{$transaction->created_at->format('h:i:s')}}</span></td>
											<td class="text-center">{{$transaction->trans_amount}}</td>
											<td class="text-center">

												@if($transaction->type=='withdraw')

												{{$transaction->address}}

												@else

                                               @if($transaction->hasMedia('file'))

												<a class="btn-success" target="_blank" href="{{$transaction->firstMedia('file')->getUrl()}}">View File</a>

												@endif

												@endif

											</td>

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
										@foreach($transactions as $tindex => $transaction)
										<tr class="first text-left">
											<td>{{$transaction->created_at->format('d/m/Y')}}&nbsp;&nbsp;{{$transaction->created_at->format('h:i:s')}}</td>
										</tr>
										<tr>
											<td>
												@if($transaction->currency->hasMedia('icon'))
    
                                      

											<img style="max-width: 28px;" src="{{$transaction->currency->firstMedia('icon')->getUrl()}}" alt="{{__($transaction->currency->name)}}"/> 

											@endif

											<label>{{__($transaction->currency->short_name)}} <br><span>{{__($transaction->currency->name)}}</span>
												</label>
											</td>
											<td>
												<span>Quantity</span>{{$transaction->trans_amount}}
											</td>
											<td class="w-details">	@if($transaction->type=='withdraw')

												{{$transaction->address}}

												@else

                                          @if($transaction->hasMedia('file'))

												<a class="btn-success" target="_blank" href="{{$transaction->firstMedia('file')->getUrl()}}">View File</a>

												@endif

												@endif</td>
											@switch($transaction->status)

											@case('pending')

											<td class="code"><img src="{{asset('front/img/icon-27.png')}}" alt="">{{__('In progress')}}</td>

											@break

											@case('approved')

											<td class="code"><img src="{{asset('front/img/icon-28.png')}}" alt="">{{__('Approved')}}</td>

											@break

											@case('rejected')

											<td class="code"><img src="{{asset('front/img/icon-29.png')}}" alt="">{{__('Rejected')}}</td>

											@break

											@endswitch
										</tr>

										@endforeach
										
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
<script src="{{asset('front/js/main.js')}}"></script> <!-- Gem jQuery -->
	<script src="{{asset('front/js/bootstrap-datepicker.js')}}"></script>
		<script>
		$('#datepicker').datepicker({autoclose:true});
		$('#datepickertwo').datepicker({autoclose:true});
		$('#datepickerthree').datepicker({autoclose:true});
		$('#datepickerfour').datepicker({autoclose:true});
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





		$(".currencyDropdown .dropdown-menu .dropdown-item").on("click", function(e) { e.preventDefault();

      var currency_id=$(this).attr('data-id');



 //  changeShowBalance(currency_id);


      $('.coin_id_class').val(currency_id);
    $('.currencyDropdown .dropdown-toggle').html($(this).html());

    //alert();
   // console.log($('#filterForm'));

    submitform();

    //$('#filterForm').submit();
});

		function submitform()
		{
			
			if($('#filterForm1').parents('div').eq(0).css('display') !='none')
			{
		


			document.getElementById("filterForm1").submit();

			}
			else
			{
			document.getElementById("filterForm").submit();

			}
		}

		$('.filter-type').on('change',function()
		{
			//console.log('ch');

			submitform();
		})


		$(document).on('change','[type="date"]',function()
		{
			submitform();
		})



  $(document).on('keyup','[name="search"]',function(e)
  {
  	if(e.which==13)
  	{
  		submitform();
  	}
  })

   $('.options li').on('click',function()
  {

  	submitform();
  })

	</script>
	@endsection