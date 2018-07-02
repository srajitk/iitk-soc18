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
		
		$cxn = mysqli_connect($host, $username, "", $dbname);
		
		$query = "SELECT `first_name`,`last_name`, `value` FROM `farmer_tbl` WHERE `user_id` = '".$usr."'";
		
		$result = mysqli_query($cxn, $query) or die($query);
		
		$row = mysqli_fetch_assoc($result);
		
		$fname = $row['first_name'];
		$lname = $row['last_name'];
		$val = $row['value'];
		
		mysqli_close($cxn);
	}
	
?>
<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width = device-width, initial-scale = 1.0">
		
		<!--============================================== styles loaded from table template ==============-->	
			<link rel="icon" type="image/png" href="style/login/images/icons/favicon.ico"/>
			<link rel="stylesheet" type="text/css" href="jslibs/bootstrap/css/bootstrap.min.css">
			<link rel="stylesheet" type="text/css" href="style/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
			<link rel="stylesheet" type="text/css" href="jslibs/animate/animate.css">
			<link rel="stylesheet" type="text/css" href="jslibs/select2/select2.min.css">
			<link rel="stylesheet" type="text/css" href="jslibs/perfect-scrollbar/perfect-scrollbar.css">
			<link rel="stylesheet" type="text/css" href="style/Table_Fixed_Header/css/util.css">
			<link rel="stylesheet" type="text/css" href="style/Table_Fixed_Header/css/main.css">
		<!--===============================================================================================-->
				
		<link rel = "stylesheet" type = "text/css" href="style/general/farmer.css">
		<link rel = "stylesheet" type = "text/css" href="style/sideIcons/sidebar.css">
		
		<script src = "jslibs/jquery.js"></script>
		<script src = "js/logout.js"></script>
		
		<script>
			$(Document).ready(function () {
				$(".icon-bar button").on('click', function () {					
					$(this).siblings().removeClass('active');
					$(this).toggleClass('active');
					var txt = "." + ($(".icon-bar button.active").attr('name'));
					
					// may want to use callbacks
					if ($(".limiter:visible").length > 0){
						$(".limiter:visible").fadeOut(function () {						
							$(txt).fadeIn();
						});
					} else {
						$(txt).fadeIn();
					}
				});
			});
		</script>
        <title> Project 1 | <?php echo $fname?></title>

    </head>
    <body>
		

		<div class="icon-bar">
			<button name = "home"><i class="fa fa-home"></i></button> 
			<button name = "place"><i class="fa fa-plus-circle"></i></button>
			<button name = "queue"><i class="fa fa-list"></i></button> 
			<button name = "contactUs"><i class="fa fa-paper-plane"></i></button> 
		</div>
		<div class = "limiter home" style = "display:none;">
			<div class = "profile">				
				Name: <?php echo $fname.' '.$lname?><br />
				Value: <?php echo $val; ?><br /> <br /> 
				<button id = "logout">Logout</button>
			</div>
		</div>
		<div class = "limiter place" style = "display:none;">
			<div style = "width: 90%; height: 90%; margin: 20px; background: white;">
					<form  method="post" action="upload.php" enctype="multipart/form-data">
						<input type="radio" name="xxx" value="fruits" checked> Fruits
						<input type="radio" name="xxx" value="vegetables"> Vegetables<br/>
						<select name="frfood" class="fruits"style="display:block">
							<option value="kela">Kela</option>
							<option value="tamatar">Tamatar</option>
							<option value="nimbu">Lemon</option>
						</select>
						<select name="vefood" class="vegetables" style="display:none">
							<option>Aloo</option>
							<option>Pyaaz</option>
							<option>Lauki</option>
						</select>
						<h6>Quality(in Kg)</h6>
						A: <input type="number" name='a'>
						B: <input type="number" name='b'>
						C: <input type="number" name='c'>
						Total Cost (in Rs)<input type="number" name="cost" required>
						Transport Required?<input type="checkbox" name="transport">
						Date of harvest<input type="date" name="harvest" required>
						Date of delivery<input type="date" name="deliver" required>
						Select image to upload:<input type="file" name="fileToUpload" id="fileToUpload">
						<input type="submit" value="Place Order" name="submit">
					</form>
			</div>
		</div>
		<div class="limiter queue" style = "display:none;">
			<div class="container-table100">
				<div class="wrap-table100">
					<div class="table100 ver5">
						<div class="table100-head">
							<table>
								<thead>
									<tr class="row100 head">
										<th class="cell100 column1">Name</th>
										<th class="cell100 column2">Quantity</th>
										<th class="cell100 column3">A</th>
										<th class="cell100 column4">B</th>
										<th class="cell100 column5">C</th>
										<th class="cell100 column6">Price/kg</th>
									</tr>
								</thead>
							</table>
						</div>

						<div class="table100-body js-pscroll">
							<table>
								<tbody>
									<tr class="row100 body">
										<td class="cell100 column1">Alpha </td>
										<td class="cell100 column2">100 kg</td>
										<td class="cell100 column3">80</td>
										<td class="cell100 column4">10</td>
										<td class="cell100 column5">10</td>
										<td class="cell100 column6">180</td>
									</tr>

									<tr class="row100 body">
										<td class="cell100 column1">Phi</td>
										<td class="cell100 column2">10000 kg</td>
										<td class="cell100 column3">70</td>
										<td class="cell100 column4">30</td>
										<td class="cell100 column5">0</td>
										<td class="cell100 column6">150</td>
									</tr>

									<tr class="row100 body">
										<td class="cell100 column1">Aditya Shivaji Yemulwad</td>
										<td class="cell100 column2">10 kg</td>
										<td class="cell100 column3">40</td>
										<td class="cell100 column4">45</td>
										<td class="cell100 column5">15</td>
										<td class="cell100 column6">75</td>
									</tr>

									<tr class="row100 body">
										<td class="cell100 column1">Patel Preet Rajesh Kumar</td>
										<td class="cell100 column2">10000 kg</td>
										<td class="cell100 column3">0</td>
										<td class="cell100 column4">85</td>
										<td class="cell100 column5">15</td>
										<td class="cell100 column6">140</td>
									</tr>
									
									<tr class="row100 body">
										<td class="cell100 column1">Gamma</td>
										<td class="cell100 column2">100 kg</td>
										<td class="cell100 column3">0</td>
										<td class="cell100 column4">85</td>
										<td class="cell100 column5">15</td>
										<td class="cell100 column6">140</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	<div class="limiter contactUs" style = "display:none;">	
		<div class="wthree-dot">
			<h1>Contact our team</h1>
			<div class="profile2">
				<div class="wrap">
					<!-- contact -->
					<div class="contact">
						<div class="contact-row agileits-w3layouts">  
							<div class="contact-w3lsleft">
								<div class="contact-grid agileits">
									<h4>DROP US A LINE </h4>
									<form action="#" method="post"> 
										<input type="text" name="Name" placeholder="Name" required="">
										<input type="email" name="Email" placeholder="Email" required=""> 
										<input type="text" name="Phone Number" placeholder="Phone Number" required="">
										<textarea name="Message" placeholder="Message..." required=""></textarea>
										<input type="submit" value="Submit" >
									</form> 
								</div>
							</div>
							<div class="contact-w3lsright">
								<div class="agileits-contact-right">
									<h2>Our Contacts</h2>
									<div class="address-row">
										<div class="address-left">
											<i class="fa fa-home" aria-hidden="true"></i>
										</div>
										<div class="address-right">
											<h5>Visit Us</h5>
											<p>Office address</p>
										</div>
										<div class="clear"> </div>
									</div>
									<div class="address-row w3-agileits">
										<div class="address-left">
											<i class="fa fa-envelope" aria-hidden="true"></i>
										</div>
										<div class="address-right">
											<h5>Mail Us</h5>
											<p><a href="mailto:info@example.com"> abc@xyz.com</a></p>
										</div>
										<div class="clear"> </div>
									</div>
									<div class="address-row">
										<div class="address-left">
											<i class="fa fa-volume-control-phone" aria-hidden="true"></i>
										</div>
										<div class="address-right">
											<h5>Call Us</h5>
											<p>1234567890</p>
										</div>
										<div class="clear"> </div>
									</div> 
								</div>
							</div>
							<div class="clear"> </div>
						</div>	
					</div> 
					
				</div>
			</div>
		</div>
	</div>

	<!--===================================================scripts loaded from table template =========-->	
		<script src="jslibs/jquery/jquery-3.2.1.min.js"></script>
		<script src="jslibs/bootstrap/js/popper.js"></script>
		<script src="jslibs/bootstrap/js/bootstrap.min.js"></script>
		<script src="jslibs/select2/select2.min.js"></script>
		<script src="jslibs/perfect-scrollbar/perfect-scrollbar.min.js"></script>
		<script>
			$('.js-pscroll').each(function(){
				var ps = new PerfectScrollbar(this);

				$(window).on('resize', function(){
					ps.update();
				})
			});
				
			
		</script>
	<!--===============================================================================================-->
		<script src="style/Table_Fixed_Header/js/main.js"></script>
    </body>
</html>
