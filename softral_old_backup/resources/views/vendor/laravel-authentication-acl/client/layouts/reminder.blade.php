<h2>Password recovery</h2>
         
          <hr>
            @if($errors && ! $errors->isEmpty() )
            @foreach($errors->all() as $error)
            <div class="alert alert-danger" style='color:black;background-color:yellow'>{{$error}}</div>
            @endforeach
            @endif
             <div class="row">
            <div class="col-lg-12">
              <div class="well">
                {!! Form::open(array('url' => URL::route("user.reminder"), 'method' => 'post', 'class'=>'col-md-offset-4') ) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-7 col-md-7">
                        <div class="form-group">
                            
                            <div class="input-group" id="password-field">
                                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                                {!! Form::email('email', '', ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Your account email', 'required', 'autocomplete' => 'off']) !!}
                            </div>
                        </div>
                    </div>
                </div>
				<div class="form-group">
                    <div class="row">
                      <div class="col-xs-7 col-md-7">
                <input type="submit" value="Recover" class="btn btn-info btn-block">
				  </div>
                </div>
                </div>
                {!! Form::close() !!}
              <div class="form-group col-md-offset-4">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-12 margin-top-10">
                        <a href="{!! URL::route('user.login') !!}"><i class="fa fa-arrow-left"></i> Back to login</a>
                    </div>
                </div>
                </div>
            </div>
        </div>
  