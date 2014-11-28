@extends ('_master')
@section ('title')
CSC, LLC.  Create Order
@stop
@section ('header')
@if(Session::get('flash_message'))
	<div class="flash-message">{{ Session::get('flash_message') }}</div>
@endif
@stop
@section ('navigation')
<!--************************************************
	This is the breadcrumb navigation code to be
	included by the _master blade template.
	************************************************-->
<a href="/">Home</a>
@stop
@section ('page_title')
Create Order
@stop
@section ('description')
This page is used to create an order for a CSC client.
@stop
@section ('content')
@foreach($errors->all() as $message) 
    <div class="error">{{ $message }}</div>
@endforeach

<form action="{{ url('create-order') }}" method="post">
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	<label for="client">Client:</label>
	{{ Form::select('Client', $client_options , Input::old('Client')) }}
	<label for="service">Service:</label>
	{{ Form::select('Service', $service_options , Input::old('Service')) }}
	</br></br>
	<p><input type="submit" value="Submit" /></p>
</form>
@stop