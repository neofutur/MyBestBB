<?php
	$result = $fdb->query('SELECT post.post_id, post.post_time, post.poster_id, post.poster_ip, post.topic_id, text.post_subject, text.post_text, users.username FROM '.$_SESSION['php'].$_SESSION['phpnuke'].'posts AS post, '.$_SESSION['php'].$_SESSION['phpnuke'].'posts_text AS text, '.$_SESSION['php'].'users AS users WHERE post.post_id>'.$start.' AND post.post_id=text.post_id AND users.user_id=post.poster_id ORDER BY post.post_id LIMIT '.$_SESSION['limit']) or myerror("Unable to get posts", __FILE__, __LINE__, $fdb->error());
	$last_id = -1;
	while($ob = $fdb->fetch_assoc($result))
	{
		$last_id = $ob['post_id'];
		echo $ob['post_id'].' ('.$ob['username'].")<br>\n"; flush();

		// Check for anonymous poster id problem
		if($ob['poster_id'] == -1){
			$ob['poster_id'] = 1;
			$ob['username'] = 'Guest';
		}

		// Dataarray
		$todb = array(
			'id'			=>		$ob['post_id'],
			'poster'		=>		$ob['username'],
			'poster_id'	=>		$ob['poster_id'],
			'posted'		=>		$ob['post_time'],
			'poster_ip'	=>		decode_ip($ob['poster_ip']),
			'message'	=>		convert_posts($ob['post_text']),
			'topic_id'	=>		$ob['topic_id'],
		);

		// Save data
		insertdata('posts', $todb, __FILE__, __LINE__);
	}

	convredirect('post_id', $_SESSION['phpnuke'].'posts', $last_id);

?>