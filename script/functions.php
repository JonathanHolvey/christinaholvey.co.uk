<?php
	// calculate css margins and dimensions to fit an image centrally into an element with fixed size
	function margins($file, $maxWidth, $maxHeight) {
		$size = getimagesize($file);
		$width = $size[0];
		$height = $size[1];
		if ($width / $height >= $maxWidth / $maxHeight) {
			$newWidth = $maxWidth;
			$newHeight = round(($height * $maxWidth) / $width);
		}
		else {
			$newWidth = round(($width * $maxHeight) / $height);
			$newHeight = $maxHeight;
		}
		$marginLeft = round(($maxWidth - $newWidth) / 2);
		$marginTop = round(($maxHeight - $newHeight) / 2);
		return "margin-top: " . $marginTop . "px; margin-left: " . $marginLeft . "px; width: " . $newWidth . "px; height: " . $newHeight . "px";
	}

	function currency($code) {
		// match full code
		switch($code) {
			case "EUR": return "&euro;";
			case "GBP": return "&pound;";
		}
		// match last character only
		switch(substr($code, -1)) {
			case "D": return "$";
			default: return "";
		}
	}

	function numberWord($number) {
		$words = array("zero", "one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten");
		if ($number > count($words))
			return number;
		else
			return $words[$number];
	}

	// return this page's url with $levels directories stripped from the end
	function goUp($levels) {
		$url = "http" . (isset($_SERVER["HTTPS"])? "s": "") . "://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
		$parts = explode("/", $url);
		$length = count($parts);
		$parts = array_slice($parts, 0, $length - $levels);
		return implode("/", $parts) . "/";
	}
?>