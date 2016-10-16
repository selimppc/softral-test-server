@extends('laravel-authentication-acl::client.layouts.base')
@section('title')
Softral - Submit A Proposal - {!! $job_detail->project_name !!}
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
       @if($errors->any())
			<div class="alert alert-danger">
				@foreach($errors->all() as $error)
					<p>{{ $error }}</p>
				@endforeach
			</div>
		@endif
	<ol class="breadcrumb">
            <li><span class="glyphicon glyphicon-home"></span> <a href="{!! URL::to('/') !!}">Home</a></li>
			@if(!empty($job_detail->categories->parent_get))
				<li><a href="{!! URL::to('/category/').'/'.$job_detail->categories->parent_get->slug !!}">{!! $job_detail->categories->parent_get->category !!}</a></li>
			@endif
            @if(isset($job_detail->categories->category))<li><a href="{!! URL::to('/category/').'/'.$job_detail->categories->slug !!}">{!!  $job_detail->categories->category !!}</a></li>@endif
            <li><a href="{!! URL::to('/job/').'/'.$job_detail->slug !!}">{!! $job_detail->project_name !!}</a></li>
			<li>{!! isset($proposal->id) ? 'Edit Proposal' : 'Submit Proposal' !!}</li>
          </ol>
			
			<div class="row-fluid">
				<div class="col-md-12 panel panel-info">
			
					<br>
					 <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
						 <h3 style="font-size:26px" class="panel-title bariol-thin">{!! isset($proposal->id) ? '<i class="fa fa-pencil"></i> Edit Proposal for ' .$job_detail->project_name:'<i class="fa fa-user"></i> Submit A Proposal for ' .$job_detail->project_name !!}</h3>
                    </div>
                </div>
            </div>  
					<hr>
					
					
					{!! $job_detail->description !!}
															<hr>	
					<div class="row-fluid">
						<h5>@if($job_detail->job_type=='fixed' && $job_detail->budget!='0')
						Budget: ${!! $job_detail->budget !!} -
					@elseif($job_detail->budget!='0')
						Hourly: ${!! $job_detail->budget !!}/Hour -
					@endif Posted : {!!  $job_detail->created_at !!}</h5>
					</div>
					<hr>
					<div class="row-fluid">
						<h5>Job ID : {!! $job_detail->id !!}</h5>
					</div>
					<hr>
					 <div class="row">
            <div class="col-md-12">
              <div class="panel panel-default">
                <div class="panel-body">                
				{!! Form::model($proposal,['route'=>'job.saveProposal','class' => 'form', 'method' => 'post']) !!}
				{!! isset($proposal->id)?Form::hidden('id'):'' !!}	
				 <input type="hidden" class="form-control" name="job_id"  value="{!! $job_detail->id !!}">
				 
				 @if($job_detail->job_type=='fixed')
                    <div class="form-group">
                      <label for="InputEmail" style='width: 100%;'>Proposal Terms</label>
                      <div class="col-md-3">Paid to you (in $)<input type="number" min="1" max="10000"  class="form-control" name="amount[paid_to]" id="paid_to" placeholder="Paid to you in $" required="true" value="{!! isset($proposal->id)?$proposal->main_amount:''!!}"></div>
                      <div class="col-md-3">+{{$freelancer_fee}} Softral Fee (in $) <input type="number" min="1" max="10000"  class="form-control" name="amount[softral_fee]" id="softral_fee" placeholder="+{{$freelancer_fee}} Softral Fee in $" required="true" readonly value="{!! isset($proposal->id)?$proposal->fee_amount:''!!}"></div>
                      <div class="col-md-3">Charged to Client (in $) <input type="number" min="1" max="10000"  class="form-control" name="amount[charged_client]" id="charged_client" placeholder="Charged to Client in $" required="true" value="{!! isset($proposal->id)?$proposal->client_amount:''!!}" readonly></div>
					   <div class="col-md-3">Estimated Delivery date<input type="text"  class="form-control readonly" name="amount[duration]" id="estimation_duration" placeholder="Estimated Delivery date" value="{!! isset($proposal->id)?$milestone->posted_date:''!!}" required="true"  ></div>
                    </div>
				@else
					 <div class="form-group">
                      <label for="InputEmail" style='width: 100%;'>Proposal Terms</label>
                      <div class="col-md-3">Amount per hour (in $)<input type="number" min="1" max="10000"  class="form-control" name="amount[paid_to]" id="paid_to" placeholder="Amount per hour" required="true" value="{!! isset($proposal->id)?$proposal->main_amount:''!!}"></div>
                      <div class="col-md-3">+{{$freelancer_fee}}% Softral Fee (in $) <input type="number" min="1" max="10000"  class="form-control" name="amount[softral_fee]" id="softral_fee" placeholder="+{{$freelancer_fee}} Softral Fee in $" required="true" readonly value="{!! isset($proposal->id)?$proposal->fee_amount:''!!}"></div>
                      <div class="col-md-3">Hours(Optional)<input type="number" min="1" max="10000"  class="form-control decrease_size" name="amount[hoursperweek]" id="hoursperweek" placeholder="Hours/Week" value="{!! isset($proposal->id)?$proposal->client_amount:''!!}" ><span>/Week</span></div>
                      <div class="col-md-3">Duration(Optional)<input type="number" min="1" max="10000"  class="form-control decrease_size" name="amount[duration]" id="duration" placeholder="Total Duration" value="{!! isset($proposal->id)?$proposal->client_amount:''!!}" ><span>Weeks</span></div>
                    </div>
					<br/><br/><br/>
					 <div class="form-group">
						 <div class="col-md-4">Charged to Client (in $) <input type="number" min="1" max="10000"  class="form-control" name="amount[charged_client]" id="charged_client" placeholder="Charged to Client in $" required="true" value="{!! isset($proposal->id)?$proposal->client_amount:''!!}" readonly></div>
					 </div>
				@endif
					<br/><br/><br/>
                    <div class="form-group">
                      <label for="InputText">Cover letter</label>
                      <textarea class="form-control" id="proposal" name="proposal" placeholder="Write your cover letter" rows="12" style="margin-bottom:10px;width:54%" required="true">{!! isset($proposal->id)?$proposal->proposal:''!!}</textarea>
                    </div>
                    <button class="btn btn-info" type="submit" id="submit">Submit A Proposal</button> <a class="btn btn-default" href="{!! URL::to('/job/').'/'.$job_detail->slug !!}">Cancel</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
					
				</div>
			</div>
			
		</div>
	
	</div>
	
	
</div>
      </div>
	
	<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	{!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
		<script type='text/javascript'>
		$(function() {
			$("#paid_to").keyup(function(){
				
				var paid_to=$('#paid_to').val();

				//var result=parseFloat(parseInt(paid_to, 10) + {{$freelancer_fee}});
				var result={{$freelancer_fee}};
				$('#softral_fee').val(result);
				var total = parseFloat(paid_to)+parseFloat(result);
				$('#charged_client').val(total);
				return true;
			});
			
			$('#estimation_duration').datepicker({
				dateFormat: 'yy-mm-dd',
				minDate: 0 
			});
			
			 $(".readonly").keydown(function(e){
				e.preventDefault();
			});
		});
    </script>

	
	  @stop