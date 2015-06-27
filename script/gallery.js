$(document).ready(function() {
	var row = 7;
	var rows = Math.ceil($("#gallerySlide>.slide").size() / row);
	
	$("#gallerySlide").cycle({
		fx:"fade",
		timeout:5000,
		pager:".thumbnails .pager",
		fastOnEvent:350,
		slideExpr:".slide",
		pagerAnchorBuilder:function(index,slide) {
			return "<div class=\"thumb link\"><img src=\"" + $(slide).find("img").attr("src").replace(".jpg","_thumb.jpg") + "\" alt=\"\"/></div>";
		}
	});
	
	// add in empty thumbnails
	if ($(".thumbnails .pager .thumb").size() % row != 0) {
		var i;
		var end = (row -1) - $(".thumbnails .pager .thumb").size() % row;
		for (i = 0;i <= end;i ++)
			$(".thumbnails .pager .thumb").last().after("<div class=\"thumb\"></div>");
	}
	
	// add in row end thumbnails
	$(".thumbnails .side").each(function() {
		var i;
		for (i = 0;i < rows;i ++) {
			$(this).append("<div class=\"thumb\"></div>");
		}
	});
	
	// randomise thumbnail colours
	var colours = new Array("E4DDCD","B5B5B5","E3E4D2","999999","D5D1AC","C6C5B8","C4B8A1","FFFFFF");
	$(".thumb:not(.link)").each(function() {
		var colour = "#" + colours[Math.floor((Math.random() * (colours.length - 1)) + 1)];
		$(this).css("background-color",colour); 
	});
	
	// slideshow controls
	$("#gallerySlide").hover(function() {
		$(this).cycle("pause");
		$("#gallerySlide .arrow.prev").css("left","-42px");
		$("#gallerySlide .arrow.next").css("right","-42px");
		$("#gallerySlide .arrow").show();
		$("#gallerySlide .arrow.prev").animate({"left":"15px"},250);
		$("#gallerySlide .arrow.next").animate({"right":"15px"},250);
	},
	function() {
		$(this).cycle("resume");
		$("#gallerySlide .arrow").hide();
	});
	
	$(".arrow.prev").click(function() {
		$("#gallerySlide").cycle("prev");
	});
	$(".arrow.next").click(function() {
		$("#gallerySlide").cycle("next");
	});
});