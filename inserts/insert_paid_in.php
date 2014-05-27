<?php

include_once '../include/common.php';

$mysqli = login_db_connect() or die("Insert_paid_in.php. Cannot connect to DB");

sec_session_start();
date_default_timezone_set("America/Los_Angeles");

$logged = login_check( $mysqli );
date_default_timezone_set("America/Los_Angeles");
if(! $logged )
	header( 'Location: ../login.php' );

if ( isset( $_POST['paid_in_number'],  $_POST['user'] , $_POST['date'], $_POST['time'], $_POST['shift'], 
				$_POST['kiosk'], $_POST['denom'] , $_POST['paid_in_amount'], $_POST['in_seal'], $_POST['out_seal'] , $_POST['paid_out_number']) ) 
{
	$username = filter_input( INPUT_POST, 'user', FILTER_SANITIZE_STRING );
   $paid_in = filter_input( INPUT_POST, 'paid_in_number', FILTER_SANITIZE_STRING );
	$date = filter_input( INPUT_POST, 'date', FILTER_SANITIZE_STRING );
	$shift = filter_input( INPUT_POST, 'shift', FILTER_SANITIZE_STRING );
	$kiosk = filter_input( INPUT_POST, 'kiosk', FILTER_SANITIZE_STRING );
	$denom = filter_input( INPUT_POST, 'denom', FILTER_SANITIZE_STRING );
	$paid_in_amount = filter_input( INPUT_POST, 'paid_in_amount', FILTER_SANITIZE_STRING );
	$in_seal = filter_input( INPUT_POST, 'in_seal', FILTER_SANITIZE_STRING );
	$out_seal = filter_input( INPUT_POST, 'out_seal', FILTER_SANITIZE_STRING );
	$paid_out_number = filter_input( INPUT_POST, 'paid_out_number', FILTER_SANITIZE_STRING );

	 if ( $insert_stmt = $mysqli->prepare( 
				"INSERT INTO paid_in_test 
				( paid_in_number, user, date , time , shift, kiosk, denomination, paid_in_amount, in_seal, out_seal, paid_out_number)
				 VALUES (?,?, CURDATE(), NOW() , ? , ? , ? , ?, ?, ? , ?)" ) )
		{
            $insert_stmt->bind_param( 'sssssssss', $paid_in, $username, $shift , $kiosk, $denom , $paid_in_amount, $in_seal, $out_seal, $paid_out_number);

			// Execute the prepared query.
            if ( !$insert_stmt->execute() )
                header( 'Location: register_error.php?err=Registration failure: INSERT' );
        }

        header( 'Location: ../kiosk.php' );
}
else 
	header( 'location: ../error.php');



?>
