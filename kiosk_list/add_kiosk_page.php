<?php

include_once '../include/common.php';

$mysqli = login_db_connect() or die("Insert_stacker.php. Cannot connect to DB");

sec_session_start();
date_default_timezone_set("America/Los_Angeles");

$logged = login_check( $mysqli );
if(! $logged )
	header( 'Location: ../login.php' );

?>
<!DOCTYPE html>
<!-- saved from url=(0044)http://getbootstrap.com/examples/dashboard/# -->
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../img/c.ico">

    <title>Add Kiosk</title>

    <!-- Bootstrap core CSS -->
 	  <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">
	  <link href="http://getbootstrap.com/examples/dashboard/dashboard.css" rel="stylesheet">
   	  <link rel="stylesheet" type="text/css" media="all" href="css/styles.css">
      <link href="http://cdn.datatables.net/1.10.0/css/jquery.dataTables.css" rel="stylesheet">
  

  <!-- Custom styles for this template -->
 	 <script type="text/javascript" src="../js/jquery-2.1.0.min.js"></script>
  	 <script type="text/javascript" src="../js/jquery.tablesorter.min.js"></script>
     <script type="text/javasript" src="../js/oneSimpleTablePaging-1.0.js"></script>
     <script type="text/javascript" src="http://cdn.datatables.net/1.10.0/js/jquery.dataTables.js"></script>


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
          </button>
          <a class="navbar-brand" href="../kiosk.php">CookieCrumbs</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">

            <li><a href="../include/process_logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </div>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-3 col-md-2 sidebar">
          <ul class="nav nav-sidebar">
            <li class="active"><a href="../kiosk.php">Home</a></li>         
            <li><a href="./remove_kiosk_page.php">Remove Kiosk</a></li>
		    <li><a href="./kiosk_list.php">Kiosk Inventory</a></li> 
          </ul>

        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Add New Kiosk to Inventory</h1>          
          <div class="table-responsive">
				<form method="POST" name="add_kiosk" action="../inserts/insert_kiosk.php">
            <table class="table table-striped">
              <thead>
                <tr>        
                  <th>Kiosk Number</th>
				  <th>Location</th>
				  <th>Shift</th>
                </tr>
              </thead>
              <tbody>
				<tr>
					<td>

						<input type="text" name="number" id="number"></td>
					<td>
					<select name="location" id="location"class="btn btn-info">
 						 <option value="Comedy Club">Comedy Club</option>
				  	     <option value="Main Cage">Main Cage</option>
 				  	     <option value="North Walkway">North Walkway</option>
				         <option value="Cabaret">Cabaret</option>
 						 <option value="Oak">Oak</option>
					     <option value="Grotto">Grotto</option>
				         <option value="High Limit">High Limit</option>
 						 <option value="Kelsey">Kelsey</option>
					     <option value="Sumac">Sumac</option>
				         <option value="Casino Valet">Casino Valet</option>
 						 <option value="Bamboo">Bamboo</option>
					     <option value="Poker">Poker</option>
				         <option value="Mountain">Mountain</option>
 						 <option value="Fast Pass">Fast Pass</option>			
			    	</select>
					</td>
					<td>
						<select name="shift" id="shift" class="btn btn-warning" >
					     <option value="Days">Days</option>
				         <option value="Swing">Swing</option>
 						 <option value="Graveyard">Graveyard</option>
						</select>
					</td>
				</tr>

		
             </tbody>
            </table>
		<input type="submit" value="Add Kiosk" name="add_kiosk" id="add_kiosk" class="btn btn-lg btn-success">
		  </form>
          </div>
        </div>
      </div>
    </div>



</body></html>
