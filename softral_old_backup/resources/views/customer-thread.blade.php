@extends('laravel-authentication-acl::client.layouts.ticket')
@section('title')
Softral - View ticket
@stop
@section('content')
<div class="row content" >

		<div class="panel panel-default chat" style="width:80%;margin:0px auto">
<a href="{{url('customer-manage-ticket')}}" class="btn btn-danger btn-sh pull-right" style="margin-top:8px">Softral Ticket Home</a><br/><br/>
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

					

							<form class="form-horizontal" action="{{route('updateATicket',$data->id)}}" method="POST">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
<table class="panel-heading" style="margin-top:-50px;width:100%" >
	<tr>
		<td>
					 Ticket  ID: {{$data->tno}}  <small class="text-muted "> Department: {{$data->tdept}} , Priority: {{$data->tpri}} </small>

		
			</td>
			<td>	
				Status: {{$data->tstatus}}

							
								
							
					</td>
				</tr>
			</table>

				
  </form>
		

					<div class="panel-body" style="height:400px">
						<ul>
							<li class="left clearfix">
								<span class="chat-img pull-left">

									<img src="{!! URL::to('/') !!}/timthumb.php?src={!! URL::to('/images').'/'.$data->user->user_profile[0]->slug !!}.jpg&w=114&h=114&q=100" alt="User Avatar" class="img-circle" />
								</span>
								<div class="chat-body clearfix">
									<div class="header">
										<strong class="primary-font">{{$data->tusername}} </strong> <small class="text-muted">{{$data->created_at}}</small>
									
	

									</div>
									<p>
							
						{!!$data->tmsg!!}
						  

									</p>
								</div>
							</li>
							
						@foreach($data2 as $row)

						@if($row->tuserid=='1')

							<li class="right clearfix">
								<span class="chat-img pull-right">
									<img src="{!! URL::to('/') !!}/timthumb.php?src={!! URL::to('/images').'/'.$row->user->user_profile[0]->slug !!}.jpg&w=114&h=114&q=100" alt="Admin Avatar" class="img-circle" />
								</span>
								<div class="chat-body clearfix">
									<div class="header">
										<strong class="pull-left primary-font">{{$row->tusername}}</strong> <small class="text-muted">{{$row->created_at}}</small>
									</div>
									<p>
												{!!$row->tmsg!!}
											</p>
								</div>
							</li>
							@elseif($row->tuserid!='1')

						<li class="left clearfix">
								<span class="chat-img pull-left">

									<img src="{!! URL::to('/') !!}/timthumb.php?src={!! URL::to('/images').'/'.$row->user->user_profile[0]->slug !!}.jpg&w=114&h=114&q=100" alt="User Avatar" class="img-circle" />
								</span>
								<div class="chat-body clearfix">
									<div class="header">
										<strong class="primary-font">{{$row->tusername}}</strong> <small class="text-muted">{{$row->created_at}}</small>
									
	

									</div>
									<p>
							
								{!!$row->tmsg!!}
						  

									</p>
								</div>
							</li>
							
							@endif
							@endforeach
						</ul>
					</div>
					
					<div class="panel-footer ">
				<form class="form-horizontal" action="{{route('sendCustomer',$data->id)}}" method="POST">
				<input type="hidden" name="_token" value="{{csrf_token()}}">
			<font size="4">	<b>Your Reply to the Ticket:</b><br/></font>
							<textarea id="btn-input" name='tmsg' class="form-control input-md" placeholder="Type your message here..." />

						</textarea>
						<br/>		
					
								<button class="btn btn-success btn-md" type="submit" id="btn-chat">Send</button>
						
					
						</div>
			
				</div>
			<br/>		<br/>		<br/>
	</form>
</div>
	@stop