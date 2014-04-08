<?php

include_once 'config.php';

$mysqli = db_connect();
 
$error_msg = "";
 
if ( isset( $_POST['username'], $_POST['p'], $_POST['role'] ) ) 
{
    // Sanitize and validate the data passed in
    $username = filter_input( INPUT_POST, 'username', FILTER_SANITIZE_STRING );
    $password = filter_input( INPUT_POST, 'p', FILTER_SANITIZE_STRING );
	$role = $_POST['role'];

    if ( strlen( $password ) != 128 )
        $error_msg .= '<p class="error">Invalid password configuration.</p>';

    $prep_stmt = "SELECT id FROM members WHERE username = ? LIMIT 1";
    $stmt = $mysqli->prepare( $prep_stmt );
 
    if ( $stmt ) 
	{
        $stmt->bind_param( 's', $username );
        $stmt->execute();
        $stmt->store_result();
 
        if ( $stmt->num_rows == 1 )
            $error_msg .= '<p class="error">A user with this username already exists.</p>';
    }

	else
        $error_msg .= '<p class="error">Database error!!</p>';
 
    // TODO: 
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.
 
    if ( empty( $error_msg ) )
	{
        // Create a random salt
        $random_salt = hash('sha512', uniqid( openssl_random_pseudo_bytes( 16 ), TRUE ) );
 
        // Create salted password 
        $password = hash( 'sha512', $password . $random_salt );
 
        // Insert the new user into the database 
        if ( $insert_stmt = $mysqli->prepare( "INSERT INTO members ( username, password, salt, role ) VALUES (?,?, ?, ?)" ) )
		{
            $insert_stmt->bind_param( 'ssss', $username, $password, $random_salt, $role );

			// Execute the prepared query.
            if ( !$insert_stmt->execute() )
                header( 'Location: ../error.php?err=Registration failure: INSERT' );
        }

        header( 'Location: ./index.php' );
    }
}

?>
