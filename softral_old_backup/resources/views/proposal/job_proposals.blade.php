@extends('laravel-authentication-acl::client.layouts.base')
@section('title')
Softral - My Proposals
@stop
@section('content')
<div class="row content">
{{--@include('laravel-authentication-acl::client.layouts.sidebar')--}}
	  
      <div class="row1 col-xs-12 col-sm-12 col-md-12 col-lg-12">

	   @if(count($proposals)!=0)
<div class="panel panel-default">
  <div class="panel-body">
   <h4 style="margin:0px;text-align:center"><strong>Proposals for <font color='#D2322D'>{!! $job->project_name !!}</font></strong></h4>
  </div>
</div>
@endif
<div class="row">
     
	   <div class="pull-left col-xs-12 col-sm-12 col-md-12 col-lg-12">
	   <?php $message = Session::get('message'); ?>
        @if( isset($message) )
        <div class="alert alert-success">{!! $message !!}</div>
        @endif
       @if($errors->any())
			<div class="alert alert-danger">
				@foreach($errors->all() as $error)
					<p>{{ $error }}</p>
				@endforeach
			</div>
		@endif
                <div style="margin-top:15px;" class="panel panel-default">
                  <div class="panel-body text-center">
				  @if(count($proposals)!=0)
<table border="1" class="table table-striped table-bordered table-hover dataTable no-footer">
	 <tbody><tr>
		<td><strong>Freelancer</strong></td>
		<td><strong>Amount</strong></td>
		<td><strong>Posted date</strong></td>
		<td><strong>Select Proposal</strong></td>
		<td><strong>View</strong></td>
		<td><strong>Delete</strong></td>
	</tr>	
		
		 @foreach($proposals as $proposal)
         	<tr>
				<td><a href="{!! URL::to('/user/profile').'/'.$proposal->user_profile->slug !!}" title="View {{$proposal->user_profile->first_name}}'s profile">{{$proposal->user_profile->first_name}}</a></td>
				<td>${{$proposal->main_amount}}</td>
				<td>{{$proposal->created_at}}</td>
				<td>
					<?php /*@if($no_more==1)
						Job is no more!
					@else */ ?>
						@if($proposal->offer==1)
							Proposal selected
						@else
							<?php /*@if($proposal->job->selected==0)*/ ?>		
								<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal">Select Proposal</button>
								
								<!-- Modal -->
											<div id="myModal" class="modal fade" role="dialog">
											  <div class="modal-dialog">

												<!-- Modal content-->
												<div class="modal-content">
												  <div class="modal-header">
													<button type="button" class="close" data-dismiss="modal">&times;</button>
													<h4 class="modal-title">Select Proposal</h4>
												  </div>
												  {!! Form::open(array('route' => 'job.selectProposal', 'class' => 'form_milestone', 'method' => 'post')) !!}
												  <input type='hidden' name='id' value='{!! $proposal->id !!}'/>
												  <input type='hidden' name='job_id' value='{!!  $proposal->job->id !!}'/>
												  <div class="modal-body">
												   <div class="form-group" style='float:left'>
													<input type='radio' value='1' name='close_job' checked /> Close job after award
													<input type='radio' value='0' name='close_job' /> Keep job open
													</div>
												  </div>
												  <div class="modal-footer">
													<button type="submit" class="btn btn-default" >Submit</button>
													<button type="submit" class="btn" data-dismiss="modal">Close</button>
												  </div>
												  </form>
												</div>

											  </div>
											</div>
							<?php /*@endif */ ?>
						<?php /*@endif*/ ?>
					@endif
				</td>
				<td><a href="{!! URL::route('proposal.view',['id' => $proposal->id]) !!}" class="margin-left-5"><i class="fa fa-eye fa-2x"></i></a></td>
				<td><a href="{!! URL::route('proposal.delete',['id' => $proposal->id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a></td>
			</tr>	
		@endforeach
              
           		   			</tbody></table>
			<div style="margin-left:2px" class="row pagging">
			{!! $proposals->render() !!}
		  </div>
			@else
				<div style='text-align:center'><h3>There are no any proposal for this job.</h3></div>
			@endif
			</div>
			</div></div></div>
  </div>
      </div>
	  {!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
	      <script>
        $(".delete").click(function(){
            return confirm("Are you sure to delete this item?");
        });
		
			 
		$(".select_proposal").click(function(){
				return confirm("Are you sure to select this proposal?");
        });
		
		 $(function() {
        $('#users-table').DataTable({
           
        });
    });
	
    </script>
	  @stop