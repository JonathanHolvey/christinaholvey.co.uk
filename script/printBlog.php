<?php
	function printBlog($post, $url, $author, $truncate = false) {
		date_default_timezone_set ("Europe/London");
		echo "<div class=\"post\"><div class=\"date\">" . date("l j F Y",(int)$post["date"]) . "</div><div class=\"subtitle\">" . $post->title . "</div>";
		echo "<div class=\"content\">" . ($truncate? substr($post->content, 0, strpos($post->content, "</p>")) . " <span class=\"more inline\"><a href=\"blog\">Continue reading</a></span></p>": $post->content) . "</div>";
		echo "<div class=\"info\">Posted by <a href=\"" . $url . "\">" . $author . "</a> at <a href=\"" . $post->url . "\">" . date("g:i A",(int)$post["date"]) . "</a></div>";
		if ($post->comment) {
			$count = 0;
			foreach ($post->comment as $comment)
				$count ++;
			echo "<div class=\"comments\"><div class=\"count\">" . numberWord($count) . " comment";
			if ($count > 1)
				echo "s - <span class=\"show\">show all</span>";
			else
				echo ":";
			echo "</div>";
			foreach ($post->comment as $comment)
				echo "<div class=\"comment\"><div class=\"info\">" . $comment->author . " on <a href=\"" . $comment->url . "\">" . date("j F Y",(int)$comment["date"]) . "</a></div>" . $comment->content . "</div>";
			echo "</div>";
		}
		echo "<div class=\"divider\"></div></div>";
	}
?>