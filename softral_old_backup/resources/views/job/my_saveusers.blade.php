@extends('laravel-authentication-acl::client.layouts.base')
@section('title')
Softral - My Save Users
@stop
@section('content')
<div class="row content">
{{--@include('laravel-authentication-acl::client.layouts.sidebar')--}}
	  
      <div class="row1 col-xs-12 col-sm-12 col-md-12 col-lg-12">

	   @if(count($save_users)!=0)
<div class="panel panel-default">
  <div class="panel-body">
   <h4 style="margin:0px;text-align:center"><strong>My Save Users</strong></h4>
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
				  @if(count($save_users)!=0)
<table border="1" class="table table-striped table-bordered table-hover dataTable no-footer">
	 <tbody><tr>
		<td><strong>User name</strong></td>
		<td><strong>View User profile</strong></td>
		<td><strong>Delete</strong></td>
	</tr>	
		
		 @foreach($save_users as $save_user)
			@if(isset($save_user->user->user_profile[0]->slug))
         	<tr>
				<td>{{$save_user->user->user_profile[0]->first_name}} {{$save_user->user->user_profile[0]->last_name}}</td>
				<td><a href="{!! URL::to('/user/profile').'/'.$save_user->user->user_profile[0]->slug !!}">View Profile</a></td>
				<td><a href="{!! URL::route('saveJob.delete',['user_id' => $save_user->user_id,'save_user_id' => $save_user->save_user_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a></td>
			</tr>	
			@endif
		@endforeach
              
           		   			</tbody></table>
			<div style="margin-left:2px" class="row pagging">
			{!! $save_users->render() !!}
		  </div>
			@else
				<div style='text-align:center'><h3>You haven't saved any user</h3></div>
			@endif
			</div>
			</div></div></div>
  </div>
      </div>
	  {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
	      <script>
        $(".delete").click(function(){
            return confirm("Are you sure to delete this item?");
        });
		
		 $(function() {
        $('#users-table').DataTable({
           
        });
    });
	
    </script>
	  @stop