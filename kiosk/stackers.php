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

    <title>Stacker</title>

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

  <body >

    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="../kiosk.php">Cookie Jar</a></li>
		
        </ul>
     
      </div>
     <h2><span style="color:Black ">Cookie Crumbs</span></h2>
      <div class="jumbotron">
        <h1 class="header">Stacker</h1>
	


	<!-- PUll values for time and date -->
		<?php 
			$date = date("m-d-Y");
			$time = date("h:i:sa");
			$user = $_SESSION['username'];

			        //Grabs the last element in the paid_in_column
        if ( $insert_stmt = $mysqli->prepare(
									 "SELECT stacker_number FROM stackers
									  ORDER BY stacker_number DESC
									  LIMIT 1" ) )
			
			
        		// Execute the prepared query.
           $insert_stmt->execute();
			  $insert_stmt->store_result();
			  $insert_stmt->bind_result( $next_stacker);
			  $insert_stmt->fetch();
	
				
			

		?>


	
		<div>
	<form class="form-horizontal" role="form" action="insert_stackers.php" method='post'>

		<!-- Hidden inputs not shown to the user -->
	<input type="hidden" id="user" value="<?php echo $user;?>" name="user">
	<input type="hidden" id="date" value="<?php echo $date;?>" name="date">
	<input type="hidden" id="time" value="<?php echo $time;?>" name="time">
	<input type="hidden" id="stacker_number" name="stacker_number" value="" >

		  <div class="form-group">
   		 <label for="stacker_number_show" class="col-sm-5 control-label">Stacker Number</label>
   	 <div class="col-sm-5">
   	   <input type="text" class="form-control" id="stacker_number_show" name="stacker_number_show" disabled value="<?php echo $next_stacker + 1;?>">
   	 </div>


 		 </div><hr>
		  <div class="form-group">
   		 <label for="user_show" class="col-sm-5 control-label">Badge</label>
   	 <div class="col-sm-5">
   	   <input type="text" class="form-control" id="user_show" name="user_show" disabled value="<?php echo $user;?>">
   	 </div>


 		 </div><hr>

		  <div class="form-group">
    <label for="date_show" class="col-sm-5 control-label">Date</label>
    <div class="col-sm-5">
      <input type="text" class="form-control" id="date_show" name="date_show" disabled value="<?php echo $date;?>">
    </div>
  </div><hr>


		  <div class="form-group">
  			  <label for="time_show" class="col-sm-5 control-label">Time</label>
			    <div class="col-sm-5">
   				   <input type="text" class="form-control" id="time_show" name="time_show" disabled value="<?php echo $time;?>">
   			 </div>
		  </div><hr>




<div class="form-group">



<fieldset data-role="controlgroup">
    	<input type="radio" name="shift" id="days" value="days" />
    	<label for="days"><span class="glyphicon glyphicon-fire"></span>Days</label>

	<input type="radio" name="shift" id="swing" value="swing"  />
    	<label for="swing"><span class="glyphicon glyphicon-gbp"></span>Swing</label>
    	
    	<input type="radio" name="shift" id="grave" value="grave"  />
    	<label for="grave"><span class="glyphicon glyphicon-wrench"></span>Grave</label>
</fieldset>
</div><hr>

<div class="form-group">
  			  <label for="kiosk" class="col-sm-5 control-label">Kiosk</label>
			    <div class="col-sm-5">
   				   <input type="text" class="form-control" id="kiosk" placeholder="Kiosk Number" name="kiosk" >
   			 </div>
</div><hr>




		  <div class="form-group">
  			  <label for="ticket_amount" class="col-sm-5 control-label">Ticket Amount</label>
			    <div class="col-sm-5">
   				   <input type="text" class="form-control" id="ticket_amount" placeholder="$$$$" name="ticket_amount" >
   			 </div>
		  </div><hr>
		  <div class="form-group">
  			  <label for="cash_amount" class="col-sm-5 control-label">Cash Amount </label>
			    <div class="col-sm-5">
   				   <input type="text" class="form-control" id="cash_amount" name="cash_amount" >
   			 </div>
		  </div><hr>

			  <div class="form-group">
  			  <label for="atm_amount" class="col-sm-5 control-label">ATM Amount </label>
			    <div class="col-sm-5">
   				   <input type="text" class="form-control" id="atm_amount" name="atm_amount" placeholder="" >
   			 </div>
		  </div><hr>

		  <div class="form-group">
  			  <label for="atm_paid_out_number" class="col-sm-5 control-label">ATM Paid-Out Number</label>
			    <div class="col-sm-5">
   				   <input type="text" class="form-control" id="atm_paid_out_number" name="atm_paid_out_number" placeholder="" >
   			 </div>
		  </div><hr>
			  <div class="form-group">
  			  <label for="stacker_total" class="col-sm-5 control-label">Stacker Total  </label>
			    <div class="col-sm-5">
   				   <input type="text" class="form-control" id="stacker_total" name="stacker_total" placeholder="" >
   			 </div>
		  </div><hr>
	
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

     <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./Carousel Template for Bootstrap_files/jquery.min.js"></script>
    <script src="./Carousel Template for Bootstrap_files/bootstrap.min.js"></script>
    <script src="./Carousel Template for Bootstrap_files/docs.min.js"></script>

</body></html>
