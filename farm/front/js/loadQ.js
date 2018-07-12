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
					Html += '<tr class="row100 body xxx" id="rno'+(i+1)+'">';
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
		$.ajax({
			type: "POST",
			datatype: "json",
			data: null,
			url: "http://localhost/farm/back/loadQdetails.php",
			success: function (data) {
				detailedOrder = JSON.parse(data);
			},
			error: function (data) {
				detailedOrder = JSON.parse(data);
				alert(JSON.stringify(x));
			},
		});

	});	
	 $('body').on('mouseenter', 'tr.body', function () {
		 // alert(1);
		var rid = $(this).attr("id");
		rname = rid.substring(3);
		var food = $("#rno"+rname+" td.column1").html();
		// alert(food);
		var time = $("#rno"+rname+" td.column3").html();
		var har  = $("#rno"+rname+" td.column2").html();
		var cost = $("#rno"+rname+" td.column4").html();
		var logistics =$("#rno"+rname+" td.column5").html();
		var rank = $("#rno"+rname+" td.column6").html();
		// alert(rank);
		var a = detailedOrder['det'][rname-1][5];
		var b = detailedOrder['det'][rname-1][6];
		var c = detailedOrder['det'][rname-1][7];
		var del = detailedOrder['det'][rname-1][11];
		//$("div[name=orderDetails] span[name=food]").html(food);
		$("div[name=orderDetails] span[name=time]").html(time);
		$("div[name=orderDetails] span[name=harvest]").html(har);
		//$("div[name=orderDetails] span[name=deliver]").html(del);
		//$("div[name=orderDetails] span[name=cost]").html(cost);
		$("div[name=orderDetails] span[name=a]").html(a);
		$("div[name=orderDetails] span[name=b]").html(b);
		$("div[name=orderDetails] span[name=c]").html(c);
		$("div[name=orderDetails] span[name=transport]").html(logistics);
		//$("div[name=orderDetails] span[name=rank]").html(rank);				
		//alert(a);
		$(this).css('z-index', 3);
		$("#overlayContainer").show();
		$("#overlay").show();
		$("#overlay").css('z-index', 4);
   });
   
   $('body').on('mouseleave', 'tr.body', function () {
	   $("#overlayContainer").hide();
		$("#overlay").hide();
		$("#overlay").removeClass("high-10");
		$(this).css('z-index', 0);
   });
   
});