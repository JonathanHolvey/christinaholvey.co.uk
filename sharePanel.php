<!-- share panel start -->
<?php $url = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER["PHP_SELF"]; $title = "Christina Holvey Art"; ?>
<div id="sharePanelShow" class="footerText" title="Email this page to a friend, or bookmark it on a social networking site">Share this page <img src="images/share.png" style="vertical-align:middle;padding-bottom:3px" alt="share"/></div>
<div id="sharePanel"> <!-- share box - icons from http://www.komodomedia.com/blog/2009/06/social-network-icon-pack/ -->
	<div style="margin-bottom:2px">Share this page using...</div>
	<img src="images/share_delicious.png" alt="Delicious"/><a id="shareDelicious" href="http://del.icio.us/post?url=<?php echo urlencode($url) . "&amp;title=" . urlencode($title); ?>" title="Bookmark with Delicious">Delicious</a><br/>
	<img src="images/share_email.png" alt="Email"/><a id="shareEmail" href="mailto:?subject=You might like this... <?php echo $title . "&amp;body=" . $title . "%0A" . $url; ?>" title="Send a link via email">Email</a><br/>
	<img src="images/share_facebook.png" alt="Facebook"/><a id="shareFacebook" href="http://www.facebook.com/sharer.php?u=<?php echo urlencode($url) . "&amp;t=" . urlencode($title); ?>" title="Post a link on Facebook">Facebook</a><br/>
	<img src="images/share_stumbleupon.png" alt="Stumbleupon"/><a id="shareStumbleupon" href="http://www.stumbleupon.com/submit?url=<?php echo urlencode($url) . "&amp;title=" . urlencode($title); ?>" title="Share on stumbleupon.com">Stumbleupon</a><br/>
	<img src="images/share_twitter.png" alt="Twitter"/><a id="shareTwitter" href="http://twitter.com/home?status=<?php echo urlencode("Currently viewing '" . $title . "' at " . $url); ?>" title="Tweet on Twitter">Twitter</a>
	<div id="sharePanelHide" style="cursor:pointer;font-size:10px;position:absolute;bottom:5px;right:9px">Close</div>
</div>
<!-- share panel end -->
