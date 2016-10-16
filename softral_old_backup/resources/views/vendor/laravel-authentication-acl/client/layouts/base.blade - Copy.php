<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">

	{!! HTML::style('http://morganthall.com/ujo/chosen-koenpunt/chosen.css') !!}
    {!! HTML::style('packages/jacopo/laravel-authentication-acl/css/bootstrap.min.css') !!}
    {!! HTML::style('css/front_style.css') !!}
	
    {!! HTML::style('packages/jacopo/laravel-authentication-acl/css/style.css') !!}
    <!--{!! HTML::style('packages/jacopo/laravel-authentication-acl/css/baselayout.css') !!}-->
    {!! HTML::style('packages/jacopo/laravel-authentication-acl/css/fonts.css') !!}
    {!! HTML::style('//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css') !!}
	   
		

    @yield('head_css')
    {{-- End head css --}}
	<meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
</head>

    <body>
       <div class="container wrapper">   
     
	  <!-- Login -->
	    <?php $condition_login_top = Session::get('condition_login_top'); ?>
	    <?php $condition_signup_top = Session::get('condition_signup_top'); ?>
	    <?php $condition_reminder_top = Session::get('condition_reminder_top'); ?>
	  @if(!isset($logged_user))
		  @if( isset($condition_login_top) )
	    <div class='login_top' >
			@include('laravel-authentication-acl::client.layouts.login')
		</div>
		  @endif
		  
		  @if( isset($condition_signup_top) )
		<div class='signup_top' >
		@section('head_css')
			{!! HTML::style('packages/jacopo/laravel-authentication-acl/css/strength.css') !!}
		@stop
			@include('laravel-authentication-acl::client.layouts.signup')
		</div>
		@endif  
		
		@if( isset($condition_reminder_top) )
		<div class='reminder_top' >
			@include('laravel-authentication-acl::client.layouts.reminder')
		</div>
		@endif
	  
	  @endif
	<!-- Login finished -->
	
	<!-- Logo -->
      <div class="logo">
        <span class="pull-right">Hello, {!! isset($logged_user) ? ($logged_user->user_profile[0]->first_name) : 'Guest' !!} |  	 <li class="dropdown" style='display:inline'>
    <a class="dropdown-toggle" data-toggle="dropdown" href="#">My Softral
    <span class="caret"></span></a>
    <ul class="dropdown-menu header_menu_profile">
      <li>{!! link_to_route('users.selfprofile.edit','My Profile') !!}</li>
	  @if(!isset($logged_user) || (isset($logged_user->user_profile[0]->profile_field_type->value) && ($logged_user->user_profile[0]->profile_field_type->value=='Seller' || $logged_user->user_profile[0]->profile_field_type->value=='Both')))
		<li>{!! link_to_route('job.myProposals','My Proposals') !!}</li>
	  @endif
	  
	  @if(!isset($logged_user) || (isset($logged_user->user_profile[0]->profile_field_type->value) && ($logged_user->user_profile[0]->profile_field_type->value=='Seller' || $logged_user->user_profile[0]->profile_field_type->value=='Both')))
		<li>{!! link_to_route('welcome.saveJobs','Save Jobs') !!}</li> 
	  @endif
	  
	 @if(!isset($logged_user) || (isset($logged_user->user_profile[0]->profile_field_type->value) && ($logged_user->user_profile[0]->profile_field_type->value=='Buyer' || $logged_user->user_profile[0]->profile_field_type->value=='Both')))
		<li>{!! link_to_route('welcome.myJobs','My Jobs') !!}</li> 
		<li>{!! link_to_route('welcome.myContracts','My Contracts') !!}</li> 
	  @endif
	  
	   <li>{!! link_to_route('financial','My Financial Accounts') !!}</li> 
	  
	  @if(!isset($logged_user) || (isset($logged_user->user_profile[0]->profile_field_type->value) && ($logged_user->user_profile[0]->profile_field_type->value=='Buyer' || $logged_user->user_profile[0]->profile_field_type->value=='Both')))
		<li>{!! link_to_route('ad.myAds','My Classifieds') !!}</li> 
	  @endif
	  <li>{!! link_to_route('job.myWorkboard','My Workboard') !!}</li>	  
    </ul>
  </li>

|  <li class="dropdown" style='display:inline'><a class="dropdown-toggle" data-toggle="dropdown" href="#">Pages
    <span class="caret"></span></a>
    <ul class="dropdown-menu header_menu_profile">
                @if(isset($pages))
                    @foreach($pages as $page)
                       <li> <a href="{!! URL::to('/pages/').'/'.$page->slug !!}">{!!$page->title!!}</a></li>
                    @endforeach
                @endif
				 <li> <a href="{!! URL::to('/').'/chat/index.php?page=8' !!}">Chat</a></li>
    </ul></li>
	
  @if(isset($logged_user)) | <a href="{!! URL::route('user.logout') !!}"> Logout</a>
	@endif</span><br/><a href="{!! URL::to('/') !!}"><h2>SOFTRAL</h2></a></br><span>Softral is Software Central where you can hire freelancers and trade software</span></br></br>
      </div>
      <!-- /Logo -->  
      <!-- Static navbar -->
	   
      <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#czsale-navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
        </div>
        <div class="collapse navbar-collapse" id="czsale-navbar">
		 <!--@if(!isset($logged_user) || (isset($logged_user->user_profile[0]->profile_field_type->value) && ($logged_user->user_profile[0]->profile_field_type->value=='Buyer' || $logged_user->user_profile[0]->profile_field_type->value=='Both')))
          {!! link_to_route('job.addAd','Add classified',array(), array('class' => 'btn btn-success navbar-btn add-classified-btn navbar-left')) !!}
	    @endif
          {!! link_to_route('job.listAd','Classified listing',array(), array('class' => 'btn btn-primary navbar-btn list-classified-btn navbar-left')) !!}-->
          <ul class="nav navbar-nav navbar-right">
            <li><a href="{!! URL::to('/') !!}">Home</a></li>
			@if(!isset($logged_user))
            <li>{!! link_to_route('user.signup','Sign Up',array(), array('class' => 'signup_click')) !!}</li>
             <li>{!! link_to_route('user.login','Log In',array(), array('class' => 'login_click')) !!}</li>
			 @endif
			 
			 @if(!isset($logged_user) || (isset($logged_user->user_profile[0]->profile_field_type->value) && ($logged_user->user_profile[0]->profile_field_type->value=='Buyer' || $logged_user->user_profile[0]->profile_field_type->value=='Both')))
             <li>{!! link_to_route('job.addJob','Post a Job') !!}</li>
			 @endif
			 
				<li>{!! link_to_route('user.members','Members') !!}</li>
			
             
              </ul>
            </li>
          </ul>
        </div>
      </nav>
            @yield('content')
       <div class="footer">
        <div class="well well-sm">
          <div class="pull-left">
            <ul class="nav nav-pills">
			 @if(!isset($logged_user) || (isset($logged_user->user_profile[0]->profile_field_type->value) && ($logged_user->user_profile[0]->profile_field_type->value=='Buyer' || $logged_user->user_profile[0]->profile_field_type->value=='Both')))
              <li>
			  <a href="{!! URL::route('job.addAd') !!}" ><span class="glyphicon glyphicon-plus"></span>Add classified</a>
			  </li>
			@endif
            </ul>
          </div>
          <div class="pull-right">
            <ul class="nav nav-pills">
                @if(isset($pages))
                    @foreach($pages as $page)
                       <li> <a href="{!! URL::to('/pages/').'/'.$page->slug !!}">{!!$page->title!!}</a></li>
                    @endforeach
                @endif
            </ul>
          </div>
          <div class="clearfix">&nbsp;</div>
        </div>
        <div class="pull-left">
          <p class="text-muted"><small>Copyright &copy; {!! date('Y') !!} - Softral.com, Powered by Pronoor - All Rights Reserved.</small></p>
        </div>
		<div class="pull-right footer_social">
		 <a href="#" class="btn btn-social btn-facebook">
                            <i class="fa fa-facebook"></i></a>
                        <a href="#" class="btn btn-social btn-google">
                            <i class="fa fa-google-plus"></i></a>
                        <a href="#" class="btn btn-social btn-twitter">
                            <i class="fa fa-twitter"></i></a>
                        <a href="#" class="btn btn-social btn-linkedin">
                            <i class="fa fa-linkedin"></i></a>
		</div>
      </div>
    </div>
    <!-- JS -->
    {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
	{!! HTML::script('packages/jacopo/laravel-authentication-acl/js/jquery-ui.js') !!}
    {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/bootstrap.min.js') !!}
	{!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/password_strength/strength.js') !!}
	{!! HTML::script('http://morganthall.com/ujo/chosen-koenpunt/chosen.jquery.min.js') !!}
    <script>
    $( document ).ready(function() {
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
	
    </body>
</html>