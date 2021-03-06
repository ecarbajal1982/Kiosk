<?php

include_once '../include/common.php';

$mysqli = login_db_connect() or die("Insert_atm_paid_out.php. Cannot connect to DB");

sec_session_start();
date_default_timezone_set("America/Los_Angeles");

$logged = login_check( $mysqli );
if(! $logged )
	header( 'Location: ../login.php' );

if ( isset( $_POST['prefix'],$_POST['number'], $_POST['denom'], $_POST['location']  ) ) 
{
	$prefix = filter_input( INPUT_POST, 'prefix', FILTER_SANITIZE_STRING );
	$number = filter_input( INPUT_POST, 'number', FILTER_SANITIZE_STRING );
	$denom = filter_input( INPUT_POST, 'denom', FILTER_SANITIZE_STRING );
	$location = filter_input( INPUT_POST, 'location', FILTER_SANITIZE_STRING );

	 if ( $insert_stmt = $mysqli->prepare( 
				"INSERT INTO `inventory_table` (`cassette_id`, `prefix`, `number`, `denom`, `location`) VALUES ('', ?, ?, ?, ?);" ) )
		{
            $insert_stmt->bind_param( 'ssss', $prefix, $number, $denom  , $location ) ;

			// Execute the prepared query.
            if ( !$insert_stmt->execute() )
                header( 'Location: register_error.php?err=Registration failure: INSERT' );
        }

        header( 'Location: ../kiosk.php' );
}
else 
	header( 'location: ../error.php');



?>
