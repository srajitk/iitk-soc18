<?php 
	$acc = $_POST["accType"];
	$login = $_POST["loginType"];
	
	if ($login == "mobno") {
		$mob = $_POST["mob"];
	}
	if ($login == "email") {
		$email = $_POST["email"];
	}
	
	$host = "localhost";
	$username = "root";
	$dbname =  "farm_db";
	
	$cxn = mysqli_connect($host, $username, "", $dbname);
	
	$acc = mysqli_real_escape_string($cxn, $acc);
	$login = mysqli_real_escape_string($cxn, $login);

	if (preg_match('/[><!=-]/', $acc) || preg_match('/[><!=-]/', $login)){
		exit("dangerous character(s) encountered");
	}

	
	if ($acc == "farmer"){
		if ($login == "mobno"){
			$query = "SELECT `salt` FROM `farmer_tbl` WHERE `mobile_no` = '".$mob."'";
		}
		elseif ($login == "email"){
			$query = "SELECT `salt` FROM `farmer_tbl` WHERE `email` = '".$email."'";
		}
	}
	if ($acc == "buyer"){
		if ($login == "mobno"){
			$query = "SELECT `salt` FROM `buyer_tbl` WHERE `mobile_no` = '".$mob."'";
		}
		elseif ($login == "email"){
			$query = "SELECT `salt` FROM `buyer_tbl` WHERE `email` = '".$email."'";
		}
	}
	if ($acc == "evaluator"){
		if ($login == "mobno"){
			$query = "SELECT `salt` FROM `evaluator_tbl` WHERE `mobile_no` = '".$mob."'";
		}
		elseif ($login == "email"){
			$query = "SELECT `salt` FROM `evaluator_tbl` WHERE `email` = '".$email."'";
		}
	}
	$result = mysqli_query($cxn, $query) or die("couldn't excecute query");
	
	if (mysqli_num_rows($result) == 0){
		$return["err"] = "query produced no results";
		$return["query"] = $result;
	}
	
	$row = mysqli_fetch_assoc($result);
	$return["err"] = false;
	$return["salt"] = $row["salt"];
	
	mysqli_close($cxn);
	
	exit(json_encode($return));
?>