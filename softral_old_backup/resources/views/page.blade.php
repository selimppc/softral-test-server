@extends('laravel-authentication-acl::client.layouts.base')
@section('title')
@if(isset($page))
Softral - {!!$page->title!!}
@endif
@stop
@section('content')



@if($slug!='contact-us')
	
<style type="text/css">
.main-gallery{width:100%;float:left;margin-top:3%;}
.videos {width:100%;}
.paregraph {width: 100%;float: left;margin: 0 0;}
.gallery_slider {width: 100%; float: left;}
.gallery_slider img {width:100%;height: 400px;}
.gallery{height:100% !important;}
.content-right{padding:0 15px;}
.main-gallery .news-section {margin-bottom: 30px;padding: 20px;}

</style>
<div class="row content">
    
        <div class="col-lg-12 content-right">
         
          <div class="row selected-classifieds">
		
			<div class="page-header"><h1>@if(isset($page)){!!$page->title!!}@endif</h1></div>
			
			
			<div class="main-gallery">
			
        	<div class="news-section">
			
			@if(!empty($page->vedio1) || !empty($page->vedio2))
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			@if(!empty($page->vedio2))
            	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			@else
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			@endif
				
                	<div class="videos">
                    <video width="100%" controls >
                        <source src="{!! URL::to('/') !!}/uploads/video/{!! $page->vedio1 !!}">
  						<source src="movie.ogg" type="video/ogg">
                    </video>
					
                </div>
				
                </div>
				
			@if(!empty($page->vedio2))
                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                	<div class="videos">
                    <video width="100%" controls autoplay >
                        <source src="{!! URL::to('/') !!}/uploads/video/{!! $page->vedio2 !!}">
  						<source src="movie.ogg" type="video/ogg">
                    </video>
                </div>
                </div>
				
				@endif
            </div>
            </div>
			@endif
			
            <div class="news-section">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="paregraph">
                        <p>
                            {!!$page->content!!}
                        </p>
                    </div>
                </div>
            </div>
			
			<?php $image=@unserialize($page['image']); ?>
					
					@if($page['image']!='' && $image!==false)
            <div class="news-section">
        		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        		<div class="gallery_slider">
                	<ul id="image-gallery" class="gallery list-unstyled cS-hidden">
				
					@foreach($image as $input)
				 
					<li data-thumb="{!! URL::to('/') !!}/uploads/{!! $input !!}"><img src="{!! URL::to('/') !!}/uploads/{!! $input !!}" /></li>
					
					@endforeach
				
                    </ul>
                </div>
        	</div>
            </div>
			@endif
					
            </div>
           
       
		 
		<!--<p>@if(isset($page)){!!$page->content!!}@endif</p>-->
		<!--<h1>Photo Gallary</h1>
		<p><img src="{!! URL::to('/') !!}/uploads/{!! $page['image'] !!}" width='100px' /></p>-->
		@if(isset($page))
		@if(count($page->children)!=0)
			
			@foreach($page->children as $child)
		<div class="panel panel-default">
            <div class="panel-heading">
                <h4 class="panel-title">
                    <a class="" data-toggle="" data-parent="" href="{!! URL::to('/pages/').'/'.$child->slug !!}">{!!$child->title!!}</a>
                </h4>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in">
                <div class="panel-body">
                   {!!$child->cut_content!!} 
                </div>
            </div>
			@endforeach
			
        </div>
		@endif
		@endif
			
          </div>
        </div>
      </div>
@else
	<div class="row content">
        <div class="col-lg-12">
		 {{-- successful message --}}
        <?php $message = Session::get('message'); ?>
        @if( isset($message) )
        <div class="alert alert-success">{!! $message !!}</div>
        @endif
          <ol class="breadcrumb">
            <li><a href="{!! URL::to('/') !!}">Home</a></li>
            <li>Contact</li>
          </ol>
          <h2>Contact Us</h2>
          <div class="row">
            <div class="col-md-8">
               <div class="panel panel-default">
                <div class="panel-body">                
				  {!! Form::open(array('route' => 'contact.sendEmail', 'class' => 'form')) !!}
				  
				 
				  
				  <div class="form-group col-md-6">
                      <label for="InputName">First Name</label>
                      <input type="text" class="form-control" id="InputName"  name ="InputName" placeholder="Enter your Name" required>
                    </div>
					
					 <div class="form-group col-md-6">
                      <label for="InputName">Last Name</label>
                      <input type="text" class="form-control" id="InputLastname"  name ="InputLastname" placeholder="Enter your Lastname" required>
                    </div>
					
					<div class="form-group col-md-12">
                      <label for="InputEmail">Email address</label>
                      <input type="email" class="form-control" id="InputEmail" name ="InputEmail" placeholder="Enter your email" required>
                    </div>
					
					<div class="form-group col-md-4">
                      <label for="InputName">City</label>
                      <input type="text" class="form-control" id="InputCity"  name ="InputCity" placeholder="Enter your City" required>
                    </div>
					
					<div class="form-group col-md-4">
                      <label for="InputName">State</label>
                      <input type="text" class="form-control" id="InputState"  name ="InputState" placeholder="Enter your State" required>
                    </div>
					
					<div class="form-group col-md-4">
                      <label for="InputName">Country</label>
                      <input type="text" class="form-control" id="InputCountry"  name ="InputCountry" placeholder="Enter your Country" required>
                    </div>
					
					<div class="form-group col-md-12">
                      <label for="InputName">Contact Number</label>
                      <input type="number_format" class="form-control" id="InputContactnumber"  name ="InputContactnumber" placeholder="Enter your ContactNumber" required>
                    </div>
					
                    
                    <div class="form-group col-md-12">
                      <label for="InputSubject">Subject</label>
                      <input type="text" class="form-control" id="InputSubject"  name ="InputSubject" placeholder="Enter your subject" required>
                    </div>
                    <div class="form-group col-md-12">
                      <label for="InputText">Your message</label>
                      <textarea class="form-control" id="InputText" name="message" placeholder="Type in your message" rows="5" style="margin-bottom:10px;" required></textarea>
                    </div>
                    <button class="btn btn-primary" type="submit">Send</button>
                 {!! Form::close() !!}
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="well well-sm">
             {!!$page->content!!}
              </div> 
            </div>
          </div>
          <hr>
         
        </div>
      </div>
@endif

	{!! HTML::style('css/lightslider.css') !!}
	
   
	  @stop