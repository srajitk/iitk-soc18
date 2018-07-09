<?php
	session_start();
	if (empty($_SESSION['user_id']) or empty($_SESSION['accType'])){
		header("Location: index.php");
		session_destroy();
		exit();
	} elseif ($_SESSION['accType'] != 'buyer') {
		session_destroy();
		exit();
	}
	
	else{
		$return = "";
		foreach ($_POST as $order){

			switch($order['cat']){
				case "a": $ratio=1; break;
				case "b": $ratio=0.75; break;
				case "c": $ratio=0.4; break;
			}
				// exit($ratio);
			$host = "localhost";
			$username = "root";
			$dbname = "farm_db";
			$price=0;
			$cxn = mysqli_connect($host, $username, "", $dbname);

			$regexId = '/^\d{0,3}$/';
			$regexDate = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/";
			$regexQty = '/^\d{0,5}$/';
			$regexCat = '/[abc]/';

			if (preg_match($regexId, $order['id']) && preg_match($regexDate, $order['date']) && preg_match($regexQty, $order['qty']) && preg_match($regexCat, $order['cat'])){
				if (date("Y-m-d", strtotime($order['date']))== $order['date']){
					$chkquery = "SELECT `contract_id`,`qty` FROM `buy_contracts_tbl` WHERE `buyer_id` = '".$_SESSION['user_id']."' AND `fv_id` = '".$order['id']."' AND `Date` = '".$order['date']."' AND `category` = '".$order['cat']*$ratio."'";

					$result = mysqli_query($cxn, $chkquery) or die ("check failed");

					$costQuery = "SELECT `price_q1` FROM `item_details_tbl` WHERE `item_no` = ".$order['id'];
					// exit(($costQuery));
					$fruit = mysqli_query($cxn,$costQuery);
					while($row1 = mysqli_fetch_assoc($fruit)){
						$price = $row1['price_q1'];
					}
					// $a=$order['qty'];
					// $b=$price;
// exit($);
					if (mysqli_num_rows($result) == 0) {
						$query = "INSERT INTO `buy_contracts_tbl` (`buyer_id`, `fv_id`, `Date`, `qty`, `category`, `Amount`) VALUES ('".$_SESSION['user_id']."', '".$order['id']."', '".$order['date']."', '".$order['qty']."', '".$order['cat']."', ".$price*$order['qty']*$ratio.")";
						mysqli_query($cxn, $query) or die ("couldn't execute query");
					} elseif (mysqli_num_rows($result) == 1) {
						$row = mysqli_fetch_assoc($result);
						$query = "UPDATE `buy_contracts_tbl` SET `qty` = '".strval(intval($row['qty']) + intval($order['qty']))."' WHERE `buy_contracts_tbl`.`contract_id` = ".$row['contract_id'].";";
						mysqli_query($cxn, $query) or die ("couldn't execute query");
					}
				}
			}
			mysqli_close($cxn);
		}
		exit(json_encode($return));
	}
?>
