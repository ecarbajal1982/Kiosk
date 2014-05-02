<?php
include_once 'common.php';

$mysqli = login_db_connect();

sec_session_start();

$logged = login_check( $mysqli );

if ( !( $logged ) )
	header( 'Location: ../login.php' );

$mysqli = inventory_db_connect();

if ( $_POST['query'] == "_all" )
	$query = "SELECT	 	s.software_id,
											s.software_name,
											s.license_num,
											s.license_type,
											s.number_of_licenses,
											s.notes
						FROM			purchase s
						ORDER BY	s.software_name ASC";

else
{
// write query here based on user input
}

if ( $stmt = $mysqli->prepare( $query ) ) 
{
	unset( $results );

 	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result( $software_id,
											$software_name,
											$license_num,
											$license_type,
											$number_of_licenses,
											$notes );

	while ( $stmt->fetch() )
	{
		unset( $equipment );			

		$get_computers_from_software_id = "SELECT	e.tag_num,
																							e.serial,
																							CONCAT( e.make, ' ', e.model ),
																							e.location,
																							CONCAT( e.building, ' ', e.room_num ),
																							e.department
																			FROM		equipment e,
																							computer c,
																							licensed_to l
																			WHERE		e.tag_num = c.computer_tag AND
																							c.computer_tag = l.computer_tag AND
																							l.software_id = ?";



		// Query equipment for current software

		if ( $stmt2 = $mysqli->prepare( $get_equipment_from_software_id ) )
		{
			$stmt2->bind_param( "s", $software_id );
			$stmt2->execute();
			$stmt2->store_result();
			$stmt2->bind_result( $tag,
													 $serial,
													 $makemodel,
													 $offcampus,
													 $location,
													 $department );

			while ( $stmt2->fetch() )
			{
				if ( $offcampus == "off" )
					$location = "Off Campus";

				$equipment[] = array( "tag" => $tag,
									  					"serial" => $serial,
															"makemodel" => $makemodel,
															"location" => $location,
															"department" => $department );
			}

			$stmt2->close();
		}

		// Set results and headers arrays
		$results[] = array( "softwareid" => $software_id,
												"softwarename" => $software_name, 
	 											"licensenumber" => $license_num,
												"licensetype" => $license_type,
												"licensequantity" => $number_of_licenses,
												"licensenotes" => $notes,
												"equipment" => $equipment, );
	}
}
echo json_encode( $results );

?>
