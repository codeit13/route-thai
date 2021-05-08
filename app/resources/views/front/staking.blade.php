    
@extends('layouts.front')
@section('title')
    Route: P2P Trading Platform
@endsection
@section('content')

@section('header-bar')
  <section id="banner_search" class="locked">
    <div class="container">
      <div class="row">
        <div class="col text-left xs-center">
          <h2>Stake Your Crypto Assets<br>
          and Earn Rewards</h2>
          <p>Route provides an all-in-one staking solution. Let us do the work,
            <br>while you earn the rewards</p>
        </div>
      </div>
    </div>
  </section>
  <section id="locked_staking">
    <div class="locked-head">
      <div class="container">
        <div class="row">
          <div class="col text-left">
            <ul>
              <li class="active"><a href="#">Locked Staking</a>
              </li>
              <li><a href="#">DeFi Staking</a>
              </li>
              <li><a href="#">Wallet</a>
              </li>
              <li><a href="#">Exchanges</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
          <table>
            <thead>
              <tr>
                <th>Token</th>
                <th>Est. APY</th>
                <th>Duration (days)</th>
                <th class="img-p">
                  <img src="{{asset('front/img/icon-4.png')}}" alt="" />&nbsp; Minimum Locked Amount</th>
                <th></th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <img src="{{asset('front/img/bitcoin.png')}}" alt="" />Bitcoin</td>
                <td class="green">
                  <label class="visible-xs">Est. APY</label>14.79%</td>
                <td>  <a class="green">30</a>
                  <a>60</a>
                  <a>90</a>
                </td>
                <td>0.1BTC</td>
                <td><a href="#" class="table_btn" data-toggle="modal" data-target="#myModal2">Stake Now</a>
                </td>
              </tr>
              <tr>
                <td>
                  <img src="{{asset('front/img/icon-5.png')}}" alt="" />Ethereum</td>
                <td class="green">
                  <label class="visible-xs">Est. APY</label>10.79%</td>
                <td>
                  <label class="visible-xs">Duration (days)</label> <a class="green">30</a>
                  <a>60</a>
                  <a>90</a>
                </td>
                <td>0.1ETH</td>
                <td><a href="#" class="table_btn">Stake Now</a>
                </td>
              </tr>
              <tr>
                <td>
                  <img src="{{asset('front/img/icon-6.png')}}" alt="" />Binance</td>
                <td class="green">
                  <label class="visible-xs">Est. APY</label>5.99%</td>
                <td>
                  <label class="visible-xs">Duration (days)</label> <a class="green">30</a>
                  <a>60</a>
                  <a>90</a>
                </td>
                <td>0.1BNB</td>
                <td><a href="#" class="table_btn">Stake Now</a>
                </td>
              </tr>
              <tr>
                <td>
                  <img src="{{asset('front/img/icon-7.png')}}" alt="" />BUSD</td>
                <td class="green">
                  <label class="visible-xs">Est. APY</label>3.79%</td>
                <td>
                  <label class="visible-xs">Duration (days)</label> <a class="green">30</a>
                  <a>60</a>
                  <a>90</a>
                </td>
                <td>0.1BUSD</td>
                <td><a href="#" class="table_btn">Stake Now</a>
                </td>
              </tr>
              <tr>
                <td>
                  <img src="{{asset('front/img/icon-8.png')}}" alt="" />TEZOS</td>
                <td class="green">
                  <label class="visible-xs">Est. APY</label>5.5%</td>
                <td>
                  <label class="visible-xs">Duration (days)</label> <a class="green">30</a>
                  <a>60</a>
                  <a>90</a>
                </td>
                <td>0.1TEZ</td>
                <td><a href="#" class="table_btn">Stake Now</a>
                </td>
              </tr>
              <tr>
                <td>
                  <img src="{{asset('front/img/bitcoin.png')}}" alt="" />Bitcoin</td>
                <td class="green">
                  <label class="visible-xs">Est. APY</label>14.79%</td>
                <td>  <a class="green">30</a>
                  <a>60</a>
                  <a>90</a>
                </td>
                <td>0.1BTC</td>
                <td><a href="#" class="table_btn">Stake Now</a>
                </td>
              </tr>
              <tr>
                <td>
                  <img src="{{asset('front/img/icon-5.png')}}" alt="" />Ethereum</td>
                <td class="green">
                  <label class="visible-xs">Est. APY</label>10.79%</td>
                <td>
                  <label class="visible-xs">Duration (days)</label> <a class="green">30</a>
                  <a>60</a>
                  <a>90</a>
                </td>
                <td>0.1ETH</td>
                <td><a href="#" class="table_btn">Stake Now</a>
                </td>
              </tr>
              <tr>
                <td>
                  <img src="{{asset('front/img/icon-6.png')}}" alt="" />Binance</td>
                <td class="green">
                  <label class="visible-xs">Est. APY</label>5.99%</td>
                <td>
                  <label class="visible-xs">Duration (days)</label> <a class="green">30</a>
                  <a>60</a>
                  <a>90</a>
                </td>
                <td>0.1BNB</td>
                <td><a href="#" class="table_btn">Stake Now</a>
                </td>
              </tr>
              <tr>
                <td>
                  <img src="{{asset('front/img/icon-7.png')}}" alt="" />BUSD</td>
                <td class="green">
                  <label class="visible-xs">Est. APY</label>3.79%</td>
                <td>
                  <label class="visible-xs">Duration (days)</label> <a class="green">30</a>
                  <a>60</a>
                  <a>90</a>
                </td>
                <td>0.1BUSD</td>
                <td><a href="#" class="table_btn">Stake Now</a>
                </td>
              </tr>
              <tr>
                <td>
                  <img src="{{asset('front/img/icon-8.png')}}" alt="" />TEZOS</td>
                <td class="green">
                  <label class="visible-xs">Est. APY</label>5.5%</td>
                <td>
                  <label class="visible-xs">Duration (days)</label> <a class="green">30</a>
                  <a>60</a>
                  <a>90</a>
                </td>
                <td>0.1TEZ</td>
                <td><a href="#" class="table_btn">Stake Now</a>
                </td>
              </tr>
              <tr>
                <td class="text-center size" colspan="5">Expand all 20 Locked Staking products</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="col-lg-12 top-tb col-sm-12 col-xs-12">
          <p>* current average staking return per protocol</p>
        </div>
      </div>
    </div>
  </section>
  <section id="below-port" class="locked-below">
    <div class="container">
      <div class="row">
        <div class="col text-center">
          <h3>GET STARTED EASILY</h3>
          <p class="main_pre">Route makes it easy to earn rewards with staking.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-xs-12 col-sm-4 text-center">
          <img src="{{asset('front/img/icon-1.png')}}" alt="">
          <h4>Sign Up & Request the<br>
          Staking Contract</h4>
          <p>Fill in your details and upload the required identity documents. Request and sign the staking contract.</p>
        </div>
        <div class="col-lg-4 col-xs-12 col-sm-4 text-center">
          <img src="{{asset('front/img/icon-2.png')}}" alt="">
          <h4>Fund Your Account</h4>
          <p>After successful onboarding, you can fund your account via bank or crypto transfer.</p>
        </div>
        <div class="col-lg-4 col-xs-12 col-sm-4 text-center">
          <img src="{{asset('front/img/icon-3.png')}}" alt="">
          <h4>Start Earning</h4>
          <p>Start earning staking rewards directly in your Route Online Account.</p>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 text-center col-sm-12 col-xs-12"> <a href="#" class="btn-info">Get Started</a>
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