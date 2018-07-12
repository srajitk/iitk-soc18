<?php
	session_start();
	if (empty($_SESSION['user_id']) or empty($_SESSION['accType'])){
		header("Location: index.php");
		session_destroy();
		exit();
	}
	elseif ($_SESSION['accType'] != 'buyer') {
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
		<link rel = "stylesheet" type = "text/css" href="style/general/contact.css">
		<link rel = "stylesheet" type = "text/css" href="style/general/buyer.css">

		<script src = "jslibs/jquery.js"></script>
		<script src = "js/logout.js"></script>
		<script src = "js/loadicons.js"></script>
		<script src = "js/loadCart.js"></script>
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
				var ratio =1;
				var prev;
				var curr;
				
				var count=1;
				$("#orderForm button[name = confirm]").click(function () {

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
					var pa = '<label id="khao'+n+'" name="ono'+count+'">Cost:'+p*qty*ratio+'</label><br/>';
					var dod = "<label>Date of Delivery:"+date+"</label><br/>";
					var s = $(".dynamic img").attr('src');
					var n = $(".dynamic img").attr('name');
					var pa = '<label id="khao'+n+'" name="ono'+count+'">Cost:'+p*qty*ratio+'</label><br/>';
					var tag = '<div name = "'+n+'" class = "orderImgPlace"><img src = "'+s+'" ></img><div class = "tip"><label class="clearOrder">Clear Order   X</label><br/><br/>'+cat+quan+dod+pa+'</div></div>';
					
					count=count+1;

					var obj = {
						id: n,
						cat: categ,
						qty:qty,
						date: date
					};

					//front end mgmt

					if (present.includes(n)) {
						// alert("order already placed")
						alert("overriding previous order");
						var tut = $("#cost").html();
						var fuf = $("#khao"+n).html();						
						fuf = fuf.substr(5);
						tut =tut-fuf;
						// alert(tut);
						// $("#cost").html(fuf);
						$("#pay #imgspace div[name = "+n+"]").remove();
						$("#pay #imgspace").append(tag);						
						fuf = $("#khao"+n).html();						
						fuf = fuf.substr(5);
						tut = parseInt(tut)+parseInt(fuf);
						// alert(tut);
						$("#cost").html(tut);
						removeByAttr(details, 'id', n);
						details.push(obj);
						
						
						// var qyq = $("div[name="+n+"]").attr("class");
						// alert(qyq);
					} else {
						$("#pay #imgspace").append(tag);
						present.push(n);
						details.push(obj);
						prev = parseInt($("#cost").html());
						curr = prev + parseInt($("#orderDetails .hidden p[name=cost]").html()) * parseInt(qty) * ratio/ parseInt($("#orderDetails .hidden p[name=ut]").html());
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
						url: "http://localhost/farm/back/recBuyOrder.php",
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
					var na = $(this).parent().parent().attr("name");
					// alert(JSON.stringify(present));
					// alert(na);
					present = jQuery.grep(present, function(value) {
					  return value != na;
					});
					var index;
					details.some(function(entry, i) {
						if (entry.id == na) {
							index = i;
							return true;
						}
					});
					// alert(index);
					details.splice(index,1);
					// alert(JSON.stringify(details));
					Array.prototype.sum = function (prop) {
						var total = 0
						for ( var i = 0, _len = details.length; i < _len; i++ ) {
							total += details[i][prop]
						}
						return total
					}
					var mom=$(this).next().next().next().next().next().next().next().next().next().html();
					mom = mom.substr(5)	;
					// alert(mom);
					var qwe = $("#cost").html();
					qwe = qwe - mom;
					// alert(qwe);	
					if(qwe==0){
						$("button[name = pay]").css("background","#777");
					}
					$("#cost").html(qwe);
					$(this).parent().parent().remove();

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
				Name: <?php echo $fname.' '.$lname?><br /><br />
				<img src="http://localhost/farm/back/uploads/<?php echo $_SESSION['accType']."_".$_SESSION['user_id'];?>.jpg" width=auto; height="100px" id="userPic" onerror="this.src='fallback-img.jpg'"></img><br/><br/>
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
								</tbody>
							</table>
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
										<p>Ans: The icons are, from the top, Home (this is where you may find your personal details), Place Order 
										(this is the portal where you buy from us), My Cart (this is a list of all the orders you have placed with
										us so far), and finally Contact Us, where you currently are. </p><br />
										<p>Q: Are orders recorded when I press confirm on the Place Order section?</p>
										<p>Ans: No, the orders are collectively placed only when you press Proceed To Payment</p><br>
										<p>Q: What do category A,B,C specify? Why is C so cheap?</p>
										<p>Ans: A,B,C represent decreasing order of quality. A is guaranteed to be fresh and represents the best amongst 
										the produce. B is somewhat below A, but perfectly ok for all households to eat. C is specifically for those who 
										cannot afford B or would like to save cash, it is by far the cheapest, but quality is not guaranteed.</p><br>
										<p>Q: Is C quality even safe to eat?</p>
										<p>Ans: Indeed, while not up to A or B, it is certainly not harmful to the health, we immediately discard those 
										fruits/vegetables that do not meet the standards of basic ediblity.</p><br>
										<p>Q: The price on the cart is not what is shown in the "Proceed To Payment" button, why?</p>
										<p>Ans: Proceed to payment only shows indicative price, the actual is set by the farmers. As farmers propose to 
										sell their produce to us, we compare their offers and buy from the ones with the best prices, minimum delay between
										harvest and sale and maximum reputation among us, the prices they quote are the ones that appear on the list. </p><br>
										<p>Q: I wish to set orders for continuous delivery, rather than filling out the form everyday. Does the website have
										that feature</p>
										<p>Ans: We are working on it and will integrate it asap.</p><br>
										<p>Q: When can I expect to receive an order that I placed?</p>
										<p>Ans: The actual time of delivery depends on the transport agency responsible for that particular order, however in
										most circumstances it should reach on the same day, if it doesn't, please report to us, we will immediately take all 
										necessary action.</p><br>
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

    </body>
</html>
