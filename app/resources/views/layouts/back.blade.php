<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <title>@yield('title')</title>
    @include('back._inc._styles')
 </head>
 <body>
    
   
   @include('back._inc._nav')
   <div class="main-content" id="panel">
         @include('back._inc._header')
    @yield('content')

    @include('back._inc._footer')
    @include('back._inc._copyright')
    @include('back._inc._scripts') 
    
    @yield('page_scripts')
 </body>
</html>   