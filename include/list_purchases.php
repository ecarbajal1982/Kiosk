 <?php
include_once 'common.php';

$mysqli = login_db_connect();

sec_session_start();

$logged = login_check( $mysqli );

if ( !( $logged ) )
	header( 'Location: ../login.php' );

$mysqli = inventory_db_connect();

if ( $_POST['query'] == "_all" )
	$query = "SELECT	 	p.purchase_id,
											p.purchase_order,
											p.purchase_date,
											p.purchased_by
						FROM			purchase p
						WHERE			p.purchase_order IS NOT NULL
						ORDER BY	p.purchase_date DESC";

else
{
// write query here based on user input
}

if ( $stmt = $mysqli->prepare( $query ) ) 
{
	unset( $results );

 	$stmt->execute();
	$stmt->store_result();
	$stmt->bind_result( $purchase_id,
						$purchase_order,
						$purchase_date,
						$purchased_by );

	while ( $stmt->fetch() )
	{
		unset( $equipment );			

		$get_equipment_from_purchase_id = "SELECT 	e.tag_num,
																								e.serial,
																								CONCAT( e.make, ' ', e.model ),
																								e.location,
																								CONCAT( e.building, ' ', e.room_num ),
																								e.department
																				FROM		equipment e,
																								purchase p
																				WHERE		e.purchase_id = p.purchase_id AND
																								p.purchase_id = ?";

		// Query equipment for current user
		if ( $stmt2 = $mysqli->prepare( $get_equipment_from_purchase_id ) )
		{
			$stmt2->bind_param( "s", $purchase_id );
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
		$results[] = array( "purchaseid" => $purchase_id,
												"purchaseorder" => $purchase_order, 
	 											"purchasedate" => $purchase_date,
												"purchasedby" => $purchased_by,
												"equipment" => $equipment, );
	}
}
echo json_encode( $results );

?>
