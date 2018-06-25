<?php
	$category = $_POST['category'];
	$a = $_POST['a'];
	$b = $_POST['b'];
	$c = $_POST['c'];
	$cost = $_POST['cost'];
	$harvest = htmlentities($_POST['harvest']);
	$harvest = date('Y-m-d', strtotime($harvest));
	$deliv = htmlentities($_POST['deliver']);
	$deliv = date('Y-m-d', strtotime($deliv));
	$food= $_POST['food'];
	
	
	$fileName = $_FILES["file"]["name"];
	$fileType = $_FILES["file"]["type"];
	$fileTemp = $_FILES["file"]["tmp_name"];
	$fileStore= "images/".$fileName;
	move_uploaded_file($fileTemp , $fileStore);
	
	
	if(!$a) $a = "";
	if(!$b) $b = "";
	if(!$c) $c = "";
	
	 $conn= mysqli_connect("localhost","root","computer","farm_db");
	
	$query11="INSERT INTO orders_placed (food, category,Cost,A,B,C,date_harvest,date_deliver,image_path)";
	$query12="VALUES ('".$food."', '".$category."', ".$cost.", ".$a.", ".$b.", ".$c.", '".$harvest."', '".$deliv."', 'sk127')";
	$query1=$query11." ".$query12;
	
	//$connection= mysqli_connect("localhost","root","computer","challenges");
	// $query21="INSERT INTO orders ( custid,foodid,cost,number,time,Delivered,payment) ";
	// $query22="VALUES (1,1,1,1, 1, 0,0)";
	// $query2=$query21." ".$query22;
	
	if(mysqli_query($conn,$query1))
		$res= "yeah babe";
	else $res =mysqli_error($conn);
	// $res= $query12;
	
	exit(JSON_encode($res."   ".$harvest));
?>


