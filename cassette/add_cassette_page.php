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

    <title>Cassette Inventory</title>

    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/dashboard/dashboard.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
  <link href="http://getbootstrap.com/examples/dashboard/dashboard.css" rel="stylesheet">
  <link rel="stylesheet" type="text/css" media="all" href="css/styles.css">
  <script type="text/javascript" src="../js/jquery-2.1.0.min.js"></script>
  <script type="text/javascript" src="../js/jquery.tablesorter.min.js"></script>
  <script type="text/javasript" src="../js/oneSimpleTablePaging-1.0.js"></script>
  <link href="http://cdn.datatables.net/1.10.0/css/jquery.dataTables.css" rel="stylesheet">
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
            <li><a href="./delete_cassette_page.php">Delete Cassette</a></li>
		    <li><a href="./cassette_inventory_page.php">Inventory</a></li> 
          </ul>

        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Add New Cassette to Inventory</h1>  


        
          <div class="table-responsive">
				<form method="POST" name="add_cassette" action="../inserts/insert_cassette.php">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Prefix</th>
                  <th>Number</th>
				  <th>Denomination</th>
				  <th>Location</th>
                </tr>
              </thead>
              <tbody>
				<tr>
					<td>
					<!--This will work to change the value of the disabled box. 
					onchange="$('#denom').val($('#prefix').val())"-->
					<select name="prefix" id="prefix"class="btn btn-info" onchange="set_values()">
 						 <option value="K">K</option>
				  	     <option value="I">I</option>
 				  	     <option value="J">J</option>
				         <option value="E">E</option>
 						 <option value="F">F</option>
					     <option value="A">A</option>
			    	</select>

<script type="text/javascript">
function set_values(){

	var value_of_prefix = $('#prefix').val();
		if( value_of_prefix == "K" ){
			$('#denom').val(1);
			$('#location').val( "Kiosk Room");
			$('#denom_show').val(1);
			$('#location_show').val( "Kiosk Room");
		}
		else if ( value_of_prefix == "I") {
			$('#denom').val(5);
			$('#location').val( "Kiosk Room");
			$('#denom_show').val(5);
			$('#location_show').val( "Kiosk Room");
		}
		else if ( value_of_prefix == "J") {
			$('#denom').val(5);
			$('#location').val( "Kiosk Room");
			$('#denom_show').val(5);
			$('#location_show').val( "Kiosk Room");
		}
		else if ( value_of_prefix == "E") {
			$('#denom').val(20);
			$('#location').val( "Kiosk Room");
			$('#denom_show').val(20);
			$('#location_show').val( "Kiosk Room");
		}
		else if ( value_of_prefix == "F") {
			$('#denom').val(20);
			$('#location').val( "Kiosk Room");
			$('#denom_show').val(20);
			$('#location_show').val( "Kiosk Room");
		}
		else if ( value_of_prefix == "A") {
			$('#denom').val(100);
			$('#location').val( "Kiosk Room");
			$('#denom_show').val(100);
			$('#location_show').val( "Kiosk Room");
		}

}

</script>

					</td>
					<td><input type="text" name="number" id="number"></td>
					<td><input type="text" name = "denom_show" id="denom_show" disabled ></td>
					<td><input type="text" name="location_show" id="location_show" disabled ></td>
						<input type="text" name="denom" id="denom" hidden>
						<input type="text" name="location" id="location" hidden>
					  <input type="text" name="cassette_id" id="cassette_id" hidden value="">
				</tr>

		
             </tbody>
            </table>
		<input type="submit" value="Add Cassette" name="add_cassette" id="add_cassette" class="btn btn-success">
		  </form>
          </div>
        </div>
      </div>
    </div>



</body></html>
