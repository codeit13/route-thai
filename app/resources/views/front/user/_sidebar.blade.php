@php $route = \Request::route()->getName(); @endphp
<div class="col-lg-2 col-xs-12 flush">
    <div class="sidebar">
       <ul>
          <li class="{{ $route == 'user.dashboard' ? 'active': ''}}"><a href="{{ route('user.dashboard') }}"><i class="fal fa-tv-alt"></i> Dashboard</a>
          </li>
          <li class="{{ $route == 'user.profile' ? 'active': ''}}"> <a href="{{ route('user.profile') }}"><i class="fal fa-user"></i> Basic Info</a>
          </li>
          <li class="{{ $route == 'user.payments' ? 'active': ''}}"> <a href="{{ route('user.payments') }}"><i class="fal fa-credit-card"></i> Payment</a>
          </li>
          <li class="{{ $route == 'user.notification' ? 'active': ''}}"> <a href="{{ route('user.notification') }}"><i class="fal fa-bell"></i> Notifications</a>
          </li>
          <li class="{{ $route == 'user.security' ? 'active': ''}}"> <a href="{{ route('user.security') }}"><i class="fal fa-lock"></i> security</a>
          </li>
       </ul>
    </div>
 </div>
