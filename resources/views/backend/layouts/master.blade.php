<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title> @yield('title', "Role Permission Managment") </title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('backend.layouts.partials.styles')
    @stack('css')
</head>

<body>

    <!-- page container area start -->
    <div class="page-container">
        <!-- sidebar menu area start -->
        @include('backend.layouts.partials.sidebar')
        <!-- sidebar menu area end -->
        <!-- main content area start -->
        @yield('admin-content')
        <!-- main content area end -->
        <!-- footer area start-->
        @include('backend.layouts.partials.footer')
        <!-- footer area end-->
    </div>
    <!-- page container area end -->
    <!-- offset area start -->
    @include('backend.layouts.partials.offset')
    <!-- offset area end -->

    <!-- Scripts -->
    @include('backend.layouts.partials.script')
    @stack('script')
</body>

</html>