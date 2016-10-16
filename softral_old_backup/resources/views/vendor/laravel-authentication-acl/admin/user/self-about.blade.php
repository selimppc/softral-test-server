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
        @if( $errors->has('model') )
        <div class="alert alert-danger">{!! $errors->first('model') !!}</div>
        @endif
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> About me</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
				  {!! Form::model($user_profile,['route'=>'users.about.edit', 'method' => 'post','files'=>true]) !!}
					   
                    <div class="col-md-6 col-xs-12">
                     <input type='hidden' name='hidden_test' value="@if(isset($_GET['user_id'])){{ $_GET['user_id'] }} @endif" />
					     <div class="form-group">
                            {!! Form::label('custom_profile_4','Tagline: *') !!}
                           {!! Form::text('custom_profile_4', $tagline, ['class' => 'form-control','required'=>'true']) !!}
                        </div>
						
						 
                            <div class="form-group">			
	<table class="form-table customFields">
		<tr valign="top">
			<th scope="row"><label for="customFieldName">Projects</label></th>
				<td>
					@if($resume!='')
							<?php
							$input1=@unserialize($resume);
							?>	
							@if(is_array($input1) || is_object($input1))
								@foreach($input1 as $key => $value)
									<?php 
									list($key1, $value1) = each($input1[$key]);
									?>
							<div class="removeimagevalue">
									 <a href="{!! URL::route('users.postaboutDelete',['id' => $key, 'user_id'=>$user_profile->user_id, '_token' => csrf_token()]) !!}">
									 <div class="img-wrap">
										<span class="close">&times;</span></a>
											<img src="{!! URL::to('/') !!}/uploads/resume/{!! $key1 !!}" width='100px' height='77px' data-id="103"/>
								 {!! Form::hidden('resume_image[]', $key1, ['class' => 'form-control']) !!}	
								 {!! Form::hidden('resume_desc[]', $value1, ['class' => 'form-control']) !!}	
								 </div>	
									
										<p>{!! $value1 !!}</p>
							</div>
								@endforeach
						@endif	
						
						 @else
								<input type="file" class="form-control customFieldName display_image" name="resume[]" value="" placeholder="Project file"  />
								<img class="blah"/>
								<input type="text" class="code form-control" id="customFieldValue" name="project_desc[]" value="" placeholder="Description about project" style="width:110%" /> 
								
						@endif
		
			
		</td>
	</tr>
</table>
<a href="javascript:void(0);" class="addCF">Add</a>
</div>

						  
                        <!-- password text field -->
                        <div class="form-group">
                            {!! Form::label('custom_profile_2','About me: *') !!}
                           {!! Form::textarea('custom_profile_2', $about_me, ['class' => 'form-control','required'=>'true']) !!}
                        </div>
						
						<div class="form-group">
                            {!! Form::label('custom_profile_3', 'Select skill: *', ['class' => 'control-label']) !!}
			
							{!! Form::select('custom_profile_3[]', $skills, $skills_me, ['id' => 'skill_id','class'=>'chzn-select', 'multiple' => 'multiple','style'=>'width:100%','data-placeholder'=>'Select a skill','required'=>'true']) !!}
                        </div>
					
							{!! Form::hidden('user_id', $user_profile->user_id) !!}
							{!! Form::hidden('id', $user_profile->id) !!}
						
						
						{!! Form::submit('Save',['class' =>'btn btn-info pull-right margin-bottom-30']) !!}
                      
                    </div>
					  
                    <div class="col-md-6 col-xs-12">
					
									<div class="news-section">
						<label>Education*</label>
							<div class="row">
								<div class="col-xs-3">
									<label>Year*</label>
										<input type="text" name="education" value="@if(isset($education['year'])){{ $education['year'] }}@endif" class="form-control" placeholder="" required>
							</div>
							  <div class="col-xs-3">
								<label>College/Uni.*</label>
									<input type="text" name="college" class="form-control" value="@if(isset($education['college'])){{ $education['college'] }}@endif" placeholder="" required>
							  </div>
							<div class="col-xs-3">
								<label>Major*</label>
									<input type="text" name="major" class="form-control" value="@if(isset($education['major'])){{ $education['major'] }}@endif" placeholder="" required>
							</div>
							<div class="col-xs-3">
								<label>BA/BS*</label>
									<input type="text"  name="bs" class="form-control" value="@if(isset( $education['bs'])){{ $education['bs'] }}@endif" placeholder="" required>
							</div>
				  
				</div>

				<div class="row">
							<div class="col-xs-3">
								<label>Year*</label>
									<input type="text" name="yr" class="form-control" value="@if(isset( $education['yr'])){{ $education['yr'] }}@endif" placeholder="" required>
							</div>
							<div class="col-xs-3">
								<label>College/Uni.*</label>
									<input type="text" name="clg" class="form-control" value="@if(isset( $education['clg'])){{ $education['clg'] }}@endif" placeholder="" required>
							</div>
							<div class="col-xs-3">
								<label>Major*</label>
									<input type="text" name="ma" class="form-control"  value="@if(isset( $education['ma'])){{ $education['ma'] }}@endif" placeholder="" required>
							</div>
							<div class="col-xs-3">
								<label>MS/MA*</label>
									<input type="text" name="ms" class="form-control"  value="@if(isset( $education['ms'])){{ $education['ms'] }}@endif" placeholder="" required>
							</div>
				</div>

				<div class="row">
						<div class="col-xs-3">
							<label>Year*</label>
								<input type="text" name="years" class="form-control" value="@if(isset( $education['years'])){{ $education['years'] }}@endif" placeholder="" required>
						</div>
						<div class="col-xs-3">
							<label>College/Uni.*</label>
								<input type="text" name="uni" class="form-control" value="@if(isset( $education['uni'])){{ $education['uni'] }}@endif" placeholder="" required>
						</div>
						<div class="col-xs-3">
							<label>Major*</label>
								<input type="text" name="mr" class="form-control" value="@if(isset( $education['mr'])){{ $education['mr'] }}@endif" placeholder="" required>
						</div>
				<div class="col-xs-3">
						<label>Other*</label>
							<input type="text" name="ot" class="form-control" value="@if(isset( $education['ot'])){{ $education['ot'] }}@endif" placeholder="" required>
								</div>
							</div>
						</div>
						
					<?php /*<div class='row'>
					 <div class="col-md-6 col-lg-6 col-xs-6">
						 <div class="form-group">
                            {!! Form::label('custom_profile_5','Last college/Uni. Attended:') !!}
                           {!! Form::text('custom_profile_5', $last_college, ['class' => 'form-control','placeholder'=>'Last college/Uni. Attended']) !!}
                        </div>
					</div>
					
					<div class="col-md-6 col-lg-6 col-xs-6">
					 <div class="form-group">
                            {!! Form::label('custom_profile_10','Specify Your Degree:') !!}
                           {!! Form::text('custom_profile_10', $your_degree, ['class' => 'form-control','placeholder'=>'Your Degree']) !!}
                        </div>
					</div>
					</div>
						
						 <div class="form-group">
                            {!! Form::label('custom_profile_6','Date of graduation:') !!}
                           {!! Form::text('custom_profile_6', $date_of_graduation, ['class' => 'form-control','placeholder'=>'Date of graduation','id'=>'year_of_graduation','readonly']) !!}
                        </div> */ ?>
						<br/>
						 <div class="form-group">
                            {!! Form::label('custom_profile_7','Employment:') !!}<br>
                           <span style='float:left;width:5%;padding-top: 5px;'>1)</span> {!! Form::text('custom_profile_7[]', isset($employment[0])?$employment[0]:'', ['class' => 'form-control','style'=>'width:70%;display:inline;margin-bottom: 5px;','placeholder'=>'Employment 1']) !!}<br>
                           <span style='float:left;width:5%;padding-top: 5px;'>2)</span>  {!! Form::text('custom_profile_7[]', isset($employment[1])?$employment[1]:'', ['class' => 'form-control','style'=>'width:70%;display:inline;margin-bottom: 5px;','placeholder'=>'Employment 2']) !!}<br>
                            <span style='float:left;width:5%;padding-top: 5px;'>3)</span>  {!! Form::text('custom_profile_7[]', isset($employment[2])?$employment[2]:'', ['class' => 'form-control','style'=>'width:70%;display:inline;margin-bottom: 5px;','placeholder'=>'Employment 3']) !!}
                        </div>
						
						 <div class="form-group">
                            {!! Form::label('custom_profile_8','Rate your expertise:') !!}
                            <div class='starrr' id='star1'></div>
						   {!! Form::hidden('custom_profile_8', $rate_of_expertise, array('id'=>'ratings-hidden')) !!}
                        </div>
						
						 <div class="form-group">
                            {!! Form::label('custom_profile_9','Rate your experience with Softral:') !!}
                          <div class='starrr' id='star2'></div>
						   {!! Form::hidden('custom_profile_9', $rate_of_experience, array('id'=>'ratings-hidden1')) !!}
                        </div>
						
						

                    </div>
					{!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>

{!! HTML::style('css/starrr.css') !!}
{!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
<script>
$(document).ready(function(){
	 var next = 1;
    var next_image = 1;
	$(".addCF").click(function(){
		//alert('hii');
		 next = next + 1;
		
		
		next_image = next_image + 1;
		
		
		$(".customFields").append('<tr valign="top"><th scope="row"></th><td><input class="form-control customFieldName display_image"  type="file" id="image'+next_image+ '" name="resume[]" value="" placeholder="Input Name" /> &nbsp;  <img class="blah" id="'+next_image+ '"/><div class="removeimage"> <input type="text" class="form-control" id="customFieldValue" name="project_desc[]" value="" placeholder="Input Value" /> &nbsp;<a href="javascript:void(0);" class="remCF">Remove</a></div></td></tr>');
		next_image++;
	});
    $(".customFields").on('click','.remCF',function(){
        $(this).parent().parent().remove();
    });
	
});
</script>
<style>
  article, aside, figure, footer, header, hgroup, 
  menu, nav, section { display: block; }
</style>
<script>

 function readURL(input,id) {
	
            if (input.files && input.files[0]) {
                var reader = new FileReader();
				id1 = id.replace('image','');
                reader.onload = function (e) {
                    $('#'+id1)
                        .attr('src', e.target.result)
                        .width(150)
                        .height(200);
                };

                reader.readAsDataURL(input.files[0]);
            }
        }
		

$(document).ready(function(){
$(document).on('change', '.display_image', function() {
	id=($(this).attr('id'));
    readURL(this,id);
});
});
</script>

<script>
	$('.img-wrap .close').on('click', function() {
		var id = $(this).closest('.img-wrap').find('img').data('id');
		confirm('Do you want to delete this project?');
	});
</script>	
<style>
	.img-wrap {
		position: relative;
		display: inline-block;
		border: 1px red solid;
		font-size: 0;
	}
	.img-wrap .close {
		position: absolute;
		top: 2px;
		right: 2px;
		z-index: 100;
		background-color: #FFF;
		padding: 5px 2px 2px;
		color: #000;
		font-weight: bold;
		cursor: pointer;
		opacity: .2;
		text-align: center;
		font-size: 22px;
		line-height: 10px;
		border-radius: 50%;
	}
	.img-wrap:hover .close {
		opacity: 1;
	}
</style>
		 	{!! HTML::Style('css/jquery-ui.css') !!}
			{!! HTML::script('js/starrr.js') !!}
 <script type='text/javascript'>
    var $s2input = $('#ratings-hidden');
    $('#star1').starrr({
      max: 5,
      rating: $s2input.val(),
      change: function(e, value){
        $s2input.val(value).trigger('input');
      }
    });
	
	  var $s2input1 = $('#ratings-hidden1');
    $('#star2').starrr({
      max: 5,
      rating: $s2input1.val(),
      change: function(e, value){
        $s2input1.val(value).trigger('input');
      }
    });
	
	$(function () {
		
				$('#year_of_graduation').datepicker({
				dateFormat: 'yy-mm-dd',
				 changeMonth: false,
				 changeYear: true
			});
            });
			
  </script>
  
@stop
