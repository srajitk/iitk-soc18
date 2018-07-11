<?php 
	
	$x[0] = $_POST['aa'];
	$x[1] = $_POST['ba'];
	$x[2] = $_POST['ca'];
	$x[3] = $_POST['ab'];
	$x[4] = $_POST['bb'];
	$x[5] = $_POST['cb'];
	$x[6] = $_POST['ac'];
	$x[7] = $_POST['bc'];
	$x[8] = $_POST['cc'];
	$x[9] = $_POST['ar'];
	$x[10] = $_POST['br'];
	$x[11] = $_POST['cr'];	

	/* SECURITY REQUIRED HERE */
		
	for ($i = 0; $i < 12; $i++){
		$x[i] /= 100;
	}
		
	$cxn = mysqli_connect("localhost","root","","farm_db");
	
	$query11 = "SELECT tm00,tm01,tm02,tm10,tm11,tm12,tm20,tm21,tm22,tm30,tm31,tm32,sellcontracts FROM farmer_tbl WHERE user_id=".$_POST['farmid'];

	$result1 = mysqli_query($cxn,$query11);
	$row = mysqli_fetch_all($result1);
	
	
	
	for($i=0;$i<12;$i++){
		$p = $i/3;
		$y = $i%3;
		$a = (($row[0][12]+1.0)*$row[0][$i]+$x[$i])/($row[0][12]+2.0);
		$query = "UPDATE farmer_tbl SET tm".(int)$p.(int)$y."=$a WHERE user_id=".$_POST['farmid'];
		mysqli_query($cxn,$query);
	}
	
	$query2 = "UPDATE farmer_tbl SET sellcontracts=".($row[0][12]+1)." WHERE user_id=".$_POST['farmid'];
	mysqli_query($cxn,$query2);
	
	
	
	exit($row[0][1]);
?>