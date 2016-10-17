 <h2>Sign Up</h2>
          <hr>
		  {!! HTML::style('http://morganthall.com/ujo/chosen-koenpunt/chosen.css') !!}
		  @if($errors->any())
			<div class="alert alert-danger" style='color:black;background-color:yellow'>
				@foreach($errors->all() as $error)
					<p>{{ $error }}</p>
				@endforeach
			</div>
		@endif
		   <?php $message = Session::get('message'); ?>
                @if( isset($message) )
                <div class="alert alert-success">{!! $message !!}</div>
                @endif
          <div class="row">
            <div class="col-lg-12">
              <div class="well">
			  <p class='required'> <font color='red'><i class="fa fa-asterisk"></i></font>&nbsp;&nbsp;&nbsp; required fields </p>
                 {!! Form::open(["route" => 'user.signup.process', "method" => "POST", "id" => "user_signup","enctype"=>"multipart/form-data"]) !!}
                    {{-- Field hidden to fix chrome and safari autocomplete bug --}}
                    {!! Form::password('__to_hide_password_autocomplete', ['class' => 'hidden']) !!}
                  <div class="form-group">
                    <div class="row">
                      <div class="col-xs-6 col-md-6 required">
                        <i class="fa fa-asterisk"></i> {!! Form::text('first_name', '', ['id' => 'first_name', 'class' => 'form-control', 'placeholder' => 'First Name', 'required', 'autocomplete' => 'off']) !!}
                      </div>
					 
                      <div class="col-xs-6 col-md-6 required">
					  <i class="fa fa-asterisk"></i> 
                          {!! Form::text('last_name', '', ['id' => 'last_name', 'class' => 'form-control', 'placeholder' => 'Last Name', 'required', 'autocomplete' => 'off']) !!}
                      </div>
					  
                    </div>
                  </div>
                  <div class="form-group">
				   <div class="row">
                      <div class="col-xs-6 col-md-6 required">
					  <i class="fa fa-asterisk"></i> 
                    {!! Form::email('email', '', ['id' => 'email', 'class' => 'form-control', 'placeholder' => 'Email address', 'required', 'autocomplete' => 'off']) !!}
					</div>
					
				  
					  <div class="col-xs-6 col-md-6 required">
					  <i class="fa fa-asterisk"></i> 
                  <div class="form-group">
                      <strong>Choose Profile Picture:</strong><span class='input_image'> {!! Form::file('image', ['id' =>'image']) !!}</span>
                  </div>
				  </div>
                  </div>
				  </div>
				  
				   <div class="row">
				   <div class="col-xs-6 col-md-6 required">
				   <i class="fa fa-asterisk"></i> 
                  <div class="form-group">
                   {!! Form::password('password', ['id' => 'password1', 'class' => 'form-control', 'placeholder' => 'Password', 'required', 'autocomplete' => 'off']) !!}
                  </div>
                  </div>
			
				  
				   <div class="col-xs-6 col-md-6">
				  
                  <div class="form-group">
                     {!! Form::password('password_confirmation', ['class' => 'form-control', 'id' =>'password2', 'placeholder' => 'Confirm password', 'required']) !!}
                  </div>
                  </div>
                  </div>
				  
                 <div class="row">
				   <div class="col-xs-6 col-md-6 ">
                     {!! Form::select('country', isset($countries)?$countries:array() ,'United States',['class' => 'form-control','id'=>'country','required']) !!}
					</div> 
				 
				
				   <div class="col-xs-2 col-md-2 ">
				     {!! Form::select('country_code', isset($countries)?$countries:array(),'United States',['class' => 'form-control','id'=>'country_code','required']) !!}
					 <input type='hidden' name='country_code_hidden' value='1' id='country_code_hidden' />
                    </div>
					
					  <div class="col-xs-4 col-md-4 required">
					  <i class="fa fa-asterisk"></i> 
                  <div class="form-group">
				  {!! Form::text('phone', '', ['id' => 'phone', 'class' => 'form-control', 'placeholder' => 'Mobile number', 'required', 'autocomplete' => 'off']) !!}
                  </div>
                  </div>
					
					</div>
					
				  
				   <div class="form-group">
				   <div class="row">
				 
					<div class="col-xs-6 col-md-6">
                     What you want to do? {!! Form::radio('custom_profile_1', 'Seller', true) !!} <strong>Freelancer (Find online job)</strong> {!! Form::radio('custom_profile_1', 'Buyer') !!} <strong>Employer (Hire Freelancers)</strong><!-- {!! Form::radio('custom_profile_1', 'Both') !!} <strong>Both</strong>-->
					</div>
					
				  	   <div id="textboxes">
					<div class="col-xs-6 col-md-6 required">
					<i class="fa fa-asterisk"></i> 
					<div class="form-group">
				   <strong>Please list your five best Skill:</strong>
                     {!! Form::select('skills[]', $skills,'skills',['id'=>'skills','required','multiple'=>true, 'hidden'=>true,'class'=>'form-control chzn-select','style'=>'width:100%','data-placeholder'=>'Select a skill']) !!}
					</div> 
					

					</div>
					
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
		  {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
		  	{!! HTML::script('http://morganthall.com/ujo/chosen-koenpunt/chosen.jquery.min.js') !!}
		  <script>			
							$(function() {
								 $(".chzn-select").chosen({
				create_option: true,
				persistent_create_option: true,
				create_option_text: 'add',
			});
						$('input[name="custom_profile_1"]').on('click', function() {
							if ($(this).val() == 'Seller') {
								$('#textboxes').show();
								$('#skills').prop('disabled',false);
								$("#skills option[value='no']").remove();
								$('#image').attr("name", 'image');
								$('.hidden_image').remove();
							}
							else {
								$('#textboxes').hide();
								$('#image').attr("name", 'image1');
								$('.input_image').append("<input type='hidden' class='hidden_image' name='image' value='1' />");
								$('#skills').append('<option value="no">-</option>');
								$('#skills').append('<option value="no">-</option>');
								$('#skills').append('<option value="no">-</option>');
								$('#skills').append('<option value="no">-</option>');
								$('#skills').append('<option value="no">-</option>');
								$('#skills').val('no');
							}
						});
						
						$('#country').on('change', function() {
							$('#country_code').val($(this).val());
							country_code=($('#country_code option:selected').text());
							$('#country_code_hidden').attr('value',country_code);
						});
						
						$('#country_code').on('change', function() {
							$('#country_code_hidden').attr('value',$('#country_code option:selected').text());
						});
					});
						
					</script>
					<style type="text/css">
.required i {position: absolute;left: 2px;top: 2px;color: #F44336;font-size:12px;}
.required { position: relative;}
.chzn-choices{
	    min-height:30px;
}
.default{
	    min-height:30px;
}
</style>