<?php
	$return["status"] = "fine";
	
	$front_hash = $_POST["psdhash"];
	$acc = $_POST["accType"];
	$mob = $_POST["mob"];
	
	$regex = '/[`#\'"!;=<>]/';
	
	if  (preg_match($regex,$acc) === 0){
		//generating the password
		$back_hash = hash("sha256", $front_hash);
		
		
		// adding password to the database...
		$host = "localhost";
		$username = "root";
		$dbname = "farm_db";
		
		$cxn = mysqli_connect($host, $username, "",$dbname);
		
		if ($acc == "farmer"){
			$query = "UPDATE `farmer_tbl` SET `password_hash` = '".$back_hash."' WHERE `farmer_tbl`.`mobile_no` = '".$mob."'; ";
		}elseif ($acc == "buyer"){
			$query = "UPDATE `buyer_tbl` SET `password_hash` = '".$back_hash."' WHERE `buyer_tbl`.`mobile_no` = '".$mob."'; ";
		}
		
		mysqli_query($cxn, $query) or die ($query);
		mysqli_close($cxn);
		$return['status'] = "all ok";
	} else {
		$return['status'] = "regex failed";
	}
	exit(JSON_encode($return));
?>