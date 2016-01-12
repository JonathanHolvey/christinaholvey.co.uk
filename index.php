<?php
	require_once("script/printNews.php");
	require_once("script/printTweet.php");
	require_once("script/printBlog.php");
	require_once("script/functions.php");


	$pictures = simplexml_load_file("pictures.xml");
	$news = simplexml_load_file("news.xml");
	$tweets = simplexml_load_file("tweets.xml");
	$blog = simplexml_load_file("blog.xml");
	$maxEvents = 1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Christina Holvey</title>
		<meta http-equiv="generator" content="Sublime Text 3"/>
		<meta name="created" content="June 2012"/>
		<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
		<meta name="description" content="Contemporary Bristol based artist and painter, producing figurative and texture-led artwork."/>
		<meta name="keywords" content="art,paintings,sheep,bath,artist,wildlife"/>
		<meta name="author" content="Jonathan Holvey"/>
		<meta name="google-site-verification" content="sDzEOXBPepmTTKiLBoF4OlWM-V92IEwSE0IphzpaDnQ"/>
		<meta name="robots" content="NOODP"/> <!-- prevent search engines from using ODP info in results -->
		<?php include("resources.php"); ?>
		
		<script type="text/javascript">
			$(document).ready(function(){$("#link_home").addClass("active");});
				$("#homeSlide").cycle({
				fx:"fade",
				timeout:5000,
			});
		</script>
		<style type="text/css">
			.post .divider,.comments {
				display:none;
			}
		</style>
	</head>
	<body>
		<?php include("header.php"); ?>
		<div id="homeSlide">
			<?php
				// generate slides from picture views with type attribute set to slide
				foreach ($pictures->xpath("picture[view[@type=\"slide\"]]") as $picture) {
					$view = $picture->xpath("view[@type=\"slide\"]");
					$view = reset($view);
					if ($view["hidden"] != "true")
						echo "<img src=\"" . $pictures["path"] . $view->file . "\" alt=\"\" title=\"" . $picture->title . "\"/>";
				}
			?>
		</div>
		<p>I'm drawn towards the haphazard nature of the countryside. I take inspiration from the people I love, the birds in my garden and sheep in the fields beyond. My art is all about simplicity, texture, and colour. My aim is to make a canvas appear simple without losing the essence of the subject.</p>	
		<div class="half">
			<div class="title">News</div>
			<?php
				// create array of future events
				foreach ($news->event as $event) {
					if (time() <= $event["endTime"])
						$futureEvents[] = $event;
					elseif ($event["duration"] == "all month" and time() <= strtotime(date("Y-m-t", (int)$event["endTime"])))
						$futureEvents[] = $event;
					elseif ($event["duration"] == "all year" and time() <= strtotime(date("Y", (int)$event["endTime"]) . "-12-31"))
						$futureEvents[] = $event;
				}
				if (count($futureEvents) > 0) {
					$count = 0;
					// print important events
					foreach ($futureEvents as $event) {
						if ($event["flag"] == "important" and $count < $maxEvents) {
							printNews($event);
							$count ++;
						}
					}
					// print other events
					foreach ($futureEvents as $event) {
						if ($event["flag"] != "important" and $count < $maxEvents) {
							printNews($event);
							$count ++;
						}
					}
				}
				else echo "<div class=\"news\">[No upcoming events]</div>";
			?>
		</div>
		<div class="half">
			<div class="title">twitter</div>
			<?php printTweet($tweets->tweet[0]); ?>
		</div>
		<p class="more" style="clear: both"><a href="follow">Read more tweets and see my calendar</a></p>
		<!-- <div class="title">From my blog</div> -->
		<?php // printBlog($blog->post[0], $blog->url, $blog->author, true) ?>
		<?php include("footer.php") ?>
	</body>
</html>