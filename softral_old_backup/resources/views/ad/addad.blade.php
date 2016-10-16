@extends('laravel-authentication-acl::client.layouts.topupClassified')
@section('title')
Softral - Post an Ad
@stop
@section('content')
<div class="row content">
 
        <div class="col-lg-12 content-right">
		 
         <div class="row selected-classifieds">
          <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                         <h3 class="panel-title bariol-thin">{!! isset($ad->id) ? 'Edit Classified: ' .$ad->project_name:'Add Classified' !!}</h3>
                    </div>
                </div>
            </div>
            <div class="panel-body">
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
                <div class="row">
                    <div class="col-md-12 col-xs-12">
                      
                    </div>
                </div>
                <div class="col-md-12 col-xs-12">
                 @if(isset($ad->id))
					{!! Form::model($ad,['route'=>'ad.edit','class' => 'form', 'method' => 'POST','files'=>true]) !!}
				 @else
					{!! Form::model($ad,['route'=>'ad.save','class' => 'form', 'method' => 'POST','files'=>true]) !!}
				 @endif
				{!! isset($ad->id)?Form::hidden('id'):'' !!}		
				<div class="form-group">
					<div class='row'>
					<div class='col-md-6'>
					{!! Form::label('title', 'Classified title: *', ['class' => 'control-label']) !!}
					{!! Form::text('title', null, ['class' => 'form-control','placeholder'=>'Ad Title']) !!}
					</div>
					</div>
				</div>
				
				<div class="form-group">	
				<div class='row'>
					<div class='col-md-6'>
				{!! Form::label('category_id', 'Select category: *', ['class' => 'control-label']) !!}
			<select id="category_id" class="chzn-select"
			id="category_id" name="category_id"
			style="width: 100%">
			   
				<option class="category" value="" disabled selected>Please select</option>
				@foreach($categories as $category)
					 @if($category->parent==0)
						<option class="category" value= "{{ $category->id }}" @if (Input::old('category_id') == $category->id) selected="selected" @endif @if ($ad->category_id == $category->id) selected="selected" @endif>{!! $category->category !!}</option>
					 @endif
					  @foreach($category->children as $submenu)
						<option class="item" value= "{{ $submenu->id }}" @if (Input::old('category_id') == $submenu->id) selected="selected" @endif @if ($ad->category_id == $submenu->id) selected="selected" @endif>{!! $submenu->category !!}</option>
					  @endforeach
				@endforeach
		</select>
			</div>
			</div>
			</div>
		
			
			<div class="form-group" style='width:737px'>
				
					{!! Form::label('description', 'Description: *', ['class' => 'control-label']) !!}
					{!! Form::textarea('description', null, ['class' => 'form-control','placeholder'=>'Write Description']) !!}
					
				</div>
				
				<div class="form-group">
				<div class='row'>
					<div class='col-md-6'>
				{!! Form::label('Add Images (Optional)') !!}
				{!! Form::file('images[]', array('multiple'=>true)) !!}
					{!!$ad->modified_images!!}
					{!!$ad->edit_images!!}
					</div>
					</div>
			</div>
			
			<div class="form-group">
				<div class='row'>
					<div class='col-md-6'>
				{!! Form::label('State', 'State: *', ['class' => 'control-label']) !!}
				{!! Form::text('state', null, ['class' => 'form-control','placeholder'=>'Write your State']) !!}
					</div>
				
					<div class='col-md-6'>
				{!! Form::label('City', 'City: *', ['class' => 'control-label']) !!}
				{!! Form::text('city', null, ['class' => 'form-control','placeholder'=>'Write your City']) !!}
					</div>
				</div>
			</div>
			
			<div class="form-group">
					<div class='row'>
					<div class='col-md-6'>
					{!! Form::label('address', 'Address:', ['class' => 'control-label']) !!}
					{!! Form::textarea('address', null, ['class' => 'form-control','rows'=>2,'placeholder'=>'Write your Address']) !!}
					</div>
					</div>
				</div>
			
				<div class="form-group">
					<div class='row'>
					<div class='col-md-6'>
					{!! Form::label('price', 'Price (In USD):', ['class' => 'control-label','style'=>'display:block']) !!}
					<span style="" class="usd">US $</span>
					{!! Form::text('price', null, ['class' => 'form-control','placeholder'=>'Write Price','style'=>'width:45%;display:inline']) !!}
					</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class='row'>
				<div style="float:left; width:100%;margin-left: 14px;"> <h3 style="margin-top: 7px;">Contact Details</h3><div class="h3-seprator"></div> </div>
				</div>
				</div>
				
				<div class="form-group">
					<div class='row'>
					<div class='col-md-6'>
					{!! Form::label('email', 'Email: *', ['class' => 'control-label']) !!}
					{!! Form::text('email', null, ['class' => 'form-control','placeholder'=>'Write your Email']) !!}
					</div>
					</div>
				</div>
				
				<div class="form-group">
					<div class='row'>
					<div class='col-md-6'>
					{!! Form::label('phone_no', 'Phone no: *', ['class' => 'control-label']) !!}
					{!! Form::text('phone_no', null, ['class' => 'form-control','placeholder'=>'Write your Phone no']) !!}
					</div>
					</div>
				</div>

				
				{!! Form::submit('Submit', ['class' => 'btn btn-primary']) !!}
				 
				{!! Form::close() !!}
                    </div>
                   
                </div>
            </div>
		  
		  </div>
        </div>
      </div>
	{!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
		
	  @stop