@extends('laravel-authentication-acl::client.layouts.base')
@section('title')
Softral Job - {!! $proposal->job->project_name !!} - Terms and Condition
@stop
@section('content')
<div class="row content">
     <style>
.pagination li:first-child {
    display: none;
}

.pagination li:last-child {
    display: none;
}
.pagination {
    float: left;
    text-align: center;
    width: 100%;
}
.pagination > li > a, .pagination > li > span {
    float: none;
}
</style> 
        <div class="container-fluid main_content view-job">
	
	<div class="row-fluid">
		
		<div class="col-lg-12">
		
      {{-- successful message --}}
        <?php $message = Session::get('message'); ?>
        @if( isset($message) )
        <div class="alert alert-success">{!! $message !!}</div>
        @endif
		<?php $error = Session::get('error'); ?>
        @if( isset($error) )
        <div class="alert alert-danger">{!! $error !!}</div>
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
			@if(!empty($proposal->job->categories->parent_get))
				<li><a href="{!! URL::to('/category/').'/'.$proposal->job->categories->parent_get->slug !!}">{!! $proposal->job->categories->parent_get->category !!}</a></li>
			@endif
            @if(isset($proposal->job->categories->category))
				<li><a href="{!! URL::to('/category/').'/'.$proposal->job->categories->slug !!}">{!!  $proposal->job->categories->category !!}</a></li>
			@endif
            <li><a href="{!! URL::to('/job/').'/'.$proposal->job->slug !!}">{!! $proposal->job->project_name !!}</a></li>
			<li>Terms & Milestone
          </ol>
			
			<div class="col-md-12 panel panel-info">
					<br>
					 <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                         <h3 class="panel-title bariol-thin" style='font-size:26px'>{!! $proposal->job->project_name !!} <span style='font-size:15px'> Job ID :{!! $proposal->job->id !!}</span></h3>
                    </div>
                </div>
            </div>    
			<br/>
				
				</div>
			
			<div class="col-lg-3 content-left">
				<h4>Workroom</h4>
				<div class="well well-sm">
				<a href="{!! URL::to('view_workboard').'?id='.$proposal->id !!}">Workboard</a><br/>
				
				@if(!isset($proposal->contract))
					@if($user_id==$proposal->job->user_id)
						<a href="javascript:void(0)" id="add_fund_escrow">Deposit fund to Escrow</a><br/>
					@endif
				@endif
				
				@if(isset($proposal->contract) && $proposal->contract->ended_contract==0 && $proposal->contract->cancel_contract==0)
					@if($user_id==$proposal->job->user_id)
						<a href="javascript:void(0)" id="add_fund_escrow">Deposit fund to Escrow</a><br/>
						<a href="javascript:void(0)" id="add_release_escrow">Release Money</a><br/>
					@endif
				@endif
				
				  @if($proposal->job->job_type=='hourly' && ($user_id==$proposal->user_id))
                    <a href="javascript:void(0)" id="add_log_hours">Log Hours</a><br>
                  @endif
					
					@if($proposal->job->job_type=='hourly')
						<a href="javascript:void(0)" id="add_release_showhours">Show Hours</a>
                    @endif
					
				@if($user_id==$proposal->job->user_id)
					@if(isset($proposal->contract) && $proposal->contract->ended_contract==1)<a href="javascript:void(0)" id="add_release_bonus">Send Bonus</a>@endif
				@endif	
				
				@if($user_id==$proposal->user_id)
					 {!! Form::open(array('route' => 'freelancerrequest.money', 'class' => 'form_milestone', 'method' => 'post')) !!}
					@if(isset($proposal->contract) && $proposal->contract->ended_contract==0)
					<input type='hidden' name='job_id' value='{{ $proposal->job_id }}' />
					<input type='hidden' name='p_id' value='{{ $proposal->id }}' />
					<input type='submit' value='Request money' class='request_money' style='border:none;background:#F5F5F5;color:#777777;padding-left:0px' />@endif
					</form>
				@endif
				</div>
			</div>
			
			<div class="row-fluid">
				<div class="col-lg-9 content-right">
					<h4>Terms & Milestone</h4>
					<div class='row'>
						<div class='col-md-12'>
							<div class='pull-left'><h5><strong>Job summary</strong></h5></div>
							<!--<a href='#'>Refund</a> or -->
							
							@if(!isset($proposal->contract))
									<div class='pull-right' style='padding-right: 24px;'><h5>Amount in Escrow: <strong>${!! $escrow_money !!}</strong></h5></div>
							@endif
							@if(isset($proposal->contract) && $proposal->contract->ended_contract==0 && $proposal->contract->cancel_contract==0)
							<div class='pull-right' style='padding-right: 24px;'><h5>Amount in Escrow: <strong>${!! $escrow_money !!}</strong></h5></div>
							@endif
						</div>
					</div>
					<hr class='margin_top_hr'>
					
				<table class="table table-condensed table-hover">

                <thead>

                  <tr>
				  <th colspan="1">Employer</th>
				  <th colspan="1">Job start date</th>
				  <th colspan="1">Total amount</th>
				  </tr>
				 
				  </thead>

                <tbody style="font-size: 12px;">

                  <tr>
                    <td><a href="{!! URL::to('user/profile').'/'.$proposal->job->user->user_profile[0]->slug !!}">{!! $proposal->job->user->user_profile[0]->first_name !!}</a></td>
                    <td>{!! $proposal->modified_updated_at !!}</td>
                    <td>${!! $proposal->main_amount !!}</td>
                  </tr>

                </tbody>

              </table>
			  
			  <table class="table table-condensed table-hover">

                <thead>

                  <tr>
				  <th colspan="1">Freelancer</th>
				  <th colspan="1">Job End date</th>
				  <th colspan="1">Total amount</th>
				  </tr>
				 
				  </thead>

                <tbody style="font-size: 12px;">

                  <tr>
                  <td><a href="{!! URL::to('user/profile').'/'.$proposal->user->user_profile[0]->slug !!}">{!! $proposal->user->user_profile[0]->first_name !!}</a></td>
                    <td>{!! $proposal->modified_ended_date !!}</td>
                    <td>${!! $proposal->main_amount !!}</td>
                  </tr>

                </tbody>

              </table>
	
				@if($proposal->job->job_type!='hourly')
					<div class='row'>
						<div class='col-md-12'>
							<div class='pull-left'><h5><strong>Milestones</strong></h5></div>
						</div>
					</div>
					<hr class='margin_top_hr'>
					
					<p>Milestones are used to define deliverables and payment schedule. Click on any date on the calendar to add or edit milestones.</p>
				<table class="table table-condensed table-hover milestone_table">

                <thead>

                  <tr class='milestone_th'>
					  <th colspan="1">Milestone</th>
					  <th colspan="1">Delivery date</th>
					  <th colspan="1">Amount</th>
					  <?php /*@if($proposal->terms_milestone==1 && ($user_id==$proposal->job->user_id)) */ ?>
						<th colspan="1">Actions</th>
						<th colspan="1">Status</th>
				  </tr>
				 
				  </thead>

                <tbody style="font-size: 12px;">

				<?php $lastElement = ($proposal->milestones->last())
				?>
				<?php $i=1 ?>
				@foreach($proposal->milestones as $milestone)
				
                  <tr>
                    <td>{!! $milestone->label !!}</td>
                    <td>{!! $milestone->modified_posted_date !!}</td>
                    <td>${!! $milestone->amount !!}</td>
                    <td>@if(isset($proposal->contract) && $proposal->contract->ended_contract==0 && $proposal->contract->cancel_contract==0  && $proposal->terms_milestone!=2)
						@if( $proposal->terms_milestone==1 && $user_id==$proposal->user_id)
							
						@else
							@if($milestone->status==0) <a href="{!! URL::route('financial.saveMilestone',['id' => $milestone->id, '_token' => csrf_token()]) !!}" id="{!! $milestone->id !!}" onclick="return edit_model(this.id);">Edit</a> | <a href="{!! URL::route('milestone.delete',['p_id'=>$proposal->id,'id' => $milestone->id, '_token' => csrf_token()]) !!}" class='delete'>Delete</a> 
						@else
							Completed
						@endif
						@endif
					@endif</td>
				<td>
				
						@if($proposal->terms_milestone==1 && ($user_id==$proposal->job->user_id))
								@if($milestone->status==0) 
									@if(isset($proposal->contract) && $proposal->contract->ended_contract==0 && $proposal->contract->cancel_contract==0 )
										@if($i==1 && $milestone->status==0) <input type="hidden" name="milestone_amount" class="milestone_amount_{!! $milestone->id !!}" value="{!! $milestone->amount !!}"><input type='hidden' name='m_id' class="milestone_id_{!! $milestone->id !!}" value='{{$milestone->id}}' /><input type='hidden' name='p_id' class="proposal_id_accept_{!! $milestone->id !!}" value='{{$proposal->id}}' /><input type='submit' class='accept_milestone' value='Release Funds' id="accept_milestone" name="{!! $milestone->id !!}" />
										<?php $i++ ?>
									@endif
									@endif	
								@else
									Released
								@endif
								  
						@elseif($proposal->terms_milestone==1 && ($user_id==$proposal->user_id && $lastElement->id!=$milestone->id))
							@if($milestone->status==0) Pending @else Released @endif
						@endif
				
						</td>
                  </tr>
				 
				 @endforeach

                </tbody>

              </table>
				@if(isset($proposal->contract) && $proposal->contract->ended_contract==0 && $proposal->contract->cancel_contract==0 )
					  @if(($user_id==$proposal->job->user_id))
						<h5><a class='btn btn-danger btn-sm btn-search' id="add_milestone"><i class="fa fa-plus-circle"></i> Create a new milestone</a></h5>
					  @endif
				@endif
			  @endif
			  	<div class='row'>
						<div class='col-md-12'>
							<div class='pull-left'><h5><strong>Pay for Results (Payment Terms)</strong></h5></div>
						</div>
				</div>
					<hr class='margin_top_hr'>
					@if(isset($proposal->contract) && $proposal->contract->terms_condition=='')
					<p>Once the freelancer completes the work and requests payment for a milestone, the employer has 15 days to review the work and release funds from escrow.

Alternatively, the employer can adjust the terms of the job or file a dispute. If no action is taken by day 30, funds held in escrow are released to the freelancer.</p>
                    @else
					<p>{!!$proposal->contract->terms_condition!!}</p>
					@endif
					
			<!--<div class='row'>
						<div class='col-md-12'>
							<div class='pull-left'><h5><strong>Agreement Documents</strong></h5></div>
						</div>
				</div>
					<hr class='margin_top_hr'>
					<p>The most recently uploaded version of the Agreement Document is the governing agreement for this project. Once a document has been accepted, it cannot be deleted.</p>
					 <h5><a href='#' class='btn btn-danger btn-sm btn-search'><i class="fa fa-plus-circle"></i> Add attachment</a></h5>
					 -->
			@if(isset($proposal->contract) && $proposal->contract->ended_contract==1 )
				<div class='row'>
							<div class='col-md-12' style='background-color: yellow;border: 1px solid black;'>
								<div class='pull-left' ><h5 ><strong>Contract has been ended.</strong></h5>
							</div>
							</div>
							<div class='col-md-12'><br>
								@if($user_id==$proposal->job->user_id)
								<a href="{!! URL::to('/financial/reopen_contract/').'?p_id='. $proposal->id !!}" class="margin-left-5 reopen btn btn-success">Reopen the contract</a>
							    @endif
								</div>
							</div>
				
				
				@if($user_id==$proposal->user_id)
						<div class='row'>
							<div class='col-md-12'>
								<a href="{!! URL::to('/freelancer_feedback/').'?p_id='. $proposal->id.'&job_id='. $proposal->job->id !!}" class="margin-left-5 btn btn-success">Give Feedback to Employer</a></h5></div>
							</div>
						</div>
				@endif
					</div>
			@else
				@if($user_id==$proposal->user_id)
					 {!! Form::open(array('route' => 'financial.saveTermsMilestone', 'class' => 'form_milestone', 'method' => 'post')) !!}
					@if($proposal->terms_milestone==0)
					
						<input type='hidden' name='proposal_id' value='{!! $proposal->id !!}' />

						@if(isset($proposal->contract->id) && $proposal->contract->employee_accept_contract==3)
							<div class='row'>
								<div class='col-md-12' style='background-color: green;border: 1px solid black;color:white'>
									<div class='pull-left'><h5><strong>Employer has changed terms & Milestone.</strong></h5></div>
								</div>
							</div>
						<br>
						@endif				
						
						@if(isset($proposal->contract->id) && $proposal->contract->employee_accept_contract==1)
							<div class='row'>
								<div class='col-md-12' style='background-color: green;border: 1px solid black;color:white'>
									<div class='pull-left'><h5><strong>Employer has accepted terms & milestone.</strong></h5></div>
								</div>
							</div>
						<br>
						@elseif(isset($proposal->contract->id) && $proposal->contract->employee_accept_contract==0)
							<div class='row'>
								<div class='col-md-12' style='background-color: green;border: 1px solid black;color:white'>
									<div class='pull-left'><h5><strong>Sorry, Employer has denied your terms & milestone.</strong></h5></div>
								</div>
							</div>
						<br>
						@endif
						
						<div class='row'>
							<div class='col-md-12' style='background-color: yellow;border: 1px solid black;'>
								<div class='pull-left'><h5><strong>Do you accept the terms & milestones?</strong></h5></div>
							</div>
							<div class='col-md-12'>
								<div class='pull-left'><h5><input type="submit"  class="btn btn-success" name="accept" value="Accept" /> <input type="submit"  class="btn btn-danger declined_offer" name="accept" value="Decline offer" />
								@if(isset($proposal->contract) && $proposal->contract->ended_contract==0 && $proposal->contract->cancel_contract==0  && $proposal->terms_milestone!=2)
									@if( $proposal->terms_milestone==1 && $user_id==$proposal->user_id)
								
									@else
										<a href="javascript:void(0)" id="edit_terms" class='btn btn-primary'>Edit Terms</a>
									@endif
								@endif
								</h5></div>
							</div>
								
						</div>
					@elseif($proposal->terms_milestone==2)
						<div class='row'>
							<div class='col-md-12' style='background-color: red;color:white;border: 1px solid black;'>
								<div class='pull-left'><h5><strong>You have declined this offer.</strong></h5></div>
							</div>
						</div>
					@else
						<input type='hidden' name='proposal_id' value='{!! $proposal->id !!}' />	
						<div class='row'>
							<div class='col-md-12' style='background-color: yellow;border: 1px solid black;'>
								<div class='pull-left'><h5><strong>You have accepted terms and milestone.</strong></h5></div>
							</div>
							<div class='col-md-12'>
								<div class='pull-left'><h5><input type="submit"  class="btn btn-success end_contract" name="end"  value="End the contract" /></h5></div>
							</div>
						</div>
					@endif
						</form>
				@else
					@if($proposal->terms_milestone==0)
						
						@if(isset($proposal->contract->id) && $proposal->contract->employee_accept_contract==2)
							<div class='row'>
								<div class='col-md-12' style='background-color: green;border: 1px solid black;color:white'>
									<div class='pull-left'><h5><strong>Freelancer has changed terms & Milestone.</strong></h5></div>
								</div>
							</div>
							<br>
							{!! Form::open(array('route' => 'financial.saveMilestone', 'class' => 'form_milestone', 'method' => 'post')) !!}
								<div class='row'>
								<input type='hidden' name='proposal_id' value='{!! $proposal->id !!}' />
								<input type='hidden' name='job_id' value='{!! $proposal->job_id !!}' />
								<input type='hidden' name='contract_id' id="" value='@if(isset($proposal->contract->id)){!! $proposal->contract->id !!}@endif' />
								
								<div class='col-md-12' style='background-color: yellow;border: 1px solid black;'>
									<div class='pull-left'><h5><strong>Do you accept new terms & milestones?</strong></h5></div>
								</div>
								<div class='col-md-12'>
									<div class='pull-left'><h5><input type="submit"  class="btn btn-success" name="accept" value="Accept" /> <input type="submit"  class="btn btn-danger" name="accept" value="No" /></h5>
									
									</div>
								</div>
								
								@if($proposal->job->job_close==1) <a href="{!! URL::route('job.openJob', ['job-id'=>$proposal->job->id, '_token' => csrf_token()]) !!}" class="open_job"><font color='green'><strong>Reopen Job</strong></font></a> @else<a href="{!! URL::route('job.closeJob', ['job-id'=>$proposal->job->id, '_token' => csrf_token()]) !!}" class="close_job">Cancel job</a>@endif
							</div>
							</form>
							
						<br>
						@else
										
						<div class='row'>
							<div class='col-md-12' style='background-color: yellow;border: 1px solid black;'>
								<div class='pull-left'><h5><strong>Freelancer hasn't accepted terms and milestone yet.</strong></h5></div>
							</div>
						</div><br/>
						@endif
					
					@elseif(($proposal->terms_milestone==2))
						<div class='row'>
							<div class='col-md-12' style='background-color: red;color:white;border: 1px solid black;'>
								<div class='pull-left'><h5><strong>Sorry, Freelancer has declined your offer.</strong></h5></div>
							</div>
					</div>
					@else
					<div class='row'>
							<div class='col-md-12' style='background-color: yellow;border: 1px solid black;'>
								<div class='pull-left'><h5><strong>Freelancer has accepted terms and milestone.</strong></h5></div>
							</div>
					</div>
				    @endif	
			
				@endif
				
				@if($user_id==$proposal->job->user_id && $proposal->terms_milestone==1)
					 {!! Form::open(array('route' => 'financial.saveTermsMilestone', 'class' => 'form_milestone', 'method' => 'post')) !!}
					<input type='hidden' name='proposal_id' value='{!! $proposal->id !!}' />	
					<div class='row'>
						<div class='col-md-12'>
								<div class='pull-left'><h5><input type="submit"  class="btn btn-success end_contract" name="end"  value="End the contract" />
								@if(isset($proposal->contract) && $proposal->contract->ended_contract==0 && $proposal->contract->cancel_contract==0  && $proposal->terms_milestone!=2)
										@if( $proposal->terms_milestone==1 && $user_id==$proposal->user_id)
									
										@else
											<a href="javascript:void(0)" id="edit_terms" class='btn btn-primary'>Edit Terms</a>
										@endif
								@endif
								@if(isset($proposal->contract) && $proposal->contract->ended_contract==0 && $proposal->contract->cancel_contract==0)
									<a href="{!! URL::to('financial/cancel_contract').'?p_id='.$proposal->id !!}" class='cancel_job'>Cancel the job</a>
								@endif
								</h5></div>
						</div>
					</div>
					</form>
				@endif
			@endif

				</div>
			</div>
			
		
	</div>
	
	<!--Popup Model -->
	<div class="modalajaxwait"></div>
	<div id="modal_addmilestone" class="modal fade">
    <div class="modal-dialog" style="margin-top: 110px !important;" >
	
        <div class="modal-content">
		
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Milestone</h4>
            </div>
			{!! Form::open(array('route' => 'financial.saveMilestone', 'class' => 'form_milestone', 'method' => 'post')) !!}
            <div class="modal-body">
					<input type='hidden' name='proposal_id' value='{!! $proposal->id !!}' />
					<input type='hidden' name='contract_id' id="" value='@if(isset($proposal->contract->id)){!! $proposal->contract->id !!}@endif' />
					
					@if($user_id==$proposal->user_id)
						<input type='hidden' name='proposal_user' value='1' />
					@else
						<input type='hidden' name='job_user' value='1' />
					@endif
					
					<input type='hidden' name='job_id' value='{!! $proposal->job_id !!}' />
					<input type='hidden' name='milestone_id' id='milestone_id' class='empty_value' value='' />
                    <div class="form-group">
                        <label for="txtassignmenttext">Milestone</label>
                        <input type='text' class="form-control empty_value" name="label" id="label" placeholder="Milestone name" required="true"></input>
                    </div>
					
					<div class="form-group">
                        <label for="txtassignmenttext">Date</label>
                        <input type='text' class="form-control readonly empty_value" name="posted_date" placeholder="Finish Date" id="posted_date" required="true"></input>
                    </div>
					
					<div class="form-group">
                        <label for="txtassignmenttext">Amount</label>
                        <input type='text' class="form-control empty_value" name="amount" placeholder="Amount" id="amount" required="true" style='float:right;width:98%'></input>
						<span class="usd" style="margin-top: 6px; float: left;">$</span>
                    </div>

                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit"  class="btn btn-primary" value="Submit" />
            </div>
			</form>
        </div><!-- /.modal-content -->
		
    </div><!-- /.modal-dialog -->
</div><!-- modal -->


<div id="modal_add_fund_escrow" class="modal fade">
    <div class="modal-dialog" style="margin-top: 110px !important;" >
	
        <div class="modal-content">
		
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Add Fund to Escrow</h4>
            </div>
			{!! Form::open(array('route' => 'financial.saveEscrow', 'class' => 'form_escrow', 'method' => 'post')) !!}
            <div class="modal-body">
					<input type='hidden' name='proposal_id' value='{!! $proposal->id !!}' />
					<input type='hidden' name='job_id' value='{!! $proposal->job_id !!}' />
                    <div class="form-group">
                        <span>You have <strong>${!! $amount !!}</strong> in your account.</span>
                    </div>
					 <div class="form-group">
                        <span for="txtassignmenttext">Do you want to deposit to escrow from your account?</span>
						<input type='radio' name='deposit_for' value='yes' required="true" class="deposit_for" checked> Yes</input> <input type='radio' name='deposit_for' value='no' required="true" class="deposit_for"> No</input>
                    </div>
					@if(!count($credit_methods)==0)
			<div style='display:none' id='credit_card_show'>
						<h3>Credit cards</h3>
						<hr/>
				@foreach($credit_methods as $credit_method)
					
				<div class="form-group">
					<div class='row'>
					<div class='col-md-6'>
					<input type='radio' name='financial_accounts_id' value='{!! $credit_method->id !!}' checked /> {!! $credit_method->credit->modified_card_number !!}
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
<!--Popup Model -->

<!--Edit terms popup-->
<div id="modal_edit_terms" class="modal fade">
    <div class="modal-dialog" style="margin-top: 110px !important;" >
	
        <div class="modal-content">
		
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit terms</h4>
            </div>
			{!! Form::open(array('route' => 'financial.editTerms',  'method' => 'post')) !!}
            <div class="modal-body">
					<input type='hidden' name='contract_id' value='{!! $proposal->contract->id !!}' />
					<div class="form-group" style='margin-left:6px'>
                        <label for="txtassignmenttext">Edit terms:</label>
						<textarea rows="7" class="form-control" name="terms_condition" placeholder="" id="" required="true" style='display: inline;'>@if(isset($proposal->contract) && $proposal->contract->terms_condition=='')Once the freelancer completes the work and requests payment for a milestone, the client has 15 days to review the work and release funds from escrow.

Alternatively, the client can adjust the terms of the job or file a dispute. If no action is taken by day 30, funds held in escrow are released to the freelancer.@else {!!$proposal->contract->terms_condition!!} @endif</textarea>
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
<!--Edit terms popup-->

<!-- Release money from Escrow -->
<div id="modal_release_fund_escrow" class="modal fade">
    <div class="modal-dialog" style="margin-top: 110px !important;" >
	
        <div class="modal-content">
		
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Release Money</h4>
            </div>
			{!! Form::open(array('route' => 'financial.releaseEscrow', 'class' => 'form_release', 'method' => 'post')) !!}
            <div class="modal-body">
					<input type='hidden' name='proposal_id' value='{!! $proposal->id !!}' />
					<input type='hidden' name='job_id' value='{!! $proposal->job_id !!}' />
                    <div class="form-group">
                        <span>You have <strong>${!! $escrow_money !!}</strong> in Escrow for this job.</span>
                    </div>
					
					<div class="form-group">
                        <label for="txtassignmenttext">Amount:</label>
						<span class="usd" style="margin-top: 6px; ">$</span>
						<input type='text' class="form-control" name="amount" placeholder="Amount" id="amount" required="true" style='display: inline;width:40%'></input>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit"  class="btn btn-primary" value="Release" />
            </div>
			</form>
        </div><!-- /.modal-content -->
		
    </div><!-- /.modal-dialog -->
</div><!-- modal -->

<!-- send bonus -->
<div id="modal_release_fund_bonus" class="modal fade">
    <div class="modal-dialog" style="margin-top: 110px !important;" >
	
        <div class="modal-content">
		
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Send money as a bonus</h4>
            </div>
			{!! Form::open(array('route' => 'financial.releaseBonus', 'class' => 'form_bonus', 'method' => 'post')) !!}
            <div class="modal-body">
					<input type='hidden' name='proposal_id' value='{!! $proposal->id !!}' />
					<input type='hidden' name='job_id' value='{!! $proposal->job_id !!}' />
                    <div class="form-group">
                        <span>You have <strong>${!! $amount !!}</strong> in your account.</span>
                    </div>
				
					<div class="form-group">
                        <label for="txtassignmenttext">Amount:</label>
						<span class="usd" style="margin-top: 6px; ">$</span>
						<input type='text' class="form-control" name="amount" placeholder="Amount" id="amount" required="true" style='display: inline;width:40%'></input>
                    </div>
          </div>
				
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit"  class="btn btn-primary" value="Send Bonus" />
            </div>
			</form>
        </div><!-- /.modal-content -->
		
    </div><!-- /.modal-dialog -->
</div><!-- modal -->


<!-- Accept MIlestone popup -->
<div id="modal_accept_milestone" class="modal fade">
    <div class="modal-dialog" style="margin-top: 110px !important;" >
	
        <div class="modal-content">
		
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Accept Milestone</h4>
            </div>
			{!! Form::open(array('route' => 'financial.acceptMilestone', 'method' => 'post')) !!}
            <div class="modal-body">
					<input type="hidden" name="amount" id="popup_accept_milestone_amount" value="">
					<input type='hidden' name='m_id' id="popup_accept_milestone_id" value='' />
					<input type='hidden' name='proposal_id' id="popup_accept_proposal_id" value='' />
					<input type='hidden' name='job_id' value='{!! $proposal->job_id !!}' />
                    <div class="form-group">
                        <span>You have <strong>${!! $escrow_money !!}</strong> in your Escrow Account.</span>
                    </div>
				
					<div class="form-group">
                        You are releasing <span class="popup_release_accept_milestone_amount"></span> for this milestone.
                    </div>
          </div>
				
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit"  class="btn btn-primary" value="Accept Milestone" />
            </div>
			</form>
        </div><!-- /.modal-content -->
		
    </div><!-- /.modal-dialog -->
</div>
<!-- Accept MIlestone popup -->
<!--Popup Model -->

<!-- Add hours popup -->
 {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
<div id="modal_release_fund_showhours" class="modal fade">
    <div class="modal-dialog" style="margin-top: 110px !important;" >
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Show Hours</h4>
            </div>
				<input type='hidden' name='job_id' id="get_job_id" value='{!! $proposal->job_id !!}' />
					<input type='hidden' name='proposal_id' id="get_proposal_id" value='{!! $proposal->id !!}' />
					<input type='hidden' name='contract_id' id="get_contract_id" value='@if(isset($proposal->contract->id)){!! $proposal->contract->id !!}@endif' />
			  @if(count($proposal->projecthours)!=0)
					<table class="table table-bordered fetch_recoreds">
					 <tr>
					<td align="center"><b>Date</td>
					  <td align="center"><b>Hours</td>
					  <td align="center"><b>Task</td>
					 </tr>
				@foreach($proposal->projecthours as $projecthour)
                  <tr>
                    <td align="center">{{ $projecthour->modified_date }}</td>
                    <td align="center">{{ $projecthour->hours }}</td>
					<td align="center"><a href="javascript:void(0)" class='add_view_task' id="add_view_task{{$projecthour->id}}">View Task</a>
						
						 <div id="modal_release_view_task{{$projecthour->id}}" style="display: none" align = "center">
					<?php echo $projecthour['task']; ?>
				</div>
					</td>
                  </tr>
			 <script type="text/javascript">
    $(function () {
        $("#modal_release_view_task{{$projecthour->id}}").dialog({
            modal: true,
            autoOpen: false,
            title: "View Task",
            width: 300,
            height: 150
        });
        $("#add_view_task{{$projecthour->id}}").click(function () {
            $('#modal_release_view_task{{$projecthour->id}}').dialog('open');
        });
    });
</script>
 				@endforeach	
</table>
{!! $proposal->projecthours()->paginate()->render() !!}
@endif

<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                
            </div>
			
        </div><!-- /.modal-content -->
		
    </div><!-- /.modal-dialog -->
</div>


<div id="modal_release_log_hours" class="modal fade">
    <div class="modal-dialog" style="margin-top: 110px !important;">
	
        <div class="modal-content">
		
		
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Log Hours</h4>
            </div>
			
            {!! Form::open(array('route' => 'financial.log_hours', 'class' => 'form_release', 'method' => 'post')) !!}
	
			
 <div class="modal-body">

					<input type='hidden' name='job_id' value='{!! $proposal->job_id !!}' />
					
					<input type='hidden' name='proposal_id' value='{!! $proposal->id !!}' />
					<input type='hidden' name='contract_id' value='@if(isset($proposal->contract->id )){!! $proposal->contract->id !!}@endif' />					
<div class="form-group">

                        <label for="txtassignmenttext">Date:</label>
						<span class="usd" style="margin-top: 6px; "></span>
						<input type='text' class="form-control readonly empty_value" name="date" placeholder="Date" id="datepicker" value="{!! $proposal->date !!}" required style='display: inline;width:40%'></input>
 </div>
 						<div class="form-group">
						<label for="txtassignmenttext">Hours:</label>	
						<span class="usd" style="margin-top: 6px; "></span>
						<input type='number' class="form-control" name="hours" placeholder="hours" id="extra7" onkeypress="return isNumber(event)" value="{!! $proposal->hours !!}" style='display: inline;width:40%'></input>
						</div>
						

						<div class="form-group">
						<label for="txtassignmenttext">Task:</label>
						<span class="usd" style="margin-top: 6px; "></span>
						<textarea id="txtArea" class="form-control" name="task" placeholder="task" rows="5" cols="50" required style='display: inline;'></textarea>
						
						</div>
						</div>
           
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit"  class="btn btn-primary" value="Log Hours" />
            </div>
			</form>
        </div><!-- /.modal-content -->
		
    </div><!-- /.modal-dialog -->
</div>
<!-- Add hours finish -->


</div>
      </div>
      </div>
	  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	   
	    <script>
  $(function() {
    $( "#datepicker" ).datepicker({
      changeMonth: true,
      dateFormat: "yy-mm-dd",
      minDate: 0 ,
      changeYear: true
    });
  });
  </script>
  
  <script>
	$(document).ready(function() {
		var j=0
        $(document).on('click', '.pagination a', function (e) {
			var selector = '.pagination li';
			
			if(j==0){
				
				$('.pagination .active').html('<a href="{{ url("/") }}/financial/terms_milestone/?page=1">1</a>');
			}
			 $(selector).removeClass('active');
			 $(this).parent().addClass('active');
           getPosts($(this).attr('href').split('page=')[1]);
		   j++;
		  e.preventDefault();
        });
    });
	
	  function getPosts(page) {
    	job_id=$("#get_job_id").val();
    	proposal_id=$("#get_proposal_id").val();
    	contract_id=$("#get_contract_id").val();
		
    	
    	//alert(hours);
        $.ajax({
            url : 'release_Showhours?page_id='+page+'&job_id='+job_id+'&proposal_id='+proposal_id+ '&contract_id='+contract_id,	
            dataType: 'json',
        }).done(function (data) {

		
            $('.fetch_recoreds').html(data.projecthours);
            location.hash = page;
        })
    }
    </script>

	
	<script>
		 $( document ).ready(function() {
			 $(".readonly").keydown(function(e){
				e.preventDefault();
			});
			
		$(".reopen").click(function(){
            return confirm("Are you sure to reopen the contract?");
        });
		
		$(".delete").click(function(){
            return confirm("Are you sure to delete this milestone?");
        });
		
		$(".cancel_terms").click(function(){
            return confirm("Are you sure to not accepting terms & milestone?");
        });
		
		$(".cancel_job").click(function(){
            return confirm("Are you sure want to cancel the job?");
        });
		
		$(".request_money").click(function(){
            return confirm("Are you sure want to request the money?");
        });
		
		$(".declined_offer").click(function(){
            return confirm("Are you sure want to request the money?");
        });
		
		$(".end_contract").click(function(){
            return confirm("Are you sure want to end the contract?");
        });
		
		$(".accept_milestone").click(function(){
            //return confirm("Are you sure want to accept this milestone?");
        });
		
		$("#accept_milestone").click(function(){
			    milestone_id=$(this).attr('name');
				
				$('#popup_accept_milestone_amount').val($('.milestone_amount_'+milestone_id).val());
				$('.popup_release_accept_milestone_amount').html('<strong>$'+$('.milestone_amount_'+milestone_id).val()+'</strong>');
				$('#popup_accept_milestone_id').val($('.milestone_id_'+milestone_id).val());
				$('#popup_accept_proposal_id').val($('.proposal_id_accept_'+milestone_id).val());
				
				$('#modal_accept_milestone').modal('show');
        });
		
		$("#add_milestone").click(function(){
		   $('.form_milestone .empty_value').val('');
           $('#modal_addmilestone').modal('show');
        });
		
		$("#add_fund_escrow").click(function(){
           $('#modal_add_fund_escrow').modal('show');
        });
		
		 $("#add_release_showhours").click(function(){
           $('#modal_release_fund_showhours').modal('show');
        });
		
		$("#add_log_hours").click(function(){
           $('#modal_release_log_hours').modal('show');
        });
		
		$("#add_release_escrow").click(function(){
           $('#modal_release_fund_escrow').modal('show');
        });
		
		$(".close_job").click(function(){
            return confirm("Are you sure to close this job?");
        });
		
		$("#edit_terms").click(function(){
           $('#modal_edit_terms').modal('show');
        });
		
		$("#add_release_bonus").click(function(){
           $('#modal_release_fund_bonus').modal('show');
        });
		
		$(".deposit_for").click(function(){
			if($(this).val()=='no'){
				$('#credit_card_show').show();
			}else{
				$('#credit_card_show').hide();
			}
        });
		
			$('#posted_date').datepicker({
				dateFormat: 'yy-mm-dd',
				minDate: 0 
			});
		 });
		 
		 function edit_model(id){
			  $body = $("body");
			  $body.addClass("loading");
			  var data=id;
			  $.post("{!! URL::to('/financial/edit_getmilestone/') !!}"+"/"+data, function(response){
				if(response.success)
				{
					$('#label').val(response.label);	
					$('#posted_date').val(response.posted_date);
					$('#amount').val(response.amount);
					$('#milestone_id').val(id);
					$body.removeClass("loading");
					 
					$('#modal_addmilestone').modal('show');
					
				}
			}, 'json');
			return false;
		 }
		
	</script>
	
	  @stop