$(Document).ready(function(){
	$("button[name=submitId]").click(function(){
		var farmerId = $("input[name=farmerId]").val();
		var regexChk = /^\d{0,8}$/;
		if (farmerId.match(regexChk) == null) {
			alert("improper farmer id");
			return;
		}
		var data = {
			farmId: farmerId,
		};
		
		
		$.ajax({
			type: "POST",
			datatype: "json",
			data: data,
			url: "http://localhost/farm/back/evalGetFarmer.php",
			success: function (data) {
				alert(data);
				var x = JSON.parse(data);	/* this does not check if the farmer exists or not, if I first set a ok farmer,
											then a non-existant one, the details still show for the previous, hide & clear them*/
				
				var name = x['farmer'][0][0] +" "+x['farmer'][0][1];
				$("#farmerName").html(name);
				$("#farmerDetails").show();
				$("#tm").show();
				$("#order_table_container").show();
				
				var i=2,row=0;
				for(row;row<4;row++){
					var a = "<td>"+x['farmer'][0][i++]+"</td>";
					var b = "<td>"+x['farmer'][0][i++]+"</td>";
					var c = "<td>"+x['farmer'][0][i++]+"</td>";						
					$("tr[name='"+row+"']").html(a+b+c);					
				}
				row=0;

				while(x['orders'][row][0]){
					var a = "<tr><td>"+x['orders'][row][0]+"</td>";
					var b = "<td>"+x['orders'][row][1]+"</td>";
					var c = "<td>"+x['orders'][row][2]+"</td>";
					var d = "<td>"+x['orders'][row][3]+"</td>";
					var e = "<td>"+x['orders'][row][4]+"</td>";
					var f = "<td>"+x['orders'][row][5]+"</td></tr>";
					row++;

					$("table[name=order_table]").append(a+b+c+d+e+f);
					
				}
			},
			error: function (data) {
				alert("something went wrong");
				alert(JSON.stringify(data));
			},
		});
	});

	
	var chkOrder = function () {
		var ono = $("#order_table_container input[name=order]").val();
		if ($("table[name=order_table] tr").children("td:first-child").filter(function() {return $(this).text() === ono;}).length > 0){
			$("#newtm_container").show();
		} else {
			$("#newtm_container").hide();
		}
	}
	
	$("#order_table_container input[name=order]").change(chkOrder);
	$("#order_table_container input[name=order]").keyup(chkOrder);
	
	$("button[name=updateMatrix]").click(function(){
		
		var upd = {
			aa :$("input[name=aa]").val(),
			ba :$("input[name=ba]").val(),
			ca :$("input[name=ca]").val(),
			ab :$("input[name=ab]").val(),
			bb :$("input[name=bb]").val(),
			cb :$("input[name=cb]").val(),
			ac :$("input[name=ac]").val(),
			bc :$("input[name=bc]").val(),
			cc :$("input[name=cc]").val(),
			ar :$("input[name=ar]").val(),
			br :$("input[name=br]").val(),
			cr :$("input[name=cr]").val(),		
			farmid:$("input[name=farmerId]").val(), 
			orderid: $("input[name=order]").val(),		
		};
		$.ajax({
			type: "POST",
			datatype: "json",
			data: upd,
			url: "http://localhost/farm/back/updateTrustMatrix.php",
			success: function (data) {
				alert(data);
			},
			error: function (data) {
				alert("something went wrong");
				alert(JSON.stringify(data));
			},
		});
		
	});
});