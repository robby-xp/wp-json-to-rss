<?php
header('Content-Type: application/rss+xml;');
echo '<?xml version="1.0" encoding="UTF-8" ?>';
?>
<rss version="2.0">
<channel>
	<title>Iwanbanaran.com</title>
	<link>http://iwanbanaran.com</link>
	<?php
	$json = file_get_contents('http://iwanbanaran.com/wp-json/wp/v2/posts?context=embed');
	$posts = json_decode($json);
	foreach ($posts as $post) { ?>
		<item>
			<title><?php echo $post->title->rendered; ?></title>
			<link><?php echo $post->link; ?></link>
			<description><?php echo $post->excerpt->rendered; ?></description>
		</item>
	<?php } ?>
</channel>
</rss>
