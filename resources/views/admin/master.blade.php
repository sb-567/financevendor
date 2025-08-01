
<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>

    <meta charset="utf-8" />
    <title>@yield('title','SUPER ADMIN')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    @include('includes.style')

</head>

<body>

    <!-- Begin page -->
    <div id="layout-wrapper">

       @include('includes.header')

   
            @yield('content')
            

   
      @include('includes.script')

      @yield('customscript')
</body>



</html>