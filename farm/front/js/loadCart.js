$(Document).ready(function () {
	$('button[name=cart]').click(function (){
		$.ajax({
			type: "POST",
			datatype: "json",
			data: null,
			url: "http://localhost/farm/back/loadBuyerCart.php",
			success: function (data) {
				var x = JSON.parse(data);		// AGAIN, WHY IS THIS NOT A JSON OBJECT LIKE SOME OF THE OTHERS
				
				var Html = "";
				for (var i = 0; i < x['tbl'].length; i++){
					Html += '<tr class="row100 body">';
					for (var j = 0; j < x.tbl['0'].length; j++){
						Html += '<td class="cell100 column'+(j+1)+'"> '+x['tbl'][i][j] +' </td>';
					}
				}
				$(".cart .table100-body tbody").html(Html);
			},
			error: function (data) {
				x = JSON.parse(data);
				alert(JSON.stringify(x));
			},
		});
	});
});