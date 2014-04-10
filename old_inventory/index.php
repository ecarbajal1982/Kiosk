<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>College of Arts &amp; Letters Inventory</title>

<link rel="stylesheet" type="text/css" href="css/inventory.css" />
<link rel="stylesheet" type="text/css" href="lib/resources/css/ext-all.css" />
<link rel="stylesheet" type="text/css" href="css/RowActions.css" />
<link rel="stylesheet" type="text/css" href="css/RecordForm.css" />

<script type="text/javascript" src="lib/adapter/ext/ext-base.js"></script>
<script type="text/javascript" src="lib/ext-all.js"></script>
<script type="text/javascript" src="ajax/RecordForm.js"></script>	
<script type="text/javascript" src="ajax/RowActions.js"></script>
<script type="text/javascript" src="ajax/Toast.js"></script>
<script type="text/javascript" src="searchfield.js"></script>
<script type="text/javascript" src="ajax/RowExpander.js"></script>
<script type="text/javascript" src="paging.js"></script>

<style type="text/css">
        body .x-panel {
            margin-bottom:20px;
        }
        .icon-grid {
            background-image:url(images/grid.png) !important;
        }
        #button-grid .x-panel-body {
            border:1px solid #99bbe8;
            border-top:0 none;
        }
		
		.add {
 		 	background-image:url(images/add.gif) !important;
		}
		.search {
			background-image:url(images/search.png) !important;
		}
		.icon-edit-record {
			background-image:url(images/edit.png) !important;
		}
		
		.ux-grid3-row-action-cell .x-grid3-cell-inner {
			padding: 1px 0 0 0;
		}
		.ux-grid3-row-action-cell .x-grid3-cell-inner div {
			background-repeat:no-repeat;
			width:16px;
			height:16px;
			cursor:pointer;
		}
		
    </style>
</head>
<body>

<?php include('header.php'); ?>

<div id="wrap">
	<div id="content">


	<select name="building" id="building" style="display: none;">
		<option value="ce">CE</option>
		<option value="fo">FO</option>
        	<option value="pa">PA</option>
		<option value="pl">PL</option>
		<option value="uh">UH</option>
		<option value="va">VA</option>
	</select>

	<select name="department" id="department" style="display: none;">
		<option value="cal">College of Arts &amp; Letters</option>
		<option value="art">Art</option>
		<option value="comm">Communication</option>
		<option value="eng">English</option>
		<option value="lib">Liberal Studies</option>
		<option value="mus">Music</option>
		<option value="phil">Philosophy</option>
		<option value="rvf">RVF Museum</option>
		<option value="th">Theatre</option>
		<option value="wl">World Languages</option>
	</select>
	
	<select name="purchase_by" id="purchase_by" style="display: none;">
		<option value="college">College</option>
		<option value="dept">Department</option>
	</select>
	
	<select name="location" id="location" style="display: none;">
		<option value="on">On</option>
		<option value="off">Off</option>
		<option value="sur">Surplus</option>
	</select>

	<div id="topic-grid"></div>

	</div><!-- [content] -->
</div><!-- [wrap] -->

<?php include('footer.php'); ?>

</body>
</html>



