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

    <title>Kiosks List</title>

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
          </button>
          <a class="navbar-brand" href="../kiosk.php">CookieCrumbs</a>
        </div>
        <div class="navbar-collapse collapse">
          <ul class="nav navbar-nav navbar-right">

            <li><a href="../nclude/process_logout.php">Logout</a></li>
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
            <li class="active"><a href="./Dashboard Template for Bootstrap_files/Dashboard Template for Bootstrap.html">Overview</a></li>
            <li><a href="./Dashboard Template for Bootstrap_files/Dashboard Template for Bootstrap.html">Reports</a></li>
            <li><a href="./Dashboard Template for Bootstrap_files/Dashboard Template for Bootstrap.html">Analytics</a></li>
            <li><a href="./Dashboard Template for Bootstrap_files/Dashboard Template for Bootstrap.html">Export</a></li>
          </ul>

        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Kiosk List</h1>



          
          <div class="table-responsive">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Kiosk Number</th>
                  <th>Location</th>
                  <th>Start Balance Date</th>
		  <th>Start Balance Time</th>
                  <th>End Balance Date</th>
		  <th>End Balance Time</th>
		  <th>Shift</th>
                  <th>Last Variance</th>
                </tr>
              </thead>
              <tbody>

<?php

	$results = mysqli_query($mysqli ,"SELECT * FROM `kiosk_table` WHERE `kiosk_id`");

	while($row = mysqli_fetch_array($results)) {
		 echo "<tr>";
		 echo "<td>" . $row['kiosk_id'] . "</td>";
		 echo "<td>" . $row['location'] . "</td>";
		 echo "<td>" . $row['start_balance_date']."</td>";
		 echo "<td>" . $row['start_balance_time']."</td>";
		 echo "<td>" . $row['end_balance_date']."</td>";
		 echo "<td>" . $row['end_balance_time']."</td>";
		 echo "<td>" . $row['shift']."</td>";
      	  	 echo "<td>" . $row['last_variance']."</td>";
		 echo "</tr>";
 	 

}
?> 


		
             </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="./Dashboard Template for Bootstrap_files/jquery.min.js"></script>
    <script src="./Dashboard Template for Bootstrap_files/bootstrap.min.js"></script>
    <script src="./Dashboard Template for Bootstrap_files/docs.min.js"></script>
  

</body></html>
