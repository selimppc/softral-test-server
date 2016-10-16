@extends('laravel-authentication-acl::client.layouts.base')
@section('title')
Softral - My Contracts
@stop
@section('content')
<div class="row content">
{{--@include('laravel-authentication-acl::client.layouts.sidebar')--}}
	  
      <div class="row1 col-xs-12 col-sm-12 col-md-12 col-lg-12">

	   @if(count($my_jobs)!=0)
<div class="panel panel-default">
  <div class="panel-body">
   <h4 style="margin:0px;text-align:center"><strong>My Contracts</strong></h4>
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
				  @if(count($my_jobs)!=0)
<table border="1" class="table table-striped table-bordered table-hover dataTable no-footer">
	 <tbody><tr>
		<td><strong>Job name</strong></td>
		<td><strong>Price</strong></td>
		<td><strong>Total Propsals</strong></td>
		<td><strong>Posted date</strong></td>
		<td><strong>Contract</strong></td>
		<td><strong>Close Job</strong></td>
		<td><strong>Edit</strong></td>
		<td><strong>View</strong></td>
		<td><strong>Delete</strong></td>
	</tr>	
		
		 @foreach($my_jobs as $my_job)
         	<tr>
				<td><a href="{!! URL::to('/job/').'/'.$my_job->job->slug !!}">{{$my_job->job->project_name}}</a></td>
				<td>@if($my_job->job->budget!=0)${!! $my_job->job->budget !!}@else Not specified @endif</td>
				<td><a href="{!! URL::route('job.jobProposals', ['job-id'=>$my_job->job->id]) !!}">View ({!! count($my_job->job->proposals) !!})</a></td>
				<td>{{$my_job->job->created_at}}</td>
				<td>@if(isset($my_job->approve_contract) && ($my_job->approve_contract==1)) Contract isn't Approved yet @elseif(isset($my_job->cancel_contract) && $my_job->cancel_contract==1)Contract cancelled @elseif(isset($my_job->ended_contract) && $my_job->ended_contract==1 && isset($my_job->proposal_selected->id))<a href="{!! URL::to('/financial/terms_milestone/').'?p_id='. $my_job->proposal_selected->id !!}" class="margin-left-5">Contract ended</a>
				<br/>
				<a href="{!! URL::to('/financial/reopen_contract/').'?p_id='. $my_job->proposal_selected->id !!}" class="margin-left-5 reopen">Reopen the contract</a>
				
				@elseif(isset($my_job) && $my_job->ended_contract==0 && $my_job->cancel_contract==0 && isset($my_job->proposal_selected->id))<a href="{!! URL::to('/financial/terms_milestone/').'?p_id='. $my_job->proposal_selected->id !!}" class="margin-left-5">View Contract</a> @endif</td>
				
				<td>@if($my_job->job->job_close==1) <a href="{!! URL::route('job.openJob', ['job-id'=>$my_job->job->id, '_token' => csrf_token()]) !!}" class="open_job"><font color='green'><strong>Reopen Job</strong></font></a> @else<a href="{!! URL::route('job.closeJob', ['job-id'=>$my_job->job->id, '_token' => csrf_token()]) !!}" class="close_job">Close Job</a>@endif</td>
				<td><a href="{!! URL::route('job.editJob', ['id'=>$my_job->job->id]) !!}"><i class="fa fa-pencil-square-o fa-2x"></i></a></td>
				<td><a href="{!! URL::to('/job/').'/'.$my_job->job->slug !!}" class="margin-left-5"><i class="fa fa-eye fa-2x"></i></a></td>
				<td><a href="{!! URL::route('myJob.delete',['id' => $my_job->job->id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a></td>
			</tr>	
		@endforeach
              
           		   			</tbody></table>
			<div style="margin-left:2px" class="row pagging">
			{!! $my_jobs->render() !!}
		  </div>
			@else
				<div style='text-align:center'><h3>You haven't posted any job</h3></div>
			@endif
			</div>
			</div></div></div>
  </div>
      </div>
	  {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
	      <script>
      
	$(function() {
         $(".delete").click(function(){
            return confirm("Are you sure to delete this job?");
        }); 
		
		$(".close_job").click(function(){
            return confirm("Are you sure to close this job?");
        }); 
		
		$(".open_job").click(function(){
            return confirm("Are you sure to reopen the job?");
        }); 
		
		$(".reopen").click(function(){
            return confirm("Are you sure to reopen the contract?");
        });
		
    });
	
    </script>
	  @stop