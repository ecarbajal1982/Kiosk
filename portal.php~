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

<? 
	include_once 'include/html_head.php'; 
	include_once 'include/modal_index.php';
?>

<link rel="shortcut icon" href="http://www.csusb.edu/images/favicon.ico">

</head>
<body style="padding-top: 60px">

<!-- Top panel-->
<div class="container" id="navbar">
  <? include 'include/template/navbar.php'; ?>
</div>


<!-- Bottom panel -->
<div class="container">
  <div class="row">


	<!-- Main Section -->
    <div id="main_content">
	  <? include "include/template/main.php"; ?>


    </div><!-- end main section -->

  </div><!-- end row -->

</div><!-- end container -->
  
</body>
</html>
