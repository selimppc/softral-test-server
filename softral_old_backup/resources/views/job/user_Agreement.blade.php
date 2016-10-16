@extends('laravel-authentication-acl::client.layouts.base')
@section('title')
Softral - My Contracts
@stop
@section('content')
<div class="row content">
{{--@include('laravel-authentication-acl::client.layouts.sidebar')--}}
	  
      <div class="row1 col-xs-12 col-sm-12 col-md-12 col-lg-12">

	   @if(count($my_jobs)!=0)
<div class="panel panel-default">
  <div class="panel-body">
   <h4 style="margin:0px;text-align:center"><strong>User Agreement</strong></h4>
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
		<td><strong>Proposal Selected Price</strong></td>
		<td><strong>Contract approved date</strong></td>
		<td><strong>Fund the amount</strong></td>
		<td><strong>Escrow Contract</strong></td>
		
	</tr>	
		
		 @foreach($my_jobs as $my_job)
		 <?php //echo '<pre>'; print_r($my_job); exit; ?>
         	<tr>
			    <td><a href="{!! URL::to('/job/').'/'.$my_job->job->slug !!}">{{$my_job->job->project_name}}</a></td>
				<?php 
				if(isset($my_job->proposal->amount)):
					$value = json_decode($my_job->proposal->amount);
					$paid_to=$value->paid_to;
				else:
					$paid_to=0;
				endif;
				?>
				
				<td>@if($paid_to!=0)
					
					${!! $paid_to !!}
				
				@else 
					Not specified @endif
				</td>
			
				<td>{{$my_job->modified_posted_date}}</td>
				<td><a href="#" data-toggle="modal" data-target="#modal_add_fund_escrow_{{$my_job->id}}">Fund</a>
				<div id="modal_add_fund_escrow_{{$my_job->id}}" class="modal fade" role="dialog">
    <div class="modal-dialog" style="margin-top: 110px !important;" >
	
        <div class="modal-content">
		
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Fund to Escrow</h4>
            </div>
			{!! Form::open(array('route' => 'financial.saveEscrow', 'class' => 'form_escrow', 'method' => 'post','style'=>'text-align:left')) !!}
            <div class="modal-body">
					<input type='hidden' name='proposal_id' value='{!! $my_job->proposal_id!!}' />
					<input type='hidden' name='job_id' value='{!! $my_job->job_id !!}' />
                    <div class="form-group">
                         <span>You have <strong>
						 
						@if(isset($money) && !empty($my_job))
							${!! $money !!}
						@else
							$0
						@endif
					</strong> in your account.</span>
                    </div>
					 <div class="form-group">
                        <span for="txtassignmenttext">Do you want to deposit to escrow from your account?</span>
						<input type='radio' name='deposit_for' value='yes' required="true" class="deposit_for" checked> Yes</input> <input type='radio' name='deposit_for' value='no' required="true" class="deposit_for"> No</input>
                    </div>
				
			<div style='display:none' class='credit_card_show'>
						<h3>Credit cards</h3>
						<hr/>
				@foreach($credit_accounts as $credit_method)
				
					 
				<div class="form-group">
					<div class='row'>
					<div class='col-md-6'>
					<input type='radio' name='financial_accounts_id' value="
					{!! $credit_method['id'] !!}" checked /> 
					
						{!! $credit_method->modified_card_number !!}
					</div>
					</div>
						<input type='hidden' name='financial_account_name' value='credit_card' />
				</div>
				
				@endforeach
				
				
				
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

				</td>
				<td>@if(isset($my_job->approve_contract) && ($my_job->approve_contract==1)) Contract isn't Approved yet @elseif(isset($my_job->cancel_contract) && $my_job->cancel_contract==1)Contract cancelled @elseif(isset($my_job->ended_contract) && $my_job->ended_contract==1 && isset($my_job->proposal_selected->id))<a href="{!! URL::to('/financial/terms_milestone/').'?p_id='. $my_job->proposal_selected->id !!}" class="margin-left-5">Contract ended</a>
				<br/>
				<a href="{!! URL::to('/financial/reopen_contract/').'?p_id='. $my_job->proposal_selected->id !!}" class="margin-left-5 reopen">Reopen the contract</a>
				
				@elseif(isset($my_job) && $my_job->ended_contract==0 && $my_job->cancel_contract==0 && isset($my_job->proposal_selected->id))<a href="{!! URL::to('/financial/terms_milestone/').'?p_id='. $my_job->proposal_selected->id !!}" class="margin-left-5">View Contract</a> @endif</td>
				
				
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
				$('.credit_card_show').show();
			}else{
				$('.credit_card_show').hide();
			}
        });
		
    });
	
    </script>
	  @stop