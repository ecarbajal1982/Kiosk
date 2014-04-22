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
        <li data-backdrop="true" data-toggle="modal" data-target="#searchModal">
					<a style="cursor:pointer;"><b>Search</b></a>
				</li>
				<li class="divider-vertical"></li>
        <li data-backdrop="true" data-toggle="modal" data-target="#addEquipmentModal">
					<a style="cursor:pointer;">Add Equipment</a>
				</li>
        <li data-backdrop="true" data-toggle="modal" data-target="#addSoftwareModal">
					<a style="cursor:pointer;">Add Software</a>
				</li>

        <ul class="nav navbar-nav">
          <li class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">List All <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="#" onClick="list_computers();"><i class="fa fa-desktop"></i>&nbsp; Computers/Tablets</a>
              </li>
              <li><a href="#" onClick="get_list( 'labs' );"><i class="fa fa-users"></i>&nbsp; Lab Workstations</a>
              </li>
              <li><a href="#" onClick="get_list( 'printers' );"><span class="glyphicon glyphicon-print"></span>&nbsp; Network Printers</a>
              </li>
              <li><a href="#" onClick="get_list( 'users' );"><span class="glyphicon glyphicon-user"></span>&nbsp; Faculty/Staff Users</a>
              </li>
              <li><a href="#" onClick="get_list( 'purchases' );"><span class="glyphicon glyphicon-barcode"></span>&nbsp; Purchase Orders</a>
              </li>
		      <?php if ( $_SESSION['role'] > 1 ) : ?>
			    <li class='divider'></li>
                <li><a href="#" onClick="get_list( 'software' );">
                  <i class="fa fa-key"></i>&nbsp; Software Licenses</a>
                </li>
		      <?php endif; ?>
            </ul>
          </li>
        </ul>
	    <?php
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
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><?php echo $_SESSION['username']; ?> &nbsp;<span class="glyphicon glyphicon-cog"></span></a>
            <ul class="dropdown-menu">
              <li><a href="#">View User Log &nbsp;<span class="glyphicon glyphicon-list-alt"></span></a></li>
              <li><a href="#">Reset Password &nbsp;<span class="glyphicon glyphicon-wrench"></span></a></li>
              <li class="divider"></li>
              <li><a href="include/process_logout.php">Log out &nbsp;&nbsp;<i class="fa fa-sign-out"></i></a></li>
            </ul>
          </li>
        </ul>
      </ul>
 
    </div><!--/.nav-collapse -->
  </div>
</div>
