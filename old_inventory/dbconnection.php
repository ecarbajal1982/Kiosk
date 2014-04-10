<?php			
// Connect to database
	$dbhost = 'localhost';
	$dbuser = 'inventoryuser';
	$dbpassword = 'inventoryuser';
	$conn = mysql_connect($dbhost, $dbuser, $dbpassword) or die ('Error: could not connect to the database.');			
	$dbname = 'inventorysystem';
	mysql_select_db($dbname) or die ('Database not found');?>
