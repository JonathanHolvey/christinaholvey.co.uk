<?php
	// calculate time difference from now and return in format eg "16 hours" or "3 days" or "A long time" etc
	function getAge($time) {
		$seconds = time() - $time;
		$minutes = round($seconds / 60); $age = $minutes . " minute"; if ($minutes > 1) $age .= "s";
		if ($minutes >= 60) {$hours = round($minutes / 60); $age = $hours . " hour"; if ($hours > 1) $age .= "s";}
		if (isset($hours) and $hours >= 24) {$days = round($hours / 24); $age = $days . " day"; if ($days > 1) $age .= "s";}
		if (isset($days) and $days >= 7) {$weeks = round($days / 7); $age = $weeks . " week"; if ($weeks > 1) $age .= "s";}
		if (isset($weeks) and $weeks > 6) $age = "A long time";
		return $age;
	}
	
	// create tweet entry from simple xml element
	function printTweet($tweet) {
		echo "<div class=\"tweet\"><div class=\"words\">" . createLinks(htmlspecialchars($tweet->title)) . "</div><div class=\"time\"><a href=\"" . $tweet->url . "\" title=\"View on twitter.com\">" . getAge($tweet["time"]) . " ago</a></div></div>";
	}
	
	// replace url with anchor, and twitter tags with search links
	function createLinks($string) {
		$string = preg_replace("/(https?:\/\/[^\s]+)/", "<a href=\"$1\">$1</a>", $string);
		$string = preg_replace("/#(\w+)/", "<a href=\"http://twitter.com/hashtag/$1\">#$1</a>", $string);
		$string = preg_replace("/(@\w+)/", "<a href=\"http://twitter.com/$1\">$1</a>", $string);
		return $string;
	}
?>