<?php 
	$return = $_POST;
	$return["status"] = "fine";
			
	$fn = $_POST["fname"];
	$ln = $_POST["lname"];
	$dob = $_POST["dob"];
	$em = $_POST["email"];
	$mob = $_POST["mob"];
	$acc = $_POST["accType"];
	
	$regex = '/[`#\-"!;=<>]/';
	$mobRegex0 = '/0{5}/';
	$mobRegex1 = '/^(\+?\d{1,3}[- ]?)?(\d{10})$/';
	
	/*To do: IMPROVE PROTECTION AGAINST SQL INJECTIONS: https://stackoverflow.com/questions/60174/how-can-i-prevent-sql-injection-in-php 
	for now basic regex is used*/
	
	if ($acc == "farmer") {
	
		$addr = $_POST['addr'];
		
		$inputOK = true;
		$inputOK = $inputOK && (preg_match($regex,$fn) === 0);
		$inputOK = $inputOK && (preg_match($regex,$ln) === 0);
		$inputOK = $inputOK && (preg_match($regex,$em) === 0);
		$inputOK = $inputOK && (preg_match($regex,$dob) === 0);
		$inputOK = $inputOK && (preg_match($regex,$mob) === 0);
		$inputOK = $inputOK && (preg_match($regex,$addr) === 0);
		
		$return["sqlIn"] = "lskdjflkslajk";
		if ($inputOK){
			$return["sqlIn"] = "check against sql injections performed. safe";
		}
		if (!$inputOK){
			$return["sqlIn"] = "check against sql injections performed. unsafe";
		}
		
		$inputOK = $inputOK && (preg_match($mobRegex1,$mob) === 1);
		
		if (preg_match($mobRegex0, $mob) !== 0){
			$inputOK = false;
		}
		// insertion into the database
		if ($inputOK){	
			$host = "localhost";
			$username = "root";
			$dbname = "farm_db";
			
			$cxn = mysqli_connect($host, $username, "", $dbname);
			
			$return["msg"] = "";
			// checking if the mobile number is taken
			$chkquery = "SELECT EXISTS(SELECT `mobile_no` FROM `farmer_tbl` WHERE `mobile_no` = '".$mob."') AS 'taken'";
			$result = mysqli_query($cxn, $chkquery) or die("couldn't excecute query");
			$row = mysqli_fetch_assoc($result);
			if ($row["taken"] == 1){
				$return["msg"] += "mobile number already taken; ";
				exit(json_encode($return));
			}
			// checking if the email id is taken
			$chkquery2 = "SELECT EXISTS(SELECT `email` FROM `farmer_tbl` WHERE `email` = '".$mob."') AS 'taken'";
			$result2 = mysqli_query($cxn, $chkquery) or die("couldn't excecute query");
			$row2 = mysqli_fetch_assoc($result);
			if ($row2["taken"] == 1){
				$return["msg"] += "email already taken";
				exit(json_encode($return));
			}
				
			$salt = bin2hex(openssl_random_pseudo_bytes(32,$cstrong));
			$return["salt"] = $salt;
			$return["safe"] = $cstrong;
			
			$query = "INSERT INTO `farmer_tbl` (`salt`, `password_hash`, `first_name`, `last_name`, `email`, `dob`, `mobile_no`, `pickup_address`) VALUES ('".$salt."', NULL, '".$fn."', '".$ln."', '".$em."', '".$dob."', '".$mob."', '".$addr."');";
				
			mysqli_query($cxn, $query) or die($query);
				
			mysqli_close($cxn);
			$return["msg"] = "values ok";
		} else {
			$return["msg"] = "php did not approve of the input";
		}
	exit(json_encode($return));
	}
	elseif ($acc == "buyer") {
	
		$addr = $_POST['addr'];
		
		$inputOK = true;
		$inputOK = $inputOK && (preg_match($regex,$fn) === 0);
		$inputOK = $inputOK && (preg_match($regex,$ln) === 0);
		$inputOK = $inputOK && (preg_match($regex,$em) === 0);
		$inputOK = $inputOK && (preg_match($regex,$dob) === 0);
		$inputOK = $inputOK && (preg_match($regex,$mob) === 0);
		$inputOK = $inputOK && (preg_match($regex,$addr) === 0);
		
		$return["sqlIn"] = "lskdjflkslajk";
		if ($inputOK){
			$return["sqlIn"] = "check against sql injections performed. safe";
		}
		else {
			$return["sqlIn"] = "check against sql injections performed. unsafe";
		}
		
		$inputOK = $inputOK && (preg_match($mobRegex1,$mob) === 1);
		if (preg_match($mobRegex0, $mob) !== 0){
			$inputOK = false;
		}
	
		// insertion into the database
		if ($inputOK){	
			$host = "localhost";
			$username = "root";
			$dbname = "farm_db";
			
			$cxn = mysqli_connect($host, $username, "", $dbname);
			
			$return["msg"] = "";
			// checking if the mobile number is taken
			$chkquery = "SELECT EXISTS(SELECT `mobile_no` FROM `buyer_tbl` WHERE `mobile_no` = '".$mob."') AS 'taken'";
			$result = mysqli_query($cxn, $chkquery) or die("couldn't excecute query");
			$row = mysqli_fetch_assoc($result);
			if ($row["taken"] == 1){
				$return["msg"] .= "mobile number already taken; ";
				exit(json_encode($return));
			}
			// checking if the email id is taken
			$chkquery2 = "SELECT EXISTS(SELECT `email` FROM `buyer_tbl` WHERE `email` = '".$mob."') AS 'taken'";
			$result2 = mysqli_query($cxn, $chkquery) or die("couldn't excecute query");
			$row2 = mysqli_fetch_assoc($result);
			if ($row2["taken"] == 1){
				$return["msg"] .= "email already taken";
				exit(json_encode($return));
			}
				
			$salt = bin2hex(openssl_random_pseudo_bytes(32,$cstrong));
			$return["salt"] = $salt;
			$return["safe"] = $cstrong;
			
			$query = "INSERT INTO `buyer_tbl` (`salt`, `password_hash`, `first_name`, `last_name`, `email`, `dob`, `mobile_no`, `delivery_address`) VALUES ('".$salt."', NULL, '".$fn."', '".$ln."', '".$em."', '".$dob."', '".$mob."', '".$addr."');";
				
			mysqli_query($cxn, $query) or die($query);
				
			mysqli_close($cxn);
			$return["msg"] = "values ok";
		} else {
			$return["msg"] = "php did not approve of the input";
		}
	exit(json_encode($return));
	} elseif ($acc == "evaluator") {
	
		$addr = $_POST['addr'];
		
		$inputOK = true;
		$inputOK = $inputOK && (preg_match($regex,$fn) === 0);
		$inputOK = $inputOK && (preg_match($regex,$ln) === 0);
		$inputOK = $inputOK && (preg_match($regex,$em) === 0);
		$inputOK = $inputOK && (preg_match($regex,$dob) === 0);
		$inputOK = $inputOK && (preg_match($regex,$mob) === 0);
		$inputOK = $inputOK && (preg_match($regex,$addr) === 0);
		
		$return["sqlIn"] = "lskdjflkslajk";
		if ($inputOK){
			$return["sqlIn"] = "check against sql injections performed. safe";
		}
		else {
			$return["sqlIn"] = "check against sql injections performed. unsafe";
		}
		
		$inputOK = $inputOK && (preg_match($mobRegex1,$mob) === 1);
		if (preg_match($mobRegex0, $mob) !== 0){
			$inputOK = false;
		}
	
		// insertion into the database
		if ($inputOK){	
			$host = "localhost";
			$username = "root";
			$dbname = "farm_db";
			
			$cxn = mysqli_connect($host, $username, "", $dbname);
			
			$return["msg"] = "";
			// checking if the mobile number is taken
			$chkquery = "SELECT EXISTS(SELECT `mobile_no` FROM `evaluator_tbl` WHERE `mobile_no` = '".$mob."') AS 'taken'";
			$result = mysqli_query($cxn, $chkquery) or die("couldn't excecute query");
			$row = mysqli_fetch_assoc($result);
			if ($row["taken"] == 1){
				$return["msg"] .= "mobile number already taken; ";
				exit(json_encode($return));
			}
			// checking if the email id is taken
			$chkquery2 = "SELECT EXISTS(SELECT `email` FROM `evaluator_tbl` WHERE `email` = '".$mob."') AS 'taken'";
			$result2 = mysqli_query($cxn, $chkquery) or die("couldn't excecute query");
			$row2 = mysqli_fetch_assoc($result);
			if ($row2["taken"] == 1){
				$return["msg"] .= "email already taken";
				exit(json_encode($return));
			}
				
			$salt = bin2hex(openssl_random_pseudo_bytes(32,$cstrong));
			$return["salt"] = $salt;
			$return["safe"] = $cstrong;
			
			$query = "INSERT INTO `evaluator_tbl` (`salt`, `password_hash`, `first_name`, `last_name`, `email`, `dob`, `mobile_no`, `reside_address`) VALUES ('".$salt."', NULL, '".$fn."', '".$ln."', '".$em."', '".$dob."', '".$mob."', '".$addr."');";
				
			mysqli_query($cxn, $query) or die($query);
				
			mysqli_close($cxn);
			$return["msg"] = "values ok";
		} else {
			$return["msg"] = "php did not approve of the input";
		}
	exit(json_encode($return));
	}
?>