@extends ('_master')
@section ('title')
CSC, LLC.  Create Service
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
<h2>Create Service</h2>
@stop
@section ('description')
This page is used to create a service for CSC.
@stop
@section ('content')
@foreach($errors->all() as $message) 
    <div class="error">{{ $message }}</div>
@endforeach
<form action="{{ url('create-service') }}" method="post">
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	<p><label>Service Name:</label></p>
	<p><input type="text" name="service_name" /></p>
	<p><label>Service Description:</label></p>
	<p><textarea rows="3" cols="75" name="service_desc"></textarea></p>
	<p><label>Service Price - (ex. #####):</label></p>
	<p><input type="text" name="service_price" /></p>
	<p><input class="select_button" type="submit" value="Create Service" /></p>
</form>
@stop