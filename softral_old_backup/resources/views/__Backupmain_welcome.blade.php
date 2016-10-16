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
					@foreach($hexa_gonal_background->children_hexa as $hexa_gonal)
                        <div class="comb"> 
                            <img src="{!! URL::to('/') !!}/uploads/{!!$hexa_gonal->image!!}" />
                            <span>{!!$hexa_gonal->title!!} <br/><br/><p>{!! strip_tags($hexa_gonal->content)!!}</p></span>                   
                        </div>
					@endforeach             
                 </div>
				 
                	
					<ul id="categories" class="clr">
					@foreach($hexa_gonal_background->children_hexa as $key=>$value)
						 @if($key==0 || $key==1 || $key==3 || $key==6 || $key==10 || $key==15 || $key==21)
							<div class="pusher2">
						 @endif
							
							@if($key!=2 && $key!=1)
								<li class='pusher{{$key+1}}'>
						    @else
								<li>
						    @endif
						   
                                <div>
                                    <img src="{!! URL::to('/') !!}/uploads/{!!$value->image!!}" alt=""/>
                                    <h1>{!!$value->title!!}</h1>
									<p>{!! strip_tags($value->content) !!}</p>
                                </div>
                            </li>
						@if($key==0 || $key==2 || $key==5 || $key==9 || $key==14 || $key==20 || $key==27)
							</div>
						@endif
					 @endforeach
					</ul>	
					
               	</div>
           	</div>
            <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
            	<div class="news-section">
                	<div class="news">
                	<h3>Employer News</h3>
                    <marquee direction="up" onmouseover="this.stop();" onmouseout="this.start();" scrollamount="2">
					 @foreach($employeer_news->children_hexa as $emp_news)
                    	<a href="{!! URL::to('/') !!}/pages/{!!$emp_news->slug!!}">{!!$emp_news->title!!}</a>
					 @endforeach
                    </marquee>                    
                </div>
                	<div class="news">
                	<h3>Freelancer News</h3>
                    <marquee direction="up" onmouseover="this.stop();" onmouseout="this.start();" scrollamount="2">
                    	 @foreach($freelancer_news->children_hexa as $free_news)
                    	<a href="{!! URL::to('/') !!}/pages/{!!$free_news->slug!!}">{!!$free_news->title!!}</a>
					 @endforeach
                    </marquee>                    
                </div>
                </div>
            </div>
        </div>
   
  	  <div class="dummy_text">
    	<h1>About Us</h1>
    	
        	{!!$about['content'] !!}
        
    </div>


@stop