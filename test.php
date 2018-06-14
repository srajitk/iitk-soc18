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
		<script>
			// Get the modal
			var modal = document.getElementById('id01');

			// When the user clicks anywhere outside of the modal, close it
			window.onclick = function(event) {
				if (event.target == modal) {
					modal.style.display = "none";
				}
			}
		</script>

		<link rel="stylesheet" href="CSS\index.css">
	</head>
	
	<body>
		<div class="loginForm" style="padding-left:550px;padding-top:50px">
			<h3>Log In...</h3>
			<label for="email"><b>Account Type:</b></label><br />
			<input type="radio" name="accType" value="farmer"> Farmer <br />
			<input type="radio" name="accType" value="buyer"> Buyer <br />
			<label for="email"><b>Login Using:</b></label><br />
			<input type="radio" name="loginType" value="mobno"> Mobile Number <br />
			<input type="radio" name="loginType" value="email"> Email Id <br />
			<button type="button" value="Submit" class="proceedBtn" >Proceed</button>
			<button onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Sign Up</button>
			<div id="mobLogin" style = "display:none;padding-right:500px">
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
		
		<div id="id01" class="modal">
		  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
		  <form class="modal-content" action="/action_page.php">
			<div class="container">
			  <h1>Sign Up</h1>
			  <p>Please fill in this form to create an account.</p>
			  <hr>
			  
			   
			  <label for="email"><b>Account Type:</b></label>
			  <input type="radio" name="accType" value="farmer"> Farmer 
			  <input type="radio" name="accType" value="buyer"> Buyer <br />
				
			  <label for="email"><b>*First Name</b></label>
			  <input type="text" placeholder="First Name" name="fname" required>
			  
			  <label for="email"><b>Last Name</b></label>
			  <input type="text" placeholder="Last Name" name="lname" >

			  <label for="email" style="padding-below=20px"; ><b>Date of Birth</b></label>
			  <input type="date" placeholder="DOB" name="dob" required><br />

			  <label for="email"><b>Mobile Number</b></label>
			  <input type="text" placeholder="Mobile Number" name="mobno" required>

			  <label for="email"><b>Email</b></label>
			  <input type="text" placeholder="Enter Email" name="emailid" required>

			  <label for="psw"><b>Password</b></label>
			  <input type="password" placeholder="Enter Password" name="psd1" required>

			  <label for="psw-repeat"><b>Repeat Password</b></label>
			  <input type="password" placeholder="Repeat Password" name="psd2" required>
			  
			  
			  <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

			  <div class="clearfix">
				<button type="button" onclick="document.getElementById('id01').style.display='none'" class="cancelbtn">Cancel</button>
				<button type="submit" class="signupbtn">Sign Up</button>
			  </div>
			</div>
		  </form>
		</div>

	    
    </body>
</html>