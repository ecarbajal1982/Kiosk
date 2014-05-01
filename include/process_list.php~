<?php
include_once 'common.php';
include_once 'query_index.php';

$mysqli = inventory_db_connect();
 
//sec_session_start();

if ( isset( $_POST['type'] ) ) 
	$type = $_POST['type'];

// List all Non-Lab Computers
if ( $type == 'computers' and $stmt = $mysqli->prepare( $get_all_computers ) ) 
{
	unset( $headers, $results );

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
		$results[] = array( "visible" => array( "tag" => $tag, 
	 										 											"serial" => $serial, 
																						"makemodel" => $makemodel, 
																						"location" => $location,
																						"department" => $department, ),
												"hidden" => array( "purchase_order" => $purchase_order, 
																					 "purchase_date" => $purchase_date,
																					 "purchased_by" => $purchased_by,
																					 "eq_printer" => $eq_printer,
					 																 "eq_notes" => $eq_notes,
					 																 "os" => $os,
					 																 "hostname" => $hostname,
					 																 "mac" => $mac,
					 																 "wmac" => $wmac,
																					 "ip" => $ip,
				 																	 "users" => $users,
				 																	 "software" => $software, ) );
	}
			
	$headers = array( "1" => "Property Tag",
										"2" => "Serial Number",
										"3" => "Make & Model",
										"4" => "Location",
										"5" => "Department", 
										"6" => "Users", );

	$resultsCount = $stmt->num_rows;		

}

// List all Lab Computers
if ( $type == 'labs' and $stmt = $mysqli->prepare( $get_all_labs ) ) 
{
	unset( $headers, $results );

 	$stmt->execute();
	$stmt->store_result();
  $stmt->bind_result( $tag,
											$serial,
											$makemodel,
											$os,
											$hostname,
											$department,
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

		// Query software for current record
		if ( $stmt4 = $mysqli->prepare( $get_software_from_tag ) )
		{
			$stmt4->bind_param( "s", $tag );
			$stmt4->execute();
			$stmt4->store_result();
			$stmt4->bind_result( $software_name, $license_type );

			while ( $stmt4->fetch() )
				$software[] = array( "name" => $software_name, "type" => $license_type );

			$stmt4->close();

		}

		// Set results and headers arrays
		$results[] = array( "visible" => array( "tag" => $tag, 
	 										 											"serial" => $serial, 
																						"makemodel" => $makemodel, 
																						"location" => $location,
																						"department" => $department, ),
												"hidden" => array( "purchase_order" => $purchase_order, 
																					 "purchase_date" => $purchase_date,
																					 "purchased_by" => $purchased_by,
																				   "eq_printer" => $eq_printer,
					 																 "eq_notes" => $eq_notes,
					 																 "os" => $os,
					 																 "hostname" => $hostname,
					 																 "mac" => $mac,
					 																 "wmac" => $wmac,
																					 "ip" => $ip,
				 																	 "software" => $software, ) );
	}
			
	$headers = array( "1" => "Property Tag",
										"2" => "Serial Number",
										"3" => "Make & Model",
										"4" => "Location",
										"5" => "Department", );

	$resultsCount = $stmt->num_rows;		

}

// List all Network Printers
if ( $type == 'printers' and $stmt = $mysqli->prepare( $get_all_network_printers ) ) 
{
	unset( $headers, $results );

 	$stmt->execute();
	$stmt->store_result();
  $stmt->bind_result( $tag,
											$serial,
											$makemodel,
											$hostname,
											$department,
											$location, 
											$purchase_order,
											$purchase_date,
											$purchased_by,
											$mac,
											$wmac,
											$ip );

	while ( $stmt->fetch() )
	{

		// Query notes for current record
		if ( $stmt2 = $mysqli->prepare( $get_notes_from_tag ) )
		{
			$stmt2->bind_param( "s", $tag );
			$stmt2->execute();
			$stmt2->store_result();
			$stmt2->bind_result( $notes );

			if ( $stmt2->fetch() )
				$eq_notes = $notes;

			$stmt2->close();

		}

		// Set results and headers arrays
		$results[] = array( "visible" => array( "tag" => $tag, 
	 										 											"serial" => $serial, 
																						"makemodel" => $makemodel,
																						"location" => $location,  
																						"department" => $department, ),
												"hidden" => array( "purchase_order" => $purchase_order, 
																					 "purchase_date" => $purchase_date,
																					 "purchased_by" => $purchased_by,
					 																 "eq_notes" => $eq_notes,
					 																 "hostname" => $hostname,
					 																 "mac" => $mac,
					 																 "wmac" => $wmac,
																					 "ip" => $ip, ) );
	}
			
	$headers = array( "1" => "Property Tag",
										"2" => "Serial Number",
										"3" => "Make & Model",
										"4" => "Location",
										"5" => "Department", );

	$resultsCount = $stmt->num_rows;		

}


// List all faculty/staff users
if ( $type == 'users' and $stmt = $mysqli->prepare( $get_all_users ) ) 
{
	unset( $headers, $results );

 	$stmt->execute();
	$stmt->store_result();
  $stmt->bind_result( $user_id,
											$f_name,
											$l_name );

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
		$results[] = array( "visible" => array( "f_name" => $f_name, 
	 										 											"l_name" => $l_name, ),
												"hidden" => array( "equipment" => $equipment, ) );
	}

	$headers = array( "1" => "First Name",
										"2" => "Last Name" );

	$resultsCount = $stmt->num_rows;

}

// List all purchase orders
if ( $type == 'purchases' and $stmt = $mysqli->prepare( $get_all_purchase_orders ) ) 
{
	unset( $headers, $results );

 	$stmt->execute();
	$stmt->store_result();
  $stmt->bind_result( $purchase_id,
											$purchase_order,
											$purchase_date,
											$purchased_by );

	while ( $stmt->fetch() )
	{
		unset( $equipment );			

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
		$results[] = array( "visible" => array( "purchase_order" => $purchase_order, 
	 										 											"purchase_date" => $purchase_date,
																						"purchased_by" => $purchased_by, ),
												"hidden" => array( "equipment" => $equipment, ) );
	}
			
	$headers = array( "1" => "Purchase Order",
										"2" => "Purchase Date",
										"3" => "Purchased By" );

	$resultsCount = $stmt->num_rows;

}


// List all licensed software
if ( $type == 'software' and $stmt = $mysqli->prepare( $get_all_software ) ) 
{
	unset( $headers, $results );

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
		unset( $computers );			

		// Query computers for current software
		if ( $stmt2 = $mysqli->prepare( $get_computers_from_software_id ) )
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

				$computers[] = array( "tag" => $tag,
															"serial" => $serial,
															"makemodel" => $makemodel,
															"location" => $location,
															"department" => $department );

			}

			$stmt2->close();

		}

		// Set results and headers arrays
		$results[] = array( "visible" => array( "software_name" => $software_name, 
	 										 											"license_number" => $license_number,
																						"license_type" => $license_type, 
																						"number_of_licenses" => $number_of_licenses, 
																						"notes" => $notes, ),
												"hidden" => array( "computers" => $computers, ) );
	}
			
	$headers = array( "1" => "Software Name",
										"2" => "License Number",
										"3" => "License Type",
										"4" => "Number of Licenses",
										"5" => "Notes", );

	$resultsCount = $stmt->num_rows;
	


}

//echo json_encode( $results );


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

if ( isset( $headers['users'] ) )
{
	printf( "<th scope='col'>
						 <div>Users</div>
					 </th>" );

}
printf( "</tr></thead><tbody>" );

foreach ( $results as $result )
{
	printf( "<tr class='toggle'>" );

	foreach ( $result["visible"] as $columnvalue )
	{
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

?>
