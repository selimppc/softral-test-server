@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Admin area: Financial Accounts
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
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                        <h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> Add Payee</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <!--<div class="col-md-12">
                       <form action="https://www.moneybookers.com/app/payment.pl" method="post" target="_blank">
					    <input type="hidden" name="payment_methods" value="VSA,">
						  <input type="hidden" name="logo_url" value="{!! URL::to('/') !!}/images/temp_logo.png"/>
						  <input type="hidden" name="pay_to_email" value="dhavaljani1992@gmail.com"/>
						  <input type="hidden" name="status_url" value="mailto:dhavaljani1990@gmail.com"/> 
						  <input type="hidden" name="language" value="EN"/>
						  <input type="hidden" name="amount" value="1"/>
						  <input type="hidden" name="currency" value="INR"/>
						 
						  <input type="hidden" name="detail1_description" value="Softral Payment"/>
						  <input type="hidden" name="detail1_text" value="This is payment by Softral PVT. LTD."/>
						  <input type="submit" value="Pay!"/>
						</form>
                    </div>-->
					
					<div class="col-md-12 col-xs-12">
                
				<div class="form-group">
					<div class='row'>
					<div class='col-md-12'>
					<h3>Skrill Accounts</h3>
					
					@foreach($skrill_accounts as $skrill_account)
					<div class='col-md-3'>
						{!! $skrill_account->skrill_account !!}
					</div>
					<div class='col-md-1'>
						<a href="{!! URL::route('myAccount.delete',['id' => $skrill_account->id, '_token' => csrf_token()]) !!}" class='delete_account'>Delete</a>
					</div>
						<br/>
					@endforeach
						<br/>
					<a href="{!! URL::route('addskrill') !!}" class='btn btn-primary'>Add Skrill Account</a>
					</div>
					</div>
					<hr/>
					<div class='row'>
					<div class='col-md-12'>
					<h3>Bank Accounts</h3>
					
					@foreach($bank_accounts as $bank_account)
					<div class='col-md-3'>
						{!! $bank_account->modified_account_number !!}
					</div>
					<div class='col-md-1'>
						<a href="{!! URL::route('myAccount.delete',['id' => $bank_account->financial->id, '_token' => csrf_token()]) !!}" class='delete_account'>Delete</a>
					</div>
						<br/>
					@endforeach
					<br/>
					<a href="{!! URL::route('addbank') !!}" class='btn btn-primary'>Add Bank Account</a>
					</div>
					</div>
					<hr/>
					<div class='row'>
					<div class='col-md-12'>
					<h3>Credit Cards</h3>
					
					@foreach($credit_accounts as $credit_account)
					<div class='col-md-3'>
						{!! $credit_account->modified_card_number !!}
					</div>
					<div class='col-md-1'>
						<a href="{!! URL::route('myAccount.delete',['id' => $credit_account->financial->id, '_token' => csrf_token()]) !!}" class='delete_account'>Delete</a>
					</div>
						<br/>
					@endforeach
					<br/>
					<a href="{!! URL::route('addcredit') !!}" class='btn btn-primary'>Add Credit Card</a>
					</div>
					</div>
					<hr/>
						<div class='row'>
					<div class='col-md-12'>
					<h3>Paypal Accounts</h3>
					
					@foreach($paypal_accounts as $paypal_account)
				
					<div class='col-md-3'>
					
						{!! $paypal_account->paypal_account !!}
					</div>
					<div class='col-md-1'>
						<a href="{!! URL::route('myAccount.delete',['id' => $paypal_account->id, '_token' => csrf_token()]) !!}" class='delete_account'>Delete</a>
					</div>
						<br/>
					@endforeach
						<br/>
					<a href="{!! URL::route('addpaypal') !!}" class='btn btn-primary'>Add Paypal Account</a>
					</div>
					</div>
					
					
				</div>
			
                    </div>
                </div>
                <div class="row">
                   
            </div>
        </div>
    </div>
</div>
 {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
  <script>
      
	$(function() {
         $(".delete_account").click(function(){
            return confirm("Are you sure to delete this item?");
        });
		
    });
	
    </script>

@stop
