<div class="modal fade bs-example-modal-sm" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content padding-3-3-prcnt bg_trans_white_90" style="margin-top: 35%;">
            <div class="modal-header no-border text-center uppercase">

                <div class="text-center"><img src="{{asset('assets/images/logo-1.png')}}" width="170"></div>
            </div>
            <div class="modal-body moskNormal400">
               {!! Form::open(array('url' => URL::route("user.login"), 'method' => 'post') ) !!}

                    <div class="form-group">

						 {!! Form::email('email', '', ['id' => 'user_name', 'class' => 'form-control width_full padding-10-7 black inpt_border', 'placeholder' => 'Email address', 'required', 'autocomplete' => 'off', 'style' => 'background: #ffffff !important; margin-bottom: 3px;']) !!}

						{!! Form::password('password', ['class' => 'form-control width_full padding-10-7 black inpt_border', 'placeholder' => 'Password', 'required' => 'required', 'autocomplete' => 'off']) !!}

                    </div>
                    <div class="form-group">
                        <div class="checkbox pull-left">
                            <label>
								{!! Form::checkbox('remember','',['id' => "remember", 'class' => 'black','checked'=>'checked']) !!}
							Remember me</label>
                        </div>
                        <button type="submit"  class="btn btn-danger padding-10-10 btn-block">Login</button>
                        <p class="text-center no-margin margin_top_15 size-12">
						{!! link_to_route('user.recovery-password','Having trouble logging in?') !!}
						<br>
						Not a member?
						<a href="{!! URL::route('user.signup') !!}">Join now</a></p>
                    </div>
                {!! Form::close() !!}
            </div>

        </div>
    </div>
</div>
