<?php
	$pictures = simplexml_load_file("pictures.xml");
	$tweets = simplexml_load_file("tweets.xml");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Christina Holvey - Contact</title>
		<meta name="robots" content="NOODP"/> <!-- prevent search engines from using ODP info in results -->
		<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
		<?php include("resources.php") ?>
		<script type="text/javascript">$(document).ready(function(){$("#link_contact").addClass("active");})</script>
	</head>
	<body>
		<?php include("header.php") ?>
		<div class="title">Contact me</div>
		<p>If you would like to order original paintings or prints, discuss commissions or provide feedback on my artwork or website please contact me using the email address below.</p>
		<p style="text-align:center"><a href="mailto:contact@christinaholvey.co.uk">contact@christinaholvey.co.uk</a></p>
		<p class="more"><a href="<?php echo $tweets["url"] ?>">Follow me on Twitter</a></p>
		<div class="pictureBox">
			<img src="images/gallery/bullFinchOClock_thumb.jpg" alt=""/>
			<img src="images/gallery/inTheMidnightGarden_thumb.jpg" alt=""/>
			<img src="images/gallery/theGreatEscape_thumb.jpg" alt=""/>
			<img src="images/gallery/outsideTap_thumb.jpg" alt=""/>
		</div>
		<?php include("footer.php") ?>
	</body>
</html>