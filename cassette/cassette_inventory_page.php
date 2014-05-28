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
  <link rel="stylesheet" type="text/css" media="all" href="css/styles.css">
  <script type="text/javascript" src="../js/jquery-2.1.0.min.js"></script>
  <script type="text/javascript" src="../js/jquery.tablesorter.min.js"></script>


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
            <li class="active"><a href="../kiosk.php">Home</a></li>
            <li><a href="./add_cassette_page.php">Add Cassette</a></li>
            <li><a href="./delete_cassette_page.php">Delete Cassette</a></li>
          </ul>

        </div>
        <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main">
          <h1 class="page-header">Cassette Inventory</h1>          
          <div class="" id="wrapper">
            <table class="tablesorter table table-striped " id="cassette_table">
              <thead>
                <tr>
				  <th>Cassette ID</th>
                  <th>Prefix</th>
                  <th>Number</th>
				  <th>Denomination</th>
				  <th>Location</th>
                </tr>
              </thead>
              <tbody>
<?php

	$results = mysqli_query($mysqli ,"SELECT * FROM `inventory_table` WHERE `cassette_id`");

	while($row = mysqli_fetch_array($results)) {
		 echo "<tr>";
		 echo"<td class='lalign'>".$row['cassette_id']."</td>";
		 echo "<td>" . $row['prefix'] . "</td>";
		 echo "<td>" . $row['number']."</td>";
	     echo "<td>" . $row['denom']."</td>";
		 echo "<td>" . $row['location']."</td>";
		 echo "</tr>";
 	 

}
?> 		
             </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

<script type="text/javascript">
$(function(){
  $('#cassette_table').tablesorter(); 
});
</script>

</body></html>
