$(Document).ready(function(){
	$("#logout").click(function () {
		$.ajax({
			type: "POST",
			url: "http://localhost/farm/back/logout.php",
			data: null,
			dataType: "script",
			success: function () {
				window.location.replace("http://localhost/farm/front/index.php");
			},
			error: function (data) {
				alert(JSON.stringify(data));
				alert("something went wrong, logout unsuccessful");
			},
		});
	});
});