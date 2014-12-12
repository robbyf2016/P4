@extends ('_master')
@section ('title')
CSC, LLC.  About Page
@stop
@section ('navigation')
<!--************************************************
	This is the breadcrumb navigation code to be
	included by the _master blade template.
	************************************************-->
<a href="/">Home</a>
@stop
@section ('page_title')
<h2>CSC About Page</h2>
@stop
@section ('description')
@if(Session::get('flash_message'))
	<div class='flash-message'>{{ Session::get('flash_message') }}</div>
@endif
@stop
@section ('content')
<h3 class="sub_title">About this CSC application:</h3><br />
<p>This web application is built on Laravel MVC, PHP, HTML, CSS, Toddish RBAC, and Bootstrap.</p>
The following have been incorporated into this application among others not identified:
<ul>
	<li>Routes - using Controllers</li>
	<li>Models - Client, Service, User, and Order</li>
	<li>Migrations - used to construct the database tables and to populate a few tables.</li>
	<li>Seeds - used to populate the database tables with initial data.</li>
	<li>Views - used to generate the HTML views for input and output to the end user.</li>
	<li>Authentication and Authorization - provided by Toddish and implemented within the code.</li>
	<li>Bootstrap - used for visual and graphical display.</li>
	<li>MySQL database - the database contains four tables specifically for the application.  Three normal tables and one pivot table.</li>
</ul>
<p>This is a basic business application that is used to maintain clients that will order security services from CSC.</p>
<ul>
	<li>Services Table - contains all of the security services offered with price.</li>
	<li>Clients Table - contains all CSC client's information.</li>
	<li>Orders Table - contains all orders for CSC clients.</li>
	<li>Orders_Service Pivot Table - links order and service.</li>
</ul>
@stop