@extends('laravel-authentication-acl::client.layouts.base')
@section('title')
Softral - My Jobs
@stop
@section('content')
<div class="row content">
{{--@include('laravel-authentication-acl::client.layouts.sidebar')--}}
	  
      <div class="row1 col-xs-12 col-sm-12 col-md-12 col-lg-12">

	   @if(count($my_jobs)!=0)
<div class="panel panel-default">
  <div class="panel-body">
   <h4 style="margin:0px;text-align:center"><strong>My Jobs</strong></h4>
  </div>
</div>
@endif
<div class="row">
     
	   <div class="pull-left col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
                <div style="margin-top:15px;" class="panel panel-default">
                  <div class="panel-body text-center">
				  @if(count($my_jobs)!=0)
<table border="1" class="table table-striped table-bordered table-hover dataTable no-footer">
	 <tbody><tr>
		<td><strong>Job name</strong></td>
		<td><strong>Price</strong></td>
		<td><strong>Total Propsals</strong></td>
		<td><strong>Posted date</strong></td>
		<td><strong>Contract</strong></td>
		<td><strong>Close Job</strong></td>
		<td><strong>Fund the Job</strong></td>
		<td><strong>Edit</strong></td>
		<td><strong>View</strong></td>
		<td><strong>Delete</strong></td>
	</tr>	
		
		 @foreach($my_jobs as $my_job)
         	<tr>
				<td><a href="{!! URL::to('/job/').'/'.$my_job->slug !!}">{{$my_job->project_name}}</a></td>
				<td>@if($my_job->budget!=0)${!! $my_job->budget !!}@else Not specified @endif</td>
				<td><a href="{!! URL::route('job.jobProposals', ['job-id'=>$my_job->id]) !!}">View ({!! count($my_job->proposals) !!})</a></td>
				<td>{{$my_job->created_at}}</td>
				<td>
				@if(isset($my_job->contract->approve_contract) && ($my_job->contract->approve_contract==1)) Contract is suspended 
				@elseif(isset($my_job->contract->hold_contract) && $my_job->contract->hold_contract==0)Contract is on hold 
				@elseif(isset($my_job->contract->cancel_contract) && $my_job->contract->cancel_contract==1)Contract cancelled 
				
				@elseif(isset($my_job->contract) && $my_job->contract->ended_contract==1 && isset($my_job->proposal_selected->id))<a href="{!! URL::to('/financial/terms_milestone/').'?p_id='. $my_job->proposal_selected->id !!}" class="margin-left-5">Contract ended</a>
				<br/>
				<a href="{!! URL::to('/financial/reopen_contract/').'?p_id='. $my_job->proposal_selected->id !!}" class="margin-left-5 reopen">Reopen the contract</a><br>
				@if(($my_job->selected==1))
				<a href="{!! URL::route('job.openJob', ['job-id'=>$my_job->id, '_token' => csrf_token()]) !!}" class="open_job"><font color='green'><strong>Reopen Job</strong></font></a> 
			    @endif
				
				@elseif(isset($my_job->contract) && $my_job->contract->ended_contract==0 && $my_job->contract->cancel_contract==0 && isset($my_job->proposal_selected->id))<a href="{!! URL::to('/financial/terms_milestone/').'?p_id='. $my_job->proposal_selected->id !!}" class="margin-left-5">View Contract</a> @endif</td>
				
				<td>@if($my_job->job_close==1) <a href="{!! URL::route('job.openJob', ['job-id'=>$my_job->id, '_token' => csrf_token()]) !!}" class="open_job"><font color='green'><strong>Reopen Job</strong></font></a> @else<a href="{!! URL::route('job.closeJob', ['job-id'=>$my_job->id, '_token' => csrf_token()]) !!}" class="close_job">Close job</a>@endif</td>
				<td>
				@if(isset($my_job->proposal_selected->terms_milestone) && ($my_job->proposal_selected->terms_milestone==2)) Offer is declined
				@elseif(isset($my_job->proposal_selected->terms_milestone) && ($my_job->proposal_selected->terms_milestone!=1)) Freelancer hasn't accepted yet.
				@elseif(isset($my_job->contract->approve_contract) && ($my_job->contract->approve_contract==1)) Contract is suspended
				@elseif(isset($my_job->contract->hold_contract) && $my_job->contract->hold_contract==0)Contract is on hold 
				@elseif(isset($my_job->contract->cancel_contract) && $my_job->contract->cancel_contract==1)Contract cancelled @elseif(isset($my_job->contract->ended_contract) && $my_job->contract->ended_contract==1) Contract ended
				@elseif(isset($my_job->contract) && isset($my_job->proposal_selected->id) && $my_job->job_close==0)<a href="#" data-toggle="modal" data-target="#modal_add_fund_escrow_{{$my_job->id}}">Fund</a>
				
				
				<div id="modal_add_fund_escrow_{{$my_job->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog" style="margin-top: 110px !important;" >
	
        <div class="modal-content">
		
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Fund to Escrow</h4>
            </div>
			{!! Form::open(array('route' => 'financial.saveEscrow', 'class' => 'form_escrow', 'method' => 'post','style'=>'text-align:left')) !!}
            <div class="modal-body">
					<input type='hidden' name='proposal_id' value='{!! $my_job->proposal_selected->id !!}' />
					<input type='hidden' name='job_id' value='{!! $my_job->id !!}' />
                    <div class="form-group">
                        <span>You have <strong>
						@if(isset($my_job->user_money) && !empty($my_job->user_money))
							${!! $my_job->user_money->total_amount !!}
						@else
							$0
						@endif
					</strong> in your account.</span>
                    </div>
					 <div class="form-group">
                        <span for="txtassignmenttext">Do you want to deposit to escrow from your account?</span>
						<input type='radio' name='deposit_for' value='yes' required="true" class="deposit_for" checked> Yes</input> <input type='radio' name='deposit_for' value='no' required="true" class="deposit_for"> No</input>
                    </div>
					@if(!count($my_job['financial_credit_card'])==0)
			<div style='display:none' id='credit_card_show'>
						<h3>Credit cards</h3>
						<hr/>
				@foreach($my_job['financial_credit_card'] as $credit_method)
					
				<div class="form-group">
					<div class='row'>
					<div class='col-md-6'>
					<input type='radio' name='financial_accounts_id' value="{!! $credit_method['id'] !!}" checked /> {!! $credit_method['credit']['modified_card_number'] !!}
					</div>
					</div>
						<input type='hidden' name='financial_account_name' value='credit_card' />
				</div>
				
				@endforeach
				@else
					You haven't added any credit card. Please <a href="{{ URL::route('addcredit') }}">Add</a> Credit card to withdraw amount.
					<hr/>
				@endif
				</div>
				
					<div class="form-group" style='margin-left:6px'>
                        <label for="txtassignmenttext">Amount:</label>
						<span class="usd" style="margin-top: 6px; ">$</span>
						<input type='text' class="form-control" name="amount" placeholder="Amount + Transaction fee" id="amount" required="true" style='display: inline;width:40%'></input>
                    </div>
          
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit"  class="btn btn-primary" value="Submit" />
            </div>
			  </div>
			</form>
        </div><!-- /.modal-content -->
		
    </div><!-- /.modal-dialog -->
</div><!-- modal -->
				@endif</td>
				<td><a href="{!! URL::route('job.editJob', ['id'=>$my_job->id]) !!}"><i class="fa fa-pencil-square-o fa-2x"></i></a></td>
				<td><a href="{!! URL::to('/job/').'/'.$my_job->slug !!}" class="margin-left-5"><i class="fa fa-eye fa-2x"></i></a></td>
				<td><a href="{!! URL::route('myJob.delete',['id' => $my_job->id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a></td>
				
			</tr>	
		@endforeach
              
           		   			</tbody></table>
			<div style="margin-left:2px" class="row pagging">
			{!! $my_jobs->render() !!}
		  </div>
			@else
				<div style='text-align:center'><h3>You haven't posted any job</h3></div>
			@endif
			</div>
			</div></div></div>
  </div>
      </div>
	  {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
	      <script>
      
	$(function() {
         $(".delete").click(function(){
            return confirm("Are you sure to delete this job?");
        }); 
		
		$(".close_job").click(function(){
            return confirm("Are you sure to close this job?");
        }); 
		
		$(".open_job").click(function(){
            return confirm("Are you sure to reopen the job?");
        }); 
		
		$(".reopen").click(function(){
            return confirm("Are you sure to reopen the contract?");
        });
		
			$(".deposit_for").click(function(){
			if($(this).val()=='no'){
				$('#credit_card_show').show();
			}else{
				$('#credit_card_show').hide();
			}
        });
		
    });
	
    </script>
	  @stop