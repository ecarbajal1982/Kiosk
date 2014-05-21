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

    <title>Balance</title>

    <!-- Bootstrap core CSS -->
    <link href="../css/bootstrap.css" rel="stylesheet">   
    <script type="text/javascript" src="../css/select/bootstrap-select.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/select/bootstrap-select.css">


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
        <h1 class="header">Balance</h1>
	


	<!-- PUll values for time and date -->
		<?php 
			$date = date("m-d-Y");
			$time = date("h:i:sa");
			$user = $_SESSION['username'];

			        //Grabs the last element in the paid_in_column
        if ( $insert_stmt = $mysqli->prepare(
									 "SELECT balance_id FROM balance
									  ORDER BY balance_id DESC
									  LIMIT 1" ) )
			
			
        		// Execute the prepared query.
           $insert_stmt->execute();
			  $insert_stmt->store_result();
			  $insert_stmt->bind_result( $next_balance);
			  $insert_stmt->fetch();	
		?>
	
	<div>
	<form class="form-horizontal" role="form" action="insert_balance.php" method='post'>

		<!-- Hidden inputs not shown to the user -->
	<input type="hidden" id="user" value="<?php echo $user;?>" name="user">
	<input type="hidden" id="date" value="<?php echo $date;?>" name="date">
	<input type="hidden" id="time" value="<?php echo $time;?>" name="time">
	<input type="hidden" id="balance_id" name="balance_id" value="" >
	<input type="hidden" id="balance_total" name="balance_total" value="">
	<input type="hidden" id="balance_over_short" name="balance_over_short" value="">

		  <div class="form-group">
   		 <label for="stacker_number_show" class="col-xs-2 control-label">Balance Number</label>
   	 <div class="col-xs-3">
   	   <input type="text" class="form-control" id="stacker_number_show" name="balance_number_show" disabled value="<?php echo $next_balance + 1;?>">
   	 </div>
    <label for="date_show" class="col-xs-2 control-label">Date</label>
    <div class="col-xs-3">
      <input type="text" class="form-control" id="date_show" name="date_show" disabled value="<?php echo $date;?>">
    </div>


 		 </div><hr>
		  <div class="form-group">
   		 <label for="user_show" class="col-xs-2 control-label">Badge</label>
   <div class="col-xs-3">
   	   <input type="text" class="form-control" id="user_show" name="user_show" disabled value="<?php echo $user;?>">
   	 </div>
  	  <label for="time_show" class="col-xs-2 control-label">Time</label>
	 <div class="col-xs-3">
   	    <input type="text" class="form-control" id="time_show" name="time_show" disabled value="<?php echo $time;?>">
   	 </div>

  </div><hr>

  <div class="form-group">
   	 <label for="user_show" class="col-xs-2 control-label">Kiosk</label>
   <div >
   	  <select id="kiosk">
		<option value="701">701</option>
		<option value="702">702</option>
		<option value="703">703</option>
		<option value="704">704</option>
		<option value="705">705</option>
		<option value="706">706</option>
		<option value="707">707</option>
		<option value="708">708</option>
		<option value="709">709</option>
		<option value="710">710</option>
		<option value="711">711</option>
		<option value="712">712</option>
		<option value="713">713</option>
		<option value="714">714</option>
		<option value="715">715</option>
		<option value="716">716</option>
	</select>
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
   <label for="ones" class="col-xs-2 control-label">$1</label>
   <div class="col-xs-3">
     <input type="text" class="form-control" id="ones" placeholder="Washingtons" name="ones" >
   </div>
   <label for="fives" class="col-xs-2 control-label">$5</label>
   <div class="col-xs-3">
     <input type="text" class="form-control" id="fives" placeholder="Abes'" name="fives" >
   </div>
</div><hr>

<div class="form-group">
   <label for="tens" class="col-xs-2 control-label">$10</label>
   <div class="col-xs-3">
     <input type="text" class="form-control" id="tens" placeholder="Hamiltons" name="tens" >
   </div>
   <label for="twenty" class="col-xs-2 control-label">$20</label>
   <div class="col-xs-3">
     <input type="text" class="form-control" id="twenty" placeholder="Jacksons" name="twenty" >
   </div>
</div><hr>

<div class="form-group">
   <label for="fifty" class="col-xs-2 control-label">$50</label>
   <div class="col-xs-3">
     <input type="text" class="form-control" id="fifty" placeholder="Grants" name="fifty" >
   </div>
   <label for="hundred" class="col-xs-2 control-label">$100</label>
   <div class="col-xs-3">
     <input type="text" class="form-control" id="hundred" placeholder="Hundos" name="hundred" >
   </div>
</div><hr>

<div class="form-group">
   <label for="ticket_total" class="col-xs-2 control-label">Ticket</label>
   <div class="col-xs-3">
     <input type="text" class="form-control" id="ticket_total" placeholder="Tickets" name="ticket_total" >
   </div>
   <label for="stacker_total" class="col-xs-2 control-label">Stacker</label>
   <div class="col-xs-3">
     <input type="text" class="form-control" id="stacker_total" placeholder="" name="stacker_total" >
   </div>
</div><hr>
<div class="form-group">
   <label for="cash_paid_ins" class="col-xs-2 control-label">Cash Paid-Ins</label>
   <div class="col-xs-3">
     <input type="text" class="form-control" id="cash_paid_ins" placeholder="" name="cash_paid_ins" >
   </div>
   <label for="reject_paid_ins" class="col-xs-2 control-label">Reject Paid-Ins</label>
   <div class="col-xs-3">
     <input type="text" class="form-control" id="reject_paid_ins" placeholder="" name="reject_paid_ins" >
   </div>
</div><hr>

<div class="form-group">
   <label for="cash_paid_outs" class="col-xs-2 control-label">Cash Paid-Outs</label>
   <div class="col-xs-3">
     <input type="text" class="form-control" id="cash_paid_outs" placeholder="" name="cash_paid_outs" >
   </div>
   <label for="coin_paid_outs" class="col-xs-2 control-label">Coin Paid-Outs</label>
   <div class="col-xs-3">
     <input type="text" class="form-control" id="coin_paid_outs" placeholder="" name="coin_paid_outs" >
   </div>
</div><hr/>

<div class="form-group">
   <label for="atm_net_amount" class="col-xs-2 control-label">ATM Net </label>
   <div class="col-xs-3">
     <input type="text" class="form-control" id="atm_net_amount" placeholder="" name="atm_net_amount" >
   </div>
   <label for="atm_fill_number" class="col-xs-2 control-label">ATM Fill Number</label>
   <div class="col-xs-3">
     <input type="text" class="form-control" id="atm_fill_number" placeholder="" name="atm_fill_number">
   </div>
</div><hr>



  <div class="form-group">

    <label for="comments" class="col-xs-2 control-label">Comments</label>
    <div class="col-xs-10">
      <input type="text" id="comments" class="form-control" name="comments">
    </div>	
  </div><br>	
  <div class="form-group">
    <div class="">
      <input type="submit" class="btn btn-info btn-block">
    </div>
  </div>
</form>
</div><!-- END OF FORM DIV -->
<hr>


<div class="form-group">
<button onclick="myFunction()" class="btn btn-danger btn-block">Calculate </button>
</div>
<hr>

  <div class="row">
		<div class="col-sm-2"> 
 			 <p>Total</p>
    	</div>
		<div class="col-sm-2">
     	 <p id="demo"> </p>
   		</div>
		<div class="col-sm-3">
			<p>Over/Short</p>
		</div>
		<div class="col-sm-3">
			<p id="demo1"></p>
		</div>
		
  </div><br>

<script>
function myFunction() {


    var ones =  parseInt (document.getElementById("ones").value) ;
    var fives = parseInt (document.getElementById("fives").value );
    var tens = parseInt( document.getElementById("tens").value) ;
    var twenty = parseInt( document.getElementById("twenty").value) ;
    var fifty = parseInt( document.getElementById("fifty").value) ;
    var hundred = parseInt( document.getElementById("hundred").value) ;
	var ticket_total = parseFloat (document.getElementById("ticket_total").value);
	var stacker_total = parseFloat (document.getElementById("stacker_total").value);
    var cash_paid_ins = parseInt( document.getElementById("cash_paid_ins").value) ;
    var reject_paid_ins = parseInt( document.getElementById("reject_paid_ins").value) ;
    var cash_paid_outs = parseInt( document.getElementById("cash_paid_outs").value) ;
	var coin_paid_outs = parseFloat (document.getElementById("coin_paid_outs").value);
    var atm_net_amount = parseInt( document.getElementById("atm_net_amount").value) ;

    var total  = ones  + fives + tens + twenty + fifty + hundred + ticket_total 
        + stacker_total + cash_paid_ins + reject_paid_ins - cash_paid_outs  - coin_paid_outs + atm_net_amount;
	var twofloat = parseFloat( total).toFixed(2);

	//Compute the over/short
	var over_short = twofloat - 219000;
	var float_over_short = parseFloat(over_short).toFixed(2);
    document.getElementById("demo").innerHTML = twofloat;
    document.getElementById("demo1").innerHTML = float_over_short;
    document.getElementById("balance_total").innerHTML = twofloat;
    document.getElementById("balance_over_short").innerHTML = float_over_short;
}
</script>

</div>
      </div><!-- End of Jumbotron div -->

 

      <div class="footer">
	<center><span style="color:#1990d5"> <p>ecarb &copy 2014</span></p></center>
      </div>

    </div> <!-- /container -->






</body></html>
