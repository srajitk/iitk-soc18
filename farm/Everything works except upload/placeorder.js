$(document).ready(function(){
	$("#place").click(function(){
		var cat = $("input[name='xxx']").val();
		if (cat=="fruits")
			var item = $("select[name='frfood']").val();
		else 
			var item = $("select[name='vefood']").val();
		var aQ = $("input[name='a']").val();
		var bQ = $("input[name='b']").val();
		var cQ = $("input[name='c']").val();
		var paise = $("input[name='cost']").val();
		var doh = $("input[name='doharvest']").val();
		var dod = $("input[name='dodeliv']").val();
		// var path=$("input[name='imgUpload'").val();
		
		
		
		var order = {
			food: item,
			category : cat,
			a : aQ,
			b : bQ,
			c : cQ,
			cost : paise,
			harvest : doh,
			deliver : dod,
			// filePath : path
		};
		
		$.ajax({
			type: "POST",
			dataType: "json",
			data: order,
			url: "placeOrder.php",
			success: function(data){
				alert(data);
			},
			error: function(data) {
				alert("something went wrong");
				alert(JSON.stringify(data));
			}
		});
	
	});
});