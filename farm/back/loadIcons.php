<?php
	$tabname = $_POST['tabname'];
	
	$host = "localhost";
	$username = "root";
	$dbname = "farm_db";

	$cxn = mysqli_connect($host, $username, "", $dbname);
	
	$query = "SELECT `file_name`, `item_no` FROM `item_details_tbl` WHERE `tab_name` = '".$tabname."'";
	
	$result = mysqli_query($cxn, $query) or die($query);
	
	$html = "";
	while ($row = mysqli_fetch_assoc($result)) {
		$html .= '<div class = "imgbox" id = "fv'.$row['item_no'].'"> <img src = "http://localhost/farm/back/fvicons/fv/'.$row['file_name'].'" style = "width: 72px; height: 72px"></img> </div>';
	}
	
	mysqli_close($cxn);
	
	exit($html);
?>