@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Admin area: Jobs list
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
		
		<td><strong>Edit</strong></td>
		<td><strong>View</strong></td>
		<td><strong>Delete</strong></td>
	</tr>	
		
		 @foreach($proposals as $proposal)
         	<tr>
				<td><a href="{!! URL::to('/user/profile').'/'.$proposal->user_profile->slug !!}" title="View {{$proposal->user_profile->first_name}}'s profile">{{$proposal->user_profile->first_name}}</a></td>
				<td>${{$proposal->main_amount}}</td>
				<td>{{$proposal->created_at}}</td>
				
				<td><a href="{!! URL::route('job.edit_Proposal', ['job_slug'=>$proposal->job->slug.'/'.$proposal->id]) !!}"><i class="fa fa-pencil-square-o fa-2x"></i></a></td>
				
				<td><a href="{!! URL::route('proposal.view_Proposal',['id' => $proposal->id]) !!}" class="margin-left-5"><i class="fa fa-eye fa-2x"></i></a></td>
				<td><a href="{!! URL::route('proposal.deleteAdminProposal',['id' => $proposal->id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a></td>
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