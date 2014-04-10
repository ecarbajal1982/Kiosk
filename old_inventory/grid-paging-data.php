<?php
	//database connection
		$link = mysql_pconnect("localhost", "inventoryuser", "inventoryuser") or die("Could not connect");
		mysql_select_db("inventorysystem") or die("Could not select database");
		
		
		// The ext grid script will send  a task field which will specify what it wants to do
		$task = '';
		if ( isset($_POST['task'])){
			$task = $_POST['task'];
		}
		switch($task){
			case "LISTING":
				getInventory();
				break;
			case "UPDATE":
				updateInventory();
				break;
			case "ADD":
				addInventory();
				break;		
			default:
				echo "{failure:true}";
				break;
		}		
				
		//update inventory
			function updateInventory()
			{
				$tag = $_POST['tag'];
				$make = $_POST['make'];
				$model = $_POST['model'];
				$serial = $_POST['serial'];
				$purchase_date = $_POST['purchase_date'];
				$purchase_by  = $_POST['purchase_by'];
				$department = $_POST['department'];
				$fname = $_POST['fname'];
				$lname = $_POST['lname'];
				$location = $_POST['location'];
				$building = $_POST['building'];
				$room = $_POST['room'];
				$os = $_POST['os'];
				$mac = $_POST['mac'];
				$wmac = $_POST['wmac'];
				$printer = $_POST['printer'];
				$notes = $_POST['notes'];


				//update record
				$query = "UPDATE inventory SET 
					make = '$make',
					model = '$model',
					purchase_date = '$purchase_date',
					purchase_by = '$purchase_by',
					department = '$department',
					location = '$location',
					building = '$building',
					room = '$room'
					WHERE tag = $tag";
					
				    $result = mysql_query($query);
    				echo '1';
					if (!result) {
						echo '0';				
					} 
			}
		
		//display inventory
			function getInventory()
			{
			
			$start = (integer) (isset($_POST['start']) ? $_POST['start'] : $_GET['start']);
			$end = (integer) (isset($_POST['limit']) ? $_POST['limit'] : $_GET['limit']);  
		
			//check for the 'sort' and 'dir' in the POST array.   
			$sortDir = isset($_POST['dir']) ? $_POST['dir'] : 'ASC'; //default to ASC if not set  
			$sortBy = isset($_POST['sort']) ? $_POST['sort'] : 'tag'; //default to company name if not set
		
			$sql_count = "SELECT * FROM inventory";
			
			//search query
			if (isset($_POST['sql_count'])){
			$sql_count .= " WHERE (tag LIKE '%".addslashes($_POST['sql_count'])."%' OR fname LIKE '%".addslashes($_POST['sql_count'])."%'
			OR lname LIKE '%".addslashes($_POST['sql_count'])."%' OR make LIKE '%".addslashes($_POST['sql_count'])."%' 
			OR model LIKE '%".addslashes($_POST['sql_count'])."%' OR room LIKE '%".addslashes($_POST['sql_count'])."%' 
			OR serial LIKE '%".addslashes($_POST['sql_count'])."%' OR os LIKE '%".addslashes($_POST['sql_count'])."%' 
			OR mac LIKE '%".addslashes($_POST['sql_count'])."%' OR wmac LIKE '%".addslashes($_POST['sql_count'])."%' 
			OR printer LIKE '%".addslashes($_POST['sql_count'])."%' OR department LIKE '%".addslashes($_POST['sql_count'])."%'
			OR purchase_date LIKE '%".addslashes($_POST['sql_count'])."%' OR purchase_by LIKE '%".addslashes($_POST['sql_count'])."%')";
	 	    }
			
			$sql = $sql_count . ' ORDER BY ' . $sortBy. ' ' . $sortDir . ' LIMIT ' . $start . ', '. $end;
			$rs_count = mysql_query($sql_count);
			$rows = mysql_num_rows($rs_count);
			$rs = mysql_query($sql);
				
				while($obj = mysql_fetch_array($rs, MYSQL_ASSOC))
					{
						$arr[] = $obj;
					}
			
				Echo $_GET['callback'].'({"total":"'.$rows.'","results":'.json_encode($arr).'})';
				
			}
		
		
		//add Inventory
		
			function addInventory()
			{
				$tag = $_POST['tag'];
				$make = $_POST['make'];
				$model = $_POST['model'];
				$serial = $_POST['serial'];
				$purchase_date = $_POST['purchase_date'];
				$purchase_by  = $_POST['purchase_by'];
				$department = $_POST['department'];
				$fname = $_POST['fname'];
				$lname = $_POST['lname'];
				$location = $_POST['location'];
				$building = $_POST['building'];
				$room = $_POST['room'];
				$os = $_POST['os'];
				$mac = $_POST['mac'];
				$wmac = $_POST['wmac'];
				$printer = $_POST['printer'];
				$notes = $_POST['notes'];
	
				$query = "INSERT INTO inventory (`tag` ,`make` ,`model` ,`serial` ,`purchase_date` ,`purchase_by` ,`department` ,`fname` ,`lname` ,`location` ,`building` ,`room` ,`os`
				,`mac` ,`wmac` ,`printer` ,`notes`) VALUES ('$tag' , '$make', '$model', '$serial', '$purchase_date', '$purchase_by', '$department', '$fname'
				, '$lname', '$location', '$building', '$room', '$os', '$mac', '$wmac', '$printer', '$notes')";
				$result = mysql_query($query);
				echo '1';
			}
			
		
	
			
			
				
?>


