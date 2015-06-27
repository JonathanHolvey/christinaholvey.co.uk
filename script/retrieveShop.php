<?php
	$apiKey = "45j61j4z7peighccnfnqcb5i";
	$shopId = "ChristinaHolvey";

	$shopOut = "../shop.xml";

	// get shop info
	$request = "https://openapi.etsy.com/v2/shops/" . $shopId . "?api_key=" . $apiKey;
	$response = json_decode(file_get_contents($request), true);
	$response = $response["results"][0];

	$shop = new simpleXMLElement("<?xml version=\"1.0\" encoding=\"ISO-8859-1\"?><shop/>");
	$shop->addAttribute("url", $response["url"]);

	// get listing info
	$request = "https://openapi.etsy.com/v2/shops/" . $shopId . "/listings/active?api_key=" . $apiKey;
	$response = json_decode(file_get_contents($request), true);
	$response = $response["results"];

	// add listings to xml
	foreach($response as $listing) {
		$item = $shop->addChild("item");
		$item->addAttribute("id", $listing["listing_id"]);
		$item->addChild("title", htmlspecialchars($listing["title"]));
		// $item->addChild("description", $listing["description"]);
		$item->addChild("price", $listing["price"]);
		$item->addChild("currency", $listing["currency_code"]);
		$item->addChild("url", htmlspecialchars($listing["url"]));
	}

	if ($shop -> asXML($shopOut))
		echo "Etsy shop cached sucessfully - <a href=\"" . $shopOut . "\">Click for file</a><br/>";
?>