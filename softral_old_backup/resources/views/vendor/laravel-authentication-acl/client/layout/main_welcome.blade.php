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




</head>

<body>

@include('laravel-authentication-acl::client.layout.header')

 <article class="bg_gray_super_light">
 
	@include('laravel-authentication-acl::client.layout.slider')
	@include('laravel-authentication-acl::client.layout.newticker')

	
	<section class="wrap">
                <div class="container-fluid">
                    <!-- Left Content-->
                    <div class="col-md-7">
                        <!--<div class="text_content box-shadow-1">
                          <h1 class="size-25"> Content Heading<sup class="size-14"> (If Necessary)</sup></h1>
                          <div class="size-13">
                              <p> Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>

                          </div>
                        </div>

                        <div class="h_space_20"></div>-->

                        <div class="tree box-shadow-1">
                            <!--=== Hexagon Start ====================================================================-->
                            <!--<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">-->

                                <div class="hexa-section">

                                    <div class="honeycombs honeycombs-wrapper">
                                        <a href="http://www.softral.com/user/profile/eugene" title="Eugene">
                                            <div class="honeycombs-inner-wrapper" style="width: 655px; height: 561.266px;">
                                                <div class="comb" style="width: 250px; height: 216.506px; left: 0px; top: 113.253px;">
                                                    <img src="./Softral - Welcome to Softral_files/timthumb.php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;" style="display: none;">
                                                    <span style="display: none;">Eugene <br><br><p>DevOps engineer</p></span>
                                                    <div class="hex_l" style="width: 250px; height: 216.506px;"><div class="hex_r" style="width: 250px; height: 216.506px;"><div class="hex_inner" style="background-image: url(&quot;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/eugene.jpg&amp;w=114&amp;h=114&amp;q=100&quot;); width: 250px; height: 216.506px;"><div class="inner_span" style="display: none;"><div class="inner-text">Eugene <br><br><p>DevOps engineer</p></div></div></div></div></div></div><div class="comb" style="width: 250px; height: 216.506px; left: 197.5px; top: 0px;">
                                                    <img src="./Softral - Welcome to Softral_files/timthumb(1).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;" style="display: none;">
                                                    <span style="display: none;">Gayathri <br><br><p>Asp.Net MVC5 Web Developer</p></span>
                                                    <div class="hex_l" style="width: 250px; height: 216.506px;"><div class="hex_r" style="width: 250px; height: 216.506px;"><div class="hex_inner" style="background-image: url(&quot;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/gayathri.jpg&amp;w=114&amp;h=114&amp;q=100&quot;); width: 250px; height: 216.506px;"><div class="inner_span" style="display: none;"><div class="inner-text">Gayathri <br><br><p>Asp.Net MVC5 Web Developer</p></div></div></div></div></div></div><div class="comb" style="width: 250px; height: 216.506px; left: 395px; top: 113.253px;">
                                                    <img src="./Softral - Welcome to Softral_files/timthumb(2).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;" style="display: none;">
                                                    <span style="display: none;">Studio45 <br><br><p>Responsive website Design + open source Development with SEO solution.</p></span>
                                                    <div class="hex_l" style="width: 250px; height: 216.506px;"><div class="hex_r" style="width: 250px; height: 216.506px;"><div class="hex_inner" style="background-image: url(&quot;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/studio45.jpg&amp;w=114&amp;h=114&amp;q=100&quot;); width: 250px; height: 216.506px;"><div class="inner_span" style="display: none;"><div class="inner-text">Studio45 <br><br><p>Responsive website Design + open source Development with SEO solution.</p></div></div></div></div></div></div><div class="comb" style="width: 250px; height: 216.506px; left: 0px; top: 339.76px;">
                                                    <img src="./Softral - Welcome to Softral_files/timthumb(3).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;" style="display: none;">
                                                    <span style="display: none;">Akash <br><br><p>Senior PHP and ROR developer</p></span>
                                                    <div class="hex_l" style="width: 250px; height: 216.506px;"><div class="hex_r" style="width: 250px; height: 216.506px;"><div class="hex_inner" style="background-image: url(&quot;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/akash.jpg&amp;w=114&amp;h=114&amp;q=100&quot;); width: 250px; height: 216.506px;"><div class="inner_span" style="display: none;"><div class="inner-text">Akash <br><br><p>Senior PHP and ROR developer</p></div></div></div></div></div></div><div class="comb" style="width: 250px; height: 216.506px; left: 197.5px; top: 226.506px;">
                                                    <img src="./Softral - Welcome to Softral_files/timthumb(4).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;" style="display: none;">
                                                    <span style="display: none;">Morgan <br><br><p>Freelancer</p></span>
                                                    <div class="hex_l" style="width: 250px; height: 216.506px;"><div class="hex_r" style="width: 250px; height: 216.506px;"><div class="hex_inner" style="background-image: url(&quot;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/morgan.jpg&amp;w=114&amp;h=114&amp;q=100&quot;); width: 250px; height: 216.506px;"><div class="inner_span" style="display: none;"><div class="inner-text">Morgan <br><br><p>Freelancer</p></div></div></div></div></div></div></div></a>
                                        <a href="http://www.softral.com/user/profile/gayathri" title="Gayathri"></a>
                                        <a href="http://www.softral.com/user/profile/studio45" title="Studio45"></a>
                                        <a href="http://www.softral.com/user/profile/akash" title="Akash"></a>
                                        <a href="http://www.softral.com/user/profile/morgan" title="Morgan"></a>

                                    </div>


                                    <ul id="categories" class="clr">

                                        <div class="pusher2">
                                            <a href="http://www.softral.com/user/profile/eugene" title="Eugene">
                                                <li class="pusher1">
                                                    <div>
                                                        <img src="images/users/timthumb.php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>Eugene</h1>
                                                        <p>DevOps engineer </p>
                                                    </div>
                                                </li></a>
                                        </div>

                                        <div class="pusher2">
                                            <a href="http://www.softral.com/user/profile/ekshit" title="ekshit">
                                                <li>
                                                    <div>
                                                        <img src="images/users/timthumb(5).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>ekshit</h1>
                                                        <p> Freelancer </p>
                                                    </div>
                                                </li></a>

                                            <a href="http://www.softral.com/user/profile/gayathri" title="Gayathri">
                                                <li>
                                                    <div>
                                                        <img src="images/users/timthumb(1).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>Gayathri</h1>
                                                        <p>Asp.Net MVC5 Web Developer </p>
                                                    </div>
                                                </li></a>
                                        </div>

                                        <div class="pusher2">
                                            <a href="http://www.softral.com/user/profile/studio45" title="Studio45">
                                                <li class="pusher4">
                                                    <div>
                                                        <img src="images/users/timthumb(2).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>Studio45</h1>
                                                        <p>Responsive website Design + open source Development with SEO solution. </p>
                                                    </div>
                                                </li></a>

                                            <a href="http://www.softral.com/user/profile/jaymin" title="Jaymin">
                                                <li class="pusher5">
                                                    <div>
                                                        <img src="images/users/timthumb(6).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>Jaymin</h1>
                                                        <p> Freelancer </p>
                                                    </div>
                                                </li></a>

                                            <a href="http://www.softral.com/user/profile/vijay-1" title="vijay">
                                                <li class="pusher6">
                                                    <div>
                                                        <img src="images/users/timthumb(7).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>vijay</h1>
                                                        <p> Freelancer </p>
                                                    </div>
                                                </li></a>
                                        </div>

                                        <div class="pusher2">
                                            <a href="http://www.softral.com/user/profile/Pankaj-1" title="Pankaj">
                                                <li class="pusher7">
                                                    <div>
                                                        <img src="images/users/timthumb(8).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>Pankaj</h1>
                                                        <p> Freelancer </p>
                                                    </div>
                                                </li></a>

                                            <a href="http://www.softral.com/user/profile/niteshwar" title="Niteshwar">
                                                <li class="pusher8">
                                                    <div>
                                                        <img src="images/users/timthumb(9).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>Niteshwar</h1>
                                                        <p> Freelancer </p>
                                                    </div>
                                                </li></a>

                                            <a href="http://www.softral.com/user/profile/amine" title="amine">
                                                <li class="pusher9">
                                                    <div>
                                                        <img src="images/users/timthumb(10).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>amine</h1>
                                                        <p> Freelancer </p>
                                                    </div>
                                                </li></a>

                                            <a href="http://www.softral.com/user/profile/harry" title="Harry">
                                                <li class="pusher10">
                                                    <div>
                                                        <img src="images/users/timthumb(11).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>Harry</h1>
                                                        <p> Freelancer </p>
                                                    </div>
                                                </li></a>
                                        </div>

                                        <div class="pusher2">
                                            <a href="http://www.softral.com/user/profile/kimberly" title="Kimberly">
                                                <li class="pusher11">
                                                    <div>
                                                        <img src="images/users/timthumb(12).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>Kimberly</h1>
                                                        <p> Freelancer </p>
                                                    </div>
                                                </li></a>

                                            <a href="http://www.softral.com/user/profile/muthusathish" title="Muthusathish">
                                                <li class="pusher12">
                                                    <div>
                                                        <img src="images/users/timthumb(13).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>Muthusathish</h1>
                                                        <p> Freelancer </p>
                                                    </div>
                                                </li></a>

                                            <a href="http://www.softral.com/user/profile/hardeep" title="Hardeep">
                                                <li class="pusher13">
                                                    <div>
                                                        <img src="images/users/timthumb(13).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>Hardeep</h1>
                                                        <p> Freelancer </p>
                                                    </div>
                                                </li></a>

                                            <a href="http://www.softral.com/user/profile/alexey" title="Alexey">
                                                <li class="pusher14">

                                                    <div>

                                                        <img src="images/users/timthumb(14).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>Alexey</h1>
                                                        <p> Freelancer </p>
                                                    </div>
                                                </li></a>

                                            <a href="http://www.softral.com/user/profile/sawcen" title="Sawcen">
                                                <li class="pusher15">

                                                    <div>

                                                        <img src="images/users/timthumb(15).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>Sawcen</h1>
                                                        <p> Freelancer </p>
                                                    </div>
                                                </li></a>
                                        </div>

                                        <div class="pusher2">
                                            <a href="http://www.softral.com/user/profile/test-2" title="test">
                                                <li class="pusher16">

                                                    <div>

                                                        <img src="images/users/timthumb(16).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>test</h1>
                                                        <p> Freelancer </p>
                                                    </div>
                                                </li></a>

                                            <a href="http://www.softral.com/user/profile/ryan" title="Ryan">
                                                <li class="pusher17">

                                                    <div>

                                                        <img src="images/users/timthumb(17).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>Ryan</h1>
                                                        <p> Freelancer </p>
                                                    </div>
                                                </li></a>

                                            <a href="http://www.softral.com/user/profile/juha" title="Juha">
                                                <li class="pusher18">

                                                    <div>

                                                        <img src="images/users/timthumb(18).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>Juha</h1>
                                                        <p> Freelancer </p>
                                                    </div>
                                                </li></a>

                                            <a href="http://www.softral.com/user/profile/akash" title="Akash">
                                                <li class="pusher19">

                                                    <div>

                                                        <img src="images/users/timthumb(3).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>Akash</h1>
                                                        <p>Senior PHP and ROR developer </p>
                                                    </div>
                                                </li></a>

                                            <a href="http://www.softral.com/user/profile/masato" title="Masato">
                                                <li class="pusher20">

                                                    <div>

                                                        <img src="images/users/timthumb(19).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>Masato</h1>
                                                        <p> Freelancer </p>
                                                    </div>
                                                </li></a>

                                            <a href="http://www.softral.com/user/profile/dawes" title="G G">
                                                <li class="pusher21">

                                                    <div>

                                                        <img src="images/users/timthumb(20).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>G G</h1>
                                                        <p> Freelancer </p>
                                                    </div>
                                                </li></a>
                                        </div>

                                        <div class="pusher2">
                                            <a href="http://www.softral.com/user/profile/gazon" title="gazon">
                                                <li class="pusher22">

                                                    <div>

                                                        <img src="images/users/timthumb(21).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>gazon</h1>
                                                        <p> Freelancer </p>
                                                    </div>
                                                </li></a>

                                            <a href="http://www.softral.com/user/profile/manish" title="Manish">
                                                <li class="pusher23">

                                                    <div>

                                                        <img src="images/users/timthumb(22).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>Manish</h1>
                                                        <p> Freelancer </p>
                                                    </div>
                                                </li></a>

                                            <a href="http://www.softral.com/user/profile/nikhil" title="Nikhil">
                                                <li class="pusher24">

                                                    <div>

                                                        <img src="images/users/timthumb(23).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>Nikhil</h1>
                                                        <p> Freelancer </p>
                                                    </div>
                                                </li></a>

                                            <a href="http://www.softral.com/user/profile/morgan" title="Morgan">
                                                <li class="pusher25">

                                                    <div>

                                                        <img src="images/users/timthumb(4).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>Morgan</h1>
                                                        <p>Freelancer </p>
                                                    </div>
                                                </li></a>

                                            <a href="http://www.softral.com/user/profile/sandhya" title="Sandhya ">
                                                <li class="pusher26">

                                                    <div>

                                                        <img src="images/users/timthumb(13).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>Sandhya </h1>
                                                        <p> Freelancer </p>
                                                    </div>
                                                </li></a>

                                            <a href="http://www.softral.com/user/profile/sibbir" title="Sibbir">
                                                <li class="pusher27">

                                                    <div>

                                                        <img src="images/users/timthumb(24).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>Sibbir</h1>
                                                        <p> Freelancer </p>
                                                    </div>
                                                </li></a>

                                            <a href="http://www.softral.com/user/profile/Ram-1" title="Ram">
                                                <li class="pusher28">

                                                    <div>

                                                        <img src="images/users/timthumb(25).php" onerror="this.src = &#39;http://www.softral.com/timthumb.php?src=http://www.softral.com/images/admin.jpg&amp;w=114&amp;h=114&amp;q=100&#39;;">
                                                        <h1>Ram</h1>
                                                        <p> Freelancer </p>
                                                    </div>
                                                </li></a>
                                        </div>
                                    </ul>

                                </div>
                            <!--</div>-->
                            <div class="clearfix"></div>
                            <!--=== Hexagon End ======================================================================-->

                        </div>
                    </div>

                    <!-- For Videos-->
                    <div class="col-md-5 ">
                        <div class="col-md-12 relative">
                        <!--<div class="video borderimg bg_img">
                            <iframe width="100%" height="315" src="https://www.youtube.com/embed/4mJO4ec_fFI" frameborder="0" autoplay allowfullscreen ></iframe>
                        </div>
                        <div class="video borderimg">
                            <iframe width="100%" height="315" src="https://www.youtube.com/embed/P6IZMBMEfWU" frameborder="0" allowfullscreen></iframe>
                        </div>-->
                        <!--<div style="height: 15px;">&nbsp;</div>-->
                        <div class="vid vid-1">
                            <div class="videos_box">
                                <div class="videos">
                                    <video class="video stopvideo box-shadow-1 bg_white padding-5-5" style="max-height:270px;" controls width="100%" poster="http://www.softral.com/images/Screenshot_2.png">
                                        <source src="http://www.softral.com/uploads/video/sofware 2.mp4" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <div class="playpause" style="display: none;"></div>
                                </div>
                            </div>
                        </div>
                        <!--<div class="bg_white" style="height: 1px;">&nbsp;</div>-->
                        <div class="vid vid-2">
                            <div class="videos_box">
                                <div class="videos">
                                    <video class="video stopvideo box-shadow-1 bg_white padding-5-5" style="max-height:270px;" controls width="100%" poster="http://www.softral.com/images/Screenshot_3.png">
                                        <source src="http://www.softral.com/uploads/video/sofware 2.mp4" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
                                    <div class="playpause" style="display: none;"></div>
                                </div>
                            </div>
                        </div>
                        <!--<div class="bg_gray_light" style="padding:10px; height: 100px;">
                            <h2 class="black size-16 tahoma"><span class="red_site">&boxbox;</span> Mini box heading</h2>
                            <p class="size-12 padding-5-0-0-0">Some Text / links / icons / anything else according to this box size.</p>
                        </div>-->
                        </div>
                    </div>
                </div>
                <!-- <div class="h_space_20"></div> -->
            </section>

	
	
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

@include('laravel-authentication-acl::client.layout.home_bottom_box')
@include('laravel-authentication-acl::client.layout.footer')


<!--=== Other Scripts ===-->
<script type="text/javascript" src="{{ URL::asset('assets/js/video.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/jquery.homeycombs.js') }}"></script>

<!--=== Bootstrap Scripts ===-->
<script type="text/javascript" src="{{ URL::asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>

<!--=== Slider Js ===-->
<script type="text/javascript" src="{{ URL::asset('assets/slick/slick.js') }}" charset="utf-8"></script>
<script type="text/javascript" src="{{ URL::asset('assets/js/custom_slider.js') }}" charset="utf-8"></script>



<!-- JS -->
{!! HTML::script('js/lightslider.js') !!}
{!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/password_strength/strength.js') !!}
{!! HTML::script('http://morganthall.com/ujo/chosen-koenpunt/chosen.jquery.min.js') !!}

<script>
    $( document ).ready(function() {

        $('#image-gallery').lightSlider({
            gallery:true,
            item:1,
            thumbItem:9,
            slideMargin: 0,
            speed:500,
            auto:true,
            loop:true,
            onSliderLoad: function()
            {
                $('#image-gallery').removeClass('cS-hidden');
            }
        });

        // Drop down menu handler
        $('.dropdown-menu').find('form').click(function (e) {
            e.stopPropagation();
        });
        $(".chzn-select").chosen({
            create_option: true,
            persistent_create_option: true,
            create_option_text: 'add',
        });
        // Slider
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".alert.alert-danger:eq(1)").hide();

    });


</script>
<script>
    $('.notify').click(function()
    {
        $('.notif').hide();
        $.get("{!! URL::route('welcome.notification') !!}", {status: 1}, function(result) {
        });

        return true;
    });
</script>

</body>
</html>