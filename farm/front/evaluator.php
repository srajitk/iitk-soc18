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
	// echo "Hello";
	// session_destroy();
?>

<!DOCTYPE html>
<head>
	
	<script src = "jslibs/jquery.js"></script>
	<script src="js/logout.js"></script>
	<script src="js/evaluator.js"></script>

</head>

<body>
	<button id = "logout">Logout</button>
	<hr/>
	Enter Farmer Id:<input type="number" name="farmerId">
	<button name = "submitId"> Submit </button>
	<hr/>
	<div>
		Name:<span id="farmerName"> </span><br/>
		Trust Matrix <br/>
		<table>
			<tr name="0"></tr>
			<tr name="1"></tr>
			<tr name="2"></tr>
			<tr name="3"></tr>
		</table>
	</div>
	<hr/>
	<div>
		<table name="order_table">
			<tr >
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
	<hr/>
	<div>
		<table>
			<tr>
				<td>A->A: <input type="number" name="aa"></td>
				<td>B->A: <input type="number" name="ba"></td>
				<td>C->A: <input type="number" name="ca"></td>
			</tr>
			<tr>
				<td>A->B: <input type="number" name="ab"></td>
				<td>B->B: <input type="number" name="bb"></td>
				<td>C->B: <input type="number" name="cb"></td>
			</tr>
			<tr>
				<td>A->C: <input type="number" name="ac"></td>
				<td>B->C: <input type="number" name="bc"></td>
				<td>C->C: <input type="number" name="cc"></td>
			</tr>
			<tr>
				<td>A->R: <input type="number" name="ar"></td>
				<td>B->R: <input type="number" name="br"></td>
				<td>C->R: <input type="number" name="cr"></td>
			</tr>
		</table>
		<button name="updateMatrix">Update</button>
	</div>
</body>
	
</html>