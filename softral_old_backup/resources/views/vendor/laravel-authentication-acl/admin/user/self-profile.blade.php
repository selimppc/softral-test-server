@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Admin area: Edit user profile
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        {{-- success message --}}
        <?php $message = Session::get('message'); ?>
        @if( isset($message) )
        <div class="alert alert-success">{!! $message !!}</div>
        @endif
        @if( $errors->has('model') )
        <div class="alert alert-danger">{!! $errors->first('model') !!}</div>
        @endif
		
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> User profile</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-6 col-xs-12">
                        @if(! $use_gravatar)
                            @include('laravel-authentication-acl::admin.user.partials.avatar_upload')
                        @else
                            @include('laravel-authentication-acl::admin.user.partials.show_gravatar')
                        @endif
						
						
                        <h4><i class="fa fa-cubes"></i> User data</h4>

                        {!! Form::model($user_profile,['route'=>'users.profile.edit', 'method' => 'post']) !!}
						<div class="form-group">
						<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Change password</button>
					</div>
					
					<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change the password</h4>
      </div>
      <div class="modal-body">
       
						  <div class="form-group">
                            {!! Form::label('password','Old password:') !!}
                            {!! Form::password('old_password', ['class' => 'form-control','required'=>'','id'=>'old_password']) !!}
                        </div>
                        <!-- password text field -->
                        <div class="form-group">
                            {!! Form::label('password','New password:') !!}
                            {!! Form::password('password', ['class' => 'form-control','required'=>'','id'=>'password']) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('password') !!}</span>
                        <!-- password_confirmation text field -->
                        <div class="form-group">
                            {!! Form::label('password_confirmation','Confirm password:') !!}
                            {!! Form::password('password_confirmation', ['class' => 'form-control','required'=>'','id'=>'password_confirmation']) !!}
                        </div>
      </div>
      <div class="modal-footer">
	   
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>&nbsp;&nbsp;{!! Form::submit('Save',['class' =>'btn btn-info pull-right margin-bottom-30','id'=>"submit1"]) !!}
      </div>
    </div>

  </div>
</div>

                        <!-- code text field -->
                        <div class="form-group">
                            {!! Form::label('code','Account number:') !!} : <font color='red'>#{!! $logged_user->id !!}</font>
                           
                        </div>
                       
                        <!-- first_name text field -->
                        <div class="form-group">
                            {!! Form::label('first_name','First name:') !!}
                            {!! Form::text('first_name', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('first_name') !!}</span>
                        <!-- last_name text field -->
                        <div class="form-group">
                            {!! Form::label('last_name','Last name: ') !!}
                            {!! Form::text('last_name', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('last_name') !!}</span>
                        <!-- phone text field -->
                        <div class="form-group">
                            {!! Form::label('phone','Phone: ') !!}
                            {!! Form::text('phone', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('phone') !!}</span>
						
						 <div class="form-group">
                            {!! Form::label('address','Address: ') !!}
                            {!! Form::text('address', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('address') !!}</span>
                        <!-- state text field -->
                        <div class="form-group">
                            {!! Form::label('state','State: ') !!}
                            {!! Form::text('state', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('state') !!}</span>
                        <!-- var text field -->
                       <!-- <div class="form-group">
                            {!! Form::label('var','Vat: ') !!}
                            {!! Form::text('var', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('vat') !!}</span>-->
                        <!-- city text field -->
                        <div class="form-group">
                            {!! Form::label('city','City: ') !!}
                            {!! Form::text('city', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('city') !!}</span>
                        <!-- country text field -->
                        <div class="form-group">
                            {!! Form::label('country','Country: ') !!}
                            {!! Form::text('country', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('country') !!}</span>
                        <!-- zip text field -->
                        <div class="form-group">
                            {!! Form::label('zip','Zip: ') !!}
                            {!! Form::text('zip', null, ['class' => 'form-control', 'placeholder' => '']) !!}
                        </div>
                        <span class="text-danger">{!! $errors->first('zip') !!}</span>
                        <!-- address text field -->
                       
                        {{-- custom profile fields --}}
                        @foreach($custom_profile->getAllTypesWithValues() as $profile_data)
							@if($profile_data->id!='2' && $profile_data->id!='3' && $profile_data->id!='1' && $profile_data->id!='4' && $profile_data->id!='5' && $profile_data->id!='6' && $profile_data->id!='7' && $profile_data->id!='8' && $profile_data->id!='9')
                        <div class="form-group">
                            {!! Form::label($profile_data->description) !!}
                            {!! Form::text("custom_profile_{$profile_data->id}", $profile_data->value, ["class" => "form-control"]) !!}
                            {{-- delete field --}}
                        </div>
							@endif
                        @endforeach

                        {!! Form::hidden('user_id', $user_profile->user_id) !!}
                        {!! Form::hidden('id', $user_profile->id) !!}
                        {!! Form::submit('Save',['class' =>'btn btn-info pull-right margin-bottom-30','id'=>"submit"]) !!}
                        {!! Form::close() !!}
                    </div>
                    <div class="col-md-6 col-xs-12">

                        @if($can_add_fields)
                        @include('laravel-authentication-acl::admin.user.custom-profile')
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
<script type='text/javascript'>
	$(function () {
				$("#submit").click(function() {
					$('#old_password').attr('disabled',true);
					$('#password').attr('disabled',true);
					$('#password_confirmation').attr('disabled',true);
				});
				
				$("#submit1").click(function() {
					$('#old_password').attr('disabled',false);
					$('#password').attr('disabled',false);
					$('#password_confirmation').attr('disabled',false);
				});
            });
			
  </script>
@stop
