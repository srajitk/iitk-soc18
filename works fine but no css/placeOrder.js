$(document).ready(function(){
	var food,category,aQ,bQ,cQ,transport,cost,harvest,deliver,file,errorChk;
	var check = true;
	var sqliChk = /[`#'"!;=~<>]/;		
	var numChk = /[a-zA-Z]/;
	
	$("input:radio[name=xxx]").change(function(){
		$("select[name=frfood]").toggle();
		$("select[name=vefood]").toggle();
	
	});
	
	$("input:submit[name=submit]").click(function(){
		category = $("input:radio[name=xxx]").val();
		if(category=="fruits"){
			food= $("select[name=frfood]").val();
		}
		else food= $("select[name=vefood]").val();
		aQ = $("input[name='a']").val();
		bQ = $("input[name=b]").val();
		cQ = $("input[name=c]").val();
		if($("input:checkbox[name=transport]").is(":checked"))
			transport =1;
		else transport=0;
		cost = $("input[name=cost]").val();
		harvest = $("input[name=harvest]").val();
		deliver = $("input[name=deliver]").val();
		
		if(new Date(harvest)> new Date(deliver)){
			alert("Date of harvest must be earlier");	// also work for > today filter
			return;
		}
		
		if(cost == ""){
			alert("Please fill form completely")
			return;
		}
		else{
			// alert("all fill");
			check = (check && (cost.match(sqliChk)== null)) && (cost.match(numChk)== null); 
			check = (check && (aQ.match(sqliChk)== null))   && (aQ.match(numChk)== null);
			check = (check && (bQ.match(sqliChk)== null))   && (bQ.match(numChk)== null);
			check = (check && (cQ.match(sqliChk)== null))   && (cQ.match(numChk)== null);
			if(!check) return;		// preferably some err msg here
		}
		var file_data = $('#fileToUpload').prop('files')[0];   
		var form_data = new FormData();                  
		form_data.append('file', file_data);
		var name= file_data.name;
		// Puts all other order datails in the table except file details
		var orderData = {
			khana :food,
			type  :category,
			logistics : transport,
			price :cost,
			a	  :aQ,
			b	  :bQ,
			c	  :cQ,
			doharvest  :String(harvest),
			dodeliver  :String(deliver),
			fileName : name
		};		
		// alert(typeof orderData.a);
		$.ajax({
			type: "POST",
			dataType: "json",
			data: orderData,
			url: "placeorder.php",
			success: function(data){
				alert(data);
				if(data=="good"){
					alert("Uploading Image");
				    $.ajax({
						url: 'uploading.php', // point to server-side PHP script 
						dataType: 'json',  // what to expect back from the PHP script, if anything
						cache: false,
						contentType: false,
						processData: false,
						data: form_data,                         
						type: 'post',
						success: function(data){
							alert(data); // display response from the PHP script, if any
						},
						error: function(data) {
							alert("went wrong");
							alert(JSON.stringify(data));
						}
					});
				}
				else {
					errorChk=0;
				}
			},
			error: function(data) {
				alert("something went wrong");
				alert(JSON.stringify(data));
				
			}
		});
		/*if(errorChk==1){			// NESTED CODE PROBABLY MORE APPROPRIATE (DUE TO ASYNC NATURE) (FROM PAST EXPERIENCE MAINLY)
			alert("Uploading Image");
			 $.ajax({
				url: 'uploading.php', // point to server-side PHP script 
				dataType: 'json',  // what to expect back from the PHP script, if anything
				cache: false,
				contentType: false,
				processData: false,
				data: form_data,                         
				type: 'post',
				success: function(data){
					alert(data); // display response from the PHP script, if any
				},
				error: function(data) {
					alert("went wrong");
					alert(JSON.stringify(data));
				}
			 });
		}
		else {
			alert("Problem in uploading of image");
		}*/
			
	});
	
});