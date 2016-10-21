@extends('laravel-authentication-acl::client.layout.master')
@section('content')
<div class="row content">

        <div class="col-lg-12 content-right">

         <div class="row selected-classifieds">
          <div class="panel panel-info">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-12">
                         <h3 class="panel-title bariol-thin">{!! isset($job->id) ? 'Edit Job: ' .$job->project_name:'Add Job' !!}</h3>
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

                <div class="col-md-12 col-xs-12">
                 @if(isset($job->id))
					{!! Form::model($job,['route'=>'job.edit','class' => 'form', 'method' => 'post','files'=>true]) !!}
				 @else
					{!! Form::model($job,['route'=>'job.save','class' => 'form', 'method' => 'post','files'=>true]) !!}
				 @endif
				{!! isset($job->id)?Form::hidden('id'):'' !!}


			 <div class="col-md-12 col-xs-12" >
				 <div class="col-md-6 col-xs-6" style="box-shadow: 0px 0px 8px #d0d0d0; padding: 10px; margin-right: 30px; ">
					 <div class="form-group">
						 {!! Form::label('project_name', 'Job name: *', ['class' => 'control-label']) !!}
						 {!! Form::text('project_name', null, ['class' => 'form-control','placeholder'=>'Enter your project name']) !!}
					 </div>

					 <div class="form-group">
						 {!! Form::label('category_id', 'Select category: *', ['class' => 'control-label']) !!}
						 <select id="category_id" class="chzn-select"
								 id="category_id" name="category_id"
								 style="width: 100%">

							 <option class="category" value="" disabled selected>Please select</option>
							 @foreach($categories as $category)
								 @if($category->parent==0)
									 <option class="category" value= "{{ $category->id }}" @if (Input::old('category_id') == $category->id) selected="selected" @endif @if ($job->category_id == $category->id) selected="selected" @endif>{!! $category->category !!}</option>
								 @endif
								 @foreach($category->children as $submenu)
									 <option class="item" value= "{{ $submenu->id }}" @if (Input::old('category_id') == $submenu->id) selected="selected" @endif @if ($job->category_id == $submenu->id) selected="selected" @endif>{!! $submenu->category !!}</option>
								 @endforeach
							 @endforeach
						 </select>
					 </div>

					 <div class="form-group">


						 {!! Form::label('skill_id', 'Select skill: *', ['class' => 'control-label']) !!}

						 {!! Form::select('skill_id[]', $skills, (isset($job->main_skill_id) && $job->main_skill_id) ?$job->main_skill_id : "", ['id' => 'skill_id','class'=>'chzn-select', 'multiple' => 'multiple','style'=>'width:100%','data-placeholder'=>'Select a skill']) !!}
					 </div>

					 <div class="form-group" style='width:737px'>
						 {!! Form::label('description', 'Description: *', ['class' => 'control-label']) !!}
						 {!! Form::textarea('description', null, ['class' => 'form-control','placeholder'=>'Enter your description',  'rows'=>'3', 'style'=>'width: 70%']) !!}
					 </div>

					 <div class="form-group">
						 {!! Form::label('Add Images (Optional)') !!}
						 {!! Form::file('images[]', array('class'=>'form-control-file','multiple'=>true, 'aria-describedby'=>'fileHelp' )) !!}
						 <small id="fileHelp" class="form-text text-muted">Choose your file : jpg, png, pdf, docx.</small>
						 {!!$job->modified_images!!}
						 {!!$job->edit_images!!}



					 </div>
				 </div>
				 <div class="col-md-5 col-xs-5" style="box-shadow: 0px 0px 8px #d0d0d0; padding: 10px; margin-left: 30px;">
					 <div class="form-group">
						 {!! Form::label('job_type', 'Job Type:', ['class' => 'control-label','style'=>'display:block']) !!}
						 {!! Form::select('job_type', array('fixed'=>'Fixed Price','hourly'=>'Hourly Price'),null, ['class' => 'form-control job_type','style'=>'width:100%;display:inline']) !!}
					 </div>

					 @if(isset($job->job_type) && $job->job_type=='hourly')
						 <?php $style='display:none';$style1=''; ?>
					 @else
						 <?php $style1='display:none';$style='';  ?>
					 @endif

					 <fieldset class="form-group row" style="background: #efefef; padding: 10px; border-radius: 3px; margin: 3px;">
						 <legend class="col-form-legend col-sm-12" ></legend>
						 <div class="form-group" >
							 {!! Form::label('budget', 'Amount (Optional):', ['class' => 'control-label','style'=>'display:block']) !!}
							 <span style="" class="usd">US $</span>
							 {!! Form::text('budget', null, ['class' => 'form-control','placeholder'=>'Enter your amount','style'=>'width:45%;display:inline']) !!}
						 </div>

						 <div class='row hourly' style='<?php echo $style1;?>'>
							 <div class='col-lg-6'>
								 <div class="form-group" >
									 {!! Form::label('hourperweek', 'Hours per week:', ['class' => 'control-label','style'=>'display:block']) !!}
									 <span style="" class="usd">US $</span>
									 {!! Form::text('hourperweek', null, ['class' => 'form-control','placeholder'=>'hours/week','style'=>'width:80%;display:inline']) !!}
								 </div>
							 </div>

							 <div class='col-lg-6'>
								 <div class="form-group">
									 {!! Form::label('duration', 'Select Duration (Optional):', ['class' => 'control-label','style'=>'display:block']) !!}
									 {!! Form::select('duration', array(''=>'-Select Duration-','1-2 Weeks'=>'1-2 Weeks','3-4 Weeks'=>'3-4 Weeks','1-3 Months'=>'1-3 Months','4-6 Months'=>'4-6 Months','7-9 Months'=>'7-9 Months'),null, ['class' => 'form-control job_type','style'=>'display:inline']) !!}
								 </div>
							 </div>
						 </div>
					 </fieldset>

					<p> &nbsp; </p>

				 </div>

			 </div>

					<div class="col-md-6 col-xs-6 pull-right" >
						@if($cant_post==0)
							{!! Form::submit('Submit Your Job', ['class' => 'btn btn-primary']) !!}
						@else
							{!! Form::submit('Submit Your Job', ['class' => 'btn btn-primary disabled','data-toggle'=>"tooltip",'title'=>"Please submit your financial info before posting a job.",]) !!}
						@endif

						{!! Form::close() !!}
					</div>
				</div>
				 </div>
			 </div>





		  </div>
        </div>
      </div>
	{!! HTML::script('packages/jacopo/laravel-authentication-acl/js/vendor/jquery-1.10.2.min.js') !!}
		 <script>
        $(".delete").click(function(){
            return confirm("Are you sure to delete this item?");
        });

		 $(function() {
        $(".image_edit_delete").click(function(){
			var id=$(this).attr('id');
			$('.'+id).remove();
		});

		$(".job_type").click(function(){
			var val=$(this).val();
			if(val=='fixed'){
				$('.hourly').hide();
				$('#budget').attr('placehoder','Enter your amount');
			}
			else{
				$('.hourly').show();
				$('#budget').attr('placeholder','Amount/Hour');
			}
		});

		  $('[data-toggle="tooltip"]').tooltip();

$(".btn-primary").click(function(e) {
    if ( $(this).hasClass("disabled"))
    {
		return false;
    }
});
    });

    </script>
	
@stop