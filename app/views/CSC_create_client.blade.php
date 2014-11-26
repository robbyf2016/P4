@extends ('_master')
@section ('title')
CSC, LLC.  Create Client
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
Create Client
@stop
@section ('description')
This page is used to create an order for a CSC client.
@stop
@section ('content')
@foreach($errors->all() as $message) 
    <div class="error">{{ $message }}</div>
@endforeach
<form action="{{ url('create-client') }}" method="post">
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	<p><label for="username">Client:</label></p>
	<p><input type="text" name="username" placeholder="Username" /></p>
	<p><label for="email">Service:</label></p>
	<p><input type="text" name="email" placeholder="Email" /></p>
	<p><input type="submit" value="Create" /></p>
</form>
@stop