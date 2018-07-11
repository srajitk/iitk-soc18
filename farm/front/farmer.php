<?php
	session_start();
	if (empty($_SESSION['user_id']) or empty($_SESSION['accType'])){
		header("Location: index.php");
		session_destroy();
		exit();
	}
	elseif ($_SESSION['accType'] != 'farmer') {
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

		<link rel = "stylesheet" type = "text/css" href="style/general/contact.css">
		<link rel = "stylesheet" type = "text/css" href="style/general/farmer.css">
		<link rel = "stylesheet" type = "text/css" href="style/sideIcons/sidebar.css">
		<link rel = "stylesheet" type = "text/css" href="style/jquery-ui-1.12.1.custom/jquery-ui.css">

		<script src = "jslibs/jquery.js"></script>
		<script src = "js/logout.js"></script>
		<script src = "js/loadicons.js"></script>
		<script src = "js/farmerVegDetails.js"></script>
		<script src = "js/placeSellContract.js"></script>
		<script src = "js/loadQ.js"></script>
		<script src = "js/viewQ.js"></script>

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

				  $("#imageAayi span").html("View Image");
				  if(!$("#fileToUpload").val()){				
					  $("div.orderForm button[name=confirm]").attr("disabled", "disabled");
					  $("div.orderForm button[name=confirm]").css("background-color","#777");
				  }
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

				if($("#fileToUpload").val()==""){				
					  $("div.orderForm button[name=confirm]").attr("disabled", "disabled");
					  $("div.orderForm button[name=confirm]").css("background-color","#777");
				  }
				
					

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
				<?php echo $fname.' '.$lname?><br /><br />
				<img src="http://localhost/farm/back/uploads/<?php echo $_SESSION['accType']."_".$_SESSION['user_id'];?>.jpg" width="100%"; height=auto id="userPic" onerror="this.src='fallback-img.jpg'"></img><br/><br/>
				Value: <?php echo $val;?><br /><br />
				<label for="profPic" class="custom-file-upload">
					<i class="fa fa-user-circle"></i>&nbsp; Try New Pic
				</label>
				<input type="file" id="profPic" name="profPic"><br/>
				<button width="100%" id="changePic"><i class="fa fa-cloud-upload"></i>&nbsp;Change Pic</button><br/>
				<button id = "logout">Logout</button>
			</div>
		</div>
		<div class="limiter place" style = "display:none;">
			<div class = "orderPortal">
				<div style = "width:100%; height: 100%; min-width: 840px; min-height: 690px; overflow: auto;">
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
								<input type = "number" name = "price" min = "1000" max = "1000000" step = "500" required /><br />
							Transport Required:&nbsp; <input type = "checkbox" name = "transport"><br/>
							Date, time Of Harvest:
								<input type = "time" name = "harvTime"/>
								<input type = "date" name = "harvDate"/><br />
							Date, time Of Collection:
								<input type = "time" name = "colTime"/>
								<input type = "date" name = "colDate"/><br /><br />
							<span style = "margin-top: 12px;">Attach photograph: <input type="file" name="fileToUpload" id="fileToUpload"></span>
								<div id="imageAayi"><span>No Image</span>
								</div>
								<div  id="chutiyaKta">
									<img id="imgUploaded">
								</div><br/><br/>
							Category Division: <p id = "catslider" style = "display:inline;"></p>
								<div id="slider" style = "width: 50%; float: right; margin-top: 6px;"></div><br/>
							<div id = "buttonSpace">
								<button type = "submit" name = "confirm" disabled>Confirm</button>
								<button type = "submit" name = "seeQueue" disabled>Queue</button>
							</div>
						</div>
						<div id = "queueModal" class = "Vqueue modal">
							<div class="modal-content">
								<span class="close">&times;</span>
								<div class="container-table100">
									<div class="wrap-table100">
										<div class="table100 ver5">
											<div class="table100-head">
												<table>
													<thead>
														<tr class="row100 head">
															<th class="cell100 column1">Name</th>
															<th class="cell100 column2">A</th>
															<th class="cell100 column3">B</th>
															<th class="cell100 column4">C</th>
															<th class="cell100 column5">Price</th>
															<th class="cell100 column6">Transport</th>
															<th class="cell100 column7">Rank</th>
														</tr>
													</thead>
												</table>
											</div>

											<div class="table100-body js-pscroll">
												<table>
													<tbody>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
							</div>
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
										<th class="cell100 column2">Date Of Delivery</th>
										<th class="cell100 column3">Order Placed On</th>
										<th class="cell100 column4">Price(Rs)</th>
										<th class="cell100 column5">Transport</th>
										<th class="cell100 column6">Rank</th>
									</tr>
								</thead>
							</table>
						</div>

						<div class="table100-body js-pscroll">
							<table>
								<tbody>
								</tbody>
							</table>
						</div>
					</div>
					<div id = "overlayContainer">
						<div name="orderDetails" id="overlay" style="display:none">
							Time Placed::<span name="time"></span>, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							Date of Harvest:<span name="harvest"></span>, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							A:<span name="a"></span>kg, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							B:<span name="b"></span>kg, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							C:<span name="c"></span>kg, 
							<!--Transport:<span name="transport"></span>, 
							Cost:<span name="cost"></span>, 
							Date to Deliver:<span name="deliver"></span>, 
							Food:<span name="food"></span>, 
							Rank:<span name="rank"></span--> 					
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="limiter contactUs" style = "display:none;">	
			<div class="wthree-dot">
				<div id = "CONTACT">
				<h1 id="ID1">Contact our team</h1>
				<div class="profile2">
					<div class="wrap">
						<!-- contact -->
						<div class="contact">
							<div class="contact-row agileits-w3layouts">  
								<div class="contact-w3lsleft">
									<div class="contact-grid agileits">
										<h4>DROP US A LINE </h4>
										<form action="#" method="post"> 
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
												<p><a href="mailto:info@example.com"> prajwalm@iitk.ac.in,<br /> srajitk@iitk.ac.in, <br />shobhitj@iitk.ac.in</a></p>
											</div>
											<div class="clear"> </div>
										</div>
										<div class="address-row">
											<div class="address-left">
												<i class="fa fa-volume-control-phone" aria-hidden="true"></i>
											</div>
											<div class="address-right">
												<h5>Call Us</h5>
												<p>9868110210</p>
											</div>
											<br><br><br><br>
											<div class="address-right">
												<input type="submit" value="FAQ's" id="faq">
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
				<div id="FAQ" style = "display:none">
				<h1 id="ID2" >FAQ's</h1>
				<div class="profile2">
					<div class="wrapfaq">
						<!-- contact -->
						
						<div class="contact-row agileits-w3layouts">  
							<div class="contact-w3lsleftfaq">
								<div class="contact-grid agileits">
									<div style = "overflow:auto;height: 50vh;min-height: 120px;">
										<p>Q: What do the icons on the left signify?</p>
										<p>Ans: The icons are, from the top, Home (this is where you may find your personal details), Place Sell Contract 
										(this is the portal where you buy from us), My Contracts (this is a list of all the contracts you have placed with
										us so far), and finally Contact Us, where you currently are. </p><br />
										<p>Q: Are all contracts accepted when I submit them?</p>
										<p>Ans: No, the contracts are simply added to a daily supply queue, based on user demand we will purchase from the 
										top of the queue as and when required.</p><br>
										<p>Q: Is there just one unified queue?</p>
										<p>Ans: No, each fruit/vegetable has a seperate queue, also each day has a seperate queue, to ensure that the farm 
										produce reaches the end-buyer in minimum time.</p><br>
										<p>Q: How are the queues formed? That is on what parameters does my position on the queue depend?</p>
										<p>Ans: Entries are inserted into the queue based on parameters like the cost is to quantity ratio, the image sent,
										the quality division, delay between harvesting and deliver and our measure of the value of a farmer.</p><br>
										<p>Q: My neighbour quotes a better value ratio than he acutally produces,Also he sends the images
										with his best produce at the top of the crates and much worse produce hidden below, will he rise above me? </p>
										<p>Ans: Certainly not, we reward integrity more than all. He may have a better first time, but soon will suffer
										much more as we start to take note of his attempts at deception. His value will soon fall behind other honest farmers
										and will almost never reach the top of the queues, also we will consider his self valuation keeping his past in mind.</p><br>
										<p>Q: The A, B, C weights reported in the "My Contracts" section are not what I fed in.</p>
										<p>Ans: Indeed, we keep track of every single purchase from you, and use that and your current quality division to decide
										what the actual division will be like.</p><br>
										<p>Q: If I quote B or C and produce quality worth A, will that improve my value?</p>
										<p>Ans: No! Please quote exactly what you produce, erring on either side can only impede the growth of your value, not 
										to mention that if you quote B, and give a price worth A, you will almost never rise to the top of the queue.</p><br>
										<p>Q: Is there an app for this too, using the website is too inconvient?</p>
										<p>Ans: We are working on it.</p><br>
										<p>Q: Some aspects of my form aren't working correctly. Please help.</p>
										<p>Ans: Mail us the problem immediately. We will correct it asap</p><br>
										
									</div>
									<input type="submit" value="Contact our team" id="cntct" style="background:black;color:white">	 
								</div>
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
