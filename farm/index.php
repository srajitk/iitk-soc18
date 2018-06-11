<?php
	session_start();
	if (empty($_SESSION['user_id']) or empty($_SESSION['accType'])){
		session_destroy();
	} else {
		header("Location: user.php");
		exit();
	}
?>

<!DOCTYPE html>

<html>
	<head>
		<meta charset = "utf-8">
		<meta name = "viewport" content = "width = device-width, initial-scale = 1.0">
		
		<title> Project 1 | Log In</title>

        <script src="jslibs/jquery.js"></script>
		<script src="jslibs/sjcl.js"></script>
		<script src="jslibs/sha256.js"></script>
        <script src="js/register.js"></script>
		<script src="js/login.js"></script>		
	</head>

	<body>
		<h3>Log In...</h3>
		<div class="loginForm">
			Account Type:<br />
			<input type="radio" name="accType" value="farmer"> Farmer <br />
			<input type="radio" name="accType" value="buyer"> Buyer <br />
			Login Using:<br />
			<input type="radio" name="loginType" value="mobno"> Mobile Number <br />
			<input type="radio" name="loginType" value="email"> Email Id <br />
			<button type="button" value="Submit" class="proceedBtn">Proceed</button>
			<div id="mobLogin" style = "display:none;">
				Mobile Number:<br />
				<input type="text" name= "mobno" /><br />
				Password:<br />
				<input type="password" name="psd" /><br />
				<button type="submit" value="Submit" class="submitbtn">Submit</button>
			</div>
			<div id="emailLogin" style = "display:none;">
				Email Id:<br />
				<input type="text" name= "email" /><br />
				Password:<br />
				<input type="password" name="psd" /><br />
				<button type="submit" value="Submit" class="submitbtn">Submit</button>
			</div>
        </div>
		
		<hr />
		
	    <div class="signupForm">
            <span onclick='$("div.signupForm").hide();' class="close" title="close modal">&times;</span>
            <div id="newuser" class="modal-content">
                <!-- "<... action="new_user_back.php" method="post">" sends data to php but the callback function not well defined, as in jquery-->
                <!-- eg. writing echo hello; echo $_POST["fname"] in php rewrites the entire html as there is nothing expecting it-->
                <!-- also onsubmit function has not been used, instead a jquery $().click is used-->
                <div class="container">
                    <h2>Sign Up</h2>
                    <p>Please fill in this form to create an account.(* indicates compulsory fields)</p>
					<!-- ONLY REPRESENTATIVE FIELDS, OTHERS MAY BE ADDED WITH TIME (SUCH AS BANK ACC NO) -->
                    <hr>
					<div id="basicForm">
						<h2> First Some basic information about yourself </h2> <hr>
						*First Name:<br /> 
						<input type="text" name="fname"/><br />
						Last Name:<br />
						<input type="text" name="lname"/><br />
						Date of Birth:<br />
						<input type="date" name="dob"/><br />
						Email Id:<br />
						<input type="email" name="emailid"/><br />
						*Mobile Number: <br />
						<input type="text" name="mobno"/><br />
						Account Type: <br />
						<input type="radio" name="accType" value="farmer"> Farmer <br />
						<input type="radio" name="accType" value="buyer"> Buyer <br />
						*Password:<br />
						<input type="password" name="psd1"/><br />
						*Re-enter Password:<br />
						<input type="password" name="psd2"/><br />
						<button type="button" class="proceedBtn">Proceed</button>
					</div>
					<div id="farmerForm" style = "display:none;">
						<h2> Now some further details </h2> <hr />
						*Pickup Address:<br />
						<textarea name="addr" rows = "5" cols = "40"/></textarea><br />
						<div class="clearfix">
							<button type="submit" class="signupbtn" name="Submit"> Submit </button>
							<button type="button" onclick="document.getElementById('signupform').style.display = 'none'" class="cancelbtn">Cancel</button>
						</div>
					</div>
					<div id="userForm" style = "display:none;">
						<h2> Now some further details </h2> <hr />
						*Delivery Address:<br />
						<textarea name="addr" rows = "5" cols = "40"/></textarea><br />
						<div class="clearfix">
							<button type="submit" class="signupbtn" name="Submit"> Submit </button>
							<button type="button" onclick="document.getElementById('signupform').style.display = 'none'" class="cancelbtn">Cancel</button>
						</div>
					</div>
					<br />
                </div>
            </div>
        </div>
    </body>
</html>