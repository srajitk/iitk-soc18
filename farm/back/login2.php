<?php
	$login = $_POST["loginType"];
	$acc = $_POST["accType"];
	
	if ($login == "mobno") {
		if ($acc == "farmer") {
			$tblName = "farmer_tbl";
			$paramName = "mobile_no";
		}
		elseif ($acc == "buyer") {
			$tblName = "buyer_tbl";
			$paramName = "mobile_no";
		}
		elseif ($acc == "evaluator") {
			$tblName = "evaluator_tbl";
			$paramName = "mobile_no";
		}
	}
	elseif ($login == "email") {
		if ($acc == "farmer") {
			$tblName = "farmer_tbl";
			$paramName = "email";
		}
		elseif ($acc == "buyer") {
			$tblName = "buyer_tbl";
			$paramName = "email";
		}
		elseif ($acc == "evaluator") {
			$tblName = "evaluator_tbl";
			$paramName = "email";
		}
	}
	
	$front_hash = $_POST["psdhash"];
	$data = $_POST["data"];
	
	$return = $_POST;
	
	//retrieving the back hash from the database...
	$host = "localhost";
	$username = "root";
	$dbname =  "farm_db";
	
	$cxn = mysqli_connect($host, $username, "computer", $dbname);
	
	$query = "SELECT `password_hash`,`user_id`, `salt1` FROM `".$tblName."` WHERE `".$paramName."` = '".$data."'";
	
	$result = mysqli_query($cxn, $query) or die("couldn't excecute query");
	
	$row = mysqli_fetch_assoc($result);
	
	$hash = $row["password_hash"];
	$usr = $row["user_id"];
	$salt2 = $row["salt1"];
	
	$back_hash = hash("sha256", $front_hash.$salt2);
	
	$return["hash"] = $hash;
	
	mysqli_close($cxn);
	
	$verify = ($hash == $back_hash);
	
	if ($verify){
		session_start();
		$_SESSION['user_id'] = $usr;
		$_SESSION['accType'] = $acc;
	}
	
	$return["access"] = $verify;
	
	exit(json_encode($return));
?>