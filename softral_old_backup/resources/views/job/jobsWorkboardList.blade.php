@extends('laravel-authentication-acl::client.layouts.base')
@section('title')
Softral - Workboards  
@stop
@section('content')
<div class="row content">
    {{--@include('laravel-authentication-acl::client.layouts.sidebar')--}}

    <div class="row1 col-xs-12 col-sm-12 col-md-12 col-lg-12">

	<?php $error = Session::get('error'); ?>
	<?php $message = Session::get('message'); ?>
        @if( isset($error) )
        <div class="alert alert-danger">{!! $error !!}</div>
        @endif  
		
		@if( isset($message) )
        <div class="alert alert-success">{!! $message !!}</div>
        @endif
		
        @if(count($my_jobs)!=0 || count($proposals) != 0)
        <div class="panel panel-default">
            <div class="panel-body">
                <h4 style="margin:0px;text-align:center"><strong>Jobs workboard lists</strong></h4>
            </div>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="pull-left col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div style="margin-top:15px;" class="panel panel-default">
                <div class="panel-body text-center">
                    @if(count($my_jobs)!=0 || count($proposals) != 0)
                    <table border="1" class="table table-striped table-bordered table-hover dataTable no-footer">
                        <tbody><tr>
                                <td><strong>Job name</strong></td>
                                <td><strong>View Workboards</strong></td>
                               
                            </tr>	

                            @foreach($my_jobs as $my_job)
                            <tr>
                                <td><a href="{!! URL::to('/job/').'/'.$my_job->slug !!}">{{$my_job->project_name}}</a></td>
                               
                                <td><a href="{!! URL::route('job.viewworkboard', ['id'=>$my_job->proposal_selected->id]) !!}">Employer WorkBoard</a></td>
                                
                            </tr>	
                            @endforeach
                            @foreach($proposals as $my_proposal)
                            <tr>
                                <td><a href="{!! URL::to('/job/').'/'.$my_proposal->job->slug !!}">{{$my_proposal->job->project_name}}</a></td>
                               
                                <td><a href="{!! URL::route('job.viewworkboard', ['id'=>$my_proposal->id]) !!}">Freelancer Work Board</a></td>
                                
                            </tr>	
                            @endforeach

                        </tbody></table>

                    @else
                    <div style='text-align:center'><h3>You don't have any job.</h3></div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @stop