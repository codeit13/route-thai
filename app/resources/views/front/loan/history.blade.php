@extends('layouts.front')
@section('title')
    Route: Loan Request
@endsection
@section('page_styles')
	<link type="text/css" rel="stylesheet" href="{{asset('front/css/datepicker.css')}}" />

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
								<a class="green-c" href="#">+ APPLY FOR NEW LOAN</a>
							</div>
						</div>
						<div class="head-xs visible-xs">
							<div class="row">
								<div class="col-7">
									<div class="row">
										<div class="col-12">
											<label>Date</label>
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
											<label>Types of Currency</label>
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
											<tr>
												<td>2212 <span>USD</span></td>
												<td>CDFKM9483</td>
												<td>23/05/2021</td>
												<td><img src="{{asset('front/img/bitcoin.png')}}" alt=""/> 2 BTC</td>
												<td>30 Days</td>
												<td>90%</td>
												<td>Paid</td>
												<td><a href="#">View Details</a></td>
											</tr>
											<tr>
												<td>23 <span>USD</span></td>
												<td>CDFKM9483</td>
												<td>23/05/2021</td>
												<td><img src="{{asset('front/img/bitcoin.png')}}" alt=""/> 2 BTC</td>
												<td>30 Days</td>
												<td>90%</td>
												<td class="red-c">UnPaid</td>
												<td><a href="#">View Details</a></td>
											</tr>
											<tr>
												<td>2212 <span>USD</span></td>
												<td>CDFKM9483</td>
												<td>23/05/2021</td>
												<td><img src="{{asset('front/img/bitcoin.png')}}" alt=""/> 2 BTC</td>
												<td>30 Days</td>
												<td>90%</td>
												<td>Paid</td>
												<td><a href="#">View Details</a></td>
											</tr>
											<tr>
												<td>23 <span>USD</span></td>
												<td>CDFKM9483</td>
												<td>23/05/2021</td>
												<td><img src="{{asset('front/img/bitcoin.png')}}" alt=""/> 2 BTC</td>
												<td>30 Days</td>
												<td>90%</td>
												<td class="red-c">UnPaid</td>
												<td><a href="#">View Details</a></td>
											</tr>
											<tr>
												<td>2212 <span>USD</span></td>
												<td>CDFKM9483</td>
												<td>23/05/2021</td>
												<td><img src="{{asset('front/img/bitcoin.png')}}" alt=""/> 2 BTC</td>
												<td>30 Days</td>
												<td>90%</td>
												<td>Paid</td>
												<td><a href="#">View Details</a></td>
											</tr>
											<tr>
												<td>23 <span>USD</span></td>
												<td>CDFKM9483</td>
												<td>23/05/2021</td>
												<td><img src="{{asset('front/img/bitcoin.png')}}" alt=""/> 2 BTC</td>
												<td>30 Days</td>
												<td>90%</td>
												<td class="red-c">UnPaid</td>
												<td><a href="#">View Details</a></td>
											</tr>
											<tr>
												<td>2212 <span>USD</span></td>
												<td>CDFKM9483</td>
												<td>23/05/2021</td>
												<td><img src="{{asset('front/img/bitcoin.png')}}" alt=""/> 2 BTC</td>
												<td>30 Days</td>
												<td>90%</td>
												<td>Paid</td>
												<td><a href="#">View Details</a></td>
											</tr>
											<tr>
												<td>23 <span>USD</span></td>
												<td>CDFKM9483</td>
												<td>23/05/2021</td>
												<td><img src="{{asset('front/img/bitcoin.png')}}" alt=""/> 2 BTC</td>
												<td>30 Days</td>
												<td>90%</td>
												<td class="red-c">UnPaid</td>
												<td><a href="#">View Details</a></td>
											</tr>
											<tr>
												<td>2212 <span>USD</span></td>
												<td>CDFKM9483</td>
												<td>23/05/2021</td>
												<td><img src="{{asset('front/img/bitcoin.png')}}" alt=""/> 2 BTC</td>
												<td>30 Days</td>
												<td>90%</td>
												<td>Paid</td>
												<td><a href="#">View Details</a></td>
											</tr>
											<tr>
												<td>23 <span>USD</span></td>
												<td>CDFKM9483</td>
												<td>23/05/2021</td>
												<td><img src="{{asset('front/img/bitcoin.png')}}" alt=""/> 2 BTC</td>
												<td>30 Days</td>
												<td>90%</td>
												<td class="red-c">UnPaid</td>
												<td><a href="#">View Details</a></td>
											</tr>
										</tbody>
									</table>
								</div>	
							</div>
							<div class="col-lg-12 visible-xs col-sm-12 col-12">
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
												<td>2212 <span>USD</span></td>
												<td>CDFKM9483</td>
												<td>23/05/2021</td>
												<td><img src="{{asset('front/img/bitcoin.png')}}" alt=""/> 2 BTC</td>
												<td>30 Days</td>
												<td>90%</td>
												<td>Paid</td>
												<td><a href="#">View Details</a></td>
											</tr>
										</tbody>
									</table>
								</div>	
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
												<td>2212 <span>USD</span></td>
												<td>CDFKM9483</td>
												<td>23/05/2021</td>
												<td><img src="{{asset('front/img/bitcoin.png')}}" alt=""/> 2 BTC</td>
												<td>30 Days</td>
												<td>90%</td>
												<td>Paid</td>
												<td><a href="#">View Details</a></td>
											</tr>
										</tbody>
									</table>
								</div>	
							</div>
						</div>
					</div>	
				</div>
			</div>
		</div>
	</section>

@endsection


@section('page_scripts')


@endsection