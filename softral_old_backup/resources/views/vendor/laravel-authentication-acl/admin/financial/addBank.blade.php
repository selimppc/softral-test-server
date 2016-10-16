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
                        <h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> Add Bank Account</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
             
					<div class="col-md-8 col-xs-8">
                
					{!! Form::open(array('route' => 'bank.save', 'class' => 'form','method' => 'POST')) !!}
				
				<div class="form-group">
					<div class='row'>
					<div class='col-md-6'>
					{!! Form::label('Bank name', 'Bank name: *', ['class' => 'control-label','style'=>'display:block']) !!}
					{!! Form::text('bank_account', NULL, ['class' => 'form-control','placeholder'=>'Bank name','style'=>'width:90%;display:inline']) !!} 
					</div>
					
					<div class='col-md-6'>
					{!! Form::label('Account name', 'Account name: *', ['class' => 'control-label','style'=>'display:block']) !!}
					{!! Form::text('account_name', NULL, ['class' => 'form-control','placeholder'=>'Account name','style'=>'width:90%;display:inline']) !!} 
					</div>
					</div>
				</div>	
			
				<div class="form-group">
					<div class='row'>
					<div class='col-md-6'>
					{!! Form::label('Account number', 'Account number: *', ['class' => 'control-label','style'=>'display:block']) !!}
					{!! Form::text('account_number', NULL, ['class' => 'form-control','placeholder'=>'Account number','style'=>'width:90%;display:inline']) !!} 
					</div>
					
					<div class='col-md-6'>
					{!! Form::label('Branch name', 'Branch name:', ['class' => 'control-label','style'=>'display:block']) !!}
					{!! Form::text('branch_name', NULL, ['class' => 'form-control','placeholder'=>'Branch name','style'=>'width:90%;display:inline']) !!} 
					</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class='row'>
					<div class='col-md-6'>
					{!! Form::label('Swift code', 'Swift code:', ['class' => 'control-label','style'=>'display:block']) !!}
					{!! Form::text('swift_code', NULL, ['class' => 'form-control','placeholder'=>'Swift code','style'=>'width:90%;display:inline']) !!} 
					</div>
					
					<div class='col-md-6'>
					{!! Form::label('IBAN code', 'IBAN code:', ['class' => 'control-label','style'=>'display:block']) !!}
					{!! Form::text('iban_code', NULL, ['class' => 'form-control','placeholder'=>'IBAN code','style'=>'width:90%;display:inline']) !!} 
					</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class='row'>
					<div class='col-md-6'>
					{!! Form::label('IFSC code', 'IFSC code(For India Purpose Only):', ['class' => 'control-label','style'=>'display:block']) !!}
					{!! Form::text('ifsc_code', NULL, ['class' => 'form-control','placeholder'=>'IFSC code','style'=>'width:90%;display:inline']) !!} 
					</div>
					
					<div class='col-md-6'>
					{!! Form::label('Routing Number *', 'Routing Number:', ['class' => 'control-label','style'=>'display:block']) !!}
					{!! Form::text('routing_number', NULL, ['class' => 'form-control','placeholder'=>'Routing Number','style'=>'width:90%;display:inline']) !!} 
					</div>
					</div>
				</div>
				
			
				<div class="form-group">
					<div class='row'>
					<div class='col-md-12'>
					{!! Form::label('Your address', 'Your address: *', ['class' => 'control-label','style'=>'display:block']) !!}
					{!! Form::textarea('recipient_address', NULL, ['cols'=>10,'rows'=>5,'class' => 'form-control','placeholder'=>'Your address','style'=>'width:90%;display:inline']) !!} 
					</div>
					
					</div>
				</div>
				<a href="{!! URL::route('financial') !!}" class='btn btn-primary'>Back</a>
				{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
				 
				{!! Form::close() !!}
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
