<?php
	session_start();
	if (empty($_SESSION['user_id']) or empty($_SESSION['accType'])){
		session_destroy();
	} else {
		if ($_SESSION['accType'] == "farmer"){
			header("Location: farmer.php");
		}
		elseif ($_SESSION['accType'] == "buyer"){
			header("Location: buyer.php");
		}
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		
		<title> Project 1 | Log In</title>
	
	
	<!--============================================== styles loaded from login template ==============-->	
		<link rel="icon" type="image/png" href="style/login/images/icons/favicon.ico"/>
		<link rel="stylesheet" type="text/css" href="jslibs/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="style/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="jslibs/animate/animate.css">
		<link rel="stylesheet" type="text/css" href="jslibs/css-hamburgers/hamburgers.min.css">
		<link rel="stylesheet" type="text/css" href="jslibs/select2/select2.min.css">
		<link rel="stylesheet" type="text/css" href="style/login/css/util.css">
		<link rel="stylesheet" type="text/css" href="style/login/css/main.css">
	<!--===============================================================================================-->
	
	<!--================================================== google icons ===============================-->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<!--===============================================================================================-->
	
	<script src="jslibs/jquery/jquery-3.2.1.min.js"></script>
	<script src="jslibs/sjcl.js"></script>
	<script src="jslibs/sha256.js"></script>
	<script src="js/register.js"></script>
	<script src="js/login.js"></script>		
	
	<link rel="stylesheet" href="style/register/index.css">
	<style>
		body { 
		  background: url("style/images/vegBack2.jpg") no-repeat center center fixed; 
		  -webkit-background-size: cover;
		  -moz-background-size: cover;
		  -o-background-size: cover;
		  background-size: cover;
		}
	</style>
	<script>
			// VERTICALLY ALIGN FUNCTION
		$(Document).ready(function () {
			vc = $('.verticalCenter');			
			vc.each(function() {
				var ah = $(this).height();
				var ph = $(this).parent().height();
				var mh = Math.ceil((ph-ah) / 2);
				$(this).css('margin-top', mh);
				
			});
		});
	</script>
	<script>
		$(Document).ready(function () {
			var wh = $(window).height();
			var ww = $(window).width();
			
			if (ww/1680> wh/1050){
				n = ww/1680;
			}
			else{
				n = wh/1050;
			}
			var marginx = 0.325*n*1680 - 0.5*(1680*n - ww);
			var marginy = 0.25*n*1050 - 0.5*(1050*n - wh);
			
			$(".wrap-login100").css("margin-left", marginx);
			$(".wrap-login100").css("margin-top", marginy);
			
			$(".wrap-login100").css("width", n * 1680 * 0.316);
			$(".wrap-login100").css("height", n * 1050 * 0.48);
		});
	
		$(window).resize(function () {
			var wh = $(window).height();
			var ww = $(window).width();
			
			if (ww/1680> wh/1050){
				n = ww/1680;
			}
			else{
				n = wh/1050;
			}
			var marginx = 0.325*n*1680 - 0.5*(1680*n - ww);
			var marginy = 0.25*n*1050 - 0.5*(1050*n - wh);
			
			$(".wrap-login100").css("margin-left", marginx);
			$(".wrap-login100").css("margin-top", marginy);
			
			$(".wrap-login100").css("width", n * 1680 * 0.316);
			$(".wrap-login100").css("height", n * 1050 * 0.48);
		});
	</script>
	<script>
		// Modal manager
		$(Document).ready(function () {
			$("#newAccount").click(function () {
				$('#id01').show(); $('div.limiter').hide();
				$('body').css('background-image', 'url("style/images/vegBack2nofocus.jpg")');
			});
			
			$("#id01 span.close-id01").click(function () {
				$('#id01').hide(); $('div.limiter').show();
				$('body').css('background-image', 'url("style/images/vegBack2.jpg")');
			});
			
			$("#id01 button.cancelbtn-id01").click(function () {
				$('#id01').hide(); $('div.limiter').show();
				$('body').css('background-image', 'url("style/images/vegBack2.jpg")');
			});
			
		});
	</script>
	</head>
	<body>
		
		<div class="limiter">
			<div class="container-login100">
				<div class="wrap-login100">
					<!--div class="login100-pic js-tilt" data-tilt>
						<img src="style/login/images/img-01.png" alt="IMG" class = 'verticalCenter'>
					</div-->

					<form class="login100-form validate-form">
						<span class="login100-form-title">
							Member Login
						</span>
						<div class = "loginForm" style= "font-size:1.8vh;">
							<div id ="preLogin">
								Account Type:<br />
								<input type="radio" name="accType" value="farmer"> Farmer 
								<input type="radio" name="accType" value="buyer"> Buyer
								<input type="radio" name="accType" value="evaluator"> Evaluator
								<br />
								Login Using:<br />
								<input type="radio" name="loginType" value="mobno"> Mobile Number 
								<input type="radio" name="loginType" value="email"> Email Id <br /><br />
								<div class="container-login100-form-btn">
									<button type="button" value="Submit" class="login100-form-btn proceedBtn">
										Proceed
									</button>
								</div>
							</div>
							<div id="emailLogin" style = "display:none;">
								<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
									<input class="input100" type="text" name="email" placeholder="Email">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="fa fa-envelope" aria-hidden="true"></i> <!-- do check if this works in the absence of net-->
									</span>
								</div>

								<div class="wrap-input100 validate-input" data-validate = "Password is required">
									<input class="input100" type="password" name="psd" placeholder="Password">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="fa fa-lock" aria-hidden="true"></i>
									</span>
								</div>
								
								<div class="container-login100-form-btn">
									<button class="login100-form-btn submitbtn" type="submit" value="Submit">
										Login
									</button>
									<button class="login100-form-btn backBtn" type="submit" value="Back">
										Back
									</button>
								</div>
							</div>
							
							<div id="mobLogin" style = "display:none;">
								<div class="wrap-input100 validate-input">
									<input class="input100" type="text" name="mobno" placeholder="Moblie Number">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="fa fa-mobile" aria-hidden="true" style = "font-size:24px;"></i>
									</span>
								</div>

								<div class="wrap-input100 validate-input">
									<input class="input100" type="password" name="psd" placeholder="Password">
									<span class="focus-input100"></span>
									<span class="symbol-input100">
										<i class="fa fa-lock" aria-hidden="true"></i>
									</span>
								</div>
								
								<div class="container-login100-form-btn">
									<button class="login100-form-btn submitbtn" type="submit" value="Submit">
										Login
									</button>
										
									<button class="login100-form-btn backBtn" type="submit" value="Back">
										Back
									</button>
								
								</div>
								
								
							</div>
						</div>

						<div class="text-center">
							<span class="txt1"> Forgot </span><a class="txt2" href="#">	Username / Password?</a>
						</div>

						<div class="text-center p-t-12">
							<div class="container-login100-form-btn">
								<button id = "newAccount" class="login100-form-btn" style="width:auto;">
									Create your Account
									<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<div id="id01" class="modal signupForm">
			<span class="close-id01">&times;</span>
			<div id = "newuser" class="modal-content" style= "overflow:auto;">
				<!--form class="modal-content" action="/action_page.php"-->
				<!-- "<... action="new_user_back.php" method="post">" sends data to php but the callback function not well defined, as in jquery-->
                <!-- eg. writing echo hello; echo $_POST["fname"] in php rewrites the entire html as there is nothing expecting it-->
                <!-- also onsubmit function has not been used, instead a jquery $().click is used-->
				<div class="container-id01">
					<h2>Sign Up</h2>
					<hr>
					<!-- ONLY REPRESENTATIVE FIELDS, OTHERS MAY BE ADDED WITH TIME (SUCH AS BANK ACC NO) -->
					<div id="basicForm">
						<!--label for="email"><b>Account Type:</b></label>
						<input type="radio" name="accType" value="farmer"> Farmer 
						<input type="radio" name="accType" value="buyer"> Buyer <br />
						
						<label for="email"><b>*First Name</b></label>
						<input type="text" placeholder="First Name" name="fname" required>
					  
						<label for="email"><b>Last Name</b></label>
						<input type="text" placeholder="Last Name" name="lname" >

						<label for="email" style="padding-below=20px"; >
						<b>Date of Birth</b></label>
						<input type="date" name="dob" required><br />

						<label for="email"><b>Mobile Number</b></label>
						<input type="text" placeholder="Mobile Number" name="mobno" required>

						<label for="email"><b>Email</b></label>
						<input type="text" placeholder="Enter Email" name="emailid" required>

						<label for="psw"><b>Password</b></label>
						<input type="password" placeholder="Enter Password" name="psd1" required>

						<label for="psw-repeat"><b>Repeat Password</b></label>
						<input type="password" placeholder="Repeat Password" name="psd2" required-->
						First Some basic information about yourself <hr>
						*First Name:<br /> 
						<input type="text" placeholder="First Name" name="fname"/><br />
						Last Name:<br />
						<input type="text" placeholder="Last Name" name="lname"/><br />
						Date of Birth:<br />
						<input type="date" name="dob"/><br />
						Email Id:<br />
						<input type="email" placeholder="Enter Email" name="emailid"/><br />
						*Mobile Number: <br />
						<input type="text" placeholder="Mobile Number" name="mobno"/><br />
						Account Type: <br />
						<input type="radio" name="accType" value="farmer"> Farmer <br />
						<input type="radio" name="accType" value="buyer"> Buyer <br />
						<input type="radio" name="accType" value="evaluator"> Evaluator <br />
						*Password:<br />
						<input type="password" name="psd1"/><br />
						*Re-enter Password:<br />
						<input type="password" name="psd2"/><br />
					  
						<p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

						<div class="clearfix">
							<button type="button" class="cancelbtn-id01">Cancel</button>
							<button type="button" class="proceedBtn">Proceed</button>
						</div>
					</div>
						
					<div id="farmerForm" style = "display:none;">
						<h2> Now some further details </h2> <hr />
						*Pickup Address:<br />
						<textarea name="addr" rows = "5" cols = "40"></textarea><br />
						<div class="clearfix">
							<button type="button" class="returnbtn-id01">Return</button>
							<button type="submit" class="signupbtn" name="Submit"> Sign Up </button>
						</div>
					</div>
					
					<div id="userForm" style = "display:none;">
						<h2> Now some further details </h2> <hr />
						*Delivery Address:<br />
						<textarea name="addr" rows = "5" cols = "40"></textarea><br />
						<div class="clearfix">
							<button type="button" class="returnbtn-id01">Return</button>
							<button type="submit" class="signupbtn" name="Submit"> Sign Up </button>
						</div>
					</div>
				</div>
			</div>
		</div>

		
	<!--===============================================================================================-->	
		<script src="jslibs/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
		<script src="jslibs/bootstrap/js/popper.js"></script>
		<script src="jslibs/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
		<script src="jslibs/select2/select2.min.js"></script>
	<!--===============================================================================================-->
		<!--script src="jslibs/tilt/tilt.jquery.min.js"></script-->
		<!--script >
			$('.js-tilt').tilt({
				scale: 1.1
			})
		</script-->
	<!--===============================================================================================-->
		<script src="style/login/js/main.js"></script>

	</body>
</html>