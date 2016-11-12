<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Selim Reza">
    <meta name="keyword" content="Edu Tech Solutions">
    <link rel="shortcut icon" href="assets/img/favicon.png">

    <title>{{ isset($pageTitle) ? $pageTitle : "Softral - Welcome to Softral" }} </title>


    <link href="{{ URL::asset('assets/font-awesome-4.6.3/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" >
    <!--=== Bootstrap CSS ===-->
    <link href="{{ URL::asset('assets/bootstrap/css/bootstrap.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/bootstrap/css/bootstrap-theme.css') }}" rel="stylesheet" type="text/css" >

    <!--=== Slider CSS ===-->
    <link href="{{ URL::asset('assets/slick/slick.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ URL::asset('assets/slick/slick-theme.css') }}" rel="stylesheet" type="text/css" >

    <!--=== Other CSS ===-->
    <link media="all" href="{{ URL::asset('assets/wow/animate.css') }}" rel="stylesheet" type="text/css" >
    <link media="all" href="{{ URL::asset('assets/css/haxagon.css') }}" rel="stylesheet" type="text/css" >
    <link media="all" href="{{ URL::asset('assets/css/homeycombs.css') }}" rel="stylesheet" type="text/css" >
    <link media="all" href="{{ URL::asset('assets/css/video-js.css') }}" rel="stylesheet" type="text/css" >
    <link media="all" href="{{ URL::asset('assets/css/styles_custom.css') }}" rel="stylesheet" type="text/css" >

    <!--=== Jquery Scripts ===-->
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>




</head>

<body>

@include('laravel-authentication-acl::client.layout.header')

         {{-- Yield Content Area--}}
         @yield('content')



</body>
</html>