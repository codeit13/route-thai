@extends('layouts.front')
@section('title')
    Route: P2P Trading Platform
@endsection
@section('content')

<section id="dashboard">
    <div class="container-fluid">
       <div class="row">
          <div class="col-lg-2 col-xs-12 flush">
             <div class="sidebar">
                <ul>
                   <li class="active"><a href="#"><i class="fa fa-tv-alt"></i> Dashboard</a>
                   </li>
                   <li> <a href="#"><i class="fa fa-user"></i> Basic Info</a>
                   </li>
                   <li> <a href="#"><i class="fa fa-credit-card"></i> Payment</a>
                   </li>
                   <li> <a href="#"><i class="fa fa-lock"></i> Securtiy</a>
                   </li>
                </ul>
             </div>
          </div>
          <div class="col-lg-10 col-xs-12 flush">
             <div class="content_dashboard">
                <div class="container">
                   <div class="row">
                      <div class="col user_details"> <i class="fa fa-user-circle"></i>
                         <div class="user_data">
                            <h3>{{ Auth::user()->email }}</h3>
                            <h4>Mobile Number : <span>{{ Auth::user()->mobile}}</span></h4>
                         </div>
                         <p>Last login time: 2021-05-04 22:19:31 <span>IP: 103.103.162.223</span>
                         </p>
                      </div>
                   </div>
                   <div class="row row-eq-height">
                      <div class="col-lg-8 col-xs-12 flush">
                         <div class="card">
                            <h2>Balance Details</h2>
                            <div class="button_ggrop"> <a href="#" class="green_btn">Deposit</a>
                               <a href="#" class="white_btn">Withdraw</a>
                            </div>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                               <li class="nav-item"> <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Crypto</a>
                               </li>
                               <li class="nav-item"> <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Fiat</a>
                               </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                               <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                  <div class="row under_tabs">
                                     <div class="col-lg-6">
                                        <h4>Account Balance: <a href="#">Hide Balance <i class="fa fa-eye-slash"></i></a></h4>
                                     <h1>{{ Auth::user()->wallet()->get(['coin','currency_id'])->sum('coin') }}<span>{{ Auth::user()->wallet()->get(['coin','currency_id'])->first()->currency->name }}</span></h1>
                                        <h3>Estimated Value:</h3>
                                        <h6 style="font-family: 'Open Sans', sans-serif;">₹108.6</h6>
                                     </div>
                                     <div class="col-lg-6 text-center">
                                        <div class="doughnut">
                                          <div class="doughnutChartContainer">
                                            <canvas id="doughnutChart" height="160"></canvas>
                                          </div>
                                          <div id="legend" class="chart-legend"></div>
                                        </div>
                                     </div>               
                                  </div>
                               </div>
                               <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">...</div>
                            </div>
                         </div>
                      </div>
                      <div class="col-lg-4 col-xs-12 xs-flush">
                         <div class="card pd_card">
                            <h2>Profile Details</h2>
                            <hr/>
                            <label>Username:</label>
                            <p>shavez_mirza_786 <a href="#"><i class="fa fa-edit"></i></a></p>
                            <label>Currency</label>
                            <div class="dropdown currency_two three_coins crypto">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('front/img/inr.svg') }}" alt="">INR
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item" href="#"><img src="{{ asset('front/img/kr.svg') }}" alt=""> KRW</a>
                                <a class="dropdown-item" href="#"><img src="{{ asset('front/img/usd.svg') }}" alt=""> USD</a>
                                <a class="dropdown-item" href="#"><img src="{{ asset('front/img/th.svg') }}" alt=""> THB</a>
                                <a class="dropdown-item" href="#"><img src="{{ asset('front/img/yen.svg') }}" alt=""> JPY</a>
                              </div>
                            </div>
                            <label>Language</label>
                            <div class="dropdown currency_two three_coins crypto">
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ asset('front/img/GBP.svg')}}" alt="">English
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                  <a class="dropdown-item" href="#"><img src="{{ asset('front/img/kr.svg')}}" alt="">Korean</a>
                                <a class="dropdown-item" href="#"><img src="{{ asset('front/img/th.svg')}}" alt="">Thailand</a>
                                <a class="dropdown-item" href="#"><img src="{{ asset('front/img/cn.svg')}}" alt="">Chineese</a>
                                <a class="dropdown-item" href="#"><img src="{{ asset('front/img/jp.svg')}}" alt=""> Japanese</a>
                              </div>
                            </div>
                            <div class="sn_notificatio">
                               <i class="fa fa-comment-alt-lines"></i>
                               SMS Notification
                               <button type="button" class="btn btn-sm btn-toggle" data-toggle="button" aria-pressed="false" autocomplete="off">
                                 <div class="handle"></div>
                               </button>
                            </div>  
                            <div class="sn_notificatio">
                               <i class="fa fa-bell"></i>
                               Line Notification
                               <button type="button" class="btn btn-sm btn-toggle active" data-toggle="button" aria-pressed="false" autocomplete="off">
                                 <div class="handle"></div>
                               </button>
                            </div>               
                         </div>
                      </div>
                   </div>
                   <div class="row row-eq-height">
                      <div class="col-lg-4 col-xs-12 flush-left  xs-flush">
                         <div class="card">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                               <li class="nav-item"> <a class="nav-link active" id="activity-tab" data-toggle="tab" href="#activity" role="tab" aria-controls="activity" aria-selected="true">Activity</a>
                               </li>
                               <li class="nav-item"> <a class="nav-link" id="devices-tab" data-toggle="tab" href="#devices" role="tab" aria-controls="devices" aria-selected="false">Devices</a>
                               </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                               <div class="tab-pane fade show active" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                                  <div class="coll_one">
                                     <div class="left_call">
                                        <h6>Web</h6>
                                        <p>2021-05-04 22:19:31</p>
                                     </div>
                                     <div class="right_call">
                                        <h6>Delhi India</h6>
                                        <p>IP: 103.103.162.223</p>
                                     </div>
                                  </div>
                                  <div class="coll_one">
                                     <div class="left_call">
                                        <h6>Web</h6>
                                        <p>2021-05-04 22:19:31</p>
                                     </div>
                                     <div class="right_call">
                                        <h6>Delhi India</h6>
                                        <p>IP: 103.103.162.223</p>
                                     </div>
                                  </div>
                                  <div class="coll_one">
                                     <div class="left_call">
                                        <h6>Web</h6>
                                        <p>2021-05-04 22:19:31</p>
                                     </div>
                                     <div class="right_call">
                                        <h6>Delhi India</h6>
                                        <p>IP: 103.103.162.223</p>
                                     </div>
                                  </div>
                                  <div class="coll_one last">
                                     <div class="left_call">
                                        <h6>Web</h6>
                                        <p>2021-05-04 22:19:31</p>
                                     </div>
                                     <div class="right_call">
                                        <h6>Delhi India</h6>
                                        <p>IP: 103.103.162.223</p>
                                     </div>
                                  </div>
                               </div>
                               <div class="tab-pane fade" id="devices" role="tabpanel" aria-labelledby="devices-tab">...</div>
                            </div>
                         </div>
                      </div>
                      <div class="col-lg-4 col-xs-12 flush-right  xs-flush">
                         <div class="card pd_card sc_card">
                            <h2>Security <span>3/4</span></h2>
                            <hr/>
                            <ul>
                               <li><i class="fa fa-check"></i> Enable 2FA</li>
                               <li><i class="fa fa-check"></i> Verified</li>
                               <li><i class="fa fa-check"></i> Enable Anti-phishing Code</li>
                               <li><i class="fa fa-times"></i> Turn-on withdrawal whitelist <span>Turn On</span></li>
                            </ul>         
                         </div>
                      </div>
                      <div class="col-lg-4 col-xs-12  xs-flush">
                         <div class="card pd_card an_card">
                            <h2>Annoucement</h2>
                            <div class="coll_one">
                               <h6>Date-12/05/2021</h6>
                               <p>Notice Regarding Coin-Margined ETCUSD 
                               Perpetual Contract K-line Adjustment</p>
                            </div>   
                            <div class="coll_one">
                               <h6>Date-12/05/2021</h6>
                               <p>Notice Regarding Coin-Margined ETCUSD 
                               Perpetual Contract K-line Adjustment</p>
                            </div> 
                            <div class="coll_one last">
                               <h6>Date-12/05/2021</h6>
                               <p>Notice Regarding Coin-Margined ETCUSD 
                               Perpetual Contract K-line Adjustment</p>
                            </div>      
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>
 @endsection