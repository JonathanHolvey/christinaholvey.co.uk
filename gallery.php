<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<title>Christina Holvey &#8226; Gallery</title>
	<meta http-equiv="generator" content="Notepad++" />
	<meta name="created" content="January 2010" />
	<meta http-equiv="content-type" content="text/html;charset=utf-8" />
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="Jonathan Holvey" />
  
	<?php include("resources.php"); ?>
	<script type="text/javascript" src="script/gallery.js"></script>
</head>
<body>
	<div id="mask"></div>
	<div id="loading">Loading...</div>
	<div id="imageBox">
		<img id="watermark" src="images/watermark.png" alt="Copyright Christina Holvey"/>
		<div class="close" title="Close"></div>
		<div id="imageHolder"></div>
		<div id="imageInfo"></div>
	</div>

	<?php include("header.php"); ?>
	<script type="text/javascript">
		document.getElementById("galleryLink").src = "images/gallery_active.png";
		// sets gallery page which is passed to gallery building script
		var page = "<?php echo $_GET["page"] ?>";
	</script>
	<div id="main" style="overflow:hidden">
		<div class="galleryPages"></div>
		<div id="galleryContainer"></div>
	</div>
	
	<?php include("footer.php"); ?>
