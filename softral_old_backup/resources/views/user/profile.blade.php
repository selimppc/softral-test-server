@extends('laravel-authentication-acl::client.layouts.base')

@section('title')

Softral - My Profile

@stop

@section('content')

<div class="panel panel-default">

			<div class="panel-body">

			 <div class="alert alert-success jave_job_success" style='display:none'></div>

			<section style="padding-bottom: 50px; padding-top: 50px;">

            <div class="row">

                <div class="col-md-4">

					 @if(!$profile->avatar)

                           <span style="" class="glyphicon glyphicon-user profile_noimage"></span>

                        @else

                           <img src="data:image/jpeg;base64,{!! ( $profile->avatar) !!}" class="img-rounded img-responsive" width='200px' style='border-radius:177px;margin-left: 52px;'>

                        @endif

                    <br>
                    <br>
					@if($feedback_freelancer!=0)
						<div style='text-align:center' class='alert alert-success'><h4>Freelancer score</h4><font color='green'><strong>{{ round($feedback_freelancer,2)}} out of 5</strong></font></div>
					@endif
				    @if($feedback_employee!=0)
						 <br>
						<div style='text-align:center' class='alert alert-success'><h4>Employer score</h4><font color='green'><strong>{{$feedback_employee}} out of 5</strong></font></div>
					@endif
                    

                </div>

                <div class="col-md-8">
                   

					 <?php $about_me = 'Nothing Specified Yet'; ?>

				  <?php $skills='No skills selected'; ?>

                    <div class="alert alert-info" style='padding-top: 2px;'>
					
				
                         <h2>{!! $profile->first_name!!} {!!$profile->last_name!!} @if($tagline!='')- <font size='3px'>{{$tagline}} @endif
						  @if($profile->user_id!=$user['id'])
							 {!! Form::open(array('route' => 'user.sendMessage', 'class' => 'form_milestone', 'method' => 'post','target'=>'_blank','style'=>'display:inline')) !!}
								<input type='hidden' name='user_id' value='{{$profile->user_id}}' />
								<input type='submit' value='Send a message' class='btn btn-primary' style='float:right'/>
							</form>
							@endif
							 </h2>
						 @if(empty($save_user))
							@if($profile->user_id!=$user['id'])<a style="float:right;" href='javascript:void(0)' value="{{$profile->user_id}}" class='btn btn-success' id="set_fav">Set as a favorite</a>@endif
						 @else
							<a style="float:right;" href="javascript:void(0)" value="13" class="btn btn-success" id=""><span class="glyphicon glyphicon-heart"></span> User saved</a>
						 @endif
						
                            <p><span class="glyphicon glyphicon-map-marker"></span> 														@if($profile->city!=null){!! $profile->city.',' !!}@endif
							@if($profile->state!=null){!! $profile->state.',' !!}@endif
							{!! $profile->country !!}</p>

                            <p><strong>Skills: </strong>
                                @foreach($profile->profile_field as $profile_field)
									@if( $profile_field->profile_field_type_id==3)
										<?php $skills = $profile_field->modified_value;		
										?>
											<?php break; ?>
									@else
										<?php $skills = 'No skills selected'; ?>
									@endif
									 @endforeach
									 {!!$skills!!}
                            </p>

							
                    </div>
					
				

				
                   <div class="form-group col-md-8 news-section">      
					@foreach($profile->profile_field as $profile_field)
					@if( $profile_field->profile_field_type_id==2)
						<?php $about_me = $profile_field->value; ?>
					 
					 <div class="sponser_logo_title">  
					<h4 style="text-transform:uppercase;">About me</h4>
					</div>
							<?php //break; ?>
						 {!!$about_me!!}<hr>
					@else
						<?php $about_me = 'Nothing Specified Yet'; ?>
					@endif
			
				
					@if( $profile_field->profile_field_type_id==7)
						<?php $Employment = $profile_field->value; 
								$emp=0;
					?>
					<?php $Employment=unserialize($Employment);?>
						@if(!empty($Employment))
							 <p><strong>Employment : </strong>
							<?php if(!empty($Employment)): ?>
								<ul>
									<?php for($i=0;$i<count($Employment);$i++):
										if($Employment[$i]!=''): $emp=1;
									?>
										<li><?php echo $Employment[$i];?></li>
									<?php endif;endfor; ?>
									
									@if($emp==0) No Detail Found @endif
										
								</ul>
							<?php endif; ?>
							</p><hr>
						@endif
							<?php //break; ?>
					@endif
					
					@if( $profile_field->profile_field_type_id==8 && $profile_field->value!='')
						<?php $rate_of_expert = $profile_field->value; ?>
							  <p><strong>Rate your expertise : </strong>
							@for($j=0;$j<$rate_of_expert;$j++)
								<span class="glyphicon glyphicon-star" style='color:gold'></span>
							@endfor	
							</p><hr>
							<?php //break; ?>
					@endif
					
					@if( $profile_field->profile_field_type_id==9 && $profile_field->value!='')
						<?php $rate_of_experience = $profile_field->value; ?>
							  <p><strong>Rate your experience with Softral : </strong>
							@for($j=0;$j<$rate_of_experience;$j++)
								<span class="glyphicon glyphicon-star" style='color:gold'></span>
							@endfor
							</p><hr>
							
					@endif
				  @endforeach
        
						
							@if(isset($education->value) && $education->value!='')
								<?php $education = @unserialize($education->value); 
									if ($education !== false) :
							?>
					<p>	
<div class='news-section'>					
                     <div class="sponser_logo_title">
                         <h4 style="text-transform:uppercase;">Education</h4>
                        </div>
      
                        <table class="bio_data">
                         <tbody>
                             <th><label>Year</label></th>
                                <th><label>College/Uni.</label></th>
                                <th><label>Major</label></th>
                                <th><label>BA/BS</label></th>
                                <th><label>MS/MA</label></th>
                                <th><label>Other</label></th>
                            </tbody>
                            <tr>
                             <td><span>@if(isset($education['year'])){{ $education['year'] }}@endif</span></td>
                                <td><span>@if(isset($education['college'])){{ $education['college'] }}@endif</span></td>
                                <td><span>@if(isset($education['major'])){{ $education['major'] }}@endif</span></td>
                                <td><span>@if(isset( $education['bs'])){{ $education['bs'] }}@endif</span></td>
                                <td><span></span></td>
                                <td><span></span></td>
                            </tr>
                            <tr>
                             <td><span>@if(isset( $education['yr'])){{ $education['yr'] }}@endif</span></td>
                                <td><span>@if(isset( $education['clg'])){{ $education['clg'] }}@endif</span></td>
                                <td><span>@if(isset( $education['ma'])){{ $education['ma'] }}@endif</span></td>
                                <td><span></span></td>
                                <td><span>@if(isset( $education['ms'])){{ $education['ms'] }}@endif</span></td>
                                <td><span></span></td>
                            </tr>
                            <tr>
                             <td><span>@if(isset( $education['years'])){{ $education['years'] }}@endif</span></td>
                                <td><span>@if(isset( $education['uni'])){{ $education['uni'] }}@endif</span></td>
                                <td><span>@if(isset( $education['mr'])){{ $education['mr'] }}@endif</span></td>
                                <td><span></span></td>
                                <td><span></span></td>
                                <td><span>@if(isset( $education['ot'])){{ $education['ot'] }}@endif</span></td>
                            </tr>
                        </table>						
							
							<!--<iframe src="http://docs.google.com/viewer?url={!! URL::to('/') !!}/uploads/resume/{!! $profile->resume !!}&embedded=true" width="400" height="400" style="border: none;display:block"></iframe>
							 <a href="{!! URL::to('/') !!}/uploads/resume/{!! $profile->resume !!}" target='_blank'>Download Resume</a>-->
</div></p><hr>
					@endif
					<?php endif; ?>
				
                    
				</div>	
					<?php  
					$profile=@unserialize($profile->resume); 
					if ($profile !== false) :
					?>	
	
                    <div class="news-section">
                    	<div class="sponser_logo_title">
            				<h1>Portfolio</h1>
			       		</div>
                    	<ul class="grid_portfolio cs-style-1">
                        <div class="row">
						@if(is_array($profile) || (is_object($profile)))
						@foreach($profile as $key=>$input)
						<?php 
						list($key1, $value1) = each($profile[$key]);
						?>
                            <li class="col-lg-4 col-md-4 col-sm-4 col-xs-4">
                              <figure>
							 <img class="portfolio-images" src="{!! URL::to('/') !!}/uploads/resume/{!! $key1 !!}" alt="img01">
                                <figcaption>
                                  <span>{{ $value1 }}</span>
                                 <!-- <a href="!#">softral.com</a>-->
                                </figcaption>
                              </figure>
                            </li>
							@endforeach
							@endif
                           </div>
						</ul>
                    </div>
					<?php endif; ?>

                </div>

				
<!-- Employee jobs -->

@if(isset($profile->profile_field_type->value) && ($profile->profile_field_type->value=='Buyer' || $profile->profile_field_type->value='Both'))
				  	 <div class="col-md-12">	   	

				<div class="row selected-classifieds">
@if(count($profile->jobs)!=0)
		  			<h4 style='padding-left: 15px;color:#d9534f'><strong>My Jobs</strong></h4>

		 	 @foreach($profile->jobs as $job)

            <div class="col-lg-12 user_profile">

              <div class="thumbnail">

			                  <div class="caption">

                  <h4><strong><a href="{!! URL::to('/job/').'/'.$job->slug !!}">{!! $job->project_name !!}</a></strong></h4>

				 <div class="price">Budget: ${!! $job->budget !!} - Posted {!!  $job->created_at !!}</div>&nbsp; | 

				 @if($job->job_close==0)

					Hiring Open 

				 @else

					 Hiring Closed

				 @endif

				<div class="pull-right posted_by"><span style="color: #AFAFAF; ">Total Proposals: </span> ({!! count($job->proposals)!!})</div><br>

				

				  @if(isset($job->categories->category))<div class="pull-left categories"><span style="color: #AFAFAF; ">Category:</span> <a href="{!! URL::to('/category/').'/'.$job->categories->slug !!}"   >{!!  $job->categories->category !!}</a> </div> @endif

				   				  <div class="pull-right skills"><span style="color: #AFAFAF; ">Skills:</span>{!! $job->modified_skill_id !!}</div>

				                   </div>

              </div>

            </div>

			@endforeach
			@else					   		 
<h4 style='padding-left: 15px;color:#d9534f'><strong>You haven't posted any job yet.</strong></h4>        
@endif
		
			</div>
            </div>
			@endif
			
			<!-- Freelancer jobs -->
			@if(isset($profile->profile_field_type->value) && ($profile->profile_field_type->value=='Seller' || $profile->profile_field_type->value='Both'))
				@if(count($working_jobs)!=0)
			 <div class="col-md-12">	   	
				<div class="row selected-classifieds">
					
			<h4 style='padding-left: 15px;color:#d9534f'><strong>My Ongoing jobs</strong></h4>
			@foreach($working_jobs as $job)
			 @if(!empty($job->contract))
            <div class="col-lg-12 user_profile">
              <div class="thumbnail">
				
			      <div class="caption">			  
                  <h4><strong><a href="{!! URL::to('/job/').'/'.$job->job->slug !!}">{!! $job->job->project_name !!}</a></strong></h4>
				 <div class="price">Budget:${!! $job->job->budget !!} - Posted {!!  $job->job->created_at !!}</div>&nbsp; | 
				 @if($job->job->job_close==0)
					Hiring Open 
				 @else
					 Hiring Closed	
				 @endif
				 
				<div class="pull-right posted_by"><span style="color: #AFAFAF; "> </span> </div><br>
				  @if(isset($job->job->categories->category))<div class="pull-left categories"><span style="color: #AFAFAF; ">Category:</span> <a href="{!! URL::to('/category/').'/'.$job->job->categories->slug !!}"   >{!!  $job->job->categories->category !!}</a> </div> @endif
				</div>
				</div>
				</div>
				@endif
				@endforeach
				@else	
			<div class="col-lg-12 user_profile">					
				<h4 style='color:#d9534f'><strong>You are not working on any jobs.</strong></h4>
			</div>
				@endif
				
				</div>
				</div>
			@endif
            <!-- ROW END -->


        </section>

              </div><!--/panel-body-->

          </div><!--/panel-->
 {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
	<script>
	 /*Save Users Ajax*/
			 	$(document).on('click', '#set_fav', function(){
					
				  var data = $(this).attr('value') ;
				  var text='save_user';
				  
				 $.post("{!! URL::to('/job/savejob/') !!}"+"/"+data+"/"+text, function(response){
				if(response.success)
				{
					
					$('.jave_job_success').show().html('You have successfully saved the user').delay(3000).fadeOut();;	
					$('#set_fav').html('<span class="glyphicon glyphicon-heart"></span> User saved');	
					$('#set_fav').attr('id','');	
				}
			}, 'json');
				 
			 });
		</script>

	  @stop