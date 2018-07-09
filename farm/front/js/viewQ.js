$(Document).ready(function () {
	$("#orderForm button[name = seeQueue]").click(function () {
		var t2 = (new Date($("#orderForm input[name = colDate]").val() +" "+ $("#orderForm input[name = colTime]").val()));
		var now = new Date();
		if (! isNaN(Date.parse($("#orderForm input[name = colDate]").val() +" "+ $("#orderForm input[name = colTime]").val()))) {
			if (t2 - now > 0) {
				$("#queueModal").show();
				var fvid = $("#vegDetails").attr('name');
				//alert(t2);
				var tzoffset = (new Date()).getTimezoneOffset() * 60000;
				var localISOTime = (new Date(t2 - tzoffset)).toISOString().slice(0, -5).replace('T', ' ');
				var details = {
					fvid: fvid,
					date: localISOTime,
				};
				//alert(localISOTime);
				// alert(JSON.stringify(details));	
				$.ajax({
					type: "POST",
					datatype: "json",
					data: details,
					url: "http://localhost/farm/back/loadVegQ .php",
					success: function (data) {
						// alert(data);
						var x = JSON.parse(data);
						//alert(JSON.stringify(x));
						var Html = "";
						for (var i = 0; i < x['tbl'].length; i++){
							Html += '<tr class="row100 body xxx" id="rno'+(i+1)+'">';
							if (x['tbl'][i][5] == 1) {
								x['tbl'][i][5] = 'ours';
							} else {
								x['tbl'][i][5] = 'self';
							}
							if (x['tbl'][i][6] == null) {
								x['tbl'][i][6] = 'queue not ready';
							}
							for (var j = 0; j < x.tbl['0'].length; j++){
								Html += '<td class="cell100 column'+(j+1)+'"> '+x['tbl'][i][j] +' </td>';
							}
						}
						$(".Vqueue .table100-body tbody").html(Html);
					},
					error: function (data) {
						x = JSON.parse(data);
						alert(JSON.stringify(x));
					},
				});
			}
		} 
	});
	
	$("#queueModal span.close").click(function () {
		$("#queueModal").hide();
	});
});