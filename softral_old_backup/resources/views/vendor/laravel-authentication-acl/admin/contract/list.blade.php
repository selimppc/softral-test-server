@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Admin area: Contracts list
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
			<h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> {!! Input::all() ? 'Search results' : 'Contracts' !!}@if(Input::get('type')) for {!! Input::get('type')!!}@endif</h3>
			</div>
    <div class="panel-body">
                <div class="col-md-12">
              @if(! $contracts->isEmpty() )
              <table class="table table-hover" id="users-table">
                      <thead>
                          <tr>
							   <th>ID</th>
							   <th>Job name</th>
                               <th>Employer name</th>
                               <th>Freelancer name</th>
                               <th>Contract status</th>                
                               <th>Suspend / Hold</th> 
							   <th>Contract amount</th>	
							   <th>Amount in Escrow</th>	
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($contracts as $contract)
						  
                          <tr>
							  <td>{!! $contract['id'] !!}</th>	
                              <td>{!! $contract['job']['project_name'] !!}</td>
                              <td>{!! $contract['job']['user']['user_profile'][0]['first_name'] !!}</td>
                              <td>{!! $contract['proposal_selected']['user']['user_profile'][0]['first_name'] !!}</td>
                             
							  <td>
							  @if(isset($contract->approve_contract) && ($contract->approve_contract==1)) Contract isn't Approved yet
							  @elseif(isset($contract->cancel_contract) && $contract->cancel_contract==1)Contract cancelled @elseif(isset($contract->ended_contract) && $contract->ended_contract==1)Contract ended
								@elseif(isset($contract) && $contract->ended_contract==0 && $contract->cancel_contract==0 && isset($contract->proposal_selected->id))Contract is Active 
								 @endif
							</td>
							<td>{!! Form::open(array('route' => 'contractsApprove', 'class' => 'form','method' => 'POST')) !!}<input type='hidden' name='contract_id' value="{!! $contract['id'] !!}" />@if($contract->approve_contract==1)<input type='submit' class='contract_submit' name='submit' value='Hold' /> / <input type='submit' name='submit' value='Reinstate' class='contract_submit' /> @elseif($contract->hold_contract==0) <input type='submit' class='contract_submit' name='submit' value='UnHold' /> / <input type='submit' name='submit' value='Suspend' class='contract_submit' /> @else <input type='submit' class='contract_submit' name='submit' value='Hold' /> / <input type='submit' name='submit' value='Suspend' class='contract_submit' /> @endif</td>
							<td>${{ $contract['proposal']['client_amount'] }}</td> 
							<td> @if(isset($contract['job']['last_escrow']['amount']))${{ $contract['job']['last_escrow']['amount'] }}@else $0 @endif</td>
								 {!! Form::close() !!}
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
@stop

@section('footer_scripts')
    <script>
        $(".contract_submit").click(function(){
            return confirm("Are you sure to Change status of Contract?");
        });
		
		 $(function() {
        $('#users-table').DataTable({
           "order": [[ 0, "desc" ]]
        });
    });
	
    </script>
@stop