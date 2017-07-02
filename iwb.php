<?php
$file = fopen('iwb.txt', 'r');
$date = fgets($file);
fclose($file);
$json = file_get_contents('http://iwanbanaran.com/wp-json/wp/v2/posts?context=embed');
$posts = json_decode($json);
$newDate = '';
$newPosts = [];
foreach($posts as $post) {
	if ($post->date > $date) {
		$newPosts[] = json_encode($post);
		if (empty($newDate)) {
			$newDate = $post->date;
		}
	} else {
		break;
	}
}
if (!empty($newDate)) {
	$file = fopen('iwb.txt', 'w');
	fwrite($file, $newDate);
	fclose($file);
}
krsort($newPosts);
foreach($newPosts as $post) {
	file_get_contents('https://hooks.zapier.com/hooks/catch/688188/1cg2q2/', false, stream_context_create(
		array(
			'http' => array(
				'method' => 'POST',
				'content' => $post,
				'header'=> "Content-Type: application/json\r\n"
			)
		)
	));
}
