@extends('laravel-authentication-acl::client.layouts.base')
@section('title')
Softral - Classified Adverts
@stop
@section('content')

<div class="row content">
	
     @include('laravel-authentication-acl::client.layouts.sidebar_classifieds')
     
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
		  <h4 style='padding-left: 14px;display:inline'>
		  @if($category!=null)
			{!!  $category_label !!} : <strong>{!!  $category !!}</strong>
		  @else
			All Classifieds
		  @endif
			 @if(isset($_GET['status']) && $_GET['status']!='') 
				<strong>: Classifieds Open </strong>
			 @endif
		  </h4>
		  
		  <form class="form" accept-charset="UTF-8" action="" method="GET" style='display:inline'>
				<div class="form-group pull-right" style='width: 36%;'>
			  <label class="control-label col-sm-4" for="Sort By" style='padding:5px 0px 0px 47px'>Sort By:</label>
			  <div class="col-sm-6 col-md-8">
				<select id="sorting" class="form-control" name="sorting" onchange='this.form.submit()'>
				  <option value=''>-Select Sorting-</option>
				  <option value='created-at-desc' @if(isset($_GET['sorting']) && $_GET['sorting']=='created-at-desc') {!!'selected'!!}@endif >Posted date Desc</option>
				  <option value='created-at-asc' @if(isset($_GET['sorting']) && $_GET['sorting']=='created-at-asc') {!!'selected'!!}@endif>Posted date Asc</option>
				  <option value='price-desc' @if(isset($_GET['sorting']) && $_GET['sorting']=='price-desc') {!!'selected'!!}@endif>Price High</option>
				  <option value='price-asc' @if(isset($_GET['sorting']) && $_GET['sorting']=='price-asc') {!!'selected'!!}@endif>Price Low</option>
				  <option value='title-desc' @if(isset($_GET['sorting']) && $_GET['sorting']=='title-desc') {!!'selected'!!}@endif>Classified Desc</option>
				  <option value='title-asc' @if(isset($_GET['sorting']) && $_GET['sorting']=='title-asc') {!!'selected'!!}@endif>Classified Asc</option>
				</select> 
			  </div>
			</div>
		  </form>
		  
		  @if(isset($_GET['min']) && $_GET['min']!='' && isset($_GET['max']) && $_GET['max']!='')
			  <h5 style="padding-left: 14px;">Min:<strong>${!!Input::get('min')!!}</strong> And Max:<strong>${!!Input::get('max')!!}</strong></h5>
		  @endif
		  
		  
		  @if(count($ads) != 0) 
		   @foreach($ads as $ad)
		   <?php $images=unserialize($ad->images); ?>
		 
            <div class="col-lg-12">
              <div class="thumbnail advert">
			  <!--@if(empty($images))
                <img src="{!! URL::to('/') !!}/images/noImageAvailable.JPG" />
			  @else
				   <img src="{!! URL::to('/') !!}/uploads/{!! $images[0] !!}"  />
			  @endif-->
                <div class="caption">
                 <h4 style='display:inline-block'><span class="ad_date">{!!  $ad->modified1_created_at !!} </span><a href="{!! URL::to('/ad-detail/').'/'.$ad->slug !!}">{!! $ad->title !!}</a> <span class="ad_date">${!! $ad->price !!} ({!! $ad->state !!}, {!! $ad->city !!})</span></h4>
				<div class="pull-right posted_by"><span style="color: #AFAFAF; ">Posted By:</span> <a href="{!! URL::to('/user/profile').'/'.$ad->user->user_profile[0]->slug !!}"   >{!!  ucwords($ad->user->user_profile[0]->first_name) !!}</a></div><br/>
				  <div class="description">{!! $ad->cut_description !!}</div>
				  @if(isset($ad->categories->category))
				  <div class="categories"><span style="color: #AFAFAF; ">Category:</span> <a href="{!! URL::to('/ad-category/').'/'.$ad->categories->slug !!}"   >{!!  $ad->categories->category !!}</a> </div>
				  @endif
				   
				  <!--<div class="pull-right skills"><span style="color: #AFAFAF; ">Location:</span><a href="{!! URL::to('/state/').'/'.$ad->modified_state !!}">{!! $ad->state !!}</a>, <a href="{!! URL::to('/city/').'/'.$ad->modified_city!!}">{!! $ad->city !!}</a></div>-->
				   
                </div>
              </div>
            </div>
			@endforeach 
			<div class="col-lg-12">{!! $ads->render() !!}</div>
			@else
				  <div class="col-lg-12">Sorry, No Classifieds Found</div>
			@endif
          </div>
        </div>
      </div>
	 
	  @stop