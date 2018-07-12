<?php
	session_start();
	if (empty($_SESSION['user_id']) or empty($_SESSION['accType'])){
		session_destroy();
		exit();
	}
	else{
		
		session_start();

		if($_SESSION['accType']==null && $_SESSION['user_id']==null){
			exit(JSON_encode("Session variables not set"));
		}
		$filename=$_FILES["file"]["name"];
		$tmp=(explode(".", $filename));
		$extension=end($tmp);
		$newfilename=$_SESSION['accType']."_".$_SESSION['user_id'] .".".$extension;

		if($extension!="jpg" && $extension!="jpeg" && $extension!="gif" && $extension!="png" ){
			exit(JSON_encode("File type  is ".$extension));
		}

			 
		// else {
			move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/' . $newfilename);
			exit(JSON_encode($newfilename));
			exit(JSON_encode("KAAM KHATAM"));
		// }
	}
?>