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
                 <h6 class="navbar-heading p-0 text-muted">
                   <span class="docs-normal"></span>
                 </h6>
                 <ul class="navbar-nav">
                  {{-- <li class="nav-item">
                     <a class="nav-link" href="#"><i class="fa fa-language text-green" aria-hidden="true"></i>
                       <span class="nav-link-text"></span>
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" href="#"><i class="fa fa-language text-red" aria-hidden="true"></i>
                       <span class="nav-link-text"></span>
                     </a>
                  </li> --}}
             </ul>
          </div>
       </div>
    </div>
 </nav>