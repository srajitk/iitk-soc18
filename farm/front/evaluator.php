<?php
	session_start();
	if (empty($_SESSION['user_id']) or empty($_SESSION['accType'])){
		header("Location: index.php");
		session_destroy();
		exit();
	}
	else{
		$usr = $_SESSION['user_id'];
		
		$host = "localhost";
		$username = "root";
		$dbname = "farm_db";

		$cxn = mysqli_connect($host, $username, "computer", $dbname);

		$query = "SELECT `first_name`,`last_name` FROM `evaluator_tbl` WHERE `user_id` = '".$usr."'";

		$result = mysqli_query($cxn, $query) or die($query);

		$row = mysqli_fetch_assoc($result);

		$fname = $row['first_name'];
		$lname = $row['last_name'];
		
		mysqli_close($cxn);
	}

?>

<!DOCTYPE html>
<head></head>

<body>
<hr/>

</body>
