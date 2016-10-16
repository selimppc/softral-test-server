@extends('laravel-authentication-acl::admin.layouts.base-2cols')
@section('title')
Softral Job - Financial Transactions
@stop
@section('content')
<div class="row">
    <div class="col-md-12">
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
    <!--notification start-->
	  <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                        <div class='pull-left'><h3 class="panel-title bariol-thin"><i class="fa fa-bell-o"></i> Financial Transactions</h3></div>
						<div class='pull-right'>You have <strong>US $ {!! $money !!}</strong> right now.</div>
                    </div>
                </div>
            </div>
    <section class="panel">
        <div class="panel-body">
		
		@foreach($all_transactions as $all_transaction)
		
		 @if(($all_transaction->financial_account_name=='escrow' && $all_transaction->job_id!='0' && $user_id==$all_transaction->user_id) || ($all_transaction->financial_account_name=='release' && $user_id==$all_transaction->proposal_selected_id ) || ($all_transaction->financial_account_name=='release' && $user_id==$all_transaction->user_id ) || ($all_transaction->financial_account_name=='credit_card' && $user_id==$all_transaction->user_id ) || ($all_transaction->financial_account_name=='bank_account' && $user_id==$all_transaction->user_id ) || ($all_transaction->financial_account_name=='bonus' && $all_transaction->job_id!='0' ) || ($all_transaction->financial_account_name=='skrill_account' && $all_transaction->user_id!='1' && $user_id==$all_transaction->user_id) || ($all_transaction->financial_account_name=='paypal_account' && $all_transaction->user_id!='1' && $user_id==$all_transaction->user_id))
            <div class="alert alert-success clearfix">
                <div class="notification-info" style='margin-left: -51px;'>
                    <ul class="clearfix notification-meta">
					 <div class="col-md-1">
						#{!! $all_transaction->id !!}
					 </div>
					  <div class="col-md-7">
                        <li class="pull-left notification-sender"><span>
						@if($all_transaction->financial_account_name=='escrow' && $all_transaction->job_id!='0' && $all_transaction->user_id!='1') 
							@if($user_id==$all_transaction->user_id)
								You have escrowed money for the 
							@else
								{!! $all_transaction->job->user->user_profile[0]->first_name !!} has escrowed money for the 
							@endif
							<a href="{!! URL::to('/') !!}/job/{!! $all_transaction->job->slug !!}" target='_blank'>{!! $all_transaction->job->project_name !!}</a>
						@elseif($all_transaction->financial_account_name=='release' && $all_transaction->job_id!='0' && $all_transaction->user_id!='1')
							@if($user_id==$all_transaction->user_id)
								{!! $all_transaction->job->user->user_profile[0]->first_name !!} has released money for the 
							@else
								You have released money for the 
							@endif
							<a href="{!! URL::to('/') !!}/job/{!! $all_transaction->job->slug !!}" target='_blank'>{!! $all_transaction->job->project_name !!}</a>
						@elseif($all_transaction->financial_account_name=='bonus' && $all_transaction->job_id!='0' && $all_transaction->user_id!='1')
							@if($user_id==$all_transaction->user_id)
								{!! $all_transaction->job->user->user_profile[0]->first_name !!} has sent money as a bonus for the
							@else
								You have sent money as a bonus for the
							@endif
							<a href="{!! URL::to('/') !!}/job/{!! $all_transaction->job->slug !!}" target='_blank'>{!! $all_transaction->job->project_name !!}</a>
						@elseif($all_transaction->financial_account_name=='credit_card' && $all_transaction->user_id!='1')
							@if($user_id==$all_transaction->user_id)
								You have add money to your account using Credit card
							@endif
						@elseif($all_transaction->financial_account_name=='skrill_account' && $all_transaction->user_id!='1')
							@if($user_id==$all_transaction->user_id)
								You have withdrawn money to your account using Skrill
							@endif
						@elseif($all_transaction->financial_account_name=='paypal_account' && $all_transaction->user_id!='1')
							@if($user_id==$all_transaction->user_id)
								You have withdrawn money to your account using Paypal
							@endif
						@elseif($all_transaction->financial_account_name=='bank_account' && $all_transaction->user_id!='1')
							@if($user_id==$all_transaction->user_id)
								You have withdrawn money to your account Via Bank account
							@endif
						@elseif($user_id==$all_transaction->proposal_selected_id && $all_transaction->user_id==1)
								Softral fee @if($all_transaction->job_id!='0') for the <a href="{!! URL::to('/') !!}/job/{!! $all_transaction->job->slug !!}" target='_blank'>{!! $all_transaction->job->project_name !!}</a>	 @endif	
						@elseif($all_transaction->user_id==1)
								Your Admin Employer Fee @if($all_transaction->job_id!='0') for the <a href="{!! URL::to('/') !!}/job/{!! $all_transaction->job->slug !!}" target='_blank'>{!! $all_transaction->job->project_name !!}</a>	 @endif	
						@endif
						</li>
					</div>	
					 <div class="col-md-2">
						<li class="notification-time" style='list-style-type: none;'>
						@if($all_transaction->financial_account_name=='bank_account' && $all_transaction->user_id!='1')
							${!! $all_transaction->modified_withdraw_amount !!}
						@elseif($all_transaction->financial_account_name=='skrill_account' && $all_transaction->user_id!='1')
							${!! $all_transaction->modified_withdraw_amount !!}
						@elseif($all_transaction->financial_account_name=='paypal_account' && $all_transaction->user_id!='1')
							${!! $all_transaction->modified_withdraw_amount !!}
						@else
							${!! $all_transaction->modified_add_amount !!}
						@endif
						</li>
					</div>
					<div class="col-md-2">
                        <li class="pull-right notification-time" style='list-style-type: none;'>{!! $all_transaction->created_at !!}</li>
                    </ul>
                </div>
            </div>
			@endif
		@endforeach
			
        </div>
    </section>
    <!--notification end-->
	@if(empty($all_transactions))
		   <div class="alert alert-success clearfix">
                <div class="notification-info" style='margin-left: -51px;'>
					Sorry, No Transactions found.
				 </div>
			 </div>
	@endif
	
</div>
</div>

    
	  @stop