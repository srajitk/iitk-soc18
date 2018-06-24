<?php
	$category = $_POST['category'];
	$a = $_POST['a'];
	$b = $_POST['b'];
	$c = $_POST['c'];
	$cost = $_POST['cost'];
	$harvest = $_POST['harvest'];
	$deliv = $_POST['deliver'];
	$food= $_POST['food'];
	
	if(!$a) $a = "";
	if(!$b) $b = "";
	if(!$c) $c = "";
	
	$conn= mysqli_connect("localhost","root","computer","farm_db");
	
	$query11="INSERT INTO orders_placed (food, category,Cost,A,B,C,date_harvest,date_deliver,image_path)";
	$query12="VALUES (".$food.", ".$category.", ".$cost.", ".$a.", ".$b.", ".$c.", ".$harvest.", ".$deliv.", sk007)";
	$query1=$query11." ".$query12;
	
	
	if(mysqli_query($conn,$query1))
		$res= "yeah babe";
	else $res =mysqli_error($conn);
	// $res= $query12;
	
	exit(JSON_encode($res));
?>