<?php
	ini_set("memory_limit","128M");
	ini_set("max_execution_time",60);
	ini_set("allow_url_fopen","ON");
	
	date_default_timezone_set("Europe/London");

	// retrieve calendar events
	$calendarIn = "https://cid-9a5d9160fad01328.calendar.live.com/calendar/private/c0b58ad6-bb43-4ba9-9fd3-2c153280a3c8/a14503c0-bd3f-4688-89a5-cc202154a831/calendar.ics";
	$calendarOut = "../news.xml";
	
	$calendarPast = 60 * 60 * 24 * 365; // number of seconds in the past to keep events for
	$calendarFuture = 60 * 60 * 24 * 365; // number of seconds in the future to keep events for
	
	// url regular expression filter
	$regexUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";
	
	require_once "iCalReader.php";
	
	// check calendar file is available
	if (file($calendarIn)) {
		// create xml object
		$xmlCalendar = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<events/>");
		// load events from calendar
		$ical = new iCalReader($calendarIn);
		$events = $ical -> getEvents();
		// sort events chronologically
		uasort($events,"iCalSort");
		// copy event into xml object
		foreach ($events as $event) {
			// only include events in the specified time range
			if (iCalGetEndTime($event) <= time() + $calendarFuture && iCalGetStartTime($event) >= time() - $calendarPast) {
				$xmlEvent = $xmlCalendar -> addChild("event");
				$xmlEvent -> addChild("title",htmlspecialchars($event["SUMMARY"]));
				$xmlEvent -> addChild("description",htmlspecialchars($event["DESCRIPTION"]));
				if ($event["LOCATION"])
					$xmlEvent -> addChild("location",htmlspecialchars(str_replace("\\","",$event["LOCATION"])));
				$xmlEvent -> addAttribute("startTime",iCalGetStartTime($event));
				$xmlEvent -> addAttribute("endTime",iCalGetEndTime($event));
				// extract custom options from description
				if (stripos($event["DESCRIPTION"],"[all month]") !== false) {
					$xmlEvent -> addAttribute("duration","all month");
					$xmlEvent -> description = str_ireplace("[all month]","",$xmlEvent -> description);
				}
				if (stripos($event["DESCRIPTION"],"[all year]") !== false) {
					$xmlEvent -> addAttribute("duration","all year");
					$xmlEvent -> description = str_ireplace("[all year]","",$xmlEvent -> description);
				}
				if (stripos($event["DESCRIPTION"],"[important]") !== false) {
					$xmlEvent -> addAttribute("flag","important");
					$xmlEvent -> description = str_ireplace("[important]","",$xmlEvent -> description);
				}
				// extract url from description
				if (preg_match($regexUrl,$event["DESCRIPTION"],$url)) {
					$xmlEvent -> addChild("url",$url[0]);
					$xmlEvent -> description = str_ireplace($url[0],"",$xmlEvent -> description);
				}
			}
		}
		// output xml file
		if ($xmlCalendar -> asXML($calendarOut))
			echo "Calendar events cached sucessfully - <a href=\"" . $calendarOut . "\">Click for file</a><br/>";
	}
	
	// comparison function for uasort() to sort events by date, i.e. use uasort($events,"iCalSort")
	function iCalSort($eventA,$eventB) {
		$timeA = iCalGetStartTime($eventA);
		$timeB = iCalGetStartTime($eventB);
		if ($timeA < $timeB)
			return -1;
		elseif ($timeA == $timeB)
			return 0;
		elseif ($timeA > $timeB)
			return 1;
	}
	// extract start timestamp from iCal event
	function iCalGetStartTime($event) {
		foreach ($event as $key => $value) {
			if (strpos($key,"DTSTART") === 0)
				return strtotime($value);
		}
	}
	// extract end timestamp from iCal event
	function iCalGetEndTime($event) {
		foreach ($event as $key => $value) {
			if (strpos($key,"DTEND") === 0)
				return strtotime($value);
		}
	}
?>