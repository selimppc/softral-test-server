@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Admin area: Mail list
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
			<h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> {!! Input::all() ? 'Search results:' : 'Pages' !!}</h3>
			</div>
			
			 {{-- Mail-Listing --}}
				<div class="panel-body">
                <div class="col-md-12">
	{!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
             
		
             <table class="table table-hover" id="users-table">
                      <thead>
                          <tr>
                              <th>Email</th>
                              <th>Message</th>
                               <th>Operations</th>
                          </tr>
                      </thead>
                
				<tbody>
                @foreach($tasks as $task)
				<tr>
                <td>{{ $task->email }}</td>
				<td><a href="javascript:void(0)" class='add_view_message' id="add_view_message{{$task->id}}">View Message</a>
				<div id="modal_release_view_message{{$task->id}}" style="display: none">
					<?php echo $task['message']; ?>
				</div>	   
						   
		 {{-- Message Dialogue-Box --}}					   	
<script type="text/javascript">
$(document).ready(function(){
$(function () {
  $( "#modal_release_view_message{{$task->id}}" ).dialog({
    autoOpen: false
  });
  
  $("#add_view_message{{$task->id}}").click(function() {
    $("#modal_release_view_message{{$task->id}}").dialog('open');
  });
});
});
</script>
		{{-- Delete Mails --}}	
			<td>
            <a href="{!! URL::route('mail.delete',['id' => $task->id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
            </td>
			
			
             </tr>
			@endforeach
			</tbody>
            </table>
            </div>
			</div>
            </div>
         
</div>
</div>
</div>

@stop

@section('footer_scripts')
 
<script src="http://code.jquery.com/ui/1.11.1/jquery-ui.min.js"></script>

<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.1/themes/smoothness/jquery-ui.css" />
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
