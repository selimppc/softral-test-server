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
   <h4 style="margin:0px;text-align:center"><strong>My Working Jobs</strong></h4>
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
<table id="users-table" border="1" class="table table-striped table-bordered table-hover dataTable no-footer">
	 <tbody><tr>
		<td><strong>Job name</strong></td>
		<td><strong>Price</strong></td>
		<td><strong>Contract</strong></td>
		<td><strong>View</strong></td>
		<td><strong>Workboard</strong></td>
	</tr>	
		
		 @foreach($save_jobs as $save_job)
         	<tr>
				<td><a href="{!! URL::to('/job/').'/'.$save_job->job->slug !!}">{{$save_job->job->project_name}}</a></td>
				<td>@if($save_job->job->budget!=0)${!! $save_job->job->budget !!}@else Not specified @endif</td>
				<td>@if(isset($save_job->approve_contract) && ($save_job->approve_contract==1)) Contract isn't Approved yet @elseif(isset($save_job->cancel_contract) && $save_job->cancel_contract==1)Contract cancelled @elseif(isset($save_job->ended_contract) && $save_job->ended_contract==1)<a href="{!! URL::to('/financial/terms_milestone/').'?p_id='. $save_job->proposal_id !!}" class="margin-left-5">Contract ended</a> @elseif(isset($save_job) && $save_job->ended_contract==0 && $save_job->cancel_contract==0)<a href="{!! URL::to('/financial/terms_milestone/').'?p_id='. $save_job->proposal_id !!}" class="margin-left-5">Contract is Active</a> @endif</td>
				<td><a href="{!! URL::to('/financial/terms_milestone/').'?p_id='. $save_job->proposal_id !!}" class="margin-left-5"><i class="fa fa-eye fa-2x"></i></a></td>
				<td><a href="{!! URL::to('view_workboard').'?id='.$save_job->proposal->id !!}" >Workboard</a></td>
			</tr>	
		@endforeach
              
           		   			</tbody></table>
			<div style="margin-left:2px" class="row pagging">
			{!! $save_jobs->render() !!}
		  </div>
			@else
				<div style='text-align:center'><h3>You are not working on any job.</h3></div>
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
		
    });
	
    </script>
	  @stop