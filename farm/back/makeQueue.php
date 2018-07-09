<?php
	$host = "localhost";
	$username = "root";
	$dbname = "farm_db";
	
	$cxn = mysqli_connect($host, $username, "",$dbname);
	
	// $start = "2018-07-10 00:00:00";
	// $end   = "2018-07-11 00:00:00";
	
	$begin = new DateTime( '2018-08-20' );
	$end = new DateTime( '2018-08-27' );

	$interval = new DateInterval('P1D');
	$daterange = new DatePeriod($begin, $interval ,$end);

	foreach($daterange as $date){
		$startStr = $date->format("Y-m-d H:i");	
		$endStr = ($date->modify( '+1 day' ))->format ("Y-m-d H:i");
		
	 	for ($food = 1; $food <=180; $food++) {
			
			$avgQuery = "SELECT  AVG(`orders_placed`.`cost_eff`) AS `avg`  FROM `orders_placed` WHERE `food` = $food AND `date_deliver` >= '$startStr' AND `date_deliver` <= '$endStr'";
			$avgResult = mysqli_query($cxn, $avgQuery) or die (mysqli_error($cxn));
			while ($avgRow = mysqli_fetch_assoc($avgResult)){
				$avgCF = $avgRow['avg'];
				if (!is_null($avgCF)){
					$query = "SELECT `orders_placed`.`orderid`, `orders_placed`.`pre_img_val`/100.0, `orders_placed`.`del_t`*`item_details_tbl`.`perishablity`  / 86400.0  `time_loss`, `orders_placed`.`cost_eff` / ".$avgCF.", `farmer_tbl`.`value`  FROM `orders_placed`, `farmer_tbl`, `item_details_tbl` WHERE `food` = '$food' AND `date_deliver` >= '$startStr' AND `date_deliver` <= '$endStr' AND `farmer_tbl`.`user_id` = `farmer_id` AND `item_details_tbl`.`item_no` = `orders_placed`.`food`  ORDER BY `cost_eff` DESC ";
							
				
					$result = mysqli_query($cxn, $query)or die ($query);
					
					$tensor = mysqli_fetch_all($result, MYSQLI_NUM);
					// $tensor[.][0] => orderid, $tensor[.][1] => img_val, $tensor[.][2] => delTime, $tensor[.][3] => costEff, $tensor[.][4] => farmer value
					
					$xival = 500;
					$xdelt = -100;
					$xceff = 750;
					$xfval = 1;
					

					foreach ($tensor as $sub){
						$v = ($xival * $sub[1]) + ($xdelt * $sub[2]) + ($xceff * $sub[3]) + ($xfval * $sub[4]);
						$q = "UPDATE `orders_placed` SET `qval`= $v  WHERE `orderid` = ". $sub[0];
						mysqli_query($cxn, $q) or die ($q);
					}
					
					$rankQuery = "SET @rno = 0; UPDATE `orders_placed` SET `rank_in_q` = (@rno:=@rno+1) WHERE `food` = ".$food." AND `date_deliver` >= '$startStr' AND `date_deliver` <= '$endStr'  ORDER BY `qval` DESC";	
					mysqli_multi_query($cxn, $rankQuery) or die (mysqli_error($cxn).'<br />'.$rankQuery);
					while(mysqli_next_result($cxn)){;}

				}
			}
		}
		echo($startStr);
	}
	mysqli_close($cxn);
	exit("1");
?>