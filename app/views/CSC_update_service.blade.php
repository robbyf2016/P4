@extends ('_master')
@section ('title')
CSC, LLC.  Modify (update or delete) Service
@stop
@section ('header')
@stop
@section ('navigation')
<!--************************************************
	This is the breadcrumb navigation code to be
	included by the _master blade template.
	************************************************-->
<a href="/">Home</a>
@stop
@section ('page_title')
@if(Session::get('flash_message'))
	<div class="flash-message">{{ Session::get('flash_message') }}</div>
@endif
Modify (update or delete) Service
@stop
@section ('description')
This page is used to update or delete a service that CSC currently offers.
@stop
@section ('content')
@foreach($errors->all() as $message) 
    <div class="error">{{ $message }}</div>
@endforeach

@if(isset ($service_selected))
<form action="{{ url('update-service') }}" method="post">
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	<input type="hidden" name="update" value="1">
	<input type="hidden" name="service_selected" value="{{$service_selected->service_name}}">
	<label for="service">Update service:</label>
	<p>
		<label>Service Name:</label>
		<textarea name="service_name">{{$service_selected->service_name}}</textarea>
	</p>
		<label>Service Description:</label>
		<textarea name="service_desc">{{$service_selected->service_desc}}</textarea>
	</p>
	<p>
		<label>Service Price:</label>
		<textarea name="service_price">{{$service_selected->service_price}}</textarea>
	</p>
	<p><input type="submit" name="button" value="Update" /><input type="submit" name="button" value="Delete" />
		<input type="submit" name="button" value="Cancel" /></p>
</form>
@else
<form action="{{ url('update-service') }}" method="post">
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	<input type="hidden" name="update" value="0">
	<label for="service">Select a service to modify (update or delete):</label>
	{{ Form::select('Service', $service_options , Input::old('Service')) }}
	</br></br></br></br>
	<p><input type="submit" name="select" value="Select" /></p>
</form>
@endif
@stop