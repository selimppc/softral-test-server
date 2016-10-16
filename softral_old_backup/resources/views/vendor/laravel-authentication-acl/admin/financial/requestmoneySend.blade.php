@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('content')

{!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
  <script type='text/javascript'>
   $(function() {
	   $body = $("body");
	   $body.addClass("loading");
       $("#moneybooker_id").submit();
    });

	
    </script>
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
			<h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> Send Money to {!! $send_money->user->user_profile[0]->first_name !!}</h3>
			</div>
			<div class="modalajaxwait"></div>
    <div class="panel-body">
                <div class="col-md-12">
              <div class="col-md-12">
                       <form action="https://www.moneybookers.com/app/payment.pl" method="post" id='moneybooker_id'>
					    <input type="hidden" name="payment_methods" value="ACC">
						  <input type="hidden" name="logo_url" value="{!! URL::to('/') !!}/images/temp_logo.png"/>
						  <!--<input type="hidden" name="transaction_id" value="{!! $send_money->id !!}">-->
						  <input type="hidden" name="pay_to_email" value="{!! $send_money->financial_account->skrill_account !!}"/>
						  <input type="hidden" name="pay_from_email" value="{!! Config::get('constants.Skrill_account') !!}">
						  <input type="hidden" name="return_url" value="{!! URL::route('requestMoney',['confirm' => 'true','transaction_id'=>$send_money->id]) !!}">

						  <input type="hidden" name="status_url" value="{!! $admin_email !!}"/> 
						  <input type="hidden" name="cancel_url" value="{!! URL::route('requestMoney') !!}"/> 
						  <input type="hidden" name="language" value="EN"/> 
						  <input type="hidden" name="amount" value="{!! $send_money->withdraw_amount !!}"/>
						  <input type="hidden" name="currency" value="USD"/>
						  <input type="hidden" name="detail1_description" value="Softral Payment"/>
						  <input type="hidden" name="detail1_text" value="This is payment by Softral PVT. LTD."/>
						  <input type="hidden" name="confirmation_note" value="You have successfully sent a payment to the Employer.">
						  <input type="submit" value="Pay!"/>
						</form>
						 
                    </div>
          </div>
          </div>
            </div>
         
        </div>
</div>
</div>
 
@stop
