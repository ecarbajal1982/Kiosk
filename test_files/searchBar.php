<?php

$userName = $_SESSION['userName'];
$userLevel = $_SESSION['userLevel'];

// admin gets blue on white panel, other users get white on blue
if ($userLevel < 4)
    $navPanelBG = 'navbar-inverse';

else
    $navPanelBG = '';


// navigation panel
echo '
<nav class="navbar '.$navPanelBG.' navbar-fixed-top"
role="navigation">
  <div class="container-fluid">
    <div class="navbar-header">
      <a style="font-family:Times New Roman;font-size:24pt;" class="navbar-brand" href="#">College of Arts & Letters Inventory</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" >
      <ul class="nav navbar-nav">
        <li><a href="#">Help</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">List All<b class="caret"></b></a>
          <ul class="dropdown-menu">
            <li><a href="#">Computers</a></li>
            <li class="divider"></li>
            <li><a href="#">Network Printers</a></li>
            <li class="divider"></li>
            <li><a href="#">Licensed Software</a></li>
            <li class="divider"></li>
            <li><a href="#">Purchase Orders</a></li>
            <li class="divider"></li>
            <li><a href="#">Other Equipment</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search" size="40">
        </div>

    <button type="button" class="btn btn-info btn-md">
      <span class="glyphicon glyphicon-search"></span>
    </button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">'.$userName.' <span class="glyphicon glyphicon-user"></span></a>
          <ul class="dropdown-menu">
            <li><a href="#">Settings</a></li>
            <li class="divider"></li>
            <li><a href="#">Log Out</a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
';

?>
