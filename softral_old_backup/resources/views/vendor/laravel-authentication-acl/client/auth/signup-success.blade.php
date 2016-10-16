@extends('laravel-authentication-acl::client.layouts.topup')
@section('title')
Softral - Registration Completed
@stop
@section('content')
<div class="row content">
               <div class="col-lg-12 content-right">
<div class="row">
    <div class="col-lg-12 text-center v-center">

        <h1><i class="fa fa-thumbs-up"></i> Congratulations, you successfully registered to {!! Config::get('acl_base.app_name') !!}</h1>
        <p class="lead">Your user has been registered succesfully.
            Now you can login to the website using the {!! link_to('/login','Following link') !!}</p>
    </div>
</div>
</div>
</div>
@stop