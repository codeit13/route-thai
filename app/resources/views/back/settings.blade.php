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



<div class="container py-5">
    <div class="shadow vw-50 p-5">
        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf()
        <!--Tradable coins multi-select with choices.css&js-->


        <div class=" mt-3">
            <div class=""> 
                <label class="text-dark">Crypto coins</label>
                <select id="crypto-list" name="tradable_coins[]" onchange="tradeableCoinsList(this)" placeholder="Select upto 10 coins" multiple>
                </select>
            </div>
        </div>
        <!--Fiat currencies multi-select with choices.css&js-->
        <div class=" mt-3">
            <div class="">
                <label class="text-dark">Fiat currencies</label>
                <select id="fiat-list" name="fiat[]" placeholder="Select currencies" class="custom-select" multiple></select>
            </div>
        </div>

        <!--Trade -->


         <div class=" mt-3">
            <div class="">
                <label class="text-dark">Trade</label>
                <select id="trade-list" name="trade[]" placeholder="Select currencies" class="custom-select" multiple></select>
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
                <input type="submit" id="UpdateCurrencySettings" class="form-control btn btn-sm btn-default"   value="Save Settings"> 
            </div>
        </div>
        </form>
</div> 
@section('page_scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>
<script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
<script type="text/javascript" src="https://cdn.rawgit.com/prashantchaudhary/ddslick/master/jquery.ddslick.min.js" ></script>

@include('back._inc._currency-list-js')
@include('back._inc._currency-selector-js')


@endsection
@endsection
