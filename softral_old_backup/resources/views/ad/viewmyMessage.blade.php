@extends('laravel-authentication-acl::client.layouts.base')
@section('title')
Softral - View message
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
            <div class="col-md-12">
             
				<div class="panel panel-info">
			<div class="panel-heading">
			<h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> {!! 'View Message for : '.$mymessage->ad->title !!}</h3>
			</div>
    <div class="panel-body viewmessage">
                <div class="col-md-12">
             <div id="section1">
                <h5><strong>Classified name</strong> : {!! $mymessage->ad->title !!}</h5>
            </div>
            <hr> 
			<div id="section1">
                <h5><strong>Sender name</strong> :  {!!  $mymessage->name !!}</h5>
            </div>
            <hr>
            <div id="section2">
                <h5><strong>Email</strong> :{!!  $mymessage->email !!}</h5>
            </div>
            <hr>
           <div id="section2">
                <h5><strong>Message</strong> :{!!  $mymessage->message !!}</h5>
            </div>
            <hr>
			<div id="section2">
                <h5><strong>Sent date:</strong> : {!! $mymessage->created_at !!}</h5>
            </div>
            <hr>
			
          </div>
          </div>
            </div>
         
        </div>
</div>
</div>
@stop
