<?php
	session_start();
	if (empty($_SESSION['user_id']) or empty($_SESSION['accType'])){
		header("Location: index.php");
		session_destroy();
		exit();
	}
	else{
		$usr = $_SESSION['user_id'];
		$acc = $_SESSION['accType'];
		
		if ($acc == "farmer"){
			$tbl = "farmer_tbl";
		}
		if ($acc == "buyer"){
			$tbl = "buyer_tbl";
		}
		$host = "localhost";
		$username = "root";
		$dbname = "farm_db";
		
		$cxn = mysqli_connect($host, $username, "", $dbname);
		
		$query = "SELECT `first_name`,`last_name` FROM `".$tbl."` WHERE `user_id` = '".$usr."'";
		
		$result = mysqli_query($cxn, $query) or die($query);
		
		$row = mysqli_fetch_assoc($result);
		
		$fname = $row['first_name'];
		$lname = $row['last_name'];
		
		mysqli_close($cxn);
	}
	
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width = device-width, initial-scale = 1.0">

        
		<!--link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"-->
		<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
		<link rel="stylesheet" type="text/css" href="css/user.css">
		
		<script src = "jslibs/jquery.js"></script>
		<script src = "js/logout.js"></script>
		
        <title> Project 1 | <?php echo $fname?></title>

    </head>
    <body>
		<h1> Messenger </h1>
        <div id = "greeting"><h2>Hello, <?php echo $fname?></h2></div>
		<button id = "logout">Logout</button>
    </body>
</html>