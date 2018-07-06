<?php
	exit();
	$data = array();
	for ($i = 0; $i < 25000; $i++) {
		$salt1 = bin2hex(openssl_random_pseudo_bytes(32,$cstrong));
		$salt2 = bin2hex(openssl_random_pseudo_bytes(32,$cstrong));
		$psd = bin2hex(openssl_random_pseudo_bytes(4,$cstrong));
		
		$h1 = hash("sha256", ($salt1.$psd));
		$h2 = hash("sha256", ($h1.$salt2));
		
		$array = array($salt1, $salt2, $h2, $psd);
		
		array_push($data,$array);
	}
	
	$fp = fopen('file.csv', 'w');

	foreach ($data as $fields) {
		fputcsv($fp, $fields);
	}

?>