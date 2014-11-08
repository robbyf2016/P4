<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>@yield('title','- Robby Fussell')</title>
<link href="twoColFixLtHdr.css" rel="stylesheet" type="text/css" />
</head>

		<body>
        
        	<div id="container">
            	<div id="header">
        			<?php include("CSC_header.php"); ?>
                </div>
                <div id="navigation">
                    @yield('navigation')
                </div>
                
                <div id="content">
                	<h2>@yield('page_title')</h2>
                    @yield('description')
					@yield('content')
            	</div>
               
                <div id="footer">
                	<p>W3C Validated
					<img src="images/HTML5.png" width="31" height="31" alt="HTML 5">
					<img src="http://jigsaw.w3.org/css-validator/images/vcss-blue" alt="Valid CSS!" width="88" height="31"/>
    				</p>
                </div>
            </div>

		</body>

		
</html>