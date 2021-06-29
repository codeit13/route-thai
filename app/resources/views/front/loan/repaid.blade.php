@extends('layouts.front')
@section('title')
    Route: Loan Request
@endsection
@section('page_styles')
	<link type="text/css" rel="stylesheet" href="{{asset('front/css/datepicker.css')}}" />

@endsection

@section('content')

   <section id="banner_search" class="loans-deshboard desh-2 visible-xs">
      <div class="container">
         <div class="row">
            <div class="col-lg-12 text-center col-sm-12 col-12">
               <h2><img src="img/img-6.png" alt=""/> Loan Processing</h2>
            </div>
         </div>
      </div> 
   </section>
	<section id="your-application">
		<div class="container">
			<div class="l-coins visible-xs">
				<div class="row tb-l one-1">
					<div class="col-lg-7 col-sm-6 col-6">
					  <h5 class="visible-xs">LOANABLE COINS</h5>
					  <h3 class="hidden-xs loan-d">Loan Details</h3>
					</div>
					 <div class="col-lg-5 text-right col-sm-6 col-6">
						<p>
							<img src="img/bitcoin.png" alt=""/>
							<img src="img/icon-5.png" alt=""/>
							<img src="img/icon-6.png" alt=""/>
							<img src="img/icon-7.png" alt=""/>
						</p>
					</div>
				</div>
			</div>	
			<div class="row tb-l">
				<div class="col-lg-7 col-sm-12 col-12">
					<div class="row">
						<div class="col-lg-6 col-sm-6 col-6">
							<h3>Loan Details</h3>
						</div>
						<div class="col-lg-6 text-right col-sm-6 col-6">
							<span class="repaid"><i class="fa fa-check" aria-hidden="true"></i> Repaid</span>
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
									<div class="col-lg-4 xs-flush-right col-sm-4 col-5">
										<h6>Loan Repaid</h6>
										<h5><b class="green">34456.98</b> USD</h5>
									</div>
									<div class="col-lg-4 col-sm-4 col-7">
										<h6>Collateral received</h6>
										<h5><b>1</b> BTC</h5>
									</div>
									<div class="col-lg-4 col-sm-4 col-6">
										<h6>Loan Term Value</h6>
										<h5><b>90%</b><span>30Days</span></h5>
									</div>
								</div>
							</div>
						</div>
						<div class="col-lg-12 text-right col-sm-12 col-12">
							<a href="#" class="btn-info go-back">Go Back</a>
						</div>
					</div>
				</div>
				<div class="col-lg-5 hidden-xs text-center col-sm-5 col-12">
					<h3>Loan Repaid</h3>
					<img src="img/repaid.png" alt=""/>
					<p class="successfully">You have successfully repaid the loan</p>
				</div>
			</div>
		</div> 
	</section>


@endsection


@section('page_scripts')


@endsection