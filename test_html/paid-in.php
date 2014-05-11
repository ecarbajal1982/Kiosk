<?php

include_once '../include/common.php';

$mysqli = login_db_connect();

sec_session_start();


$logged = login_check( $mysqli );
date_default_timezone_set("America/Los_Angeles");
if(! $logged )
	header( 'Location: login.php' );

?>


<!DOCTYPE html>
<!-- saved from url=(0050)http://getbootstrap.com/examples/jumbotron-narrow/ -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../img/c.ico">

    <title>Paid-In</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">   
	<!-- Bootstrap core JavaScript  ================================================== -->
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/jumbotron-narrow/jumbotron-narrow.css" rel="stylesheet">
   <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.5.0-rc-1/pure-min.css">
<style> 


</style>


  </head>

  <body background="../img/bp.jpg">

    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="../kiosk.php">Cookie Jar</a></li>
		
        </ul>
     
      </div>
     <h2><span style="color:white ">Cookie Crumbs</span></h2>
      <div class="jumbotron">
        <h1 class="header">Paid-In</h1>
	


	<!-- PUll values for time and date -->
		<?php 
			$date = date("m-d-Y");
			$time = date("h:i:sa");
			$user = $_SESSION['username'];

		?>


	
		<div>
	<form class="form-horizontal" action="insert_paid_in.php" method='post'>
	
		<!-- Hidden inputs not shown to the user -->
	<input type="hidden" id="user" value="<?php echo $user;?>" name="user">
	<input type="hidden" id="paid_in_number" value="" name="paid_in_number">


		  <div class="form-group">
   		 <label for="user" class="col-sm-2 control-label">Badge</label>
   	 <div class="col-sm-10">
   	   <input type="text" class="form-control" id="user_show" name="user_show" disabled value="<?php echo $user;?>">

   	 </div>
 		 </div>
	
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <input type="submit" class="btn btn-info btn-block">
    </div>
  </div>
</form>
		</div><!-- END OF FORM DIV -->

      </div><!-- End of Jumbotron div -->

  

      <div class="footer">
	<center><span style="color:#1990d5"> <p>ecarb &copy 2014</span></p></center>
      </div>

    </div> <!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  

</body></html>
