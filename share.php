<?php
$SITE_ROOT = "http://mindblitz.mindcet.org/";
$page_link = $SITE_ROOT."#/results/".$_GET["key"];
$img_URL = $SITE_ROOT."shareimage/".$_GET["key"].".png";
?>



<!DOCTYPE html>
<html>
    <head>
	
        <meta property="og:title" content="I've been mind blitzed" />
        <meta property="og:image" content="<?php echo $img_URL; ?>" />
        <meta property="og:image:width" content="1200" />
        <meta property="og:image:height" content="630" />
        <!-- etc. -->
    </head>
    <body>
        <p>I've been mind blitzed</p>
        <img src="<?php echo $img_URL; ?>">
		<script type="text/javascript">
			window.location = "<?php echo $page_link; ?>"
		</script>
    </body>
</html>
