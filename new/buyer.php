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
		<link rel = "stylesheet" type = "text/css" href="style/general/style.css">
		<link rel = "stylesheet" type = "text/css" href="style/general/buyer.css">
		
		<script src = "jslibs/jquery.js"></script>
		<script src = "js/logout.js"></script>
		<script src = "js/loadicons.js"></script>
		<script src = "js/loadCart.js"></script>
		<script src = "js/buyerVegDetails.js"></script>
		
		<script>
			$(Document).ready(function () {
				// alert("<?php echo $_SESSION['accType'];?>");
				$(".icon-bar button").on('click', function () {					
					$(this).siblings().removeClass('active');
					$(this).toggleClass('active');
					var txt = "." + ($(".icon-bar button.active").attr('name'));
					
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
		<script>
		
			var removeByAttr = function(arr, attr, value){
				var i = arr.length;
				while(i--){
				   if( arr[i] 
					   && arr[i].hasOwnProperty(attr) 
					   && (arguments.length > 2 && arr[i][attr] === value ) ){ 

					   arr.splice(i,1);

				   }
				}
				return arr;
			}
		
			function toObject(arr) {
			  var rv = {};
			  for (var i = 0; i < arr.length; ++i)
				if (arr[i] !== undefined) rv[i] = arr[i];
			  return rv;
			}
			var present = [];
			var details = [];
			$(Document).ready(function () {
				$("#orderForm button[name = confirm]").click(function () {
					var ratio =1;
					//object formation
					var categ = $("#orderForm input[name = qlty]:checked").val();
					var qty = $("#orderForm input[name=quantity]").val();
					var date = $("#orderForm input[name=orderDate]").val();
					switch(categ){
						case "a" : ratio =1; break;
						case "b" : ratio = 0.75; break;
						case "c" : ratio = 0.40; break;
					}
					//html tag formation
					var p = $("#paisa").html();
					var cat = "<label>Category:"+categ+"</label><br/>";
					var quan = "<label>Quantity:"+qty+"</label><br/>";
					var pa = "<label>Cost:"+p*qty*ratio+"</label><br/>";
					var dod = "<label>Date of Delivery:"+date+"</label><br/>";
					var s = $(".dynamic img").attr('src');
					var n = $(".dynamic img").attr('name');
					var tag = '<div name = "'+n+'" class = "orderImgPlace"><img src = "'+s+'" ></img><div class = "tip"><label class="clearOrder">CLear Order   X</label><br/><br/>'+cat+quan+dod+pa+'</div></div>';
					
					
					
					var obj = {
						id: n,
						cat: categ,
						qty:qty,
						date: date
					};
					
					//front end mgmt					
					
					if (present.includes(n)) {
						alert("order already placed")
						/*alert("overriding previous order");
						$("#pay #imgspace div[name = "+n+"]").remove();
						$("#pay #imgspace").append(tag);
						removeByAttr(details, 'id', n);
						details.push(obj);
						var prev = parseInt($("#cost").html());
						var curr = prev + parseInt($("#orderDetails .hidden p[name=cost]").html()) * parseInt(qty) / parseInt($("#orderDetails .hidden p[name=ut]").html());
						$("#cost").html(curr);*/

					} else {
						$("#pay #imgspace").append(tag);
						present.push(n);
						details.push(obj);
						var prev = parseInt($("#cost").html());
						var curr = prev + parseInt($("#orderDetails .hidden p[name=cost]").html()) * parseInt(qty) / parseInt($("#orderDetails .hidden p[name=ut]").html());
						$("#cost").html(curr);
					}
					
					if (present.length > 0) {
						$("#pay button[name = pay]").prop('disabled', false);
					} else {
						$("#pay button[name = pay]").prop('disabled', true);
					}
				});
				$("#pay button[name = pay]").click(function () {
					x = toObject(details);
					$.ajax({
						type: "POST",
						datatype: "json",
						data: x,
						url: "http://localhost/farm2/back/recBuyOrder.php",
						success: function (data) {

							alert(data);
						},
						error: function (data) {
							alert("couldn't place buy order");
							alert(JSON.stringify(data));
						},
					});
				});
				$("#imgspace").on('click',".clearOrder",function(){
					alert("hello");
				});
				$("#changePic").click(function(){
					var file_data = $('#profPic').prop('files')[0];   
					var form_data1 = new FormData();                  
					form_data1.append('file', file_data);
					$.ajax({
						url: 'http://localhost/farm/back/uploadProfilePic.php', // point to server-side PHP script 
						dataType: 'json',  // what to expect back from the PHP script, if anything
						cache: false,
						contentType: false,
						processData: false,
						data: form_data1,                         
						type: 'post',
						success: function(data){
							alert(data); // display response from the PHP script, if any
							
						},
						error: function(data) {
							alert("went wrong");
							alert(JSON.stringify(data));
						}
					 });
				});
			});
		</script>
		
        <title> Project 1 | <?php echo $fname?></title>

    </head>
    <body>
		

		<div class="icon-bar">
			<button name = "home"><i class="fa fa-home"></i></button> 
			<button name = "place"><i class="fa fa-plus-circle"></i></button>
			<button name = "cart"><i class="fa fa-shopping-cart"></i></button> 
			<button name = "contactUs"><i class="fa fa-paper-plane"></i></button> 
		</div>
		<div class = "limiter home" style = "display:none;">
			<div class = "profile">		
				<img src="../back/uploads/<?php echo $_SESSION['accType']."_".$_SESSION['user_id'];?>.jpg" width=auto; height="100px" id="userPic"></img><br/><br/>
				<input type="file" id="profPic" name="profPic"><br/>
				<button width="100px" id="changePic">Change Profile Pic</button><br/>
				Name: <?php echo $fname.' '.$lname?><br /><br />
				<button id = "logout">Logout</button>
			</div>
		</div>
		<div class="limiter place" style = "display:none;">
			<div class = "orderPortal">
				<div style = "width:100%; height: 100%; min-width: 750px; min-height: 690px; overflow: auto;">
					<div id = "helper">
						<div id = "msg">Please select a vegetable/fruit first (by navigating to the appropriate category)</div>
					</div>
					<div id = "menu">
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
							<div class = "imageSpace"></div>
						</div>

						<div id="fruitsMedium" class="tabcontent" style = "display:none;">
							<div class = "imageSpace"></div>
						</div>

						<div id="fruitsLarge" class="tabcontent" style = "display:none;">
							<div class = "imageSpace"></div>
						</div>
						
						<div id="potatoGourds" class="tabcontent" style = "display:none;">
							<div class = "imageSpace"></div>
						</div>
						
						<div id="greenVeg" class="tabcontent" style = "display:none;">
							<div class = "imageSpace"></div>
						</div>
						
						<div id="generalVeg" class="tabcontent" style = "display:none;">
							<div class = "imageSpace"></div>
						</div>
						
						<div id="leafyVeg" class="tabcontent" style = "display:none;">
							<div class = "imageSpace"></div>
						</div>
						
						<div id="saladChinese" class="tabcontent" style = "display:none;">
							<div class = "imageSpace"></div>
						</div>
						
						<div id="flavourVeg" class="tabcontent" style = "display:none;">
							<div class = "imageSpace"></div>
						</div>
					</div>
					<div id = "orderDetails" style = "display:none;">
						<div id = "vegDetails">
							<div class = "dynamic"></div>
							<br />
							<div class = "static"></div>
							<div class = "hidden" style = "display:none;">
								<p name = 'ut'></p>
								<p name = 'cost'></p>
							</div>
						</div>
						<div id = "orderForm">
							Category: 
								<input type = "radio" name = "qlty" value = "a" />A
								<input type = "radio" name = "qlty" value = "b" />B
								<input type = "radio" name = "qlty" value = "c" />C<br /><br />
							Quantity (in <span class = "units">kg</span>):
								<input type = "number" name = "quantity" required /><br /><br />
							Date Of Delivery:
								<input type = "date" name = "orderDate"/>
							<button type = "submit" name = "confirm" disabled>Confirm</button>
						</div>
						<div id = "pay">
							<div id = "imgspace" style = "width: 100%; height: 70%; padding: 16px;">
							</div>
							<button type = "submit" name = "pay" disabled>Proceed to Payment (Rs <span id = "cost">0</span>/-)</button>
							<div id="paisa" style="display:none">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="limiter cart" style = "display:none;">
			<div class="container-table100">
				<div class="wrap-table100">
					<div class="table100 ver5">
						<div class="table100-head">
							<table>
								<thead>
									<tr class="row100 head">
										<th class="cell100 column1">Veg/Fruit Name</th>
										<th class="cell100 column2">Date of Delivery</th>
										<th class="cell100 column3">Quantity</th>
										<th class="cell100 column4">Category</th>
										<th class="cell100 column5">Price</th>
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
									</tr>

									<tr class="row100 body">
										<td class="cell100 column1">Phi</td>
										<td class="cell100 column2">10000 kg</td>
										<td class="cell100 column3">70</td>
										<td class="cell100 column4">30</td>
										<td class="cell100 column5">0</td>
									</tr>

									<tr class="row100 body">
										<td class="cell100 column1">Aditya Shivaji Yemulwad</td>
										<td class="cell100 column2">10 kg</td>
										<td class="cell100 column3">40</td>
										<td class="cell100 column4">45</td>
										<td class="cell100 column5">15</td>
									</tr>

									<tr class="row100 body">
										<td class="cell100 column1">Patel Preet Rajesh Kumar</td>
										<td class="cell100 column2">10000 kg</td>
										<td class="cell100 column3">0</td>
										<td class="cell100 column4">85</td>
										<td class="cell100 column5">15</td>
									</tr>
									
									<tr class="row100 body">
										<td class="cell100 column1">Gamma</td>
										<td class="cell100 column2">100 kg</td>
										<td class="cell100 column3">0</td>
										<td class="cell100 column4">85</td>
										<td class="cell100 column5">15</td>
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
												<p>IIT Kanpur, Hall 5</p>
											</div>
											<div class="clear"> </div>
										</div>
										<div class="address-row w3-agileits">
											<div class="address-left">
												<i class="fa fa-envelope" aria-hidden="true"></i>
											</div>
											<div class="address-right">
												<h5>Mail Us</h5>
												<p><a href="mailto:info@example.com"> prajwalm@iitk.ac.in</a></p>
											</div>
											<div class="clear"> </div>
										</div>
										<div class="address-row">
											<div class="address-left">
												<i class="fa fa-volume-control-phone" aria-hidden="true"></i>
											</div>
											<div class="address-right">
												<h5>Call Us</h5>
												<p>9868110215</p>
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