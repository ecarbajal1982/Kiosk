<?php

include_once '../include/common.php';

$mysqli = login_db_connect() or die("Insert_atm_paid_out.php. Cannot connect to DB");

sec_session_start();
date_default_timezone_set("America/Los_Angeles");

$logged = login_check( $mysqli );
if(! $logged )
	header( 'Location: ../login.php' );

if ( isset( $_POST['user'] , $_POST['balance_id'], $_POST['date'], $_POST['time'],$_POST['shift'],
	$_POST['ones'],$_POST['fives'],$_POST['tens'],$_POST['twenty'],$_POST['fifty'],
	$_POST['hundred'],$_POST['ticket_total'],$_POST['stacker_total'],$_POST['cash_paid_ins'],
	$_POST['reject_paid_ins'],$_POST['cash_paid_outs'],$_POST['coin_paid_outs'],
	$_POST['atm_net_amount'],$_POST['atm_fill_number'],$_POST['balance_total'],
	$_POST['balance_over_short'],$_POST['comments'],$_POST['kiosk']
	  ) )
{   


	$balance_id = filter_input( INPUT_POST, 'balance_id', FILTER_SANITIZE_STRING );
	$username = filter_input( INPUT_POST, 'user', FILTER_SANITIZE_STRING );
	$date = filter_input( INPUT_POST, 'date', FILTER_SANITIZE_STRING );

 	$shift = filter_input( INPUT_POST, 'shift', FILTER_SANITIZE_STRING );


	$kiosk = filter_input( INPUT_POST, 'kiosk', FILTER_SANITIZE_STRING );
	
	$reversals = filter_input( INPUT_POST, 'reversals', FILTER_SANITIZE_STRING );
	$net_atm_amount = filter_input( INPUT_POST, 'net_atm_amount', FILTER_SANITIZE_STRING );

	 if ( $insert_stmt = $mysqli->prepare( 
				"INSERT INTO balance 
				( balance_id, user, date , time , shift)
				 VALUES (?,?, CURDATE(), NOW() , ? )" ) )
		{
            $insert_stmt->bind_param( 'sss', $balance_id, $username, $shift ) ;

			// Execute the prepared query.
            if ( !$insert_stmt->execute() )
                header( 'Location: register_error.php?err=Registration failure: INSERT' );
        }

        header( 'Location: ../kiosk.php' );
}
else 
	header( 'location: ../error.php');
?>
