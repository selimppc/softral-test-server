@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Admin area: Edit user about
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        {{-- success message --}}
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
                        <h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> Setting</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-3 col-xs-12">
                       {!! Form::model($user_profile,['route'=>'users.setting.save', 'method' => 'post']) !!}
					   
					     <div class="form-group">
                            {!! Form::label('freelancer_fee','Fee for Freelancer: *') !!}
                           {!! Form::text('freelancer_fee', $user_profile->freelancer_fee, ['class' => 'form-control']) !!}
                        </div>
						
						<div class="form-group">
                            {!! Form::label('employee_fee','Fee for Employer: *') !!}
                           {!! Form::text('employee_fee', $user_profile->employee_fee, ['class' => 'form-control']) !!}
                        </div>
						
						{!! Form::submit('Save',['class' =>'btn btn-info pull-right margin-bottom-30']) !!}
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-6 col-xs-12">


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@stop
