@extends('laravel-authentication-acl::client.layouts.base')
@section('title')
Softral - {!!$page->title!!}
@stop
@section('content')

@if($slug!='contact-us')
<div class="row content">
    
        <div class="col-lg-12 content-right">
         
          <div class="row selected-classifieds">
		
			<div class="page-header"><h1>{!!$page->title!!}</h1></div>
		<p>{!!$page->content!!}</p>
		
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
     
	  @stop