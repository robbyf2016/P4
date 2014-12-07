@extends ('_master')
@section ('title')
CSC, LLC.  Create User
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
<h2>Create User</h2>
@stop
@section ('description')
This page is used to create users for access to the CSC, LLC. Website.
@stop
@section ('content')
@foreach($errors->all() as $message) 
    <div class="error">{{ $message }}</div>
@endforeach
<form action="{{ url('user') }}" method="post">
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	<p><label for="username">Username:</label></p>
	<p><input type="text" name="username" placeholder="Username" /></p>
	<p><label for="email">Email:</label></p>
	<p><input type="text" name="email" placeholder="Email" /></p>
	<p><label for="password">Password:</label></p>
	<p><input type="password" name="password" placeholder="Password" /></p>
	<p><input type="submit" value="Create" /></p>
</form>
@stop