$(Document).ready(function () {		
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
				x = JSON.parse(data);		// WHY THE HELL IS DATA NOT ALREADY A JSON OBJECT DESPITE USING json_encode IN PHP?? 
				if (x['status'] == "ok"){
					var name1 = x['name1'];
					var name2 = x['name2'];
					var newHtml = "";
					newHtml += '<img src = "'+ src +'"></img>';
					newHtml += '<div id = "fvname">';
					if (name2 == ""){
						newHtml += name1;
					} else {
						newHtml += name1 + "<br />(" + name2 + ")";
					}
					newHtml += '</div>';
					$(".place #vegDetails .dynamic").html(newHtml);
					$(".place #vegDetails .const").show();
					$("#vegDetails").attr('name', fvid);
				}
			},
			error: function (data) {
				alert("something went wrong while recieving data from getVegDetails.php");
				alert(JSON.stringify(data));
			},
		});
	});
});
