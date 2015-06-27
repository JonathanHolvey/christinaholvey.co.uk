<?php
	require_once("script/functions.php");

	$pictures = simplexml_load_file("pictures.xml");
	
	$maxWidth = 900; // max image width
	$maxHeight = 500; // max image height
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<base href="<?php echo goUp(2) ?>"/>
		<title>Christina Holvey - <?php echo ucfirst($_GET["view"]) ?></title>
		<meta name="robots" content="NOODP"/> <!-- prevent search engines from using ODP info in results -->
		<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
		<?php include("resources.php") ?>
		<script type="text/javascript" src="script/gallery.js"></script>
		<script type="text/javascript">$(document).ready(function() {$("#link_<?php echo $_GET["view"] ?>").addClass("active");});</script>
	</head>
	<body>
		<?php include("header.php") ?>
		<div id="gallerySlide">
			<div class="arrow prev"></div>
			<div class="arrow next"></div>
			<?php
				foreach ($pictures as $picture) {
					foreach ($picture->view as $view) {
						if ($view["type"] == "gallery" and $view["group"] == $_GET["view"] and $view["hidden"] != "true") {
							$file = $pictures["path"] . $view->file;
							echo "<div class=\"slide\" style=\"" . margins($file, $maxWidth, $maxHeight) . "\">
								<div class=\"rotatedInfo\">
									<div class=\"details\">" . $view->width . " &#215; " . $view->height . " cm " . strtolower($view->medium) . "</div>" . $picture->title . "
								</div>
								<img src=\"" . $file . "\" alt=\"\"/>
							</div>";
						}
						break;
					}
				}
			?>
		</div>
		<div class="thumbnails">
			<div class="side left"></div>
			<div class="pager"></div>
			<div class="side right"></div>
		</div>
		<?php include("footer.php") ?>
	</body>
</html>