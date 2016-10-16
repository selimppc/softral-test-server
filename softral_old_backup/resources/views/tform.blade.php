@extends('laravel-authentication-acl::client.layouts.ticket')
@section('title')
Softral - Add new ticket
@stop
@section('content')
<div class="row content" >
	<div id="sidebar-collapse" class="col-lg-3 content-left col-sm-3 col-lg-2 sidebar" style='display:block'>
	<br/>
		<ul class="nav menu well well-sm">
			<li class="active"><a href="customer-service"><svg class="glyph stroked calendar"><use xlink:href="#stroked-calendar"></use></svg> New Ticket</a></li>

			<li><a href="customer-manage-ticket"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg>Manage Sent Tickets</a></li>
		
			<li role="presentation" class="divider"></li>
		</ul>

	</div><!--/.sidebar-->
		
	<div class="col-sm-10 col-lg-10  main">			
		<br/>

				@if(Session::has('succ'))
		<br/>
		<div class="row">
			<div class="col-lg-12">
		
				<div class="alert bg-success" role="alert">
					<svg class="glyph stroked checkmark"><use xlink:href="#stroked-checkmark"></use></svg><font size="4"> {{ Session::get('succ') }} </font>
				</div>
		
			</div>
		</div><!--/.row-->	
				@endif

		@if(count($errors)>0)	

				@foreach($errors->all() as $error)
					<div class="row">
			<div class="col-lg-12">
		
			<div class="alert bg-danger" role="alert">
					<svg class="glyph stroked cancel"><use xlink:href="#stroked-cancel"></use></svg><font size="4"> {{ $error }} </font>
				</div>
		
			</div>
		</div><!--/.row-->	
	@endforeach
				@endif	

		<div class="row">


		<div class="col-md-12">
			<div class="panel panel-success">
					<div class="panel-heading"><svg class="glyph stroked email"><use xlink:href="#stroked-email"></use></svg> Compose a Ticket</div>
				
					<div class="panel-body">
						<form class="form-horizontal" action="{{url('customer-service')}}" method="POST">
									<input type="hidden" name="_token" value="{{ csrf_token() }}">
							<fieldset>
								<!-- Name input-->

						
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Name</label>
									<div class="col-md-9">
									<input id="tusername" name="tusername" type="text" value="{{$logged_user['user_profile'][0]['first_name']}} {{$logged_user['user_profile'][0]['last_name']}}" readonly class="form-control">
									</div>
								</div>
							
								<!-- Email input-->
								<div class="form-group">
									<label class="col-md-3 control-label" for="email">E-mail</label>
									<div class="col-md-9">
										<input id="tuseremail" name="tuseremail" type="text" readonly value="{{$logged_user['email']}}" class="form-control">
									</div>
								</div>
								
								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Department</label>
									<div class="col-md-9">
								
										<select id="tdept" name="tdept" class="form-control">
										<option disabled selected>Select</option>
										
										@foreach($data as $row)
										<option>{{$row->deptname}}</option>
										@endforeach
									</select>

									</div>

								</div>

								<div class="form-group">
									<label class="col-md-3 control-label" for="name">Priority</label>
									<div class="col-md-9">
								
										<select id="tpri" name="tpri" class="form-control">
										<option disabled selected>Select</option>
											@foreach($data2 as $row)
										<option>{{$row->priname}}</option>
										@endforeach
									</select>
									</div>
								</div>
								<!-- Message body -->
								<div class="form-group">
									<label class="col-md-3 control-label" for="message">Your message
									</label>
									<div class="col-md-9">
										<textarea class="form-control" id="tmsg" name="tmsg" placeholder="Please enter your message here..." rows="5"></textarea>
									</div>
								</div>
								
								<!-- Form actions -->
								<div class="form-group">
									<div class="col-md-12 widget-right">
										<button type="submit" class="btn btn-success btn-md pull-right">Submit</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>

		</div><!--/.row-->
						
		
	</div>	<!--/.main-->
	</div>	<!--/.main-->
	
	
@stop
