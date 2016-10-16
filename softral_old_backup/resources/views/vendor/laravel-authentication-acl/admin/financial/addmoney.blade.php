@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Admin area: Add Money
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        <?php $message = Session::get('message');
		?>
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
                        <div class='pull-left'><h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> Add Money</h3></div>
						<div class='pull-right'>You have <strong>US $ {!! $money !!}</strong> right now.</div>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                
					<div class="col-md-12 col-xs-12">
					
					<!-- Bank account -->
					<!--@if(!count($skrill_methods)==0)
						<h3>Skrill Accounts</h3>
						<hr/>
				@foreach($skrill_methods as $skrill_method)
					
				<div class="form-group">
				<iframe name="payment_{!! $skrill_method->id !!}" id="payment_{!! $skrill_method->id !!}" style='display:none;height:500px;width:100%'  ></iframe>
					<div class='row'>
					<div class='col-md-6'>
					{!! Form::label('Skrill account', 'Add money by Skrill:', ['class' => 'control-label']) !!}
					{!! $skrill_method->skrill_account !!} (<a href='javascript:void(0)' id='{!! $skrill_method->id !!}' class='skrill_withdraw'>Add</a>)
					</div>
					</div>
					
					{!! Form::open(array('route' => 'addmoneyskrill.save','class'=>'skrill_form', 'id' => 'skrill_form_'.$skrill_method->id,'method' => 'POST','style'=>'display:none')) !!}
					<input type='hidden' name='financial_accounts_id' value='{!! $skrill_method->id !!}' />
					<input type='hidden' name='financial_account_name' value='skrill_account' />
						<div class='row'>
						<div class='col-md-6'>
						<div class="col-md-4"><label class="control-label" >Available Balance</label></div> <div class="">US $ {!! $money !!}</div>
						</div>
						</div>
						<br/>
						<div class='row'>
						<div class='col-md-6'>
						<div class="col-md-4"><label class="control-label" >Add Amount</label></div><div class=""> US $ <input type='text' id='add_amount' class='add_amount' name='add_amount' required='true' /></div>
						</div>
						</div>
						
						<br/>
						<a target="payment_{!! $skrill_method->id !!}" href="{!! URL::route('addmoneyskrill.save',['skrill_id' => $skrill_method->id, '_token' => $code]) !!}" class="btn btn-primary click_payment" value="payment_{!! $skrill_method->id !!}" title='Add Money' >Add Money</a>
						<!--<input type='submit' name='submit' value='Add amount' class='btn btn-primary click_payment'> <a href="{{ URL::route('financial') }}" class='btn btn-default'>Cancel</a>
						 
					</form>
						
				</div>
				
				@endforeach
				@else
					You haven't added any skrill account. Please <a href="{{ URL::route('addskrill') }}">Add</a> Skrill method to withdraw amount.
					<hr/>
				@endif-->
			
				<!-- Credit card account -->
				@if(!count($credit_methods)==0)
						<h3>Credit cards</h3>
						<hr/>
				@foreach($credit_methods as $credit_method)
					
				<div class="form-group">
					<div class='row'>
					<div class='col-md-6'>
					{!! Form::label('Credit card', 'Add by Credit card:', ['class' => 'control-label']) !!}
					{!! $credit_method->credit->modified_card_number !!} (<a href='javascript:void(0)' id='{!! $credit_method->id !!}' class='skrill_withdraw'>Add</a>)
					</div>
					</div>
					
					{!! Form::open(array('route' => 'addmoneycredit.save','class'=>'skrill_form', 'id' => 'skrill_form_'.$credit_method->id,'method' => 'POST','style'=>'display:none','target'=>'_blank')) !!}
						<input type='hidden' name='financial_accounts_id' value='{!! $credit_method->id !!}' />
						<input type='hidden' name='financial_account_name' value='credit_card' />
						
						<div class='row'>
						<div class='col-md-6'>
						<div class="col-md-4"><label class="control-label" >Available Balance</label></div> <div class="">US $ {!! $money !!}</div>
						</div>
						</div>
						<br/>
						<div class='row'>
						<div class='col-md-6'>
						<div class="col-md-4"><label class="control-label" >Add Amount</label></div><div class=""> US $ <input type='text' id='withdraw_amount' class='withdraw_amount' name='add_amount' required='true' /></div>
						</div>
						</div>
						
						<br/>
						<input type='submit' name='submit_credit' value='Add money' class='btn btn-primary'> <a href="{{ URL::route('financial') }}" class='btn btn-default'>Cancel</a>
					</form>
						
				</div>
				
				@endforeach
				@else
					You haven't added any credit card. Please <a href="{{ URL::route('addcredit') }}">Add</a> Credit card to withdraw amount.
					<hr/>
				@endif
                    </div>
                </div>
                <div class="row">
                   
            </div>
        </div>
    </div>
</div>
{!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
<script>
$( document ).ready(function() {
 $(".skrill_withdraw").click(function(){
	 $('.skrill_form').hide();
	 var id=$(this).attr('id');
	$('#skrill_form_'+id).slideToggle( "slow", function() {
		
	});	 
			 });
			 
		$(".click_payment").click(function(){
			value=$(this).attr('value');
			var amount=$("#add_amount").val();
			var _href = $(this).attr("href"); 
			$(this).attr("href", _href + '&amount='+amount);
			$('#'+value).show();
		
		});
});
			 </script>
@stop
