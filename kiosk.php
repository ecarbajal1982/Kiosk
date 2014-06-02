<!-- This is the file that will be the inception of the projcet. From here, we will be able
to make all the selections for the kiosks. THIS IS KIOSK.PHP  -->

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
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
			<li><a href="./paid_in_out/paid-in.php">Paid-In / Paid-Out </a></li>
            <li><a href="./cassette/paid_in_search.php">Paid-In Search</a></li> 
   		    <li><a href="./cassette/paid_out_search.php">Paid-Out Seach</a></li> 
            <li><a href="./cassette/cassette_inventory_page.php">Cassette Inventory</a></li>          
            <li><a href="./kiosk_list/kiosk_list.php">Kiosks</a></li>
			<li><a href="./atm/atm_paid_out.php">ATM Paid-Out</a><li>
			<li><a href="./stackers/stakers.php">Stackers</a></li>
			<li><a href="./check_in_out/check-out.php">Check-Out</a></li>
			<li><a href="./balance/balance.php">Balance Kiosk</a></li>
          </ul>
			<div style="background-image: url(img/pechanga_seal.jpg); height: 100px; width: 65%;"></div>		
		</div>

        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header"><?php echo "Welcome ". $_SESSION['username']  ." to " ?> CookieCrumbs</h1>

    <!-- Carousel
    ================================================== -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>
      <div class="carousel-inner">
        <div class="item active">
          <img src="img/pechanga_ladies.jpg" alt="First slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Pechanga Resort and Casino</h1>

            </div>
          </div>
        </div>
        <div class="item">
          <img src="img/pechanga.jpg" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
            </div>
          </div>
        </div>
        <div class="item">
          <img src="img/silk.jpg" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
			<h1>Club Silk</h1>
            </div>
          </div>
        </div>
        <div class="item">
          <img src="img/round_bar.jpg" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
            </div>
          </div>
        </div>
        <div class="item">
          <img src="img/journey.jpg" alt="Second slide">
          <div class="container">
            <div class="carousel-caption">
            </div>
          </div>
        </div>
        <div class="item">
          <img src="img/pechanga_1.png" alt="Third slide">
          <div class="container">
            <div class="carousel-caption">
              <h1>Fun! Exilarating! Rewarding!</h1>
              <p><a class="btn btn-lg btn-primary" href="http://pechanga.com" role="button">Pechanga.com</a></p>
            </div>
          </div>
        </div>
      </div>
      <a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
    </div><!-- /.carousel -->


          <div class="row placeholders"  style=" background:img/water_1.jpg">
  				
				<footer>
					<center><h5><font color="gray">ecarb &copy 2014</h5></center>
				</footer>
          </div>

  
            
 

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="js/jquery-2.1.0.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="./Dashboard Template for Bootstrap_files/docs.min.js"></script>
  

</body></html>
