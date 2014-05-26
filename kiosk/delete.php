<?php

include_once '../include/common.php';

$mysqli = login_db_connect() or die("Insert_stacker.php. Cannot connect to DB");

sec_session_start();
date_default_timezone_set("America/Los_Angeles");

$logged = login_check( $mysqli );
if(! $logged )
	header( 'Location: ../login.php' );

	//This is the variable of the delete button
	if( isset($_POST['checkbox']) ){

	$checkbox = $_POST['checkbox']; 
	foreach ( $checkbox as $cassette_id ) {

		 $insert_stmt = $mysqli->prepare( "DELETE FROM inventory_table WHERE cassette_id = ? LIMIT 1;");
		 $insert_stmt->bind_param( 's' , $cassette_id ) ;

		 			// Execute the prepared query.
            if ( !$insert_stmt->execute()  or die( mysql_error() )  ){
                header( 'Location: register_error.php?err=Registration failure: INSERT' );
		 	}//End of if does not execute statement
	}//End of the foreach loop

	 header( 'Location: ../kiosk.php' );

} //End of if , if the checkbox is not set
	
else echo"checkbox values are not set";

?>

