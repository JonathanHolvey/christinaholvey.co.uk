<?php
	require_once("script/printNews.php");
	require_once("script/printTweet.php");

	$pictures = simplexml_load_file("pictures.xml");
	$news = simplexml_load_file("news.xml");
	$tweets = simplexml_load_file("tweets.xml");
	date_default_timezone_set("Europe/London");
	
	$maxFuture = 5;
	$maxPast = 5;
	$maxTweets = 6;
	
	// create arrays of future and past events
	foreach ($news->event as $event) {
		if (time() <= $event["endTime"])
			$futureEvents[] = $event;
		elseif ($event["duration"] == "all month" and time() <= strtotime(date("Y-m-t", (int)$event["endTime"])))
			$futureEvents[] = $event;
		elseif ($event["duration"] == "all year" and time() <= strtotime(date("Y", (int)$event["endTime"]) . "-12-31"))
			$futureEvents[] = $event;
		else
			$pastEvents[] = $event;
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Christina Holvey - Follow</title>
		<meta name="robots" content="NOODP"/> <!-- prevent search engines from using ODP info in results -->
		<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
		<?php include("resources.php") ?>
		<script type="text/javascript">$(document).ready(function(){$("#link_follow").addClass("active");});</script>
	</head>
	<body>
		<?php include("header.php") ?>
		<div class="half">
		<div class="title">Upcoming events</div>
			<?php
				if (count($futureEvents) > 0) {
					$count = 0;
					foreach ($futureEvents as $event) {
						printNews($event);
						$count ++;
						if ($count >= $maxFuture)
							break;
					}
				}
				else echo "<div class=\"news\">[No upcoming events]</div>";
			?>
			<div class="title">Recent events</div>
			<?php	
				// print past events
				$count = 0;
				foreach (array_reverse($pastEvents) as $event) {
					printNews($event);
					$count ++;
					if ($count >= $maxPast)
						break;
				}
			?>
		</div>
		<div class="half">
			<div class="title">Recent tweets</div>
			<?php
				$count = 0;
				foreach ($tweets->tweet as $tweet) {
					printTweet($tweet);
					$count ++;
					if ($count == $maxTweets)
						break;
				}
			?>
		</div>
		<p class="more">Read more of my tweets at <a href="<?php echo $tweets["url"] ?>">Twitter.com</a></p>
		<?php include("footer.php") ?>
	</body>
</html>