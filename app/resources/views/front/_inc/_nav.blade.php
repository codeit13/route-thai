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
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="{{ asset('front/img/GBP.svg') }}" alt="">English</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <form class="form-inline">
                                                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> <span><i class="fa fa-search" aria-hidden="true"></i></span>
                                                <a class="dropdown-item  myLink" href="">
                                                <img src="{{ asset('front/img/kr.svg')}}" alt="">Korean</span>
                                                </a>
                                                <a class="dropdown-item myLink" href="">
                                                <img src="{{ asset('front/img/th.svg')}}" alt="">Thailand</span>
                                                </a>
                                                <a class="dropdown-item myLink" href="">
                                                <img src="{{ asset('front/img/cn.svg')}}" alt="">Chineese</span>
                                                </a>
                                                <a class="dropdown-item myLink" href="">
                                                <img src="{{ asset('front/img/jp.svg')}}" alt="">Japanese</span>
                                                </a>
                                            </form>
                                        </div>
                                    </div>
                                    </li>
                                <li>
                                    <div class="dark-light"> <i class="fa fa-moon-o" aria-hidden="true"></i></div>
                                </li>
                            @else

                            @php $wallet_types = \App\Models\CurrencyType::all(); @endphp
                                <li class="nav-item dropdown onhover">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <span class="visible-xs"><i class="fal fa-wallet"></i></span>Wallet
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <ul>
                                            @foreach($wallet_types as $wallet)
                                            <li><a href="{{route('wallet.history',['type'=>$wallet->id,'typename'=>strtolower($wallet->type)])}}">{{__($wallet->type)}} {{__('Wallet')}}</a></li>
                                            @endforeach                                            
                                            <li><a href="{{route('wallet.deposit')}}">{{__('Deposit')}}</a></li>
                                            <li><a href="{{route('wallet.withdraw')}}">{{__('Withdraw')}}</a></li>
                                            <li><a href="{{route('wallet.request.history')}}">{{__('History ( Deposit & Withdraw ) ')}}</a></li>
                                        </ul>
                                    </div>
                                </li>
                                
                                <li class="onsubmenu">
                                    <div class="dropdown currency_two">
                                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="{{ asset('front/img/GBP.svg') }}" alt="">English</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            {{-- <form class="form-inline"> --}}
                                                {{-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> <span><i class="fa fa-search" aria-hidden="true"></i></span> --}}
                                                <a class="dropdown-item  myLink" href="">
                                                <img src="{{ asset('front/img/kr.svg')}}" alt="">Korean</span>
                                                </a>
                                                <a class="dropdown-item myLink" href="">
                                                <img src="{{ asset('front/img/th.svg')}}" alt="">Thailand</span>
                                                </a>
                                                <a class="dropdown-item myLink" href="">
                                                <img src="{{ asset('front/img/cn.svg')}}" alt="">Chineese</span>
                                                </a>
                                                <a class="dropdown-item myLink" href="">
                                                <img src="{{ asset('front/img/jp.svg')}}" alt="">Japanese</span>
                                                </a>
                                            {{-- </form> --}}
                                        </div>
                                    </div>
                                    </li>
                                    <li class="onsubmenu">
                                        <div class="dropdown currency_two">
                                           <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                              <img src="{{ asset('front/img/Korean Won.png') }}" alt=""> <span>Korean Won</span> KRW</button>
                                           <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                              {{-- <form class="form-inline"> --}}
                                                 {{-- <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search"> <span><i class="fa fa-search" aria-hidden="true"></i></span> --}}
                                                 <a class="dropdown-item  myLink" href="usd">
                                                    <img src="{{ asset('front/img/USD Dollar.png') }}" alt="">United states Dollar <span>USD</span>
                                                 </a>
                                                 <a class="dropdown-item myLink" href="inr">
                                                    <img src="{{ asset('front/img/Indian Rupee.png') }}" alt="">Indian Rupee <span>INR</span>
                                                 </a>
                                                 <a class="dropdown-item myLink" href="thb">
                                                    <img src="{{ asset('front/img/Thai Baht.png') }}" alt="">Thai Baht <span>THB</span>
                                                 </a>
                                                 <a class="dropdown-item myLink" href="krw">
                                                    <img src="{{ asset('front/img/Japenese Yuan.png') }}" alt="">Japanese Yuan <span>JPY</span>
                                                 </a>
                                              {{-- </form> --}}
                                           </div>
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
                                <li class="onsubmenu hidden-xs"><a class="bell" href="#"><i class="fa fa-bell-o" aria-hidden="true"></i> <span>05</span></a></li>
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