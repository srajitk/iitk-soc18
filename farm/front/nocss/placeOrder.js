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
			alert("Date of harvest must be earlier");
			return;
		}
		
		if(cost == ""){
			alert("Please fill form completely")
			return;
		}
		else{
			check = (check && (cost.match(sqliChk)== null)) && (cost.match(numChk)== null); 
			check = (check && (aQ.match(sqliChk)== null))   && (aQ.match(numChk)== null);
			check = (check && (bQ.match(sqliChk)== null))   && (bQ.match(numChk)== null);
			check = (check && (cQ.match(sqliChk)== null))   && (cQ.match(numChk)== null);
			if(!check) return;	
			
			
		}
		var file_data = $('#fileToUpload').prop('files')[0];   
		var form_data = new FormData();                  
		form_data.append('file', file_data);
		var name= file_data.name;
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
		$.ajax({
			type: "POST",
			dataType: "json",
			data: orderData,
			url: "placeorder.php",
			success: function(data){
				alert(data);
				/*if(data=="good"){
					alert("Uploading Image");
					 $.ajax({
						url: 'uploading.php',
						dataType: 'json',
						cache: false,
						contentType: false,
						processData: false,
						data: form_data,                         
						type: 'post',
						success: function(data){
							alert(data); 
						},
						error: function(data) {
							alert("went wrong");
							alert(JSON.stringify(data));
						}
					 });
				}
				else {
					alert("Problem in uploading of image");
				}
				*/
				
			},
			error: function(data) {
				alert("something went wrong");
				alert(JSON.stringify(data));
				
			}
		});
			
	});
	
});