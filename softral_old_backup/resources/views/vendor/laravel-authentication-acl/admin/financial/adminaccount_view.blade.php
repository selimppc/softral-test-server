@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Admin area: Account detail
@stop

@section('content')
<div class="row">
    <div class="col-md-12">
            <div class="col-md-12">
                {{-- print messages --}}
                <?php $message = Session::get('message'); ?>
                @if( isset($message) )
                    <div class="alert alert-success">{!! $message !!}</div>
                @endif
                {{-- print errors --}}
                @if($errors && ! $errors->isEmpty() )
                    @foreach($errors->all() as $error)
                        <div class="alert alert-danger">{!! $error !!}</div>
                    @endforeach
                @endif
                {{-- user lists --}}
				<div class="panel panel-info">
			<div class="panel-heading">
			<h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> {!! 'View Account : '.$account_view->user->user_profile[0]->first_name !!}</h3>
			</div>
    <div class="panel-body">
                <div class="col-md-12">
             <div id="section1">
                <h5><strong>Account Type</strong> : @if($account_view->skrill_account!='') 
									Skrill
									@elseif($account_view->bank_account!='')
									Bank 
									@elseif($account_view->person_name!='')
									Credit card
									@endif</h5>
            </div>
            <hr> 
			<div id="section1">
                <h5><strong>Account holder </strong> :  @if($account_view->skrill_account!='') 
									{!! $account_view->skrill_account !!}
									@elseif($account_view->bank_account!='')
									{!! $account_view->bank_account !!}
									@elseif($account_view->person_name!='')
									{!! $account_view->person_name !!}
									@endif</h5>
            </div>
            <hr>
			
			<div id="section2">
                <h5><strong>User full name</strong> :{!! $account_view->user->user_profile[0]->first_name !!} {!! $account_view->user->user_profile[0]->last_name !!}</h5>
            </div>
            <hr> 
			
			<div id="section2">
                <h5><strong>User Email address</strong> :{!! $account_view->user->email !!}</h5>
            </div>
            <hr> 
			
			@if($account_view->bank_account!='')
            <div id="section2">
                <h5><strong>Account number</strong> :{!! $account_view->bank->modified_account_number !!}</h5>
            </div>
            <hr> 
			<div id="section2">
                <h5><strong>Branch name</strong> :{!! $account_view->bank->branch_name !!}</h5>
            </div>
            <hr>
			<div id="section2">
                <h5><strong>Account name</strong> :{!! $account_view->bank->account_name !!}</h5>
            </div>
            <hr>
			<div id="section2">
                <h5><strong>Address</strong> :{!! $account_view->bank->recipient_address !!}</h5>
            </div>
            <hr>
			<div id="section2">
                <h5><strong>Swift code</strong> :{!! $account_view->bank->swift_code !!}</h5>
            </div>
			<div id="section2">
                <h5><strong>Routing number</strong> :{!! $account_view->bank->modified_routing_number !!}</h5>
            </div>
            <hr>
			<div id="section2">
                <h5><strong>IBAN code</strong> :{!! $account_view->bank->iban_code !!}</h5>
            </div>
            <hr>
			<div id="section2">
                <h5><strong>IFSC code</strong> :{!! $account_view->bank->ifsc_code !!}</h5>
            </div>
            <hr>
			@endif
			
			@if($account_view->person_name!='')
			<h3> Shipping Address</h3>
			<hr>
            <div id="section2">
                <h5><strong>Card number</strong> :{!! $account_view->credit->modified_card_number !!}</h5>
            </div>
            <hr> 
			<div id="section2">
                <h5><strong>Expired month</strong> :{!! $account_view->credit->modified_expired_month !!}</h5>
            </div>
            <hr>
			<div id="section2">
                <h5><strong>Expired year</strong> :{!! $account_view->credit->modified_expired_year !!}</h5>
            </div>
            <hr>
			<div id="section2">
                <h5><strong>Security code</strong> :{!! $account_view->credit->modified_security_code !!}</h5>
            </div>
            <hr>
			<div id="section2">
                <h5><strong>Country</strong> :{!! $account_view->credit->country !!}</h5>
            </div>
            <hr>
			<div id="section2">
                <h5><strong>Shipping address</strong> :{!! $account_view->credit->address !!}</h5>
            </div>
            <hr>
			<div id="section2">
                <h5><strong>State</strong> :{!! $account_view->credit->state !!}</h5>
            </div>
            <hr>			
			<div id="section2">
                <h5><strong>City</strong> :{!! $account_view->credit->city !!}</h5>
            </div>
            <hr>
			<div id="section2">
                <h5><strong>Zipcode</strong> :{!! $account_view->credit->zipcode !!}</h5>
            </div>
            <hr>
			@endif
			
			
			<div id="section2">
                <h5><strong>Created at:</strong> : {!! $account_view->created_at !!}</h5>
            </div>
            <hr>
			
          </div>
          </div>
            </div>
         
        </div>
</div>
</div>
@stop

@section('footer_scripts')
  
@stop