$(Document).ready(function () {
	var firstname, lastname, dobirth, emailid, mobno, psd1, psd2, formType, entriesOK = false;
	var regexChk = /[`#'"!;=~<>]/;						// primitive way of guarding against SQL injections	
	var mobileRegex1 = /^(\+?\d{1,3}[- ]?)?(\d{10})$/;
	var mobileRegex0 = /0{5}/;
	var firstFormOk = false;
	
    $("div.signupForm #newuser #basicForm button.proceedBtn").click(function () {
        // check if field entries are valid occurs after this in edge, but before in chrome, hence html::required discouraged
        firstname = $("div.signupForm #newuser #basicForm input[name = fname]").val();
        lastname = 	$("div.signupForm #newuser #basicForm input[name = lname]").val();
        dobirth = 	$("div.signupForm #newuser #basicForm input[name = dob]").val();
        emailid = 	$("div.signupForm #newuser #basicForm input[name = emailid]").val();
        mobno = 	$("div.signupForm #newuser #basicForm input[name = mobno]").val();
        psd1 = 		$("div.signupForm #newuser #basicForm input[name = psd1]").val();
        psd2 = 		$("div.signupForm #newuser #basicForm input[name = psd2]").val();
		
		entriesOK = true;
		
		if (firstname == "" || psd1 == "" || mobno == "") {
			alert("required fields missing");
		}
		else {
			// General testing for SQL injections
			entriesOK = entriesOK && (firstname.match(regexChk) == null);
			entriesOK = entriesOK && (lastname.match(regexChk)  == null);
			entriesOK = entriesOK && (dobirth.match(regexChk)   == null);
			entriesOK = entriesOK && (emailid.match(regexChk)   == null);
			entriesOK = entriesOK && (mobno.match(regexChk)   	== null);
			entriesOK = entriesOK && (psd1.match(regexChk) 		== null);
			entriesOK = entriesOK && (psd2.match(regexChk)		== null);
			
			// Special tests for mobile numbers (perhaps temporary)
			// mobile number may also be tested by an otp/ activation link, which may render the below redundant if not harmful
			var mobRegexArr = mobno.match(mobileRegex1);
			var InvMob = mobno.match(mobileRegex0);
			if (mobRegexArr == null || InvMob != null){
				alert("invalid mobile number");
				return;
			}
			mobno = mobRegexArr.pop();		// Temporary. Is it ok to remove country codes? Or better to store number as is? Will check later how sms' are actually sent/recieved.
			
			// Special tests for email IDs
			// This part will not use email ids, but will send an email with the activation link
			
			if (!entriesOK) {
				alert("no entry can contain the characters {`, #, ', \", !, ;, =}, please alter your entries accordingly");
			}
			else {
				if (psd1 != psd2) {
					alert("passwords do not match");
				} else {
					formType = 	$("div.signupForm #newuser #basicForm input:radio[name=accType]:checked").attr("value");
					if (formType != "farmer" && formType != "buyer" && formType != "evaluator"){
						alert("formtype missing");
					}
					if (formType == "farmer"){
						$("div.signupForm #newuser div#basicForm").hide();
						$("div.signupForm #newuser div#farmerForm").show();													
					} else if (formType == "buyer"){
						$("div.signupForm #newuser div#basicForm").hide();
						$("div.signupForm #newuser div#userForm").show();					
					} else if (formType == "evaluator"){
						$("div.signupForm #newuser div#basicForm").hide();
						$("div.signupForm #newuser div#userForm").show();					
					}
				}
			}
		}
	});		
	$("#id01 button.returnbtn-id01").click(function () {
		$("div.signupForm #newuser div#basicForm").show();
		$("div.signupForm #newuser div#userForm").hide();					
		$("div.signupForm #newuser div#farmerForm").hide();													
	});
	
	$("div.signupForm #newuser #farmerForm button.signupbtn").click(function () {
		var pickupAddr = $("div.signupForm #newuser #farmerForm textarea[name = addr]").val();
		if (pickupAddr == "") {
			alert("required fields missing");
		}
		else {
			entriesOK = (pickupAddr.match(regexChk) == null);
			if (!entriesOK) {
				alert("no entry can contain the characters {`, #, ', \", !, ;, =}, please alter your entries accordingly");
			} else {
				var data = {
					fname: firstname,
					lname: lastname,
					dob: dobirth,
					email: emailid,
					mob: mobno,
					addr: pickupAddr,
					accType: formType,
					};					
				
				// user data other than password sent here, salt obtained in return
				$.ajax({
					type: "POST",
					dataType: "json",
					data: data,
					url: "http://localhost/farm/back/register.php",
					success: function(data){
						if (data.msg == "values ok") {
							// prepending salt recieved to password and hashing on the frontend
							alert(JSON.stringify(data));
							var salt = data.salt;
							var psd = salt + psd1;
							var bitArray = sjcl.hash.sha256.hash(psd);
							var digest_sha256 = sjcl.codec.hex.fromBits(bitArray);
									
							var psdData = {
								mob: mobno,
								accType: formType,
								psdhash: digest_sha256,
							};
							
							alert(JSON.stringify(psdData));
							// now to send the sha256 over to the backend
							$.ajax({
								type: "POST",
								dataType: "json",
								data: psdData,
								url: "http://localhost/farm/back/register2.php",
								success: function(data){
									alert("account created, enjoy");	
								},
								error: function(data) {
									alert("something went wrong#12");
									alert(JSON.stringify(data));
								}
							});
						}
						else {
							alert("credentials are already taken");
						}
						
						// pending work, to clear all  the entries of the form
					},
					error: function (data) {
						alert("error#11");
						alert(JSON.stringify(data));
					}
				}); 
			}
		}
	});
	$("div.signupForm #newuser #userForm button.signupbtn").click(function () {
		//alert (firstname + ", " + lastname+ ", " + dobirth+ ", " + emailid+ ", " + mobno+ ", " + psd1+ ", " + psd2+ ", " + formType);
		var pickupAddr = $("div.signupForm #newuser #userForm textarea[name = addr]").val();
		if (pickupAddr == "") {
			alert("required fields missing");
		}
		else {
			entriesOK = (pickupAddr.match(regexChk) == null);
			if (!entriesOK) {
				alert(pickupAddr);
				alert("no entry can contain the characters {`, #, ', \", !, ;, =} or any whitespace character, please alter your entries accordingly");
			} else {
				var data = {
					fname: firstname,
					lname: lastname,
					dob: dobirth,
					email: emailid,
					mob: mobno,
					addr: pickupAddr,
					accType: formType,
					};					
				
				// user data other than password sent here, salt obtained in return
				$.ajax({
					type: "POST",
					dataType: "json",
					data: data,
					url: "http://localhost/farm/back/register.php",
					success: function(data){
						if (data.msg == "values ok") {
							// prepending salt recieved to password and hashing on the frontend
							var salt = data.salt;
							var psd = salt + psd1;
							var bitArray = sjcl.hash.sha256.hash(psd);
							var digest_sha256 = sjcl.codec.hex.fromBits(bitArray);
									
							var psdData = {
								mob: mobno,
								accType: formType,
								psdhash: digest_sha256,
							};
							alert(JSON.stringify(psdData))
							
							
							// now to send the sha256 over to the backend
							$.ajax({
								type: "POST",
								dataType: "json",
								data: psdData,
								url: "http://localhost/farm/back/register2.php",
								success: function(data){
									alert(JSON.stringify(data));
									alert("account created, enjoy");	// BUG #1: NOT ALERTING, EVEN THOUGH ACCOUNT IS CREATED. WHY?
								},
								error: function(data) {
									alert("something went wrong#22");
									alert(JSON.stringify(data));
								}
							});
						}
						else {
							alert("credentials are already taken");
						}				
						// pending work, to clear all  the entries of the form
					},
					error: function (data) {
						alert("error#21");
						alert(JSON.stringify(data));
					}
				}); 
			}
		}
	});
});
