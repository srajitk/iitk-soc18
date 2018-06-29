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
		<script src = "js/buyerVegDetails.js"></script>
		
		<script>
			$(Document).ready(function () {
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
		
		var detailok1 = false;		// qlty, qty
		var detailok2 = false;		// dates
		var detailok3 = true;		// misc
		
		var k1 = false;
		var k2 = true;
		$(Document).ready(function () {
			$("#orderDetails input:radio").click(function () {
				if (!k1 && k2) {
					$("#orderDetails #category .ok").css('color', '#00e841');
					$("#orderDetails #category .ok").css('border', '3px solid #00e841');
					detailok1 = true;
					$("#orderDetails #confirmOrder button[name = confirm]").prop('disabled', !(detailok1 && detailok2 && detailok3));
					
				}
				k1 = true;
			});
			$("#orderDetails #category input[type=number]").keyup(function () {
				k2 = ($("#orderDetails #category input[type=number]:valid").length > 0);
				if (k1 && k2){
					$("#orderDetails #category .ok").css('color', '#00e841');
					$("#orderDetails #category .ok").css('border', '3px solid #00e841');
					detailok1 = true;
					$("#orderDetails #confirmOrder button[name = confirm]").prop('disabled', !(detailok1 && detailok2 && detailok3));
				}
				
				if (k1 && !k2) {
					$("#orderDetails #category .ok").css('color', '#777');
					$("#orderDetails #category .ok").css('border', '3px solid #777');
					detailok1 = false;
					$("#orderDetails #confirmOrder button[name = confirm]").prop('disabled', true);
					
				}
			});
		});
		
		$(Document).ready(function () {
			$("#orderDetails #date .slideTwo input:checkbox").change(function () {
				if ($("#orderDetails #date .slideTwo input:checked").length > 0){
					$("#orderDetails #date #stagger").show();
					$("#orderDetails #date #onetime").hide();
				} else {
					$("#orderDetails #date #onetime").show();
					$("#orderDetails #date #stagger").hide();
				}
			});
		});
		
		$(Document).ready(function () {
			var checkStaggerDate = function () {
				var dt1 = new Date($("#orderDetails #date #stagger input[name=startDate]").val());
				var dt2 = new Date($("#orderDetails #date #stagger input[name=endDate]").val());
				var min = new Date();
				var max = new Date();
				min.setDate(min.getDate() + 1);
				max.setDate(max.getDate() + 90);
				var step = $("#orderDetails #date #stagger input[name=step]").val();
				if ((step != "") &1& (dt1 != "") && (dt2 != "") && (dt1 < dt2) && (min < dt1) && (max > dt2)){
					var istep = parseInt(step);
					if (((dt2 - dt1) / (1000*3600*24) % istep) == 0){
						$("#orderDetails #date .ok").css('color', '#00e841');
						$("#orderDetails #date .ok").css('border', '3px solid #00e841');
						detailok2 = true;
						$("#orderDetails #confirmOrder button[name = confirm]").prop('disabled', !(detailok1 && detailok2 && detailok3));
					} else {
						$("#orderDetails #date .ok").css('color', '#777');
						$("#orderDetails #date .ok").css('border', '3px solid #777');
						detailok2 = false;
						$("#orderDetails #confirmOrder button[name = confirm]").prop('disabled', true);
					
					}
				} else {
					$("#orderDetails #date .ok").css('color', '#777');
					$("#orderDetails #date .ok").css('border', '3px solid #777');
					detailok2 = false;
					$("#orderDetails #confirmOrder button[name = confirm]").prop('disabled', true);
				}
			}
			
			var chkDate = function () {
				var dt = new Date($("#orderDetails #date #onetime input[name=oneDate]").val());
				var min = new Date();
				var max = new Date();
				min.setDate(min.getDate() + 1);
				max.setDate(max.getDate() + 90);
				if (min < dt && max > dt){
					$("#orderDetails #date .ok").css('color', '#00e841');
					$("#orderDetails #date .ok").css('border', '3px solid #00e841');
					detailok2 = true;
					$("#orderDetails #confirmOrder button[name = confirm]").prop('disabled', !(detailok1 && detailok2 && detailok3));
				} else {
					$("#orderDetails #date .ok").css('color', '#777');
					$("#orderDetails #date .ok").css('border', '3px solid #777');				
					detailok2 = false;
					$("#orderDetails #confirmOrder button[name = confirm]").prop('disabled', true);
				}
			}
		
			$("#orderDetails #date #stagger input[name=endDate]").change(checkStaggerDate);
			$("#orderDetails #date #stagger input[name=startDate]").change(checkStaggerDate);
			$("#orderDetails #date #stagger input[name=step]").keyup(checkStaggerDate);
			$("#orderDetails #date #stagger input[name=step]").change(checkStaggerDate);
			$("#orderDetails #date .slideTwo input:checkbox").change(function () {
				if ($("#orderDetails #date .slideTwo input:checked").length > 0){
					checkStaggerDate();
				} else {
					chkDate();
				}
			});
			$("#orderDetails #date #onetime input[name=oneDate]").change(chkDate);
		});
		
		</script>
		<script>
			$(Document).ready(function () {
				var menulen = $("#menu").outerWidth(true);
				var vdlen = $("#vegDetails").outerWidth(true);
				
				var len = menulen + vdlen - 24;
				
				$("#orderDetails").css("width", len + "px");
			});
		
			$(window).resize(function () {
				var menulen = $("#menu").outerWidth(true);
				var vdlen = $("#vegDetails").outerWidth(true);
				
				var len = menulen + vdlen - 24;
				
				$("#orderDetails").css("width", len + "px");
			});
		</script>
		<script>
		$(Document).ready(function () {		/* To be changed from */
			$("#hashtag").click(function () {
				$("#orderDetails").fadeIn();
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
				Name: <?php echo $fname.' '.$lname?><br /><br />
				<button id = "logout">Logout</button>
			</div>
		</div>
		<div class="limiter place" style = "display:none;">
			<div class = "orderPortal">
				<div style = "width:100%; height: 100%; min-width: 750px; min-height: 690px; overflow: auto;">
					<div id = "oprow1">
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
						<div id = "vegDetails" style = "display:none;">
							<div class = "dynamic"></div>
							<div class = "const" style = "display:none;">
								<button type = "submit" id = "hashtag">Place Order</button>
							</div>
						</div>
					</div>
					<div id = "oprow2">
						<div id = "orderDetails" style = "display:none;">
							<div style = "width:78vw; padding: 12px; min-width: 1080px; position: absolute; height: 100%">
								<div id = "confirmOrder">
									<h2> Relevant Details </h2>
									<br/>Expected Price Of A: Rs <?php echo 100?>, B: Rs <?php echo 60?>, C: Rs <?php echo 40?>
									
									<button type = "submit" name = "confirm" disabled>Confirm</button>
								</div>
								<div class = "detail" id = "pref">
									Other Preferences will come here...
								</div>
								<div class = "detail" id = "date">
									<div class = "detailHead">Dates:</div>
									<p style = "position: absolute; margin-top: 2px; margin-left: 4px;font-size: 18px;">Stagger :</p>
									<div class="slideTwo">	
										<input type="checkbox" value="None" id="slideTwo" name="check" />
										<label for="slideTwo"></label>
									</div>
									<div id = "stagger" style = "display: none;">
										Start Date: <input type = "date" name = "startDate" /><br/>
										Step: <input type = "number" name = "step" min = "1" max = "28" step = "1" value = "7"/><br/>
										End Date: <input type = "date" name = "endDate" /><br/>
									</div>
									<div id = "onetime">
										Date: <input type = "date" name = "oneDate" />
									</div>
									<div class = "ok"><i class="fa fa-check"></i></div>
								</div>
								<div class = "detail" id = "category">
									<div class = "detailHead">Quality & Qty</div>
									<p style = "font-size: 16px;">Category:</p>
										<div class = "cat">																	
											<ul>
												<li>
													<input type="radio" id="a" name="selector">
													<label for="a">A</label>
													<div class="check"></div>
												</li>

												<li>
													<input type="radio" id="b" name="selector">
													<label for="b">B</label>
													<div class="check"><div class="inside"></div></div>
												</li>

												<li>
													<input type="radio" id="c" name="selector">
													<label for="c">C</label>    
													<div class="check"><div class="inside"></div></div>
												</li>
											</ul>
										</div>
									<span style = "font-size: 14px">Quantity: 
									<input type = "number" name = "quantity" min = "0.1" max = "1000" step = "0.05" value = "1" required /> kg
									<span class="validity"></span></span>
									
									<div class = "ok"><i class="fa fa-check"></i></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="limiter cart" style = "display:none;">
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