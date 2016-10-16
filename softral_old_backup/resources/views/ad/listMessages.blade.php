@extends('laravel-authentication-acl::client.layouts.base')
@section('title')
Softral - My Messages for {!!$ad_detail->title!!}
@stop
@section('content')
<div class="row content">
{{--@include('laravel-authentication-acl::client.layouts.sidebar')--}}
	  
      <div class="row1 col-xs-12 col-sm-12 col-md-12 col-lg-12">

	   @if(count($messages)!=0)
<div class="panel panel-default">
  <div class="panel-body">
   <h4 style="margin:0px;text-align:center"><strong>My Messages for {!!$ad_detail->title!!}</strong></h4>
  </div>
</div>
@endif
<div class="row">
     
	   <div class="pull-left col-xs-12 col-sm-12 col-md-12 col-lg-12">
	   <?php $message = Session::get('message'); ?>
        @if( isset($message) )
        <div class="alert alert-success">{!! $message !!}</div>
        @endif
       @if($errors->any())
			<div class="alert alert-danger">
				@foreach($errors->all() as $error)
					<p>{{ $error }}</p>
				@endforeach
			</div>
		@endif
                <div style="margin-top:15px;" class="panel panel-default">
                  <div class="panel-body text-center">
				  @if(count($ad_detail->messages)!=0)
<table border="1" class="table table-striped table-bordered table-hover dataTable no-footer">
	 <tbody><tr>
		<td><strong>Classified name</strong></td>
		<td><strong>Name</strong></td>
		<td><strong>Email</strong></td>
		<td><strong>Sent date</strong></td>
		<td><strong>View</strong></td>
		<td><strong>Delete</strong></td>
	</tr>	
		
		 @foreach($messages as $message)
         	<tr>
				<td><a href="{!! URL::to('/ad-detail/').'/'.$ad_detail->slug !!}">{{$ad_detail->title}}</a></td>
				<td>{{$message->name}}</td>
				<td>{{$message->email}}</td>
				<td>{{$message->created_at}}</td>
				<td><a href="{!! URL::route('myMessage.view',['id' => $message->id]) !!}" class="margin-left-5"><i class="fa fa-eye fa-2x"></i></a></td>
				<td><a href="{!! URL::route('myMessage.delete',['id' => $message->id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a></td>
			</tr>	
		@endforeach
              
           		   			</tbody></table>
			<div style="margin-left:2px" class="row pagging">
			{!! $messages->render() !!}
		  </div>
			@else
				<div style='text-align:center'><h3>No messages for {{$ad_detail->title}}</h3></div>
			@endif
			</div>
			</div></div></div>
  </div>
      </div>
	  {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
	      <script>
      
	$(function() {
         $(".delete").click(function(){
            return confirm("Are you sure to delete this item?");
        });
		
    });
	
    </script>
	  @stop