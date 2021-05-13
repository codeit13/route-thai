@php $route = \Request::route()->getName(); @endphp
<div class="col-lg-2 col-xs-12 flush">
    <div class="sidebar">
       <ul>
          <li class="{{ $route == 'user.dashboard' ? 'active': ''}}"><a href="{{ route('user.dashboard') }}"><i class="fal fa-tv-alt"></i> Dashboard</a>
          </li>
          <li class="{{ $route == 'user.profile' ? 'active': ''}}"> <a href="{{ route('user.profile') }}"><i class="fal fa-user"></i> Basic Info</a>
          </li>
          <li> <a href="#"><i class="fal fa-credit-card"></i> Payment</a>
          </li>
          <li> <a href="#"><i class="fal fa-lock"></i> Securtiy</a>
          </li>
       </ul>
    </div>
 </div>