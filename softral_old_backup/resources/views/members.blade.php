@extends('laravel-authentication-acl::client.layouts.base')
@section('title')
Softral - Welcome to Softral
@stop
@section('content')
<div class="row content">
    <div class="col-lg-3 content-left">
          <h4>Search</h4>
		  
		  <div class="well well-sm">
		   <form method="GET" action="{!! URL::to('/').'/all-members' !!}" accept-charset="UTF-8" class="form">
           <fieldset> <div class="col-lg-12">
 <div class="col-md-12"> 
 <h4>Type username</h4>
  <input type="text" name="q" class="form-control" placeholder="Search user" value="{{Input::get('q')}}"><br/>
  
  <h4>Select type</h4>
 <select name="search_type" class="form-control" >

 <option value="">-User type-</option>
 <option value="Seller" @if(Input::get('search_type')=='Seller') Selected='selected' @endif>Freelancer</option>
 <option value="Buyer" @if(Input::get('search_type')=='Buyer') Selected='selected' @endif>Employer</option>
 </select>
 <br>
  <h4>Select Skill</h4>

 <select name="skill" class="form-control" >
	<option value="">-Select Skill-</option>
	@foreach($skills as $skill)
		<option value="{!! $skill->id !!}" @if(Input::get('skill')==$skill->id) Selected='selected' @endif>{!! $skill->skill !!}</option>
	@endforeach
 </select>
  <br>
 <h4>Account Number</h4>
	<input type="text" name="l" class="form-control" placeholder="Search Account Number" value="{{Input::get('l')}}"><br/>
 </div></div> <input type="submit" class="btn btn-danger btn-sm btn-search" value="Search">

              </fieldset>
            </form>
          </div>
		
        </div>
	  
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
		  @if((Input::get('search_type')))
			 <h4 style='padding-left: 14px;'>Search by : @if(Input::get('search_type')=='Seller') Freelancer Listing @else Employer Listing @endif</h4>
		  @endif
		
		  </h4>
		  
		
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
				 
					<a href="{!! URL::to('/user/profile').'/'.$proposal->user->user_profile[0]->slug !!}">{{ $proposal->first_name}} {{ $proposal->last_name}}</a>
				 
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
				  <div class="col-lg-12">Sorry, No User Found</div>
			@endif
		</div>
			
		 <!-- for freelancing -->
		  
        </div>
      </div>
	  @stop