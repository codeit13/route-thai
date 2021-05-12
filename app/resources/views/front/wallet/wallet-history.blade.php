@extends('layouts.front')
@section('title')
    Route: P2P Trading Platform
@endsection
@section('page_styles')
	<link type="text/css" rel="stylesheet" href="{{asset('front/css/datepicker.css')}}" />

@endsection
@section('content')
<section id="wallet-content" class="request crypto order-history">
		<div class="container">
			<div class="row">
				<div class="col-lg-12  col-sm-12 col-12">
					<div class="white-box" style="background:none; box-shadow:none;">
						<div class="row">
							<div class="col-lg-12 col-sm-12 col-12">


								<h3>
                          @if($request->type==2)

								{{__('Withdraw History')}}


                          @else
								{{__('Deposit History')}}

								@endif

							</h3>
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
						<li class=""><a href="{{route('wallet.request.history',['type'=>$currency_type->id,'typename'=>strtolower($currency_type->type)]).'?type='.$request->type??''}}">{{__($currency_type->type)}}</a></li>
						@endif


						

						@endforeach
					
						<li class="last"><a href="#"><img src="{{asset('front/img/icon-13.png')}}" alt=""/></a></li>
					</ul>

						</div>
					</div>

						<div class="head-xs visible-xs">
							<form id="filterForm1" action="{{route('wallet.request.history',array('type'=>$walletType->id??'','typename'=>$walletType->type??''))}}" method="GET" >
							<div class="row">
								<div class="col-7">
									<div class="row">
										<div class="col-12">
											<label>{{__('Date')}}</label>
										</div>
									</div>
									<div class="row">

										<div class="col-6 sp-right">
											<input class="date filter-type" name="start_date" id="datepicker" value="{{$request->start_date??''}}" autocomplete="off" type="text" placeholder=""/>
										</div>
										<div class="col-6 sp-left">
											<input class="date filter-type" autocomplete="off" name="end_date" value="{{$request->end_date??''}}" id="datepickertwo" type="text" placeholder=""/>
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
									
													     @foreach($currencies as $cIndex=> $currency)

                    @if($currency->id==$currentCurrency)

                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                      @if($currency->hasMedia('icon'))
    
                                      

                      <img src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 

                      @endif

                      {{__($currency->short_name)}} <span>{{__($currency->name)}}</span>
                      </button>
                      @endif

                      @endforeach

                      
                    @if(!$currentCurrency)

                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                      @if($currencies[0]->hasMedia('icon'))
    
                                      

                      <img src="{{$currencies[0]->firstMedia('icon')->getUrl()}}" alt="{{__($currencies[0]->name)}}"/> 

                      @endif

                      {{__($currencies[0]->short_name)}} <span>{{__($currencies[0]->name)}}</span>
                      </button>



                    @endif



                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                           @foreach($currencies as $cIndex=> $currency)

                            <a class="dropdown-item" data-id="{{$currency->id}}" href="#">

                                 @if($currency->hasMedia('icon'))
    
                                      

                      <img src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 

                      @endif

                      {{__($currency->short_name)}} <span>{{__($currency->name)}}</span>



                            </a>


                    @endforeach


												</div>
												     <input type="hidden" name="currency" class="coin_id_class" id="coin_id" value="{{($currentCurrency)}}"/>
									</div>
								</div>
							</div>
							<div class="col-12 flush">
								<label>Status</label>
							</div>
							<div class="row">
								<div class="col-4">
								<select name="status" class="filter-type">
													<option value=""> select </option>
													<option value="pending" @if($request->status=='pending') selected @endif>{{__('In Progress')}}</option>
													<option value="approved" @if($request->status=='approved') selected @endif>{{__('Approved')}}</option>
													<option value="rejected" @if($request->status=='rejected') selected @endif>{{__('Rejected')}}</option>
												</select>
								</div>
								<div class="col-8">
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


												<input class="date filter-type" name="start_date" autocomplete="off" id="datepickerthree" value="{{$request->start_date??''}}" type="text" placeholder=""/></td>
											<td><input class="date filter-type" autocomplete="off" name="end_date" value="{{$request->end_date??''}}" id="datepickerfour" type="text" placeholder=""/></td>
											<td style="width:180px; display:inline-block;">
												<div class="dropdown currency_two three_coins crypto">

													     @foreach($currencies as $cIndex=> $currency)

                    @if($currency->id==$currentCurrency)

                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                      @if($currency->hasMedia('icon'))
    
                                      

                      <img src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 

                      @endif

                      {{__($currency->short_name)}} <span>{{__($currency->name)}}</span>
                      </button>
                      @endif

                      @endforeach

                      
                    @if(!$currentCurrency)

                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                      @if($currencies[0]->hasMedia('icon'))
    
                                      

                      <img src="{{$currencies[0]->firstMedia('icon')->getUrl()}}" alt="{{__($currencies[0]->name)}}"/> 

                      @endif

                      {{__($currencies[0]->short_name)}} <span>{{__($currencies[0]->name)}}</span>
                      </button>



                    @endif



                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                           @foreach($currencies as $cIndex=> $currency)

                            <a class="dropdown-item" data-id="{{$currency->id}}" href="#">

                                 @if($currency->hasMedia('icon'))
    
                                      

                      <img src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 

                      @endif

                      {{__($currency->short_name)}} <span>{{__($currency->name)}}</span>



                            </a>


                    @endforeach


												</div>
												     <input type="hidden" name="currency" class="coin_id_class" id="coin_id" value="{{($currentCurrency)}}"/>

											</td>
											<td>
												<select name="type" class="filter-type">
													<option value="1" @if($request->type==1) selected @endif >{{__('Deposit')}}</option>

													<option value="2" @if($request->type==2) selected @endif>{{__('Withdraw')}}</option>
												</select>
											</td>
											<td>
												<select name="status" class="filter-type">
													<option value=""> select </option>
													<option value="pending" @if($request->status=='pending') selected @endif>{{__('In Progress')}}</option>
													<option value="approved" @if($request->status=='approved') selected @endif>{{__('Approved')}}</option>
													<option value="rejected" @if($request->status=='rejected') selected @endif>{{__('Rejected')}}</option>
												</select>
											</td>
											<td><input class="coin" value="{{$request->search??''}}" name="search" type="search" placeholder="Search Coin Name" /></td>
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
    
                                      

											<img src="{{$transaction->currency->firstMedia('icon')->getUrl()}}" alt="{{__($transaction->currency->name)}}"/> 

											@endif

											<label>{{__($transaction->currency->short_name)}} <br><span>{{__($transaction->currency->name)}}</span>
												</label>
											</td>
											<td>{{$transaction->created_at->format('d/m/Y')}}<span>&nbsp;&nbsp;{{$transaction->created_at->format('h:i:s')}}</span></td>
											<td class="text-center">{{$transaction->trans_amount}}</td>
											<td class="text-center">

												@if($transaction->type==2)

												{{$transaction->address}}

												@else



												<a class="btn-success" target="_blank" href="{{$transaction->firstMedia('file')->getUrl()}}">View File</a>

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
    
                                      

											<img src="{{$transaction->currency->firstMedia('icon')->getUrl()}}" alt="{{__($transaction->currency->name)}}"/> 

											@endif

											<label>{{__($transaction->currency->short_name)}} <br><span>{{__($transaction->currency->name)}}</span>
												</label>
											</td>
											<td>
												<span>Quantity</span>{{$transaction->trans_amount}}
											</td>
											<td class="w-details">	@if($transaction->type==2)

												{{$transaction->address}}

												@else



												<a class="btn-success" target="_blank" href="{{$transaction->firstMedia('file')->getUrl()}}">View File</a>

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

		$(".currency_two .dropdown-menu .dropdown-item").on("click", function(e) { e.preventDefault();

      var currency_id=$(this).attr('data-id');

 //  changeShowBalance(currency_id);


      $('.coin_id_class').val(currency_id);
    $('.currency_two .dropdown-toggle').html($(this).html());

    //alert();
   // console.log($('#filterForm'));

    submitform();

    //$('#filterForm').submit();
});

		function submitform()
		{
			if($('#filterForm1').parent('.head-xs').css('display') !='none')
			{
			document.getElementById("filterForm1").submit();

			}
			else
			{
			document.getElementById("filterForm").submit();

			}
		}

		$(document).on('change','.filter-type',function()
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

	</script>
	@endsection