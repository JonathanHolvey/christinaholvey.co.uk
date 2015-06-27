<?php
	$pictures = simplexml_load_file("pictures.xml");
	$blog = simplexml_load_file("blog.xml");
	require_once("script/functions.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Christina Holvey - Blog</title>
		<meta name="robots" content="NOODP"> <!-- prevent search engines from using ODP info in results -->
		
		<?php include("resources.php"); ?>
		<?php include("script/printBlog.php"); ?>
		<script type="text/javascript">$(document).ready(function(){$("#link_blog").addClass("active");});</script>
	</head>
	<body>
		<?php include("header.php"); ?>
		<div class="twoThirds">
			<div class="title blog"><?php echo $blog->title ?></div>
			<div class="subtitle blog"><?php echo $blog->subtitle ?></div>
			<?php 
				foreach ($blog->post as $post)
					printBlog($post, $blog->url, $blog->author);
			?>
			<div class="more" style="margin-bottom:10px">Read more posts and leave comments at <a href="<?php echo $blog->url ?>">Blogspot.com</a></div>
			<div class="more rss" style="margin-bottom:35px"><a href="<?php echo $blog->rss ?>">Subscribe via RSS</a></div>
		</div>
		<?php include("footer.php"); ?>
	</body>
</html>