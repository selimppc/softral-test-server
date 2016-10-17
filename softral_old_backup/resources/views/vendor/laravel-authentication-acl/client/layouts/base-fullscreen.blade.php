<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="author" content="">


    {!! HTML::style('packages/jacopo/laravel-authentication-acl/css/bootstrap.min.css') !!}
	{!! HTML::style('//vjs.zencdn.net/4.1/video-js.css') !!}  
    {!! HTML::style('//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css') !!}
    {!! HTML::style('css/style.css') !!}
    {!! HTML::style('css/haxagon.css') !!}
	{!! HTML::style('css/homeycombs.css') !!}
    {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
	 {!! HTML::script('//vjs.zencdn.net/4.1/video.js') !!} 
    {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/bootstrap.min.js') !!}
	
    {!! HTML::script('js/jquery.homeycombs.js') !!}
	
    @yield('head_css')
    {{-- End head css --}}

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
<script type="text/javascript">
$(document).ready(function() {
	$('.honeycombs').honeycombs({
		combWidth: 250,
		margin: 10
	});
});
</script>
</head>

     <body style="background:#023e73;">
        <div class="">
		
		<div class="main">
	<div class="container">
	
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
	  
        <div class="logo">

        <span class="pull-right" style='padding: 14px 27px 3px 4px;'>
		<div class="dropdown parent">
		@if(!empty($logged_user))
  <a id="dLabel" class="notify" role="button" data-toggle="dropdown" data-target="#" href="#">
 
    <i class="glyphicon glyphicon-bell" id="notification"><span class=" notif badge badge-notify" id="noti">@if(isset($notif) && $notif!=0){{$notif}} @endif</span></i>
  </a>

  <ul class="dropdown-menu notifications"  role="menu" aria-labelledby="dLabel">
    
     <div class="notification-heading"><h4 class="menu-title">@if(isset($notif) && $notif!=0) {{$notif}} new notifications @else No new notification @endif</h4>
    </div>
 
   <div class="notifications-wrapper">

	@if(!empty($logged_user))
	  @if(isset($notifications) && count($notifications)!=0)
	    @foreach($notifications as $notification)
		  @if(isset($notification->job->project_name))	
			@if($notification->label=='got proposal')
				<a class="" href="{!!URL::to('/job/proposal_view?id='.$notification->proposal_id ) !!}">
				@elseif($notification->label=='select proposal' || $notification->label=='Escrow money' || $notification->label=='Ended the Contract' || $notification->label=='Sent Bonus' || $notification->label=='Released Money' || $notification->label=='FEnded the Contract')<a class="content" href="{!! URL::to ('financial/terms_milestone?p_id='.$notification->proposal_id) !!}">
			@endif
	
	<div class="notification-item">
       <p class="item-info">
	   @if($notification->label=='got proposal') You have got proposal
	   @elseif($notification->label=='select proposal') Your proposal has been selected 
	   @elseif($notification->label=='Escrow money')  {{ $notification->job->user->user_profile[0]->first_name}} has Escowed ${{ $notification->amount }} 
	   @elseif($notification->label=='Ended the Contract') {{ $notification->proposal->user->user_profile[0]->first_name}} has Ended the Contract 
	   @elseif($notification->label=='FEnded the Contract') {{ $notification->job->user->user_profile[0]->first_name}} has Ended the Contract 
	   @elseif($notification->label=='Sent Bonus') {{ $notification->job->user->user_profile[0]->first_name}} has sent bonus ${{ $notification->amount }}
	   @elseif($notification->label=='Released Money') {{ $notification->job->user->user_profile[0]->first_name}} has released money @endif
	   for job {{ $notification->job->project_name}}</p>
		</div>
    </a>
		   @endif	
	@endforeach
	@else
		<div class="notification-item"><center> No notification found <center></div>
  @endif
@endif
   </div>
  
    <li class="divider"></li>
    <div class="notification-footer"><h4 class="menu-title"> <a href="{!! URL::to('job/notification') !!}">See all<i class="glyphicon glyphicon-circle-arrow-right"></i></a></h4></div>
  </ul>
 @endif
</div>
		Hello, {!! isset($logged_user) ? ($logged_user->user_profile[0]->first_name) : 'Guest' !!} |  	 <li class="dropdown" style='display:inline'>
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
		<li>{!! link_to_route('welcome.myContracts','Escrow Contracts') !!}</li> 
		<li>{!! link_to_route('welcome.user_Agreement','User Agreements') !!}</li> 
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
	@endif</span><br/>
	
	 <div class="click2edit1 click2edit{!! isset($logo_info['id'])?$logo_info['id']:null !!}">{!! isset($logo_info['content'])?$logo_info['content']:null !!}</div>
		@if(isset($logged_user) && $logged_user->id==1)
			<button id="edit1" class="btn btn-primary" onclick="edit1()" type="button">Edit</button>
			<button id="save1" class="btn btn-primary save" onclick="save1()" type="button" value="{!! isset($logo_info['id'])?$logo_info['id']:null !!}">Save</button>
		@endif
	</br></br>
        </div>
		<div class="content">
    		<nav class="navbar navbar-default">
  				<div class="container-fluid">
    			<!-- Brand and toggle get grouped for better mobile display -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" 	 					 						aria-expanded="false">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                      </button>
                    </div>
		    		<!-- Collect the nav links, forms, and other content for toggling -->
    				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    	<ul class="nav navbar-nav">
                       		<li @if('http://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']==url('/').'/') class="active" @endif><a href="{!! URL::to('/') !!}">Home<span class="sr-only">(current)</span></a></li>
                            <li @if('http://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']==url('pages/about-us')) class="active" @endif><a style='margin:0px 5px 0px 0px' href="{!! URL::to('/').'/pages/about-us' !!}">About Us</a></li>
                             <!--<li><a style='margin:0px 0px 0px -20px' href="{!! URL::to('/').'/shome' !!}">Freelancer Area</a></li>-->
                            <li class="dropdown @if('http://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']==url('add-job') || ('http://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']==url('shome'))) active @endif ">
                              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">				 								Jobs<span class="caret"></span>
                              </a>
                              <ul class="dropdown-menu">
							   @if(!isset($logged_user) || (isset($logged_user->user_profile[0]->profile_field_type->value) && ($logged_user->user_profile[0]->profile_field_type->value=='Buyer' || $logged_user->user_profile[0]->profile_field_type->value=='Both')))											
									<li>{!! link_to_route('job.addJob','Post a Job') !!}</li>
								@endif
                               <li><a href="{!! URL::to('/').'/shome' !!}">Search for Job</a></li>
                              </ul>
                        	</li>
                             <li><a href="{!! URL::to('/').'/chat/index.php' !!}">Chat</a></li>
								<li @if('http://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']==url('all-members')) class="active" @endif>{!! link_to_route('user.members','Members') !!}</li>
							
							
								<li @if('http://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']==url('pages/rules-conditions')) class="active" @endif><a href="{!! URL::to('/').'/pages/rules-conditions' !!}">Terms & Conditions</a></li>
							
							<li @if('http://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']==url('pages/privacy-policy')) class="active" @endif><a href="{!! URL::to('/').'/pages/privacy-policy' !!}">Privacy Policy</a></li>
							<li @if('http://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']==url('pages/contact-us')) class="active" @endif><a href="{!! URL::to('/').'/pages/contact-us' !!}">Contact us</a></li>			
                      	</ul>
    				</div><!-- /.navbar-collapse -->
                </div><!-- /.container-fluid -->
            </nav>
		</div>
	</div>
</div>
<div class="container">
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
					<a href="{!! URL::to('/').'/contact' !!}">Contact us</a>
        </div>
        <div class="copy">
        	All Rights Reserved. Copyright {!! date('Y') !!} � Softral TM
        </div>
    </div>
</div>
        </div>
		
	@if(isset($logged_user) && $logged_user->id==1)
	{!! HTML::style('http://summernote.org/bower_components/summernote/dist/summernote.css') !!}
	   {!! HTML::style('//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css') !!}
	   	
	 {!! HTML::script('//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js') !!}
	 
	  {!! HTML::script('http://summernote.org/bower_components/summernote/dist/summernote.js') !!}
	  <script>
    	var edit = function() 
		{
		  	$('.click2edit').summernote({focus: true});
		};
		var save = function() 
		{
		  	var makrup = $('.click2edit').summernote('code');
		  	$('.click2edit').summernote('destroy');
		};
		
		var edit1 = function() 
		{
		  	$('.click2edit1').summernote({focus: true});
		};
		var save1 = function() 
		{
		  	var makrup = $('.click2edit1').summernote('code');
		  	$('.click2edit1').summernote('destroy');
		};
    </script>
	<script>
	$(document).ready(function(){
    $('.save').click(function(){
		
	var id=$(this).val();
	var data=$('.click2edit'+id).html();

    $.ajax({
      url: "{!! URL::to('/editable/') !!}",
      data: {'content':data, 'id':id, '_token': $('input[name=_token]').val()},
	  type:'POST',
      success: function(data){
		
      }
    });      
  }); 
  
});
	</script>
  
	 @endif
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