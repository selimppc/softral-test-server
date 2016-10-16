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
   <h4 style="margin:0px;text-align:center"><strong>My Proposals</strong></h4>
  </div>
</div>
@endif
<div class="row">
     
	   <div class="pull-left col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
                <div style="margin-top:15px;" class="panel panel-default">
                  <div class="panel-body text-center">
				  
				  @if(count($proposals)!=0)
<table border="1" class="table table-striped table-bordered table-hover dataTable no-footer">
	 <tbody><tr>
		<td><strong>Job name</strong></td>
		<td><strong>Amount</strong></td>
		<td><strong>Counter Amount</strong></td>
		<td><strong>Posted date</strong></td>
		<td><strong>Edit</strong></td>
		<td><strong>View</strong></td>
		<td><strong>See Contract</strong></td>
		<td><strong>Delete</strong></td>
	</tr>	
		
		 @foreach($proposals as $proposal)
         	<tr>
				<td><a href="{!! URL::to('/job/').'/'.$proposal->job->slug !!}">{{$proposal->job->project_name}}</a></td>
				<td>${{$proposal->main_amount}}</td>
				<td>@if(isset($proposal->counter_amount) && $proposal->counter_amount!='')${{$proposal->counter_amount}}@endif</td>
				<td>{{$proposal->created_at}}</td>
				<td><a href="{!! URL::route('job.addProposal', ['job_slug'=>$proposal->job->slug,'id' => $proposal->id]) !!}"><i class="fa fa-pencil-square-o fa-2x"></i></a></td>
				<td><a href="{!! URL::route('proposal.view',['id' => $proposal->id]) !!}" class="margin-left-5"><i class="fa fa-eye fa-2x"></i></a></td>
				
				<td>@if(isset($proposal->contract))<a href="{!! URL::to('/financial/terms_milestone/').'?p_id='. $proposal->id !!}" class="margin-left-5"><i class="fa fa-eye fa-2x"></i></a>
				@else
					No Contract
				@endif
				</td>
				<td><a href="{!! URL::route('proposal.delete',['id' => $proposal->id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a></td>
			</tr>	
		@endforeach
              
           		   			</tbody></table>
			<div style="margin-left:2px" class="row pagging">
			{!! $proposals->render() !!}
		  </div>
			@else
				<div style='text-align:center'><h3>You haven't submitted any proposal</h3></div>
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
		
		 $(function() {
        $('#users-table').DataTable({
           
        });
    });
	
    </script>
	  @stop