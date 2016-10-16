<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	 <title>@yield('title')</title>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="{{asset('cs/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="{{asset('cs/css/datepicker3.css')}}" rel="stylesheet">
<link href="{{asset('cs/css/bootstrap-table.css')}}" rel="stylesheet">
<link href="{{asset('cs/css/styles.css')}}" rel="stylesheet">
  <script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
  <script>tinymce.init({ selector:'textarea' });</script>
<!--Icons-->
<script src="{{asset('cs/js/lumino.glyphs.js')}}"></script>
	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			 <div class="logo">
        <span class="pull-right" style='padding: 6px 27px 3px 4px;'>Hello, {!! isset($logged_user) ? ($logged_user->user_profile[0]->first_name) : 'Guest' !!} |  	 <li class="dropdown" style='display:inline'>
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">My Softral
    <span class="caret"></span></a>
    <ul class="dropdown-menu header_menu_profile">
      <li>{!! link_to_route('users.selfprofile.edit','My Profile') !!}</li>
      @if(isset($logged_user)) <li><a href="{!! URL::to('/').'/user/profile/'.$logged_user->user_profile[0]->slug !!}">View Profile</a></li>@endif
	  @if(!isset($logged_user) || (isset($logged_user->user_profile[0]->profile_field_type->value) && ($logged_user->user_profile[0]->profile_field_type->value=='Seller' || $logged_user->user_profile[0]->profile_field_type->value=='Both')))
		<li>{!! link_to_route('job.myProposals','My Proposals') !!}</li>
	  @endif
	  
	  @if(!isset($logged_user) || (isset($logged_user->user_profile[0]->profile_field_type->value) && ($logged_user->user_profile[0]->profile_field_type->value=='Seller' || $logged_user->user_profile[0]->profile_field_type->value=='Both')))
		<li>{!! link_to_route('welcome.saveJobs','Save Jobs') !!}</li> 
		<li>{!! link_to_route('welcome.runningJobs','Working Jobs') !!}</li> 
	  @endif
	  
	  <li>{!! link_to_route('welcome.saveUsers','Save Users') !!}</li> 
	  
	 @if(!isset($logged_user) || (isset($logged_user->user_profile[0]->profile_field_type->value) && ($logged_user->user_profile[0]->profile_field_type->value=='Buyer' || $logged_user->user_profile[0]->profile_field_type->value=='Both')))
		<li>{!! link_to_route('welcome.myJobs','My Jobs') !!}</li> 
		<li>{!! link_to_route('welcome.myContracts','My Contracts') !!}</li> 
	  @endif
	  
	   <li>{!! link_to_route('financial','My Financial Accounts') !!}</li> 
	  
	  @if(!isset($logged_user) || (isset($logged_user->user_profile[0]->profile_field_type->value) && ($logged_user->user_profile[0]->profile_field_type->value=='Buyer' || $logged_user->user_profile[0]->profile_field_type->value=='Both')))
		<!--<li>{!! link_to_route('ad.myAds','My Classifieds') !!}</li> -->
	  @endif
	  <li>{!! link_to_route('job.myWorkboard','My Workboard') !!}</li>
	<li>{!! link_to_route('CustomerService','Customer Service') !!}</li>	  
    </ul>
  </li>
  
  	@if(!isset($logged_user))
									 | <li style='display:inline'>{!! link_to_route('user.signup','Sign Up',array(), array('class' => 'signup_click')) !!}</li>
									| <li style='display:inline'>{!! link_to_route('user.login','Log In',array(), array('class' => 'login_click')) !!}</li>
	@endif

	
  @if(isset($logged_user)) | <a href="{!! URL::route('user.logout') !!}"> Logout</a>
	@endif</span><br/>{!! $logo_info['content']!!}</br></br>
        </div>
		
	</div>

	</nav>
		
	  
<div class='container'>
<div class='gallary'>
            @yield('content')
</div>

<div class="footer">
    	<div class="footer_menu">
        	 @if(isset($pages))
                    @foreach($pages as $page)
                      <a href="{!! URL::to('/pages/').'/'.$page->slug !!}">{!!$page->title!!}</a>
                    @endforeach
                @endif
					<a href="{!! URL::to('/').'/pages/contact-us' !!}">Contact us</a>
        </div>
        <div class="copy">
        	Copyright &trade; {!! date('Y') !!} - Softral.com, Powered by Pronoor - All Rights Reserved.
        </div>
    </div>
</div>

        	<script src="{{asset('cs/js/jquery-1.11.1.min.js')}}"></script>
	<script src="{{asset('cs/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('cs/js/chart.min.js')}}"></script>
	<script src="{{asset('cs/js/chart-data.js')}}"></script>
	<script src="{{asset('cs/js/easypiechart.js')}}"></script>
	<script src="{{asset('cs/js/easypiechart-data.js')}}"></script>
	<script src="{{asset('cs/js/bootstrap-datepicker.js')}}"></script>
	<script src="{{asset('cs/js/bootstrap-table.js')}}"></script>
	<script>
		$('#calendar').datepicker({
		});

		!function ($) {
		    $(document).on("click","ul.nav li.parent > a > span.icon", function(){          
		        $(this).find('em:first').toggleClass("glyphicon-minus");      
		    }); 
		    $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	


</body>
</html>