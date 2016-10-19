<header>
    <section style="margin-bottom:-20px;">
        <section class="wrap">
            <div class="container-fluid">
                <div class="col-md-3">
                    <div class="h_left">
                        <!--<div class="logo text-center">Softral<sub>TM</sub></div>-->
                        <div class="logo text-center">
                            <a href="{{ URL::to('/')}}"><img src="{{asset('assets/images/logo-1.png')}}" class="img-responsive"></a>
                        </div>
                    </div>
                </div>
                <div class="col-md-9 text-center">
                    <div class="h_right">
                        <div class="src_form">
                            <form class="form-inline">
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputEmail3">Search Text</label>
                                    <input type="text" class="form-control" id="exampleInputEmail3" placeholder="Search">
                                </div>
                                <div class="form-group">
                                    <label class="sr-only" for="exampleInputPassword3">Category</label>
                                    <select class="form-control">
                                        <option>Type one</option>
                                        <option>Type Two</option>
                                        <option>Type Three</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-default sbmt"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="clr">&nbsp;</div>

        <!--=== Navigation Bar ===-->
        <div class="h_full bg_black">
            <section class="wrap">
                <nav class="navbar navbar-inverse">
                    <div class="container-fluid bg_black">
                        <!-- Brand and toggle get grouped for better mobile display -->
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                            <ul class="nav navbar-nav size-13">
                                <li @if('http://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']==url('/')) class="active" @endif><a href="{!! URL::to('/') !!}">Home</a></li>
								
								<li @if('http://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']==url('pages/about-us')) class="active" @endif><a href="{!! URL::to('/').'/pages/about-us' !!}">About Us</a></li>
                               
                                <li class="dropdown @if('http://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']==url('add-job') || ('http://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']==url('shome'))) active @endif ">
								  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Jobs<span class="caret"></span>
								  </a>
								  <ul class="dropdown-menu">
								   @if(!isset($logged_user) || (isset($logged_user->user_profile[0]->profile_field_type->value) && ($logged_user->user_profile[0]->profile_field_type->value=='Buyer' || $logged_user->user_profile[0]->profile_field_type->value=='Both')))											
										<li>{!! link_to_route('job.addJob','Post a Job') !!}</li>
									@endif
								   <li><a href="{!! URL::to('/').'/shome' !!}">Search for Job</a></li>
								  </ul>
								</li>
							
                               <li><a href="{!! URL::to('/').'/chat/index.php' !!}">Chat</a></li>
							   
							   <li @if('http://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']==url('all-members')) class="active" @endif>{!! link_to_route('user.members','Members') !!}</li>
							
							   <li @if('http://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']==url('pages/rules-conditions')) class="active" @endif><a href="{!! URL::to('/').'/pages/rules-conditions' !!}">Terms & Conditions</a></li>
							   
							   <li @if('http://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']==url('pages/privacy-policy')) class="active" @endif><a href="{!! URL::to('/').'/pages/privacy-policy' !!}">Privacy Policy</a></li>
							   
								<li @if('http://' . $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']==url('pages/contact-us')) class="active" @endif><a href="{!! URL::to('/').'/pages/contact-us' !!}">Contact us</a></li>


                            </ul>
                            <ul class="nav navbar-nav navbar-right size-13">
                                <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">My Softral<span class="caret"></span></a>
                                    <ul class="dropdown-menu">
										<li>{!! link_to_route('users.selfprofile.edit','My Profile') !!}</li>
										
										@if(isset($logged_user)) 
											<li><a href="{!! URL::to('/').'/user/profile/'.$logged_user->user_profile[0]->slug !!}">View Profile</a></li>
										@endif
										
										@if(!isset($logged_user) || (isset($logged_user->user_profile[0]->profile_field_type->value) && ($logged_user->user_profile[0]->profile_field_type->value=='Seller' || $logged_user->user_profile[0]->profile_field_type->value=='Both')))
										   <li>{!! link_to_route('job.myProposals','My Proposals') !!}</li>
									    @endif
										
										@if(!isset($logged_user) || (isset($logged_user->user_profile[0]->profile_field_type->value) && ($logged_user->user_profile[0]->profile_field_type->value=='Seller' || $logged_user->user_profile[0]->profile_field_type->value=='Both')))
										   <li>{!! link_to_route('welcome.saveJobs','Save Jobs') !!}</li> 
										   <li>{!! link_to_route('welcome.runningJobs','Working Jobs') !!}</li> 
									    @endif
										
										<li>{!! link_to_route('welcome.saveUsers','Save Users') !!}</li>

										@if(!isset($logged_user) || (isset($logged_user->user_profile[0]->profile_field_type->value) && ($logged_user->user_profile[0]->profile_field_type->value=='Buyer' || $logged_user->user_profile[0]->profile_field_type->value=='Both')))
										   <li>{!! link_to_route('welcome.myJobs','My Jobs') !!}</li> 
										   <li>{!! link_to_route('welcome.myContracts','Escrow Contracts') !!}</li> 
										   <li>{!! link_to_route('welcome.user_Agreement','User Agreements') !!}</li> 
									    @endif										
                                        
                                        <li>{!! link_to_route('financial','My Financial Accounts') !!}</li> 
                                        
										@if(!isset($logged_user) || (isset($logged_user->user_profile[0]->profile_field_type->value) && ($logged_user->user_profile[0]->profile_field_type->value=='Buyer' || $logged_user->user_profile[0]->profile_field_type->value=='Both')))
											<!--<li>{!! link_to_route('ad.myAds','My Classifieds') !!}</li> -->
										  @endif
										<li>{!! link_to_route('job.myWorkboard','My Workboard') !!}</li>
										<li>{!! link_to_route('CustomerService','Customer Service') !!}</li>		  

                                    </ul>
                                </li>
                                <!--<li><a href="#"><span class=""></span> My Softral</a></li>-->
                                <li><a href="#" class="sign" data-toggle="modal" data-target="#loginModal">Login</a></li>
                                <li><a href="#" class="sign_1" data-toggle="modal" data-target="#signupModal">Sign Up</a></li>
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </nav>
            </section>
        </div>
    </section>
</header>

<?php $message = Session::get('message'); ?>
	@if( isset($message) )
	<div class="alert alert-success">{!! $message !!}</div>
	@endif
	@if($errors && ! $errors->isEmpty() )
	@foreach($errors->all() as $error)
	<div class="alert alert-danger" style='color:black;background-color:yellow'>{!! $error !!}</div>
	@endforeach
	@endif

<!--=== Modal Login Start =======================-->
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
<!--=== Modal Signup Start (Step-1)=======================-->

<div class="modal fade bs-example-modal-md" id="signupModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-md" role="document">
        <div class="modal-content bg_trans_white_90" style="margin-top: 5%;">

            <div class="modal-body moskNormal400">
                <div class="col-md-12 no-padding">
                    <div class="col-md-6 text-left"><img src="{{asset('assets/images/logo-1.png')}}" width="170"></div>
                    <div class="col-md-6 text-right lowercase">Already have an account? <button type="submit" class="sign" data-dismiss="modal" data-toggle="modal"  data-target="#loginModal">Login</button></div>
                </div>
                <div class="col-md-12"><div class="border_bottom">&nbsp;</div></div>
                <div class="col-md-12 text-center" style="padding: 2% 0 2% 0 !important;">
                    <h1 class="size-18 line-h-26 tahomabd">Welcome!<br> First, tell us what you're looking for.</h1>
                    <div class="text-center">
                        <img src="{{asset('assets/images/signup-pointer-image.png')}}" class="text-center">
                    </div>
                </div>
                <div class="col-md-12">


                    <div class="col-md-5 col-sm-5 col-lg-5 text-center">
                        <div class="type_box_circle pull-right" data-dismiss="modal" data-toggle="modal"  data-target="#sellerModal">
                            <div class="white type_box_inner">
                                <div class="text-center"><img src="{{asset('assets/images/freelancer-1.png')}}" width="45"></div>
                                <h2 class="size-26">Freelancer</h2>
                                <p class="size-12">Find Freelance projects and grow your business</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2 col-sm-2 col-lg-2 text-center relative">
                        <svg height="200" width="100%" >
                            <line x1="50%" y1="0" x2="50%" y2="100%" style="stroke:rgb(80,80,80);stroke-width:1" />
                            <line x1="45%" y1="20%" x2="45%" y2="80%" style="stroke:rgb(80,80,80);stroke-width:1" />
                            <line x1="55%" y1="20%" x2="55%" y2="80%" style="stroke:rgb(80,80,80);stroke-width:1" />
                        </svg>
                    </div>
                    <div class="col-md-5 col-sm-5 col-lg-5 text-center">
                        <div class="type_box_circle pull-left" data-dismiss="modal" data-toggle="modal"  data-target="#buyerModal">
                            <div class="white type_box_inner">
                                <div class="text-center"><img src="{{asset('assets/images/employer-1.png')}}" width="45"></div>
                                <h2 class="size-26">Employer</h2>
                                <p class="size-12">Find, Collaborate with, and pay an expert</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="clearfix"></div>
            <div class="modal-footer no-border">

            </div>
        </div>
    </div>
</div>

<!--===== Modal Freelancer Form start ( Step-2.1)==================-->

<div class="modal fade bs-example-modal-lg" id="sellerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content padding-3-3-prcnt bg_green_super_light margin_top_10_prcnt">

            <div class="modal-body moskNormal400">
                <div class="col-md-12 padding-0-0-5-0">

                    <div class="text-center size-25 green_blackish">&blk14; Create a <strong>Freelancer</strong> Account</div>
                </div>
                <div class="col-md-12"><div class="">&nbsp;</div></div>

                <div class="col-md-12">
                    {!! Form::open(["route" => 'user.signup.process', "method" => "POST", "id" => "user_signup","enctype"=>"multipart/form-data"]) !!}

						{{-- Field hidden to fix chrome and safari autocomplete bug --}}
						{!! Form::password('__to_hide_password_autocomplete', ['class' => 'hidden']) !!}
                        <div class="col-md-6">
                            <div class="form-group">
								{!! Form::text('first_name', '', ['id' => 'first_name', 'class' => 'form-control green_light_border', 'placeholder' => 'First Name', 'required', 'autocomplete' => 'off']) !!}

                            </div>
                            <div class="form-group">
								{!! Form::email('email', '', ['id' => 'email', 'class' => 'form-control green_light_border', 'placeholder' => 'Email', 'required', 'autocomplete' => 'off']) !!}

                            </div>

							<div class="form-group">
								{!! Form::password('password', ['id' => 'password1', 'class' => 'form-control green_light_border', 'placeholder' => 'Password', 'required', 'autocomplete' => 'off']) !!}
							</div>

							<div class="form-group">
								{!! Form::select('country_code', isset($countries)?$countries:array(),'United States',['class' => 'form-control green_light_border','id'=>'country_code','required','data-placeholder'=>'Select a country']) !!}
								<input type='hidden' name='country_code_hidden' value='1' id='country_code_hidden' />

                            </div>

							<div class="form-group">

								{!! Form::select('skills[]', $skills,'skills',['id'=>'skills','required','multiple'=>true, 'hidden'=>true,'class'=>'form-control green_light_border chzn-select','style'=>'width:100%','data-placeholder'=>'Select a skill']) !!}

							</div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
								{!! Form::text('last_name', '', ['id' => 'last_name', 'class' => 'form-control green_light_border', 'placeholder' => 'Last Name', 'required', 'autocomplete' => 'off']) !!}

                            </div>

							<div class="form-group">
							  <strong>Choose Profile Picture:</strong><span class='input_image'> {!! Form::file('image', ['id' =>'image']) !!}</span>
						  </div>

						   <div class="form-group">
							 {!! Form::password('password_confirmation', ['class' => 'form-control green_light_border', 'id' =>'password2', 'placeholder' => 'Confirm password', 'required']) !!}
						  </div>

                           <div class="form-group">
							{!! Form::text('phone', '', ['id' => 'phone', 'class' => 'form-control green_light_border', 'placeholder' => 'Mobile number', 'required', 'autocomplete' => 'off']) !!}
						  </div>

						  {!! Form::hidden('custom_profile_1', 'Seller', array('id' => 'invisible_id')) !!}

                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label class="green_blackish">
                                    <input type="checkbox" checked > Yes, I understand and agree to the Softral Terms of Service.
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal" data-target="#signupModal">&lAarr; Back</button>
                            <button type="submit" class="btn btn-success">&check; Create</button>
                        </div>
                    </form>
                </div>
                <!--</div>-->
            </div>
            <div class="clearfix"></div>
            <div class="modal-footer no-border">&nbsp;</div>
        </div>
    </div>
</div>


<!--===== Modal Employer Form start (step-2.2)==================-->
<div class="modal fade bs-example-modal-lg" id="buyerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content padding-3-3-prcnt bg_white margin_top_10_prcnt">

            <div class="modal-body moskNormal400">
                <div class="col-md-12 padding-0-0-5-0">

                    <div class="text-center size-25">&blk14; Create a <strong>Employer</strong> Account</div>
                </div>
                <div class="col-md-12"><div class="">&nbsp;</div></div>

                <div class="col-md-12">
                    {!! Form::open(["route" => 'user.signup.process', "method" => "POST", "id" => "user_signup","enctype"=>"multipart/form-data"]) !!}
                        <div class="col-md-6">
                            <div class="form-group">
								{!! Form::text('first_name', '', ['id' => 'first_name', 'class' => 'form-control green_light_border', 'placeholder' => 'First Name', 'required', 'autocomplete' => 'off']) !!}

                            </div>
                            <div class="form-group">
								{!! Form::email('email', '', ['id' => 'email', 'class' => 'form-control green_light_border', 'placeholder' => 'Email', 'required', 'autocomplete' => 'off']) !!}

                            </div>

							<div class="form-group">
								{!! Form::password('password', ['id' => 'password1', 'class' => 'form-control green_light_border', 'placeholder' => 'Password', 'required', 'autocomplete' => 'off']) !!}
							</div>

							<div class="form-group">
								{!! Form::select('country_code', isset($countries)?$countries:array(),'United States',['class' => 'form-control green_light_border','id'=>'country_code','required','data-placeholder'=>'Select a country']) !!}
								<input type='hidden' name='country_code_hidden' value='1' id='country_code_hidden' />

                            </div>

							<div class="form-group">

								{!! Form::select('skills[]', isset($skills)?$skills:null,'skills',['id'=>'skills','required','multiple'=>true, 'hidden'=>true,'class'=>'form-control green_light_border chzn-select','style'=>'width:100%','data-placeholder'=>'Select a skill']) !!}

							</div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
								{!! Form::text('last_name', '', ['id' => 'last_name', 'class' => 'form-control green_light_border', 'placeholder' => 'Last Name', 'required', 'autocomplete' => 'off']) !!}

                            </div>

							<div class="form-group">
							  <strong>Choose Profile Picture:</strong><span class='input_image'> {!! Form::file('image', ['id' =>'image']) !!}</span>
						  </div>

						   <div class="form-group">
							 {!! Form::password('password_confirmation', ['class' => 'form-control green_light_border', 'id' =>'password2', 'placeholder' => 'Confirm password', 'required']) !!}
						  </div>

                           <div class="form-group">
							{!! Form::text('phone', '', ['id' => 'phone', 'class' => 'form-control green_light_border', 'placeholder' => 'Mobile number', 'required', 'autocomplete' => 'off']) !!}
						  </div>

						  {!! Form::hidden('custom_profile_1', 'Buyer', array('id' => 'invisible_id')) !!}  
                        </div>
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" checked > Yes, I understand and agree to the Softral Terms of Service.
                                </label>
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <button type="button" class="btn btn-default" data-dismiss="modal" data-toggle="modal" data-target="#signupModal">&lAarr; Back</button>
                            <button type="submit" class="btn btn-danger">&check; Create</button>
                        </div>
                    </form>
                </div>
                <!--</div>-->
            </div>
            <div class="clearfix"></div>
            <div class="modal-footer no-border">&nbsp;</div>
        </div>
    </div>
</div>

<!--=== Modal Js ===-->
<script>
    $('#loginModal').on('shown.bs.modal', function () {
        $('#user_name').focus();
    })
    $('#signupModal').on('shown.bs.modal', function () {
        $('#user_name').focus();
    })

</script>

{!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
		 <script>
        $(".delete").click(function(){
            return confirm("Are you sure to delete this item?");
        });

		 $(function() {
        $(".image_edit_delete").click(function(){
			var id=$(this).attr('id');
			$('.'+id).remove();
		});

		$(".job_type").click(function(){
			var val=$(this).val();
			if(val=='fixed'){
				$('.hourly').hide();
				$('#budget').attr('placehoder','Enter your amount');
			}
			else{
				$('.hourly').show();
				$('#budget').attr('placeholder','Amount/Hour');
			}
		});

		  $('[data-toggle="tooltip"]').tooltip();

    $(".btn-primary").click(function(e) {
        if ( $(this).hasClass("disabled"))
        {
            return false;
        }
    });
        });

    </script>
