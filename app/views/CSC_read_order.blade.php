@extends ('_master')
@section ('title')
CSC, LLC.  Read Order
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
Read Order
@stop
@section ('description')
This page is used to read orders of a specific CSC client.
@stop
@section ('content')
@foreach($errors->all() as $message) 
    <div class="error">{{ $message }}</div>
@endforeach

<form action="{{ url('read-order') }}" method="post">
	<input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
	<label for="client">Client:</label>
	{{ Form::select('Client', $client_options , Input::old('Client')) }}
	<input type="submit" value="Submit" />
</form>
@if(isset($selection))
</br></br>
<p class="results">Results:</p>
	@foreach($client_info as $client)
	<p>	
		<div class="client">
			<span class="client_name">
				{{ $client->client_name }} </br>
			</span>
				{{ $client->address }}</br>
				{{ $client->city }} , 
				{{ $client->state }}  
				{{ $client->zip_code }}</br>
		</div>
	</p>
	@endforeach
	<table class="outtable">
		<tr>
			<th>Order Number</th>
			<th>Order Created</th>
			<th>Type of Service Ordered</th>
			<th>Service Description</th>
			<th>Service Price</th>
		</tr>
	@foreach($selection as $order)
		<tr>
    		<td>{{ $order->id }}</td>
    		<td>{{ $order->created_at }}</td>
    	@foreach($order->services as $service)
    		<td>{{ $service->service_name }}</td>
    		<td>{{ $service->service_desc }}</td>
    		<td>{{ $service->service_price }}</td>
    	@endforeach
    	</tr>
	@endforeach
	</table>
@endif	
@stop