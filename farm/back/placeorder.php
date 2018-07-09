<?php
	session_start();
	if (empty($_SESSION['user_id']) or empty($_SESSION['accType'])){
		header("Location: index.php");
		session_destroy();
		exit();
	} 
	elseif ($_SESSION['accType']!="farmer"){
		session_destroy();
		exit();
	}
	else{
		$connection = mysqli_connect("localhost","root","","farm_db");

		$return = $_POST;
		
		$fvid = mysqli_real_escape_string($connection, $_POST['khana']);
		$cost =  mysqli_real_escape_string($connection, $_POST['price']);
		$qty = mysqli_real_escape_string($connection, $_POST['qty']);
		$a = mysqli_real_escape_string($connection, $_POST['a']);				// upto here, a,b,c just represent the ratios
		$b = mysqli_real_escape_string($connection, $_POST['b']);
		$c = mysqli_real_escape_string($connection, $_POST['c']);
		
		$tmquery = "SELECT `tm00`,`tm01`,`tm02`,`tm10`,`tm11`,`tm12`,`tm20`,`tm21`,`tm22`,`tm30`,`tm31`,`tm32` FROM `farmer_tbl` WHERE `user_id`=" .$_SESSION['user_id'];
		
		$tmresult = mysqli_query($connection, $tmquery) or die (mysqli_error($connection));
		
		if ($tmrow = mysqli_fetch_assoc($tmresult)){
		
			$trustMatrix = array (
				array($tmrow['tm00'],$tmrow['tm01'],$tmrow['tm02']),
				array($tmrow['tm10'],$tmrow['tm11'],$tmrow['tm12']),
				array($tmrow['tm20'],$tmrow['tm21'],$tmrow['tm22']),
				array($tmrow['tm30'],$tmrow['tm31'],$tmrow['tm32']),
			);
			
			$return['trustMatrix'] = $trustMatrix;
			
			$fqlty = array($a, $b, $c);
			$nqlty = array();
			
			for ($i = 0; $i < 4; $i++){
				$x = 0;
				for ($j = 0; $j < 3; $j++){
					$x += $trustMatrix[$i][$j] * $fqlty[$j];
				}
				$nqlty[] = $x;
			}
			
			$a = $nqlty[0];
			$b = $nqlty[1];
			$c = $nqlty[2];
			$r = $nqlty[3];
			$return['a'] = $a;
			$return['b'] = $b;
			$return['c'] = $c;
			$return['r'] = $r;
			
		} else {
			$return['status'] = "ugly";
			$return['err_msg'] = "couldn't recieve farmer parameters";
			exit(json_encode($return));
		}
		
		$transport = mysqli_real_escape_string($connection, $_POST['logistics']);
		$harvest = mysqli_real_escape_string($connection, $_POST['th']);
		$deliver = mysqli_real_escape_string($connection, $_POST['tc']);
		$name = mysqli_real_escape_string($connection, $_POST['fileName']);

		$regexId = '/^\d{0,3}$/';
		$regexCost = '/^\d{3,8}$/';
		$regexABC = '/^\d{0,6}$/';
		$regexTrans = '/^[01]$/';
		$regexDateTime = "/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1]) ([0-1][0-9]|2[0-3]):[0-5][0-9]:[0-5][0-9]$/";
		
		if (preg_match($regexId, $fvid) && preg_match($regexCost, $cost) && preg_match($regexABC, $a) && preg_match($regexABC, $b) && preg_match($regexABC, $c) && preg_match($regexABC, $r) && preg_match($regexTrans, $transport) && preg_match($regexDateTime, $harvest) && preg_match($regexDateTime, $deliver)){
			
			if (date("Y-m-d H:i:s", strtotime($harvest))== $harvest && date("Y-m-d H:i:s", strtotime($deliver))== $deliver){
				
				$extension = strtolower(pathinfo($name,PATHINFO_EXTENSION));

				if ($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif" ) {
					$return['status'] = "bad";
					$return['err_msg'] = "File type not image";
					exit(JSON_encode($return));
				}

				// prevent against accidental re-orders
				$chkquery = "SELECT DISTINCT(1) AS `exist` FROM `orders_placed` WHERE EXISTS (SELECT * FROM `orders_placed` WHERE `farmer_id` = ".$_SESSION['user_id']." AND `food` = $fvid AND `date_deliver` = '$deliver')"; 
				
				if (!($chkresult = mysqli_query($connection, $chkquery))) {
					$return['status'] = "ugly";
					$return['err_msg'] = "couldn't execute duplicate check";
					exit(json_encode($return));
				}
				
				if ($row = mysqli_fetch_assoc($chkresult)){
					$return['status'] = "bad";
					$return['err_msg'] = "similar order already placed";
					exit(JSON_encode($return));
				}
				
				$query="INSERT INTO `orders_placed` (`farmer_id`, `food`, `Cost`, `transport`, `A`,`B`,`C`,`R`, `date_harvest`,`date_deliver`) VALUES ('".$_SESSION['user_id']."' ,'".$fvid."', ".$cost.", ".$transport.", ".$a.", ".$b.", ".$c.",".$r.", '".$harvest."', '".$deliver."')";

				if (!($result = mysqli_query($connection, $query))) {
					$return['status'] = "ugly";
					$return['err_msg'] = "couldn't insert";
					exit(JSON_encode($return));
				}

				$lastId = mysqli_insert_id($connection);
				$image_name = $fvid."_".$_SESSION['user_id']."_".$lastId;

				$query21="UPDATE `orders_placed` SET `image_path` = '".$image_name."' WHERE `orderid` =".$lastId;

				if(mysqli_query($connection,$query21)){
					mysqli_close($connection);
					$return['status'] = "good";
					exit(json_encode($return));
				}
				else {
					mysqli_close($connection);
					$return['status'] = "ugly";
					$return['err_msg'] = "couldn't accomodate image";
					exit(JSON_encode($return));
				}
			} else {
				$return['status'] = "bad";
				$return['err_msg'] = "improper dates";
				exit(json_encode($return));
			}
			
		} else {
			$return['status'] = "bad";
			$return['err_msg'] = "inputs not in the right format";
			exit(json_encode($return));
		}
	}
?>
