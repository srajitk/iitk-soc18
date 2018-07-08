$(Document).ready(function () {		
	var detailok1 = false;		// qlty, qty
	var detailok2 = false;		// dates
	var detailok3 = true;		// misc

	var k1 = false;
	var k2 = false;

	var chkqty = function () {
		k2 = ($("#orderForm input[type=number]:valid").length > 0);
		if (k1 && k2){
			detailok1 = true;
			$("#orderForm button[name = confirm]").prop('disabled', !(detailok1 && detailok2 && detailok3));
		}

		if (k1 && !k2) {
			detailok1 = false;
			$("#orderForm button[name = confirm]").prop('disabled', true);
		}
	}

	var chkDate = function () {
		var dt = new Date($("#orderForm input[type = date]").val());
		var min = new Date();
		var max = new Date();
		min.setDate(min.getDate() + 1);
		max.setDate(max.getDate() + 90);
		if (min < dt && max > dt){
			detailok2 = true;
			$("#orderForm button[name = confirm]").prop('disabled', !(detailok1 && detailok2 && detailok3));
		} else {
			detailok2 = false;
			$("#orderForm button[name = confirm]").prop('disabled', true);
		}
	}

	$(".imageSpace").on("click", ".imgbox", function () {
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
					$("#orderForm span.units").html(x['uts']);
					$("#orderForm input[name = quantity]").attr('min', x['min']);
					$("#orderForm input[name = quantity]").attr('max', x['max']);
					$("#orderForm input[name = quantity]").attr('step', x['step']);
					$("#orderDetails .static").html("Expected price of " + x['min'] + x['uts'] + " is<br> A: Rs " + x['utPrice'] + "<br>  B: Rs " +x['utPrice']*0.75+"<br> C: Rs "+x['utPrice']*0.4);
					$("#orderDetails .hidden p[name=cost]").html(x['utPrice']);
					$("#orderDetails .hidden p[name=ut]").html(x['min']);
					chkDate();
					chkqty();
					$("#paisa").html("");
					$("#paisa").append(x['utPrice']);
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
	$("#orderForm input[type = date]").change(chkDate);
});
