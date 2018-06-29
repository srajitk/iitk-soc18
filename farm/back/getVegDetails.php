<?php
	$fv = $_POST['id'];
	
	/*$return = $_POST;
	$return["A"] = 1;
	$return['sdf'] = "sdf";*/
	
	$host = "localhost";
	$username = "root";
	$dbname = "farm_db";
	
	$cxn = mysqli_connect($host, $username, "", $dbname);
	
	if (mysqli_connect_errno()){
		$return["status"] = "error";
		$return["err"] = "couldn't connect to database";
		$return["errmsg"] = mysqli_connect_error();	
		exit(json_encode($return));
	}
	
	$fv = mysqli_real_escape_string($cxn, $fv);
	
	$query = "SELECT `name_line1`, `name_line2` FROM `farm_db`.`item_details_tbl` WHERE `item_details_tbl`.`item_no` = '$fv';";
	
	$result = mysqli_query($cxn, $query) or die ("couldn't execute query: $query");
	
	$row = mysqli_fetch_assoc($result);
	
	if ($row["name_line1"] != ""){
		$return["status"] = "ok";
		$return["err"] = "None";
		$return["name1"] = $row["name_line1"];
		$return["name2"] = $row["name_line2"];
	}
	else {
		$return["status"] = "error";
		$return["err"] = "couldn't find item";
	}

	exit(json_encode($return));
?>