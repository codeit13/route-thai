@extends('layouts.front')
@section('title')
    Route: P2P Trading Platform
@endsection
@section('page_styles')
	<link type="text/css" rel="stylesheet" href="{{asset('front/css/datepicker.css')}}" />

@endsection

@section('content')

 <section id="banner_search" class="loans-deshboard desh-2 visible-xs">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 text-center col-sm-12 col-12">
               <h2><img src="{{asset('front/img/img-6.png')}}" alt=""/> Repay Loan</h2>
            </div>
         </div>
      </div> 
   </section>
	<section id="your-application" class="repay-details bottom-0">
		<div class="container">
			<div class="l-coins visible-xs">
				<div class="row tb-l one-1">
					<div class="col-lg-7 col-sm-6 col-6">
					  <h5 class="visible-xs">LOANABLE COINS</h5>
					  <h3 class="hidden-xs loan-d">Loan Details</h3>
					</div>
					 <div class="col-lg-5 text-right col-sm-6 col-6">
						<p>
							<img src="{{asset('front/img/bitcoin.png')}}" alt=""/>
							<img src="{{asset('front/img/icon-5.png')}}" alt=""/>
							<img src="{{asset('front/img/icon-6.png')}}" alt=""/>
							<img src="{{asset('front/img/icon-7.png')}}" alt=""/>
						</p>
					</div>
				</div>
			</div>	
			<div class="row tb-l">
				<div class="col-lg-12 col-sm-12 col-12">
					<div class="row">
						<div class="col-lg-6 col-sm-6 col-6">
							<h3>Loan Details</h3>
						</div>
						<div class="col-lg-6 text-right col-sm-6 col-6">
							<span class="in-progress">In Progress</span>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-6 col-sm-6 col-6">
							<label>Order Date:23rd may <span>|</span> 14:34PM</label>
						</div>
						<div class="col-lg-6 text-right col-sm-6 col-6">
							<label>Order Number: CSKKCK9894</label>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-sm-12 col-12">
							<div class="white-box">
								<div class="row">
									<div class="col-lg-3 xs-flush-right col-sm-4 col-5">
										<h6>My Collateral is</h6>
										<h5><b>1.00</b> &nbsp;BTC&nbsp; <img src="{{asset('front/img/bitcoin.png')}}" alt=""/></h5>
									</div>
									<div class="col-lg-3 m-l col-sm-4 col-7">
										<h6>Current value</h6>
										<p><img src="{{asset('front/img/sm-icon-1.png')}}" alt=""/> BTC:<b>1,797,994.87</b> USD <br><a href="#">+0.73%;</a></p>
									</div>
									<div class="col-lg-2 col-sm-4 col-6">
										<h6>Loan Term Value</h6>
										<h5><b>90%</b><br><span>30Days</span></h5>
									</div>
									<div class="col-lg-2 col-sm-4 col-6">
										<h6>Close price set at</h6>
										<h5><b>219000</b> USD</h5>
									</div>
									<div class="col-lg-2 col-sm-4 col-6">
										<h6>Loan to be repaid</h6>
										<h5><b class="green">34456.98</b> USD</h5>
									</div>
									<div class="col-lg-2 text-right visible-xs col-sm-4 col-6">
										<h6>PDL</h6>
										<h5><a>+0.73%;</a></h5>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-8 col-sm-8 col-5">
							<a href="#" class="btn-info close-now">Close now</a>
						</div>
						<div class="col-lg-4 hidden-xs text-right pdl-2 col-sm-4 col-7">
							<label>PDL: <span>+0.73%</span> <a href="#" class="btn-info">Repay Loan</a></label>
							<p>Repay to 8 days (21st Sep,2021 | 14:23)</p>
						</div>
						<div class="col-lg-4 visible-xs text-right pdl-2 col-sm-4 col-7">
							<label><a href="#" class="btn-info">Repay Loan</a></label>
							<p>Repay to 8 days (21st Sep,2021 | 14:23)</p>
						</div>
						<div class="visible-xs xs-l-flush hidden-xs col-7">
							<a href="#" class="btn-info repay-now">REPAY LOAN</a>
							<p class="red-position">Repay to 8 days (21st Sep, 2021 14:23)</p>
						</div>
					</div>
				</div>
			</div>
		</div> 
	</section>
	<section id="loans-deshboard-new" class="repay">
      <div class="container">
		<div class="my-loan-history">
			<div class="row">
				<div class="col-lg-6 col-sm-6 col-4">
					<h4>Other Loans</h4>
				</div>
				<div class="col-lg-6 visible-xs text-right col-sm-6 col-8">
					<a href="#" class="btn-success apply-for">+ Apply For newloan</a>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 hidden-xs col-sm-12 col-12">
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
		<div class="apply-new-loan">
			<div class="row">
				<div class="col-lg-9 col-sm-8 col-12">
					<div class="row">
						<div class="col-lg-4 col-sm-4 col-12">
							<p>Lorem ipsum dolor sit amet,
							consectetur adipiscing elit, sed
							do eiusmod.</p>
						</div>
						<div class="col-lg-4 col-sm-4 col-12">
							<p>Lorem ipsum dolor sit amet,
							consectetur adipiscing elit, sed
							do eiusmod.</p>
						</div>
						<div class="col-lg-4 col-sm-4 col-12">
							<p>Lorem ipsum dolor sit amet,
							consectetur adipiscing elit, sed
							do eiusmod.</p>
						</div>
					</div>
				</div>
				<div class="col-lg-3 text-right col-sm-4 col-12">
					<a href="#" class="btn-info">Apply new loan</a>
				</div>
			</div>
		</div>
      </div> 
   </section>

@endsection


@section('page_scripts')


@endsection