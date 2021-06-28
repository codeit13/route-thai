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
@section('header-bar')
<div class="container">
    <div class="row">
        <div class="progress-section visible-xs">
            <h2>P2P Exchange</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12 flush">
            <ul class="mini_links">
                <li class="active"><a href="{{ route('p2p.exchange') }}">Buy</a>
                </li>
                <li><a href="{{ route('sell.create') }}">Sell</a>
                </li>
                <li class="visible-xs"><button class="show_filter"><img src="{{asset('front/img/refresh.png')}}"></button></li>
            </ul>
        </div>
    </div>
</div>
@endsection
<section id="filter">
    <div class="container">
        <form id="search_form" action="{{ route('p2p.exchange') }}" method="get" accept-charset="utf-8">
            <div class="row">
                <div class="col-lg-12">
                    <ul class="search_bar">
                        <li>
                            <label>Amount</label>
                            <br/>
                            <div class="dropdown currency_two three_coins">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Payments
                                </button>
                                <input type="hidden" name="currency_id" id="currency_id" value="{{ $crypto_currencies->first()->id }}">
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach($crypto_currencies as $single_currency_id)
                                        <a class="dropdown-item" href="#">
                                            10,000
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        <li>
                            <label>Fiat</label>
                            <br/>
                            <div class="dropdown currency_two three_coins">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="{{ $crypto_currencies->first()->getMedia('icon')->first()->getUrl() }}" alt="" id="img_main_1"> 
                                        <span id="text_1" style="color: black">{{ $crypto_currencies->first()->short_name }} <span>{{ $crypto_currencies->first()->name }}</span></span>
                                </button>
                                <input type="hidden" name="currency_id" id="currency_id" value="{{ $crypto_currencies->first()->id }}">
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach($crypto_currencies as $single_currency_id)
                                        <a class="dropdown-item" href="javascript:void(0)" 
                                            data-img="{{ $single_currency_id->getMedia('icon')->first()->getUrl() }}"
                                            data-name="{{ $single_currency_id->name }}"
                                            data-short_name="{{ $single_currency_id->short_name }}"
                                            data-currency="{{ $single_currency_id->id }}"
                                            onclick="selectCurrency(this,'currency_id','img_main_1','text_1')">
                                            <img src="{{ $single_currency_id->getMedia('icon')->first()->getUrl() }}" alt="">
                                            {{ $single_currency_id->short_name }} 
                                            <span>{{ $single_currency_id->name }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        <li class="full_li">
                            <label>Fiat Currency</label>
                            <br/>
                            <div class="dropdown currency_two three_coins" style="width: 259px">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="width: 259px">
                                    <img src="{{ $fiat_currencies->first()->getMedia('icon')->first()->getUrl() }}" alt="" id="img_main_2"> 
                                    <span style="color: black" id="text_2">{{ $fiat_currencies->first()->short_name }} <span>{{ $fiat_currencies->first()->name }}</span></span>
                                </button>
                                <input type="hidden" name="fiat_currency_id" id="fiat_currency_id" value="{{ $fiat_currencies->first()->id }}">
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    @foreach($fiat_currencies as $single_fiat_currency_id)
                                        <a class="dropdown-item" href="javascript:void(0)" 
                                            data-img="{{ $single_fiat_currency_id->getMedia('icon')->first()->getUrl() }}"
                                            data-name="{{ $single_fiat_currency_id->name }}"
                                            data-short_name="{{ $single_fiat_currency_id->short_name }}"
                                            data-currency="{{ $single_fiat_currency_id->id }}"
                                            onclick="selectCurrency(this,'fiat_currency_id','img_main_2','text_2')">
                                            <img src="{{ $single_fiat_currency_id->getMedia('icon')->first()->getUrl() }}" alt="">
                                            {{ $single_fiat_currency_id->short_name }} 
                                            <span>{{ $single_fiat_currency_id->name }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        </li>
                        <li class="full_li hidden-xs">
                            <a href="javascript::void(0)" onclick="searchForm()" class="refresh">
                            <img src="{{asset('front/img/refresh.png')}}">Refresh</a>
                        </li>
                    </ul>
                </div>
                {{-- <div class="col-lg-4">
                </div> --}}
            </div>
        </form>
    </div>
</section>
<section id="content" class="p2p">
    <div class="container">
        <div class="row">
            <div class="col xs-flush">
                <div class="card">
                    <div class="main_data_dable">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" class="res_po">Advertisers</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Limit/Available</th>
                                    <th scope="col">Payment</th>
                                    <th scope="col" class="text-center">Trade <span>0 Fee</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($transactions->count() > 0)
                                    @foreach($transactions as $single_transaction)
                                        @if($single_transaction->buyer_requests_count == 0)
                                            <tr>
                                                <th scope="row" class="ft_first">
                                                    <img src="{{ $single_transaction->currency->getMedia('icon')->first()->getUrl() }}" alt="">
                                                    <div class="right_ssd">{{ $single_transaction->user->name }}
                                                    </div>
                                                </th>
                                                <td class="text-center">
                                                    <span id="bb_btc_p">{{ $single_transaction->trans_amount }} </span><span>{{ $single_transaction->fiat_currency->short_name }}</span>
                                                </td>
                                                <td class="text-center">
                                                    <span id="bm_btc"><span>{{ $single_transaction->quantity }} {{ $single_transaction->currency->short_name }}</span>
                                                </td>

                                                <td class="text-center">
                                                    @foreach($single_transaction->user->user_payment_method as $single_payment_method)
                                                        <span data-bs-toggle="tooltip" data-bs-placement="top" title="" data-original-title="{{ $single_payment_method->payment_methods->name }}">
                                                            <img src="{{ $single_payment_method->payment_methods->getMedia('icon')->first()->getUrl() }}" alt="">
                                                        </span>
                                                    @endforeach
                                                </td>

                                                <td class="text-center">
                                                    <a href="{{ route('payment.show',['transaction'=>$single_transaction->trans_id]) }}" class="table_btn">Buy {{ $single_transaction->currency->short_name }}</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="5">No Data</td>
                                    </tr>
                                @endif
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
    function searchForm(){
        $('#search_form').submit();
    }
    function selectCurrency(current_obj,input_id,image_id,text_id){
        var current_obj = $(current_obj);
        var current_image = current_obj.attr('data-img');
        var current_name = current_obj.attr('data-name');
        var current_short_name = current_obj.attr('data-short_name');
        var current_currency = current_obj.attr('data-currency');

        $('#'+input_id).val(current_currency);
        $('#'+image_id).attr('src',current_image);
        $('#'+text_id).html(current_short_name+'<span> '+current_name+'</span>');

        console.log(current_image,current_name,current_short_name,current_currency)
    }

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