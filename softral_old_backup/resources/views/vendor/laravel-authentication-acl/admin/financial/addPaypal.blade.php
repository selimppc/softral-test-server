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
                        <h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> Add Paypal Account</h3>
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
	<!-- to add left menu in view file add link to  -->
					<div class="col-md-12 col-xs-12">
                
					{!! Form::open(array('route' => 'paypal.save', 'class' => 'form','method' => 'POST')) !!}
				
				<div class="form-group">
					<div class='row'>
					<div class='col-md-6'>
					{!! Form::label('Paypal account', 'Paypal ID: *', ['class' => 'control-label','style'=>'display:block']) !!}
					{!! Form::text('paypal_account', NULL, ['class' => 'form-control','placeholder'=>'Paypal username','style'=>'width:90%;display:inline']) !!} 
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

