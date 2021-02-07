<?php
	ini_set("memory_limit", "128M");
	ini_set("max_execution_time", 60);
	ini_set("allow_url_fopen", "ON");
	
	date_default_timezone_set("Europe/London");
	
	// retrieve blog posts
	$blogIn = "http://christinaholvey.blogspot.com/feeds/posts/default?alt=rss";
	$blogOut = "../blog.xml";
	$maxPosts = 5;
	
	if ($xmlBlogIn = simplexml_load_file($blogIn)->channel) {
		// create xml object
		$xmlBlogOut = new SimpleXMLElement("<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<blog/>");
		$xmlBlogOut->addChild("title", htmlspecialchars($xmlBlogIn->title));
		$xmlBlogOut->addChild("subtitle", htmlspecialchars($xmlBlogIn->description));
		$xmlBlogOut->addChild("author", htmlspecialchars(str_replace(")", "", substr($xmlBlogIn->managingEditor, strpos($xmlBlogIn->managingEditor, "(") + 1))));
		$xmlBlogOut->addChild("url", htmlspecialchars($xmlBlogIn->link));
		$xmlBlogOut->addChild("rss", $blogIn);
		// copy blog posts
		$count = 0;
		foreach ($xmlBlogIn->item as $post) {
			$postCopy = $xmlBlogOut->addChild("post");
			$postCopy->addChild("title", $post->title);
			$postCopy->addAttribute("date", strtotime($post->pubDate));
			$postCopy->addAttribute("id", substr($post->guid, strpos($post->guid, "post-") + 5));
			$postCopy->addChild("url", $post->link);
			$postCopy->addChild("content", "<p>" . str_replace(array("&nbsp;", "<br /><br />"), array("&#160;", "</p><p>"), $post->description) . "</p>");
						
			//retrieve comments
			$commentsIn = "http://christinaholvey.blogspot.com/feeds/" . $postCopy["id"] . "/comments/default?alt=rss";
 			$xmlComments = simplexml_load_file($commentsIn)->channel;
				foreach ($xmlComments->item as $comment) {
					$commentCopy = $postCopy->addChild("comment");
					$commentCopy->addAttribute("date", strtotime($comment->pubDate));
					$commentCopy->addChild("author", str_replace(")", "", substr($comment->author, strpos($comment->author, "(") + 1)));
					$commentCopy->addChild("content", $comment->description);
					$commentCopy->addChild("url", $comment->link);
				}
			
			$count ++;
			if ($count >= $maxPosts)
				break;
		}
		// output xml file
		if ($xmlBlogOut->asXML($blogOut))
			echo "Blog posts cached sucessfully - <a href=\"" . $blogOut . "\">Click for file</a><br/>";
	}
?>