@extends ('_master')
@section ('title')
CSC, LLC.  Create Client
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
<h2>Create Client</h2>
@stop
@section ('description')
This page is used to create a client for CSC.
@stop
@section ('content')
@foreach($errors->all() as $message) 
    <div class="error">{{ $message }}</div>
@endforeach
<form action="{{ url('create-client') }}" method="post">
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	<p><label for="client">Client:</label></p>
	<p><input type="text" name="client" placeholder="Client" id="client" /></p>
	<p><label for="address">Address:</label></p>
	<p><input type="text" name="address" placeholder="Address" id="address"/></p>
	<p><label for="City">City:</label></p>
	<p><input type="text" name="city" placeholder="City" id="City"/></p>
	<p><label for="state">State - (ex. MA) 2 letters only:</label></p>
	<p><input type="text" name="state" placeholder="State" id="state"/></p>
	<p><label for="zip">Zip - (ex. #####) 5 digits only:</label></p>
	<p><input type="text" name="zip" placeholder="Zip" id="zip" /></p>
	<p><input class="select_button" type="submit" value="Create" /></p>
</form>
@stop