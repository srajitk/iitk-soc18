$(Document).ready(function () {
	$(".place .itemselector .tablinks").click(function () {
		$(".place .tabcontent").hide();
		$(".place .tabcontent").removeClass("active");
		$(".place .itemselector .tablinks").removeClass("active");
		
		var name = $(this).attr("name");
		$(this).addClass('active');

		$(".place #" + name).show();
		$(".place #" + name).addClass("active");
		
		if ($(".place #"+ name + " .imageSpace").html() == ""){
			
			var tabData = {
				tabname: name,
			};
			$.ajax({
				type: "POST",
				datatype: "json",
				data: tabData,
				url: "http://localhost/farm/back/loadIcons.php",
				success: function (data) {
					$(".place #"+ name + " .imageSpace").html(data);
//					alert("hello");
				},
				error: function (data) {
					alert("something went wrong while recieving data from loadIcons.php");
					alert(JSON.stringify(data));
				},
			});
		}
	});
	$("#faq").click(function(){		// why the fuck is this over here???
		$("#CONTACT").toggle();
		//$(this).parent().toggle();
		$("#FAQ").toggle();
	});
	$("#cntct").click(function(){
		$("#FAQ").toggle();
		//$(this).parent().toggle();
		$("#CONTACT").toggle();
	});
});