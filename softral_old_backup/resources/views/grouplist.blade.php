@extends('laravel-authentication-acl::client.layouts.base')
@section('title')
Softral - User Group List
@stop
@section('content')

<div class="row content">

  <h2>Groups</h2>
  <p>Users group list</p> 
  	<div class="row">
		<div class="col-md-12 col-xs-12">
			<div class="btn-group pull-right">
				<a class="btn btn-primary" href="{{URL::to('/')}}/admin/addgroup">Create Group</a>
        <a class="btn btn-warning" href="{{URL::to('/')}}/admin/quelist">View Que</a>
			</div>
		</div>
		@if (Session::has('success_message'))
			<div class="col-md-12">
				<div class="alert alert-success">
				  <strong>Success!</strong> {{ Session::get('success_message') }}
				</div>
			</div>
		@endif
	</div>
	
  <div class="table-responsive">       
  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Group id</th>
        <th>Group name</th>
        <th>Total user</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
    	 @foreach ($groups as $group)
	      <tr>
	        <td>{{$group->group_id}}</td>
	        <td>{{$group->group_name}}</td>
	        <td><button value="{{$group->group_id}}" type="button" class="btn btn-info" data-toggle="modal" data-target="#viewGroupUser" onclick="viewGroupUsers(this.value,'{{$group->group_name}}')">{{$group->total_users}}</button></td>
	      	<td width="20%"><a href="{{URL::to('/')}}/admin/editgroup/{{$group->group_id}}" class="btn btn-success"><span class="glyphicon glyphicon-edit"></span></a>
	      	<a href="javascript:delete_group('{{$group->group_id}}')" class="btn btn-danger"><span class="glyphicon glyphicon-remove"></span></a></td>
	      </tr>
	    @endforeach
    </tbody>
  </table>
  </div>
</div>


  <div class="modal fade" id="viewGroupUser" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title group-name"></h4>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12 result_msg">
              
            </div>
          </div>
          <table class="table table-bordered">
          	<thead>
		      <tr>
		        <th>User id</th>
		        <th>User name</th>
		        <th>Email address</th>
            <th>Is que list</th>
		      </tr>
		    </thead>
		    <tbody>

		    </tbody>
          </table>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

@endsection


