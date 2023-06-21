<div class="wrap">
	<h2>Sitemap Generator</h2>

	<form method="post">
		<input type="text" name="url" class="input" placeholder="URL" />
		<input type="submit" name="generate" class="button" value="Generate Sitemap" />
		<input type="submit" name="lastResult" class="button" value="Last result" />
	</form>
</div>

<?php
if(array_key_exists('generate', $_POST)) {
	generateSitemap();
}
else if(array_key_exists('lastResult', $_POST)) {
	lastResult();
}
function generateSitemap() {
	$config = include("tools/sitemap-config.php");
	$config['SITE_URL'] = $_POST['url'];

	if (filter_var($config['SITE_URL'], FILTER_VALIDATE_URL)) {
		include "tools/sitemap-generator.php";
		$smg = new SitemapGenerator($config);
		$smg->GenerateSitemap();
	} else {
		show_message('The URL is not valid');
	}
}
function lastResult() {
	$xml = str_replace('wp-content/plugins/sitemap-generator', '', __DIR__) . "sitemap.xml";
	if (!file_exists($xml)) {
		show_message('Sitemap not found');
		return;
	}

// get sitemap content
	$content = file_get_contents($xml);
	if (!$content) {
		show_message('Sitemap not found');
		return;
	}


// parse the sitemap content to object
	$xml = simplexml_load_string($content);

	echo "<div style='margin-top: 30px; padding: 0 20px'><ol>";

// retrieve properties from the sitemap object
	foreach ($xml->url as $urlElement) {
		$url = $urlElement->loc;
		echo "<li style='border-bottom: 1px solid black; padding: 20px 0'>$url</li>";
	}

	echo "</ol></div>";
}
?>
