<?php
	$food = $_POST['khana'];
	$category = $_POST['type'];
	$cost = $_POST['price'];
	$a = $_POST['a'];
	$b = $_POST['b'];
	$c = $_POST['c'];
	$transport = $_POST['logistics'];
	$harvest = $_POST['doharvest'];
	$deliver = $_POST['dodeliver'];
	$name = $_POST['fileName'];
	$extension = strtolower(pathinfo($name,PATHINFO_EXTENSION));
	
	$connection =mysqli_connect("localhost","root","","farm_db");
	
	
	if($extension != "jpg" && $extension != "png" && $extension != "jpeg"&& $extension != "gif" ) {
		exit(JSON_encode("FIle type not image"));
	}
	
	$query11="INSERT INTO orders_placed (food, category,Cost,transport,A,B,C,date_harvest,date_deliver)";
	$query12="VALUES ('".$food."', '".$category."', ".$cost.", ".$transport.", ".$a.", ".$b.", ".$c.", '".$harvest."', '".$deliver."')";
	$query1=$query11." ".$query12;
	if(mysqli_query($connection,$query1)){
		$lastId=mysqli_insert_id($connection);
		$image_name=$food."_".$lastId;
		
	}
	else exit(JSON_encode("bad"));
	
	$query21="UPDATE orders_placed SET image_path='".$image_name."' WHERE orderid =".$lastId;
	
	if(mysqli_query($connection,$query21)){exit(JSON_encode("good"));}
	
	else {exit(JSON_encode("bad"));}
	mysqli_close($connection);
?>