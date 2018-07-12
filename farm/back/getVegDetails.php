<?php
	session_start();
	if (empty($_SESSION['user_id']) or empty($_SESSION['accType'])){
		session_destroy();
		exit();
	}
	elseif ($_SESSION['accType'] != 'buyer') {
		session_destroy();
		exit();
	}
	else{
		$fv = $_POST['id'];
		$host = "localhost";
		$username = "root";
		$dbname = "farm_db";

		$cxn = mysqli_connect($host, $username, "", $dbname);

		if (mysqli_connect_errno()){
			$return["status"] = "ugly";
			$return["err"] = "couldn't connect to database";
			$return["errmsg"] = mysqli_connect_error();
			exit(json_encode($return));
		}

		if (preg_match('/^\d{0,3}$/', $fv)) {

			$fv = mysqli_real_escape_string($cxn, $fv);

			$query = "SELECT `name_line1`, `name_line2`, `qty_slab_no`, `price_q1` FROM `farm_db`.`item_details_tbl` WHERE `item_details_tbl`.`item_no` = '$fv';";

			$result = mysqli_query($cxn, $query) or die ("couldn't execute query: $query");

			$row = mysqli_fetch_assoc($result);

			switch($row['qty_slab_no']) {
				case 0:
				$return['uts'] = 'kg';
				$return['min'] = 1;
				$return['max'] = 20;
				$return['step'] = 1;
				break;
				case 1:
				$return['uts'] = 'g';
				$return['min'] = 100;
				$return['max'] = 1000;
				$return['step'] = 100;
				break;
				case 2:
				$return['uts'] = 'g';
				$return['min'] = 250;
				$return['max'] = 2000;
				$return['step'] = 250;
				break;
				case 3:
				$return['uts'] = 'dz';
				$return['min'] = 1;
				$return['max'] = 20;
				$return['step'] = 1;
				break;
				case 4:
				$return['uts'] = 'pc';
				$return['min'] = 1;
				$return['max'] = 20;
				$return['step'] = 1;
				break;
				case 5:
				$return['uts'] = 'bndl';
				$return['min'] = 1;
				$return['max'] = 20;
				$return['step'] = 1;
				break;
				case 6:
				$return['uts'] = 'pkt';
				$return['min'] = 1;
				$return['max'] = 20;
				$return['step'] = 1;
				break;
			}


			if ($row["name_line1"] != ""){
				$return["status"] = "ok";
				$return["err"] = "None";
				$return["name1"] = $row["name_line1"];
				$return["name2"] = $row["name_line2"];
				$return["utPrice"] = $row["price_q1"];
			}
			else {
				$return["status"] = "error";
				$return["err"] = "couldn't find item";
			}
			exit(json_encode($return));
		}
	}
?>
