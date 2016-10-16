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
    <link media="all" href="{{ URL::asset('assets/css/haxagon.css') }}" rel="stylesheet" type="text/css" >
    <link media="all" href="{{ URL::asset('assets/css/homeycombs.css') }}" rel="stylesheet" type="text/css" >
    <link media="all" href="{{ URL::asset('assets/css/video-js.css') }}" rel="stylesheet" type="text/css" >
    <link media="all" href="{{ URL::asset('assets/css/styles_custom.css') }}" rel="stylesheet" type="text/css" >

    <!--=== Jquery Scripts ===-->
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>
    <!--=== Other Scripts ===-->
    <script type="text/javascript" src="{{ URL::asset('assets/js/video.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/jquery.homeycombs.js') }}"></script>

    <!--=== Bootstrap Scripts ===-->
    <script type="text/javascript" src="{{ URL::asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>

    <!--=== Slider Js ===-->
    <script type="text/javascript" src="{{ URL::asset('assets/slick/slick.js') }}" charset="utf-8"></script>
    <script type="text/javascript" src="{{ URL::asset('assets/js/custom_slider.js') }}" charset="utf-8"></script>

</head>

<body>

@include('layouts.header')

<article class="bg_gray_super_light">

    @if(\App\Http\Requests\Request::is('/'))
    {
        <!-- Slider -->
        @include('layouts._slider')
        <!-- News Ticker -->
        @include('layouts._newsticker')
    }


    <!-- Content -->
    <section class="wrap">
        @if($errors->any())
            <ul class="alert alert-danger">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif

        {{--set some message after action--}}
        @if (Session::has('message'))
            <div class="alert alert-success">{{Session::get("message")}}</div>

        @elseif(Session::has('error'))
            <div class="alert alert-warning">{{Session::get("error")}}</div>

        @elseif(Session::has('info'))
            <div class="alert alert-info">{{Session::get("info")}}</div>

        @elseif(Session::has('danger'))
            <div class="alert alert-danger">{{Session::get("danger")}}</div>
        @endif




         {{-- Yeild Content Area--}}
         @yield('content')




        <div class="h_space_20"></div>
    </section>

    <!-- Bottom Creeping Text -->
    <section class="wrap">
        <div class="container-fluid">
            <div class="col-md-12">
                <div class="no-padding bg_white box-shadow-4">
                    <section class="bottom_slider slider red_site tahoma text-left" style="padding: 20px !important;">
                        <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,</div>
                        <div>when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, remaining essentially unchanged.</div>
                        <div>It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently</div>
                        <div>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour</div>
                    </section>
                </div>
            </div>
        </div>
        <div class="h_space_20">&nbsp;</div>
    </section>
</article>

@if(\App\Http\Requests\Request::is('/'))
{
    @include('layouts.bottom_box')
}

@include('admin::layouts.footer')

</body>
</html>