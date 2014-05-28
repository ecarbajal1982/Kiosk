<?php

include_once '../include/common.php';

$mysqli = login_db_connect() or die("Insert_atm_paid_out.php. Cannot connect to DB");

sec_session_start();
date_default_timezone_set("America/Los_Angeles");

$logged = login_check( $mysqli );
if(! $logged )
	header( 'Location: ../login.php' );

if ( isset( $_POST['number'],  $_POST['location'] , $_POST['shift']  ) ) 
{
	$shift = filter_input( INPUT_POST, 'shift', FILTER_SANITIZE_STRING );
	$kiosk_id = filter_input( INPUT_POST, 'number', FILTER_SANITIZE_STRING );
	$location = filter_input( INPUT_POST, 'location', FILTER_SANITIZE_STRING );

	 if ( $insert_stmt = $mysqli->prepare(  
           "INSERT INTO `kiosk_table` (`kiosk_id`, `location`, `start_balance_date`, `start_balance_time`, `end_balance_date`, 			   
									   `end_balance_time`, `shift`, `last_variance`)
			 VALUES (? , ? , '', '', '', '',  ? , '');" ) )
		{
            $insert_stmt->bind_param( 'sss', $kiosk_id , $location , $shift ) ;

			// Execute the prepared query.
            if ( !$insert_stmt->execute() )
                header( 'Location: register_error.php?err=Registration failure: INSERT' );
        }

        header( 'Location: ../kiosk.php' );
}
else 
	header( 'location: ../error.php');



?>
