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
			<h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> {!! Input::all() ? 'Search results:' : 'All Financial Accounts' !!}</h3>
			</div>
    <div class="panel-body">
                <div class="col-md-12">
              @if(! $accounts->isEmpty() )
              <table class="table table-hover" id="users-table">
                      <thead>
                          <tr>
                              <th>ID</th>
                              <th>User name</th>
                              <th>User email</th>
                               <th>Account type</th>
                               <th style='width:97px'>Credential</th>
                               <th>Created at</th>
                               <th>Details</th>
                               <th>Operations</th>
                          </tr>
                      </thead>
                      <tbody>
                         @foreach($accounts as $account)
                          <tr>
							<td>{!! $account->id !!}</td>
                              <td>{!! $account->user->user_profile[0]->first_name !!}</td>
                              <td>{!! $account->user->email !!}</td>
							  
                              <td>@if($account->skrill_account!='') 
									Skrill
									@elseif($account->bank_account!='')
									Bank 
									@elseif($account->person_name!='')
									Credit card
									@endif
							  </td>
							  
                             <td>@if($account->skrill_account!='') 
									{!! $account->skrill_account !!}
									@elseif($account->bank_account!='')
									{!! $account->bank_account !!}
									@elseif($account->person_name!='')
									{!! $account->person_name !!}
									@endif
							  </td>
                              <td>{!! $account->updated_at !!}</td>
                              <td><a href="{!! URL::route('adminaccount.view',['id' => $account->id, '_token' => csrf_token()]) !!}" class="margin-left-5"><i class="glyphicon glyphicon-eye-open fa-2x"></i></a></td>
                              <td>
                                  @if(! $account->protected)
                                  <a href="{!! URL::route('adminaccount.delete',['id' => $account->id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                                  @else
                                      <i class="fa fa-times fa-2x margin-left-12 light-blue"></i>
                                  @endif
                              </td>
                          </tr> 
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
    <script>
	$(function() {
        $(".delete").click(function(){
            return confirm("Are you sure to delete this account?");
        });
		
		 $(function() {
        $('#users-table').DataTable({
			
  "aaSorting": [[ 0, "desc" ]]

           
        });
    });
    });
	
    </script>
	
@stop
