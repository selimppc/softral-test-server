@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Admin area: categories list
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
			<h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> {!! Input::all() ? 'Search results' : 'Categories' !!}@if(Input::get('type')) for {!! Input::get('type')!!}@endif</h3>
			</div>
    <div class="panel-body">
                <div class="col-md-12">
              @if(! $categories->isEmpty() )
              <table class="table table-hover" id="users-table">
                      <thead>
                          <tr>
                              <th>Category name</th>
                               <th>Operations</th>
                          </tr>
                      </thead>
                      <tbody>
                          @foreach($categories as $category)
						   @if($category->parent==0)
                          <tr>
                              <td>{!! $category->category !!}</td>
                              <td>
                                  @if(! $category->protected)
                                      <a href="{!! URL::route('category.edit', ['id' => $category->id,'type'=>$category->type]) !!}"><i class="fa fa-pencil-square-o fa-2x"></i></a>
                                      <a href="{!! URL::route('category.delete',['id' => $category->id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
                                  @else
                                      <i class="fa fa-times fa-2x light-blue"></i>
                                      <i class="fa fa-times fa-2x margin-left-12 light-blue"></i>
                                  @endif
                              </td>
                          </tr>
						   @endif
							  @foreach($category->children as $submenu)
							   <tr>
								  <td> <strong>{!! $category->category !!}</strong>  => {!! $submenu->category !!}</td>
								  <td>
									  @if(! $submenu->protected)
										  <a href="{!! URL::route('category.edit', ['id' => $submenu->id,'type'=>$category->type]) !!}"><i class="fa fa-pencil-square-o fa-2x"></i></a>
										  <a href="{!! URL::route('category.delete',['id' => $submenu->id, '_token' => csrf_token()]) !!}" class="margin-left-5 delete"><i class="fa fa-trash-o fa-2x"></i></a>
									  @else
										  <i class="fa fa-times fa-2x light-blue"></i>
										  <i class="fa fa-times fa-2x margin-left-12 light-blue"></i>
									  @endif
								  </td>
							  </tr>
							  @endforeach
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