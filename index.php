<?php

include_once 'include/common.php';

$mysqli = login_db_connect();

sec_session_start();

$logged = login_check( $mysqli );

if ( isset( $_GET['error'] ) )
{
	$user = $_GET['user'];
	$error = $_GET['error'];

	if ( $logged )
		header( 'Location: portal.php?error=' .$error );

	else
		header( 'Location: login.php?user=' .$user. '&error=' .$error );
}

else
{
	if ( $logged )
		header( 'Location: kiosk.php' );

	else
		header( 'Location: login.php' );
}

?>
<link rel="shortcut icon" href="t.ico">

