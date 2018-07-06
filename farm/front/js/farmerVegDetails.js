$(Document).ready(function () {		

	var chkok = function () {
		if (($("#orderForm input[name=quantity]:valid").length > 0) && ($("#orderForm input[name=price]:valid").length > 0)){
			var t1 = (new Date($("#orderForm input[name = harvDate]").val() +" "+ $("#orderForm input[name = harvTime]").val()));
			var t2 = (new Date($("#orderForm input[name = colDate]").val() +" "+ $("#orderForm input[name = colTime]").val()));
			var now = new Date();
			
			var delt = t2 - t1;
			if (delt !== delt) {
				//alert ("dates not specified properly");
				$("#orderForm button").prop("disabled", true);
			} else {
				if (delt < 0){
					//alert("dates of harvesting cannot be after the dates of collection");
					$("#orderForm button").prop("disabled", true);
				} else if (t2 - now < 0) {
					//alert("please enter a valid date for collection");
					$("#orderForm button").prop("disabled", true);
				}
				else {
					$("#orderForm button").prop("disabled", false);
				}
			}
		}
		else {
			$("#orderForm button").prop("disabled", true);
		}
	}
	
	$("#orderForm input[name=quantity]").change(chkok);
	$("#orderForm input[name=quantity]").keyup(chkok);
	$("#orderForm input[name=price]").change(chkok);
	$("#orderForm input[name=price]").keyup(chkok);
	$("#orderForm input[name=harvDate]").change(chkok);
	$("#orderForm input[name=harvDate]").keyup(chkok);
	$("#orderForm input[name=harvTime]").change(chkok);
	$("#orderForm input[name=harvTime]").keyup(chkok);
	$("#orderForm input[name=colDate]").change(chkok);
	$("#orderForm input[name=colDate]").keyup(chkok);
	$("#orderForm input[name=colTime]").change(chkok);
	
	$("#orderForm button").click( function () {
		var fvid = $("#vegDetails").attr('name');
		var t1 = (new Date($("#orderForm input[name = harvDate]").val() +" "+ $("#orderForm input[name = harvTime]").val()));
		var t2 = (new Date($("#orderForm input[name = colDate]").val() +" "+ $("#orderForm input[name = colTime]").val()));
		var qty = $("#orderForm input[name=quantity]:valid").val();
		var price = $("#orderForm input[name=price]:valid").val();
		
		var a = $("#slider").slider("values",0);
		var b = ($("#slider").slider("values", 1) - $("#slider").slider("values", 0));
		var c = 100 - $("#slider").slider("values", 1);
		
		var sellOrder = {
			fvid: fvid,
			th: t1,
			tc: t2,
			qty: qty,
			price: price,
			a: a,
			b: b,
			c: c
		};
		$.ajax({
			type: "POST",
			datatype: "json",
			data: sellOrder,
		});
	});

	$(".imageSpace").on("click", ".imgbox", function () {
		//alert("hello");
		var fvid = ($(this).attr('id')).slice(2);
		var src = $(this).children().attr('src');
		var vdata = {
			id: fvid,
		};
		$.ajax({
			type: "POST",
			datatype: "json",
			data: vdata,
			url: "http://localhost/farm/back/getVegDetails.php",
			success: function (data) {
				var x = JSON.parse(data);		// WHY THE HELL IS DATA NOT ALREADY A JSON OBJECT DESPITE USING json_encode IN PHP?? 
				if (x['status'] == "ok"){
					var name1 = x['name1'];
					var name2 = x['name2'];
					var newHtml = "";
					newHtml += '<img src = "'+ src +'" name = "'+fvid+'"></img>';
					newHtml += '<div id = "fvname">';
					if (name2 == ""){
						newHtml += name1;
					} else {
						newHtml += name1 + "<br />(" + name2 + ")";
					}
					newHtml += '</div>';
					$(".place #vegDetails .dynamic").html(newHtml);
					$("#orderDetails").show();
					$(".place #vegDetails .const").show();
					$("#vegDetails").attr('name', fvid);
					$("#chutiyaKta img").attr('src', src);
				} else {
					alert("something not ok in data recieved from backend");
				}
			},
			error: function (data) {
				alert("something went wrong while recieving data from getVegDetails.php");
				alert(JSON.stringify(data));
			},
		});
	});
/*
	// the clicking of a radio cannot be undone, therefore k1 starts as false and turns true on the first click
	$("#orderForm input:radio").click(function () {
		k1 = true;
		if (k1 && k2) {
			detailok1 = true;
			$("#orderForm button[name = confirm]").prop('disabled', !(detailok1 && detailok2 && detailok3));
		}
	});
	
	$("#orderForm input[type=number]").keyup(chkqty);
	$("#orderForm input[type=number]").change(chkqty);
	$("#orderForm input[type = date]").change(chkDate);*/
});
