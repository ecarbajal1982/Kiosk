<?php

include_once '../include/common.php';

$mysqli = login_db_connect() or die("Insert_stacker.php. Cannot connect to DB");

sec_session_start();
date_default_timezone_set("America/Los_Angeles");

$logged = login_check( $mysqli );
if(! $logged )
	header( 'Location: ../login.php' );

if ( isset( $_POST['stacker_number'],  $_POST['user'] , $_POST['date'], $_POST['time'], $_POST['shift'], 
				$_POST['kiosk'] , $_POST['ticket_amount'], $_POST['cash_amount'], $_POST['atm_amount'], $_POST['atm_paid_out_number'],
				$_POST['stacker_total']) ) 
{
	$username = filter_input( INPUT_POST, 'user', FILTER_SANITIZE_STRING );
   $stacker_number= filter_input( INPUT_POST, 'stacker_number', FILTER_SANITIZE_STRING );
	$date = filter_input( INPUT_POST, 'date', FILTER_SANITIZE_STRING );
	$shift = filter_input( INPUT_POST, 'shift', FILTER_SANITIZE_STRING );
	$kiosk = filter_input( INPUT_POST, 'kiosk', FILTER_SANITIZE_STRING );	
	$ticket_amount = filter_input( INPUT_POST, 'ticket_amount', FILTER_SANITIZE_STRING );
	$cash_amount = filter_input( INPUT_POST, 'cash_amount', FILTER_SANITIZE_STRING );
	$atm_amount = filter_input( INPUT_POST, 'atm_amount', FILTER_SANITIZE_STRING );
	$atm_paid_out_number = filter_input( INPUT_POST, 'atm_paid_out_number', FILTER_SANITIZE_STRING );
	$stacker_total = filter_input( INPUT_POST, 'stacker_total', FILTER_SANITIZE_STRING );

	 if ( $insert_stmt = $mysqli->prepare( 
				"INSERT INTO stackers
				( stacker_number, user, date , time , shift, kiosk, ticket_total, cash_amount, atm_amount, atm_paid_out_number, stacker_total)
				 VALUES (?,?, CURDATE(), NOW() , ? , ? , ? , ?, ?, ? , ?)" ) )
		{
            $insert_stmt->bind_param( 'sssssssss', $stacker_number, $username, $shift , $kiosk, $ticket_amount , $cash_amount, $atm_amount,
											$atm_paid_out_number, $stacker_total);

			// Execute the prepared query.
            if ( !$insert_stmt->execute() )
                header( 'Location: register_error.php?err=Registration failure: INSERT' );
        }

        header( 'Location: ../kiosk.php' );
}
else 
	header( 'location: ../error.php');



?>
