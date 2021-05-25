@extends('layouts.front')
@section('title')
    Route: P2P Trading Platform
@endsection
@section('content')
<div class="progress-section visible-xs">
  <h2>{{__('Withdraw Assest')}}</h2>
</div>
<section id="wallet-content" class="request withdraw-asset">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 hidden-xs col-sm-12 col-12">
          <div class="white-box">
            <div class="row">
              <div class="col-lg-6 col-sm-6 col-6">
                <h3>{{__('Withdraw Assest')}}</h3>
              </div>
              <div class="col-lg-6 text-right col-sm-6 col-6">  
                <a href="#" class="btn-success">{{__('Transfer')}}</a>
                <a href="{{route('p2p.exchange')}}" class="btn-primary">{{__('P2P Trading')}}</a>
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
      <div class="row hidden-xs hidden-lg">
        <div class="col-lg-12 col-sm-12 col-12">
          <h3 class="wa_text">{{__('Withdraw Assest')}}</h3>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 bg-white-xs col-sm-12 col-12 xs-flush">
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


                <form action="{{route('wallet.create.withdraw')}}" method="post">

                  @csrf
                  <div class="field">
                    <label>{{__('Coin')}}</label>
                    <div class="dropdown currency_two three_coins crypto currencyDropdown">

                      @php

                       if(!(isset($currenctCurrency)))
                      {
                          $currentCurrency=old("currency_id");
                      }

                        @endphp

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

                      
                    @if(!$currentCurrency && isset($currencies[0]->id))

                      <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        
                      @if($currencies[0]->hasMedia('icon'))
    
                                      

                      <img src="{{$currencies[0]->firstMedia('icon')->getUrl()}}" alt="{{__($currencies[0]->name)}}"/> 

                      @endif

                      {{__($currencies[0]->short_name)}} <span>{{__($currencies[0]->name)}}</span>
                      </button>



                    @endif



                      <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                           @foreach($currencies as $cIndex=> $currency)

                            <a class="dropdown-item" data-id="{{$currency->id}}" href="#">

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
                    <input type="hidden" name="currency_id" id="coin_id" value="{{($currentCurrency)?$currentCurrency:$currencies[0]->id??''}}"/>
                          @error('currency_id')
                                <p class="invalid-value" role="alert">
                                    <strong>{{ __($message) }}</strong>
                                </p>
                                @enderror
                  </div>
                  <div class="field qq">
                    <label>{{__('Total Quantity')}}</label>
                   
                                  
                                        <input type="text" name="quantity" class="form-control @error('quantity') is-invalid @enderror"   required="" id="quantity" aria-describedby="emailHelp" autocomplete="e-m-a-i-l" autofocus="" value="{{ old('quantity') }}">
                                    
                                     @error('quantity')
                                <p class="invalid-value" role="alert">
                                    <strong>{{__($message) }}</strong>
                                </p>
                                @enderror
                    <span class="total">{{__('Total balance')}}: <b id="totalBalance">0.00000000 {{__('BTC')}}</b></span>
                  </div>
                  <div class="field">
                    <label>{{__('Address')}}</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <textarea name="address" placeholder="Wallet Details">{{old('address')}}</textarea>
                      </div>
                   
                    </div>

                    @error('address')
                                <p class="invalid-value mt-4" role="alert">
                                    <strong>{{__($message) }}</strong>
                                </p>
                                @enderror

                  </div>
                 
                     
                             
                  <div class="field">
                    <button type="submit">{{__('Withdrawal')}}</button>
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

      var wallets=@json($wallets);

     var currencies=@json($currencies);


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

    $(".currencyDropdown .dropdown-menu .dropdown-item").on("click", function(e) { e.preventDefault();

      var currency_id=$(this).attr('data-id');

   changeShowBalance(currency_id);


      $('#coin_id').val(currency_id);
    $('.currencyDropdown .dropdown-toggle').html($(this).html());
});

    var selectedCurrencyBalance=0;

    function changeShowBalance(coin_id)
{

    var balance='0.00000';

    selectedCurrencyBalance=balance;

    var balanceRow=wallets.filter(function(wallet){
          return wallet.currency_id==coin_id;
    })

    balanceRow=balanceRow[0];

    var currencyRow=currencies.filter(function(currency)
    {
       return currency.id==coin_id;
    })

    currencyRow=currencyRow[0];

    balance=balance+' '+currencyRow.short_name;

    if( balanceRow && typeof balanceRow.coin !='undefined')
    {
         balance=balanceRow.coin + ' '+currencyRow.short_name;

         selectedCurrencyBalance=balanceRow.coin;

    }


    $('#totalBalance').text(balance);
}

var currentCurrency='{{($currentCurrency)?$currentCurrency:$currencies[0]->id??''}}';


changeShowBalance(currentCurrency);

$(document).on('keyup','#quantity',function()
{

    var quantity=parseFloat($(this).val());

    $(this).next('.validateError').remove();
  
    selectedCurrencyBalance=parseFloat(selectedCurrencyBalance);

    if(selectedCurrencyBalance < quantity)
    {
      $(this).addClass('is-invalid');

      $(this).after('<p class="text-danger text-bold validateError">{{__("Withdraw quantity should be less than available balance.")}}</p>');
    }
    else
    {
      $(this).removeClass('is-invalid');

    }

})

  </script>

  @endsection