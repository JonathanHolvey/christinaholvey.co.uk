<?php $pictures = simplexml_load_file("pictures.xml") ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<title>Christina Holvey - About</title>
		<meta name="robots" content="NOODP"/> <!-- prevent search engines from using ODP info in results -->
		<meta http-equiv="content-type" content="text/html;charset=utf-8"/>
		<?php include("resources.php") ?>
		<script type="text/javascript">$(document).ready(function(){$("#link_about").addClass("active");});</script>
	</head>
	<body>
		<?php include("header.php"); ?>
		<div class="title">biography</div>
		<p>Christina Holvey is a painter and illustrator who works from her studio situated in the heart of the Chew Valley in rural Somerset. Here she paints, draws and writes, taking 'natural' inspiration from the great outdoors and featuring everything from the wild birds in her garden to the sheep grazing the patchwork fields beyond.</p>
		<p>Initially graduating in Biological Sciences, she worked as a producer at the BBC Natural History Unit, before shifting her focus from creating stories with moving images to that of painting a similar narrative in just one frame.</p>
		<p>Christina's warm and quirky style has quickly become desirable and she now regularly exhibits at both the Royal West of England Academy and Medici Gallery London, in addition to a number of distinguished galleries throughout the UK. Lord Bath is a keen Patron of her work and she recently provided all thirty-six illustrations for a new book entitled <i>My Garden and Other Animals</i> written by the TV presenter and naturalist Mike Dilger.</p>
		<div class="quote">
			She uses oil paints which have great depth and versatility. The palette, subject and forms come together to make a very striking but unfussy piece of art that is beguiling.
			<div class="citation">Rostra Gallery, Bath</div>
		</div>
		<div class="pictureBox">
			<img src="images/gallery/goldfinchCoffeeMorning_thumb.jpg" alt=""/>
			<img src="images/gallery/inTheBluebells_thumb.jpg" alt=""/>
			<img src="images/gallery/blueTitsOnPrimroseBank_thumb.jpg" alt=""/>
			<img src="images/gallery/chillySpringMorning_thumb.jpg" alt=""/>
		</div>
		<div class="quote" style="width:90%">
			My art is all about simplicity, texture and colour, with the emphasis being to always create an evocative interpretation, rather than merely a replica. Working from life is both a challenge and a joy, with the aim being to strip out the detail, whilst still crucially retaining both the raw elements and essence of my chosen subject. The rich cast of characters I see whilst working in my cottage garden are a delight to bring to life. And irrespective of the weather, and each and every day, there will always be some element of the natural world which both catches my eye and intrigues me sufficiently to reach for my sketchbook.
			<div class="citation">Christina Holvey</div>
		</div>
		<?php include("footer.php") ?>
	</body>
</html>