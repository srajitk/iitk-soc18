<?php
	session_start();
	if (empty($_SESSION['user_id']) or empty($_SESSION['accType'])){
		session_destroy();
		exit();
	} elseif ($_SESSION['accType'] != 'buyer') {
		session_destroy();
		exit();
	}
	
	else{
		$return['msg'] = "hello";

		$host = "localhost";
		$username = "root";
		$dbname = "farm_db";

		$cxn = mysqli_connect($host, $username, "", $dbname);

		$query = "SELECT CONCAT(`item_details_tbl`.`name_line1`, ' ', `item_details_tbl`.`name_line2`) AS 'name', `buy_contracts_tbl`.`Date`, CONCAT(`buy_contracts_tbl`.`qty`,`item_details_tbl`.`qty_slab_name`), `buy_contracts_tbl`.`category`, `buy_contracts_tbl`.`Amount` FROM `buy_contracts_tbl` INNER JOIN `item_details_tbl` ON `item_details_tbl`.`item_no` = `buy_contracts_tbl`.`fv_id` WHERE `buyer_id` = ". $_SESSION['user_id'];

		$result = mysqli_query($cxn, $query) or die ("couldn't execute query");

		$return['tbl'] = mysqli_fetch_all($result);

		mysqli_close($cxn);

		exit(json_encode($return));
	}
?>
