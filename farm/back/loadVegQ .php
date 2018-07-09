<?php
	session_start();
	if (empty($_SESSION['user_id']) or empty($_SESSION['accType'])){
		session_destroy();
		exit();
	} elseif ($_SESSION['accType'] != "farmer") {
		session_destroy();
		exit("you must be a farmer to access this facility");
	}
	else{
		$food = $_POST['fvid'];
		$date = $_POST['date'];			// FOR NOW THIS WORKS JUST WITH 10 JULY, DO SOMETHING

		$return['date'] = $date;
		
		$host = "localhost";
		$username = "root";
		$dbname = "farm_db";
		$cxn = mysqli_connect($host, $username, "", $dbname);
		
		$food = mysqli_real_escape_string($cxn, $food);
		$date = mysqli_real_escape_string($cxn, $date);
		
		$regexId = '/^\d{0,3}$/';
		$regexDateTime = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]) ([0-1][0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/";
		
		if (preg_match($regexId, $food) && preg_match($regexDateTime, $date)){
			if (date("Y-m-d H:i:s", strtotime($date))== $date){
				$return['status'] = "good";
				
				
				$startStr = (new DateTime($date))->format('Y-m-d');
				$endDate = new DateTime($startStr);
				$endDate = $endDate->modify('+1 day');
				$endStr = $endDate->format('Y-m-d H:i:s');
				
				
				$query = "SELECT CONCAT(`farmer_tbl`.`first_name`,' ',`farmer_tbl`.`last_name`) AS `name`, `A`,`B`,`C`, `Cost`,`transport`,`rank_in_q` FROM `orders_placed`,`farmer_tbl` WHERE `food` = '$food' AND `date_deliver` >= '$startStr' AND `date_deliver` < '$endStr' AND `farmer_tbl`.`user_id` = `orders_placed`.`farmer_id` ORDER BY `rank_in_q`";
				
				$result = mysqli_query($cxn, $query) or die ("couldn't execute query");
				
				$return['query'] = $query;
				$return['tbl'] = mysqli_fetch_all($result);
				
				mysqli_close($cxn);
				
				exit(json_encode($return));
			} else {
				$return['status'] = "bad";
				$return['err_msg'] = "invalid date entered";
				exit(json_encode($return));
			}
		} else {
			$return['status'] = "bad";
			$return['err_msg'] = "invalid entries to form";
			exit(json_encode($return));
		}
	}
?>