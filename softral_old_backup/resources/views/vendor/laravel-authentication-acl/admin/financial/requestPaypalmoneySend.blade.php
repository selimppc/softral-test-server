@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('content')

{!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
  <script type='text/javascript'>
   $(function() {
	   $body = $("body");
	   $body.addClass("loading");
       $("#paypal_id").submit();
	   $('.loading').hide();
    });

	
    </script>
     <script src="https://www.paypalobjects.com/js/external/apdg.js" type="text/javascript"></script>
<!--

//-->
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
                @if($errors && ! $errors->isEmpty())
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
                      <!--   <form action="https://www.paypal.com/cgi-bin/webscr" method="post" id='paypal_id'>
					    <input type="hidden" name="payment_methods" value="ACC">
						  <input type="hidden" name="logo_url" value="{!! URL::to('/') !!}/images/temp_logo.png"/>
						  <!--<input type="hidden" name="transaction_id" value="{!! $send_money->id !!}">-->
						 
						  <!-- For paypal account -->
						  
                          <!--  -<input type="hidden" name="pay_to_email" value="{!! $send_money->financial_account->paypal_account !!}"/>
						  <input type="hidden" name="pay_from_email" value="{!! Config::get('constants.Paypal_account') !!}">
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
						</form>-->
						
						
						<form action="https://www.paypal.com/cgi-bin/webscr" method="post"  target="PPDGFrame" class="standard" id='paypal_id' accept-charset="utf-8">
						<input type="hidden" name="cmd" value="_cart">
						<input type="hidden" name="upload" value="1">
						<input type="hidden" name="business" value="{!! $send_money->financial_account->paypal_account !!}">
						<!--  -->
					    <input type="hidden" name="item_number_1" value="1"/>
                        <input type="hidden" name="item_name_1" value="Transfer"/>
                      <!--   <input type="hidden" name="rm" value="2"/>
                        <input type="hidden" name="test_ipn" value="1" />-->
                        <input id="type" type="hidden" name="expType" value="mini">
						<input type="hidden" name="amount_1" value="{!! $send_money->withdraw_amount !!}">
						<input type="hidden" name="buyer_credit_promo_code" value="">
						<input type="hidden" name="buyer_credit_product_category" value="">
						<input type="hidden" name="email" value="usdoc24@yahoo.com">
						<!-- {!! Config::get('constants.Paypal_account')  !!} -->
						<input type="hidden" name="buyer_credit_user_address_change" value="">
						<input type="hidden" name="no_shipping" value="0">
						<input type="hidden" name="no_note" value="1">
						<input type="hidden" name="currency_code" value="USD">
						<input type="hidden" name="lc" value="US">
						<input type='hidden' name='cancel_return' value='http://example.com/cancel.php'>
                        <input type='hidden' name='return' value='http://softral.com/admin/financial/requestMoney/getDone'>
						<input type="hidden" name="detail1_description" value="Softral Payment"/>
						<input type="image" src="https://www.paypal.com/en_US/i/btn/btn_paynowCC_LG.gif" border="0" name="submit" alt="Make payments with PayPal - it's fast, free and secure!">

                        <img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1">
						<input type="hidden" name="bn" value="PP-BuyNowBF">
						<input type="submit" value="Pay!"/>
						
						</form>
						<script type="text/javascript" charset="utf-8">
                        var returnFromPayPal = function(){
                        alert("Returned from PayPal");
 
                              }
                          var dgFlowMini = new PAYPAL.apps.DGFlowMini({trigger: 'submitBtn', expType: 'mini', callbackFunction: 'returnFromPayPal'});
                        </script>
						 
                    </div>
          </div>
          </div>
            </div>
         
        </div>
</div>
</div>
 
@stop

