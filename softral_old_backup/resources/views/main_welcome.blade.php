@extends('laravel-authentication-acl::client.layouts.base-fullscreen')
@section('title')
Softral - Welcome to Softral
@stop
@section('content')

	<div class="gallary">
    	<div class="row">
		 
        	<div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
				
                <div class="hexa-section" style='background: url("{!! URL::to('/') !!}/uploads/{!!$hexa_gonal_background->image!!}") no-repeat;background-size: 900px 1000px;'>
                	
				<div class="honeycombs">
					@foreach($freelancers as $freelancer)
						@if(isset($freelancer->user_profile[0]->profile_field_type_tagline->value) && $freelancer->user_profile[0]->avatar!='')
								<a href="{!! URL::to('/user/profile').'/'.$freelancer->user_profile[0]->slug !!}" title="{!! $freelancer->user_profile[0]->first_name !!}"><div class="comb"> 
								   <img src="{!! URL::to('/') !!}/timthumb.php?src={!! URL::to('/images').'/'.$freelancer->user_profile[0]->slug !!}.jpg&w=114&h=114&q=100" onerror="this.src = '{!! URL::to('/') !!}/timthumb.php?src={!! URL::to('/images').'/admin' !!}.jpg&w=114&h=114&q=100';"  />
								<span>{!!$freelancer->user_profile[0]->first_name!!} <br/><br/><p>{!! $freelancer->user_profile[0]->profile_field_type_tagline->value!!}</p></span>           
							</div></a>      
						@endif
					@endforeach             
                 </div>
				 
                	
					<ul id="categories" class="clr">
					<?php $j=0; ?>
					@foreach($freelancers as $key=>$value)
						@if(($value->user_profile[0]->avatar!=''))
							
						 @if($j==0 || $j==1 || $j==3 || $j==6 || $j==10 || $j==15 || $j==21)
							<div class="pusher2">
						 @endif
							<a href="{!! URL::to('/user/profile').'/'.$value->user_profile[0]->slug !!}" title="{!! $value->user_profile[0]->first_name !!}">
							@if($j!=2 && $j!=1)
								<li class='pusher{{$j+1}}'>
						    @else
								<li>
						    @endif
					
                                <div>
								
                                  <img src="{!! URL::to('/') !!}/timthumb.php?src={!! URL::to('/images').'/'.$value->user_profile[0]->slug !!}.jpg&w=114&h=114&q=100" onerror="this.src = '{!! URL::to('/') !!}/timthumb.php?src={!! URL::to('/images').'/admin' !!}.jpg&w=114&h=114&q=100';"  />
                                    <h1>{!!$value->user_profile[0]->first_name!!}</h1>
									<p>@if(isset($value->user_profile[0]->profile_field_type_tagline->value)){!!($value->user_profile[0]->profile_field_type_tagline->value) !!} @else Freelancer @endif</p>
                                </div>
                            </li></a>
						@if($j==0 || $j==2 || $j==5 || $j==9 || $j==14 || $j==20 || $j==27)
							</div>
						@endif
							<?php $j++; ?>
						@endif
					 @endforeach
					</ul>	
					
               	</div>
           	</div>
			
				 <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            
            
                    <div class="videos_box">
                        <div class="videos">
                            <video class='video' autoplay controls width="100%"  poster="{!! URL::to('/') !!}/images/Screenshot_2.png" >
                                 <source src="{!! URL::to('/') !!}/uploads/video/{!! $about->vedio1 !!}" type="video/mp4" >
								 Your browser does not support the video tag.
                            </video>
							  <div class="playpause"></div>
                        </div>
				
                 	</div>
              
                    <div class="videos_box">
                        <div class="videos">
                            <video class='video' autoplay controls width="100%"  poster="{!! URL::to('/') !!}/images/Screenshot_3.png" >
                                <source src="{!! URL::to('/') !!}/uploads/video/{!! $about->vedio2 !!}" type="video/mp4">
								Your browser does not support the video tag.
                            </video>
							 <div class="playpause"></div>
                        </div>
                 	
                </div>
				
				  <div class="videos_box">
                        <div class="videos">
                            <video class='video' autoplay controls width="100%"  poster="{!! URL::to('/') !!}/images/Screenshot_3.png" >
                                <source src="{!! URL::to('/') !!}/uploads/video/{!! $about->vedio3 !!}" type="video/mp4">
								Your browser does not support the video tag.
                            </video>
							 <div class="playpause"></div>
                        </div>
                 	
                </div>
				
				
            </div>
			
            <!--<div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            	<div class="news-section">
				
				@if(!empty($employeer_news->children_hexa))
                	<div class="news">
                	<h3>News</h3>
                    <marquee direction="up" onmouseover="this.stop();" onmouseout="this.start();" scrollamount="10" scrolldelay="500">
					 @foreach($employeer_news->children_hexa as $emp_news)
                    	<a href="{!! URL::to('/') !!}/pages/{!!$emp_news->slug!!}">{!!$emp_news->title!!}</a>
					 @endforeach
                    </marquee>                    
                </div>
				@endif
				
				@if(!empty($freelancer_news->children_hexa))
                	<div class="news">
                	<h3>IT News</h3>
                    <marquee direction="up" onmouseover="this.stop();" onmouseout="this.start();" scrollamount="10" scrolldelay="500">
                    	 @foreach($freelancer_news->children_hexa as $free_news)
                    	<a href="{!! URL::to('/') !!}/pages/{!!$free_news->slug!!}">{!!$free_news->title!!}</a>
					 @endforeach
                    </marquee>                    
                </div>
				@endif
                </div>
            </div>-->
        </div>

        <div class="click2edit click2edit{!! ($about['id']) !!}">{!! ($about['content']) !!}</div>
		@if(isset($logged_user) && $logged_user->id==1)
			<button id="edit" class="btn btn-primary" onclick="edit()" type="button">Edit</button>
			<button id="save" class="btn btn-primary save" onclick="save()" type="button" value="{!! ($about['id']) !!}" >Save</button>
			<input type='hidden' name='_token' value='{!! csrf_token() !!}' />
			<input type='hidden' id='ids' />
		@endif

    </div>
	<?php $image=@unserialize($about['image']); ?>
		@if(!empty($image))
		<div class="news-section">
    	<div class="sponser_logo_title">
        	<h4>More about us</h4>
            <h1>Our Partners</h1>
        </div>
        <div class="sponser_logo">
		@foreach($image as $input)
			<a href="#!" title=""><img src="{!! URL::to('/') !!}/uploads/{!! $input !!}" /></a>
		@endforeach
        </div>	
   	</div>
	@endif
	
	
	<script>
	var free_url = "{!! URL::to('/get_freelancers') !!}";
	var timer = null;
	function __refreshFreelancers()
	{
		jQuery.get(free_url, function(res)
		{
			if( res.status == 'ok' )
			{
				jQuery('#categories').html(res.cats);
				jQuery('.honeycombs').html(res.html);
				jQuery('.honeycombs').honeycombs({
						combWidth: 250,
						margin: 10
					});
			}
		});
	}
	$(function() 
	{
		timer = setInterval(__refreshFreelancers, 7000);
		

		$('video').parent().click(function () {
			if($(this).children("video").get(0).paused)
			{
				$(this).children("video").get(0).play();
				$(this).children(".playpause").fadeOut();
			}
			else
			{
				$(this).children(".video").get(0).pause();
				$(this).children(".playpause").fadeIn();
			}
		});
		$("video").each(function() {
			this.pauseOthers = function(event) 
			{
				$('video').addClass('stopvideo');
				$(this).removeClass('stopvideo');
				$('.stopvideo').each(function() 
				{
					
					this.pause();
					
				});
			};
			
			this.addEventListener("play", this.pauseOthers.bind(this), false);
		});
	});
	</script>

<script>
$(window).ready(function(){
	$(".playpause").hide();	
});
</script>
                
@stop
