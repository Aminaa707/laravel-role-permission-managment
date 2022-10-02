<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>404 Error - srtdash</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @include('backend.layouts.partials.styles')
</head>

<body>


    <!-- error area start -->
    <div class="error-area ptb--100 text-center">
        <div class="container">
            <div class="error-content">
                @yield('err-content')
            </div>
        </div>
    </div>
    <!-- error area end -->

    @include('backend.layouts.partials.script')
</body>

</html>