@extends('laravel-authentication-acl::client.layouts.base-fullscreen')
@section ('title')
404
@stop
@section('content')
<div class=''>
<div class='gallary'>
<?php $message = Session::get('message'); ?>
        @if( isset($message) )
        <div class="alert alert-success">{!! $message !!}</div>
        @endif
		<?php $error = Session::get('error'); ?>
        @if( isset($error) )
        <div class="alert alert-danger">{!! $error !!}</div>
        @endif
<div class="row content">
 {{-- successful message --}}
        
       @if($errors->any())
			<div class="alert alert-danger">
				@foreach($errors->all() as $error)
					<p>{{ $error }}</p>
				@endforeach
			</div>
		@endif
    <div class="col-lg-12 text-center v-center">

        <h1><i class="fa fa-exclamation-triangle"></i> 404</h1>
        <p class="lead">
            Sorry, this is not the page you were looking for.
            <a href="{!! URL::to('/') !!}"><i class="fa fa-home"></i> Go to homepage</a>
        </p>
    </div>
</div>
</div>
</div>
@stop