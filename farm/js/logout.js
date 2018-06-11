$(Document).ready(function(){
	$("#logout").click(function () {
		$.ajax({
			type: "POST",
			url: "./back/logout.php",
			data: null,
			dataType: "script",
			success: function () {
				window.location.replace("./index.php");
			},
			error: function () {
				alert("something went wrong, logout unsuccessful");
			},
		});
	});
});