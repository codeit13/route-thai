@extends('layouts.front')
@section('title')
    Route: P2P Trading Platform
@endsection
@section('content')

<section id="wallet-content" class="request withdraw-asset">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 hidden-xs col-sm-12 col-12">
          <div class="white-box">
            <div class="row">
              <div class="col-lg-6 col-sm-6 col-6">
                <h3>Withdraw Assest</h3>
              </div>
              <div class="col-lg-6 text-right col-sm-6 col-6">  
                <a href="#" class="btn-success">Transfer</a>
                <a href="#" class="btn-primary">P2P Trading</a>
                <!--
                <a class="mobile-tag" href="#">
                  <img src="img/icon-13.png" alt="" />
                </a>
                -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row visible-xs">
        <div class="col-lg-12 col-sm-12 col-12">
          <h3 class="wa_text">Withdraw Assest</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 bg-white-xs col-sm-12 col-12">
          <div class="white-box m-top-0">
            <ul class="janral-head hidden-xs">
           @foreach($currency_types as $index => $currency_type)


            @if(isset($walletType->id) && $walletType->id==$currency_type->id)

            <li class="active"><a href="#">{{__($currency_type->type)}}</a></li>
            @elseif(!isset($walletType->id) && $index==0)
            <li class="active"><a href="#">{{__($currency_type->type)}}</a></li>
            @else
            <li class=""><a href="{{route('wallet.withdraw',['type'=>$currency_type->id,'typename'=>strtolower($currency_type->type)])}}">{{__($currency_type->type)}}</a></li>
            @endif


            

            @endforeach
          
            <li class="last"><a href="#"><img src="{{asset('front/img/icon-13.png')}}" alt=""/></a></li>
            </ul>
            <div class="row">
              <div class="col-lg-6 p-text col-sm-6 col-12">
                <form>
                  <div class="field">
                    <label>Coin</label>
                    <div class="dropdown currency_two three_coins crypto">

                        @foreach($currencies as $cIndex=> $currency)

                    @if($currency->id==$currentCurrency)

                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                      @if($currency->hasMedia('icon'))
    
                                      

                      <img src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 

                      @endif

                      {{__($currency->short_name)}} <span>{{__($currency->name)}}</span>
                      </button>
                      @endif

                      @endforeach

                      
                    @if(!$currentCurrency)

                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                      @if($currencies[0]->hasMedia('icon'))
    
                                      

                      <img src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 

                      @endif

                      {{__($currencies[0]->short_name)}} <span>{{__($currencies[0]->name)}}</span>
                      </button>



                    @endif



                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                           @foreach($currencies as $cIndex=> $currency)

                            <a class="dropdown-item" href="#">

                                 @if($currency->hasMedia('icon'))
    
                                      

                      <img src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 

                      @endif

                      {{__($currency->short_name)}} <span>{{__($currency->name)}}</span>



                            </a>


                    @endforeach
                           <!--    <a class="dropdown-item" href="#"><img src="img/bitcoin.png" alt=""> BTC <span>Bitcoin</a>
                        <a class="dropdown-item" href="#"><img src="img/icon-5.png" alt=""> ETH <span>Ethereum</a>
                        <a class="dropdown-item" href="#"><img src="img/icon-6.png" alt=""> BNB <span>BNB</span></a> -->
                      </div>
                    </div>
                  </div>
                  <div class="field qq">
                    <label>Total Quantity</label>
                    <div class="dropdown currency_two three_coins crypto">
                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        1
                      </button>
                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="#">2</a>
                        <a class="dropdown-item" href="#">3</a>
                        <a class="dropdown-item" href="#">4</a>
                      </div>
                    </div>
                    <span class="total">Total balance: <b>0.00000000 BTC</b></span>
                  </div>
                  <div class="field">
                    <label>Address</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <textarea placeholder="Wallet Details"></textarea>
                      </div>
                    </div>
                  </div>
                  <div class="field">
                    <button type="button">Withdrawal</button>
                  </div>
                </form>
              </div>
              <div class="col-lg-6 xs-flush col-sm-6 col-12">
                <div class="step-h">
                  <ul>
                    <li>
                      <div class="row">
                        <div class="col-lg-1 xs-right flush text-center col-sm-2 col-2">
                          <span>1</span>
                        </div>
                        <div class="col-lg-11 col-sm-10 col-10">
                          <h5>Initiate a withdrawal</h5>
                          <h6>Start a withdrawal request on Route.</h6>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="row">
                        <div class="col-lg-1 xs-right flush text-center col-sm-2 col-2">
                          <span>2</span>
                        </div>
                        <div class="col-lg-11 col-sm-10 col-10">
                          <h5>Admin wallet confirmation</h5>
                          <h6>Copy and paste the deposit address of the receiver</h6>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="row">
                        <div class="col-lg-1 xs-right flush text-center col-sm-2 col-2">
                          <span>3</span>
                        </div>
                        <div class="col-lg-11 col-sm-10 col-10">
                          <h5>Admin Approval</h5>
                          <h6>Wait for withdrawal network confirmation</h6>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="row">
                        <div class="col-lg-1 xs-right flush text-center col-sm-2 col-2">
                          <span>4</span>
                        </div>
                        <div class="col-lg-11 col-sm-10 col-10">
                          <h5>Withdrawal Successful</h5>
                          <h6>Deposit successfully sent to receivers address</h6>
                        </div>
                      </div>
                    </li>
                  </ul>
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
  <script>
    $("ul.btc").on("click", ".init", function() {
        $(this).closest("ul.btc").children('li:not(.init)').toggle();
    });
    
    var allOptions = $("ul.btc").children('li:not(.init)');
    $("ul.btc").on("click", "li:not(.init)", function() {
        allOptions.removeClass('selected');
        $(this).addClass('selected');
        $("ul.btc").children('.init').html($(this).html());
        allOptions.toggle();
    });

    $(".currency_two .dropdown-menu .dropdown-item").on("click", function(e) { e.preventDefault();
    $('.currency_two .dropdown-toggle').html($(this).html());
});

  </script>

  @endsection