@extends('laravel-authentication-acl::client.layouts.base')
@section('title')
Softral - View notifs
@stop
@section('content')
<div class="row content">
    <div class="container-fluid main_content view-job">
	
	<div class="row-fluid">
		
		<div class="col-lg-12">
		
		<div class="notif-heading"><h4 class="menu-title">All Notifications</h4>
    </div>

		@if(isset($notify) && count($notify)!=0)
		@foreach($notify as $notif)
	
		@if($notif->label=='got proposal')
		<a class="content" href="{!! URL::to('/job/proposal_view?id=' .$notif->proposal_id) !!}">
	@elseif($notif->label=='select proposal' || $notif->label=='Escrow money' || $notif->label=='Ended the Contract' || $notif->label=='Sent Bonus' || $notif->label=='Released Money' || $notif->label=='FEnded the Contract')
	<a class="content" href="{!! URL::to('financial/terms_milestone?p_id='.$notif->proposal_id) !!}">
	@endif
		<div class="notif-item">
		
		  <p class="item-info col-lg-9 pull-left"> @if($notif->label=='got proposal') You have got proposal
	   @elseif($notif->label=='select proposal') Your proposal has been selected 
	   @elseif($notif->label=='Escrow money')  {{ $notif->job->user->user_profile[0]->first_name}} has Escowed ${{ $notif->amount }} 
	   @elseif($notif->label=='Ended the Contract') {{ $notif->proposal->user->user_profile[0]->first_name}} has Ended the Contract 
	   @elseif($notif->label=='FEnded the Contract') {{ $notif->job->user->user_profile[0]->first_name}} has Ended the Contract 
	   @elseif($notif->label=='Sent Bonus') {{ $notif->job->user->user_profile[0]->first_name}} has sent bonus ${{ $notif->amount }} 
	   @elseif($notif->label=='Released Money') {{ $notif->job->user->user_profile[0]->first_name}} has released money @endif
	   for job {{ $notif->job->project_name}}</p>
	
		<p class="item-info pull-right" style='color:#ff7788;font-weight:bold'> {{ date('F d', strtotime($notif->updated_at)) }}</p>
	
		</div>
    </a>
		
		@endforeach
	@else
		<div class="notif-item"><center> No notif found <center></div>
	@endif
	
{!! $notify->render() !!}		
    
 
</div>

</div>
		</div>
		
		</div>
		
		 @stop