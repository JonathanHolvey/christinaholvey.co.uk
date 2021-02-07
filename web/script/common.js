$(document).ready(function() {
	// add lines to titles
	$(".title").each(function() {
		$(this).after("<div class=\"line\"/>");
	});
	
	// correct rotated title positions
	$(".rotatedInfo").each(function() {
		if (ieVersion() == 7) {
			$(this).css("filter","progid:DXImageTransform.Microsoft.BasicImage(rotation=3)");
			$(this).css("left",-1 + $(this).width() / -2);
			$(this).css("bottom",$(this).width() / 2);
			$(this).css("background","white");
		}
		else if (ieVersion() == 8) {
			$(this).css("filter","progid:DXImageTransform.Microsoft.BasicImage(rotation=3)");
			$(this).css("left","-18px");
			$(this).css("bottom",-18 + $(this).height());
			$(this).css("background","white");
		}
		// for standards compliant browsers, including IE9
		else {
			$(this).css("left",$(this).width() / -2);
			$(this).css("bottom",$(this).width() / 2);
		}
		$(this).show();
	});

	// add quote marks to quotes
	$(".quote").each(function() {
		$(this).prepend("<div class=\"pull open\">&ldquo;</div>").append("<div class=\"pull close\">&rdquo;</div>");
	});
	
	// hide blog comments
	$(".comments").each(function() {
		$(this).children(".comment").first().css("display","block");
	});
	
	// show all comments
	$(".show").click(function() {
		$(this).parent().parent().children(".comment").css("display","block");
		$(this).hide();
		var html = $(this).parent().html().replace(" - ",":");
		$(this).parent().html(html);
	});
});