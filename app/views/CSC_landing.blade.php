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
<h2>CSC Site Information Page</h2>
@stop
@section ('description')
<h3 class="sub_title">Application navigation:</h3><br />
<p>This web application is built on Laravel MVC, PHP, HTML, CSS, Toddish RBAC, and Bootstrap.</p>
There are three defined roles:
<ul>
	<li>Admin role</li>
	<li>Employee role</li>
	<li>Client role</li>
</ul>
<p>If a user signs up for a login account, they are given the default client role.  Depending on the role, a user can only perform
	the functions identified in the role based matrix diagram.  Authentication and authorization is performed on each function
	route to determine accessibility.  Depending on the current authenticated user, the "site functions" menu will only show the functions
	which they can perform.  If a user attempts to call a function route in the URL, the application will determine if they are 
	authorized or not and will respond accordingly.</p>
<p>Under the admin role, a user is able to perform all CRUD functionality as in create services, clients, and orders; read services and orders;
	update services; and delete services.</p>
@stop
@section ('content')
@if(Session::get('flash_message'))
	<div class='flash-message'>{{ Session::get('flash_message') }}</div>
@endif
<img src="images/role_based_matrix.png" alt="RBM Image" />
@stop