@extends ('_master')
@section ('title')
CSC, LLC.  Read Services
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
<h2>Read Services</h2>
@stop
@section ('description')
This page is used to display services offered by CSC.
@stop
@section ('content')
@foreach($errors->all() as $message) 
    <div class="error">{{ $message }}</div>
@endforeach
@if(isset($services))
<br />
<p class="results">Results:</p>
	<table class="outtable">
		<tr>
			<th>Service Name</th>
			<th>Service Description</th>
			<th>Service Price</th>
		</tr>
		@foreach($services as $service)
			<tr>
    			<td>{{$service->service_name}}</td>
    			<td>{{$service->service_desc}}</td>
    			<td>{{$service->service_price}}</td>
			</tr>
		@endforeach
	</table>
@endif
@stop