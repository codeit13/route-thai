@extends('layouts.back')
@section('title')
    Settings |
@endsection
@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css" />
<style>
.choices__list--multiple .choices__item{
    background-color: white;
    color: black;
    border: 1px solid #00C98E;
}
.choices[data-type*=select-multiple] .choices__button{
    color: black;
    
    background-image: url("assets/cancel.svg");
}
label.text-dark{
    font-size: 24px;
}
#exchange-list .dd-option-image{
    height: 25px;
    width: 25px;
}
#exchange-list .dd-option{
    display: inline-block;
}
#exchange-list .dd-option-text{
    line-height: unset !important;
}
#exchange-list .dd-selected-image{
    height: 25px;
    width: 25px;
}
#exchange-list.dd-container,#exchange-list .dd-select{
    width:auto !important;
}
.dd-options{
    width: 100% !important;
}
#exchange-list .dd-selected-text{line-height: unset !important;color: black;}
#exchange-list .dd-selected{color: rgba(109, 108, 108, 0.692) !important;
text-decoration: none !important; }
</style>
@php 
    $currencies = \App\Models\Currency::where('type_id',1)->with('media')->get();
    $f_currencies = \App\Models\Currency::where('type_id',2)->with('media')->get();
    $list = [];
    $coins = [];
    $tradable = [];
    $loanable = [];
    $f_currencies_list = $currencies_list = [];
    foreach($currencies as $currency) {
        $list[$currency->short_name] = ['name'=> $currency->name, 'img'=>$currency->media()->first()->getUrl()];
        $coins[] = $currency->short_name;
        if($currency->is_tradable == 1)
        $tradable[] = $currency->short_name;
        // $tradable[$currency->short_name] = ['name'=> $currency->name, 'img'=>$currency->media()->first()->getUrl()];
        if($currency->is_loanable == 1)
        $loanable[] = $currency->short_name;
    }   
    foreach($f_currencies as $currency) {
        $f_currencies_list[] = $currency->short_name;
        $currencies_list[$currency->short_name] = ['name'=> $currency->name, 'img'=>$currency->media()->first()->getUrl()];
    }
@endphp
<div class="container py-5">
    <div class="shadow vw-50 p-5">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf()
        <!--Tradable coins multi-select with choices.css&js-->
        <div class=" mt-3">
            <div class=""> 
                <label class="text-dark">Tradable coins</label>
                <select id="coin-list" name="tradable_coins[]" onchange="tradeableCoinsList()" placeholder="Select upto 10 coins" multiple>
                </select>
            </div>
        </div>
        <!--Fiat currencies multi-select with choices.css&js-->
        <div class=" mt-3">
            <div class="">
                <label class="text-dark">Fiat currencies</label>
                <select id="currency-list" name="fiat[]" placeholder="Select currencies" class="custom-select" multiple></select>
            </div>
        </div>
        <!--Exchange select with ddslick-->

        <div class=" mt-3">
            <div class="">
                <label class="text-dark">Exchange List</label>
                <div>
                    <select id="exchange-list" name="exchange[]" class="custom-select"></select>
                </div>
            </div>
        </div>

         <!--Fiat currencies multi-select with choices.css&js-->
         <div class=" mt-3">
             <div class=""> 
                 <label class="text-dark">Loanable Coins</label>
                 <select id="coin-loan-list" name="loanable_coins[]" placeholder="Select coins" class="custom-select" multiple></select>
             </div>
         </div>
         <div class="mt-3">
            <div class=""> 
                <input type="submit" class="form-control btn btn-sm btn-default"   value="Save Settings"> 
            </div>
        </div>
        </form>
</div> 
@section('page_scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/prashantchaudhary/ddslick/master/jquery.ddslick.min.js" ></script>

<script>
var coinsList = JSON.parse('@php echo json_encode($coins); @endphp');
var coinsAlertsList = JSON.parse('@php echo json_encode($list); @endphp');
var currencyList = JSON.parse('@php echo json_encode($f_currencies_list); @endphp');
var currencyDetails = JSON.parse('@php echo json_encode($currencies_list); @endphp');

// console.log(coinsList); 
  Object.keys(coinsAlertsList).forEach((coinInfo) => {
    const coinimgpath = coinsAlertsList[coinInfo]['img'];
    const coinimg = $('<img>', { src: coinimgpath, height: '25px',width:'25px',class:'mr-2' });
    // console.log(coinimgpath);
    $('#coin-list').append('<option>'+coinimg[0].outerHTML+coinInfo+'</option>');
  });
  currencyList.forEach((currencyInfo) => {
    const currencyimgpath = currencyDetails[currencyInfo]['img'];
    const currencyimg = $('<img>', { src: currencyimgpath, height: 'auto',width:'25px',class:'mr-2' });
    $('#currency-list').append('<option>'+currencyimg[0].outerHTML+currencyInfo+'</option>');
  });
  coinsList.forEach((coinLoanInfo) => {
    const coinimgpath = coinsAlertsList[coinLoanInfo]['img'];
    const coinimg = $('<img>', { src: coinimgpath, height: '25px',width:'25px',class:'mr-2' });
    $('#coin-loan-list').append('<option>'+coinimg[0].outerHTML+coinLoanInfo+'</option>');
  });

$(document).ready(function(){

    var multipleCancelButton = new Choices('#coin-list', {
        removeItemButton: true,
        maxItemCount:10,
        searchResultLimit:8,
        renderChoiceLimit:100,
        items: coinsList,
        choices: coinsList,
    });
    multipleCancelButton.setValue(['@php echo implode("','",$tradable); @endphp']);

    var currencyListSelector = new Choices('#currency-list', {
        removeItemButton: true,
        maxItemCount:10,
        searchResultLimit:8,
        renderChoiceLimit:100,
        items: [],
        choices: [],
    });    
    var currencyLoanListSelector = new Choices('#coin-loan-list', {
        removeItemButton: true,
        maxItemCount:10,
        searchResultLimit:8,
        renderChoiceLimit:100,
        items: [],
        choices: [],
    });    
    currencyLoanListSelector.setValue(['@php echo implode("','",$loanable); @endphp']);

function tradeableCoinsList(){
    console.log("Hello");
}
});
</script>

@endsection
@endsection
