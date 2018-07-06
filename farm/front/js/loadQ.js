$(Document).ready(function () {
	$('button[name=queue]').click(function (){
		$.ajax({
			type: "POST",
			datatype: "json",
			data: null,
			url: "http://localhost/farm/back/loadFarmerQ.php",
			success: function (data) {
				var x = JSON.parse(data);		// AGAIN, WHY IS THIS NOT A JSON OBJECT LIKE SOME OF THE OTHERS
				
				var Html = "";
				for (var i = 0; i < x['tbl'].length; i++){
					Html += '<tr class="row100 body">';
					if (x['tbl'][i][4] == 1) {
						x['tbl'][i][4] = 'ours';
					} else {
						x['tbl'][i][4] = 'self';
					}
					if (x['tbl'][i][5] == null) {
						x['tbl'][i][5] = 'queue not ready';
					}
					for (var j = 0; j < x.tbl['0'].length; j++){
						Html += '<td class="cell100 column'+(j+1)+'"> '+x['tbl'][i][j] +' </td>';
					}
				}
				$(".queue .table100-body tbody").html(Html);
			},
			error: function (data) {
				x = JSON.parse(data);
				alert(JSON.stringify(x));
			},
		});
	});
});