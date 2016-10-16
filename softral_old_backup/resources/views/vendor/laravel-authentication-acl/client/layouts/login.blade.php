<h2>Log In</h2>
 <hr>
	  <?php $message = Session::get('message'); ?>
            @if( isset($message) )
            <div class="alert alert-success">{!! $message !!}</div>
            @endif
            @if($errors && ! $errors->isEmpty() )
            @foreach($errors->all() as $error)
            <div class="alert alert-danger" style='color:black;background-color:yellow'>{!! $error !!}</div>
            @endforeach
            @endif
	  <div class="row">
            <div class="col-lg-12">
              <div class="well">
                {!! Form::open(array('url' => URL::route("user.login"), 'method' => 'post', 'class'=>'col-md-offset-4') ) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-7 col-md-7">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                {!! Form::email('email', '', ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email address', 'required', 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                    </div>
                    </div>
               
               <div class="row">
                    <div class="col-xs-12 col-sm-7 col-md-7">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                {!! Form::password('password', ['id' => 'password', 'class' => 'form-control', 'placeholder' => 'Password', 'required', 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                    </div>
                    </div>
              {!! Form::checkbox('remember')!!}
                {!! Form::label('remember','Remember me') !!}
                
				<div class="form-group">
                    <div class="row">
                      <div class="col-xs-7 col-md-7">
                <input type="submit" value="Login" class="btn btn-info btn-block" />
				   </div>
                        </div>
                    </div>
                {!! Form::close() !!}
				 <div class="form-group col-md-offset-4">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 margin-top-10">
        {!! link_to_route('user.recovery-password','Forgot password?') !!}
        or <a href="{!! URL::route('user.signup') !!}"><i class="fa fa-sign-in"></i> Signup here</a>
            </div>
            </div>
        </div>
            </div>
        </div>
    </div>
	<!-- Login finished -->