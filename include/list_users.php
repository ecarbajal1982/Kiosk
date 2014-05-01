<?php
include_once 'common.php';
include_once 'query_index.php';

$mysqli = inventory_db_connect();

if ( $_POST['query'] == "_all" )
	$query = "SELECT	u.user_id, 
						u.f_name, 
						u.l_name,
						u.email,
						u.department
			  FROM		user u
			  WHERE		u.l_name IS NOT NULL
			  ORDER BY	u.l_name ASC";

else
{
// write query here based on user input
}

if ( $stmt = $mysqli->prepare( $query ) ) 
{
	unset( $results );

 	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result( $user_id,
						$f_name,
						$l_name,
						$email,
						$department );

	while ( $stmt->fetch() )
	{
		unset( $equipment );			

		// Query equipment for current user
		if ( $stmt2 = $mysqli->prepare( $get_equipment_from_user ) )
		{
			$stmt2->bind_param( "s", $user_id );
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
		$results[] = array( "firstname" => $f_name, 
	 						"lastname" => $l_name,
							"equipment" => $equipment, );
	}


}
echo json_encode( $results );

?>
