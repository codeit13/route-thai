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

<h1>Arbitrage Page</h1>
@endsection
@section('page_scripts')
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