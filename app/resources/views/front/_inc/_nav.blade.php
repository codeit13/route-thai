<div id="header" id="home" class="p2p-wallet">
    <div class="container-fluid">
        <div class="header-bottom">
            <nav id="navigation" class="navigation navigation-landscape navbar-light bg-light">
                <div class="nav-header">
                    <a class="navbar-brand  dark-mode-img" href="{{ route('home') }}">
                       <img src="{{ asset('front/img/logo.png') }}" class="black-logo" alt="">
                       <img src="{{ asset('front/img/logo.png') }}" class="white_logo" alt="">
                    </a>
                    <div class="nav-toggle"></div>
                    <header class="site-header visible-xs">
                      <nav class="site-nav">
                        <input id="site-menu-trigger" type="checkbox">
                        <label for="site-menu-trigger">
                          <span class="line"></span>
                          <span class="line"></span>
                          <span class="line"></span>
                          <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                        </label>
                        <div class="site-menu">
                          <ul>
                           @if(Auth::check())   
                            <li>
                            <a class="not-c" href="{{ route('user.dashboard') }}">{{ ucfirst(Auth::user()->name) }}<br><label><i class="fa fa-diamond" aria-hidden="true"></i> VIP <span>Verified</span></label></a>
                            </li>
                            @endif
                            <li><a href="#">Security</a></li>
                            <li><a href="#">Identification</a></li>
                            <li><a href="#">API Management</a></li>
                            <li><a href="#">Reward Center</a></li>
                            <li><a href="#">Task Center</a></li>
                            <li><a href="#">Referral <mark>Earn bonus</mark></a></li>
                            <li><a href="#" onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                            </li>
                        </ul>
                        </div>
                      </nav>
                    </header>
                    <li class="onsubmenu visible-xs"><a class="bell" href="#"><i class="fa fa-bell-o" aria-hidden="true"></i> <span>05</span></a></li>
                    <a class="mobile_logo visible-xs" href="{{ route('home') }}">
                       <img src="{{ asset('front/img/logo.png') }}" class="white_logo" alt="">
                    </a>
                 </div>
                <div class="nav-menus-wrapper" style="transition-property: none;">
                    @if (!Auth::check())
                    <div class="mobile_menu visible-xs"> 
                        <a class="" href="{{ route('login')}}">Log In</a>
                        <a class="btn btn-primary" href="{{ route('register')}}">Register</a>
                    </div>
                    @endif
                    <ul class="nav-menu">
                        <li class="nav-item {{\Route::is("p2p.exchange")?'active':''}}" > <a class="nav-link" href="{{route('p2p.exchange')}}"><span class="visible-xs"><i class="far fa-exchange-alt"></i></span>P2P Exchange</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="#"><span class="visible-xs"><i class="fas fa-landmark"></i></span>Mortgage Loan</a>
                        </li>
                        <li class="nav-item {{\Route::is("staking")?'active':''}}"> <a class="nav-link" href="{{route('staking')}}"><span class="visible-xs"><i class="far fa-plane-departure"></i></span>Staking</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="#"><span class="visible-xs"><i class="fas fa-magic"></i></span>Auto Trading</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="#"><span class="visible-xs"><i class="fal fa-info-circle"></i></span>ICO Information</a>
                        </li>
                        <li class="nav-item"> <a target="_blank" class="nav-link" href="//arbitrage.route-thai.com"><span class="visible-xs"><i class="fab fa-bitcoin"></i></span>Arbitrage</a>
                        </li>
                    </ul>
                    <div class="right_side  my-2 my-lg-0">

                        <ul class="main_ul">
                            @if (!Auth::check())<li class="hd_small"><a class="" href="{{ route('login') }}">Log In</a></li>
                            <li class="hd_small"><a class="btn btn-primary" href="{{ route('register') }}">Register</a></li>
                            <li class="onsubmenu">
                                <div class="dropdown currency_two">
                                  @php 
                                    $languages = \App\Models\Language::all();
                                    $default_language = !empty(Auth::user()->default_language) ? \App\Models\Language::find(Auth::user()->default_language) : \App\Models\Language::where('is_default',1)->first();
                                    @endphp
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <img src="{{ $default_language->firstMedia('icon') != null ? $default_language->firstMedia('icon')->getUrl() : '' }}" alt="">{{ $default_language->name }}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @foreach ($languages as $item)
                                            <a class="dropdown-item language-item" href="#" data-language="{{ $item->id }}"><img src="{{ $item->firstMedia('icon')->getUrl() }}" alt="">{{ $item->name}}</a>
                                        @endforeach
                                    </div> 
                                </div>
                                </li>
                            <li>
                            <div class="dark-light"> <i class="fa fa-moon-o" aria-hidden="true"></i></div>
                            </li>
                            @else
                            @php $wallet_types = \App\Models\CurrencyType::all(); @endphp
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="visible-xs"><i class="fal fa-wallet"></i></span>Wallet
                                </a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <ul>
                                        <li><a href="{{route('wallet.history')}}">{{__('Fiat and Spot')}}</a></li> 
                                        <li><a href="{{route('wallet.p2p')}}">{{__('P2P')}}</a></li>                                   
                                        <li><a href="{{route('wallet.deposit')}}">{{__('Deposit')}}</a></li>
                                        <li><a href="{{route('wallet.withdraw')}}">{{__('Withdraw')}}</a></li>
                                        <li><a href="{{route('wallet.request.history')}}">{{__('History ( Deposit & Withdraw ) ')}}</a></li>
                                        {{-- <li><a href="{{route('wallet.history')}}">{{__('Crypto and Fiat')}}</a></li>   
                                        <li><a href="{{route('wallet.p2p')}}">{{__('P2P')}}</a></li>                                     
                                        <li><a href="{{route('wallet.deposit')}}">{{__('Deposit')}}</a></li>
                                        <li><a href="{{route('wallet.withdraw')}}">{{__('Withdraw')}}</a></li>
                                        <li><a href="{{route('wallet.request.history')}}">{{__('History ( Deposit & Withdraw ) ')}}</a></li> --}}
                                            <li><a href="{{route('trade.history')}}">{{__('Trade History')}}</a></li>
                                        </ul>
                                </div>
                            </li>
                            <li class="onsubmenu">
                                <div class="dropdown currency_two">
                                    @php 
                                    $languages = \App\Models\Language::all();
                                    $default_language = !empty(Auth::user()->default_language) ? \App\Models\Language::find(Auth::user()->default_language) : \App\Models\Language::where('is_default',1)->first();
                                    @endphp
                                    <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        @if($default_language->hasMedia('icon'))
                                        <img src="{{ $default_language->firstMedia('icon')->getUrl()??'' }}" alt="">{{ $default_language->name }}
                                        @endif
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        @foreach ($languages as $item)
                                            <a class="dropdown-item language-item" href="#" data-language="{{ $item->id }}">
                                                @if($item->hasMedia('icon'))
                                                <img src="{{ $item->firstMedia('icon')->getUrl() }}" alt="">

                                                @endif

                                                {{ $item->name}}</a>
                                        @endforeach
                                    </div>
                                </div>
                                </li>
                                <li class="onsubmenu">
                                    <div class="dropdown currency_two">
                                        @php 
                                        $currencies = \App\Models\Currency::where('type_id',2)->get();
                                        $default_currency = !empty(Auth::user()->default_currency) ? \App\Models\Currency::find(Auth::user()->default_currency) : \App\Models\Currency::where('type_id',2)->first();
                                        @endphp
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="{{ $default_currency->firstMedia('icon')->getUrl() }}" alt="{{__($default_currency->name)}}">{{__($default_currency->short_name)}}
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton" x-placement="bottom-start">
                                        @foreach($currencies as $cIndex=> $currency)
                                            <a class="dropdown-item myLink currency-item" href="javascript:void(0)" data-currency={{ $currency->id }}>

                                                  @if($currency->hasMedia('icon'))

                                                <img src="{{ $currency->firstMedia('icon')->getUrl() }}" alt="{{ $currency->name }}">

                                                @endif

                                                {{ $currency->name }} <span> {{ $currency->short_name }}</span></a>
                                        @endforeach 
                                    </div>
                                 </li>
                                <li class="nav-item dropdown hidden-xs">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                    </a>
                                <div class="dropdown-menu max-w" aria-labelledby="navbarDropdown">
                                    <ul>
                                        <li>
                                            <a class="not-c" href="{{ route('user.dashboard') }}">{{ ucfirst(Auth::user()->name) }}<br>
                                                <label><i class="fa fa-diamond" aria-hidden="true"></i> VIP
                                                    <span>Verified</span></label></a>
                                        </li>
                                        <li><a href="#">Security</a></li>
                                        <li><a href="#">Identification</a></li>
                                        <li><a href="#">API Management</a></li>
                                        <li><a href="#">Reward Center</a></li>
                                        <li><a href="#">Task Center</a></li>
                                        <li><a href="#">Referral <mark>Earn bonus</mark></a></li>
                                        <li><a href="#"
                                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item dropdown ntf hidden-xs">
                                    <a class="nav-link dropdown-toggle bell non" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-bell-o" aria-hidden="true"></i> <span>04</span>
                                    </a>
                                <div class="dropdown-menu max-w notification_menu" aria-labelledby="navbarDropdown">
                                    <ul>
                                        <li class="head text-light bg-dark">
                                                <span>Notifications (4)</span>
                                                <a href="" class="float-right text-light">Mark all as read</a>
                                          </li>
                                          <li>
                                              <div class="notifi_body">
                                                  <ul>
                                                      <li class="notification-box">
                                                        <div class="row">
                                                          <div class="col-lg-3 col-sm-3 col-3 text-center">
                                                            <img src="{{ asset('front/img/coin_23.png') }}" class="w-50 rounded-circle">
                                                          </div>    
                                                          <div class="col-lg-8 col-sm-8 col-8">
                                                            <h2>David John</h2>
                                                            <p>
                                                              Lorem ipsum dolor sit amet, consectetur
                                                            </p>
                                                            <small class="text-warning">27.11.2015, 15:00</small>
                                                          </div>    
                                                        </div>
                                                      </li>
                                                      <li class="notification-box bg-gray">
                                                        <div class="row">
                                                          <div class="col-lg-3 col-sm-3 col-3 text-center">
                                                            <img src="{{ asset('front/img/coin_23.png') }}" class="w-50 rounded-circle">
                                                          </div>    
                                                          <div class="col-lg-8 col-sm-8 col-8">
                                                            <h2>David John</h2>
                                                            <p>
                                                              Lorem ipsum dolor sit amet, consectetur
                                                            </p>
                                                            <small class="text-warning">27.11.2015, 15:00</small>
                                                          </div>   
                                                        </div>
                                                      </li>
                                                      <li class="notification-box">
                                                        <div class="row">
                                                          <div class="col-lg-3 col-sm-3 col-3 text-center">
                                                            <img src="{{ asset('front/img/coin_23.png') }}" class="w-50 rounded-circle">
                                                          </div>    
                                                          <div class="col-lg-8 col-sm-8 col-8">
                                                            <h2>David John</h2>
                                                            <p>
                                                              Lorem ipsum dolor sit amet, consectetur
                                                            </p>
                                                            <small class="text-warning">27.11.2015, 15:00</small>
                                                          </div>    
                                                        </div>
                                                      </li>
                                                      <li class="notification-box bg-gray">
                                                        <div class="row">
                                                          <div class="col-lg-3 col-sm-3 col-3 text-center">
                                                            <img src="{{ asset('front/img/coin_23.png') }}" class="w-50 rounded-circle">
                                                          </div>    
                                                          <div class="col-lg-8 col-sm-8 col-8">
                                                            <h2>David John</h2>
                                                            <p>
                                                              Lorem ipsum dolor sit amet, consectetur
                                                            </p>
                                                            <small class="text-warning">27.11.2015, 15:00</small>
                                                          </div>   
                                                        </div>
                                                      </li>
                                                  </ul>
                                              </div>                    
                                          </li>
                                          <li class="footer bg-dark text-center">
                                            <a href="" class="text-light">View All</a>
                                          </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="onsubmenu">
                                <div class="dark-light"> <i class="fa fa-moon-o" aria-hidden="true"></i>
                                    <span class="visible-xs">Dark Mode</span>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    @yield('header-bar')
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>