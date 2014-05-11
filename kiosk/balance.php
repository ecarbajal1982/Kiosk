<?php

include_once '../include/common.php';
 
$mysqli = login_db_connect();

sec_session_start();

$logged = login_check( $mysqli );

if ( !( $logged ) )
	header( 'Location: login.php' );
	
?>
<!DOCTYPE HTML>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="img/t.ico">
  <!-- CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">

  <!-- Javascript -->
  <script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/bootstrap-typeahead.js"></script> 
  <script type="text/JavaScript" src="js/sha512.js"></script> 
  <script type="text/JavaScript" src="js/main.js"></script>

	<title>Balance</title>

	

</head>
<body>

</body>
</html>
