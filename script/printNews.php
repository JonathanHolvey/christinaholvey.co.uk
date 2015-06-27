<?php
	function printNews($event) {
		date_default_timezone_set("Europe/London");
		// format duration
		$duration = "";
		if ($event["duration"] == "all year")
			$duration .= "Coming in ";
		if (date("His",(int)$event["endTime"]) == "000000")
			$event["endTime"] -= 1;
		if (date("His",(int)$event["startTime"]) != "000000" and $event["duration"] != "all month" and $event["duration"] != "all year")
			$duration .= date("g:i A",(int)$event["startTime"]);
		if (date("dmY",(int)$event["startTime"]) != date("dmY",(int)$event["endTime"]) and $event["duration"] != "all month" and $event["duration"] != "all year")
			$duration .= date(" j",(int)$event["startTime"]) . "<sup>" . date("S",(int)$event["startTime"]) . "</sup>";
		if (date("mY",(int)$event["startTime"]) != date("mY",(int)$event["endTime"]) and $event["duration"] != "all year")
			$duration .= date(" F",(int)$event["startTime"]);
		if (date("Y",(int)$event["startTime"]) != date("Y",(int)$event["endTime"]))
			$duration .= date(" Y",(int)$event["startTime"]);
		if ((int)$event["startTime"] + 86399 != (int)$event["endTime"] and $event["duration"] != "all month" and $event["duration"] != "all year")
			$duration .= " to";
		if ($event["duration"] == "all month" and date("mY",(int)$event["startTime"]) != date("mY",(int)$event["endTime"]))
			$duration .= " to";
		if ($event["duration"] == "all year" and date("Y",(int)$event["startTime"]) != date("Y",(int)$event["endTime"]))
			$duration .= " to";
		if (date("His",(int)$event["endTime"]) != "235959" and $event["duration"] != "all month" and $event["duration"] != "all year")
			$duration .= date(" g:i A",(int)$event["endTime"]);
		if ($event["duration"] != "all month" and $event["duration"] != "all year")
			$duration .= date(" j",(int)$event["endTime"]) . "<sup>" . date("S",(int)$event["endTime"]) . "</sup>";
		if ($event["duration"] != "all year")
			$duration .= date(" F",(int)$event["endTime"]);
		$duration .= date(" Y",(int)$event["endTime"]);
		
		// tidy url label
		if ($event->url) {
			$urlLabel = str_ireplace("http://","",$event->url);
			if (strpos($urlLabel,"/") != 0)
				$urlLabel = substr($urlLabel,0,strpos($urlLabel,"/"));
		}
			
		echo "<div class=\"news\"><div class=\"subtitle\">" . $event->title . "</div><div class=\"details\">" . $duration;
		if ($event->location)
			echo " - " . $event->location;
		echo "</div><div class=\"description\">" . $event->description . "</div>";
		if (isset($event->url))
			echo "<a href=\"" . $event->url . "\">" . $urlLabel . "</a>";
		echo "</div>";
	}
?>