<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="images/favicon.ico">
    <link href="css/CSC.css" rel="stylesheet">

    <title>CyberSecurity Consultants LLC.</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/sticky-footer-navbar.css" rel="stylesheet">

  </head>

  <body>
    @yield('header')
    <!-- Fixed navbar -->
    <nav class="navbar navbar-default navbar-fixed-top" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">CyberSecurity Consultants, LLC.</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/enter">Home</a></li>
            <li><a href="/about">About</a></li>
            <li><a href="/contact">Contact</a></li>
            <!-- ************************************************************************************************
                 Check to see if username is set to verify if user is authenticated.  This is used for DRY principle.
                 Only show dropdown functions and signout on authenticated user pages. 
                 ********************************************************************************************* -->
            @if(isset(Auth::user()->username))
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Site Functions <span class="caret"></span></a>
              <ul class="dropdown-menu" role="menu">
                @if(Auth::user()->is('CSC_client'))
                <li class="dropdown-header">CSC Client Functions</li>
                <li><a href="/read-service">Display (read) Services</a></li>
                <li><a href="/read-order">Display (read) Orders</a></li>
                @elseif(Auth::user()->is('CSC_Employee'))
                <li class="dropdown-header">CSC Employee Functions</li>
                <li><a href="/read-service">Display (read) Services</a></li>
                <li><a href="/create-client">Create Clients</a></li>
                <li><a href="/read-client">Display (read) Clients</a></li>
                <li><a href="/update-client">Modify (update) Clients</a></li>
                <li><a href="/create-order">Create Orders</a></li>
                <li><a href="/read-order">Display (read) Orders</a></li>
                @else
                <li class="dropdown-header">CSC Admin Functions</li>
                <li><a href="/create-service">Create Services</a></li>
                <li><a href="/read-service">Display (read) Services</a></li>
                <li><a href="/update-service">Modify (update/delete) Services</a></li>
                <li><a href="/create-client">Create Clients</a></li>
                <li><a href="/read-client">Display (read) Clients</a></li>
                <li><a href="/update-client">Modify (update) Clients</a></li>
                <li><a href="/create-order">Create Orders</a></li>
                <li><a href="/read-order">Display (read) Orders</a></li>
                @endif
              </ul>
            </li>
            <li><a href="/logout">Sign Out</a></li>
            @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>

    <!-- Begin page content -->
    <div class="container">
      <div class="page-header">
        <?php include("CSC_header.php"); ?>
      </div>
        @yield('page_title')
        @yield('description')
        @yield('content')
    </div>

    <footer class="footer">
      <div class="container">
        <p>W3C Validated
        <img src="images/HTML5.png" width="31" height="31" alt="HTML 5">
        <img src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!" width="88" height="31"/>
        </p>
      </div>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="js/ie10-viewport-bug-workaround.js"></script>

  </body>
</html>