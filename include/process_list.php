<?php
include_once 'common.php';

$mysqli = inventory_db_connect();
 
sec_session_start();

if ( isset( $_POST['type'] ) ) 
{
	$type = $_POST['type'];

	if ( $type == 'computers' )
	{
		$computer_stmt = "SELECT e.tag_num, e.serial, CONCAT( e.make, ' ', e.model ), c.os, c.hostname, e.department, e.location, CONCAT( e.building, ' ', e.room_num )
											FROM equipment e, computer c 
											WHERE c.computer_tag = e.tag_num
											ORDER BY tag_num DESC";


		$stmt = $mysqli->prepare( $computer_stmt );
 
    if ( $stmt ) 
		{
    	$stmt->execute();
			$stmt->store_result();
      $stmt->bind_result( $tag, $serial, $makemodel, $os, $hostname, $department, $offcampus, $location );

			printf( "Number of Results: %d", $stmt->num_rows );
			printf( "<table id='custom_table' summary='Search Results'>
							 	 <thead>
									 <tr>
										 <th></th>
										 <th scope='col'>Property Tag</th>
										 <th scope='col'>Serial Number</th>
										 <th scope='col'>Make & Model</th>
										 <th scope='col'>Location</th>
										 <th scope='col'>Department</th>
										 <th scope='col'>Users</th>
									 </tr>
								 </thead>
								 <tbody>" );

			while ( $stmt->fetch() )
			{
				printf( "<tr>
									 <td><i class='fa fa-plus-square-o fa-fw'></i></td>
									 <td>%s</td>
									 <td>%s</td>
									 <td>%s</td>", $tag, $serial, $makemodel );

				if ( $offcampus == 'off' )
					printf( "<td>Off Campus</td>" );

				else if ( $offcampus == 'on' )
					printf( "<td>%s</td>", $location );

				else
					printf( "<td>Unknown</td>" );

				printf( "<td>%s</td>", $department );

				$mysqli2 = inventory_db_connect();

				if ( $stmt2 = $mysqli2->prepare( "SELECT CONCAT( u.f_name, ' ', u.l_name )
																					FROM user u, uses us
																					WHERE u.user_id = us.user_id AND us.tag_num = ?" ) )
				{
					$stmt2->bind_param( "s", $tag );
					$stmt2->execute();
					$stmt2->store_result();
					$stmt2->bind_result( $user );

					if ( $stmt2->num_rows == 0 )
						printf( "<td></td>" );
										
					else if ( $stmt2->num_rows == 1 )
					{
						$stmt2->fetch();
						printf( "<td>%s</td>", $user );
					}
	
					else if ( $stmt2->num_rows > 1 )
					{
						$stmt2->fetch();
						printf( "<td>%s", $user );
						while ( $stmt2->fetch() )
							printf( "<br>%s", $user );

						printf( "</td></tr>" );
					}
				}	
			}
			
			printf( "</tbody></table>" );

    }
	}
}

?>
