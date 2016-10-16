@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
Admin area: Add category
@stop

@section('content')

<div class="row">
    <div class="col-md-12">
        {{-- successful message --}}
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
        <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                         <h3 class="panel-title bariol-thin">{!! isset($category->id) ? '<i class="fa fa-pencil"></i> Edit' : '<i class="fa fa-user"></i> Create' !!} Category @if(Input::get('type')) for {!! Input::get('type')!!}@endif</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                      
                    </div>
                </div>
                <div class="col-md-6 col-xs-12">
                
				 {!! Form::model($category,['route'=>'category.save', 'method' => 'post']) !!}
				
				 {!! isset($category->id)?Form::hidden('id'):'' !!}	
				{!! Form::hidden('type', Input::get('type'), ["class"=> "form-control"] ) !!}				 
				<div class="form-group">
					{!! Form::label('category', 'Category: *', ['class' => 'control-label']) !!}
					{!! Form::text('category', null, ['class' => 'form-control']) !!}
				</div>
				
				<div class="form-group">
					{!! Form::label('parent', 'Select Parent category:', ['class' => 'control-label']) !!}
					 {!! Form::select('parent', $parents, (isset($category->parent) && $category->parent) ?$category->parent : "", ["class"=> "form-control"] ) !!}
				</div>
				 
				{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
				 
				{!! Form::close() !!}
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
</script>
@stop