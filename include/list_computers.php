<?php
include_once 'common.php';
include_once 'query_index.php';

$mysqli = login_db_connect();

sec_session_start();

$logged = login_check( $mysqli );

if ( !( $logged ) )
	header( 'Location: login.php' );

$mysqli = inventory_db_connect();

// List all Non-Lab Computers
if ( $stmt = $mysqli->prepare( $get_all_computers ) ) 
{
	unset( $results );

 	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result( $tag,
						$serial,
						$makemodel,
						$department,
						$offcampus,
						$location );

	while ( $stmt->fetch() )
	{
		unset( $users );				

		if ( $offcampus == 'off' )
			$location = "Off Campus";

		// Query users for current record
		if ( $stmt4 = $mysqli->prepare( $get_users_from_tag ) )
		{
			$stmt4->bind_param( "s", $tag );
			$stmt4->execute();
			$stmt4->store_result();
			$stmt4->bind_result( $firstname, $lastname );

			while ( $stmt4->fetch() )
				$users[] = array( "firstname" => $firstname, "lastname" => $lastname );

			$stmt4->close();
		}	

		// Set results and headers arrays
		$results[] = array( "tag" => $tag, 
							"serial" => $serial, 
							"makemodel" => $makemodel, 
							"location" => $location,
							"department" => $department,
							"users" => $users, );
	}
}

echo json_encode( $results );


/*

include_once 'common.php';
include_once 'query_index.php';

$mysqli = inventory_db_connect();

// List all Non-Lab Computers
if ( $stmt = $mysqli->prepare( $get_all_computers ) ) 
{
	unset( $results );

 	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result( $tag,
						$serial,
						$makemodel,
						$os,
						$hostname,
						$department,
						$offcampus,
						$location, 
						$purchase_order,
						$purchase_date,
						$purchased_by,
						$mac,
						$wmac,
						$ip );

	while ( $stmt->fetch() )
	{
		unset( $users, $software );				

		if ( $offcampus == 'off' )
			$location = "Off Campus";
				
		// Query printer for current record
		if ( $stmt2 = $mysqli->prepare( $get_printer_from_tag ) )
		{
			$stmt2->bind_param( "s", $tag );
			$stmt2->execute();
			$stmt2->store_result();
			$stmt2->bind_result( $printer );

			if ( $stmt2->fetch() )
				$eq_printer = $printer;

			$stmt2->close();
		}

		// Query notes for current record
		if ( $stmt3 = $mysqli->prepare( $get_notes_from_tag ) )
		{
			$stmt3->bind_param( "s", $tag );
			$stmt3->execute();
			$stmt3->store_result();
			$stmt3->bind_result( $notes );

			if ( $stmt3->fetch() )
				$eq_notes = $notes;

			$stmt3->close();
		}

		// Query users for current record
		if ( $stmt4 = $mysqli->prepare( $get_users_from_tag ) )
		{
			$stmt4->bind_param( "s", $tag );
			$stmt4->execute();
			$stmt4->store_result();
			$stmt4->bind_result( $firstname, $lastname );

			while ( $stmt4->fetch() )
				$users[] = array( "firstname" => $firstname, "lastname" => $lastname );

			$stmt4->close();
		}	

		// Query software for current record
		if ( $stmt5 = $mysqli->prepare( $get_software_from_tag ) )
		{
			$stmt5->bind_param( "s", $tag );
			$stmt5->execute();
			$stmt5->store_result();
			$stmt5->bind_result( $software_name, $license_type );

			while ( $stmt5->fetch() )
				$software[] = array( "name" => $software_name, "type" => $license_type );

			$stmt5->close();
		}

		// Set results and headers arrays
		$results[] = array( "tag" => $tag, 
							"serial" => $serial, 
							"makemodel" => $makemodel, 
							"location" => $location,
							"department" => $department,
							"purchase_order" => $purchase_order, 
							"purchase_date" => $purchase_date,
							"purchased_by" => $purchased_by,
							"eq_printer" => $eq_printer,
			 				"eq_notes" => $eq_notes,
			 				"os" => $os,
			 				"hostname" => $hostname,
			 				"mac" => $mac,
			 				"wmac" => $wmac,
							"ip" => $ip,
		 					"software" => $software, 
							"users" => $users, );
	}
				

}

echo json_encode( $results );


*/
?>


