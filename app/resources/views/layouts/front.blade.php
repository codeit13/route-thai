<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>@yield('title') {!! env("APP_NAME") !!}</title>
    @include('front._inc._styles')
    @yield('page_styles')
 </head>
 <body>
  <div class="loader">
      <div id="bars">
         <span></span>
         <span></span>
         <span></span>
         <span></span>
         <span></span>
      </div>
   </div>
        
    @include('front._inc._nav')

    @yield('content')

    @include('front._inc._success-modal')

    @include('front._inc._footer')
    @include('front._inc._copyright')
    @include('front._inc._scripts') 
    
    @yield('page_scripts')
    @stack('extra_scripts')
 </body>
</html>   