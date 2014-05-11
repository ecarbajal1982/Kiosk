<?php

include_once 'include/common.php';
 
$mysqli = login_db_connect();

sec_session_start();

$logged = login_check( $mysqli );

if ( !( $logged ) )
	header( 'Location: login.php' );
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>CAL Inventory</title>

	<link rel="shortcut icon" href="http://www.csusb.edu/images/favicon.ico">

  <!-- CSS -->

  <link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/jquery.tablesorter.pager.css">
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">

  <!-- Javascript -->
  <script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
  <script type="text/javascript" src="js/jquery.tablesorter.js"></script>
  <script type="text/javascript" src="js/jquery.tablesorter.pager.js"></script>
  <script type="text/javascript" src="js/jquery.tablesorter.widgets.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/bootstrap-typeahead.js"></script> 
  <script type="text/JavaScript" src="js/sha512.js"></script> 
  <script type="text/JavaScript" src="js/main.js"></script>

</head>
<body style="padding-top: 60px; padding-bottom: 20px;">

<!-- Processing Modal -->
<div class="modal" id="processingModal" style="padding-top:200px" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm">
    <div class="modal-content">
      <div class="modal-body text-center">
        <i class="fa fa-clock-o"></i> Processing...
      </div>

    </div>
  </div>
</div>


<!-- Search Modal -->
<div class="modal" id="searchModal" style="padding-top:40px" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center">
        Search
      </div>

    </div>
  </div>
</div>

<!-- Add Equipment Modal -->
<div class="modal" id="addEquipmentModal" style="padding-top:40px" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
		  <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h3 class="modal-title"><b>Choose Type &rsaquo;&rsaquo;&nbsp;</b><span>
				<button class="btn btn-primary" type="button" id="addComputer">Computer/Tablet</button>
				<button class="btn btn-primary" type="button" id="addPrinter">Network Printer</button>
				<button class="btn btn-primary" type="button" id="addOther">Other Equipment</button></span></h3>
<script>$("#addComputer").on( "click", function(){
	$( this ).parent().hide();
	$( '.modal-title' ).html( "<b>Add Computer or Tablet:</b>" );


});</script>
		  </div>
      <div class="modal-body text-center">
        Add New Equipment
      </div>

    </div>
  </div>
</div>

<!-- Add Software Modal -->
<div class="modal" id="addSoftwareModal" style="padding-top:40px" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body text-center">
        Add New Software
      </div>

    </div>
  </div>
</div>

<!-- Top panel-->
<div class="container" id="navbar">
  <?php include 'include/template/navbar.php'; ?>
</div>


<!-- Bottom panel -->
<div class="container">
  <div class="row">
	<!-- Main Section -->
    <div id="main_content">
<button id='example'>test</button>
 <script>

            $('#example').popover({
                trigger: "click",
                placement: "bottom",
                content: "This is a default title",
                });

  </script>
    </div><!-- end main section -->

  </div><!-- end row -->

</div><!-- end container -->
  
</body>
</html>
