  
@extends('layouts.front')
@section('title')
    Route: P2P Trading Platform
@endsection
@section('content')
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

  <section id="toolbar">
      <div class="container">
        <div class="row">
          <div class="col">
            <ul class="main_tool">
              <li>
                <div class="btn-group" role="group" aria-label="Basic example">
                  <button type="button" class="btn btn-secondary active">Buy</button>
                  <button type="button" class="btn btn-secondary">Sell</button>
                </div>
              </li>
              <li>
                <ul class="inner_tool">
                  <li><a href="#" class="active">USDT</a>
                  </li>
                  <li><a href="#">BTC</a>
                  </li>
                  <li><a href="#">BUSD</a>
                  </li>
                  <li><a href="#">ETH</a>
                  </li>
                  <li><a href="#">DAI</a>
                  </li>
                </ul>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </section>
    <section id="filter">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <ul class="search_bar">
              <li>
                <label>Amount</label>
                <br/>
                <form class="form-inline">
                  <input class="form-control mr-sm-2" type="search" placeholder="Enter amount" aria-label="Search"><span>USD</span>
                  <button type="submit" class="btn btn-primary mb-2">Search</button>
                </form>
              </li>
              <li>
                <label>Fiat</label>
                <br/>
                <div class="dropdown currency_two three_coins">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{asset('front/img/bitcoin.png')}}" alt="">
                    <p>USD</p>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <form class="form-inline">
                      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> <span class="icon_ss"><i class="fa fa-search" aria-hidden="true"></i></span>
                    </form>
                    <a class="dropdown-item" href="#">
                      <img src="{{asset('front/img/bitcoin.png')}}" alt="">USD</a>
                    <a class="dropdown-item" href="#">
                      <img src="{{asset('front/img/bitcoin.png')}}" alt="">USD</a>
                    <a class="dropdown-item" href="#">
                      <img src="{{asset('front/img/bitcoin.png')}}" alt="">USD</a>
                    <a class="dropdown-item" href="#">
                      <img src="{{asset('front/img/bitcoin.png')}}" alt="">USD</a>
                  </div>
                </div>
              </li>
              <li>
                <label>Payment</label>
                <br/>
                <div class="dropdown currency_two three_coins">
                  <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img src="{{asset('front/img/tether.png')}}" alt="">
                    <p>All Payment</p>
                  </button>
                  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <form class="form-inline">
                      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> <span class="icon_ss"><i class="fa fa-search" aria-hidden="true"></i></span>
                    </form>
                    <a class="dropdown-item" href="#">
                      <img src="{{asset('front/img/tether.png')}}" alt="">All Payment</a>
                    <a class="dropdown-item" href="#">
                      <img src="{{asset('front/img/tether.png')}}" alt="">All Payment</a>
                    <a class="dropdown-item" href="#">
                      <img src="{{asset('front/img/tether.png')}}" alt="">All Payment</a>
                    <a class="dropdown-item" href="#">
                      <img src="{{asset('front/img/tether.png')}}" alt="">All Payment</a>
                  </div>
                </div>
              </li>
            </ul>
          </div>
          <div class="col-lg-4 text-right">
            <a href="#" class="refresh">
              <img src="{{asset('front/img/refresh.png')}}">Refresh</a>
          </div>
        </div>
      </div>
    </section>
    <section id="content" class="p2p">
      <div class="container">
        <div class="row">
          <div class="col">
            <div class="card">
              <div class="main_data_dable">
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th scope="col" class="res_po">Advertisers</th>
                      <th scope="col">Price</th>
                      <th scope="col">Limit/Available</th>
                      <th scope="col">Payment</th>
                      <th scope="col">Trade <span>0 Fee</span>
                      </th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <th scope="row" class="ft_first">
                        <img src="{{asset('front/img/bitcoin.png')}}" alt="">
                        <div class="right_ssd">⚡ OrianyellaB ⚡
                          <br/> <span class="gray">53 orders  - 84.13% completion</span>
                        </div>
                      </th>
                      <td><span id="bb_btc_p">1.005</span><span>USD</span>
                        <br/><span class="gray">Get on dollar: $0.93</span>
                      </td>
                      <td><span id="bm_btc">Available <span>166.80 USDT</span>
                        <br/>Limit <span>$100.00 - $167.63</span></span>
                      </td>
                      <td>
                        <img src="{{asset('front/img/artm.png')}}">AirTM
                        <br/><span class="tag">receipt requ...</span><span class="tag">online pay...</span><span class="tag">no third par...</span>
                      </td>
                      <td><a href="#" class="table_btn">Buy USDT</a>
                        <br/><span class="gray">Limits: 50,000–250,000 INR</span>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row" class="ft_first">
                        <img src="{{asset('front/img/bitcoin.png')}}" alt="">
                        <div class="right_ssd">⚡ OrianyellaB ⚡
                          <br/> <span class="gray">53 orders  - 84.13% completion</span>
                        </div>
                      </th>
                      <td><span id="bb_btc_p">1.005</span><span>USD</span>
                        <br/><span class="gray">Get on dollar: $0.93</span>
                      </td>
                      <td><span id="bm_btc">Available <span>166.80 USDT</span>
                        <br/>Limit <span>$100.00 - $167.63</span></span>
                      </td>
                      <td>
                        <img src="{{asset('front/img/artm.png')}}">AirTM
                        <br/><span class="tag">receipt requ...</span><span class="tag">online pay...</span><span class="tag">no third par...</span>
                      </td>
                      <td><a href="#" class="table_btn">Buy USDT</a>
                        <br/><span class="gray">Limits: 50,000–250,000 INR</span>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row" class="ft_first">
                        <img src="{{asset('front/img/bitcoin.png')}}" alt="">
                        <div class="right_ssd">⚡ OrianyellaB ⚡
                          <br/> <span class="gray">53 orders  - 84.13% completion</span>
                        </div>
                      </th>
                      <td><span id="bb_btc_p">1.005</span><span>USD</span>
                        <br/><span class="gray">Get on dollar: $0.93</span>
                      </td>
                      <td><span id="bm_btc">Available <span>166.80 USDT</span>
                        <br/>Limit <span>$100.00 - $167.63</span></span>
                      </td>
                      <td>
                        <img src="{{asset('front/img/artm.png')}}">AirTM
                        <br/><span class="tag">receipt requ...</span><span class="tag">online pay...</span><span class="tag">no third par...</span>
                      </td>
                      <td><a href="#" class="table_btn">Buy USDT</a>
                        <br/><span class="gray">Limits: 50,000–250,000 INR</span>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row" class="ft_first">
                        <img src="{{asset('front/img/bitcoin.png')}}" alt="">
                        <div class="right_ssd">⚡ OrianyellaB ⚡
                          <br/> <span class="gray">53 orders  - 84.13% completion</span>
                        </div>
                      </th>
                      <td><span id="bb_btc_p">1.005</span><span>USD</span>
                        <br/><span class="gray">Get on dollar: $0.93</span>
                      </td>
                      <td><span id="bm_btc">Available <span>166.80 USDT</span>
                        <br/>Limit <span>$100.00 - $167.63</span></span>
                      </td>
                      <td>
                        <img src="{{asset('front/img/artm.png')}}">AirTM
                        <br/><span class="tag">receipt requ...</span><span class="tag">online pay...</span><span class="tag">no third par...</span>
                      </td>
                      <td><a href="#" class="table_btn">Buy USDT</a>
                        <br/><span class="gray">Limits: 50,000–250,000 INR</span>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row" class="ft_first">
                        <img src="{{asset('front/img/bitcoin.png')}}" alt="">
                        <div class="right_ssd">⚡ OrianyellaB ⚡
                          <br/> <span class="gray">53 orders  - 84.13% completion</span>
                        </div>
                      </th>
                      <td><span id="bb_btc_p">1.005</span><span>USD</span>
                        <br/><span class="gray">Get on dollar: $0.93</span>
                      </td>
                      <td><span id="bm_btc">Available <span>166.80 USDT</span>
                        <br/>Limit <span>$100.00 - $167.63</span></span>
                      </td>
                      <td>
                        <img src="{{asset('front/img/artm.png')}}">AirTM
                        <br/><span class="tag">receipt requ...</span><span class="tag">online pay...</span><span class="tag">no third par...</span>
                      </td>
                      <td><a href="#" class="table_btn">Buy USDT</a>
                        <br/><span class="gray">Limits: 50,000–250,000 INR</span>
                      </td>
                    </tr>
                    <tr>
                      <th scope="row" class="ft_first">
                        <img src="{{asset('front/img/bitcoin.png')}}" alt="">
                        <div class="right_ssd">⚡ OrianyellaB ⚡
                          <br/> <span class="gray">53 orders  - 84.13% completion</span>
                        </div>
                      </th>
                      <td><span id="bb_btc_p">1.005</span><span>USD</span>
                        <br/><span class="gray">Get on dollar: $0.93</span>
                      </td>
                      <td><span id="bm_btc">Available <span>166.80 USDT</span>
                        <br/>Limit <span>$100.00 - $167.63</span></span>
                      </td>
                      <td>
                        <img src="{{asset('front/img/artm.png')}}">AirTM
                        <br/><span class="tag">receipt requ...</span><span class="tag">online pay...</span><span class="tag">no third par...</span>
                      </td>
                      <td><a href="#" class="table_btn">Buy USDT</a>
                        <br/><span class="gray">Limits: 50,000–250,000 INR</span>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
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
                <img src="{{asset('front/img/plus.png')}}">How to Complete Identity Verification?</a>
            </p>
            <div class="collapse" id="collapseExample">
              <div class="card card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</div>
            </div>
            <br/>
            <p class="faq_step">
              <a data-toggle="collapse" href="#collapseExample2" role="button" aria-expanded="false" aria-controls="collapseExample2">
                <img src="{{asset('front/img/plus.png')}}">How to Buy Cryptocurrency on Route P2P?</a>
            </p>
            <div class="collapse" id="collapseExample2">
              <div class="card card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</div>
            </div>
            <br/>
            <p class="faq_step">
              <a data-toggle="collapse" href="#collapseExample3" role="button" aria-expanded="false" aria-controls="collapseExample3">
                <img src="{{asset('front/img/plus.png')}}">Where can you learn about Crypto Derivatives on Route?</a>
            </p>
            <div class="collapse" id="collapseExample3">
              <div class="card card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</div>
            </div>
            <br/>
            <p class="faq_step">
              <a data-toggle="collapse" href="#collapseExample4" role="button" aria-expanded="false" aria-controls="collapseExample4">
                <img src="{{asset('front/img/plus.png')}}">How to get started with Route Launchpool?</a>
            </p>
            <div class="collapse" id="collapseExample4">
              <div class="card card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</div>
            </div>
          </div>
          <div class="col-lg-6 col-sm-6 col-xs-12">
            <p class="faq_step">
              <a data-toggle="collapse" href="#collapseExample5" role="button" aria-expanded="false" aria-controls="collapseExample5">
                <img src="{{asset('front/img/plus.png')}}">How to Complete Identity Verification?</a>
            </p>
            <div class="collapse" id="collapseExample5">
              <div class="card card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</div>
            </div>
            <br/>
            <p class="faq_step">
              <a data-toggle="collapse" href="#collapseExample6" role="button" aria-expanded="false" aria-controls="collapseExample6">
                <img src="{{asset('front/img/plus.png')}}">How to Buy Cryptocurrency on Route P2P?</a>
            </p>
            <div class="collapse" id="collapseExample6">
              <div class="card card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</div>
            </div>
            <br/>
            <p class="faq_step">
              <a data-toggle="collapse" href="#collapseExample7" role="button" aria-expanded="false" aria-controls="collapseExample7">
                <img src="{{asset('front/img/plus.png')}}">Where can you learn about Crypto Derivatives on Route?</a>
            </p>
            <div class="collapse" id="collapseExample7">
              <div class="card card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</div>
            </div>
            <br/>
            <p class="faq_step">
              <a data-toggle="collapse" href="#collapseExample8" role="button" aria-expanded="false" aria-controls="collapseExample8">
                <img src="{{asset('front/img/plus.png')}}">How to get started with Route Launchpool?</a>
            </p>
            <div class="collapse" id="collapseExample8">
              <div class="card card-body">Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident.</div>
            </div>
          </div>
        </div>
      </div>
    </section>


    @endsection

@section('page_scripts')

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

    @endsection