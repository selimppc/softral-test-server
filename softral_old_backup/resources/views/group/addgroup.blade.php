 {{-- */$select = array();/* --}}
@if(count ($edit_data) >0)
  @foreach ($edit_data as $data)
    {{-- */$select[]=$data->user_id/* --}}
  @endforeach
@endif

@extends('laravel-authentication-acl::client.layouts.base')
@section('title')
Softral - Add Group
@stop
@section('content')



<div class="row content">
  @if(@$edit_data[0]->group_id!='')
    <h2>Update Group</h2>
  @else
    <h2>Create Group</h2>
  @endif
  
  @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <form method="POST" action="{{URL::to('/')}}/admin/savegroup" novalidate>
  	 <meta name="_token" content="{!! csrf_token() !!}"/>
  	 <input type="hidden" name="_token" value="{{ csrf_token() }}">
     <input type="hidden" name="group_id" value="{{ @$edit_data[0]->group_id }}">
    <div class="form-group">
      <label for="group_name">Group Name:</label>
      <input type="text" class="form-control" id="group_name" placeholder="Enter group name" name="group_name" value="{{ @$edit_data[0]->group_name }}">
    </div>
    <div class="form-group">
      <label for="users">Select User:</label>
      <select multiple class="form-control" id="users" name="users[]">
        @foreach ($users as $key => $user)
            <option value="{{ $user->id }}" {{in_array($user->id,$select)?' selected=selected ' : ''}}>{{ $user->first_name }} {{ $user->last_name }} ({{$user->email}})</option>
        @endforeach
      
    </select>
    </div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>

@endsection
