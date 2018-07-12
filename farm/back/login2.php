<?php
	$login = $_POST["loginType"];
	$acc = $_POST["accType"];

		
	//retrieving the back hash from the database...
	$host = "localhost";
	$username = "root";
	$dbname =  "farm_db";
	
	$cxn = mysqli_connect($host, $username, "", $dbname);
	
	$acc = mysqli_real_escape_string($cxn, $acc);
	$login = mysqli_real_escape_string($cxn, $login);
	
	if (preg_match('/[><!=-]/', $acc) || preg_match('/[><!=-]/', $login)){
		$return['access'] = false;
		$return['msg'] = "dangerous character(s) encountered";
		exit(json_encode($return));
	}
	
	
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
		else {
			$return['access'] = false;
			$return['msg'] = "account type not recognized";
			exit(json_encode($return));
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
		else {
			$return['access'] = false;
			$return['msg'] = "account type not recognized";
			exit(json_encode($return));
		}
	}
	else {
		$return['access'] = false;
		$return['msg'] = "login type not recognized";
		exit(json_encode($return));
	}
	
	$front_hash = $_POST["psdhash"];
	$data = $_POST["data"];
	
	if (preg_match('/^[a-fA-F0-9]*$/', $front_hash) && ! preg_match('/[<>=!"]/', $data)){	
	
		$front_hash = mysqli_real_escape_string($cxn, $front_hash);
		$data = mysqli_real_escape_string($cxn, $data);

		$return = $_POST;

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
	} else {
		$return['access'] = false;
		$return['msg'] = "regex checks failed";
		exit(json_encode($return));
	}
?>