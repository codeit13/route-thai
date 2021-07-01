@extends('layouts.front')
@section('title')
    Route: Loan Request
@endsection
@section('page_styles')
	<link type="text/css" rel="stylesheet" href="{{asset('front/css/datepicker.css')}}" />

	<style type="text/css">
		#loan_navbar .nav-pagi nav {
    display: inline-block;
    padding: 20px 0px;
}
#loan_navbar .nav-pagi nav a {
    padding: 0px 15px;
    color: var(--white-black-text);
    font-size: 18px;
    line-height: 30px;
    display: inline-block;
}
#loan_navbar .nav-pagi nav li.active a {
    background: #ebecf0;
    border-radius: 5px;
    color: #000;
}
#loan_navbar .nav-pagi nav span {
    position: relative;
    top: 4px;
}
	</style>

@endsection

@section('content')

 <section id="wallet-content" class="request crypto order-history my-loan">
		<div class="container">
			<div class="row">
				<div class="col-lg-12  col-sm-12 col-12">
					<div class="white-box" style="background:none; box-shadow:none;">
						<div class="row">
							<div class="col-lg-6 col-sm-6 col-6">
								<h3>My Loan History</h3>
							</div>
							<div class="col-lg-6 col-sm-6 col-6 text-right">
								<a class="green-c" href="{{route('loan.create')}}">+ {{__('APPLY FOR NEW LOAN')}}</a>
							</div>
						</div>
						<div class="head-xs visible-xs">

								<form id="filterForm1" action="{{route('loan.history')}}" method="GET" >

							<div class="row">
								<div class="col-lg-7 col-xs-12 xs-flush">
									<div class="row">
										<div class="col-12">
											<label>Date</label>
										</div>
									</div>
									<div class="row">
										<div class="col-6 sp-right">
											<input type="date" class="backend-filter" name="start_date" value="{{$request->start_date??''}}">
										</div>
										<div class="col-6 sp-left">
											<input type="date" class="backend-filter" name="end_date" value="{{$request->end_date??''}}">
										</div>
									</div>
								</div>
								<div class="col-lg-5 col-xs-12 xs-flush sp-left">
									<div class="row">
										<div class="col-12">
											<label>Types of Currency</label>
										</div>
									</div>
									<div class="dropdown currency_two three_coins crypto currencyDropdown">


									
													     @foreach($currencies as $cIndex=> $currency)
													       

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

                      	  <a class="dropdown-item" data-id="" href="#">





                            <span>{{__('All')}}</span>



                            </a>

                           @foreach($currencies as $cIndex=> $currency)
													   

                            <a class="dropdown-item" data-id="{{$currency->id}}" href="#">

                                 @if($currency->hasMedia('icon'))
    
                                      

                      <img style="max-width: 28px;" src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 

                      @endif

                      {{__($currency->short_name)}} <span>{{__($currency->name)}}</span>



                            </a>


                    @endforeach


												</div>
												     <input type="hidden" name="currency" class="coin_id_class" id="" value="{{($currentCurrency)}}"/>
									</div>

								</div>
							</div>
							<div class="row">
								<div class="col-12 flush">
									<label>Status</label>
								</div>
							</div>
							<div class="row">
								<div class="col-4">
									<select name="status" class="backend-filter">
										<option value="">All</option>
										<option value="pending" @if($request->status=='pending') selected @endif>{{__('Pending')}}</option>
										<option value="approved" @if($request->status=='approved') selected @endif>{{__('In Progress')}}</option>

										<option value="close" @if($request->status=='close') selected @endif>{{__('Close')}}</option>

									</select>
								</div>
								<div class="col-8 xs-flush-right">
									<input class="coin backend-filter-input" type="search" placeholder="Search Coin Name" value="{{$request->search??''}}" name="search" />
								</div>
							</div>	
						</form>
						</div>	
						<div class="row hidden-xs">
								<form id="filterForm" action="{{route('loan.history')}}" method="GET" >
							<div class="col-lg-12 col-sm-12 col-12">
								<table class="order-history-table">
									<thead>
										<tr>
											<th colspan="2">Date</th>
											<th>Types of Currency</th>
											<th>Status</th>
											<th></th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>

												<input type="date" class="backend-filter" name="start_date" value="{{$request->start_date??''}}">

											</td>

											<td>
												<input type="date" class="backend-filter" name="end_date" value="{{$request->end_date??''}}">
											</td>
											<td style="width:180px; display:inline-block;">
													<div class="dropdown currency_two three_coins crypto currencyDropdown">


									
													     @foreach($currencies as $cIndex=> $currency)
													       

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

                      	  <a class="dropdown-item" data-id="" href="#">





                            <span>{{__('All')}}</span>



                            </a>

                           @foreach($currencies as $cIndex=> $currency)
													   

                            <a class="dropdown-item" data-id="{{$currency->id}}" href="#">

                                 @if($currency->hasMedia('icon'))
    
                                      

                      <img style="max-width: 28px;" src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 

                      @endif

                      {{__($currency->short_name)}} <span>{{__($currency->name)}}</span>



                            </a>


                    @endforeach


												</div>
												     <input type="hidden" name="currency" class="coin_id_class" id="" value="{{($currentCurrency)}}"/>
									</div>
											</td>
											<td>
												<select name="status" class="backend-filter">
										<option value="">All</option>
										<option value="pending" @if($request->status=='pending') selected @endif>{{__('Pending')}}</option>
										<option value="approved" @if($request->status=='approved') selected @endif>{{__('In Progress')}}</option>

										<option value="close" @if($request->status=='close') selected @endif>{{__('Close')}}</option>

									</select>
											</td>
											<td><input class="coin" name="search" type="search" placeholder="Search Coin Name" value="{{$request->search??''}}" /></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>

					</form>
					</div>	
				</div>	
			</div>
		</div>
	</section>
	<section id="loans-deshboard-new">
		<div class="container">
			<div class="row">
				<div class="col-lg-12  col-sm-12 col-12">
					<div class="my-loan-history">
						<div class="row">
							<div class="col-lg-12 hidden-xs vs-sm col-sm-12 col-12">
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th>Loan Amount</th>
												<th>Order Number</th>
												<th>Order Date</th>
												<th>Collateral</th>
												<th>Loan Term</th>
												<th>LTV</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach($loans as $loan)
											<tr>

												<td>{{$loan->loan_amount}} <span>{{$loan->loan_currency->short_name}}</span></td>
												<td>{{$loan->loan_id}}</td>
												<td>{{$loan->loan_date}}</td>
												<td>
													@if($loan->collateral_currency->hasMedia('icon'))
													<img style="max-width:28px;" src="{{$loan->collateral_currency->firstMedia('icon')->getUrl()}}" alt="{{$loan->collateral_currency->short_name}}"/>

													@endif

													{{$loan->collateral_amount}} {{$loan->collateral_currency->short_name}}</td>
												<td>{{$loan->duration}} &nbsp;{{$loan->duration_type}}</td>
												<td>{{$loan->term_percentage}}%</td>
												<td>{{$loan->front_status}}</td>
												<td><a href="{{route('loan.show.detail',['loan'=>$loan->loan_id])}}">View Details</a></td>

											</tr>

											@endforeach
									
										</tbody>
									</table>

								</div>	

								<div class="row" id="loan_navbar">
						<div class="col-lg-12 text-center nav-pagi col-sm-12 col-12">

							{{ $loans->onEachSide(5)->links('front._inc._paginator') }}
						
						</div>
					</div>
							</div>
							<div class="col-lg-12 visible-xs col-sm-12 col-12 xs-flush">
								@foreach($loans as $loan)
								<div class="table-responsive">
									<table class="table">
										<thead>
											<tr>
												<th>Loan Amount</th>
												<th>Order Number</th>
												<th>Order Date</th>
												<th>Collateral</th>
												<th>Loan Term</th>
												<th>LTV</th>
												<th>Status</th>
												<th>Action</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												

														<td>{{$loan->loan_amount}} <span>{{$loan->loan_currency->short_name}}</span></td>
												<td>{{$loan->loan_id}}</td>
												<td>{{$loan->loan_date}}</td>
												<td>
													@if($loan->collateral_currency->hasMedia('icon'))
													<img style="max-width:28px;" src="{{$loan->collateral_currency->firstMedia('icon')->getUrl()}}" alt="{{$loan->collateral_currency->short_name}}"/>

													@endif

													{{$loan->collateral_amount}} {{$loan->collateral_currency->short_name}}</td>
												<td>{{$loan->duration}} &nbsp;{{$loan->duration_type}}</td>
												<td>{{$loan->term_percentage}}%</td>
												<td>{{$loan->front_status}}</td>
												<td><a href="{{route('loan.show.detail',['loan'=>$loan->loan_id])}}">View Details</a></td>
											</tr>
										</tbody>
									</table>
								</div>

								@endforeach

							<!-- -->
							</div>
						</div>

						
					</div>	
				</div>
			</div>
		</div>
	</section>

@endsection


@section('page_scripts')


<script type="text/javascript">

	$(".currencyDropdown .dropdown-menu .dropdown-item").on("click", function(e) { e.preventDefault();

      var currency_id=$(this).attr('data-id');



      $('.coin_id_class').val(currency_id);
    $('.currencyDropdown .dropdown-toggle').html($(this).html());



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

		$('.backend-filter').on('change',function()
		{
			//console.log('ch');

			submitform();
		})


		// $(document).on('change','[type="date"]',function()
		// {
		// 	submitform();
		// })



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