<?php

include_once 'include/common.php';

$mysqli = login_db_connect();

sec_session_start();

$logged = login_check( $mysqli );

if( $logged )
	header( 'Location: portal.php' );

?>

<!DOCTYPE html>
<html>
<head>
  <title>CAL Inventory</title>
  <link rel="shortcut icon" href="http://www.csusb.edu/images/favicon.ico">
  <? include_once 'include/html_head.php'; ?>

</head>
<body>
  <!-- Login Panel -->
  <div class="container" style="padding-top: 50px;" >
	<div class="jumbotron">
  	  <div class="container">
		<h1 style="font-family:'Times New Roman';">
          College of Arts & Letters<br>
      	  Equipment and Software Inventory
    	</h1>
    	<p>To begin your search, please log in:</p>

    	<!-- Login Form -->
    	<form class="form-horizontal" action="include/process_login.php" method="post" name="login_form">

          <!-- Username input-->
      	  <div class="form-group" id="username_input">
            <label class="col-xs-1 control-label text-right" for="username">Username</label>
            <div class="col-xs-3">
              <input id="user" name="user" type="text" class="form-control" value="<? echo $_GET['user']; ?>">
            </div>
			<div class="col-xs-3 control-label"><span class="pull-left" id="username_error"></span>
			</div>
          </div>

          <!-- Password input-->
          <div class="form-group" id="password_input">
            <label class="col-xs-1 control-label text-right" for="password">Password</label>
            <div class="col-xs-3">
              <input id="password" name="password" type="password" class="form-control">
            </div>
			<div class="col-xs-3 control-label"><span class="pull-left" id="password_error"></span>
			</div>
          </div>

          <!-- Login Button -->
          <div class="form-group">
            <label class="col-xs-1 control-label" for="login_submit"></label>
            <div class="col-xs-3">
              <button id="login_submit" 
					  name="login_submit"
					  class="btn btn-primary"
					  onclick="formhash( this.form, this.form.password );$('.form-group').removeClass('has-error');">
		      Log In <span class="glyphicon glyphicon-chevron-right"></span></button>
            </div>
          </div>

        </form>

      </div><!-- container -->
    </div><!-- jumbotron -->
  </div><!-- container -->

</body>

<?
	if( isset( $_GET['error'] ) )
	{
		$error = $_GET['error'];

		switch( $error )
		{
			case "no_such_user": ?>
				<script>$( '#username_error' ).html( '<span class="glyphicon glyphicon-remove"></span> No such user!' );
						$( '#username_input' ).addClass( 'has-error' );
				</script>
				<? break;
			case "wrong_password": ?>
				<script>$( '#password_error' ).html( '<span class="glyphicon glyphicon-remove"></span> Wrong password!' );
						$( '#password_input' ).addClass( 'has-error' );
				</script>
				<? break;
			case "account_locked": ?>
				<script>$( '#username_error' ).html( '<span class="glyphicon glyphicon-remove"></span> This account is locked!' );
						$( '#username_input' ).addClass( 'has-error' );
				</script>
				<? break;
		}
	}

?> 

</html>
