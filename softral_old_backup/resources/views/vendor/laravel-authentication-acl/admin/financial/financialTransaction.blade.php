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
						<div class='pull-right'>You have <strong>US ${!! $money !!}</strong> right now.</div>
                    </div>
                </div>
            </div>
    <section class="panel">
	@if(!empty($all_transactions))
        <div class="panel-body">
		<?php $job_id=array(); ?>
		<table class="table table-condensed table-hover">
		<th>Project name</th>
		<th>Employer</th>
		<th>Freelancer</th>
		<th>Contract Amount</th>
		<th>Funded Amount</th>
		<th>Milestone Amount</th>
		<th>Payment Status</th>
		
		
		@foreach($all_transactions as $all_transactions1)
		<?php $i=1 ?>
			@foreach($all_transactions1 as $all_transaction)
			
			<tr>
				<td>@if(!in_array($all_transaction['job']['id'],$job_id))
					<strong>{{$all_transaction['job']['project_name']}}</strong> @endif
				<td>@if(!in_array($all_transaction['job']['id'],$job_id))<strong>{{$all_transaction['job']['user']['user_profile'][0]['first_name']}}</strong><br/>Account#:{{$all_transaction['job']['user']['id']}}@endif </td>
				<td>@if(!in_array($all_transaction['job']['id'],$job_id))<strong>{{$all_transaction['proposal']['user']['user_profile'][0]['first_name']}}</strong><br/>Account#:{{$all_transaction['proposal']['user']['id']}} @endif</td>
				<td>@if(!in_array($all_transaction['job']['id'],$job_id))${{$all_transaction['proposal']['client_amount']}}@endif</td>
				<td>
				@if($all_transaction->status==0)
					@if($i==1 && $all_transaction['escrow']['amount']!='')
						<strong>${{$all_transaction['escrow']['amount']}}</strong>
					<?php $i++ ?>
					@endif
				@endif
				</td>
				<td><strong>{{$all_transaction['label']}} - ${{$all_transaction['amount']}}</strong> <br/>({{$all_transaction['modified_posted_date']}})</td>
				<td>@if($all_transaction['status']==1) <strong>Paid</strong> <br/>({{$all_transaction['modified_updated_at']}}) @else Unpaid @endif
				<?php $job_id[]=$all_transaction['job']['id']; ?>
				</td>
			</tr>
		 
			@endforeach
		@endforeach
		</table>
        </div>
	@endif
    </section>
    <!--notification end-->
	@if(empty($all_transactions))
		   <div class="alert alert-success clearfix">
                <div class="notification-info">
					Sorry, No Transactions found.
				 </div>
			 </div>
	@endif
	
</div>
</div>

    
	  @stop