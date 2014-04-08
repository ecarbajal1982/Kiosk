<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>CAL Inventory</title>

  <!-- Bootstrap core CSS -->
  <link href="css/bootstrap.min.css" rel="stylesheet">


  <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>

<!-- Welcome Banner -->
<div class="jumbotron">
  <div class="container">
    <h1 style="font-family:'Times New Roman';">
      Welcome to the College of Arts & Letters<br>
      Equipment and Software Inventory System
    </h1>
    <p>
      To begin your search, please log in below.
    </p>

    <!-- Login Panel -->
		<div class='alert alert-danger pull-left'>Incorrect Username or Password!</div>  
<br>
    <form class="pull-left" action="login_submit.php" method="post">
  	<fieldset>

      <!-- Text input-->

      <div class="control-group">
        <label class="control-label" for="username"></label>
        <div class="controls">
          <input id="username" name="username" type="text" placeholder="Username" class="input-xlarge form-control">
        </div>
      </div>

      <!-- Password input-->

      <div class="control-group">
        <label class="control-label" for="password"></label>
        <div class="controls">
          <input id="password" name="password" type="password" placeholder="Password" class="form-control">
        </div>
      </div>

      <!-- Login Button -->

      <div class="control-group">
        <label class="control-label" for="login_submit"></label>
        <div class="controls">
          <button id="login_submit" name="login_submit" class="btn btn-primary">Log In »</button>

        </div>
      </div>

    </fieldset>
    </form>

    <!-- end Login Panel -->

  </div><!-- end container -->
</div><!-- end jumbotron -->


<!-- end Welcome Banner -->


<!-- Bootstrap core JavaScript
  ================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>

</body>
</html>
