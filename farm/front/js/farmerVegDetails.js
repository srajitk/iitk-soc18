$(Document).ready(function () {		

	var chkok = function () {
		if (! isNaN(Date.parse($("#orderForm input[name = colDate]").val() +" "+ $("#orderForm input[name = colTime]").val()))) {
			if (! isNaN(Date.parse($("#orderForm input[name = harvDate]").val() +" "+ $("#orderForm input[name = harvTime]").val()))) {
				if (($("#orderForm input[name=quantity]:valid").length > 0) && ($("#orderForm input[name=price]:valid").length > 0)){
					var t1 = (new Date($("#orderForm input[name = harvDate]").val() +" "+ $("#orderForm input[name = harvTime]").val()));
					var t2 = (new Date($("#orderForm input[name = colDate]").val() +" "+ $("#orderForm input[name = colTime]").val()));
					var now = new Date();
					
					var delt = t2 - t1;
					if (delt !== delt) {
						//alert ("dates not specified properly");
						$("#orderForm button[name = confirm]").prop("disabled", true);
					} else {
						if (delt < 0){
							//alert("dates of harvesting cannot be after the dates of collection");
							$("#orderForm button[name = confirm]").prop("disabled", true);
						} else if (t2 - now < 0) {														/* To change, queue entries may only occur 7 days hence */
							//alert("please enter a valid date for collection");
							$("#orderForm button[name = confirm]").prop("disabled", true);
						}
						else {
							// what if $("#fileToUpload") IS EMPTY ? @Srajit
							$("#orderForm button[name = confirm]").prop("disabled", false);
						}
					}
				}
				else {
					$("#orderForm button[name = confirm]").prop("disabled", true);
				}
			}
			else {
				$("#orderForm button[name = confirm]").prop("disabled", true);
			}
		}
		else {
			$("#orderForm button[name = confirm]").prop("disabled", true);
		}
	}
	
	var chkokQ = function () {
		var t2 = (new Date($("#orderForm input[name = colDate]").val() +" "+ $("#orderForm input[name = colTime]").val()));
		var now = new Date();
		if (! isNaN(Date.parse($("#orderForm input[name = colDate]").val() +" "+ $("#orderForm input[name = colTime]").val()))) {
			if (t2 - now < 0) {
				$("#orderForm button[name = seeQueue]").prop("disabled", true);
			}
			else {
				$("#orderForm button[name = seeQueue]").prop("disabled", false);
			}
		} else {
			$("#orderForm button[name = seeQueue]").prop("disabled", true);
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
	$("#orderForm input[name=colDate]").change(chkokQ);
	$("#orderForm input[name=colDate]").keyup(chkokQ);
	$("#orderForm input[name=colTime]").change(chkokQ);

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
			url: "http://localhost/farm/back/getVegDetailsF.php",
			success: function (data) {
				//alert("hello");
				//alert(data);
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
});
