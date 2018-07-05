<?php
	session_start();
	if (empty($_SESSION['user_id']) or empty($_SESSION['accType'])){
		header("Location: index.php");
		session_destroy();
		exit();
	}
	else{
		$fvid = $_POST['khana'];
		$cost = $_POST['price'];
		$qty = $_POST['qty'];
		$a = $_POST['a'];
		$b = $_POST['b'];
		$c = $_POST['c'];

		/* SERIOUS WORK PENDING: MULTIPLY THE VECTOR ABC WITH THE TRUST MATRIX */

		$a = $a * $qty;
		$b = $b * $qty;
		$c = $c * $qty;

		$transport = $_POST['logistics'];
		$harvest = $_POST['th'];
		$deliver = $_POST['tc'];
		$name = $_POST['fileName'];

		$extension = strtolower(pathinfo($name,PATHINFO_EXTENSION));

		$connection =mysqli_connect("localhost","root","computer","farm_db");


		if ($extension != "jpg" && $extension != "png" && $extension != "jpeg" && $extension != "gif" ) {
			exit(JSON_encode("File type not image"));
		}

		$query="INSERT INTO `orders_placed` (`farmer_id`, `food`, `Cost`, `transport`, `A`,`B`,`C`,`date_harvest`,`date_deliver`) VALUES ('".$_SESSION['user_id']."' ,'".$fvid."', ".$cost.", ".$transport.", ".$a.", ".$b.", ".$c.", '".$harvest."', '".$deliver."')";

		mysqli_query($connection, $query) or die ("bad");

		$lastId = mysqli_insert_id($connection);
		$image_name = $fvid."_".$_SESSION['user_id']."_".$lastId;

		$query21="UPDATE `orders_placed` SET `image_path` = '".$image_name."' WHERE `orderid` =".$lastId;

		if(mysqli_query($connection,$query21)){
			mysqli_close($connection);
			exit("good");
		}
		else {
			mysqli_close($connection);
			exit(JSON_encode("bad"));
		}
	}
?>