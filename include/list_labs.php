<?php

include_once 'common.php';
include_once 'query_index.php';

$mysqli = inventory_db_connect();

// List all Lab Computers
if ( $stmt = $mysqli->prepare( $get_all_labs ) ) 
{
	unset( $results );

 	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result( $tag,
						$serial,
						$makemodel,
						$department,
						$location );

	while ( $stmt->fetch() )
	{			
		// Set results and headers arrays
		$results[] = array( "tag" => $tag, 
	 						"serial" => $serial, 
							"makemodel" => $makemodel, 
							"location" => $location,
							"department" => $department );

	}
}

echo json_encode( $results );

?>
