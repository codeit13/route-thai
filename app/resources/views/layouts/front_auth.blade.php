<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>@yield('title') {!! env("APP_NAME") !!}</title>
    @include('front._inc._styles')
 </head>
 <body class="dark-mode">
   <div class="loader">
      <div id="bars">
         <span></span>
         <span></span>
         <span></span>
         <span></span>
         <span></span>
      </div>
   </div>
    @yield('content')
    @include('front._inc._copyright')
    @include('front._inc._scripts') 
    @yield('page_scripts')
 </body>
</html>