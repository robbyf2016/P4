<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta name="description" content="CSC Homepage">
<meta name="author" content="Robby Fussell">
<title>Cyber Security Consultants, LLC.</title>
<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="css/cover.css" rel="stylesheet">
<link href="css/CSC.css" rel="stylesheet"
<link rel="icon" href="images/favicon.ico">
</head>

<body>

	<!-- Boostrap code here that references Bootstrap CSS with personalized content 
		 This is the main landing page of the site -->

@if(Session::get('flash_message'))
	<div class="flash-message">{{ Session::get('flash_message') }}</div>
@endif

<div class="site-wrapper">

      <div class="site-wrapper-inner">

        <div class="cover-container">

          <div class="masthead clearfix">
            <div class="inner">
              <h3 class="masthead-brand">CyberSecurity Consultants, LLC.</h3>
              <nav>
                <ul class="nav masthead-nav">
                  <li class="active"><a href="#">Home</a></li>
                  <li><a href="#">Contact</a></li>
                  <li><a href="/user">Sign Up</a></li>
                </ul>
              </nav>
            </div>
          </div>

          <div class="inner cover">
          	<img src="images/CyberSecurityprototype 2.png" height=200px width=200px>
            <h1 class="cover-heading">CyberSecurity Consultants, LLC.</h1>
            <p class="lead">The purpose of this site is to demonstrate various PHP application requests to a database, implementation of routes, blades, and other PHP and Laravel functionality.  The web application enters data into the database via a form or provides an option to produce some desired output.  This site is monitored and all actions recorded.</p>
            <p class="lead">
              <a href="/enter" class="btn btn-lg btn-default">Enter Site</a>
            </p>
          </div>

          <div class="mastfoot">
            <div class="inner">
              <p>Copyright <a href="http://">CyberSecurity Consultants, LLC.</a>, by <a href="https://twitter.com/robbyf23">Robby Fussell</a>.</p>
            </div>
          </div>

        </div>

      </div>

    </div>

</body>
</html>