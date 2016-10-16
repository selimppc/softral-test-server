@extends('laravel-authentication-acl::client.layouts.ticket')
@section('title')
Softral - Admin Manage settings
@stop
@section('content')
<div class="row content" >		
	<div id="sidebar-collapse" class="col-lg-3 content-left col-sm-3 col-lg-2 sidebar" style='display:block'>
	<br/>
		<ul class="nav menu well well-sm">
			<li><a href="admin-ticket"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> Manage Ticket</a></li>

			<li class="active"><a href="admin-manage-setting"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg>Manage Setting</a></li>
			<li><a href="admin/users/list"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg>Admin Panel</a></li>
		
			<li role="presentation" class="divider"></li>
		</ul>

	</div><!--/.sidebar-->
	

	<div class="col-sm-10 col-lg-10  main">				
		@if(Session::has('succ'))
		<br/>
		<div class="row">
			<div class="col-lg-12">
		
				<div class="alert bg-success" role="alert">
					<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg> <font size="4"> {{ Session::get('succ') }} </font>
				</div>
		
			</div>
		</div><!--/.row-->	
				@endif
	@if(count($errors)>0)	

				@foreach($errors->all() as $error)
					<br/>
					<div class="row">
			<div class="col-lg-12">
		
			<div class="alert bg-danger" role="alert">
					<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg><font size="4"> {{ $error }} </font>
				</div>
		
			</div>
		</div><!--/.row-->	
	@endforeach
				@endif	

		<br/>
				<div class="row">
			<div class="col-md-6">
				<div class="panel panel-info">
							
			
					<div class="panel-heading">Update Department</div>
					<div class="panel-body">
						<table data-toggle="table" data-url="" >
						    <thead>
						    <tr>
						        <th data-field="id" data-align="right">Sl No</th>
						        <th data-field="name">Deprtment Name</th>
						        <th data-field="option">Option</th>
						    </tr>
						    </thead>
							<?php $sl=1; ?>
										@foreach($data as $row)
						    <tr>
						        <td data-field="id" data-align="right"><?php echo  $sl;?></td>
						        <td data-field="name">{{$row->deptname}}</td>
						        <td data-field="option"><a  onclick="return confirm('Are you sure you want to Delete?')"  href="{{route('deleteDept',$row->id)}}" class="btn btn-danger btn-md pull-middle">Delete</a></td>
						    </tr>
						     <?php $sl=$sl+1;?>
						@endforeach
						</table>
					</div>
					<hr/>
						<div class="panel-heading">Add a New Department</div>
					<div class="panel-body">
							<form class="form-horizontal" action="{{route('addDept')}}" method="POST">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
								<table style="width:100%">
								<tr><td style="width:70%">
							<input id="deptname" name="deptname" type="text" placeholder="Enter Department Name ..." style="width:90%" class="form-control">		
					</td><td style="width:30%">
						<button class="btn btn-success btn-md" type="submit" id="btn-chat">Submit</button>
					</td>
						</tr>
						</table>
							</form>
					</div>

				</div>
			</div>

			<div class="col-md-6">
				<div class="panel panel-danger">
					<div class="panel-heading">Update Priority</div>
					<div class="panel-body">
							<table data-toggle="table" data-url="" >
						    <thead>
						    <tr>
						        <th data-field="id" data-align="right">Sl No</th>
						        <th data-field="name">Priority Name</th>
						        <th data-field="option">Option</th>
						    </tr>
						    </thead>
							<?php $sl=1; ?>
										@foreach($data2 as $row)
						    <tr>
						        <td data-field="id" data-align="right"><?php echo  $sl;?></td>
						        <td data-field="name">{{$row->priname}}</td>
						        <td data-field="option"><a  onclick="return confirm('Are you sure you want to Delete?')"  href="{{route('deletePri',$row->id)}}" class="btn btn-danger btn-md pull-middle">Delete</a></td>
						    </tr>
						     <?php $sl=$sl+1;?>
						@endforeach
						</table>
					</div>
								<hr/>
						<div class="panel-heading">Add a New Priority</div>
					<div class="panel-body">
							<form class="form-horizontal" action="{{route('addPri')}}" method="POST">
							<input type="hidden" name="_token" value="{{csrf_token()}}">
								<table style="width:100%">
								<tr><td style="width:70%">
							<input id="priname" name="priname" type="text" placeholder="Enter Priority Name ..." style="width:90%" class="form-control">		
					</td><td style="width:30%">
						<button class="btn btn-warning btn-md" type="submit" id="btn-chat">Submit</button>
					</td>
						</tr>
						</table>
							</form>
					</div>
				</div>
			</div>
		<!--/.row-->	
	
		
	</div><!--/.main-->
								
		
	</div>	<!--/.main-->
	</div>	<!--/.main-->
@stop