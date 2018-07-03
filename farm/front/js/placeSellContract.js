$(Document).ready(function(){
	$("#orderForm button[name = confirm]").click( function () {
		var fvid = $("#vegDetails").attr('name');
		var t1 = (new Date($("#orderForm input[name = harvDate]").val() +" "+ $("#orderForm input[name = harvTime]").val()));
		var t2 = (new Date($("#orderForm input[name = colDate]").val() +" "+ $("#orderForm input[name = colTime]").val()));
		var qty = $("#orderForm input[name=quantity]:valid").val();
		var price = $("#orderForm input[name=price]:valid").val();
		
		var a = $("#slider").slider("values",0)*qty/100;
		var b = ($("#slider").slider("values", 1) - $("#slider").slider("values", 0))*qty/100;
		var c = (100 - $("#slider").slider("values", 1))*qty/100;
		
		var transport;
		
		if ($("input:checkbox[name=transport]").is(":checked")) transport = 1;
		else transport=0;

		var file_data = $('#fileToUpload').prop('files')[0];   
		var form_data = new FormData();                  
		form_data.append('file', file_data);
		var name= file_data.name;
		
		var sellOrder = {
			khana: fvid,
			logistics : transport,
			th: t1.toISOString().slice(0, 19).replace('T', ' '),
			tc: t2.toISOString().slice(0, 19).replace('T', ' '),
			qty: qty,
			price: price,
			a: a,
			b: b,
			c: c,
			fileName : name
		};
		alert(JSON.stringify(sellOrder));
		
		$.ajax({
			type: "POST",
			datatype: "json",
			data: sellOrder,
			url: "http://localhost/farm/back/placeorder.php",			
			success: function(data){
				alert(data);
				if(data=="good"){
					alert("Uploading Image");
					$.ajax({
						url: "http://localhost/farm/back/uploading.php",			
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
				
				
			},
			error: function(data) {
				alert("something went wrong");
				alert(JSON.stringify(data));
				
			}
		});
	});
});