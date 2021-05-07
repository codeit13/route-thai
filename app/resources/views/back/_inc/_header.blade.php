<nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
    <div class="container-fluid">
       <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <h3><i class="fa fa-user-circle" aria-hidden="true"></i></h3>
          <!-- Search form -->
          <form class="navbar-search navbar-search-light form-inline mr-sm-3" id="navbar-search-main">
             <div class="form-group mb-0">
                <div class="input-group input-group-alternative input-group-merge">
                   <div class="input-group-prepend"> <span class="input-group-text"><i class="fa fa-search" aria-hidden="true"></i></span>
                   </div>
                   <input class="form-control" placeholder="" type="text">
                </div>
             </div>
             <button type="button" class="close" data-action="search-close" data-target="#navbar-search-main" aria-label="Close"> <span aria-hidden="true">×</span>
             </button>
          </form>
          <!-- Navbar links -->
          <ul class="navbar-nav align-items-center  ml-md-auto ">
             <li class="nav-item d-xl-none">
                <!-- Sidenav toggler -->
                <div class="pr-3 sidenav-toggler sidenav-toggler-dark" data-action="sidenav-pin" data-target="#sidenav-main">
                   <div class="sidenav-toggler-inner"> <i class="sidenav-toggler-line"></i>
                      <i class="sidenav-toggler-line"></i>
                      <i class="sidenav-toggler-line"></i>
                   </div>
                </div>
             </li>
             <li class="nav-item d-sm-none">
                <a class="nav-link" href="#" data-action="search-show" data-target="#navbar-search-main"> <i class="ni ni-zoom-split-in"></i>
                </a>
             </li>
             @if(Auth::guard('admin')->check())
             <li>
               <a href="#"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">Logout</a>
             </li>
             @endif
             <li class="nav-item dropdown">
                <li class="dropdown language-selector">
                   <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true" aria-expanded="false">
                     <img src="{{ asset('back/img/us.svg') }}">&nbsp;
                     
                   </a>
                   <ul class="dropdown-menu pull-right">
                     <li data-lang="ko" class="language-dropdown">
                       <a href="#">
                         <img src="{{ asset('back/img/kr.svg') }}">
                         <span>Korean</span>
                       </a>
                     </li>
                     <li data-lang="en" class="active language-dropdown">
                       <a href="#">
                         <img src="{{ asset('back/img/us.svg') }}">
                         <span>English</span>
                       </a>
                     </li>
                     <li data-lang="th" class="language-dropdown">
                       <a href="#">
                         <img src="{{ asset('back/img/th.svg') }}">
                         <span>Thailand</span>
                       </a>
                     </li>
                     <li data-lang="chi" class="language-dropdown">
                       <a href="#">
                         <img src="{{ asset('back/img/cn.svg') }}">
                         <span>Chineese</span>
                       </a>
                     </li>
                     <li data-lang="jpn" class="language-dropdown">
                       <a href="#">
                         <img src="{{ asset('back/img/jp.svg') }}">
                         <span>Japanese</span>
                       </a>
                     </li>
                   </ul>
                 </li>
             </li>
          </ul>
          <ul class="navbar-nav align-items-center  ml-auto ml-md-0 ">
             <li class="nav-item dropdown">
                <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                   <div class="media align-items-center">
                      <span class="avatar avatar-sm rounded-circle">
                      <img alt=" Image placeholder" src="{{ asset('back/img/theme/team-4.png') }}">
                      </span>

                      <div class="media-body  ml-2  d-none d-lg-block"> <span class="mb-0 text-sm  font-weight-bold">{{ Auth::guard('admin')->user()->name??'' }}</span>
                      @if(Auth::guard('admin')->check())
                           <div class="media-body  ml-2  d-none d-lg-block"> <span class="mb-0 text-sm  font-weight-bold">{{ Auth::guard('admin')->user()->name }}</span>                              
                      @endif
                      </div>
                   </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right ">
                   <div class="dropdown-header noti-title">
                      <h6 class="text-overflow m-0"></h6>
                   </div>
                   
                   <!-- <a href="#!" class="dropdown-item"> <i class="ni ni-single-02"></i>
                   <span>My profile</span>
                   </a>
                   <a href="#!" class="dropdown-item"> <i class="ni ni-settings-gear-65"></i>
                    <span>Settings</span>
                   </a>
                   <a href="#!" class="dropdown-item"> <i class="ni ni-calendar-grid-58"></i>
                   <span>Activity</span>
                   </a>
                   <a href="#!" class="dropdown-item"> <i class="ni ni-support-16"></i>
                   <span>Support</span>
                   </a> -->
                   <div class="dropdown-divider"></div>
                   <a href="auth/logout.php" class="dropdown-item"> <i class="ni ni-user-run"></i>
                   <span></span>
                   </a>
                </div>
             </li>
          </ul>
       </div>
    </div>
 </nav>
 <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
   {{ csrf_field() }}
</form>