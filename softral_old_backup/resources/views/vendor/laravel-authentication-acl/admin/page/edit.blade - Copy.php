@extends('laravel-authentication-acl::admin.layouts.base-2cols')
@section('title')
Admin area: Add page
@stop

@section('content')
{!! HTML::style('packages/jacopo/laravel-authentication-acl/css/summernote.css') !!}
<div class="row">
    <div class="col-md-12">
        {{-- successful message --}}
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
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                         <h3 class="panel-title bariol-thin">{!! isset($page->id) ? '<i class="fa fa-pencil"></i> Edit' : '<i class="fa fa-user"></i> Create' !!} page:</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                      
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                    <h4>Add page</h4>
				
					
				 {!! Form::model($page,['route'=>'page.save', 'method' => 'post','files'=>true]) !!}
				
				 {!! isset($page->id)?Form::hidden('id'):'' !!}	
					
				<div class="form-group">
					{!! Form::label('title', 'Title: *', ['class' => 'control-label']) !!}
					{!! Form::text('title', null, ['class' => 'form-control']) !!}
				</div>
		
				<div class="form-group">
				{!! Form::label('Add Image') !!}
				{!! Form::file('image') !!}
				
				@if($page['image']!='')
					<img src="{!! URL::to('/') !!}/uploads/{!! $page['image'] !!}" width='100px' />
				@endif
				<input type='hidden' name='image_text' value='<?php echo $page['image'];?>' />
			</div>
				
				<div class="form-group">
					{!! Form::label('content', 'Content: *', ['class' => 'control-label']) !!}
					{!! Form::textarea('content', null, ['class' => 'form-control summernote']) !!}
				</div>
				
				@if(isset($page->parent) && ($page->parent!=0) || (!isset($page->parent)))
				<div class="form-group">
					{!! Form::label('parent', 'Select parent page:', ['class' => 'control-label']) !!}
					 {!! Form::select('parent', $parents, (isset($page->parent) && $page->parent) ?$page->parent : "", ["class"=> "form-control"] ) !!}
				</div>
				@endif
				
				<div class="form-group">
					{!! Form::label('active', 'Status', ['class' => 'control-label']) !!}
					{!! Form::select('active', array('1' => 'Active', '0' => 'Inactive'), (isset($page->active)) ?$page->active : "", ['id' => 'active','class' => 'form-control']) !!}
				</div>
			
				{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
				 
				{!! Form::close() !!}
                    </div>
                   
                </div>
            </div>
      </div>
</div>


<script type='text/javascript'>
$(document).ready(function() {
 $('#content').summernote({
  height: 300,                 // set editor height

  minHeight: null,             // set minimum height of editor
  maxHeight: null,             // set maximum height of editor
                 // set focus to editable area after initializing summernote
});
});
</script>
@stop
{!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
@section('footer_scripts')

{!! HTML::script('packages/jacopo/laravel-authentication-acl/js/summernote.min.js') !!}
@stop