<!doctype html>
<html lang="en" >

<head>

    <meta charset="utf-8" />
    <title>@yield('title','Home')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    @include('website.includes.style')



</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

       @include('website.includes.header')

   
            @yield('content')
            

   
      @include('website.includes.footer')

      @yield('customscript')
</body>



</html>