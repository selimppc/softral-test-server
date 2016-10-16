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
                        <h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> Add Credit Card</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
             
					<div class="col-md-8 col-xs-8">
                
					{!! Form::open(array('route' => 'credit.save', 'class' => 'form','method' => 'POST')) !!}
				
				<div class="form-group">
					<div class='row'>
					<div class='col-md-6'>
					{!! Form::label('Credit card', 'Credit card: *', ['class' => 'control-label','style'=>'display:block']) !!}
					{!! Form::text('card_number', NULL, ['class' => 'form-control','placeholder'=>'Credit card','style'=>'width:90%;display:inline']) !!} 
					</div>
					
					<div class='col-md-6'>
					{!! Form::label('Your name on the card', 'Your name on the card: *', ['class' => 'control-label','style'=>'display:block']) !!}
					{!! Form::text('person_name', NULL, ['class' => 'form-control','placeholder'=>'Your name on the card','style'=>'width:90%;display:inline']) !!} 
					</div>
					
					</div>
				</div>	
				
				<div class="form-group">
					<div class='row'>
					<div class='col-md-6'>
					{!! Form::label('Expire month', 'Expire month: *', ['class' => 'control-label','style'=>'display:block']) !!}
					{!! Form::select('exp_month',array('01'=>'01','02'=>'02','03'=>'03','04'=>'04','05'=>'05','06'=>'06','07'=>'07','08'=>'08','09'=>'09','10'=>'10','11'=>'11','12'=>'12'), NULL, ['class' => 'form-control','placeholder'=>'Expire month','style'=>'width:90%;display:inline']) !!} 
					</div>
					
					<div class='col-md-6'>
					{!! Form::label('Expire year', 'Expire year:', ['class' => 'control-label','style'=>'display:block']) !!}
					{!! Form::select('exp_year',$years, NULL, ['class' => 'form-control','placeholder'=>'Expire year','style'=>'width:90%;display:inline']) !!} 
					</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class='row'>
					<div class='col-md-12'>
					{!! Form::label('Security code', 'Security code: * (Last 3 digits behind your credit card)', ['class' => 'control-label','style'=>'display:block']) !!}
					{!! Form::text('security_code', NULL, ['class' => 'form-control','placeholder'=>'Security code','style'=>'width:43%;display:inline']) !!} 
					</div>
				
					</div>
				</div>
				
				<h3>Billing Details</h3>
				<hr/>
				
				<div class="form-group">
					<div class='row'>
					<div class='col-md-12'>
					{!! Form::label('Address', 'Address: *', ['class' => 'control-label','style'=>'display:block']) !!}
					{!! Form::textarea('address', NULL, ['cols'=>10,'rows'=>5,'class' => 'form-control','placeholder'=>'Address','style'=>'width:90%;display:inline']) !!} 
					</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class='row'>
					<div class='col-md-6'>
					{!! Form::label('Country', 'Country: *', ['class' => 'control-label','style'=>'display:block']) !!}
					{!! Form::select('country',$countries, NULL, ['class' => 'form-control','placeholder'=>'Country','style'=>'width:90%;display:inline']) !!} 
					</div>
				
					<div class='col-md-6'>
					{!! Form::label('State', 'State: *', ['class' => 'control-label','style'=>'display:block']) !!}
					{!! Form::text('state', NULL, ['class' => 'form-control','placeholder'=>'State','style'=>'width:90%;display:inline']) !!} 
					</div>
					
					</div>
				</div>
				
				<div class="form-group">
					<div class='row'>
			
					<div class='col-md-6'>
					{!! Form::label('City', 'City: *', ['class' => 'control-label','style'=>'display:block']) !!}
					{!! Form::text('city', NULL, ['class' => 'form-control','placeholder'=>'City','style'=>'width:90%;display:inline']) !!} 
					</div>
					
					<div class='col-md-6'>
					{!! Form::label('Zip code', 'Zip code: *', ['class' => 'control-label','style'=>'display:block']) !!}
					{!! Form::text('zipcode', NULL, ['class' => 'form-control','placeholder'=>'Zip code','style'=>'width:90%;display:inline']) !!} 
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
