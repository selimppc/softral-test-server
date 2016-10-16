@extends('laravel-authentication-acl::admin.layouts.base-2cols')

@section('title')
    Admin area: Jobs list
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
			<h3 class="panel-title bariol-thin"><i class="fa fa-user"></i> {!! 'View Job : '.$job->project_name !!}</h3>
			</div>
    <div class="panel-body">
                <div class="col-md-12">
             <div id="section1">
                <h5><strong>Job name</strong> : {!! $job->project_name !!}</h5>
            </div>
            <hr> 
			<div id="section1">
                <h5><strong>Posted by</strong> :  {!!  ucwords($job->user->user_profile[0]->first_name) !!}</h5>
            </div>
            <hr>
			<div id="section1">
                <h5><strong>Job type</strong> :  {!!  ucwords($job->job_type) !!}</h5>
            </div>
            <hr>
            <div id="section2">
                <h5><strong>Category name</strong> :{!! $job->categories->category !!}</h5>
            </div>
            <hr>
           <div id="section2">
                <h5><strong>Skills</strong> :{!! $job->modified_skill_id !!}</h5>
            </div>
            <hr>
			<div id="section2">
                <h5><strong>Job Description</strong>:<br/><br/> {!! $job->description !!}</h5>
            </div>
            <hr>
			<div id="section2">
				<?php $images=unserialize($job->images); ?>
                <h5><strong>Images</strong> :
				 @if(!empty($images))
					 @for($i=0;$i<count($images);$i++)
						<img src="{!! URL::to('/') !!}/uploads/{!! $images[$i] !!}"  width='33%' />
					 @endfor
				@endif
			</h5>
            </div>
            <hr>
			
			@if( $job->job_type=='fixed')
			<div id="section2">
                <h5><strong>Fixed Budget:</strong> ${!! $job->budget !!}</h5>
            </div>
            <hr>
			@else
			<div id="section2">
                <h5><strong>Hour:</strong> ${!! $job->budget !!}/Hour</h5>
            </div>
            <hr>
			
			@if($job->hourperweek!='0')
			<div id="section2">
                <h5><strong>Hours per week:</strong> {!! $job->hourperweek !!} Hours/Week</h5>
            </div>
            <hr>
			@endif
			
			@if($job->duration!='0')
			<div id="section2">
                <h5><strong>Duration:</strong> {!! $job->duration !!}</h5>
            </div>
            <hr>
			@endif
			@endif
			
			<div id="section2">
                <h5><strong>Created at:</strong> : {!! $job->created_at !!}</h5>
            </div>
            <hr>
			
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