 <!-- Fixed navbar -->
<div class="navbar navbar-inverse navbar-fixed-top" role="navigation">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" style="font-family:Times New Roman;font-size:19pt;" href="portal.php">College of Arts & Letters Inventory</a>
    </div>
    <div class="navbar-collapse collapse">
      <ul class="nav navbar-nav pull-right">
        <li><a href="#"><b>Search</b></a></li>
<li class="divider-vertical"></li>
        <li><a href="#">Add Equipment</a></li>
        <li><a href="#">Add Software</a></li>

        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">List All <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="#" onClick="get_list( 'computers' );">
                <span class="glyphicon glyphicon-hdd"></span>&nbsp; Computers/Tablets</a>
              </li>
              <li><a href="#" onClick="get_list( 'printers' );">
                <span class="glyphicon glyphicon-print"></span>&nbsp; Network Printers</a>
              </li>
              <li><a href="#" onClick="get_list( 'users' );">
                <span class="glyphicon glyphicon-user"></span>&nbsp; Faculty/Staff Users</a>
              </li>
              <li><a href="#" onClick="get_list( 'users' );">
                <span class="glyphicon glyphicon-barcode"></span>&nbsp; Purchase Orders</a>
              </li>
		      <? if ( $_SESSION['role'] > 1 ) : ?>
			    <li class='divider'></li>
                <li><a href="#" onClick="get_list( 'software' );">
                  <span class='glyphicon glyphicon-lock'></span>&nbsp; Software Licenses</a>
                </li>
		      <? endif; ?>
            </ul>
          </li>
        </ul>
	    <?
	  		if ( $_SESSION['role'] == 4 )
				echo '<ul class="nav navbar-nav">
      				    <li class="dropdown">
        				  <a href="#" class="dropdown-toggle" data-toggle="dropdown">Administration <b class="caret"></b></a>
        				  <ul class="dropdown-menu">
        	 			    <li><a href="#"><span class="glyphicon glyphicon-list"></span>&nbsp; Manage Inventory Users</a></li>
        	  			    <li><a href="#"><span class="glyphicon glyphicon-eye-open"></span>&nbsp; View User Activity Log</a></li>
        				  </ul>
      					</li>
    				  </ul>';
	    ?>
<!--
        <form class="navbar-form navbar-left">
          <input type="text" class="form-control" placeholder="Search" size="45">
          <button class="btn btn-primary" type="button"><span class="glyphicon glyphicon-search"></span></button>
        </form>
-->
        <ul class="nav navbar-nav navbar-right text-right">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><? echo $_SESSION['username']; ?> &nbsp;<span class="glyphicon glyphicon-cog"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">View User Log &nbsp;<span class="glyphicon glyphicon-list-alt"></span></a></li>
              <li><a href="#">Reset Password &nbsp;<span class="glyphicon glyphicon-wrench"></span></a></li>
              <li class="divider"></li>
              <li><a href="include/process_logout.php">Log out &nbsp;<span class="glyphicon glyphicon-exclamation-sign"></span></a></li>
            </ul>
          </li>
        </ul>
      </ul>
 
    </div><!--/.nav-collapse -->
  </div>
</div>