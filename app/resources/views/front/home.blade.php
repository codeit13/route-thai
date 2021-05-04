@extends('layouts.front')
@section('title')
    Route: P2P Trading Platform
@endsection
@section('content')
<section id="banner_search">
    <div class="container">
       <div class="row">
          <div class="col text-center xs-left">
             <h2>Buy and Sell cryptocurrency</h2>
             <p>Join the world's largest crypto exchange. Designed for India</p>
             <form class="form-inline">
                <input class="form-control mr-sm-2" type="search" placeholder="Enter your email address" aria-label="Search">
                <button type="submit" class="btn btn-primary mb-2">Register Now</button>
             </form>
          </div>
       </div>
    </div>
 </section>
 <section id="main-content">
    <div class="container">
       <div class="row row-eq-height">
          <ul class="bxslider">
             <li class="col-lg-3 col-sm-3 col-xs-12">
                <div class="card">
                   <div class="row">
                      <div class="col-lg-2 col-sm-2 flush col-2">
                         <img class="slide_box" src="{{ asset('front/img/bitcoin.png') }}" alt="">
                      </div>
                      <div class="col-lg-7 col-sm-7 col-7">
                         <h6 id="ada_coin">BTC / THB</h6>
                         <h2><span id="thb_ada_price" style="font-size: 20px;">1,797,994.87</span></h2>
                         <p>Volume: <span><span id="thb_ada_volume">6,447,291.85 USD</span></p>
                      </div>
                      <div class="col-lg-3 col-sm-3 flush col-3 text-right">
                         <span class="text-green side_span">+0.73%</span>
                      </div>
                   </div>
                </div>
             </li>
             <li class="col-lg-3 col-sm-3 col-xs-12">
                <div class="card">
                   <div class="row">
                      <div class="col-lg-2 col-sm-2 flush col-2">
                         <img class="slide_box" src="{{ asset('front/img/tether.png') }}" alt="">
                      </div>
                      <div class="col-lg-7 col-sm-7 col-7">
                         <h6 id="ada_coin">USDT / THB</h6>
                         <h2><span id="thb_ada_price" style="font-size: 20px;">31.17</span></h2>
                         <p>Volume: <span><span id="thb_ada_volume">6,447,291.85 USD</span></p>
                      </div>
                      <div class="col-lg-3 col-sm-3 flush col-3 text-right">
                         <span class="text-green side_span">+0.13%</span>
                      </div>
                   </div>
                </div>
             </li>
             <li class="col-lg-3 col-sm-3 col-xs-12">
                <div class="card">
                   <div class="row">
                      <div class="col-lg-2 col-sm-2 flush col-2">
                         <img class="slide_box" src="{{ asset('front/img/cardan.png') }}" alt="">
                      </div>
                      <div class="col-lg-7 col-sm-7 col-7">
                         <h6 id="ada_coin">ADA / THB</h6>
                         <h2><span id="thb_ada_price" style="font-size: 20px;">37.29</span></h2>
                         <p>Volume: <span><span id="thb_ada_volume">6,447,291.85 USD</span></p>
                      </div>
                      <div class="col-lg-3 col-sm-3 flush col-3 text-right">
                         <span class="text-green side_span">+0.73%</span>
                      </div>
                   </div>
                </div>
             </li>
             <li class="col-lg-3 col-sm-3 col-xs-12">
                <div class="card">
                   <div class="row">
                      <div class="col-lg-2 col-sm-2 flush col-2">
                         <img class="slide_box" src="{{ asset('front/img/2405.png') }}" alt="">
                      </div>
                      <div class="col-lg-7 col-sm-7 col-7">
                         <h6 id="ada_coin">IOST / THB</h6>
                         <h2><span id="thb_ada_price" style="font-size: 20px;">1.64</span></h2>
                         <p>Volume: <span><span id="thb_ada_volume">6,447,291.85 USD</span></p>
                      </div>
                      <div class="col-lg-3 col-sm-3 flush col-3 text-right">
                         <span class="text-green side_span">-8.38</span>
                      </div>
                   </div>
                </div>
             </li>
          </ul>
       </div>
    </div>
 </section>
 <section id="content">
    <div class="container">
       <div class="row">
          <div class="col xs-card">
             <div class="card">
                <div class="main_data_dable">
                   <table class="table table-striped table-hover">
                      <thead>
                         <tr>
                            <th scope="col" class="res_po">Name</th>
                            <th scope="col">Last Price</th>
                            <th scope="col">24h Change</th>
                            <th scope="col">&nbsp;</th>
                            <th scope="col">Markets</th>
                         </tr>
                      </thead>
                      <tbody>
                         <tr>
                            <th scope="row" class="ft_first"><img src="{{ asset('front/img/bitcoin.png') }}" alt=""> BTC <span>Bitcoin</span></th>
                            <td><span id="bb_btc_p">$ 55064.14</span></td>
                            <td><span id="bm_btc" class="text-red">-0.75%</span></td>
                            <td><img src="{{ asset('front/img/Image 12') }}.png"></td>
                            <td><a href="#" class="table_btn">Buy</a></td>
                         </tr>
                         <tr>
                            <th scope="row" class="ft_first"><img src="{{ asset('front/img/ethereum.png') }}" alt=""> ETH <span>Ethereum</span></th>
                            <td><span id="bb_btc_p">$2,095.81</span></td>
                            <td><span id="bm_btc" class="text-green">+5.26%</span></td>
                            <td><img src="{{ asset('front/img/Image 12') }}.png"></td>
                            <td><a href="#" class="table_btn">Buy</a></td>
                         </tr>
                         <tr>
                            <th scope="row" class="ft_first"><img src="{{ asset('front/img/bnb.png') }}" alt=""> BNB <span>BNB</span></th>
                            <td><span id="bb_btc_p">$339.63</span></td>
                            <td><span id="bm_btc" class="text-red">-0.75%</span></td>
                            <td><img src="{{ asset('front/img/Image 12') }}.png"></td>
                            <td><a href="#" class="table_btn">Buy</a></td>
                         </tr>
                         <tr>
                            <th scope="row" class="ft_first"><img src="{{ asset('front/img/busd.png') }}" alt=""> BUSD <span>BNB</span></th>
                            <td><span id="bb_btc_p">$1.99</span></td>
                            <td><span id="bm_btc" class="text-green">-0.75%</span></td>
                            <td><img src="{{ asset('front/img/Image 12') }}.png"></td>
                            <td><a href="#" class="table_btn">Buy</a></td>
                         </tr>
                      </tbody>
                   </table>
                   <div class="side_center text-center">
                      <a href="#">View more markets</a>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>
 <section id="portfolio">
    <div class="container">
       <div class="row">
          <div class="col text-center">
             <h2>Create your <span>cryptocurrency portfolio</span> today</h2>
             <p>Route has a variety of features that make it the best place to start trading</p>
          </div>
       </div>
       <div class="row">
          <div class="col-lg-4 col-sm-5 col-xs-4 text-center">
             <div class="inner_div">
                <img src="{{ asset('front/img/bar-chart') }}.png" alt="">
                <div class="side_inner">
                   <h3>Manage your portfolio</h3>
                   <p>Buy and sell popular digital currencies,
                      keep track of them in the one place.
                   </p>
                </div>
             </div>
             <div class="inner_div">
                <img src="{{ asset('front/img/calendar.png') }}" alt="">
                <div class="side_inner">
                   <h3>Recurring buys</h3>
                   <p>Invest in cryptocurrency slowly over time 
                      by scheduling buys daily, weekly, or monthly.
                   </p>
                </div>
             </div>
             <div class="inner_div">
                <img src="{{ asset('front/img/folder.png') }}" alt="">
                <div class="side_inner">
                   <h3>Vault protection</h3>
                   <p>For added security, store your funds in a 
                      vault with time delayed withdrawals.
                   </p>
                </div>
             </div>
             <div class="inner_div">
                <img src="{{ asset('front/img/message.png') }}" alt="">
                <div class="side_inner">
                   <h3>Mobile apps</h3>
                   <p>Stay on top of the markets with the Route
                      app for Android or iOS.
                   </p>
                </div>
             </div>
          </div>
          <div class="col-lg-8 col-sm-7 col-xs-8 text-center">
             <img src="{{ asset('front/img/portfolio.png') }}">
          </div>
       </div>
    </div>
 </section>
 <section id="below-port">
    <div class="container-fluid">
       <div class="row">
          <div class="col text-center">
             <h3>Start your crypto journey with a partner you can trust</h3>
             <p class="main_pre">Elevate your financial freedom to a higher plane with route.</p>
          </div>
       </div>
       <div class="row">
          <div class="col-lg-3 col-xs-12 col-sm-3 text-center">
             <img src="{{ asset('front/img/offer.png') }}" alt="">
             <h4>Zero-Fee purchase</h4>
             <p>Buy cryptocurrencies using Indian Rupees (INR) with 0 transaction fees on Route P2P!</p>
          </div>
          <div class="col-lg-3 col-xs-12 col-sm-3 text-center">
             <img src="{{ asset('front/img/stock-market') }}.png" alt="">
             <h4>Lowest trading fee</h4>
             <p>Our low fees and attractive VIP program beat the competition. Enjoy some of the lowest transaction fees in India.</p>
          </div>
          <div class="col-lg-3 col-xs-12 col-sm-3 text-center">
             <img src="{{ asset('front/img/laptop.png') }}" alt="">
             <h4>Ironclad security</h4>
             <p>Our complex security measurements and SAFU fund protect your data and assets against all risks.</p>
          </div>
          <div class="col-lg-3 col-xs-12 col-sm-3 text-center">
             <img src="{{ asset('front/img/customer-service') }}.png" alt="">
             <h4>Customer support</h4>
             <p>Route provides you with the service you need with our knowledgable and experienced customer support team.</p>
          </div>
       </div>
    </div>
 </section>
 <section id="gs-div">
    <div class="container">
       <div class="row">
          <div class="col text-center">
             <h2>Getting started</h2>
             <p>Learn how to start trading cryptocurrency today.</p>
          </div>
       </div>
       <div class="row">
          <div class="col text-center">
             <ul class="nav nav-tabs" id="myTab" role="tablist">
               <li class="nav-item">
                 <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Buy Crypto</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Learn about Cryptocurrency</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Trade</a>
               </li>
               <li class="nav-item">
                 <a class="nav-link" id="earn-tab" data-toggle="tab" href="#earn" role="tab" aria-controls="earn" aria-selected="false">Earn</a>
               </li>
             </ul>
             <div class="tab-content" id="myTabContent">
               <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                  <div class="row">
                      <div class="col-lg-4 col-xs-12 colsm-4 text-center">
                         <a href="#">
                            <img src="{{ asset('front/img/Mask Group') }} 1.png">
                            <p>Buy Crypto in India on Route</p>
                         </a>
                      </div>
                      <div class="col-lg-4 col-xs-12 colsm-4 text-center">
                         <a href="#">
                            <img src="{{ asset('front/img/Mask Group') }} 2.png">
                            <p>What is P2P trading?</p>
                         </a>
                      </div>
                      <div class="col-lg-4 col-xs-12 colsm-4 text-center">
                         <a href="#">
                            <img src="{{ asset('front/img/Mask Group') }} 3.png">
                            <p>Buy and transfer cryptocurrency via WazirX</p>
                         </a>
                      </div>
                   </div>
               </div>
               <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                  <div class="row">
                      <div class="col-lg-4 col-xs-12 colsm-4 text-center">
                         <a href="#">
                            <img src="{{ asset('front/img/Mask Group') }} 1.png">
                            <p>Buy Crypto in India on Route</p>
                         </a>
                      </div>
                      <div class="col-lg-4 col-xs-12 colsm-4 text-center">
                         <a href="#">
                            <img src="{{ asset('front/img/Mask Group') }} 2.png">
                            <p>What is P2P trading?</p>
                         </a>
                      </div>
                      <div class="col-lg-4 col-xs-12 colsm-4 text-center">
                         <a href="#">
                            <img src="{{ asset('front/img/Mask Group') }} 3.png">
                            <p>Buy and transfer cryptocurrency via WazirX</p>
                         </a>
                      </div>
                   </div>
               </div>
               <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                  <div class="row">
                      <div class="col-lg-4 col-xs-12 colsm-4 text-center">
                         <a href="#">
                            <img src="{{ asset('front/img/Mask Group') }} 1.png">
                            <p>Buy Crypto in India on Route</p>
                         </a>
                      </div>
                      <div class="col-lg-4 col-xs-12 colsm-4 text-center">
                         <a href="#">
                            <img src="{{ asset('front/img/Mask Group') }} 2.png">
                            <p>What is P2P trading?</p>
                         </a>
                      </div>
                      <div class="col-lg-4 col-xs-12 colsm-4 text-center">
                         <a href="#">
                            <img src="{{ asset('front/img/Mask Group') }} 3.png">
                            <p>Buy and transfer cryptocurrency via WazirX</p>
                         </a>
                      </div>
                   </div>
               </div>
               <div class="tab-pane fade" id="earn" role="tabpanel" aria-labelledby="earn-tab">
                  <div class="row">
                      <div class="col-lg-4 col-xs-12 colsm-4 text-center">
                         <a href="#">
                            <img src="{{ asset('front/img/Mask Group') }} 1.png">
                            <p>Buy Crypto in India on Route</p>
                         </a>
                      </div>
                      <div class="col-lg-4 col-xs-12 colsm-4 text-center">
                         <a href="#">
                            <img src="{{ asset('front/img/Mask Group') }} 2.png">
                            <p>What is P2P trading?</p>
                         </a>
                      </div>
                      <div class="col-lg-4 col-xs-12 colsm-4 text-center">
                         <a href="#">
                            <img src="{{ asset('front/img/Mask Group') }} 3.png">
                            <p>Buy and transfer cryptocurrency via WazirX</p>
                         </a>
                      </div>
                   </div>
               </div>
             </div>
          </div>
       </div>
    </div>
 </section>
 <section id="download">
    <div class="container">
       <div class="row">
          <div class="col-lg-6 col-xs-12 col-sm-6">
             <div class="dd_content">
                <span>DOWNLOAD APP</span>
                <h2>Enros app for better crypto
                currency platform.</h2>
                <p>This should be used to tell a story and let your users know a little more 
                about your product or service. How can you benefit them?
                convince them to use your service.</p>
                <a href="#"><img src="{{ asset('front/img/appstore.png') }}" alt=""></a>
                <a href="#"><img src="{{ asset('front/img/playstore.png') }}" alt=""></a>
             </div>      
          </div>
          <div class="col-lg-6 col-xs-12 col-sm-6 text-center">
             <img class="main" src="{{ asset('front/img/download-moc') }}.png">
          </div>
       </div>
    </div>
 </section>
 <section id="faq">
    <div class="container">
       <div class="row">
          <div class="col-lg-12 col-xs-12 col-sm-12 text-center">
             <h2>frequently asked questions</h2>
          </div>
       </div>
       <div class="row">
          <div class="col-lg-6 col-sm-6 col-xs-12">
             <p class="faq_step">
               <a data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
                 <img src="{{ asset('front/img/plus.png') }}"> How to Complete Identity Verification?
               </a>
             </p>
             <div class="collapse" id="collapseExample">
               <div class="card card-body">
                 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
               </div>
             </div>
             <br/>
             <p class="faq_step">
               <a data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
                 <img src="{{ asset('front/img/plus.png') }}"> How to Buy Cryptocurrency on Route P2P?
               </a>
             </p>
             <div class="collapse" id="collapseExample2">
               <div class="card card-body">
                 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
               </div>
             </div>
             <br/>
             <p class="faq_step">
               <a data-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample3">
                 <img src="{{ asset('front/img/plus.png') }}"> Where can you learn about Crypto Derivatives on Route?
               </a>
             </p>
             <div class="collapse" id="collapseExample3">
               <div class="card card-body">
                 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
               </div>
             </div>
             <br/>
             <p class="faq_step">
               <a data-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false" aria-controls="collapseExample4">
                 <img src="{{ asset('front/img/plus.png') }}"> How to get started with Route Launchpool?
               </a>
             </p>
             <div class="collapse" id="collapseExample4">
               <div class="card card-body">
                 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
               </div>
             </div>
          </div>
          <div class="col-lg-6 col-sm-6 col-xs-12">
             <p class="faq_step">
               <a data-toggle="collapse" href="#collapseExample5" role="button" aria-expanded="false" aria-controls="collapseExample5">
                 <img src="{{ asset('front/img/plus.png') }}"> How to Complete Identity Verification?
               </a>
             </p>
             <div class="collapse" id="collapseExample5">
               <div class="card card-body">
                 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
               </div>
             </div>
             <br/>
             <p class="faq_step">
               <a data-toggle="collapse" href="#collapseExample6" role="button" aria-expanded="false" aria-controls="collapseExample6">
                 <img src="{{ asset('front/img/plus.png') }}"> How to Buy Cryptocurrency on Route P2P?
               </a>
             </p>
             <div class="collapse" id="collapseExample6">
               <div class="card card-body">
                 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
               </div>
             </div>
             <br/>
             <p class="faq_step">
               <a data-toggle="collapse" href="#collapseExample7" role="button" aria-expanded="false" aria-controls="collapseExample7">
                 <img src="{{ asset('front/img/plus.png') }}"> Where can you learn about Crypto Derivatives on Route?
               </a>
             </p>
             <div class="collapse" id="collapseExample7">
               <div class="card card-body">
                 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
               </div>
             </div>
             <br/>
             <p class="faq_step">
               <a data-toggle="collapse" href="#collapseExample8" role="button" aria-expanded="false" aria-controls="collapseExample8">
                 <img src="{{ asset('front/img/plus.png') }}"> How to get started with Route Launchpool?
               </a>
             </p>
             <div class="collapse" id="collapseExample8">
               <div class="card card-body">
                 Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.
               </div>
             </div>
          </div>
       </div>            
    </div>
 </section>
 <div class="modal alert_poup fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
       <div class="modal-content">
          <div class="modal-header">
             <button type="button" class="close" data-dismiss="modal" aria-label="Close">
             <span aria-hidden="true">&times;</span>
             </button>
          </div>
          <div class="modal-body">
             <img src="{{ asset('front/img/Image 17.png') }}" class="header_img" alt="">
             <img src="{{ asset('front/img/coin_base.svg')}}" class="header_img"  alt="">
             <img src="{{ asset('front/img/bitCoinBig.svg')}}" class="header_img"  alt="">
             <h2>10.99%</h2>
             <a href="#" class="btn-primary btn" class="close" data-dismiss="modal" aria-label="Close">Close this alert</a>
          </div>
       </div>
    </div>
 </div>
@endsection

@section('page_scripts')
<script> 
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
    });
</script>
@endsection     
