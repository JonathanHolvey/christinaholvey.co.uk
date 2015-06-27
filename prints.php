<?php 
	require_once("script/functions.php");
	$pictures = simplexml_load_file("pictures.xml");
	$shop = simplexml_load_file("shop.xml");
	$maxWidth = 400;
	$maxHeight = 400;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Christina Holvey - Prints</title>
		<meta name="robots" content="NOODP"/> <!-- prevent search engines from using ODP info in results -->
		<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
		<?php include("resources.php"); ?>
		<script type="text/javascript">$(document).ready(function(){$("#link_prints").addClass("active");});</script>
	</head>
	<body>
		<?php include("header.php") ?>
		<div class="title">limited edition prints</div>
		<p>The selection of paintings listed on this page are available as limited edition prints through Etsy. They measure 22&nbsp;&#215;&nbsp;22&nbsp;cm and are supplied ready to frame, in a 30&nbsp;&#215;&nbsp;30&nbsp;cm mount.</p>
		<div class="prints">
			<?php
				// create each print listing using info from pictures.xml and shop.xml
				foreach ($pictures->xpath("picture[view[@type=\"print\"]]") as $picture) {
					$view = $picture->xpath("view[@type=\"print\"]");
					$view = $view[0];
					if ($view["hidden"] != "true" and count($shop->xpath("item[@id=\"" . $view->etsy . "\"]")) > 0) {
						$item = $shop->xpath("item[@id=\"" . $view->etsy . "\"]");
						$item = $item[0];
						$file = $pictures["path"] . $view->file;
						echo "<div class=\"print\">
							<div class=\"holder\" style=\"" . margins($file, $maxWidth, $maxHeight) . "\">
								<div class=\"rotatedInfo\">" . $picture->title . "</div>
								<img src=\"" . $file . "\" alt=\"\"/>
								<div class=\"button\"><a href=\"" . $item->url . "\"><span class=\"buy\">buy on Etsy</span><span class=\"price\"> " . currency($item->currency) . "&thinsp;" . $item->price . "&thinsp;<small>" . $item->currency . "</small></span></a></div>
							</div>
						</div>";
					}
				}
			?>
		</div>
		<p class="more">See my shop at <a href="<?php echo $shop["url"] ?>">Etsy.com</a></p>
		<?php include("footer.php") ?>
	</body>
</html>