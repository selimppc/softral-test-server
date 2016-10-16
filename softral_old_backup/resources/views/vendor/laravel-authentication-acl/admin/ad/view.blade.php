@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Admin area: Ads list
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
            <div class="col-md-12">
                {{-- print messages --}}
                <?php $message = Session::get('message'); ?>
                @if( isset($message) )
                    <div class="alert alert-success">{!! $message !!}</div>
                @endif
                {{-- print errors --}}
                @if($errors && ! $errors->isEmpty() )
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{!! $error !!}</div>
                    @endforeach
                @endif
                {{-- user lists --}}
				<div class="panel panel-info">
			<div class="panel-heading">
			<h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> {!! 'View Ad : '.$ad->title !!}</h3>
			</div>
    <div class="panel-body">
                <div class="col-md-12">
             <div id="section1">
                <h5><strong>Ad title</strong> : {!! $ad->title !!}</h5>
            </div>
            <hr> 
			<div id="section1">
                <h5><strong>Posted by</strong> :  {!!  ucwords($ad->user->user_profile[0]->first_name) !!}</h5>
            </div>
            <hr>
            <div id="section2">
                <h5><strong>Category name</strong> :{!! $ad->categories->category !!}</h5>
            </div>
            <hr>
			<div id="section2">
                <h5><strong>Ad Description</strong> :{!! $ad->description !!}</h5>
            </div>
            <hr>
			<div id="section2">
				<?php $images=unserialize($ad->images); ?>
                <h5><strong>Images</strong> :
				 @if(!empty($images))
					 @for($i=0;$i<count($images);$i++)
						<img src="{!! URL::to('/') !!}/uploads/{!! $images[$i] !!}"  width='33%' />
					 @endfor
				@endif
			</h5>
            </div>
            <hr>
			<div id="section2">
                <h5><strong>Price:</strong> ${!! $ad->price !!}</h5>
            </div>
			 <hr>
			<div id="section2">
                <h5><strong>State:</strong> :{!! $ad->state !!}</h5>
            </div>
			 <hr>
			<div id="section2">
                <h5><strong>City:</strong> :{!! $ad->city !!}</h5>
            </div>
			 <hr>
			<div id="section2">
                <h5><strong>Address:</strong> :{!! $ad->address !!}</h5>
            </div>
            <hr>
			<div id="section2">
                <h5><strong>Email:</strong> :{!! $ad->email !!}</h5>
            </div>
            <hr>
			<div id="section2">
                <h5><strong>Phone no:</strong> :{!! $ad->phone_no !!}</h5>
            </div>
            <hr>
			<div id="section2">
                <h5><strong>Created at:</strong> : {!! $ad->created_at !!}</h5>
            </div>
            <hr>
			
          </div>
          </div>
            </div>
         
        </div>
</div>
</div>
@stop

@section('footer_scripts')
  
@stop