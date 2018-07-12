<?php
	$farmerId = $_POST['farmId'];
		
	if (!($cxn = mysqli_connect("localhost","root","","farm_db"))) {
		$return['status'] = "ugly";
		$return['err_msg'] = "couldn't connect to database";
		exit(json_encode($return));
	}
	
	$farmerId = mysqli_real_escape_string($cxn, $farmerId);
	
	if (preg_match('/^\d{0,8}$/', $farmerId)){
		$query11 = "SELECT first_name,last_name,tm00,tm01,tm02,tm10,tm11,tm12,tm20,tm21,tm22,tm30,tm31,tm32 FROM farmer_tbl WHERE user_id=".$farmerId;
		if (!($result1 = mysqli_query($cxn , $query11))){ 
			$return['status'] = "ugly";
			$return['err_msg'] = "couldn't retrieve trustMatrix, query failed: ".$query11;
			exit(json_encode($return));
		}
		
		$return['farmer'] = mysqli_fetch_all($result1);

		$query21 = "SELECT orderid,food,date_deliver,A,B,C FROM orders_placed WHERE farmer_id =".$farmerId;
		if (!($result2 = mysqli_query($cxn, $query21))){
			$return['status'] = "ugly";
			$return['err_msg'] = "couldn't retrieve trustMatrix, query failed: ".$query11;
			exit(json_encode($return));
		}
		$return['orders'] = mysqli_fetch_all($result2);
		mysqli_close($cxn);
		$return['status'] = "good";
		exit(JSON_encode($return));
	} else {
		$return['status'] = "bad";
		$return['err_msg'] = "invalid farmer_id provided";
		exit(json_encode($return));
	}
?>
