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
CSC Site Information Page
@stop
@section ('description')
This will contain information on how to navigate through this application.  Also the RTM.
@stop
@section ('content')
@if(Session::get('flash_message'))
	<div class='flash-message'>{{ Session::get('flash_message') }}</div>
@endif
@stop