<?php 
	$farmerId = $_POST['farmId'];
	//exit(JSON_encode($farmerId));
	$cxn = mysqli_connect("localhost","root","computer","farm_db");
	
	$query11 = "SELECT first_name,last_name,tm00,tm01,tm02,tm10,tm11,tm12,tm20,tm21,tm22,tm30,tm31,tm32 FROM farmer_tbl WHERE user_id=".$farmerId; 
	// exit(JSON_encode($query11));
	$result1 = mysqli_query($cxn , $query11) or die("Query not working");
	$return['farmer'] = mysqli_fetch_all($result1);
	
	$query21 = "SELECT orderid,food,date_deliver,A,B,C FROM orders_placed WHERE farmer_id =".$farmerId;
	$result2 = mysqli_query($cxn, $query21);
	$return['orders'] = mysqli_fetch_all($result2);
	mysqli_close($cxn);
	exit(JSON_encode($return));
	
	
?>