<?php

	// Fetch forum info
	$result = $fdb->query('SELECT * FROM '.$_SESSION['php'].$_SESSION['phpnuke'].'forums WHERE forum_id>'.$start.' ORDER BY forum_id LIMIT '.$_SESSION['limit']) or myerror('phpBB: Unable to get table: forums', __FILE__, __LINE__, $fdb->error());
	$last_id = -1;
	while($ob = $fdb->fetch_assoc($result))
	{
		$last_id = $ob['forum_id'];
		echo $ob['forum_name'].' ('.$ob['forum_id'].")<br>\n"; flush();

		// Check for anonymous poster id problem
		$ob['forum_last_post_id'] == -1 ? $ob['forum_last_post_id'] = 1 : null;

		// Fetch user info
		$userres = $fdb->query('SELECT users.username, posts.post_time FROM '.$_SESSION['php'].'users AS users, '.$_SESSION['php'].$_SESSION['phpnuke'].'posts AS posts WHERE users.user_id=posts.poster_id AND posts.post_id='.$ob['forum_last_post_id']) or myerror("Unable to fetch user info for forum conversion.", __FILE__, __LINE__, $fdb->error());
		$userinfo = $fdb->fetch_assoc($userres);

		// Change last_post = 0 to null to prevent the time-bug.
		$userinfo['post_time'] == 0 ? $userinfo['post_time'] = 'null' : null;
		$ob['forum_last_post_id'] == 0 ? $ob['forum_last_post_id'] = 'null' : null;

		// Unset variables
		if(!isset($userinfo['username']))
			$userinfo['username'] = 'null';

		// Dataarray
		$todb = array(
			'id'				=>		$ob['forum_id'],
			'forum_name'	=>		$ob['forum_name'],
			'forum_desc'	=>		$ob['forum_desc'],
			'num_topics'	=>		$ob['forum_topics'],
			'num_posts'		=>		$ob['forum_posts'],
			'disp_position'=>		$ob['forum_order'],
			'last_poster'	=>		$userinfo['username'],
			'last_post_id'	=>		$ob['forum_last_post_id'],
			'last_post'		=>		$userinfo['post_time'],
			'cat_id'			=>		$ob['cat_id'],
		);

		// Save data
		insertdata('forums', $todb, __FILE__, __LINE__);
	}

	convredirect('forum_id', $_SESSION['phpnuke'].'forums', $last_id);

?>