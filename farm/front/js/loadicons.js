$(Document).ready(function () {
	$(".cart .itemselector .tablinks").click(function () {
		$(".cart .tabcontent").hide();
		$(".cart .tabcontent").removeClass("active");
		$(".cart .itemselector .tablinks").removeClass("active");
		
		var name = $(this).attr("name");
		$(this).addClass('active');

		$(".cart #" + name).show();
		$(".cart #" + name).addClass("active");
		
		if ($(".cart #"+ name + " .imageSpace").html() == ""){
			
			var tabData = {
				tabname: name,
			};
			$.ajax({
				type: "POST",
				datatype: "json",
				data: tabData,
				url: "http://localhost/farm/back/loadIcons.php",
				success: function (data) {
					$(".cart #"+ name + " .imageSpace").html(data);
				},
				error: function (data) {
					alert("something went wrong while recieving data from loadIcons.php");
					alert(JSON.stringify(data));
				},
			});
		}
	});
});