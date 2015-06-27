$(document).ready(function() {
	// show and hide share panel
	$("#sharePanelShow,#sharePanelHide").click(function() {
		if ($("#sharePanel").css("display") == "none")
			$("#sharePanel").show();
		else
			$("#sharePanel").hide();
	});
});