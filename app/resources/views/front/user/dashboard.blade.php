@extends('layouts.front')
@section('title')
    Route: P2P Trading Platform
@endsection
@section('content')

<section id="dashboard">
    <div class="container-fluid">
       <div class="row">
          @include('front.user._sidebar')
          <div class="col-lg-10 col-xs-12 flush">
             <div class="content_dashboard">
                <div class="container">
                   <div class="row">
                      <div class="col user_details"> <i class="fal fa-user-circle"></i>
                         <div class="user_data">
                            <h3>@php $minFill = 4; echo preg_replace_callback('/^(.)(.*?)([^@]?)(?=@[^@]+$)/u',function ($m) use ($minFill) {return $m[1] . str_repeat("*", max($minFill, mb_strlen($m[1], 'UTF-8'))) . ($m[3] ?: $m[0]); }, Auth::user()->email ); @endphp </h3>
                            <h4>Mobile Number : <span>{{ substr(Auth::user()->mobile, 0, -6) . "****".substr(Auth::user()->mobile, -2)}}</span></h4>
                         </div>
                         <p>Last login time: {{ Auth::user()->lastLoginAt() ?? now() }} <span> IP Address: {{ Auth::user()->lastLoginIp() ?? \Request::ip() }}</span>
                         </p>
                      </div>
                   </div>
                   <div class="row row-eq-height">
                      <div class="col-lg-8 col-xs-12 flush">
                         <div class="card">
                            <h2>Balance Details</h2>
                            <div class="button_ggrop"> 
                               <a href="{{ route('wallet.deposit') }}" class="green_btn">Deposit</a>
                               <a href="{{ route('wallet.withdraw') }}" class="white_btn">Withdraw</a>
                            </div>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                               <li class="nav-item"> <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Crypto</a>
                               </li>
                               <li class="nav-item"> <a onclick="newchart()" class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Fiat</a>
                               </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                               <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                  <div class="row under_tabs">
                                     <div class="col-lg-6">
                                        <h4>Account Balance: <a href="#">Hide Balance <i class="fal fa-eye-slash"></i></a></h4>
                                    {{-- <h1>{{ Auth::user()->wallet()->get(['coin','currency_id'])->sum('coin') }}<span>{{ Auth::user()->wallet()->get(['coin','currency_id'])->first()->currency->name }}</span></h1> --}}
                                        <h3>Estimated Value:</h3>
                                        <h6 style="font-family: 'Open Sans', sans-serif;">₹108.6</h6>
                                     </div>
                                     <div class="col-lg-6 text-center">
                                        <div class="doughnut">
                                          <div class="doughnutChartContainer">
                                            <canvas id="doughnutChart" height="160"></canvas>
                                          </div>
                                          <div id="legend" class="chart-legend"></div>
                                        </div>
                                     </div>               
                                  </div>
                               </div>
                               <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">

                                   <div class="row under_tabs">
                                     <div class="col-lg-6">
                                        <h4>Account Balance: <a href="#">Hide Balance <i class="fal fa-eye-slash"></i></a></h4>
                                    {{-- <h1>{{ Auth::user()->wallet()->get(['coin','currency_id'])->sum('coin') }}<span>{{ Auth::user()->wallet()->get(['coin','currency_id'])->first()->currency->name }}</span></h1> --}}
                                        <h3>Estimated Value:</h3>
                                        <h6 style="font-family: 'Open Sans', sans-serif;">₹108.6</h6>
                                     </div>
                                     <div class="col-lg-6 text-center">
                                        <div class="doughnut">
                                          <div class="doughnutChartContainer">
                                            <canvas id="doughnutChart1" height="160"></canvas>
                                          </div>
                                          <div id="legend1" class="chart-legend"></div>
                                        </div>
                                     </div>               
                                  </div>


                               </div>
                            </div>
                         </div>
                      </div>
                      <div class="col-lg-4 col-xs-12 xs-flush">
                         <div class="card pd_card">
                            <h2>Profile Details</h2>
                            <hr/>
                            <label>Username:</label>
                            <p class="username"><span> {{ Auth::user()->name }} </span>
                              @if(Auth::user()->is_username_updated == false)
                              <a href="#" data-toggle="modal" data-target="#usernameUpdate"> <i class="fal fa-edit"></i></a>
                              @endif
                              </p>
                            <p class="alert currency-msg pl-0 pb-0 m-0 small" style="display: none"></p>   
                            <label>Currency</label>
                            <div class="dropdown currency_two three_coins crypto">
                               @php 
                                 $currencies = \App\Models\Currency::where('type_id',2)->get();
                                 $default_currency = !empty(Auth::user()->default_currency) ? \App\Models\Currency::find(Auth::user()->default_currency) : \App\Models\Currency::first();
                               @endphp
                               <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                 <img src="{{ $default_currency->firstMedia('icon')->getUrl() }}" alt="{{__($default_currency->name)}}">{{__($default_currency->short_name)}}
                               </button>
                               <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @foreach($currencies as $cIndex=> $currency)
                                    <a class="dropdown-item currency-item" href="javascript:void(0)" data-currency={{ $currency->id }}>
                                   @if($currency->hasMedia('icon'))
                                      <img src="{{ $currency->firstMedia('icon')->getUrl() }}" alt="{{ $currency->name }}">

                                      @endif

                                       {{ $currency->short_name }}</a>
                                @endforeach                                
                              </div>
                            </div>
                            <label>Language</label>
                            <div class="dropdown currency_two three_coins crypto">
                              @php 
                              $languages = \App\Models\Language::all();
                              $default_language = !empty(Auth::user()->default_language) ? \App\Models\Language::find(Auth::user()->default_language) : \App\Models\Language::where('is_default',1)->first();
                              @endphp
                              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img src="{{ $default_language->firstMedia('icon')->getUrl() }}" alt="">{{ $default_language->name }}
                              </button>
                              <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                @foreach ($languages as $item)
                                    <a class="dropdown-item language-item" href="#" data-language="{{ $item->id }}"><img src="{{ $item->firstMedia('icon')->getUrl() }}" alt="">{{ $item->name}}</a>
                                @endforeach
                              </div>
                            </div>
                            <div class="sn_notificatio">
                               <i class="fal fa-comment-alt-lines"></i>
                               SMS Notification
                               <button type="button" class="btn btn-sm btn-toggle" data-mode="sms_notification" data-toggle="button" aria-pressed="{{ Auth::user()->sms_notification ? 'true' : 'false' }}" autocomplete="off">
                                 <div class="handle"></div>
                               </button>
                            </div>  
                            <div class="sn_notificatio">
                               <i class="fal fa-bell"></i>
                               Line Notification
                               <button type="button" class="btn btn-sm btn-toggle" data-mode="line_notification" data-toggle="button" aria-pressed="{{ Auth::user()->line_notification ? 'true' : 'false' }}" autocomplete="off">
                                 <div class="handle"></div>
                               </button>
                            </div> 
                            <p class="alert toggle-msg small" style="display: none"></p>
                            
                         </div>
                      </div>
                   </div>
                   <div class="row row-eq-height">
                      <div class="col-lg-4 col-xs-12 flush-left  xs-flush">
                         <div class="card">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                               <li class="nav-item"> <a class="nav-link active" id="activity-tab" data-toggle="tab" href="#activity" role="tab" aria-controls="activity" aria-selected="true">{{__("Activity")}}</a>
                               </li>
                               <li class="nav-item"> <a class="nav-link" id="devices-tab" data-toggle="tab" href="#devices" role="tab" aria-controls="devices" aria-selected="false">{{__("Devices")}}</a>
                               </li>
                            </ul>
                            <div class="tab-content card_scroll" id="myTabContent">
                               <div class="tab-pane fade show active" id="activity" role="tabpanel" aria-labelledby="activity-tab">
                                 @foreach (auth()->user()->authentications as $item)
                                 <div class="coll_one">
                                     <div class="left_call">
                                        <h6>{{ $item->user_agent }}</h6>
                                        <p>{{ $item->login_at}}</p>
                                     </div>
                                     <div class="right_call">
                                        <h6>{{ $item->region_name }}, {{ $item->country_name }}</h6>
                                        <p>IP: {{ $item->ip_address }}</p>
                                     </div>
                                  </div>
                                  @endforeach 
                               </div>
                               <div class="tab-pane fade" id="devices" role="tabpanel" aria-labelledby="devices-tab">...</div>
                            </div>
                         </div>
                      </div>
                      <div class="col-lg-4 col-xs-12 flush-right  xs-flush">
                         <div class="card pd_card sc_card">
                            <h2>Security <span>3/4</span></h2>
                            <hr/>
                            <ul>
                               <li><i class="fal fa-check"></i> Enable 2FA</li>
                               <li><i class="fal fa-check"></i> Verified</li>
                               <li><i class="fal fa-check"></i> Enable Anti-phishing Code</li>
                               <li><i class="fal fa-times"></i> Turn-on withdrawal whitelist <span>Turn On</span></li>
                            </ul>         
                         </div>
                      </div>
                      <div class="col-lg-4 col-xs-12  xs-flush">
                         <div class="card pd_card">
                            <h2>Annoucement</h2>
                            <hr/>
                            <div class="coll_one">
                               <h6>Date-12/05/2021</h6>
                               <p>Notice Regarding Coin-Margined ETCUSD 
                               Perpetual Contract K-line Adjustment</p>
                            </div>   
                            <div class="coll_one">
                               <h6>Date-12/05/2021</h6>
                               <p>Notice Regarding Coin-Margined ETCUSD 
                               Perpetual Contract K-line Adjustment</p>
                            </div> 
                            <div class="coll_one last">
                               <h6>Date-12/05/2021</h6>
                               <p>Notice Regarding Coin-Margined ETCUSD 
                               Perpetual Contract K-line Adjustment</p>
                            </div>      
                         </div>
                      </div>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </section>
 @if(Auth::user()->is_username_updated == false)
   @include('front.user._updateUsername')
 @endif 
@endsection
 @section('page_scripts')
 <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.3.0/Chart.js"></script>
   <script>
       var colors = [
        'rgb(247, 131, 38)',
        'rgb(55, 215, 84)',
        'rgb(68, 148, 251)',
        'rgb(158, 163, 165)',
        'rgb(51, 143, 82)',
        'rgb(77, 83, 96)',
        'rgb(180, 142, 173)',
        'rgb(150, 181, 180)',
        'rgb(235, 203, 138)',
        /*'rgb(94, 65, 149)',
        'rgb(171, 121, 103)',
        'rgb(134, 175, 18)'*/
      ];

      @php
          $labels=$coins=$fiatLabels=$fiatCoins=[];
          $totalCryptoSum=$totalFiatSum=0;
      foreach(auth()->user()->wallet()->where('wallet_type','!=',3)->orderBy('coin','desc')->get() as $balance)
      {
        if($balance->wallet_type==1)
        {
          $totalCryptoSum+=(float)$balance->coin;

          if(count($labels) >= 3)
          {
             if(count($labels)<4)
             {
               $labels[]='Others';
               $coins[]=(float)$balance->coin;
             }
             else
             {
               $coins[3]=$coins[3]+(float)$balance->coin;
             }

             
             
          }
          else
          {
             $labels[]=$balance->currency->short_name.' '.$balance->coin;

             $coins[]=(float)$balance->coin;

          }
          
        }
        else
        {
          $totalFiatSum+=(float)$balance->coin;
          if(count($fiatLabels) >= 3)
          {
             if(count($fiatLabels)<4)
             {
               $fiatLabels[]='Others';
               $fiatCoins[]=(float)$balance->coin;
             }
             else
             {
               $fiatCoins[3]=$fiatCoins[3]+(float)$balance->coin;
             }

             
             
          }
          else
          {
            $fiatLabels[]=$balance->currency->short_name.' '.$balance->coin;

            $fiatCoins[]=(float)$balance->coin;
          }
          
        }
        

      }

      if($totalCryptoSum <=0)
      {
         $labels[]=['Nil'];
         $coins[]=[1];
      }

      if($totalFiatSum <=0)
      {
        $fiatLabels=['Nil'];
         $fiatCoins=[1];
      }



      

      @endphp
      var labels = @json($labels);
      var data = @json($coins);
      var fiatLabels = @json($fiatLabels);
      var fiatCoins = @json($fiatCoins);
      var bgColor = colors;


      var dataChart = {
        labels: labels,
        datasets: [{
          data: data,
          backgroundColor: bgColor
        }]
      };
      var config = {
        type: 'doughnut',
        data: dataChart,
        options: {
          maintainAspectRatio: false,
          cutoutPercentage: 45,
          legend: {
            display: false
          },
          legendCallback: function(chart) {
            var text = [];
            text.push('<ul class="doughnut-legend">');
            if (chart.data.datasets.length) {
              for (var i = 0; i < chart.data.datasets[0].data.length; ++i) {
                text.push('<li><span class="doughnut-legend-icon" style="background-color:' + chart.data.datasets[0].backgroundColor[i] + '"></span>');
                if (chart.data.labels[i]) {
                  text.push('<span class="doughnut-legend-text">' + chart.data.labels[i] + '</span>');
                }
                text.push('</li>');
              }
            }
            text.push('</ul>');
            return text.join("");
          },
          tooltips: {
            yPadding: 10,
            callbacks: {
              label: function(tooltipItem, data) {
                var total = 0;
                data.datasets[tooltipItem.datasetIndex].data.forEach(function(element /*, index, array*/ ) {
                  total += element;
                });
                var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];

                if(data.labels[tooltipItem.index]=='Nil')
                {
                  return 'Nil';
                }
                var percentTxt = Math.round(value / total * 100);
                return data.labels[tooltipItem.index] + ': ' + data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index] + ' (' + percentTxt + '%)';
              }
            }
          }
        }
      };
        var ctx = document.getElementById("doughnutChart").getContext("2d");
         var doughnutChart = new Chart(ctx, config);

      var legend = doughnutChart.generateLegend();
      var legendHolder = document.getElementById("legend");
      legendHolder.innerHTML = legend + '';


      // second dounhnutchart

      

     


    var fiatChart=0;

      function newchart()
      {

        if(!fiatChart)
        {
          var config2 = Object.assign({}, config);

          var bgColor2 = [...bgColor];

      var dataChart2 = {
        labels: fiatLabels,
        datasets: [{
          data: fiatCoins,
          backgroundColor: bgColor2.reverse()
        }]
      };
           config2.data=dataChart2;
        setTimeout(function()
        {
            var ctx1 = document.getElementById("doughnutChart1").getContext("2d");
         var doughnutChart1 = new Chart(ctx1, config2);

      var legend1 = doughnutChart1.generateLegend();
      var legendHolder1 = document.getElementById("legend1");
      legendHolder1.innerHTML = legend1 + '';

        fiatChart=1;
        },200);

      }
        
      }
      

    $('.btn-toggle').on('click',function(e){
        e.preventDefault();
        var mode= $(this).data('mode');
         $.ajax({
            type:'POST',
            dataType:'JSON',
            url:"{{ route('user.update.notification') }}",
            data:{ mode : mode, _token: "{{ csrf_token() }}" },
            success:function(data) {
               $('.usr-msg').html(data.message).show();
               setTimeout(function() { $(".usr-msg").hide() }, 2000);               
            }
         });
    });
    $('.currency-item').on('click',function(e){
      e.preventDefault();
      var currency= $(this).data('currency');
      $.ajax({
         type:'POST',
         dataType:'JSON',
         url:"{{ route('user.update.currency') }}",
         data:{ currency : currency, _token: "{{ csrf_token() }}" },
         success:function(data) {
            $('.currency-msg').html(data.message).show();
            setTimeout(function() { $(".currency-msg").hide() }, 2000);
            location.reload();
         }
      });
   });
   $('.language-item').on('click',function(e){
      e.preventDefault();
      var language= $(this).data('language');
      $.ajax({
         type:'POST',
         dataType:'JSON',
         url:"{{ route('user.update.language') }}",
         data:{ language : language, _token: "{{ csrf_token() }}" },
         success:function(data) {
            $('.currency-msg').html(data.message).show();
            setTimeout(function() { $(".currency-msg").hide() }, 2000);
            location.reload();
         }
      });
   });
 </script>
 @endsection

