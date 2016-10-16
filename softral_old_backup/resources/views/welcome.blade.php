@extends('laravel-authentication-acl::client.layouts.base')
@section('title')
Softral - Welcome to Softral
@stop
@section('content')
<div class="row content">
     @include('laravel-authentication-acl::client.layouts.sidebar')
	  
        <div class="col-lg-9 content-right">
         
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
          <div class="row selected-classifieds">
		  @if(Input::get('search_type')=='freelancer')
			 <h4 style='padding-left: 14px;'>All Freelancers</h4>
		  @endif
		  
		  @if(Input::get('search_type')=='jobs' || Input::get('search_type')=='') 
			  <h4 style='padding-left: 14px;display:inline'>
			  @if($category!=null)
				{!!  $skill !!} : <strong><font color='#D2322D'>{!!  $category !!}</font></strong>
			  @else
				All Jobs
			  @endif
			
			 @if(isset($_GET['status']) && $_GET['status']!='') 
				<strong><font color='#D2322D'>: Hiring Closed </font></strong>
			 @endif
		  </h4>
		  
		  <form class="form" accept-charset="UTF-8" action="{!! URL::to('/') !!}/shome" method="GET" style='display:inline'>
				<div class="form-group pull-right" style='width: 36%;'>
			  <label class="control-label col-sm-4" for="Sort By" style='padding:5px 0px 0px 47px'>Sort By:</label>
			  <div class="col-sm-6 col-md-8">
				<select id="sorting" class="form-control" name="sorting" onchange='this.form.submit()'>
				  <option value=''>-Select Sorting-</option>
				  <option value='created-at-desc' @if(isset($_GET['sorting']) && $_GET['sorting']=='created-at-desc') {!!'selected'!!}@endif >Posted date Desc</option>
				  <option value='created-at-asc' @if(isset($_GET['sorting']) && $_GET['sorting']=='created-at-asc') {!!'selected'!!}@endif>Posted date Asc</option>
				  <option value='budget-desc' @if(isset($_GET['sorting']) && $_GET['sorting']=='budget-desc') {!!'selected'!!}@endif>Budget High</option>
				  <option value='budget-asc' @if(isset($_GET['sorting']) && $_GET['sorting']=='budget-asc') {!!'selected'!!}@endif>Budget Low</option>
				  <option value='project-name-desc' @if(isset($_GET['sorting']) && $_GET['sorting']=='project-name-desc') {!!'selected'!!}@endif>Job name Desc</option>
				  <option value='project-name-asc' @if(isset($_GET['sorting']) && $_GET['sorting']=='project-name-asc') {!!'selected'!!}@endif>Job name Asc</option>
				</select> 
			  </div>
			</div>
		  </form>
		  
		  @if(isset($_GET['min']) && $_GET['min']!='' && isset($_GET['max']) && $_GET['max']!='')
			  <h5 style="padding-left: 14px;">Min: <strong><font color='#D2322D'>${!!Input::get('min')!!}</font></strong> And Max: <strong><font color='#D2322D'>${!!Input::get('max')!!}</font></strong></h5>
		  @endif
		  
		  
		  @if(count($jobs) != 0) 
		   @foreach($jobs as $job)
		   <?php $images=unserialize($job->images); ?>
		 
            <div class="col-lg-12">
              <div class="thumbnail">
				  @if(empty($images))
					<img src="{!! URL::to('/') !!}/images/noImageAvailable.JPG" />
				  @else
					   <img src="{!! URL::to('/') !!}/uploads/{!! $images[0] !!}"  />
				  @endif
                <div class="caption">
                  <h4><a href="{!! URL::to('/job/').'/'.$job->slug !!}">{!! $job->project_name !!}</a></h4>
				  <div class='price'>
				  @if($job->job_type=='fixed' && $job->budget!='0')
						Budget: ${!! $job->budget !!} -
					@elseif($job->budget!='0')
						Hourly: ${!! $job->budget !!}/Hour -
					@endif
			  Posted : {!!  $job->created_at !!} | Total Proposals <strong>({!! count($job->proposals)!!})</strong></div><div class="pull-right posted_by"><span style="color: #AFAFAF; ">Posted By:</span> <a href="{!! URL::to('/user/profile').'/'.$job->user->user_profile[0]->slug !!}"   >{!!  ucwords($job->user->user_profile[0]->first_name) !!}</a></div><br/>
				  <div class="description">{!! $job->cut_description !!}</div>
				  @if(isset($job->categories->category))
				  <div class="categories"><span style="color: #AFAFAF; ">Category:</span> <a href="{!! URL::to('/category/').'/'.$job->categories->slug !!}"   >{!!  $job->categories->category !!}</a> </div>
				  @endif
				   @if(!empty($job->modified_skill_id))
				  <div class="pull-right skills"><span style="color: #AFAFAF; ">Skills:</span> {!! $job->modified_skill_id !!}</div>
				   @endif
                </div>
              </div>
            </div>
			@endforeach 
			<div class="col-lg-12">{!! $jobs->render() !!}</div>
			@else
				  <div class="col-lg-12">Sorry, No Jobs Found</div>
			@endif
          </div>
		  
		  @else
		  <!-- for freelancing -->
	   @if(count($jobs) != 0) 
	  @foreach($jobs as $proposal)
		  <div class="col-lg-12">
			
			  <div class="thumbnail" >
				@if($proposal->avatar!=NULL)
			                  <img src="data:image/jpeg;base64,{!! ( $proposal->user->user_profile[0]->avatar) !!}" style='width:100px;height:100px'>
				@else
					 <span class='glyphicon glyphicon-user proposal-user'></span>
				@endif
			                  <div class="caption">
                  <h4>
				 
					<a href="{!! URL::to('/user/profile').'/'.$proposal->user->user_profile[0]->slug !!}">{{ $proposal->first_name}}</a>
				 
				</h4>
				 <div class="price"><span class="glyphicon glyphicon-map-marker"></span> @if($proposal->city!=null){!! $proposal->city.',' !!}@endif
							@if($proposal->state!=null){!! $proposal->state.',' !!}@endif
							{!! $proposal->country !!}</div><div class="pull-right posted_by"><span style="color: #AFAFAF; ">User since:</span> {!!  $proposal->modified_created_at !!}</div><br>
				  <?php $about_me = 'Nothing Specified Yet'; ?>
				  <?php $skills='No skills selected'; ?>
				  @foreach($proposal->profile_field as $profile_field)
					@if( $profile_field->profile_field_type_id==2)
						<div class="description">
						<?php $about_me = $profile_field->original_value; ?>
						</div>
							<?php break; ?>
					@else
						<?php $about_me = 'Nothing Specified Yet'; ?>
					@endif
				  @endforeach
				  
				   @foreach($proposal->profile_field as $profile_field)
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
								 
              </div>
            </div>
				@endforeach
				<div class="col-lg-12">{!! $jobs->render() !!}</div>
			@else
				  <div class="col-lg-12">Sorry, No Freelancer Found</div>
			@endif
		</div>
			@endif
		 <!-- for freelancing -->
		  
        </div>
      </div>
	  @stop