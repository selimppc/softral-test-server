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
                        <div class='pull-left'><h3 class="panel-title bariol-thin"><i class="fa fa-bell-o"></i> Financial Activity</h3></div>
						<div class='pull-right'>You have <strong>US ${!! $money !!}</strong> right now.</div>
                    </div>
                </div>
            </div>
			<br>
      	<section class="panel transcation_dt">
        	<div class="row">
            	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                	<table class="vertical">
                    	<tbody>
							<th>Transcation number</th>
                        	<th>Job name</th>
                        	<th>Contract</th>
                            <th>Date/Time</th>
                            <th>Payment</th>
                        </tbody>
						
					@foreach($all_transactions as $transaction)
                        <tr>
							<td>#{{$transaction['id']}}</td>
							<td>{{$transaction['job']['project_name']}} @if($transaction['user_id']==1) <b>(Softral Service Fee)</b> @endif</td>
                        	<td>
							
					 @if($transaction['withdraw_amount']!=0)
							Withdraw through {{ str_replace('_',' ',$transaction['financial_account_name'])}} by You
					 @elseif($transaction['financial_account_name']=='credit_card' || $transaction['financial_account_name']=='paypal_account')
						    Deposit through {{ str_replace('_',' ',$transaction['financial_account_name'])}} by You
					 @else
						 {{$transaction['financial_account_name']}}
							@if($transaction['user_id']==$user_id) by <u>{{$transaction['job']['user']['user_profile'][0]['first_name']}}</u>
							@elseif($transaction['user_id']==1) to <u> Softral</u>
							 @else to  <u>  {{$transaction['user']['user_profile'][0]['first_name']}} @endif</u>
							 
					 @endif
					</td>
                            <td>{{$transaction['created_at']}}</td>
                            <td>$@if($transaction['withdraw_amount']!=0){{$transaction['withdraw_amount']}} @else{{$transaction['add_amount']}} @endif</td>
                        </tr>
					@endforeach
                        
                    </table>
                </div>
               
            </div>
        </section> 
		<center>{!! $all_transactions->setPath('')->render() !!}</center>
    <!--notification end-->
	@if(count($all_transactions)==0)
		   <div class="alert alert-success clearfix">
                <div class="notification-info">
					Sorry, No Transactions found.
				 </div>
			 </div>
	@endif
	
</div>
</div>

    
	  @stop