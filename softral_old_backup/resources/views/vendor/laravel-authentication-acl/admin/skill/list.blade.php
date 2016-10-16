@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Admin area: skills list
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
			<h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> {!! Input::all() ? 'Search results:' : 'Skills' !!}</h3>
			</div>
    <div class="panel-body">
                <div class="col-md-12">
              @if(! $skills->isEmpty() )
              <table class="table table-hover" id="users-table">
                      <thead>
                          <tr>
                              <th>skill name</th>
                               <th>Operations</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($skills as $skill)
						   
                          <tr>
                              <td>{!! $skill->skill !!}</td>
                              <td>
                                  @if(! $skill->protected)
                                      <a href="{!! URL::route('skill.edit', ['id' => $skill->id]) !!}"><i class="fa fa-pencil-square-o fa-2x"></i></a>
                                      <a href="{!! URL::route('skill.delete',['id' => $skill->id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                                  @else
                                      <i class="fa fa-times fa-2x light-blue"></i>
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
@stop

@section('footer_scripts')
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