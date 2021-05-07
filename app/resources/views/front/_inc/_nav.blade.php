<div id="header" id="home">
    <div class="container-fluid">
        <div class="header-bottom">
            <nav id="navigation" class="navigation navigation-landscape navbar-light bg-light">
                <div class="nav-header">
                    <a class="navbar-brand  dark-mode-img" href="{{ route('home') }}">
                        <img src="{{ asset('front/img/logo.png') }}" class="black-logo" alt="">
                        <img src="{{ asset('front/img/logo.png') }}" class="white_logo" alt="">
                    </a>
                    <div class="nav-toggle"></div>
                    <a class="btn btn-primary" href="#">Register</a>
                </div>
                <div class="nav-menus-wrapper" style="transition-property: none;">
                    <ul class="nav-menu">
                        <li class="nav-item"> <a class="nav-link" href="p2p.html">P2P Exchange</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="#">Mortgage Loan</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="#">Staking</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="#">Auto Trading</a>
                        </li>
                        <li class="nav-item"> <a class="nav-link" href="#">ICO Information</a>
                        </li>
                    </ul>
                    <div class="right_side  my-2 my-lg-0">

                        <ul class="main_ul">
                            @if (!Auth::check())
                                <li><a class="" href="{{ route('login') }}">Log In</a></li>
                                <li class="hd_small"><a class="btn btn-primary"
                                        href="{{ route('register') }}">Register</a></li>
                                <li>
                                    <div class="dark-light"> <i class="fa fa-moon-o" aria-hidden="true"></i></div>
                                </li>
                            @else

                            @php

                            $wallet_types=\App\Models\CurrencyType::all();

                            @endphp
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Wallet
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <ul>

                                            @foreach($wallet_types as $wallet)

                                            <li><a href="{{route('wallet.history',['type'=>$wallet->id,'typename'=>strtolower($wallet->type)])}}">{{__($wallet->type)}} {{__('Wallet')}}
                                                  
                                                </a></li>

                                            @endforeach
                                            
                                            
                                            <li><a href="{{route('wallet.deposit')}}">Deposit</a></li>
                                            <li><a href="#">Deposit history</a></li>
                                        </ul>
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
                                                <a class="not-c"
                                                    href="mailto:rahul@routecoin.com">{{ Auth::user()->email }}<br>
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
                                    <div class="dropdown currency_two">
                                        <button class="btn btn-secondary dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            <img src="img/GBP.svg" alt=""> <span>United States Dollar</span>
                                            USD</button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <form class="form-inline">
                                                <input class="form-control mr-sm-2" type="search" placeholder="Search"
                                                    aria-label="Search"> <span><i class="fa fa-search"
                                                        aria-hidden="true"></i></span>
                                                <a class="dropdown-item  myLink" href="usd">
                                                    <img src="img/AUD.svg" alt="">Australian Dollar <span>USD</span>
                                                </a>
                                                <a class="dropdown-item myLink" href="krw">
                                                    <img src="img/EUR.svg" alt="">Korean won <span>KRW</span>
                                                </a>
                                                <a class="dropdown-item myLink" href="inr">
                                                    <img src="img/inr.svg" alt="">Indian Rupee <span>INR</span>
                                                </a>
                                                <a class="dropdown-item myLink" href="thb">
                                                    <img src="img/thb.svg" alt="">Thai Baht <span>THB</span>
                                                </a>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                                <li class="onsubmenu">
                                    <div class="dark-light"> <i class="fa fa-moon-o" aria-hidden="true"></i></div>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>

        </div>
    </div>
</div>
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    {{ csrf_field() }}
</form>