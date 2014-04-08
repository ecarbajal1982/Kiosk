<?php
include_once '../include/common.php';

$mysqli = db_connect();
 
sec_session_start();

$error_msg = "";
 
if ( isset( $_POST['username'], $_POST['p'], $_POST['role'] ) ) 
{
    // Sanitize and validate the data passed in
    $username = filter_input( INPUT_POST, 'username', FILTER_SANITIZE_STRING );
    $password = filter_input( INPUT_POST, 'p', FILTER_SANITIZE_STRING );
	$role = $_POST['role'];

    if ( strlen( $password ) != 128 )
        $error_msg .= '<p class="error">Invalid password configuration.</p>';

    $prep_stmt = "SELECT id FROM users WHERE username = ? LIMIT 1";
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
 
    if ( empty( $error_msg ) )
	{
        // Create a random salt
        $random_salt = hash('sha512', uniqid( openssl_random_pseudo_bytes( 16 ), TRUE ) );
 
        // Create salted password 
        $password = hash( 'sha512', $password . $random_salt );
 
        // Insert the new user into the database 
        if ( $insert_stmt = $mysqli->prepare( "INSERT INTO users ( username, password, salt, role ) VALUES (?,?, ?, ?)" ) )
		{
            $insert_stmt->bind_param( 'ssss', $username, $password, $random_salt, $role );

			// Execute the prepared query.
            if ( !$insert_stmt->execute() )
                header( 'Location: register_error.php?err=Registration failure: INSERT' );
        }

        header( 'Location: ../portal.php?event=register_success' );
    }
}

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Register New User</title>
        <script type="text/JavaScript" src="../js/sha512.js"></script> 
        <script type="text/JavaScript" src="../js/main.js"></script>
    </head>
    <body>
        <!-- Registration form to be output if the POST variables are not
        set or if the registration script caused an error. -->
        <h1>Register with us</h1>
        <?php

        if ( !empty( $error_msg ) )
            echo $error_msg;

        ?>
        <ul>
            <li>Usernames may contain only digits, upper and lower case letters and underscores</li>
            <li>Emails must have a valid email format</li>
            <li>Passwords must be at least 6 characters long</li>
            <li>Passwords must contain
                <ul>
                    <li>At least one upper case letter (A..Z)</li>
                    <li>At least one lower case letter (a..z)</li>
                    <li>At least one number (0..9)</li>
                </ul>
            </li>
            <li>Your password and confirmation must match exactly</li>
        </ul>
        <form action="<?php echo esc_url( $_SERVER['PHP_SELF'] ); ?>" 
              method="post" 
              name="registration_form">
            Username: <input type='text'
							 name='username'
							 id='username' /><br>
            Password: <input type="password"
                             name="password" 
                             id="password"/><br>
            Confirm password: <input type="password" 
                                     name="confirmpwd" 
                                     id="confirmpwd" /><br>
			Role: <input type="number"
						 name="role"
						 id="role" /><br>
            <input type="button" 
                   value="Register" 
                   onclick="return regformhash( this.form,
                                   				this.form.username,
                                   				this.form.password,
                                   				this.form.confirmpwd,
												this.form.role );" /> 
        </form>
        <p>Return to the <a href="../index.php">login page</a>.</p>
    </body>
</html>
