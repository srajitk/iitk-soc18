<?php
	$tabname = $_POST['tabname'];
	
	$host = "localhost";
	$username = "root";
	$dbname = "farm_db";

	$cxn = mysqli_connect($host, $username, "", $dbname);
	
	$query = "SELECT `file_name`, `name_line1`, `name_line2`, `size` FROM `img_details_tbl` WHERE `tab_name` = '".$tabname."'";
	
	$result = mysqli_query($cxn, $query) or die($query);
	
	$html = "";
	while ($row = mysqli_fetch_assoc($result)) {
		$html .= '<div class = "imgbox"> <img src = "http://localhost/farm/back/fvicons/fv/'.$row['file_name'].'" style = "width: 54px; height: 54px"></img> </div>';
	}
	
	mysqli_close($cxn);
	
	exit($html);
?>