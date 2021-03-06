<?php
include_once 'common.php';
include_once 'query_index.php';

$mysqli = login_db_connect();

sec_session_start();

$logged = login_check( $mysqli );

if ( !( $logged ) )
	header( 'Location: ../login.php' );

$mysqli = inventory_db_connect();

// List all Non-Lab Computers
if ( $_POST['query'] == '_computers' )
	$query = "SELECT	e.tag_num, 
						e.serial, 
						CONCAT( e.make, ' ', e.model ),
						c.os,
						c.hostname,
						e.department,
						e.location,
						CONCAT( e.building, ' ', e.room_num ), 	
						p.purchase_order,
						p.purchase_date,
						p.purchased_by,
						n.mac,
						n.wmac,
						n.ip
			FROM 		equipment e,
						computer c,
						eq_network n,
						purchase p, 
						user u,
						uses us
			WHERE	 	c.computer_tag = e.tag_num AND
						us.tag_num = e.tag_num AND
						us.user_id = u.user_id AND 
						e.purchase_id = p.purchase_id AND
						n.tag_num = e.tag_num AND
						u.l_name IS NOT NULL
			GROUP BY 	e.tag_num
			ORDER BY 	e.tag_num DESC";

else if ( $_POST['query'] == '_labs' )
	$query = "SELECT	e.tag_num,
						e.serial,
						CONCAT( e.make, ' ', e.model ),
						c.os,
						c.hostname,
						e.department,
						e.location,
						CONCAT( e.building, ' ', e.room_num ), 	
						p.purchase_order,
						p.purchase_date,
						p.purchased_by,
						n.mac,
						n.wmac,
						n.ip
			  FROM 		equipment e,
						computer c,
						eq_network n,
						purchase p, 
						user u,
						uses us
			  WHERE 	c.computer_tag = e.tag_num AND
						us.tag_num = e.tag_num AND
						us.user_id = u.user_id AND 
						e.purchase_id = p.purchase_id AND
						n.tag_num = e.tag_num AND
						u.l_name IS NULL
			  GROUP BY 	e.tag_num
			  ORDER BY 	e.tag_num DESC";

else if ( $_POST['query'] == '_printers' )
	$query = "SELECT	e.tag_num,
						e.serial,
						CONCAT( e.make, ' ', e.model ),
						pr.hostname,
						e.department,
						CONCAT( e.building, ' ', e.room_num ), 	
						p.purchase_order,
						p.purchase_date,
						p.purchased_by,
						n.mac,
						n.wmac,
						n.ip
			  FROM 		equipment e,
						eq_network n,
						purchase p,
						network_printer pr
			  WHERE 	pr.printer_tag = e.tag_num AND
						e.purchase_id = p.purchase_id AND
						n.tag_num = e.tag_num
			  ORDER BY 	pr.hostname ASC";

else
	$query = "SELECT		e.tag_num, 
											e.serial, 
											CONCAT( e.make, ' ', e.model ),
											c.os,
											c.hostname,
											e.department,
											e.location,
											CONCAT( e.building, ' ', e.room_num ), 	
											p.purchase_order,
											p.purchase_date,
											p.purchased_by,
											n.mac,
											n.wmac,
											n.ip
						FROM 			equipment e,
											computer c,
											eq_network n,
											purchase p
						WHERE	 		c.computer_tag = e.tag_num AND
											e.purchase_id = p.purchase_id AND
											n.tag_num = e.tag_num AND
											( e.tag_num LIKE ? OR
												e.serial LIKE ? OR
												e.make LIKE ? OR 
												e.model LIKE ? OR 
												c.os LIKE ? OR 
												c.hostname LIKE ? OR 
												e.department LIKE ? OR 
												p.purchase_order LIKE ? OR 
												p.purchase_date LIKE ? OR 
												p.purchased_by LIKE ? OR 
												n.mac LIKE ? OR 
												n.wmac LIKE ? OR 
												n.ip LIKE ? )
						GROUP BY 	e.tag_num
						ORDER BY 	e.tag_num DESC";


if ( $stmt = $mysqli->prepare( $query ) ) 
{
	unset( $results );

	if ( $_POST['query'] != "_computers" or $query != "_labs" or $query != "_printers" )
	{
		$word = '%' . $_POST['query'] . '%';
		$stmt->bind_param( "sssssssssssss", $word, $word, $word, $word, $word, $word, $word, $word, $word, $word, $word, $word, $word );
	}

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
				
		$get_printer_from_tag = "SELECT p.printer
								 FROM 	eq_printer p
								 WHERE 	p.tag_num = ?";

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

		$get_notes_from_tag = "SELECT	n.notes
					   		   FROM 	eq_notes n
					  		   WHERE 	n.tag_num = ?";

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

		$get_users_from_tag = "SELECT	u.user_id, u.f_name, u.l_name
							   FROM 	user u, uses us
							   WHERE 	u.user_id = us.user_id AND us.tag_num = ?";

		// Query users for current record
		if ( $stmt4 = $mysqli->prepare( $get_users_from_tag ) )
		{
			$stmt4->bind_param( "s", $tag );
			$stmt4->execute();
			$stmt4->store_result();
			$stmt4->bind_result( $user_id, $firstname, $lastname );

			while ( $stmt4->fetch() )
				$users[] = array( "userid" => $user_id, "firstname" => $firstname, "lastname" => $lastname );

			$stmt4->close();
		}	

		$get_software_from_tag = "SELECT 	s.software_name, s.license_type
								  FROM 		software s, licensed_to l
								  WHERE 	s.software_id = l.software_id AND l.computer_tag = ?";

		// Query software for current record
		if ( $stmt5 = $mysqli->prepare( $get_software_from_tag ) )
		{
			$stmt5->bind_param( "s", $tag );
			$stmt5->execute();
			$stmt5->store_result();
			$stmt5->bind_result( $software_name, $license_type );

			while ( $stmt5->fetch() )
				$software[] = array( "name" => $software_name );

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

?>
