<style>
.sidenav .nav-link span { color:white}
</style>   
<nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
       <!-- Brand -->
       <div class="sidenav-header  align-items-center">
          <a class="navbar-brand" href="javascript:void(0)">
          <img src="{{ asset('front/img/logo.png') }}">
          <img class="white" src="{{ asset('back/img/daytrade_logo_white.png') }}">
          </a>
       </div>
       <div class="navbar-inner">
          <!-- Collapse -->
          <div class="collapse navbar-collapse" id="sidenav-collapse-main">
             <!-- Nav items -->
              <ul class="navbar-nav">
                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('admin.dashboard') }}"> <i class="ni ni-tv-2 text-primary"></i>
                     <span class="nav-link-text">Dashboard</span>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('admin.users') }}"> <i class="fa fa-user-circle text-orange" aria-hidden="true"></i>
                        <span class="nav-link-text">User Management</span>
                     </a>
                  </li>
                  @php   $requestsTypes = \App\Models\CurrencyType::where('id','!=',3)->get();@endphp

                  @foreach($requestsTypes as $rqType)
                     <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.deposit.requests.show',['type'=>$rqType->id,'name'=>$rqType->type]) }}"> <i class="fa fa-money" aria-hidden="true"></i>
                           <span class="nav-link-text">{{__($rqType->type)}}{{__(' Deposit Requests')}}</span>
                        </a>
                     </li>
                  @endforeach

                  @foreach($requestsTypes as $rqType)
                     <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.withdraw.requests.show',['type'=>$rqType->id,'name'=>$rqType->type]) }}"> <i class="fa fa-money" aria-hidden="true"></i>
                           <span class="nav-link-text">{{__($rqType->type)}}{{__(' Withdraw Requests')}}</span>
                        </a>
                     </li>
                  @endforeach



                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('admin.user.wallets') }}"> <i class="fa fa-money text-green" aria-hidden="true"></i>
                     <span class="nav-link-text">User Wallet</span>
                     </a>
                  </li>

                   <li class="nav-item">
                     <a class="nav-link" href="{{ route('admin.deposit.address') }}"> <i class="fa fa-bitcoin text-green" aria-hidden="true"></i>
                     <span class="nav-link-text">Deposit Address</span>
                     </a>
                  </li>
                  
                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('admin.trades.list') }}"> <i class="fa fa-line-chart text-green" aria-hidden="true"></i>
                     <span class="nav-link-text">Trades</span>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('admin.settings') }}"> <i class="fa fa-settings text-green" aria-hidden="true"></i>
                     <span class="nav-link-text">Settings</span>
                     </a>
                  </li>
                  {{--
                  <li class="nav-item">
                     <a class="nav-link" href="#"> <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                     <span class="nav-link-text"></span>
                     </a>
                  </li>
 
                  <li class="nav-item">
                     <a class="nav-link" href="#"> <i class="fa fa-users text-yellow" aria-hidden="true"></i>
                     <span class="nav-link-text"></span>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#"> <i class="fa fa-user text-green" aria-hidden="true"></i>
                        <span class="nav-link-text"></span>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#"> <i class="ni ni-money-coins text-red" aria-hidden="true"></i>
                        <span class="nav-link-text"></span>
                     </a>
                  </li>
 
                  <li class="nav-item">
                     <a class="nav-link" href="#"> <i class="fa fa-random text-orange" aria-hidden="true"></i>
                        <span class="nav-link-text"></span>
                     </a>
                  </li>
 
                  <li class="nav-item">
                     <a class="nav-link" href="#"> <i class="fa fa-trophy text-yellow" aria-hidden="true"></i>
                        <span class="nav-link-text"></span>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#"> <i class="ni ni-tag text-primary" aria-hidden="true"></i>
                        <span class="nav-link-text"></span>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#"> <i class="fa fa-random text-orange" aria-hidden="true"></i>
                        <span class="nav-link-text"></span>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#"> <i class="fa fa-line-chart text-green" aria-hidden="true"></i>
                        <span class="nav-link-text"></span>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#"> <i class="fa fa-plus-square text-yellow" aria-hidden="true"></i>
                       <span class="nav-link-text"></span>
                     </a>
                  </li>
                </ul>
                 <h6 class="navbar-heading p-0 text-muted">
                   <span class="docs-normal"></span>
                 </h6>
                 <ul class="navbar-nav">
                  <li class="nav-item">
                     <a class="nav-link" href="#"><i class="fa fa-lock text-red" aria-hidden="true"></i>
                       <span class="nav-link-text"></span>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#"><i class="fa fa-desktop text-green" aria-hidden="true"></i>
                       <span class="nav-link-text"></span>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#"><i class="fa fa-list text-yellow" aria-hidden="true"></i>
                       <span class="nav-link-text"></span>
                     </a>
                  </li> --}}
                </ul>
                 <!-- Divider -->
                   
                 <!-- Heading -->
                 <hr class="my-3">
                 <h6 class="navbar-heading p-0 text-muted">
                   <span class="docs-normal">Loan Management</span>
                 </h6>
                 <ul class="navbar-nav mb-md-3">
                  <li class="nav-item">
                    <!--  -->
                     <a class="nav-link" href="{{ route('admin.loan.list') }}"> <i class="ni ni-money-coins text-red" aria-hidden="true"></i>
                     <span class="nav-link-text">Loan Requestes</span>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="{{ route('admin.settings.loan') }}"> <i class="ni ni-money-coins text-red" aria-hidden="true"></i>
                     <span class="nav-link-text">Loan Settings</span>
                     </a>
                  </li>
             </ul>
          </div>
       </div>
    </div>
 </nav>