<?php
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
		$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
		if($check !== false) {
			echo "File is an image - " . $check["mime"] . ".";
			$uploadOk = 1;
		} else {
			echo "File is not an image.";
			$uploadOk = 0;
		}
	}
	// Check if file already exists
	if (file_exists($target_file)) {
		echo "Sorry, file already exists.";
		$uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 500000) {
		echo "Sorry, your file is too large.";
		$uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
		echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
		$uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
	} else {
		if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
			echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
		} else {
			echo "Sorry, there was an error uploading your file.";
		}
	}

	$category = $_POST['xxx'];
	if($category=="fruits"){
		$food = $_POST['frfood'];
	}
	elseif ($category=="vegetables"){
		$food = $_POST['vefood'];
	}
		
	$a = $_POST['a'];
	$b = $_POST['b'];
	$c = $_POST['c'];
	$cost = $_POST['cost'];
	$harvest = htmlentities($_POST['harvest']);
	$harvest = date('Y-m-d', strtotime($harvest));
	$deliv = htmlentities($_POST['deliver']);
	$deliv = date('Y-m-d', strtotime($deliv));
	
	
	if(!$a) $a = "";
	if(!$b) $b = "";
	if(!$c) $c = "";
	
	$conn= mysqli_connect("localhost","root","","farm_db");
	
	$query11="INSERT INTO orders_placed (food, category,Cost,A,B,C,date_harvest,date_deliver,image_path)";
	$query12="VALUES ('".$food."', '".$category."', ".$cost.", ".$a.", ".$b.", ".$c.", '".$harvest."', '".$deliv."', '".$_FILES["fileToUpload"]["name"]."' )";
	$query1=$query11." ".$query12;
	
	
	if(mysqli_query($conn,$query1)){
		header("test.php"); /* Redirect browser */
		exit();
	}
		
	else $res =mysqli_error($conn);
	echo $res;
?>
