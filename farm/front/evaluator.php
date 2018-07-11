<?php
	session_start();
	if (empty($_SESSION['user_id']) or empty($_SESSION['accType'])){
		header("Location: index.php");
		session_destroy();
		exit();
	}
	elseif ($_SESSION['accType'] != 'evaluator') {
		header("Location: index.php");
		session_destroy();
		exit();
	}
	else{
		$usr = $_SESSION['user_id'];
		
		$host = "localhost";
		$username = "root";
		$dbname = "farm_db";

		$cxn = mysqli_connect($host, $username, "", $dbname);

		$query = "SELECT `first_name`,`last_name` FROM `evaluator_tbl` WHERE `user_id` = '".$usr."'";

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

		<link rel="stylesheet" type="text/css" href="style/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel = "stylesheet" type = "text/css" href="style/general/evaluator.css">
		
		<script src = "jslibs/jquery.js"></script>
		<script src="js/logout.js"></script>
		<script src="js/evaluator.js"></script>

	</head>

	<body>
		<div id = "header">
			<button id = "logout">Logout</button>
		</div>
		<div id = "rateImages">
			<div class = "imgBox">
				<div class = "imgSpace" id = "order1">
					<!-- note: image comes from the css, for now, on changing this, ensure that the inserted image 
					doesn't get distorted -->
				</div>
				&nbsp;Order Number: <span class = "ono">1</span><br /> <!-- use sibling selectors to get to this -->
				&nbsp;Image Rating: <input type = "number" max = "100"></input> <!-- use sibling selectors to get to this -->
			</div>
			<div class = "imgBox">
				<div class = "imgSpace" id = "order2"></div>
				&nbsp;Order Number: <span class = "ono">2</span><br />
				&nbsp;Image Rating: <input type = "number" max = "100"></input>
			</div>
			<div class = "imgBox">
				<div class = "imgSpace" id = "order3"></div>
				&nbsp;Order Number: <span class = "ono">3</span><br />
				&nbsp;Image Rating: <input type = "number" max = "100"></input>
			</div>
			<div class = "imgBox">
				<div class = "imgSpace" id = "order128"></div>
				&nbsp;Order Number: <span class = "ono">128</span><br />
				&nbsp;Image Rating: <input type = "number" max = "100"></input>
			</div>
		</div>
		<div id = "rateGoods">
			Enter Farmer Id:<input type="number" name="farmerId">
			<button name = "submitId"> Submit </button>
			<div id = "farmerDetails" style = "display:none;">
				<hr/>
				Farmer Name:<span id="farmerName"> </span><br/>
				Trust Matrix: <br/>
				<table id = "tm">
					<tr name="0"></tr>
					<tr name="1"></tr>
					<tr name="2"></tr>
					<tr name="3"></tr>
				</table>
			</div>
			<div id = "order_table_container" style = "display:none;">
				<hr/>
				<table name="order_table">
					<tr>
						<th>Orderid </th>
						<th>Food Item </th>
						<th>Date of delivery</th>
						<th>A</th>
						<th>B</th>
						<th>C</th>
					</tr>
				</table>
				Order ID : <input type="number" name="order">
			</div>
			<div id = "newtm_container" style = "display:none;">
				<hr/>
				<table id = "newtm">
					<tr>
						<td>A->A: <input type="number" name="aa" max = "100"> %</td>
						<td>B->A: <input type="number" name="ba" max = "100"> %</td>
						<td>C->A: <input type="number" name="ca" max = "100"> %</td>
					</tr>
					<tr>
						<td>A->B: <input type="number" name="ab" max = "100"> %</td>
						<td>B->B: <input type="number" name="bb" max = "100"> %</td>
						<td>C->B: <input type="number" name="cb" max = "100"> %</td>
					</tr>
					<tr>
						<td>A->C: <input type="number" name="ac" max = "100"> %</td>
						<td>B->C: <input type="number" name="bc" max = "100"> %</td>
						<td>C->C: <input type="number" name="cc" max = "100"> %</td>
					</tr>
					<tr>
						<td>A->R: <input type="number" name="ar" max = "100"> %</td>
						<td>B->R: <input type="number" name="br" max = "100"> %</td>
						<td>C->R: <input type="number" name="cr" max = "100"> %</td>
					</tr>
				</table>
				<button name="updateMatrix">Update</button>
			</div>
		</div>
	</body>
	
</html>