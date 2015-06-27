function basename(path) {
	return path.replace(/\\/g,'/').replace( /.*\//, '' );
}

function toTitleCase(toTransform) {
	return toTransform.replace(/\b([a-z])/g, function (_, initial) {
		return initial.toUpperCase();
	});
}

var xmlPictures;
$(document).ready(function() {
	
	// load xml file
	$.ajax({
		type:"GET",
		url:"pictures.xml",
		dataType:"xml",
		success:function(xml) {
			xmlPictures = xml;
			
			// find picture type - page is passed from gallery.php
			if (page == "")
				page = $(xmlPictures).children().children()[0].tagName;
			
			// create page links
			$(xmlPictures).children().children().each(function() {
				$(".galleryPages").append("<a href=\"?page=" + this.tagName + "\">" + toTitleCase(this.tagName) + "</a>");
			});
			
			// create thumbnails
			$(xmlPictures).find(page).find("picture").each(function() {
				// create html string for gallery item
				var galleryString = "<div class=\"galleryItem\"><img class=\"thumbnail\" src=\"images/gallery/" + $(this).find("image").text().replace(".jpg","_thumb.jpg") + "\" alt=\"\"/><div class=\"galleryInfo\"><i>" + $(this).find("title").text() + "</i><br/>" + $(this).find("medium").text();
				if ($(this).attr("width") && $(this).attr("height"))
					galleryString += "<br/>" + $(this).attr("width") + " &#215; " + $(this).attr("height") + " cm";
				if ($(this).attr("price") && $(xml).find("pictures").attr("showPrices") == "yes")
					galleryString += "<div class=\"price\">&pound;" + $(this).attr("price") + "</div>";
				if ($(this).attr("sold") == "yes")
					galleryString += "<div class=\"sold\">Sold</div>";
				else if ($(this).attr("sold") == "nfs")
					galleryString += "<div class=\"sold\">NFS</div>";
				// add item to gallery
				$("#galleryContainer").append(galleryString + "</div>");
			});
			
			// show image when thumbnail is clicked
			$(".thumbnail").click(function() {
				var src = $(this).attr("src").replace("_thumb","");
				showImage(src);
			});
			
			// hide image when cross is clicked
			$("#imageBox .close,#mask").click(function() {
				hideImage();
			});

			// disable right click
			$("#galleryContainer .galleryItem,#imageBox").bind("contextmenu",function(e){
				return false;
			});
		}
	});
	
	$(window).resize(function() {
		hideImage();
	});
});

// show chosen image
function showImage(src) {
	var maxSize = 800; // maximum image size in px
	
	$("#mask").css("opacity",0.5);
	$("#mask").show();
	$("#loading").show();
	$("#imageBox").css("visibility","hidden");
	$("#imageBox").show();
	
	// create image
	$("#imageHolder").html("<img src=\"" + src + "\" alt=\"\"/>");
	// find info about image
	$(xmlPictures).find("picture").each(function() {
		if ($(this).find("image").text() == basename(src)) {
			var title = $(this).find("title").text();
			$("#imageInfo").html(title);
			return false;
		}
	});
	
	// resize image, watermark and margins after image is loaded
	$("#imageHolder img").imagesLoaded(function(img) {	
		var infoHeight = $("#imageInfo").outerHeight();
		// set image size - always less that value of maxSize
		var imageHeight = 0.8 * $(window).height() - infoHeight;
		var imageWidth = 0.9 * $(window).width();
		if (imageHeight > maxSize)
			imageHeight = maxSize;
		if (imageWidth > maxSize)
			imageWidth = maxSize;
		// set image size
		$(img).css({
			"maxHeight":imageHeight,
			"maxWidth":imageWidth
		});
		$("#imageInfo,#imageBox").css("width",$(img).width());
		// set margins
		$("#imageBox").css({
			"top":($(window).height() - $("#imageBox").outerHeight()) / 2,
			"left":($(window).width() - $("#imageBox").outerWidth()) / 2
		});
		// set watermark position
		$("#watermark").css("top",($("#imageHolder").height() - $("#watermark").height()) / 2);
		// show image
		$("#loading").hide();
		$("#imageBox").css("visibility","visible");
	});
}

function hideImage() {
	$("#mask,#imageBox").hide();
}