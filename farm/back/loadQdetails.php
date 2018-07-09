<?php
	session_start();
	if (empty($_SESSION['user_id']) or empty($_SESSION['accType'])){
		header("Location: index.php");
		session_destroy();
		exit();
	} elseif ($_SESSION['accType']!="farmer"){
		session_destroy();
		exit();
	}
	else {
		$cxn = mysqli_connect("localhost","root","","farm_db");
		
		$query11 = "SELECT * FROM orders_placed WHERE farmer_id =". $_SESSION['user_id'];
		
		$result1 = mysqli_query($cxn , $query11);
		$return['det'] = mysqli_fetch_all($result1) or die($query11);
		
		exit(JSON_encode($return));
		
	}
?>