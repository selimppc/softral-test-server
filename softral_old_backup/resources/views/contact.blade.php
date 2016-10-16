@extends('laravel-authentication-acl::client.layouts.base')
@section('title')
Softral - Contact Us
@stop
@section('content')
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
                    <div class="form-group">
                      <label for="InputEmail">Email address</label>
                      <input type="email" class="form-control" id="InputEmail" name ="InputEmail" placeholder="Enter your email" required>
                    </div>
                    <div class="form-group">
                      <label for="InputSubject">Subject</label>
                      <input type="text" class="form-control" id="InputSubject"  name ="InputSubject" placeholder="Enter your subject" required>
                    </div>
                    <div class="form-group">
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
              {!! $page['content'] !!}
			  @if(isset($page['children_hexa'][0]['content']))<p>{!! $page['children_hexa'][0]['content'] !!}</p>@endif
              </div> 
            </div>
          </div>
          <hr>
         
        </div>
      </div>
      
	  @stop