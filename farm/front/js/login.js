$(Document).ready(function () {
	
	var mobno, email, psd, accType, loginType;
	
    $("div.loginForm button.proceedBtn").click(function () { 	
		accType = $("div.loginForm input:radio[name=accType]:checked").attr("value");
		loginType = $("div.loginForm input:radio[name=loginType]:checked").attr("value");
		if (loginType == "mobno" && accType != undefined){
			$("div.loginForm #preLogin").hide();
			$("div.loginForm #mobLogin").show();
			$("div.loginForm #emailLogin").hide();
		} else if (loginType == "email" && accType != undefined){
			$("div.loginForm #preLogin").hide();
			$("div.loginForm #mobLogin").hide();
			$("div.loginForm #emailLogin").show();
		} else {
			alert("required fields missing");
		}
	});
	
    $("div.loginForm button.backBtn").click(function () {	
		$("div.loginForm #preLogin").show();
		$("div.loginForm #mobLogin").hide();
		$("div.loginForm #emailLogin").hide();
	
	});
	
	$("div.loginForm button.submitbtn").click(function () {
		var regexChk = /[`#'"!;=\s]/;
		var entriesOK = true;
		
		if (loginType == "mobno"){
			mobno = $("div.loginForm div#mobLogin input[name = mobno]").val();
			psd = $("div.loginForm div#mobLogin input[name = psd]").val();
		}
		if (loginType == "email"){
			email = $("div.loginForm div#emailLogin input[name = email]").val();
			psd = $("div.loginForm div#emailLogin input[name = psd]").val();
		}
		
		
		if ((mobno == "" && email == "") || psd == ""){
			alert("reqd fields missing");
		}
		else {
			entriesOK = entriesOK && (psd.match(regexChk) == null);
			if (loginType == "mobno"){
				entriesOK = entriesOK && (mobno.match(regexChk) == null);
			}
			if (loginType == "email"){
				entriesOK = entriesOK && (email.match(regexChk) == null);
			}
			
			if (!entriesOK) {
				alert("no entry can contain the characters {`, #, ', \", !, ;, =} or any whitespace character, please alter your entries accordingly");
			}
			else {
				if (loginType == "mobno"){
					var data = {
						loginType: loginType,
						accType: accType,
						mob: mobno,
					};
				}
				if (loginType == "email"){
					var data = {
						loginType: loginType,
						accType: accType,
						email: email,
					};
				}
				
				$.ajax({
					type:"POST",
					dataType: "json",
					data: data,
					url: "http://localhost/farm/back/login1.php",
					success: function (data) {
						if (data.err == false){
							var saltedpsd = data.salt + psd;
							var bitArray = sjcl.hash.sha256.hash(saltedpsd);
							var digest_sha256 = sjcl.codec.hex.fromBits(bitArray);
							if (loginType == "mobno"){
								var psdData = {
									loginType: loginType,
									accType: accType,
									data: mobno,
									psdhash: digest_sha256,
								};
							}
							if (loginType == "email"){
								var psdData = {
									loginType: loginType,
									accType: accType,
									data: email,
									psdhash: digest_sha256,
								};
							}
							$.ajax({
								type:"POST",
								dataType: "json",
								data: psdData,
								url: "http://localhost/farm/back/login2.php",
								success: function (data) {
									if (data.access){
										if (accType == "farmer"){
											window.location.replace("farmer.php");
										} else if (accType == "buyer") {
											window.location.replace("buyer.php");
										} else if (accType == "evaluator") {
											window.location.replace("evaluator.php");
										}
										
									} else if (!data.access){
										alert("details are invalid!");
										alert(JSON.stringify(data));
										$("#emailLogin input[name=email]").val("");
										$("#emailLogin input[name=psd]").val("");
										$("#emailLogin input[name=mobno]").val("");
									}
								},
								error: function (data) {
									alert(JSON.stringify(psdData));
									alert("something went wrong inside");
									alert(JSON.stringify(data));
								},
							});
						} else if (data.err == "query produced no results"){
							alert(data.query);
						}
					},
					error: function (data) {
						alert("something went wrong outside");
						alert(JSON.stringify(data));
					}
				});
			}
		}
	});
});