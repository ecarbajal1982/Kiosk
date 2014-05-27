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
	//There are twenty-one variables to store
	$user = filter_input( INPUT_POST, 'user', FILTER_SANITIZE_STRING );
	$balance_id = filter_input( INPUT_POST, 'balance_id', FILTER_SANITIZE_STRING );
 	$shift = filter_input( INPUT_POST, 'shift', FILTER_SANITIZE_STRING );
	$ones = filter_input( INPUT_POST, 'ones', FILTER_SANITIZE_STRING );
	$fives = filter_input( INPUT_POST, 'fives', FILTER_SANITIZE_STRING );
	$tens = filter_input( INPUT_POST, 'tens', FILTER_SANITIZE_STRING );
	$twenty = filter_input( INPUT_POST, 'twenty', FILTER_SANITIZE_STRING );
	$fifty = filter_input( INPUT_POST, 'fifty', FILTER_SANITIZE_STRING );
	$hundred = filter_input( INPUT_POST, 'hundred', FILTER_SANITIZE_STRING );
	$ticket_total = filter_input( INPUT_POST, 'ticket_total', FILTER_SANITIZE_STRING );
	$stacker_total = filter_input( INPUT_POST, 'stacker_total', FILTER_SANITIZE_STRING );
	$cash_paid_ins = filter_input( INPUT_POST, 'cash_paid_ins', FILTER_SANITIZE_STRING );
	$reject_paid_ins = filter_input( INPUT_POST, 'reject_paid_ins', FILTER_SANITIZE_STRING );
	$cash_paid_outs = filter_input( INPUT_POST, 'cash_paid_outs', FILTER_SANITIZE_STRING );
	$coin_paid_outs = filter_input( INPUT_POST, 'coin_paid_outs', FILTER_SANITIZE_STRING );
	$atm_net_amount = filter_input( INPUT_POST, 'atm_net_amount', FILTER_SANITIZE_STRING );
	$atm_fill_number = filter_input( INPUT_POST, 'atm_fill_number', FILTER_SANITIZE_STRING );
	$balance_total = filter_input( INPUT_POST, 'balance_total', FILTER_SANITIZE_STRING );
	$balance_over_short = filter_input( INPUT_POST, 'balance_over_short', FILTER_SANITIZE_STRING );
	$comments = filter_input( INPUT_POST, 'comments', FILTER_SANITIZE_STRING );
	$kiosk = filter_input( INPUT_POST, 'kiosk', FILTER_SANITIZE_STRING );
	


	 if ( $insert_stmt = $mysqli->prepare(
				"INSERT INTO balance 
				( balance_id, date , user, time , kiosk, shift , ones, fives, tens, twenty, fifty,
				  hundred, ticket_total, stacker_total, cash_paid_ins, reject_paid_ins, cash_paid_outs, 
				  coin_paid_outs, atm_net_amount, atm_fill_number, balance_total, balance_over_short, comments	)
				 VALUES (?, CURDATE(), ?, NOW() , ? , ? , ? , ?, ? , ? , ?,
						 ?, ?, ?, ?, ?, ? ,
						 ? , ? , ? , ? ,? ,? )" ) )
		{
            $insert_stmt->bind_param( 'sssssssssssssssssssss', $balance_id, $user, $kiosk, $shift , $ones, $fives, $tens, $twenty, $fifty,
				  $hundred, $ticket_total, $stacker_total, $cash_paid_ins, $reject_paid_ins, $cash_paid_outs, 
				  $coin_paid_outs, $atm_net_amount, $atm_fill_number, $balance_total, $balance_over_short, $comments ) ;

			// Execute the prepared query.
            if ( !$insert_stmt->execute() )
                header( 'Location: register_error.php?err=Registration failure: INSERT' );
        }

        header( 'Location: ../kiosk.php' );
}
else 
	header( 'location: ../error.php');
?>
