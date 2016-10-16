@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Admin area: Send Mail to Users
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <?php $message = Session::get('message'); ?>
        @if( isset($message) )
        <div class="alert alert-success">{!! $message !!}</div>
        @endif
		
		<?php $error = Session::get('error'); ?>
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
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="panel-title bariol-thin"><i class="fa fa-send"></i> Send Mail</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    
					<div class="col-md-12 col-xs-12">
                
					{!! Form::open(array('route' => 'mailSend', 'class' => 'form','method' => 'POST')) !!}
				
				<div class="form-group">
				
				<div class='row'>
					<div class='col-md-6'>
				{!! Form::label('user_type', 'Select User type', ['class' => 'control-label','style'=>'display:block']) !!}
				{!! Form::select('user_type',array('1'=>'-Select Type-','Freelancer','Employer'),Input::get('type'),array('class'=>'form-control','name'=>'user_type','required'=>'required','onchange'=>'return select_type(this.value);')) !!}
				</div>
					</div>
					
				<div class='row'>
					<div class='col-md-6'>
					
				{!! Form::label('users', 'Select Users', ['class' => 'control-label','style'=>'display:block']) !!}
				{!! Form::select('users',$users,null,array('class'=>'chosen-select-width form-control','multiple'=>'multiple','name'=>'users[]','required'=>'required')) !!}
				<a href='void:javascript(0)' class="select">Select all</a>
				</div>
					</div>
					<br>
					<div class='row'>
					<div class='col-md-6'>
				{!! Form::label('Bcc:', 'Bcc:', ['class' => 'control-label','style'=>'display:block']) !!}
				{!! Form::text('bcc','',array('class'=>'form-control','placeholder'=>'Enter Bcc')) !!}
				</div>
					</div>
					<br>
					<div class='row'>
					<div class='col-md-6'>
					{!! Form::label('Messages', 'Messages: *', ['class' => 'control-label ','style'=>'display:block']) !!}
				<textarea rows="10" cols="50" name="message" class="form-control" required></textarea>
					</div>
					</div>
				</div>
				<a href="{!! URL::route('financial') !!}" class='btn btn-primary'>Back</a>
				 
				{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
				
				{!! Form::close() !!}
                    </div>
                </div>
                <div class="row">
                    
            </div>
        </div>
    </div>
</div>
 {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
 {!! HTML::style('packages/jacopo/laravel-authentication-acl/css/chosen.min.css') !!}
 {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/chosen.jquery.js') !!}
  <script>
      
	$(function() {
         $(".delete_account").click(function(){
            return confirm("Are you sure to delete this item?");
        });
	
    });
	
    </script>
	  <script type="text/javascript">
  $( document ).ready(function() {
	$('.select').click(function(){
		 $('.chosen-select-width option').prop('selected', true);
		 $('.default').val('ALL SELECTED');
		 $('.chosen-select-width').trigger("chosen:updated");
		 return false;
	});
});

</script>
	<script type="text/javascript">
    var config = {
      '.chosen-select-width'     : {width:"60%"}
    }
    for (var selector in config) {
      $(selector).chosen(config[selector]);
    }
	
	function select_type(val){
	window.location="{!! URL::to('/') !!}/admin/mailSend?type="+val;
}
  </script>

@stop
