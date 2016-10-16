@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Admin area: All Users Financial Accounts
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
			<h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> {!! Input::all() ? 'Search results:' : 'Requested Money by Users' !!}</h3>
			</div>
    <div class="panel-body">
                <div class="col-md-12">
              @if(! $moneys->isEmpty() )
              <table class="table table-hover" id="users-table">
                      <thead>
                          <tr>
                              <th style='display:none'>ID</th>
                              <th>User name</th>
                              <th>User email</th>
                               <th>Account type</th>
                               <th style='width:97px'>Amount</th>
							   <th>Status</th>
                               <th>Created at</th>
                               <th>Operations</th>
                               
                          </tr>
                      </thead>
                      <tbody>
                         @foreach($moneys as $money)
                          <tr>
							   <td style='display:none'>{!! $money->id !!}</td>
                              <td>{!! $money->user->user_profile[0]->first_name !!}</td>
                              <td>{!! $money->user->email !!}</td>
                              <td><?php echo str_replace('_',' ',$money->financial_account_name); ?></td>
                              <td>${!! $money->modified_withdraw_amount !!}</td>
                              <td>@if($money->completed==0)<font color='red'>Unpaid @else <font color='green'>Paid @endif</font></td>
                              <td>{!! $money->created_at !!}</td>
							 
                             <td> 
							 @if(isset( $money->financial_account->id))
								<a href="{!! URL::route('adminaccount.view',['id' => $money->financial_account->id, '_token' => csrf_token()]) !!}" class="margin-left-5" title='View Account'><i class="glyphicon glyphicon-eye-open fa-2x"></i></a>
							 @endif
							 @if($money->completed==0)
								@if(isset($money->financial_account->skrill_account) && $money->financial_account->skrill_account!='')
								 <a target="payment_{!! $money->id !!}" href="{!! URL::route('requestmoney.send',['id' => $money->id, '_token' => csrf_token()]) !!}" class="click_payment" value="payment_{!! $money->id !!}" title='Send Money' ><i class="fa fa-send fa-2x"></i></a>
								@elseif(isset($money->financial_account->paypal_account) && $money->financial_account->paypal_account!='')
                                  <a target="payment_{!! $money->id !!}" href="{!! URL::route('requestPaypalmoney.send',['id' => $money->id, '_token' => csrf_token()]) !!}" class="click_payment" value="payment_{!! $money->id !!}" title='Send Money' ><i class="fa fa-send fa-2x"></i></a>
								 @endif
							@else
								<i class="glyphicon glyphicon-ok fa-2x" style='color:green'></i>
							@endif
								 <a href="{!! URL::route('requestMoney.delete',['id' => $money->id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x" title='Delete Account'></i></a>
							 </td>
                          </tr> 
						  <iframe name="payment_{!! $money->id !!}" id="payment_{!! $money->id !!}" style='display:none;height:500px;width:100%'  ></iframe>
						@endforeach
					    </tbody>
              </table>
            
              @else
                  <span class="text-warning"><h5>No results found.</h5></span>
              @endif
          </div>
          </div>
            </div>
         
        </div>
</div>
</div>
 {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
  <script type='text/javascript'>
   $(function() {
        $(".delete").click(function(){
            return confirm("Are you sure to delete this item?");
        });
		
		
        $('#users-table').DataTable({
            "order": [[ 0, "desc" ]]
        });
		
		$(".click_payment").click(function(){
			value=$(this).attr('value');
			$('#'+value).show();
			
		});
    });
	
    </script>
@stop

