@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Admin area: Jobs list
@stop

@section('content')
<div class="row content">
    
        <div class="container-fluid main_content view-job">
	
	<div class="row-fluid">
		
		<div class="col-lg-12">
	
	<?php $message = Session::get('message'); ?>
        @if( isset($message) )
        <div class="alert alert-success">{!! $message !!}</div>
        @endif
		
		<ol class="breadcrumb">
            <li><span class="glyphicon glyphicon-home"></span> <a href="{!! URL::to('/') !!}">Home</a></li>
			@if(!empty( $proposal->job->categories->parent_get))
				<li><a href="{!! URL::to('/category/').'/'. $proposal->job->categories->parent_get->slug !!}">{!!  $proposal->job->categories->parent_get->category !!}</a></li>
			@endif
            @if(isset($proposal->job->categories->category))<li><a href="{!! URL::to('/category/').'/'. $proposal->job->categories->slug !!}">{!!   $proposal->job->categories->category !!}</a></li>@endif
            <li><a href="{!! URL::to('/job/').'/'. $proposal->job->slug !!}">{!!  $proposal->job->project_name !!}</a></li>
			 <li>My Proposal</li>
          </ol>
			
			<div class="row-fluid">
				<div class="col-md-12 panel panel-info">
					<br>
					 <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                         <h3 class="panel-title bariol-thin" style='font-size:26px'>{!! $proposal->job->project_name !!}</h3>
                    </div>
					
					<div class="col-md-6" style='text-align:right;padding-top:5px'>
					@if($no_more==1)
						<strong>Job is no more!</strong>
					@else
						@if($proposal->offer==1)
							<strong>Proposal selected for this job</strong>
						@else
							@if($proposal->job->selected==0 && $user_id==$proposal->job->user_id)	
								<a href="{!! URL::route('job.selectProposal',['id' => $proposal->id,'job_id' => $proposal->job->id,'_token' => csrf_token()]) !!}" title="Select a proposal"  class='select_proposal pull-right'><strong>Select Proposal</strong></a>
							@endif
						@endif
					@endif
					</div>
                </div>
            </div>    
					@if(isset($proposal->job->categories->category))<h5>Category: <a href="{!! URL::to('/category/').'/'.$proposal->job->categories->slug !!}"   >{!! $proposal->job->categories->category !!}</a></h5>@endif
					
					<hr>
				
					{!! $proposal->proposal !!}
					<?php $images=unserialize($proposal->job->images); ?>
					@if(!empty($images))
					<hr>
					<div class="row-fluid">
						<h5>Images : {!! $images_string !!}</h5>
					</div>
					@else
					<hr>	
					@endif
					
					@if( $proposal->job->job_type=='fixed')
					<div class="row-fluid">
						<h5> Amount : ${!! $proposal->main_amount !!}</h5>
						<h5>Submitted date : {!! $proposal->created_at !!}</h5>
					</div>
					<hr>
					@else
					<div class="row-fluid">
						<h5>Hour : ${!! $proposal->main_amount !!}/Hour</h5>
						<h5>Submitted date : {!! $proposal->created_at !!}</h5>
					</div>
					<hr>
					@endif
					
					@if($proposal->hoursperweek_amount!='')
					<div class="row-fluid">
						<h5> Hours per week : {!! $proposal->hoursperweek_amount !!} Hours/Week</h5>
					</div>
					<hr>
					@endif
					
					@if($proposal->duration_amount!='')
					<div class="row-fluid">
						<h5> {!! $proposal->duration_amount !!}</h5>
					</div>
					@endif
					<h5>Charged to Client : ${!! $proposal->client_amount !!}</h5>
					
					<div class="row-fluid">
						<h5>Job ID : {!! $proposal->job->id !!}</h5>
					</div>
					
					
				</div>
			</div>
			
			
			@if($proposal->offer==1 && $proposal->freelancer_counter_amount!='') 
				<div class="row-fluid">
				<h3>This offer of ${{$proposal->freelancer_counter_amount}} has been selected.</h3>
				</div>
			@endif
      
		
	</div>
	</div>
	
	
</div>
      </div>
	   {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
	      <script>
     
		$(".select_proposal").click(function(){
				return confirm("Are you sure to select this proposal?");
        });
	
    </script>
	  @stop