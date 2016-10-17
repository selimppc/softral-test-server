@extends('laravel-authentication-acl::client.layouts.base')
@section('head_css')
{!! HTML::style('packages/jacopo/laravel-authentication-acl/css/strength.css') !!}
@stop
@section('title')
Softral - User SignUp
@stop

@section('content')
<div class="row content">

 @include('laravel-authentication-acl::client.layouts.sidebar')
               <div class="col-lg-9 content-right">
          <ol class="breadcrumb">
            <li><a href="{!! URL::to('/') !!}">Home</a></li>
            <li>{!! link_to_route('user.signup','Sign Up') !!}</li>
          </ol>
          <h2>Sign Up</h2>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent sit amet porta eros, eget facilisis arcu. Duis condimentum fermentum enim, ac rutrum erat venenatis vel. Morbi pharetra viverra faucibus.</p>
          <hr>
		   <?php $message = Session::get('message'); ?>
                @if( isset($message) )
                <div class="alert alert-success">{!! $message !!}</div>
                @endif
          <div class="row">
            <div class="col-lg-12">
              <div class="well">
                 {!! Form::open(["route" => 'user.signup.process', "method" => "POST", "id" => "user_signup"]) !!}
                    {{-- Field hidden to fix chrome and safari autocomplete bug --}}
                    {!! Form::password('__to_hide_password_autocomplete', ['class' => 'hidden']) !!}
                  <div class="form-group">
                    <div class="row">
                      <div class="col-xs-6 col-md-6">
                       {!! Form::text('first_name', '', ['id' => 'first_name', 'class' => 'form-control', 'placeholder' => 'First Name', 'required', 'autocomplete' => 'off']) !!}
                      </div>
					  <span class="text-danger">{!! $errors->first('first_name') !!}</span>
                      <div class="col-xs-6 col-md-6">
                          {!! Form::text('last_name', '', ['id' => 'last_name', 'class' => 'form-control', 'placeholder' => 'Last Name', 'required', 'autocomplete' => 'off']) !!}
                      </div>
					  <span class="text-danger">{!! $errors->first('last_name') !!}</span>
                    </div>
                  </div>
                  <div class="form-group">
                    {!! Form::email('email', '', ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email address', 'required', 'autocomplete' => 'off']) !!}
                  </div>
				   <span class="text-danger">{!! $errors->first('email') !!}</span>
                  <div class="form-group">
                   {!! Form::password('password', ['id' => 'password1', 'class' => 'form-control', 'placeholder' => 'Password', 'required', 'autocomplete' => 'off']) !!}
                  </div>
				   <span class="text-danger">{!! $errors->first('password') !!}</span>
                  <div class="form-group">
                     {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' =>'password2', 'placeholder' => 'Confirm password', 'required']) !!}
                  </div>
				   <div class="form-group">
				   <div class="row">
				   <div class="col-xs-6 col-md-6">
                     {!! Form::select('country', isset($countries)?$countries:array() ,null,['class' => 'form-control','id'=>'country','required']) !!}
					</div> 
					<div class="col-xs-6 col-md-6">
                     What you want to do? {!! Form::radio('custom_profile_1', 'Seller', true) !!} <strong>Sell</strong> {!! Form::radio('custom_profile_1', 'Buyer') !!} <strong>Buy</strong> {!! Form::radio('custom_profile_1', 'Both') !!} <strong>Both</strong>
					</div>
                  </div>
                  </div>
				    <div class="form-group">
					  <div id="pass-info"></div>
					  </div>
                  <button class="btn btn-lg btn-primary btn-block" type="submit">Sign up</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
 
  {{-- Js files --}}
  {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
  {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/password_strength/strength.js') !!}

  <script>
    $(document).ready(function() {
      //------------------------------------
      // password checking
      //------------------------------------
      var password1 		= $('#password1'); //id of first password field
      var password2		= $('#password2'); //id of second password field
      var passwordsInfo 	= $('#pass-info'); //id of indicator element

      passwordStrengthCheck(password1,password2,passwordsInfo);

      //------------------------------------
      // captcha regeneration
      //------------------------------------

      $("#captcha-gen-button").click(function(e){
      		e.preventDefault();

      		$.ajax({
              url: "/captcha-ajax",
              method: "POST",
              headers: { 'X-CSRF-Token' : '{!! csrf_token() !!}' }
            }).done(function(image) {
              $("#captcha-img-container").html(image);
            });
      	});
    });
  </script>
    @stop
