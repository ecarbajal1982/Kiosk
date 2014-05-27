<!-- This is the paid in form -->


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

  <body>

    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
          <li class="active"><a href="../kiosk.php">Cookie Jar</a></li>
		
        </ul>
     
      </div>
     <h2><span style="color:black ">Cookie Crumbs</span></h2>
      <div class="jumbotron">
        <h1 class="header">Paid-In</h1>
	


	<!-- PUll values for time and date -->
		<?php 
			$date = date("m-d-Y");
			$time = date("h:i:sa");
			$user = $_SESSION['username'];

			        //Grabs the last element in the paid_in_column
        if ( $insert_stmt = $mysqli->prepare(
									 "SELECT paid_in_number FROM paid_in_test
									  ORDER BY paid_in_number DESC
									  LIMIT 1" ) )
			
			
        		// Execute the prepared query.
           $insert_stmt->execute();
			  $insert_stmt->store_result();
			  $insert_stmt->bind_result( $next_paid_in);
			  $insert_stmt->fetch();
	
				
			

		?>


	
		<div>
	<form class="form-horizontal" role="form" action="../inserts/insert_paid_in.php" method='post'>

		<!-- Hidden inputs not shown to the user -->
	<input type="hidden" id="user" value="<?php echo $user;?>" name="user">
	<input type="hidden" id="paid_in_number" value="" name="paid_in_number">
	<input type="hidden" id="date" value="<?php echo $date;?>" name="date">
	<input type="hidden" id="time" value="<?php echo $time;?>" name="time">
	<input type="hidden" id="paid_out_number" name="paid_out_number" value="<?php echo $next_paid_in + 1;?>" >


		  <div class="form-group">
  			  <label for="paid_in_show" class="col-sm-5 control-label">Paid-In Number</label>
			    <div class="col-sm-5">
   				   <input type="text" class="form-control" id="paid_in" name="paid_in_show"  disabled value="<?php echo $next_paid_in + 1 ;?>">
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
  			  <label for="inputPassword3" class="col-sm-5 control-label">Time</label>
			    <div class="col-sm-5">
   				   <input type="text" class="form-control" id="inputPassword3"  disabled value="<?php echo $time;?>">
   			 </div>
		  </div><hr>


		  <div class="form-group">
  			  <label for="paid_out_show" class="col-sm-5 control-label">Paid-Out Number</label>
			    <div class="col-sm-5">
   				   <input type="text" class="form-control" id="paid_out_show"  name ="paid_out_show" disabled  value="<?php echo $next_paid_in + 1;?>">
   			 </div>
		  </div><hr>

<div>
<fieldset data-role="controlgroup" data-mini="true">
    	<input type="radio" name="shift" id="days" value="days" />
    	<label for="days"><span class="glyphicon glyphicon-fire"></span>Days</label>

	<input type="radio" name="shift" id="swing" value="swing"  />
    	<label for="swing"><span class="glyphicon glyphicon-gbp"></span>Swing</label>
    	
    	<input type="radio" name="shift" id="grave" value="grave"  />
    	<label for="grave"><span class="glyphicon glyphicon-wrench"></span>Grave</label>
</fieldset>
</div> <hr>


		  <div class="form-group">
  			  <label for="kiosk" class="col-sm-5 control-label">Kiosk </label>
			    <div class="col-sm-5">
   				   <input type="text" class="form-control" id="kiosk" name="kiosk"  >
   			 </div>
		  </div><hr>

<div class="form-group">
<fieldset data-role="controlgroup" data-mini="true">

    	<input type="radio" name="denom" id="ones" value="ones" />
    	<label for="ones"><span class="glyphicon glyphicon-gift"></span>Ones</label>

	<input type="radio" name="denom" id="five_i" value="five_i"  />
    	<label for="five_i"><span class="glyphicon glyphicon-random"></span>Five I</label>
    	
	<input type="radio" name="denom" id="five_j" value="five_j"  />
    	<label for="five_j"><span class="glyphicon glyphicon-screenshot"></span>Five J</label><hr>

	<input type="radio" name="denom" id="twenty_e" value="twenty_e"  />
    	<label for="twenty_e"><span class="glyphicon glyphicon-facetime-video"></span>Twenty E</label>

    	<input type="radio" name="denom" id="twenty_f" value="twenty_f"  />
    	<label for="twenty_f"><span class="glyphicon glyphicon-plane"></span>Twenty F</label>

   	<input type="radio" name="denom" id="hundreds" value="hundreds"  />
    	<label for="hundreds"><span class="glyphicon glyphicon-eye-open"></span>Hundreds</label>
</fieldset>
</div><hr>

		  <div class="form-group">
  			  <label for="paid_in_amount" class="col-sm-5 control-label">Paid-In Amount </label>
			    <div class="col-sm-5">
   				   <input type="text" class="form-control" id="paid_in_amount" placeholder="Paid-In Amount" name="paid_in_amount" >
   			 </div>
		  </div><hr>


		  <div class="form-group">
  			  <label for="inputPassword3" class="col-sm-5 control-label">Paid-Out Amount </label>
			    <div class="col-sm-5">
   				   <input type="text" class="form-control" id="inputPassword3"  >
   			 </div>
		  </div><hr>


		  <div class="form-group">
  			  <label for="in_seal" class="col-sm-5 control-label">Incoming Seal</label>
			    <div class="col-sm-5">
   				   <input type="text" class="form-control" id="in_seal" name="in_seal" >
   			 </div>
		  </div><hr>

		  <div class="form-group">
  			  <label for="out_seal" class="col-sm-5 control-label">Outgoing Seal</label>
			    <div class="col-sm-5">
   				   <input type="text" class="form-control" id="out_seal" name="out_seal" >
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
  

</body></html>
