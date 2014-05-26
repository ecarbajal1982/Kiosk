<?php

include_once 'include/common.php';
 
$mysqli = login_db_connect();

sec_session_start();

$logged = login_check( $mysqli );

if ( !( $logged ) )
	header( 'Location: login.php' );
	
?>
<!DOCTYPE html>
<!-- saved from url=(0044)http://getbootstrap.com/examples/dashboard/# -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/c.ico">

    <title>Home</title>

    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/dashboard/dashboard.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  <style id="holderjs-style" type="text/css"></style></head>

  <body style="">

    <div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">        
            <li><a href="include/process_logout.phpl">Logout</a></li>
          </ul>
          <form class="navbar-form navbar-right">
            <input type="text" class="form-control" placeholder="Search...">
          </form>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
			<li><a href="kiosk/paid-in.php">Paid-In </a></li>
            <li><a href="kiosk/inventory.php">Cassette Inventory</a></li>
          
            <li><a href="kiosk/kiosks.php">Kiosks</a></li>
			<li><a href="kiosk/atm_paid_out">ATM Paid-Out</a><li>
			<li><a href="kiosk/stakers.php">Stacker</a></li>
			<li><a href="kiosk/check-out.php">Check-Out</a></li>
			<li><a href="kiosk/check-in.php">Check-In</a></li>
			<li><a href="kiosk/balance.php">Balance Kiosk</a></li>
          </ul>
		<div style="background-image: url(img/pechanga_seal.jpg); height: 100px; width: 65%;"></div>
		
		</div>

        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><?php echo "Welcome ". $_SESSION['username']  ." to " ?> CookieCrumbs</h1>

          <div class="row placeholders"  style=" background:img/water_1.jpg">
  				<div style="background-image: url(img/water_1.jpg); height: 500px; width: 100%;">	
				</div>
				<footer>
					<center><h5><font color="gray">ecarb &copy 2014</h5></center>
				</footer>
          </div>

  
            
 

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./Dashboard Template for Bootstrap_files/jquery.min.js"></script>
    <script src="./Dashboard Template for Bootstrap_files/bootstrap.min.js"></script>
    <script src="./Dashboard Template for Bootstrap_files/docs.min.js"></script>
  

</body></html>
