@extends('layouts.front')
@section('title')
Route: P2P Trading Platform
@endsection
@section('page_styles')
    <style type="text/css" media="screen">
        #content.p2p .right_ssd{
            width: 81%;
        }
    </style>
    <link rel="stylesheet" href="front/arbitragecss/arbitrage.css">
@stop
@section('content')

<section id="main-content" class="arbitrage">
 <!-- Modal for Exchange filter -->
 <div class="modal fade" id="exchangeSelectCenter" tabindex="-1" role="dialog" aria-labelledby="exchangeSelectCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header flex-column mt-5 mt-md-2 pb-0">
              <h5 class="modal-title" id="exampleModalLongTitle">Select Exchanges</h5>
              <p class="text-danger m-0" style="font-size:10px;">* Select minimum 3 Exchanges to apply filter</p>
              <form class="form-inline mt-3 w-100">
                <input class="form-control mr-sm-2 w-100"  type="search" placeholder="Search" aria-label="Search">
                <span><i class="fa fa-search search-icon" aria-hidden="true"></i></span>
              </form>
            <button type="button" style="padding-top: 0.65rem;" class="close mt-5 mt-md-1" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="Exhange-menu">
            <div id="ex-data-img" class="row text-left font-weight-bold row-cols-4 row-cols-sm-1">           
            </div> 
          </div>
        </div>
      </div>
    </div>
    <!-- Modal for coin filter -->
    <div class="modal fade" id="coinSelectCenter" tabindex="-1" role="dialog" aria-labelledby="coinSelectCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
        <div class="modal-content">
          <div class="modal-header flex-column mt-5 mt-md-2">
              <h5 class="modal-title" id="exampleModalLongTitle">Select Coins</h5>
              <form class="form-inline mt-3 w-100">
                <input class="form-control mr-sm-2 w-100"  type="search" placeholder="Search" aria-label="Search">
                <span><i class="fa fa-search search-icon" aria-hidden="true"></i></span>
              </form>
            <button type="button" style="padding-top: 0.65rem;" class="close mt-5 mt-md-1" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="Coin-menu">
            <div id="coin-data-img" class="row text-left font-weight-bold row-cols-4 row-cols-sm-1">
            </div>
          </div>
        </div>
      </div>
    </div>
  <div class="container">
    <div class="row">
      <div class="col text-center">
        <h1>Top CryptoAlerts Spot Exchanges</h1>
        <p>CryptoAlert ranks and scores exchanges based on traffic, liquidity, trading volumes, and confidence in the
          legitimacy of trading volumes reported.</p>
      </div>
    </div>
    <div class="row row-eq-height">
      <ul class="bxslider">
        <li class="col-lg-3 col-sm-3 col-xs-12">
          <div class="card">
            <div class="row">
              <div class="col-lg-8 col-sm-8 col-8">
                <h6 id="ada_coin">THB ADA</h6>
                <h2><span id="thb_ada_price" style="font-size: 20px;">37.09</span></h2>
              </div>
              <div class="col-lg-4 col-sm-4 flush col-4">
                <img class="chart" src="http://crypto.supremeganesh.com/public/img/chart.png" alt="">
              </div>
            </div>
            <p><span><span id="thb_ada_percent">-0.4</span> %</span> Volume: <span
                id="thb_ada_volume">3099232.0141884</span></p>
          </div>
        </li>
        <li class="col-lg-3 col-sm-3 col-xs-12">
          <div class="card">
            <div class="row">
              <div class="col-lg-8 col-sm-8 col-8">
                <h6 id="ada_coin">THB ADA</h6>
                <h2><span id="thb_ada_price" style="font-size: 20px;">37.09</span></h2>
              </div>
              <div class="col-lg-4 col-sm-4 flush col-4">
                <img class="chart" src="http://crypto.supremeganesh.com/public/img/chart.png" alt="">
              </div>
            </div>
            <p><span><span id="thb_ada_percent">-0.4</span> %</span> Volume: <span
                id="thb_ada_volume">3099232.0141884</span></p>
          </div>
        </li>
        <li class="col-lg-3 col-sm-3 col-xs-12">
          <div class="card">
            <div class="row">
              <div class="col-lg-8 col-sm-8 col-8">
                <h6 id="ada_coin">THB ADA</h6>
                <h2><span id="thb_ada_price" style="font-size: 20px;">37.09</span></h2>
              </div>
              <div class="col-lg-4 col-sm-4 flush col-4">
                <img class="chart" src="http://crypto.supremeganesh.com/public/img/chart.png" alt="">
              </div>
            </div>
            <p><span><span id="thb_ada_percent">-0.4</span> %</span> Volume: <span
                id="thb_ada_volume">3099232.0141884</span></p>
          </div>
        </li>

        <li class="col-lg-3 col-sm-3 col-xs-12">
          <div class="card">
            <div class="row">
              <div class="col-lg-8 col-sm-8 col-8">
                <h6 id="ada_coin">THB ADA</h6>
                <h2><span id="thb_ada_price" style="font-size: 20px;">37.09</span></h2>
              </div>
              <div class="col-lg-4 col-sm-4 flush col-4">
                <img class="chart" src="http://crypto.supremeganesh.com/public/img/chart.png" alt="">
              </div>
            </div>
            <p><span><span id="thb_ada_percent">-0.4</span> %</span> Volume: <span
                id="thb_ada_volume">3099232.0141884</span></p>
          </div>
        </li>
      </ul>
    </div>
  </div>
</section>
<section id="content">
  <div class="container-fluid">
    <h2 class="heading">Crypto<span>Alert</span></h2>
    <div class="row">
      <div class="col flush">
        <div class="card">
        <div class="main_head">
              <div class="row align-items-center justify-content-between">
                <div class="col-lg-6">
                  <div class="row">
                    <div class="col-4">
                      <div class="dropdown currency_two three_coins" width='100%' id="exchange">
                        <button class="btn btn-secondary dropdown-toggle" style="width: 100%;" value="BITKUB"
                          type="button" id="dropdownBaseExchange" data-toggle="dropdown" aria-haspopup="true"
                          aria-expanded="false">
                          <img src="img/bitkub.svg" alt="">Bitkub</button>

                        <div class="dropdown-menu" style="width:100%" aria-labelledby="dropdownBaseExchange">
                          <form class="form-inline">
                            <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                            <span><i class="fa fa-search" aria-hidden="true"></i></span>
                          </form>
                          <!-- This dropdown is populated using javascript -->
                        </div>
                      </div>
                      </div>
                      <div class="col-4">
                       <!-- Button trigger exchange filter modal -->
                       <button type="button" style="font-size:14px;" class="btn btn-secondary btn-block" data-toggle="modal" data-target="#exchangeSelectCenter">
                          Exchange
                          <i class="fa fa-star-o"></i>
                        </button>
                    </div>
                   <div class="col-4 align-items-center">
                      <!-- Button trigger coin filter modal -->
                      <button type="button" class="btn btn-secondary mr-1 btn-block" data-toggle="modal" data-target="#coinSelectCenter">
                        Coin
                        <i class="fa fa-star-o"></i>
                      </button>
                      </div>

                       <!-- 
                      <button type="button" id="toggleFav" style="width: 100%; font-size: 1em;" class="btn btn-outline-primary btn-block"><i
                          class="fa fa-star-o" aria-hidden="true"></i> Watchlist</button>
                     -->
                    
                  </div>
                </div>
                <div class="col-1 pl-0 d-flex justify-content-lg-end justify-content-sm-center">
                  
                </div>
                <div class="col-lg-5 ml-auto justify-content-lg-right">
                  <div class="row table-row">
                    <div class="col-12">
                      <div class="row align-items-center justify-content-around justify-content-lg-end">
                    <!-- <div class="col-6 "> -->
                      
                            <form class="form-inline align-self-center mr-2">
                              <a href="javascript:;" style="border-radius: 4px;
                              background-color: #6c757d;
                              color: white;
                              width: 35px;
                              height: 35px;
                              display: flex;
                              align-items: center;
                              text-decoration: none;
                              justify-content: center;" class="actions-drop-main" id="dropdownMenuLink" data="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-paint-brush"
                                aria-hidden="true" ></i></a>
                                
                                <div class="dropdown-menu custome-class p-0" aria-labelledby="dropdownMenuLink" id="range-dropdown">
                                    <div class="py-3">
                                      <h6 class="pl-4 pb-3">Color Settings</h6>
                                      <div class="range-percent ml-4">
                                    <div class="d-flex align-items-center addrange" id="range-row-0">
                                      <div class="mb-3 pr-3">
                                        <input type="number" id="min-value-0" style="width: 80px;height: 35px;" class="form-control" placeholder="Min">
                                      </div>
                                      <div class="mb-3 pr-3">
                                        <span class="font-weight-bold">-</span>
                                      </div>
                                      <div class="mb-3 pr-3">
                                        <input type="number" id="max-value-0" style="width: 80px;height: 35px;" class="form-control" placeholder="Max">
                                      </div>
                                      <div class="mb-3 pr-3">
                                        <input type="color" id="set-color-0" class="form-control p-0 border-0 rounded-circle selectcolor" style="box-shadow: none !important;">
                                      </div>
                                      </div>
                                    </div>
                                    <div class="d-flex align-items-center justify-content-center mb-3 mr-4">
                                      <button style="width: 40px; height: 40px;" class="btn bg-transparent add-more-range text-primary"><i class="fa fa-plus"></i></button>
                                    </div>
                                    <div class="d-flex justify-content-center mx-4 ml-md-0">
                                      <a id="change-color" class="btn btn-primary">Submit</a>
                                      <a id="cancel-color" class="btn btn-outline-primary ml-2">Reset</a>
                                    </div>
                                  </div>
                                </div>
                            </form>
                        <!-- <p class="d-none d-md-block">show rows</p> -->
                          <select class="custom-select">
                            <option value="all">All</option>
                            <option value="10">10</option>
                            <option value="25">25</option>
                            <option value="50">50</option>
                          </select>
                    <!-- </div> -->
                    <div class="col-6">
                      <form class="form-inline" style="width:100%">
                        <input class="form-control mr-sm-2" style="width: 100%;" id="tablesearchinput" type="search"
                          placeholder="Coin" aria-label="Search"> <span><i class="fa fa-search search-icon"
                            aria-hidden="true"></i></span>
                      </form>
                    </div>
                  </div>
                  </div>
                  </div>
                </div>
              </div>
            </div>
          
          <div class="main_data_dable">
            <table id="main_data_table" class="table table-hover p-0" style="width: 100%">
              <thead id="currency_header">
                <tr id="currency_header_row">
                  <!-- <th scope="col"></th> -->
                  <th scope="col" class="res_po"><span class="d-none d-sm-none d-md-block">Crypto </span>Coin</th>
                </tr>
              </thead>
              <tbody id="currencytable_body"></tbody>
            </table>
          </div>
        </div>

        </div>
      </div>
    </div>
  </div>

</section>
<!-- Modal -->
<div class="modal alert_poup fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span
            aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img src='front/arbitrageimg/Image 17.png' class="header_img" alt="">
        <img src='front/arbitrageimg/coin_base.svg' class="header_img" alt="">
        <img src='front/arbitrageimg/bitCoinBig.svg' class="header_img" alt="">
        <h2>10.99%</h2>
        <a href="#" class="btn-primary btn" class="close" data-dismiss="modal" aria-label="Close">Close this alert</a>
      </div>
    </div>
  </div>
</div>
<div class="alertbox">
  <div class="alert_head">
    <h2>Alerts</h2>
    <div class="actions">
      <a href="#">
        <img src="front/arbitrageimg/settings.svg" alt="">
      </a>
      <a href="#" id="plus_show_div" class="hide_tab">
        <img src="front/arbitrageimg/plus.svg" alt="">
      </a>
      <a href="#" id="hide">
        <img src="front/arbitrageimg/cancel.svg" alt="">
      </a>
    </div>
  </div>
  <div class="alert_body">
    <ul class="nav nav-tabs" id="myTab" role="tablist">
      <li class="nav-item"> <a class="nav-link hide_div show_tab active" id="home-tab" data-toggle="tab" href="#home"
          role="tab" aria-controls="home" aria-selected="true">Active
          Alert</a>
      </li>
      <li class="nav-item"> <a class="nav-link hide_div show_tab" id="profile-tab" data-toggle="tab" href="#profile"
          role="tab" aria-controls="profile" aria-selected="false">Alert Log</a>
      </li>
    </ul>
    <div class="tab-content" id="myTabContent">
      <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
      </div>
      <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <div class="noti_card">
          <h6>Alert Description</h6>
          <ul>
            <li data-toggle="tooltip" data-placement="top" title="Bitcoin">
              <img src="front/arbitrageimg/coin_1.svg" alt="">
            </li>
            <li data-toggle="tooltip" data-placement="top" title="ArcBlock">
              <img src="front/arbitrageimg/coin_3.svg" alt="">
            </li>
            <li data-toggle="tooltip" data-placement="top" title="Cardano">
              <img src="front/arbitrageimg/coin_3.svg" alt="">
            </li>
            <li data-toggle="tooltip" data-placement="top" title="Band">
              <img src="front/arbitrageimg/coin_1.svg" alt="">
            </li>
          </ul>
          <p><span>10%</span>|<span>100%</span>
          </p>
        </div>
        <div class="noti_card">
          <h6>Alert Description</h6>
          <ul>
            <li><span class="badge badge-pill badge-primary">Select All</span>
            </li>
          </ul>
          <p><span>10%</span>|<span>100%</span>
          </p>
        </div>
      </div>
    </div>
  </div>
  <div class="alert_create">
    <h2>Create Alert</h2>
    <div class="formdiv">
      <div class="form-group">
        <input type="text" id="alertDescription" name="description" placeholder="Description">
      </div>
      <div class="form-group">
        <select class="selectpicker" id="alertCoins" multiple>
          <option value="0" class="test">Select All</option>
          <!-- This dropdown menu is populated using javascript -->
        </select>
      </div>
      <div class="form-group inline">
        <input id="txtChar1" type="text" name="" placeholder="e.g. -10"><b>to</b>
        <input id="txtChar2" type="text" name="" placeholder="e.g. 10">
      </div>
      <div class="form-group sound">
        <ul class="alert">
          <li class="new">Allow Sound</li>
          <li>
            <label class="switch" for="box-1">
              <input type="checkbox" checked name="sound_status" value="1" id="box-1"> <span
                class="slider round"></span>
            </label>
          </li>
        </ul>
      </div>
      <div class="form-group create_alert">
        <button type="submit" id="show_div" class="hide_tab">Create Alerts</button>
      </div>
    </div>
  </div>
</div>


<a id='show' class="float">
  <i class="fa fa-bell my-float"></i>
</a>
@endsection

@section('page_scripts')
<script src="{{ asset('js/index.js') }}"></script>
<script type="text/javascript">
    $('#footer,#copy').hide();
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
