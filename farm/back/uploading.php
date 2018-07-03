<?php
	
	$connection = mysqli_connect("localhost","root","","farm_db");
	$query1= "SELECT `image_path` FROM `orders_placed` WHERE `orderid`= (SELECT max(`orderid`) FROM `orders_placed`)";
		//	ERROR PRONE, PLEASE CHANGE MAX... TO DATA TAKEN FROM JS FILE, WHAT IF THE LAST ENTRY WERE DELETED OR CASES LIKE THIS
		// OR TWO OR MORE REQUESTS CAME SIMULTANEOULSY ENOUGH FOR PHP NOT TO BE ABLE TO DISTNIGUISH BTW THEM
		
	$result = mysqli_query($connection,$query1);
	
	while($row = mysqli_fetch_assoc($result)){
		$x = $row['image_path'];
	}
	$filename = $_FILES["file"]["name"];
	$tmp = (explode(".", $filename));
	$extension = end($tmp);
	
	$newfilename=$x .".".$extension;
		if ( 0 < $_FILES['file']['error'] ) {
		exit(JSON_encode($extension));
    }
    else {
        move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $newfilename);
		exit(JSON_encode($newfilename));
		exit(JSON_encode("KAAM KHATAM"));
	}
	
?>