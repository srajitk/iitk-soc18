<?php
	$category = $_POST['category'];
	$a = $_POST['a'];
	$b = $_POST['b'];
	$c = $_POST['c'];
	$cost = $_POST['cost'];
	$harvest = $_POST['harvest'];
	$deliv = $_POST['deliver'];
	$food= $_POST['food'];
	
	if(!$a) $a = 0;
	if(!$b) $b = 0;
	if(!$c) $c = 0;
	
	$conn= mysqli_connect("localhost","root","","farm_db");
	
	$query11="INSERT INTO orders_placed (`food`, `category`,`Cost`,`A`,`B`,`C`,`date_harvest`,`date_deliver`,`image_path`) VALUES ('".$food."', '".$category."', '".$cost."', '".$a."', '".$b."', '".$c."', '".$harvest."', '".$deliv."', 'sk007')";
	
	$res = $_POST;
	$res['query'] = $query11;
	if(mysqli_query($conn,$query11))
		$res['out'] = "yeah babe";
	else $res['out'] = mysqli_error($conn);
	
	exit(JSON_encode($res));
?>