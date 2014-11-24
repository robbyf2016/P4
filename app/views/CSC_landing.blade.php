@extends ('_master')
@section ('title')
CSC, LLC.  Landing Page
@stop
@section ('navigation')
<!--************************************************
	This is the breadcrumb navigation code to be
	included by the _master blade template.
	************************************************-->
<a href="/">Home</a>
@stop
@section ('page_title')
CSC Landing Page
@stop
@section ('description')
This page is used to CRUD users/order/services for CSC, LLC.
@stop
@section ('content')
@if(Session::get('flash_message'))
	<div class='flash-message'>{{ Session::get('flash_message') }}</div>
@endif
@stop