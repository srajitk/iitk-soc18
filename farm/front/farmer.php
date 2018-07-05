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
				
		<link rel = "stylesheet" type = "text/css" href="style/general/style.css">
		<link rel = "stylesheet" type = "text/css" href="style/general/farmer.css">
		<link rel = "stylesheet" type = "text/css" href="style/sideIcons/sidebar.css">
		<link rel = "stylesheet" type = "text/css" href="style/jquery-ui-1.12.1.custom/jquery-ui.css">
		
		<script src = "jslibs/jquery.js"></script>
		<script src = "js/logout.js"></script>
		<script src = "js/loadicons.js"></script>
		<script src = "js/farmerVegDetails.js"></script>
		<script src = "js/placeSellContract.js"></script>
		
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
				function readURL(input) {

				  if (input.files && input.files[0]) {
					var reader = new FileReader();

					reader.onload = function(e) {
					  $('#imgUploaded').attr('src', e.target.result);
					}

					reader.readAsDataURL(input.files[0]);
				  }
				}

				$("#fileToUpload").change(function() {
				  readURL(this);
				
				  $("#imageAayi span").html("View Image Uploaded");
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
							
							<div class = "static" style = "display:none;"></div>
							<div class = "hidden" style = "display:none;">
								<p name = 'ut'></p>
								<p name = 'cost'></p>
							</div>
						</div>
						<div id = "orderForm">
							Quantity (in <span class = "units">kg</span>):
								<input type = "number" name = "quantity" min = "50" max = "50000" step = "5" required /><br /><br />
							Price charged (in Rs): 
								<input type = "number" name = "price" min = "1000" max = "1000000" step = "500" required /><br /><br />
							Transport Required:&nbsp; <input type = "checkbox" name = "transport"><br/>
							Date, time Of Harvest:
								<input type = "date" name = "harvDate"/>
								<input type = "time" name = "harvTime"/><br />
							Date, time Of Collection:
								<input type = "date" name = "colDate"/>
								<input type = "time" name = "colTime"/><br />
							Attach photograph: <input type="file" name="fileToUpload" id="fileToUpload"><br />
							Category Division: <p id = "catslider" style = "display:inline;"></p>
								<div id="slider" style = "width: 50%; float: right; margin-top: 6px;"></div><br/>
								<div id="imageAayi" ><span>No Image Uploaded </span>
									<div  id="chutiyaKta">
										<img src="xyz" id="imgUploaded" style="width:200px; height:150px;"><br />
									</div>
								</div>
							<button type = "submit" name = "confirm" disabled>Confirm</button>
						</div>
					</div>
				</div>
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
		<!--script src="jslibs/jquery.js"></script-->
		<script src="style/jquery-ui-1.12.1.custom/jquery-ui.js"></script>
		
			<script>
				$(Document).ready(function () {
					$( "#slider" ).slider({
						range: true,
						values: [ 17, 67 ],
						slide: function( event, ui ) {
							$( "#catslider" ).html( "A: " + ui.values[0] + " B: " + (ui.values[1] - ui.values[0]) + " C: " + (100 - ui.values[1]));
						}
					});

					$( "#catslider" ).html( "A: " + $("#slider").slider("values",0) + " B: " + ($("#slider").slider("values", 1) - $("#slider").slider("values", 0)) + " C: " + (100 - $("#slider").slider("values", 1)) );
				});
			</script>


    </body>
</html>