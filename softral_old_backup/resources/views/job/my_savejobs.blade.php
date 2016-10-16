@extends('laravel-authentication-acl::client.layouts.base')
@section('title')
Softral - My Save Jobs
@stop
@section('content')
<div class="row content">
{{--@include('laravel-authentication-acl::client.layouts.sidebar')--}}
	  
      <div class="row1 col-xs-12 col-sm-12 col-md-12 col-lg-12">

	   @if(count($save_jobs)!=0)
<div class="panel panel-default">
  <div class="panel-body">
   <h4 style="margin:0px;text-align:center"><strong>My Save Jobs</strong></h4>
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
				  @if(count($save_jobs)!=0)
<table border="1" class="table table-striped table-bordered table-hover dataTable no-footer">
	 <tbody><tr>
		<td><strong>Job name</strong></td>
		<td><strong>Price</strong></td>
		<td><strong>Posted date</strong></td>
		<td><strong>View</strong></td>
		<td><strong>Delete</strong></td>
	</tr>	
		
		 @foreach($save_jobs as $save_job)
         	<tr>
				<td><a href="{!! URL::to('/job/').'/'.$save_job->job->slug !!}">{{$save_job->job->project_name}}</a></td>
				<td>@if($save_job->job->budget!=0)${!! $save_job->job->budget !!}@else Not specified @endif</td>
				<td>{{$save_job->job->created_at}}</td>
				<td><a href="{!! URL::to('/job/').'/'.$save_job->job->slug !!}" class="margin-left-5"><i class="fa fa-eye fa-2x"></i></a></td>
				<td><a href="{!! URL::route('saveJob.delete',['user_id' => $save_job->user_id,'job_id' => $save_job->job_id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a></td>
			</tr>	
		@endforeach
              
           		   			</tbody></table>
			<div style="margin-left:2px" class="row pagging">
			{!! $save_jobs->render() !!}
		  </div>
			@else
				<div style='text-align:center'><h3>You haven't saved any job</h3></div>
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