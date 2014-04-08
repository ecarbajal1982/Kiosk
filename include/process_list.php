<?php
include_once 'common.php';

$mysqli = inventory_db_connect();
 
sec_session_start();

if ( isset( $_POST['type'] ) ) 
{
	$type = $_POST['type'];

	if ( $type == 'computers' )
	{
		$prep_stmt = "SELECT e.tag_num, e.serial, c.hostname, c.os FROM equipment e, computer c WHERE c.computer_tag = e.tag_num ORDER BY tag_num DESC";
/*		$prep_stmt = "SELECT e.tag_num, e.serial, CONCAT( e.make, ' ', e.model ), e.department, e.location, CONCAT( e.building, ' ', e.room ), c.hostname, c.os, eqprinter.printer, eqnotes.notes, eqnet.mac, eqnet.wmac, eqnet.ip, p.purchase_order, p.purchase_date, p.purchased_by
					  FROM equipment e, computer c, eq_printer eqprinter, eq_notes eqnotes, eq_network eqnet, purchase p
					  WHERE e.tag_num = c.computer_tag AND e.tag_num = eqprinter.tag_num AND e.tag_num = eqnotes.tag_num
							AND e.tag_num = eqnet.tag_num AND e.purchase_id = p.purchase_id
					  ORDER BY tag_num DESC";

*/

	}

	if ( $type == 'printers' )
		$prep_stmt = "SELECT * FROM equipment e, network_printer p WHERE p.printer_tag = e.tag_num";		

	if ( $type == 'users' )
		$prep_stmt = "SELECT * FROM user GROUP BY 'f_name', 'l_name' ORDER BY 'l_name' ASC";

	if ( $type == 'purchases' )
		$prep_stmt = "SELECT * FROM purchase";

	if ( $type == 'software' )
		$prep_stmt = "SELECT * FROM software";

    $stmt = $mysqli->prepare( $prep_stmt );
 
    if ( $stmt ) 
	{
        $stmt->execute();
        $stmt->bind_result( $tag, $serial, $hostname, $os );

		printf( "Results: <br>");
		while ( $stmt->fetch() )
			printf("%s, %s, %s, %s <br>", $tag, $serial, $hostname, $os);
    }

	else echo "failure";


}

?>
