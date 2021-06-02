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
@stop
@section('content')

<section id="main-content">
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
            <div class="row">
              <div class="col-lg-6">
                <div class="row">
                  <div class="col-6">
                    <div class="dropdown currency_two three_coins" width='100%' id="exchange">
                      <button class="btn btn-secondary dropdown-toggle" style="width: 100%;" value="BITKUB"
                        type="button" id="dropdownBaseExchange" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <img src="front/arbitrageimg/bitkub.svg" alt="">Bitkub</button>
                      <div class="dropdown-menu" style="width:100%" aria-labelledby="dropdownBaseExchange">
                        <form class="form-inline">
                          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                          <span><i class="fa fa-search" aria-hidden="true"></i></span>
                        </form>
                        <!-- This dropdown is populated using javascript -->
                      </div>
                    </div>
                  </div>
                  <div class="col-6">
                    <button type="button" id="toggleFav" style="width: 100%;" class="btn btn-outline-primary"><i
                        class="fa fa-star-o" aria-hidden="true"></i> Watchlist</button>
                  </div>
                </div>
                <!-- <ul>
                  <li>
                    <h2>Crypto<span>Alert</span></h2>
                  </li>
                  <li>
                    <div class="dropdown currency_two three_coins" id="exchange">
                      <button class="btn btn-secondary dropdown-toggle" style="width: 100%;" value="BITKUB"
                        type="button" id="dropdownBaseExchange" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false">
                        <img src="front/arbitrageimg/bitkub.svg" alt="">Bitkub</button>
                      <div class="dropdown-menu" style="width:100%" aria-labelledby="dropdownBaseExchange">
                        <form class="form-inline">
                          <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                          <span><i class="fa fa-search" aria-hidden="true"></i></span>
                        </form>
                        <!-- This dropdown is populated using javascript
                      </div>
                    </div>
                  </li>
                  <li>
                    <button type="button" id="toggleFav" class="btn btn-outline-primary"><i class="fa fa-star-o"
                        aria-hidden="true"></i> Watchlist</button>
                  </li>
                </ul> -->
              </div>
              <div class="col-2 pl-0 d-flex justify-content-end">
                <form class="form-inline align-self-center">
                   <a href="javascript:;" style="border-radius: 4px;
                   background-color: #6c757d;
                   color: white;
                   width: 35px;
                   height: 35px;
                   display: flex;
                   align-items: center;
                   text-decoration: none;
                   justify-content: center;" class="actions-drop-main" id="dropdownMenuLink" data="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" ><i class="fa fa-cog"
                      aria-hidden="true" ></i></a>

                      <div class="dropdown-menu custome-class p-0" aria-labelledby="dropdownMenuLink" id="range-dropdown">
                          <div class="p-3">
                          <div class="range-percent">
                          <div class="d-flex align-items-center addrange" id="range-row-0">
                            <div class="mb-3 pr-3">
                              <label class="d-flex justify-content-start">Min (%):</label>
                              <input type="number" id="min-value-0" style="width: 80px;height: 35px;" class="form-control">
                            </div>
                            <div class="pr-3">
                              <span>TO</span>
                            </div>
                            <div class="mb-3 pr-3">
                              <label class="d-flex justify-content-start">Max (%) :</label>
                              <input type="number" id="max-value-0" style="width: 80px;height: 35px;" class="form-control">
                            </div>
                            <div class="mb-3 pr-3">
                              <input type="color" id="set-color-0" class="form-control p-0 mt-4 border-0 rounded-circle selectcolor" style="box-shadow: none !important;">
                            </div>
                            </div>
                          </div>
                          <div class="d-flex align-items-center justify-content-center mb-3">
                            <button style="width: 40px; height: 40px;" class="btn btn-light add-more-range"><i class="fa fa-plus"></i></button>
                          </div>
                          <div class="d-flex justify-context-end border-top pt-3">
                            <a id="change-color" class="btn btn-primary">Submit</a>
                            <a id="cancel-color" class="btn btn-outline-primary ml-2">Reset</a>
                          </div>
                        </div>
                      </div>
                </form>
              </div>
              <div class="col-lg-4 ml-auto text-right">
                <div class="row table-row">
                  <div class="col-12">
                    <div class="row ">
                  <div class="col-6">
                    <div class="features">
                      <p>show rows</p>
                      <select>
                        <option value="all">All</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                      </select>
                    </div>

                    <!-- <ul>
                      <li>
                        <select>
                          <option value="all">All</option>
                          <option value="10">10</option>
                          <option value="25">25</option>
                          <option value="50">50</option>
                        </select>
                      </li>
                    </ul> -->
                  </div>
                  <div class="col-6">
                    <form class="form-inline" style="width:100%">
                      <input class="form-control mr-sm-2" style="width: 100%;" id="tablesearchinput" type="search"
                        placeholder="Search coin" aria-label="Search"> <span><i class="fa fa-search search-icon"
                          aria-hidden="true"></i></span>
                    </form>
                  </div>
                </div>
                </div>
                </div>

                <!-- <ul class="features">
                  <li>Show rows</li>
                  <li>
                    <select>
                      <option value="all">All</option>
                      <option value="10">10</option>
                      <option value="25">25</option>
                      <option value="50">50</option>
                    </select>
                  </li>
                  <li>
                    <form class="form-inline">
                      <input class="form-control mr-sm-2" style="width: 100%;" id="tablesearchinput" type="search"
                        placeholder="Search coin" aria-label="Search"> <span><i class="fa fa-search search-icon"
                          aria-hidden="true"></i></span>
                    </form>
                  </li>
                </ul> -->
              </div>
            </div>
          </div>
          <div class="main_data_dable">
            <table id="main_data_table" class="table table-hover" style="width: 100%">
              <thead id="currency_header">
                <tr id="currency_header_row">
                  <th scope="col"></th>
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
