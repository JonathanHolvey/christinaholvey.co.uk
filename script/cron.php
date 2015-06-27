<?php
	// list of scripts to run as this cron job - note full absolute address must be given
	file_get_contents("http://www.christinaholvey.co.uk/script/retrieveUpdates.php");
	file_get_contents("http://www.christinaholvey.co.uk/script/retrieveTweets.php");
	file_get_contents("http://www.christinaholvey.co.uk/script/retrieveShop.php");
	file_get_contents("http://www.christinaholvey.co.uk/script/retrieveblog.php");
?>