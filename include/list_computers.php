<?php
include_once 'common.php';
//include_once 'query_index.php';

$mysqli = inventory_db_connect();

$get_all_computers = "SELECT		e.tag_num,
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
																purchase p, 
																user u,
																uses us

											WHERE 		c.computer_tag = e.tag_num AND
																us.tag_num = e.tag_num AND
																us.user_id = u.user_id AND 
																e.purchase_id = p.purchase_id AND
																n.tag_num = e.tag_num AND
																u.l_name IS NOT NULL

											GROUP BY 	e.tag_num

											ORDER BY 	e.tag_num DESC";

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
		$get_printer_from_tag = "SELECT p.printer

								 				 		 FROM 	eq_printer p

												 		 WHERE 	p.tag_num = ?";

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
		$get_notes_from_tag = "SELECT n.notes

													 FROM 	eq_notes n

											 		 WHERE 	n.tag_num = ?";

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
		$get_users_from_tag = "SELECT u.f_name,
																	u.l_name

											 		 FROM 	user u,
																	uses us
						
								  		 		 WHERE 	u.user_id = us.user_id AND
																	us.tag_num = ?";

		if ( $stmt4 = $mysqli->prepare( $get_users_from_tag ) )
		{
			$stmt4->bind_param( "s", $tag );
			$stmt4->execute();
			$stmt4->store_result();
			$stmt4->bind_result( $firstname, $lastname );

			while ( $stmt4->fetch() )
				$users[] = array("firstname" => $firstname, "lastname" => $lastname );

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
												"users" => $users,
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
							 					"software" => $software, );
	}
				

}

echo json_encode( $results );

/*
printf( "Number of Results: %d", $resultsCount );
printf( "<div class='row well'>
		      <div class='col-xs-6'>
                <form class='form-inline'>
                  <input type='text' class='form-control search' placeholder='Search' size='25' data-column='all'>
                    <button class='btn btn-primary' type='button'>
                      <span class='glyphicon glyphicon-search'></span>
                    </button>
                </form>
              </div>
              <div class='col-xs-6 text-right'>
                <button class='btn btn-primary' type='button'>
                  <span class='glyphicon glyphicon-file'></span>&nbsp; Print Report
                </button>
	          </div>
            </div>");
printf( "<div class='wrapper'><table id='custom_table' class='tablesorter'>
							 
							 	 <thead>
									 <tr class='tablesorter-stickyHeader'>" );

foreach ( $headers as $header )
{
	printf( "<th scope='col'>
						 <div>%s</div>
					 </th>", $header );
}

printf( "</tr></thead><tbody>" );

foreach ( $results as $result )
{
	printf( "<tr class='toggle'>" );

	foreach ( $result["visible"] as $columnvalue )
	{
		if ( is_array( $columnvalue ) )
		{
			printf( "<td class='parent_row'>" );

			foreach( $columnvalue as $user )
			{
				printf( "%s %s", $user["firstname"], $user["lastname"] );

				if ( next( $user["firstname"] ) )
					printf( ", " );
			}

			printf( "</td>" );
		}

		else
			printf( "<td class='parent_row'>%s</td>", $columnvalue );
	}

	printf( "</tr>
					 <tr class='tablesorter-childRow'>

						 <td colspan='10'>
							 <div class='panel'>
								 <div class='panel-body'>
							 		 <div class='col-xs-3'>
										 <ul class='list-group'>
  										 <li class='list-group-item list-group-item'>
												 <b>Purchase Order: </b>
												 <div class='pull-right'>N/A</div>
											 </li>
  										 <li class='list-group-item list-group-item'>
												 <b>Purchase Date: </b>
												 <div class='pull-right'>02/15/2010</div>
											 </li>
  										 <li class='list-group-item list-group-item'>
												 <b>Purchased By: </b>
												 <div class='pull-right'>Department</div>
											 </li>
										 </ul>
							 		 </div>
							 		 <div class='col-xs-3'>
										 <ul class='list-group'>
  										 <li class='list-group-item list-group-item'>
												 <b>Hostname: </b>
												 <div class='pull-right'>UH201-01-01</div>
											 </li>
  										 <li class='list-group-item list-group-item'>
												 <b>OS: </b>
												 <div class='pull-right'>Windows 7 Pro 64bit</div>
											 </li>
  										 <li class='list-group-item list-group-item'>
												 <b>Printer: </b>
												 <div class='pull-right'>HP LaserJet 2000j</div>
											 </li>
										 </ul>
									 </div>
							 		 <div class='col-xs-3'>
										 <ul class='list-group'>
  										 <li class='list-group-item list-group-item'>
												 <b>MAC Address: </b>
												 <div class='pull-right'>1a:2b:3c:4d:5e:6f</div>
											 </li>
  										 <li class='list-group-item list-group-item'>
												 <b>Wireless MAC: </b>
												 <div class='pull-right'>0f:9e:8d:7c:6b:5a</div>
											 </li>
  										 <li class='list-group-item list-group-item'>
												 <b>IP Address: </b>
												 <div class='pull-right'>169.245.1.2</div>
											 </li>
										 </ul>
							   	 </div>
								 </div>
							 </div>
					 </td></tr>" );


}


// after query has been done:
printf( "</tbody></table></div>
<script id='js'>$(function(){

	var options = {
		widthFixed : true,
		cssChildRow : 'tablesorter-childRow',
		showProcessing: true,
		headerTemplate : '{content} {icon}',

		widgets: [ 'stickyHeaders', 'filter' ],

		widgetOptions: {

			// extra class name added to the sticky header row
			stickyHeaders : 'tablesorter-stickyHeader',
			filter_external : '.search',
			filter_columnFilters : false

		}
	};

	$('#custom_table').tablesorter(options);

});



$('.tablesorter-childRow td').hide();
							


$( '.toggle' ).on( 'click' ,function()
{
  $( this ).closest('tr').nextUntil('tr:not(.tablesorter-childRow)').find('td').toggle();

  return false;
});
</script>" );
*/
?>
