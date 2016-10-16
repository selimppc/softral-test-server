@extends('laravel-authentication-acl::client.layouts.base')
@section('title')
Softral Job - View {!!  $proposal->job->project_name !!}
@stop
@section('content')
<div class="row content">
    
        <div class="container-fluid main_content view-job">
	
	<div class="row-fluid">
		
		<div class="col-lg-12">
	
	<?php $message = Session::get('message'); ?>
        @if( isset($message) )
        <div class="alert alert-success">{!! $message !!}</div>
        @endif
		
		<ol class="breadcrumb">
            <li><span class="glyphicon glyphicon-home"></span> <a href="{!! URL::to('/') !!}">Home</a></li>
			@if(!empty( $proposal->job->categories->parent_get))
				<li><a href="{!! URL::to('/category/').'/'. $proposal->job->categories->parent_get->slug !!}">{!!  $proposal->job->categories->parent_get->category !!}</a></li>
			@endif
            @if(isset($proposal->job->categories->category))<li><a href="{!! URL::to('/category/').'/'. $proposal->job->categories->slug !!}">{!!   $proposal->job->categories->category !!}</a></li>@endif
            <li><a href="{!! URL::to('/job/').'/'. $proposal->job->slug !!}">{!!  $proposal->job->project_name !!}</a></li>
			 <li>My Proposal</li>
          </ol>
			
			<div class="row-fluid">
				<div class="col-md-12 panel panel-info">
					<br>
				
			
					
					 <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                         <h3 class="panel-title bariol-thin" style='font-size:26px'>
						 {!! $proposal->job->project_name !!} 
						<span style='font-size:15px'> Job ID :{!! $proposal->job->id !!}</span>
						 </h3>
						 
						 <div class="row-fluid">
						<h5></h5>
						
					</div>	
                    </div>
					
					<div class="col-md-6" style='text-align:right;padding-top:5px'>
					@if($no_more==1)
						<strong>Job is no more!</strong>
					@else
						@if($proposal->offer==1)
							<strong>Proposal selected for this job</strong>
						@else
							@if($proposal->job->selected==0 && $user_id==$proposal->job->user_id)	
							<button type="button" class="btn btn-info pull-right" data-toggle="modal"  data-target="#myModal">Select Proposal</button>
							@endif
						@endif
					@endif
					</div>
                </div>
            </div>    
			
			
					@if(isset($proposal->job->categories->category))<h5>Category: <a href="{!! URL::to('/category/').'/'.$proposal->job->categories->slug !!}"   >{!! $proposal->job->categories->category !!}</a></h5>@endif
					
					<hr>
					<h5>Freelancer Name:
						{!! $proposal->user_profile->first_name !!}
						<a href="{{ URL::to('/user/profile/'). '/'.$proposal->user_profile->slug }}">Freelancer Profile</a>
						</h5>
					<?php $images=unserialize($proposal->job->images); ?>
					@if(!empty($images))
					
					<div class="row-fluid">
						<h5>Images : {!! $images_string !!}</h5>
					</div>
					@else
					<hr>	
					@endif
					
					
					
					{!! $proposal->proposal !!}
					
					@if( $proposal->job->job_type=='fixed')
					<div class="row-fluid">
						<h5> Amount : ${!! $proposal->main_amount !!}</h5>
						
						<h5>Proposal Submitted date : {{ $proposal->created_at }}</h5>	
					</div>
					<hr>
					@else
					<div class="row-fluid">
						<h5>Hour : ${!! $proposal->main_amount !!}/Hour</h5>
						<h5>Proposal Submitted date : {{ $proposal->created_at }}</h5>
					</div>
					<hr>
					@endif
					
					@if($proposal->hoursperweek_amount!='')
					<div class="row-fluid">
						<h5> Hours per week : {!! $proposal->hoursperweek_amount !!} Hours/Week</h5>
					</div>
					<hr>
					@endif
					
					@if($proposal->duration_amount!='')
					<div class="row-fluid">
						<h5> {!! $proposal->duration_amount !!}</h5>
					</div>
					@endif
					<h5>Charged to Client : ${!! $proposal->client_amount !!}</h5>
					
					
					
					
				</div>
			</div>
			
			@if(isset($proposal->counter_amount) && $proposal->counter_amount!='' && ($user_id==$proposal->user_id) && $proposal->job->selected==0 )
				<div class="row-fluid">
				<h3> You have got a new offer from Client : ${{$proposal->counter_amount}}</h3>
				</div>
			@endif
			
			@if(isset($proposal->freelancer_counter_amount) && $proposal->freelancer_counter_amount!='' && ($user_id==$proposal->job->user_id) && $proposal->job->selected==0)
				<div class="row-fluid">
				<h3> You have got a new offer from Freelancer : ${{$proposal->freelancer_counter_amount}}</h3>
				</div>
			@endif
			
			@if($proposal->offer==1 && $proposal->freelancer_counter_amount!='') 
				<div class="row-fluid">
				<h3>Congratulations, Your offer of ${{$proposal->freelancer_counter_amount}} has been selected.</h3>
				</div>
			@endif
           
			 @if($proposal->job->selected==0 ) 
			
			<div class="row-fluid">
				<div class="col-md-12 panel panel-info">
					<br>
					 <div class="panel-heading">
                <div class="row">
                    <div class="col-md-6">
                         Send a counter offer
                    </div>
				  </div>
            </div>  	
			<br/>
					<div class="row-fluid">
					 <div class="col-md-6 col-xs-12">
					
					 {!! Form::open(array('route' => 'job.counter_offer', 'class' => 'form_milestone', 'method' => 'post')) !!}
				
				<div class="form-group">
					@if($user_id==$proposal->job->user_id)
						<div class='col-md-1' style='6px 1px 3px 24px'>$</div><input type='number' name='counter_amount' value='' placeholder='Add amount' required class= "form-control" style='width:50%' />
					@else
						<div class='col-md-1' style='6px 1px 3px 24px'>$</div><input type='number' name='freelancer_counter_amount' value='' placeholder='Add amount' required class= "form-control" style='width:50%' />
					@endif
					<input type='hidden' name='p_id' value='{{ $proposal->id }}'  />
				</div>
				
				<div class="form-group">
					<input type='submit' value='Send a counter offer' class='btn btn-primary'  />
				</div>	
					
					</form>
			
					</div>
					</div>
                </div>
            </div> 
			@endif
				
			<!-- Modal -->
											<div id="myModal" class="modal fade" role="dialog">
											  <div class="modal-dialog">

												<!-- Modal content-->
												<div class="modal-content">
												  <div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Select Proposal</h4>
												  </div>
												  {!! Form::open(array('route' => 'job.selectProposal', 'class' => 'form_milestone', 'method' => 'post')) !!}
												  <input type='hidden' name='id' value='{!! $proposal->id !!}'/>
												  <input type='hidden' name='job_id' value='{!!  $proposal->job->id !!}'/>
												  <div class="modal-body">
												   <div class="form-group" style='float:left'>
													<input type='radio' value='1' name='close_job' checked /> Close job after award
													<input type='radio' value='0' name='close_job' /> Keep job open
													</div>
												  </div>
												  <div class="modal-footer">
													<button type="submit" class="btn btn-primary" >Submit</button>
													<button type="submit" class="btn" data-dismiss="modal">Close</button>
												  </div>
												  </form>
												</div>

											  </div>
											</div>
		
	</div>
	</div>
	
	
</div>
      </div>
	   
	 {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
	      <script>
     
		$(".select_proposal").click(function(){
				return confirm("Are you sure to select this proposal?");
        });
	
    </script>
	  @stop