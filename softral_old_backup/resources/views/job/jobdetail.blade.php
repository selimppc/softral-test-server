@extends('laravel-authentication-acl::client.layouts.base')
@section('title')
Softral Job - {!! $job_detail->project_name !!}
@stop
@section('content')
<div class="row content">
    
        <div class="container-fluid main_content view-job">
	
	<div class="row-fluid">
		
		<div class="col-lg-9">
		
      {{-- successful message --}}
        <?php $message = Session::get('message'); ?>
        <?php $error = Session::get('error'); ?>
        @if( isset($message) )
        <div class="alert alert-success">{!! $message !!}</div>
        @endif
		
		 @if( isset($error) )
        <div class="alert alert-danger">{!! $error !!}</div>
        @endif
       @if($errors->any())
			<div class="alert alert-danger">
				@foreach($errors->all() as $error)
					<p>{{ $error }}</p>
				@endforeach
			</div>
		@endif
        <div class="alert alert-success jave_job_success" style='display:none'></div>
       
		<ol class="breadcrumb">
            <li><span class="glyphicon glyphicon-home"></span> <a href="{!! URL::to('/') !!}">Home</a></li>
			@if(!empty($job_detail->categories->parent_get))
				<li><a href="{!! URL::to('/category/').'/'.$job_detail->categories->parent_get->slug !!}">{!! $job_detail->categories->parent_get->category !!}</a></li>
			@endif
            @if(isset($job_detail->categories->category))
				<li><a href="{!! URL::to('/category/').'/'.$job_detail->categories->slug !!}">{!!  $job_detail->categories->category !!}</a></li>
			@endif
            <li>{!! $job_detail->project_name !!}</li>
          </ol>
			
			<div class="row-fluid">
				<div class="col-md-12 panel panel-info">
					<br>
					 <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                         <h3 class="panel-title bariol-thin" style='font-size:26px'>{!! $job_detail->project_name !!}</h3>
                    </div>
                </div>
            </div>    
			<br/>
			@if(isset($job_detail->categories->category))
					<h5>Category: <a href="{!! URL::to('/category/').'/'.$job_detail->categories->slug !!}"   >{!!  $job_detail->categories->category !!}</a></h5>
				@endif
					<div class="row-fluid">
						<div class="">
						@if($job_detail->job_type=='fixed')
							Fixed Price : @if($job_detail->budget!=0)${!! $job_detail->budget !!}@else Not specified @endif
						@else
							Hourly : @if($job_detail->budget!=0)${!! $job_detail->budget !!}/Hour @else Not specified @endif
						@endif
						&nbsp;&nbsp;<span class="job_info_sep">|</span>&nbsp;&nbsp;
						
						@if($job_detail->hourperweek!='0')
							{!! $job_detail->hourperweek !!} Hours/Week
							&nbsp;&nbsp;<span class="job_info_sep">|</span>&nbsp;&nbsp;
						@endif	
						
						@if($job_detail->duration!='')
							{!! $job_detail->duration !!}
							&nbsp;&nbsp;<span class="job_info_sep">|</span>&nbsp;&nbsp;
						@endif
						<span class='glyphicon glyphicon-time'></span> Posted {!!  $job_detail->created_at !!}
							<a class="pull-right" href='{!! URL::to('/') !!}'><span><&nbsp;</span><span class="lnk-title">Back</span></a>
						</div>
					</div>
					<hr>
					
					
					{!! $job_detail->description !!}
					<?php $images=unserialize($job_detail->images); ?>
					@if(!empty($images))
					<hr>
					<div class="row-fluid">
						<h5>Images : {!! $images_string !!}</h5>
					</div>
					@else
					<hr>	
					@endif
					
					<div class="row-fluid">
						<h5>Skills : {!! $job_detail->modified_skill_id !!}</h5>
					</div>
					<hr>
					
					<div class="row-fluid">
						<h5>Job ID : {!! $job_detail->id !!}</h5>
					</div>
					
				</div>
			</div>
			
			<div class="col-lg-12 content-right">
        
          <div class="row selected-classifieds proposal">
		  			<h3 style=' margin-left: 14px;display:inline'>All Proposals</h3>
					<div class="pull-right total_proposal">Total proposals ({!! count( $job_detail->proposals) !!})</div>
				@if(count( $proposals)!=0)	
					@foreach($proposals as $proposal)
				@if(isset($proposal->user->id))
            <div class="col-lg-12">
			@if($logged_id==$proposal->user->id)
              <div class="thumbnail" style='border:4px solid #CDEEF4; box-shadow: 0 1px 1px rgba(0, 0, 0, 0.05);'>
			@else
			  <div class="thumbnail" >
			@endif	
				@if($proposal->user->user_profile[0]->avatar!=NULL)
			                  <img src="data:image/jpeg;base64,{!! ( $proposal->user->user_profile[0]->avatar) !!}">
				@else
					 <span class='glyphicon glyphicon-user proposal-user'></span>
				@endif
			                  <div class="caption">
                  <h4>
				  @if($logged_id!=$proposal->user->id)
					<a href="{!! URL::to('/user/profile').'/'.$proposal->user->user_profile[0]->slug !!}">{{ $proposal->user->user_profile[0]->first_name}}</a>
				  @else
					<a href="javascript:void(0)">Your Proposal</a>
				  @endif
				</h4>
				 <div class="price"><span class="glyphicon glyphicon-map-marker"></span> @if($proposal->user->user_profile[0]->city!=null){!! $proposal->user->user_profile[0]->city.',' !!}@endif
							@if($proposal->user->user_profile[0]->state!=null){!! $proposal->user->user_profile[0]->state.',' !!}@endif
							{!! $proposal->user->user_profile[0]->country !!}</div><div class="pull-right posted_by"><span style="color: #AFAFAF; ">Submitted:</span> {!!  $proposal->created_at !!}</div><br>
				  <?php $about_me = 'Nothing Specified Yet'; ?>
				  <?php $skills='No skills selected'; ?>
				  @foreach($proposal->user_profile->profile_field as $profile_field)
					@if( $profile_field->profile_field_type_id==2)
						<div class="description">
						<?php $about_me = $profile_field->original_value; ?>
						</div>
							<?php break; ?>
					@else
						<?php $about_me = 'Nothing Specified Yet'; ?>
					@endif
				  @endforeach
				  
				   @foreach($proposal->user_profile->profile_field as $profile_field)
					@if( $profile_field->profile_field_type_id==3)
						<div class="description">
						<?php $skills = $profile_field->modified_value;		
						?>
						</div>
							<?php break; ?>
					@else
						<?php $skills = 'No skills selected'; ?>
					@endif
					 @endforeach
				
				<div class="description">
					{!!$about_me!!}</div>
					  <!--<div class="categories"><span style="color: #AFAFAF; ">Category:</span> <a href="http://localhost:81/client_projects/softral1/public/category/graphic-design-job">Graphic design job</a> </div>-->
				   				  <div class="pull-right skills"><span style="color: #AFAFAF; ">Skills:</span>{!!$skills!!} </div>
				                   </div>
								   @if($owner=='owner' && empty($proposal_selected))
									   <div class="pull-left" style='width:100%'>
								<a href="{!! URL::route('job.selectProposal',['id' => $proposal->id,'job_id' => $job_detail->id,'_token' => csrf_token()]) !!}" title="Select a proposal"  class='select_proposal'><strong>Select Proposal</strong></a>
							   </div>
									@elseif(!empty($proposal_selected) && $proposal_selected->id==$proposal->id)
										 <div class="pull-left" style='width:100%;color:#3276B1'>
								<strong>Proposal Selected!</strong>
							   </div>
									@endif
              </div>
            </div>
			@endif
				@endforeach
				
		</div>
		@endif
		</div><div class="col-lg-12">
		@if(count( $job_detail->proposals)!=0)
				<a href='javascript:void(0)' id='view_more' value='{!! $job_detail->id !!}'>View More</a>
		@else
				No Proposal Found
		@endif
			</div>
		</div>
		</div>
		
		
		
		<div class="col-lg-3" style='margin-top: 30px;'>
		
		<div class="row-fluid col-lg-12">
						
							<div class="col-lg-9"><h3>Client info</h3><br>
							@if($job_detail->user->user_profile[0]->avatar!=NULL)
								<img src="data:image/jpeg;base64,{!! ( $job_detail->user->user_profile[0]->avatar) !!}" style='width:200px'>
							@else
								<span class="glyphicon glyphicon-user client_image" style=""></span>
							@endif
						</div><div class="col-lg-12"><h3>Posted by <a href='{!! URL::to('/user/profile').'/'.$job_detail->user->user_profile[0]->slug !!}'>{!! ucwords($job_detail->user->user_profile[0]->first_name )!!}</a></h3></div> 
						</div>
					
				<br>	
		<div class="row-fluid">
						<div class="col-lg-12" style=' margin-left: 11px;'>
							<h5><span class="glyphicon glyphicon-map-marker"></span> @if($job_detail->user->user_profile[0]->city!=null){!! $job_detail->user->user_profile[0]->city.',' !!}@endif
							@if($job_detail->user->user_profile[0]->state!=null){!! $job_detail->user->user_profile[0]->state.',' !!}@endif
							{!! $job_detail->user->user_profile[0]->country !!}&nbsp;&nbsp;</h5>
						</div>
					</div>
					
					
			<br>
			<div class="row-fluid">
			
				<div class="col-md-12" style=' margin-left: -15px;'>
					<br>
					<?php /*@if(!empty($proposal_selected))
						<a href='javascript:void(0)' class="btn btn-primary btn-large col-md-12 " >This job has been assigned.</a> */ ?>
					@if($job_detail->job_close==2)
						<a href='javascript:void(0)' class="btn btn-primary btn-large col-md-12 " style='width:auto'>Job has been closed.</a>
					@elseif(!empty($check_proposal))
						<a href='javascript:void(0)' class="btn btn-primary btn-large col-md-12 " style='width:auto'>You have already submitted a proposal</a>
					@elseif($owner!='owner')
						<a class="btn btn-primary btn-large col-md-12 " href="{!! URL::to('/add-proposal/').'/'.$job_detail->slug !!}">&nbsp;Submit A Proposal</a>
					@else
						<a href='javascript:void(0)' class="btn btn-primary btn-large col-md-12 ">Your Job</a>
					@endif
					
				</div>
				
				<div class="col-md-12" style=' margin-left: -15px;'>
					<br>
					
					@if(empty($save_jobs))
						<a href="javascript:void(0)" class='btn btn-success col-md-12 ' title="Save this job" value="{!! $job_detail->id !!}" id='save_job'><span class="glyphicon glyphicon-heart"></span> Save Job</a>
					@else
						<a href="javascript:void(0)" class='btn btn-success col-md-12 ' title="Save this job"  id=''><span class="glyphicon glyphicon-heart"></span> Job saved</a>
					@endif
					
				</div>
				<hr>
				@if(isset($job_detail->categories->get_jobs))
				<div class="col-md-12">
					<h3>Similar jobs</h3>
					<hr>
					<ul class="similar_jobs">
					@foreach($job_detail->categories->get_jobs as $same_job)
						@if($same_job->id!=$job_detail->id)
							<li><a href="{!! URL::to('/job/').'/'.$same_job->slug !!}">{!!$same_job->project_name!!}</a><br><small>by {!!  ucwords($same_job->user->user_profile[0]->first_name) !!}</small></li>
						@endif
					@endforeach
					</ul>
				</div>
				@endif
				
			</div>
			
			
		</div>
	</div>
	
	
</div>
      </div>
	   {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
	<script>
		 $( document ).ready(function() {
			 var page=1;
			 
			$(".select_proposal").click(function(){
				return confirm("Are you sure to select this proposal?");
        });
			  /*View more Propsoals Ajax*/
			 $("#view_more").click(function(){
				  var data = $(this).attr('value') ;
				  page=page+1;
				
				 $.post("{!! URL::to('/job/ajaxproposal/') !!}"+"/"+data+"/"+page, function(response){
				if(response.success)
				{
					if(response.proposals=='empty'){
						$('#view_more').html('No more proposal!');
						return false;
					}
					$('.proposal').append(response.proposals);	
				}
			}, 'json');
				 
			 });
			 
			 /*Save Jobs Ajax*/
			 	$(document).on('click', '#save_job', function(){
				  var data = $(this).attr('value') ;
				   var text='save_job';
				 $.post("{!! URL::to('/job/savejob/') !!}"+"/"+data+"/"+text, function(response){
				if(response.success)
				{
					
					$('.jave_job_success').show().html('You have successfully saved the job').delay(3000).fadeOut();;	
					$('#save_job').html('<span class="glyphicon glyphicon-heart"></span> Job saved');	
					$('#save_job').attr('id','');	
				}
			}, 'json');
				 
			 });
		 });
		
	</script>
	
	  @stop