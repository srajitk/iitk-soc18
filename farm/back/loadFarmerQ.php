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
		$return['msg'] = "hello";

		$host = "localhost";
		$username = "root";
		$dbname = "farm_db";
		
		$cxn = mysqli_connect($host, $username, "", $dbname);
		
		$query = "SELECT CONCAT(`item_details_tbl`.`name_line1`, \" \",`item_details_tbl`.`name_line2`) AS `name`, `date_deliver`,`time_placed`, `Cost`,`transport`,`rank_in_q` FROM `orders_placed`,`item_details_tbl` WHERE `farmer_id` = ".$_SESSION['user_id']." AND `item_details_tbl`.`item_no` = `orders_placed`.`food` ORDER BY `date_deliver` ";
		
		$result = mysqli_query($cxn, $query) or die ("couldn't execute query");
		
		$return['tbl'] = mysqli_fetch_all($result);
		
		mysqli_close($cxn);
		
		exit(json_encode($return));
	}
?>