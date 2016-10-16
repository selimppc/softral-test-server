@extends('laravel-authentication-acl::client.layouts.base')

@section('title')
Admin area: Freelancer Feedback
@stop

@section('content')
{!! HTML::style('css/starrr.css') !!}
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
       
		<div class="col-md-12 panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="panel-title bariol-thin"><i class="fa fa-send"></i>Give Feedback and Rating to the Employer for job - {!! $contract->job->project_name !!}</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    
					<div class="col-md-12 col-xs-12">
                
					{!! Form::open(array('route' => 'FreelancerratingSave', 'class' => 'form','method' => 'POST')) !!}
				
				<div class="form-group">
				
				<div class='row'>
					<div class='col-md-6'>
	
				{!! Form::label('employee_rating', 'Rating to Employer', ['class' => 'control-label','style'=>'display:block']) !!}
				 <div class='starrr' id='star1'></div>
				</div>
					</div>
					
					<div class='row'>
					<div class='col-md-6'>
					{!! Form::label('Feedback', 'Feedback: *', ['class' => 'control-label','style'=>'display:block']) !!}
					{!! Form::hidden('employee_rating', null, array('id'=>'ratings-hidden')) !!}
					{!! Form::hidden('contract_id', $contract->id, array('id'=>'ratings-hidden')) !!}
                  {!! Form::textarea('employee_comment', null, array('rows'=>'5','id'=>'new-review','class'=>'form-control animated','placeholder'=>'Enter your feedback here...'))!!}
					</div>
					</div>
				</div>
				
				{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
				
				{!! Form::close() !!}
                    </div>
                </div>
                <div class="row">
                   
            </div>
        </div>
    </div>
    
</div>
</div>
 {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
	 {!! HTML::script('js/starrr.js') !!}
 <script>
    var $s2input = $('#ratings-hidden');
    $('#star1').starrr({
      max: 5,
      rating: $s2input.val(),
      change: function(e, value){
        $s2input.val(value).trigger('input');
      }
    });
  </script>
@stop
