@extends ('_master')
@section ('title')
CSC, LLC.  Modify (update) Client
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
<h2>Modify (update) Client</h2>
@stop
@section ('description')
This page is used to update a client of CSC.
@stop
@section ('content')
@foreach($errors->all() as $message) 
    <div class="error">{{ $message }}</div>
@endforeach

@if(isset ($client_selected))
<form action="{{ url('update-client') }}" method="post">
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	<input type="hidden" name="update" value="1">
	<input type="hidden" name="client_selected" value="{{$client_selected->client_name}}">
	<label>Update client:</label>
	<p>
		<label>Client Name:</label>
		<textarea name="client_name">{{$client_selected->client_name}}</textarea>
	</p>
	<p>
		<label>Address:</label>
		<textarea rows="3" cols="75" name="address">{{$client_selected->address}}</textarea>
	</p>
	<p>
		<label>City:</label>
		<input type="text" name="city" value="{{$client_selected->city}}" />
	</p>
	<p>
		<label>State - (ex. MA) 2 letters only:</label>
		<input type="text" name="state" value="{{$client_selected->state}}" />
	</p>
	<p>
		<label>Zip - (ex. #####) 5 digits only:</label>
		<input type="text" name="zip_code" value="{{$client_selected->zip_code}}" />
	</p>

	<p><input type="submit" name="button" value="Update" />
		<input type="submit" name="button" value="Cancel" /></p>
</form>
@else
<form action="{{ url('update-client') }}" method="post">
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	<input type="hidden" name="update" value="0">
	<label for="client">Select a client to modify (update):</label>
	{{ Form::select('Client', $client_options , Input::old('Client')) }}
	<input class="select_button" type="submit" name="select" value="Select" id="client"/>
</form>
@endif
@stop