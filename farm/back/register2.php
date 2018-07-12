<?php
	$return["status"] = "fine";
	
	$front_hash = $_POST["psdhash"];
	$acc = $_POST["accType"];
	$mob = $_POST["mob"];
	
	$regex = '/[`#\'"!;=<>]/';
	
	if  (preg_match($regex,$acc) === 0 && preg_match('/^[a-fA-F0-9]*$/', $front_hash) && preg_match('/^(\+?\d{1,3}[- ]?)?(\d{10})$/', $front_hash)){
		//generating the password
		
		$salt2 = bin2hex(openssl_random_pseudo_bytes(32,$cstrong));
		
		$back_hash = hash("sha256", ($front_hash.$salt2));
		
		
		// adding password to the database...
		$host = "localhost";
		$username = "root";
		$dbname = "farm_db";
		
		$cxn = mysqli_connect($host, $username, "",$dbname);
		
		if ($acc == "farmer"){
			$query = "UPDATE `farmer_tbl` SET `password_hash` = '".$back_hash."', `salt1` = '".$salt2."' WHERE `farmer_tbl`.`mobile_no` = '".$mob."'; ";
		}elseif ($acc == "buyer"){
			$query = "UPDATE `buyer_tbl` SET `password_hash` = '".$back_hash."', `salt1` = '".$salt2."' WHERE `buyer_tbl`.`mobile_no` = '".$mob."'; ";
		}elseif ($acc == "evaluator"){
			$query = "UPDATE `evaluator_tbl` SET `password_hash` = '".$back_hash."', `salt1` = '".$salt2."' WHERE `evaluator_tbl`.`mobile_no` = '".$mob."'; ";
		}
		
		mysqli_query($cxn, $query) or die ($query);
		mysqli_close($cxn);
		$return['status'] = "all ok";
	} else {
		$return['status'] = "regex failed";
	}
	exit(JSON_encode($return));
?>