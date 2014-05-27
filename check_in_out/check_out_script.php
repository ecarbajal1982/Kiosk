<?php

include_once '../include/common.php';

$mysqli = login_db_connect() or die("Insert_stacker.php. Cannot connect to DB");

sec_session_start();
date_default_timezone_set("America/Los_Angeles");

$logged = login_check( $mysqli );
if(! $logged ){
	header( 'Location: ../login.php' );

}

	//This is the variable of the delete button
	if( isset($_POST['checkbox'], $_POST['destination']) ){

	$checkbox = $_POST['checkbox']; 
 	$destination = $_POST['destination'];

	reset($checkbox);
	reset($destination);
	$i = 0;
	$z = 0;
	for( $j=0; $j < sizeof($destination);$j++){
			
		if( $destination[$j] != "" ){
			 
			 $dest = $destination[$j];
			 $cassette_id = $checkbox[$z];		
			 $insert_stmt = $mysqli->prepare( "UPDATE `inventory_table` SET `location` = ? WHERE `cassette_id` = ? LIMIT 1;");
			 $insert_stmt->bind_param( 'ss' , $dest, $cassette_id ) ;
			 $insert_stmt->execute() ;	
			 $z++;
		}
		else {


		}
;



	}


	unset ( $cassette_id);

	 header( 'Location: ../kiosk.php');



} //End of if , if the checkbox is not set
	
else echo"checkbox values are not set";

?>

