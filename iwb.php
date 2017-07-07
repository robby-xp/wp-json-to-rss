<?php
header('Content-Type: application/rss+xml;');
echo '<?xml version="1.0" encoding="UTF-8" ?>';
?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">
<channel>
	<title>Iwanbanaran.com</title>
	<link>http://iwanbanaran.com</link>
	<description>Iwanbanaran.com RSS Feed</description>
	<atom:link href="http://myxln.net/iwb.php" rel="self" type="application/rss+xml" />
	<?php
	$json = file_get_contents('http://iwanbanaran.com/wp-json/wp/v2/posts?context=embed');
	$posts = json_decode($json);
	foreach ($posts as $post) { ?>
		<item>
			<title><?php echo $post->title->rendered; ?></title>
			<link><?php echo $post->link; ?></link>
			<description><![CDATA[<?php echo $post->excerpt->rendered; ?>]]></description>
			<pubDate><?php echo date('r', strtotime($post->date.'+07:00')); ?></pubDate>
			<guid><?php echo 'http://iwanbanaran.com/?p='.$post->id; ?></guid>
		</item>
	<?php } ?>
</channel>
</rss>
