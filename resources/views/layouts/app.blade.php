<!DOCTYPE html>
<html>
<head>
    <title>KKBOX Bookshelf</title>
    <!-- Fonts -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Lato:100">

    @if (Config::get('app.debug'))
        <!-- build:css(public) css/vendor.css -->
        <!-- bower:css -->
        <link rel="stylesheet" href="/bower_components/font-awesome/css/font-awesome.css" />
        <!-- endbower -->
        <!-- endbuild -->
        <link rel="stylesheet" href="{{ asset("css/app.css") }}">
    @else
        <link rel="stylesheet" href="{{ elixir("css/vendor.css") }}">
        <link rel="stylesheet" href="{{ elixir("css/app.css") }}">
    @endif
</head>
<body>
@yield('content')
<!-- Scripts -->
@if (Config::get('app.debug'))
    <!-- build:js(public) js/vendor.js -->
    <!-- bower:js -->
    <script src="/bower_components/jquery/dist/jquery.js"></script>
    <script src="/bower_components/bootstrap-sass/assets/javascripts/bootstrap.js"></script>
    <!-- endbower -->
    <!-- endbuild -->
    <script src="{{ asset("js/app.js") }}"></script>
@else
    <script src="{{ elixir("js/vendor.js") }}"></script>
    <script src="{{ elixir("js/app.js") }}"></script>
@endif
</body>
</html>
