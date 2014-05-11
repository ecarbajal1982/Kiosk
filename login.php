<?php

include_once 'include/common.php';

$mysqli = login_db_connect();

sec_session_start();


$logged = login_check( $mysqli );

if( $logged )
	header( 'Location: kiosk.php' );

?>

<!DOCTYPE html>
<html>
<head>
  <title>Cookie Login</title>
  <link rel="shortcut icon" href="img/c.ico">

  <!-- CSS -->
  <link rel="stylesheet" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/font-awesome.min.css">

  <!-- Javascript -->
  <script type="text/javascript" src="js/jquery-2.1.0.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.js"></script>
  <script type="text/javascript" src="js/bootstrap-typeahead.js"></script> 
  <script type="text/JavaScript" src="js/sha512.js"></script> 
  <script type="text/JavaScript" src="js/main.js"></script>
     <!-- Bootstrap core CSS -->
    <link href="http://getbootstrap.com/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="http://getbootstrap.com/examples/signin/signin.css" rel="stylesheet">

</head>
  <body background = "./img/water.jpg">


    <div class="container">	

	   
<!-- Login Form -->
  		<!--BE SURE TO INCLUDE THE NAME OF THE VARIABLE. IF NOT PHP WILL NOT PICK IT UP IN THE POST-->
        <form class="form-signin" role="form" action='include/process_login.php' method='POST'>
	
	
       <h2 class="form-signin-heading"><font color="#428bca"><background="Black">Welcome to CookieCrumbs <br> </h2>

	
		<div>
		<input id="user" name="user" type="text" class="form-control" value="<?php echo $_GET['user']; ?>" autofocus="" required="" placeholder="Badge Number">
		</div><!--end user input div -->		
		<div><span class="pull-left" id="username_error"></span></div>
		<div class=""><span class="pull-left" id="password_error"></span></div>
		<br>
		<div>
		    <input id="password" name="password" type="password" class="form-control" placeholder="Password" required="" ><br>
		</div>
	
        <!--</label> -->
                  <button id="login_submit" 
					  name="login_submit"
					  class="btn btn-lg btn-primary btn-block"
					  onclick="formhash( this.form, this.form.password );$('.form-group').removeClass('has-error');">Sign In</button>
      </form>


	<!--To make registration for the user. ONly implement when creating new users. -->
	<!--	<center><a href="admin/register.php">Register</a></center>  -->

    </div> <!-- /container -->
	<footer>
	<center><h5><font color="gray">ecarb &copy 2014</h5></center>
	</footer>
</body>

<?php
	if( isset( $_GET['error'] ) )
	{
		$error = $_GET['error'];

		switch( $error )
		{
			case "no_such_user": ?>
				<script>$( '#username_error' ).html( '<span  style="color:red" class="glyphicon glyphicon-remove"> User does not exist! Try again</span>' );
						$( '#username_input' ).addClass( 'has-error' );
				</script>
				<?php break;
			case "wrong_password": ?>
				<script>$( '#password_error' ).html( '<span style="color:red" class="glyphicon glyphicon-remove"> Wrong password! Try again</span' );
						$( '#password_input' ).addClass( 'has-error' ); $('#password').focus();
				</script>
				<?php break;
			case "account_locked": ?>
						<!-- $(selector ) .addClass( Make it look like this from css styling); -->
				<script>$( '#username_error' ).html( '<span style="color:red" class="glyphicon glyphicon-remove">This account is locked!</span' );
						$( '#username_input' ).addClass( 'has-error' ); //This adds a css class to this particular element
						
				</script>
				<?php break;
		}
	}

?> 

</html>
