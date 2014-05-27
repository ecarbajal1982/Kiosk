<?php

include_once '../include/common.php';

$mysqli = login_db_connect() or die("Insert_atm_paid_out.php. Cannot connect to DB");

sec_session_start();
date_default_timezone_set("America/Los_Angeles");

$logged = login_check( $mysqli );
if(! $logged )
	header( 'Location: ../login.php' );

if ( isset( $_POST['atm_paid_out_number'],  $_POST['user'] , $_POST['date'], $_POST['time'], $_POST['shift'], 
				$_POST['kiosk'], $_POST['gross_atm_amount'] , $_POST['reversals'], $_POST['net_atm_amount'] ) ) 
{
	$username = filter_input( INPUT_POST, 'user', FILTER_SANITIZE_STRING );
   $atm_paid_out_number = filter_input( INPUT_POST, 'atm_paid_out_number', FILTER_SANITIZE_STRING );
	$date = filter_input( INPUT_POST, 'date', FILTER_SANITIZE_STRING );
	$shift = filter_input( INPUT_POST, 'shift', FILTER_SANITIZE_STRING );
	$kiosk = filter_input( INPUT_POST, 'kiosk', FILTER_SANITIZE_STRING );
	$gross_atm_amount = filter_input( INPUT_POST, 'gross_atm_amount', FILTER_SANITIZE_STRING );
	$reversals = filter_input( INPUT_POST, 'reversals', FILTER_SANITIZE_STRING );
	$net_atm_amount = filter_input( INPUT_POST, 'net_atm_amount', FILTER_SANITIZE_STRING );

	 if ( $insert_stmt = $mysqli->prepare( 
				"INSERT INTO atm_paid_outs 
				( atm_paid_out_number, user, date , time , shift, kiosk, gross_atm_amount, reversals, net_atm_amount )
				 VALUES (?,?, CURDATE(), NOW() , ? , ? , ? , ?, ? )" ) )
		{
            $insert_stmt->bind_param( 'sssssssss', $atm_paid_out_number, $username, $shift , $kiosk, $gross_atm_amount , $reversals, $net_atm_amount ) ;

			// Execute the prepared query.
            if ( !$insert_stmt->execute() )
                header( 'Location: register_error.php?err=Registration failure: INSERT' );
        }

        header( 'Location: ../kiosk.php' );
}
else 
	header( 'location: ../error.php');



?>
