@extends ('_master')
@section ('title')
CSC, LLC.  Read Clients
@stop
@section ('header')
@stop
@section ('page_title')
@if(Session::get('flash_message'))
	<div class="flash-message">{{ Session::get('flash_message') }}</div>
@endif
<h2>Read Clients</h2>
@stop
@section ('description')
This page is used to display clients of CSC.
@stop
@section ('content')
@foreach($errors->all() as $message) 
    <div class="error">{{ $message }}</div>
@endforeach
@if(isset($clients))
<br />
<p class="results">Results:</p>
	<table class="outtable">
		<tr>
			<th>Client Name</th>
			<th>Street</th>
			<th>City</th>
			<th>State</th>
			<th>Zip</th>
		</tr>
		@foreach($clients as $client)
			<tr>
    			<td>{{$client->client_name}}</td>
    			<td>{{$client->address}}</td>
    			<td>{{$client->city}}</td>
    			<td>{{$client->state}}</td>
    			<td>{{$client->zip_code}}</td>
			</tr>
		@endforeach
	</table>
@endif
@stop