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
		
		$query = "SELECT `first_name`,`last_name` FROM `buyer_tbl` WHERE `user_id` = '".$usr."'";
		
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
				
		<link rel = "stylesheet" type = "text/css" href="style/sideIcons/sidebar.css">
		<link rel = "stylesheet" type = "text/css" href="style/general/buyer.css">
		
		<script src = "jslibs/jquery.js"></script>
		<script src = "js/logout.js"></script>
		<script src = "js/loadicons.js"></script>
		
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
			<button name = "cart"><i class="fa fa-shopping-cart"></i></button> 
			<button name = "place"><i class="fa fa-plus-circle"></i></button>
			<button name = "card"><i class="fa fa-credit-card"></i></button> 
			<button name = "undecided"><i class="fa fa-question-circle"></i></button> 
		</div>
		<div class = "limiter home" style = "display:none;">
			<div class = "profile">				
				Name: <?php echo $fname.' '.$lname?><br /><br />
				<button id = "logout">Logout</button>
			</div>
		</div>
		<div class="limiter cart" style = "display:none;">
			<div class = "orderPortal">
				<div class = "menu">
					<div class = "itemselector">
						<button class="tablinks" name = "fruitsSmall">Fruits Small</button>
						<button class="tablinks" name = "fruitsMedium">Fruits Medium</button>
						<button class="tablinks" name = "fruitsLarge">Fruits Large</button>
						<button class="tablinks" name = "potatoGourds">Potato & Gourds</button>
						<button class="tablinks" name = "greenVeg">Green Veg</button>
						<button class="tablinks" name = "generalVeg">General Veg</button>
						<button class="tablinks" name = "leafyVeg">Leafy Veg</button>
						<button class="tablinks" name = "saladChinese">Salad & Chinese</button>
						<button class="tablinks" name = "flavourVeg">Flavour Veg</button>
					</div>
					<div id="fruitsSmall" class="tabcontent" style = "display:none;">
						<div class = "tabheader"><h3>Fruits Small</h3></div>
						<div class = "imageSpace"></div>
					</div>

					<div id="fruitsMedium" class="tabcontent" style = "display:none;">
						<div class = "tabheader"><h3>Fruits Medium</h3></div>
						<div class = "imageSpace"></div>
					</div>

					<div id="fruitsLarge" class="tabcontent" style = "display:none;">
						<div class = "tabheader"><h3>Fruits Large</h3></div>
						<div class = "imageSpace"></div>
					</div>
					
					<div id="potatoGourds" class="tabcontent" style = "display:none;">
						<div class = "tabheader"><h3>Potato and Gourds</h3></div>
						<div class = "imageSpace"></div>
					</div>
					
					<div id="greenVeg" class="tabcontent" style = "display:none;">
						<div class = "tabheader"><h3>Green Veg</h3></div>
						<div class = "imageSpace"></div>
					</div>
					
					<div id="generalVeg" class="tabcontent" style = "display:none;">
						<div class = "tabheader"><h3>General Veg</h3></div>
						<div class = "imageSpace"></div>
					</div>
					
					<div id="leafyVeg" class="tabcontent" style = "display:none;">
						<div class = "tabheader"><h3>Leafy Veg</h3></div>
						<div class = "imageSpace"></div>
					</div>
					
					<div id="saladChinese" class="tabcontent" style = "display:none;">
						<div class = "tabheader"><h3>Salad and Chinese</h3></div>
						<div class = "imageSpace"></div>
					</div>
					
					<div id="flavourVeg" class="tabcontent" style = "display:none;">
						<div class = "tabheader"><h3>Flavour Veg</h3></div>
						<div class = "imageSpace"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="limiter place" style = "display:none;">
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