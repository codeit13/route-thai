@extends('layouts.front')
@section('title')
Route: P2P Trading Platform
@endsection
@section('content')
<div class="progress-section visible-xs">
    <h2>{{__("Order History")}}</h2>
</div>
<section id="wallet-content" class="request crypto order-history hht">
    <div class="container">
    <div class="row  hidden-xs">
        <div class="col-lg-12  col-sm-12 col-12 flush">
            <div class="white-box" style="">
                <div class="row">
                    <div class="col-lg-12 col-sm-12 col-12">
                        <h3>{{__("Order History")}}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12  col-sm-12 col-12 flush">
            <div class="white-box">
                @if(session()->has('message'))
                 <div class="alert alert-{{ session()->get('message_type') }}">
                    {{ session()->get('message') }}
                 </div>
               @endif
                {{-- <ul class="janral-head">
                    @foreach($currency_types as $index => $currency_type)
                    @if(isset($walletType->id) && $walletType->id==$currency_type->id)
                    <li class="active"><a href="#">{{__($currency_type->type)}}</a></li>
                    @elseif(!isset($walletType->id) && $index==0)
                    <li class="active"><a href="#">{{__($currency_type->type)}}</a></li>
                    @else
                    <li class=""><a href="{{route('wallet.request.history',['type'=>$currency_type->id,'typename'=>strtolower($currency_type->type)]).'?type='.$request->type??''}}">{{__($currency_type->type)}}</a></li>
                    @endif
                    @endforeach
                    <li class="last"><a href="#"><img src="{{asset('front/img/icon-13.png')}}" alt=""/></a></li>
                </ul> --}}
                <div class="head-xs visible-xs">
                    <form id="filterForm1" class="form_22" action="{{route('trade.history')}}" method="GET" >
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="row">
                                    <div class="col-12">
                                        <label>{{__("Date")}}</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6 sp-right">
                                        <input type="date" id="reportdate" name="start_date" value="{{$request->start_date??''}}">
                                    </div>
                                    <div class="col-6 sp-left">
                                        <input type="date" id="reportdate" name="end_date" value="{{$request->end_date??''}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 sp-left">
                                <div class="row">
                                    <div class="col-12">
                                        <label>{{__('Types of Currency')}}</label>
                                    </div>
                                </div>
                                <div class="dropdown currency_two three_coins crypto currencyDropdown">
                                    @foreach($currencies as $cIndex=> $currency)
                                    @if($currency->id==$currentCurrency)
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if($currency->hasMedia('icon'))
                                    <img style="max-width: 28px;" src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 
                                    @endif
                                    {{__($currency->short_name)}} <span>{{__($currency->name)}}</span>
                                    </button>
                                    @endif
                                    @endforeach
                                    @if(!$currentCurrency)
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    @if($currencies[0]->hasMedia('icon'))
                                    <img style="max-width: 28px;" src="{{$currencies[0]->firstMedia('icon')->getUrl()}}" alt="{{__($currencies[0]->name)}}"/> 
                                    @endif
                                    {{__($currencies[0]->short_name)}} <span>{{__($currencies[0]->name)}}</span>
                                    </button>
                                    @endif
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @foreach($currencies as $cIndex=> $currency)
                                        <a class="dropdown-item" data-id="{{$currency->id}}" href="#">
                                        @if($currency->hasMedia('icon'))
                                        <img style="max-width: 28px;" src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 
                                        @endif
                                        {{__($currency->short_name)}} <span>{{__($currency->name)}}</span>
                                        </a>
                                        @endforeach
                                    </div>
                                    <input type="hidden" name="currency" class="coin_id_class" id="coin_id" value="{{($currentCurrency)}}"/>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 flush">
                                <label>{{__("Status")}}</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <select name="status" class="filter-type">
                                    <option value=""> Select </option>
                                    <option value="pending" @if($request->status=='pending') selected @endif>{{__('In Progress')}}</option>
                                    <option value="approved" @if($request->status=='approved') selected @endif>{{__('Approved')}}</option>
                                    <option value="rejected" @if($request->status=='rejected') selected @endif>{{__('Rejected')}}</option>
                                </select>
                            </div>
                            <div class="col-8 xs-flush-right">
                                <input class="coin" name="search" value="{{$request->search??''}}" type="search" placeholder="Search Coin Name" />
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row hidden-xs">
                    <form id="filterForm" action="{{route('trade.history')}}" method="GET" >
                        <div class="col-lg-12 col-sm-12 col-12">
                            <table class="order-history-table">
                                <thead>
                                    <tr>
                                        <th colspan="2">Date</th>
                                        <th>Types of Currency</th>
                                        <th style="width:110px;">Order Type</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <input type="date" id="reportdate" name="start_date" value="{{$request->start_date??''}}">
                                        </td>
                                        <td>
                                            <input type="date" id="reportdate" name="end_date" value="{{$request->end_date??''}}">
                                        </td>
                                        <td style="width:250px; display:inline-block;">
                                            <div class="dropdown currency_two three_coins crypto currencyDropdown">
                                                @foreach($currencies as $cIndex=> $currency)
                                                    @if($currency->id==$currentCurrency)
                                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            @if($currency->hasMedia('icon'))
                                                                <img style="max-width: 28px;" src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 
                                                            @endif
                                                            {{__($currency->short_name)}} <span>{{__($currency->name)}}</span>
                                                        </button>
                                                    @endif
                                                @endforeach
                                                @if(!$currentCurrency)
                                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">All</span>
                                                </button>
                                                @endif
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" data-id="all" href="#">
                                                        <span>All</span>
                                                    </a>
                                                    @foreach($currencies as $cIndex=> $currency)
                                                        <a class="dropdown-item" data-id="{{$currency->id}}" href="#">
                                                            @if($currency->hasMedia('icon'))
                                                            <img style="max-width: 28px;" src="{{$currency->firstMedia('icon')->getUrl()}}" alt="{{__($currency->name)}}"/> 
                                                            @endif
                                                            {{__($currency->short_name)}} <span>{{__($currency->name)}}</span>
                                                        </a>
                                                    @endforeach
                                                </div>
                                                <input type="hidden" name="currency" class="coin_id_class" id="coin_id" value="{{($currentCurrency)}}"/>
                                            </div>
                                        </td>
                                        <td>
                                        <select name="type" class="filter-type">
                                            <option value="all" @if($request->type=='' or $request->type=='all') selected @endif>All</option>
                                            <option value="sell" @if($request->type=='sell') selected @endif >{{__('Sell')}}</option>
                                            <option value="buy" @if($request->type=='buy') selected @endif>{{__('Buy')}}</option>
                                        </select>
                                        </td>
                                        <td>
                                        <select name="status" class="filter-type">
                                            <option value="all" @if($request->status=='' or $request->status=='all') selected @endif>All</option>
                                            <option value="pending" @if($request->status=='pending') selected @endif>{{__('In Progress')}}</option>
                                            <option value="approved" @if($request->status=='approved') selected @endif>{{__('Approved')}}</option>
                                            <option value="rejected" @if($request->status=='rejected') selected @endif>{{__('Rejected')}}</option>
                                        </select>
                                        </td>
                                        <td><input class="coin" value="{{$request->search??''}}" name="search" type="search" placeholder="Search Coin Name" /></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 history-details  col-sm-12 col-12">
                            <table>
                                <thead>
                                    <tr>
                                        <th style="width:8%;">{{__("Asset Type")}}</th>
                                        <th>{{__("Amount")}}</th>
                                        <th>{{__("Price")}}</th>
                                        <th>{{__("Quantity")}}</th>
                                        <th>{{__("Counterparty")}}</th>
                                        <th>{{__("Status")}}</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($transactions as $tIndex => $transaction)
                                    <tr class="xs-full">
                                        <td class="@if($transaction->type=='buy')buy @else sell @endif hidden-xs">
                                            <h2>{{__(ucwords($transaction->type))}}</h2>
                                        </td>
                                        <td class="hidden-xs" colspan="2"><span>{{__("Order number")}}</span>{{$transaction->trans_id}}</td>
                                        <td class="xs-full" colspan="2"><span>{{__("Created time")}}</span>{{$transaction->created_at}}</td>
                                        <td class="hidden-xs"></td>
                                    </tr>
                                    <tr>
                                        <td>
                                            @if($transaction->currency->hasMedia('icon'))
                                            <img style="max-width: 28px;" class="top-xs-m" src="{{$transaction->currency->firstMedia('icon')->getUrl()}}" alt="{{__($transaction->currency->name)}}"/> 
                                            @endif
                                            <label class="visible-xs">{{__($transaction->currency->short_name)}} <span>{{__($transaction->currency->name)}}</span></label>
                                        </td>
                                        <td class="size-t"><label class="hidden-xs">{{$transaction->trans_amount}} {{__($transaction->fiat_currency->short_name)}}</label> <label class="visible-xs">{{__("Quantity")}} <span>{{$transaction->trans_amount}}</span></label></td>
                                        <td class="hidden-xs">{{number_format((float)$transaction->quantity/$transaction->trans_amount, 5, '.', '')}}/{{$transaction->currency->short_name}}</td>
                                        <td class="hidden-xs">{{$transaction->quantity}}&nbsp;{{__($transaction->currency->short_name)}}</td>
                                        <td class="light"><label class="hidden-xs">{{$transaction->receiver->name??''}}</label> 
                                            <a class="file visible-xs" href="#">View File</a>
                                        </td>
                                        <td class="hidden-xs show_on">
                                            @switch($transaction->status)
                                                @case('pending')
                                                    <img src="{{asset('front/img/icon-27.png')}}" alt=""/>
                                                    {{__('In progress')}}
                                                    <a class="hidden-xs" href="@if($transaction->type == 'sell') {{route('sell.buyer_request',['trans_id'=>$transaction->trans_id])}} @else {{route('payment.show',['transaction'=>$transaction->trans_id])}} @endif">{{__("Detail")}}</a>
                                                @break
                                                @case('approved')
                                                <img src="{{asset('front/img/icon-28.png')}}" alt=""/>
                                                {{__('Approved')}}
                                                <a class="hidden-xs" href="@if($transaction->type == 'sell') {{route('sell.buyer_request',['trans_id'=>$transaction->trans_id])}} @else {{route('payment.show',['transaction'=>$transaction->trans_id])}} @endif">{{__("Detail")}}</a>
                                                @break
                                                @case('rejected')
                                                    <img src="{{asset('front/img/icon-29.png')}}" alt=""/>
                                                    {{__('Rejected')}}
                                                    <a class="hidden-xs" href="@if($transaction->type == 'sell') {{route('sell.buyer_request',['trans_id'=>$transaction->trans_id])}} @else {{route('payment.show',['transaction'=>$transaction->trans_id])}} @endif">{{__("Detail")}}</a>
                                                @break
                                            @endswitch
                                        </td>
                                        <td class="center_small sub_buttons">
                                            @if($transaction->status == 'pending')
                                                <a class="btn-primary" href="{{ route('sell.create',['trans_id'=>$transaction->trans_id]) }}" style="padding: 6px;color: white;"><i class="fa fa-edit"></i></a> 
                                                <a class="btn-success" href="{{ route('sell.destroy',['trans_id'=>$transaction->trans_id]) }}" style="padding: 7px;color: white;"><i class="fa fa-trash"></i></a> 
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center nav-pagi hidden-xs col-sm-12 col-12">
                            {{ $transactions->links('front._inc._paginator') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('page_scripts')
<script src="{{asset('front/js/main.js')}}"></script> <!-- Gem jQuery -->
<script src="{{asset('front/js/bootstrap-datepicker.js')}}"></script>
<script>
    $('#datepicker').datepicker({autoclose:true});
    $('#datepickertwo').datepicker({autoclose:true});
    $('#datepickerthree').datepicker({autoclose:true});
    $('#datepickerfour').datepicker({autoclose:true});
</script>
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
<script type="text/javascript">
    $('.btn-toggle').click(function() {
        $(this).find('.btn').toggleClass('active');  
        
        if ($(this).find('.btn-primary').length>0) {
         $(this).find('.btn').toggleClass('btn-primary');
        }
        if ($(this).find('.btn-danger').length>0) {
         $(this).find('.btn').toggleClass('btn-danger');
        }
        if ($(this).find('.btn-success').length>0) {
         $(this).find('.btn').toggleClass('btn-success');
        }
        if ($(this).find('.btn-info').length>0) {
         $(this).find('.btn').toggleClass('btn-info');
        }
        
        $(this).find('.btn').toggleClass('btn-default');
           
    });
    
    $('form').submit(function(){
        var radioValue = $("input[name='options']:checked").val();
        if(radioValue){
            alert("You selected - " + radioValue);
        };
        return false;
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
    
    $(".currencyDropdown .dropdown-menu .dropdown-item").on("click", function(e) { 
        e.preventDefault();
        var currency_id=$(this).attr('data-id');
        $('.coin_id_class').val(currency_id);
        $('.currencyDropdown .dropdown-toggle').html($(this).html());
        submitform();
    });
    
    function submitform()
    {
        if($('#filterForm1').parent('.head-xs').css('display') !='none')
        {
            document.getElementById("filterForm1").submit();    
        }
        else
        {
            document.getElementById("filterForm").submit();    
        }
    }
    
    $(document).on('change','.filter-type',function()
    {
        submitform();
    })
    
    $(document).on('keyup','[name="search"]',function(e)
    {
        if(e.which==13)
        {
            submitform();
        }
    })
</script>
@endsection